<?php
session_start();
require_once('./config.php');
require_once('./database.php');
require_once('./session.php');


class BranchHandler
{

    static function setBranchPosPage()
    {
        $page = $_POST["page"];
        $session = new Session();
        $session->set('branch-pos-page', (int) $page);
        header("Location: ../branch.php");
        exit;
    }

    static function setBranchTransactionPage()
    {
        $page = $_POST["page"];
        $session = new Session();
        $session->set('branch-transaction-page', (int) $page);
        header("Location: ../branch.php?page=transactions");
        exit;
    }

    static function setBranchStockPage()
    {
        $page = $_POST["page"];
        $session = new Session();
        $session->set('branch-stock-page', (int) $page);
        header("Location: ../branch.php?page=stocks");
        exit;
    }

    static function branchAddToCart()
    {
        $session = new Session();
        $branchProducts = $session->getOrSet('branch-cart-product', []);
        $productExists = false;

        $productStock = $_POST['product_stock'];
        foreach ($branchProducts as $key => &$product) {
            if ($product['product_id'] == $_POST['product_id']) {
                if (isset($_POST['action']) && $_POST['action'] === 'increment') {
                    if ($product['quantity'] < $productStock)
                        $product['quantity'] += 1;

                } elseif (isset($_POST['action']) && $_POST['action'] === 'decrement') {
                    if ($product['quantity'] > 1)
                        $product['quantity'] -= 1;
                    else
                        unset($branchProducts[$key]);
                }
                $productExists = true;
                break;
            }
        }
        if (!$productExists) {
            $branchProducts[] = [
                'product_id' => $_POST['product_id'],
                'branch_id' => $_POST['branch_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_stock' => $productStock,
                'quantity' => 1
            ];
        }

        $session->set('branch-cart-product', $branchProducts);
        header("Location: ../branch.php");
        exit;
    }

    static function branchAddTransaction()
    {
        $database = new MySQLDatabase();
        $session = new Session();

        $total = $_POST['total'];
        $received = $_POST['received'];
        $change = $_POST['change'];

        $branchProducts = $session->get('branch-cart-product');
        if ($branchProducts) {
            $productIDList = [];
            $branch_id = '1';
            foreach ($branchProducts as $product) {
                $productId = $product['product_id'];
                $quantity = $product['quantity'];
                $branch_id = $product['branch_id'];

                $query = "INSERT INTO productOrdered (productId, numberProduct) VALUES (?, ?)";
                $database->prepexec($query, $productId, $quantity);
                $productOrderedId = $database->getLastInsertedId();
                $productIDList[] = $productOrderedId;

                $updateQuery = "UPDATE products SET productStock = productStock - ? WHERE id = ?";
                $database->prepexec($updateQuery, $quantity, $productId);
            }

            $productIDListJson = json_encode(['id' => $productIDList]);
            $query = "INSERT INTO transactions (productOrderedIds, branchId, staffId, totalPrice, cashPrice, changePrice) 
                VALUES (?, ?, ?, ?, ?, ?)";

            $database->prepexec($query, $productIDListJson, $branch_id, 1, $total, $received, $change);
            $session->set('success-message', "Transaction saved successfully!");
        } else {
            $session->set('error-message', "Transaction error!");
        }

        $session->set('branch-cart-product', []);
        $session->set('branch-pos-page', 1);
        header("Location: ../branch.php");
        exit;
    }

    static function branchAddStock()
    {
        $database = new MySQLDatabase();
        $session = new Session();
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $branch_id = $_POST['branch_id'];

        $updateQuery = "UPDATE products SET productStock = productStock + ? WHERE id = ?";
        $database->prepexec($updateQuery, $quantity, $product_id);

        $updateQuery = "INSERT INTO stockHistory (productId, staffId, branchId, quantity) VALUES (?, ?, ?, ?)";
        $database->prepexec($updateQuery, $product_id, $user_id, $branch_id, $quantity);

        $session->set('success-message', 'Successfully restock items');
        header("Location: ../branch.php?page=stocks");
        exit;
    }

    static function branchRemoveStock()
    {
        $database = new MySQLDatabase();
        $session = new Session();
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $branch_id = $_POST['branch_id'];

        $updateQuery = "UPDATE products SET productStock = productStock - ? WHERE id = ?";
        $database->prepexec($updateQuery, $quantity, $product_id);

        $updateQuery = "INSERT INTO stockHistory (productId, staffId, branchId, quantity) VALUES (?, ?, ?, ?)";
        $database->prepexec($updateQuery, $product_id, $user_id, $branch_id, -$quantity);

        $session->set('success-message', 'Successfully unstock items');
        header("Location: ../branch.php?page=stocks");
        exit;
    }
}

class AdminHandler
{

    static function adminAddProduct()
    {
        $database = new MySQLDatabase();
        $session = new Session();

        $productName = $_POST["productName"];
        $productCategory = $_POST["productCategory"];
        if ($productCategory == "newCategory") {
            $productCategory = $_POST["newCategoryName"];
        }
        $assignedBranch = $_POST["assignedBranch"];
        $productStock = $_POST["productStock"];
        $productPrice = $_POST["productPrice"];
        $productQRCode = $_POST["productQRCode"];

        $uploadDir = '../img/';
        $productImage = null;

        if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
            $fileName = basename($_FILES['productImage']['name']);
            $uploadFile = $uploadDir . $fileName;

            if (file_exists($uploadFile) || move_uploaded_file($_FILES['productImage']['tmp_name'], $uploadFile)) {
                $productImage = $_FILES['productImage']['name'];
            } else {
                $session->set('error-message', 'Error uploading the file.');
                header("Location: ../admin.php?page=product-report");
                exit;
            }
        }

        $query = "
        INSERT INTO products 
        (branchId, barCode, productName, productPrice, productStock, productCategory, productImage) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        $database->prepexec(
            $query,
            $assignedBranch,
            $productQRCode,
            $productName,
            $productPrice,
            $productStock,
            $productCategory,
            $productImage
        );
        $session->set('success-message', 'Product added successfully.');
        header("Location: ../admin.php?page=product-report");
        exit;
    }
    static function archivedProduct()
    {
        $id = $_POST['id'];
        $is_archived = $_POST['is_archived'];

        $database = new MySQLDatabase();
        if ($is_archived == 'Archived') {
            $updateQuery = "UPDATE products SET isArchived = TRUE WHERE id = ?";
            $database->prepexec($updateQuery, $id);
        } else {
            $updateQuery = "UPDATE products SET isArchived = FALSE WHERE id = ?";
            $database->prepexec($updateQuery, $id);
        }
        header("Location: ../admin.php?page=product-report");
        exit;
    }

    static function adminAddBranch()
    {
        $database = new MySQLDatabase();
        $branch_name = $_POST['branchName'];
        $updateQuery = "INSERT INTO branch (branchName) VALUES (?)";
        $database->prepexec($updateQuery, $branch_name);
        header("Location: ../admin.php?page=accounts");
        exit;
    }

    static function adminAddAccount()
    {
        $database = new MySQLDatabase();
        $session = new Session();
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userStatus = $_POST['userStatus'];
        $assignedBranch = $_POST['assignedBranch'];
        $isAdmin = $_POST['isAdmin'] == "true" ? 1 : 0;

        $updateQuery = "INSERT INTO users (firstName, lastName, userName, email, password, isAdmin, assignedBranch, userStatus)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $database->prepexec($updateQuery, $firstName, $lastName, $userName, $email, $password, $isAdmin, $assignedBranch, $userStatus);

        $updateQuery = "INSERT INTO staff (userId) VALUES (?)";
        $database->prepexec($updateQuery, $database->getLastInsertedId());

        $session->set('success-message', 'Successfully added new account');
        header("Location: ../admin.php?page=accounts");
        exit;
    }

    static function setAdminPage($page, $goto = null)
    {
        $pages = $_POST["page"];
        $session = new Session();
        $session->set("admin-$page-page", (int) $pages);
        if ($goto)
            header("Location: ../admin.php?page=$goto");
        else
            header("Location: ../admin.php");
        exit;
    }

    static function branchSetUserStatus()
    {
        $database = new MySQLDatabase();
        $session = new Session();
        $user_id = $_POST["user_id"];
        $userStatus = $_POST["userStatus"];

        $updateQuery = "UPDATE users SET userStatus = ? WHERE id = ?";
        $database->prepexec($updateQuery, $userStatus, $user_id);

        $session->set('success-message', 'User status changed');
        header("Location: ../admin.php?page=accounts");
        exit;
    }

    static function adminChangeProductPrice()
    {
        $database = new MySQLDatabase();
        $session = new Session();

        $product_id = $_POST["product_id"];
        $product_price = $_POST["product_price"];
        $updateQuery = "UPDATE products SET productPrice = ? WHERE id = ?";
        $database->prepexec($updateQuery, $product_price, $product_id);

        $session->set('success-message', 'Product price changed successfully');
        header("Location: ../admin.php?page=product-report");
        exit;
    }
}

function login()
{
    $database = new MySQLDatabase();
    $session = new Session();
    $email = $_POST['email'];
    $password = $_POST['pass'];

    if (empty($email) || empty($password)) {
        $session->set('error-message', 'Email or password cannot be empty.');
        header("Location: login.php");
        exit();
    }

    $query = "
        SELECT id, userName, firstName, lastName, email, password, isAdmin, assignedBranch, userStatus 
        FROM users WHERE email = ? LIMIT 1";

    $result = $database->prepexec($query, $email);
    if ($result->num_rows == 0) {
        $session->set('error-message', 'Invalid email or password.');
        header("Location: ../index.php");
        exit();
    }

    $user = $result->fetch_assoc();
    if ($password != $user['password']) {
        $session->set('error-message', 'Invalid email or password.');
        header("Location: ../index.php");
        exit();
    }

    if ($user['userStatus'] !== 'active') {
        $session->set('error-message', 'Your account is not active.');
        header("Location: ../index.php");
        exit();
    }

    $userData = [
        'id' => $user['id'],
        'userName' => $user['userName'],
        'firstName' => $user['firstName'],
        'lastName' => $user['lastName'],
        'email' => $user['email'],
        'isAdmin' => $user['isAdmin'],
        'assignedBranch' => $user['assignedBranch'],
        'userStatus' => $user['userStatus']
    ];

    $session->set('account', $userData);
    $session->set('success-message', 'Login successful!');

    if ($userData['isAdmin'] == '0')
        header("Location: ../branch.php");
    else
        header("Location: ../admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $type = $_POST['type'];
    if ($type == 'client-login')
        login();

    if ($type == 'branch-stock-item')
        BranchHandler::branchAddStock();
    if ($type == 'branch-unstock-item')
        BranchHandler::branchRemoveStock();
    if ($type == "branch-pos-page")
        BranchHandler::setBranchPosPage();
    if ($type == "branch-transaction-page")
        BranchHandler::setBranchTransactionPage();
    if ($type == "branch-stock-page")
        BranchHandler::setBranchStockPage();
    if ($type == "branch-add-cart")
        BranchHandler::branchAddToCart();
    if ($type == "branch-add-transaction")
        BranchHandler::branchAddTransaction();

    if ($type == "admin-add-product")
        AdminHandler::adminAddProduct();
    if ($type == "admin-change-price")
        AdminHandler::adminChangeProductPrice();
    if ($type == "admin-set-user-status")
        AdminHandler::branchSetUserStatus();
    if ($type == "archive-product")
        AdminHandler::archivedProduct();
    if ($type == "admin-add-branch")
        AdminHandler::adminAddBranch();
    if ($type == "admin-add-account")
        AdminHandler::adminAddAccount();
    if ($type == "admin-account-page")
        AdminHandler::setAdminPage('account', 'accounts');
    if ($type == "admin-stock-page")
        AdminHandler::setAdminPage('stock', 'product-report');
    if ($type == "admin-transactions-page")
        AdminHandler::setAdminPage('transactions');
    if ($type == "admin-stock-history-page")
        AdminHandler::setAdminPage('stock-history', 'stock-report');
    if ($type == "admin-transaction-page")
        AdminHandler::setAdminPage('transaction', 'transaction-report');
}

?>