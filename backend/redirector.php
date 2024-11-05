<?php
session_start();
require_once('./config.php');
require_once('./database.php');
require_once('./session.php');


class BranchHandler
{

    static function checkOnlineStatus()
    {
        $isOnline = !(@fsockopen('www.google.com', 80) == null);
        $_SESSION['online'] = $isOnline;
        header("Location: ../branch.php");
        exit;
    }
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
                'branch_name' => $_SESSION['account']['assignedBranch'],
                'product_barcode' => $_POST['product_barcode'],
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

    static function branchAddProductOffline($branch_target)
    {
        $session = new Session();
        $branchProducts = $session->getOrSet('branch-cart-product', []);
        $productExists = false;

        $productBarcode = $_POST['productBarcode'];
        $products = $session->get("product-cache-{$branch_target}");

        $product_target = [];
        foreach ($products as $prod) {
            if ($prod['barCode'] === $productBarcode) {
                $product_target = $prod;
                break;
            }
        }
        if (empty($product_target)) {
            $session->set('error-message', "You are offline. Product does not found in this branch.");
            header("Location: ../branch.php");
            exit;
        }

        $productStock = $product_target['productStock'];
        foreach ($branchProducts as $key => &$product) {
            if ($product['product_id'] === $product_target['id']) {
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
                'product_id' => $product_target['id'],
                'branch_id' => $product_target['branchId'],
                'branch_name' => $branch_target,
                'product_barcode' => $product_target['barCode'],
                'product_name' => $product_target['productName'],
                'product_price' => $product_target['productPrice'],
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
        $seniorDiscount = $_POST['is-senior'];
        $pwdDiscount = $_POST['is-pwd'];

        $branchProducts = $session->get('branch-cart-product');

        if ($branchProducts) {
            $productIDList = [];
            $branch_id = '1';

            foreach ($branchProducts as $product) {
                $productId = $product['product_id'];
                $quantity = $product['quantity'];
                $branch_id = $product['branch_id'];

                $quantityToDeduct = $product['quantity'];
                $productIDList[] = [
                    'product_id' => $productId,
                    'branch_name' => $product['branch_name'],
                    'product_name' => $product['product_name'],
                    'product_price' => $product['product_price'],
                    'quantity' => $quantity
                ];

                $totalAvailableStock = 0;

                $checkQuery = "SELECT * FROM stockHistory 
                                    WHERE productId = ? 
                                    AND discarded = FALSE 
                                    AND expirationDate > NOW() 
                                    ORDER BY expirationDate ASC";
                $checkResult = $database->prepexec($checkQuery, $productId);

                while ($batch = $checkResult->fetch_assoc()) {
                    $totalAvailableStock += $batch['remainingStock'];
                    if ($totalAvailableStock >= $quantityToDeduct) {
                        break;
                    }
                }

                if ($totalAvailableStock < $quantityToDeduct) {
                    $session->set('error-message', "Some of the product stock available is expired: {$product['product_name']}");
                    header("Location: ../branch.php");
                    exit;
                }

                $checkResult->data_seek(0);
                while ($quantityToDeduct > 0 && $batch = $checkResult->fetch_assoc()) {
                    $stockId = $batch['id'];
                    $remainingStock = $batch['remainingStock'];
                    $deductAmount = min($quantityToDeduct, $remainingStock);

                    $quantityToDeduct -= $deductAmount;
                    $updateQuery = "UPDATE stockHistory SET remainingStock = remainingStock - ? WHERE id = ?";
                    $database->prepexec($updateQuery, $deductAmount, $stockId);
                }
            }

            $transactionData = [
                'productOrderedIds' => $productIDList,
                'branchId' => $branch_id,
                'branchName' => $session->get('account')['branchName'],
                'staffId' => $session->get('account')['id'],
                'staffUsername' => $session->get('account')['userName'],
                'totalPrice' => $total,
                'cashPrice' => $received,
                'changePrice' => $change,
                'seniorDiscount' => $seniorDiscount,
                'pwdDiscount' => $pwdDiscount,
            ];

            if ($_SESSION['online']) {
                $productIDList = [];
                foreach ($branchProducts as $product) {
                    $productId = $product['product_id'];
                    $quantity = $product['quantity'];

                    $query = "INSERT INTO productOrdered (productId, numberProduct) VALUES (?, ?)";
                    $database->prepexec($query, $productId, $quantity);
                    $productOrderedId = $database->getLastInsertedId();
                    $productIDList[] = $productOrderedId;

                    $updateQuery = "UPDATE products SET productStock = productStock - ? WHERE id = ?";
                    $database->prepexec($updateQuery, $quantity, $productId);
                }

                $productIDListJson = json_encode(['id' => $productIDList]);

                $query = "INSERT INTO transactions (productOrderedIds, branchId, staffId, totalPrice, cashPrice, changePrice, seniorDiscount, pwdDiscount) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $database->prepexec(
                    $query,
                    $productIDListJson,
                    $branch_id,
                    $session->get('account')['id'],
                    $total,
                    $received,
                    $change,
                    $seniorDiscount,
                    $pwdDiscount
                );
                $session->set('success-message', "Transaction saved successfully!");
            } else {
                $offlineTransactionsFile = '../json/offline_transactions.json';
                $offlineTransactions = file_exists($offlineTransactionsFile)
                    ? json_decode(file_get_contents($offlineTransactionsFile), true)
                    : [];

                $branchName = $transactionData['branchName'];
                if (!isset($offlineTransactions[$branchName])) {
                    $offlineTransactions[$branchName] = [];
                }
                $offlineTransactions[$branchName][] = $transactionData;
                file_put_contents($offlineTransactionsFile, json_encode($offlineTransactions, JSON_PRETTY_PRINT));
                $session->set('success-message', "Transaction saved offline for Branch $branchName. Upload when online.");
            }
        } else {
            $session->set('error-message', "Transaction error!");
        }
        $session->set('last_transaction', $transactionData);
        $session->set('branch-cart-product', []);
        $session->set('branch-pos-page', 1);
        header("Location: ../branch.php");
        exit;
    }

    static function updateTransaction()
    {
        // update-transaction
        $database = new MySQLDatabase();
        $session = new Session();

        $transactionId = $_POST['transactionId'];
        $cashReceived = $_POST['cashReceived'];
        $itemIds = $_POST['itemId'] ?? [];
        $itemQuantities = $_POST['itemQuantity'] ?? [];
        $productIds = $_POST['productIds'] ?? [];

        $seniorDiscount = $_POST['seniorDiscount'] ?? "0";
        $pwdDiscount = $_POST['pwdDiscount'] ?? "0";

        $discountRate = 0;
        if ($seniorDiscount) {
            $discountRate += 0.20;
        }
        if ($pwdDiscount) {
            $discountRate += 0.20;
        }
        $itemTotalPrice = 0;

        try {
            $database->beginTransaction();

            foreach ($productIds as $index => $productId) {
                $quantity = $itemQuantities[$index];

                $productQuery = "SELECT productPrice, productStock FROM products WHERE id = ?";
                $product = $database->prepexec($productQuery, $productId)->fetch_assoc();

                $oldTransactionQuery = "SELECT * FROM productOrdered WHERE id = ?";
                $oldTransaction = $database->prepexec($oldTransactionQuery, $itemIds[$index])->fetch_assoc();

                if ($product) {
                    $productPrice = $product['productPrice'];
                    $originalStock = $product['productStock'];

                    $newStock = $originalStock + $oldTransaction['numberProduct'] - $quantity;
                    $quantityToDeduct = $quantity;
                    $totalAvailableStock = 0;

                    $stockQuery = "SELECT * FROM stockHistory 
                        WHERE productId = ? 
                        AND discarded = FALSE 
                        AND expirationDate > NOW() 
                        ORDER BY expirationDate ASC";
                    $stockResult = $database->prepexec($stockQuery, $productId);

                    $totalAvailableStock = $oldTransaction['numberProduct'];
                    while ($batch = $stockResult->fetch_assoc()) {
                        $totalAvailableStock += $batch['remainingStock'];
                        if ($totalAvailableStock >= abs($quantityToDeduct)) {
                            break;
                        }
                    }

                    if ($totalAvailableStock < abs($quantityToDeduct)) {
                        throw new Exception("Not enough stock available for product ID {$productId}");
                    }

                    $stockResult->data_seek(0);
                    $toAdd = $oldTransaction['numberProduct'];
                    while ($batch = $stockResult->fetch_assoc()) {
                        $stockId = $batch['id'];
                        $remainingStock = $batch['remainingStock'] + $toAdd;
                        $toAdd = 0;

                        $deductAmountMin = min($quantityToDeduct, $remainingStock);
                        $deductAmount = $remainingStock - $deductAmountMin;
                        $quantityToDeduct -= $deductAmountMin;

                        $updateQuery = "UPDATE stockHistory SET remainingStock = ? WHERE id = ?";
                        $database->prepexec($updateQuery, $deductAmount, $stockId);
                    }

                    $stockUpdateQuery = "UPDATE products SET productStock = ? WHERE id = ?";
                    $database->prepexec($stockUpdateQuery, $newStock, $productId);

                    $transactionItemUpdateQuery = "UPDATE productOrdered SET numberProduct = ? WHERE id = ? AND productId = ?";
                    $database->prepexec($transactionItemUpdateQuery, $quantity, $itemIds[$index], $productId);

                    $itemTotalPrice += $quantity * $productPrice * (1 - $discountRate);
                }
            }

            if ($itemTotalPrice > $cashReceived) {
                throw new Exception("Insufficient cash received for the total transaction price.");
            }

            $query = "UPDATE transactions SET totalPrice = ?, cashPrice = ?, changePrice = ?, seniorDiscount = ?, pwdDiscount = ? WHERE id = ?";
            $database->prepexec($query, $itemTotalPrice, $cashReceived, $cashReceived - $itemTotalPrice, $seniorDiscount, $pwdDiscount, $transactionId);

            $database->commit();
            $session->set('success-message', "Transaction updated successfully!");

        } catch (Exception $e) {
            $database->rollback();
            $session->set('error-message', "Transaction update failed: " . $e->getMessage());
        }

        header("Location: ../branch.php?page=transactions");
        exit;
    }

    // static function branchAddTransaction()
    // {
    //     $database = new MySQLDatabase();
    //     $session = new Session();

    //     $total = $_POST['total'];
    //     $received = $_POST['received'];
    //     $change = $_POST['change'];
    //     $branchProducts = $session->get('branch-cart-product');

    //     if ($branchProducts) {
    //         $productIDList = [];
    //         $branch_id = '1';

    //         foreach ($branchProducts as $product) {
    //             $productId = $product['product_id'];
    //             $quantityToDeduct = $product['quantity'];
    //             $branch_id = $product['branch_id'];

    //             $productIDList[] = [
    //                 'product_id' => $productId,
    //                 'branch_name' => $product['branch_name'],
    //                 'product_name' => $product['product_name'],
    //                 'product_price' => $product['product_price'],
    //                 'quantity' => $quantityToDeduct
    //             ];
    //             $modifiedStocks = [];
    //             $totalAvailableStock = 0;

    //             $checkQuery = "SELECT * FROM stockHistory 
    //                     WHERE productId = ? 
    //                     AND discarded = FALSE 
    //                     AND expirationDate > NOW() 
    //                     ORDER BY expirationDate ASC";
    //             $checkResult = $database->prepexec($checkQuery, $productId);

    //             while ($batch = $checkResult->fetch_assoc()) {
    //                 $totalAvailableStock += $batch['remainingStock'];
    //                 if ($totalAvailableStock >= $quantityToDeduct) {
    //                     break;
    //                 }
    //             }

    //             if ($totalAvailableStock < $quantityToDeduct) {
    //                 foreach ($modifiedStocks as $stockId => $originalStock) {
    //                     $revertQuery = "UPDATE stockHistory SET remainingStock = ? WHERE id = ?";
    //                     $database->prepexec($revertQuery, $originalStock, $stockId);
    //                 }
    //                 $session->set('error-message', "Some of the product stock available is expired: {$product['product_name']}");
    //                 header("Location: ../branch.php");
    //                 exit;
    //             }

    //             $checkResult->data_seek(0);
    //             while ($quantityToDeduct > 0 && $batch = $checkResult->fetch_assoc()) {
    //                 $stockId = $batch['id'];
    //                 $remainingStock = $batch['remainingStock'];
    //                 $deductAmount = min($quantityToDeduct, $remainingStock);

    //                 $updateQuery = "UPDATE stockHistory SET remainingStock = remainingStock - ? WHERE id = ?";
    //                 $database->prepexec($updateQuery, $deductAmount, $stockId);

    //                 // potential rollback
    //                 if (!isset($modifiedStocks[$stockId])) {
    //                     $modifiedStocks[$stockId] = $remainingStock;
    //                 }

    //                 $quantityToDeduct -= $deductAmount;
    //             }
    //         }

    //         $transactionData = [
    //             'productOrderedIds' => $productIDList,
    //             'branchId' => $branch_id,
    //             'branchName' => $session->get('account')['branchName'],
    //             'staffId' => $session->get('account')['id'],
    //             'staffUsername' => $session->get('account')['userName'],
    //             'totalPrice' => $total,
    //             'cashPrice' => $received,
    //             'changePrice' => $change,
    //         ];

    //         if ($_SESSION['online']) {
    //             $productIDListJson = json_encode(['id' => array_column($productIDList, 'product_id')]);
    //             $query = "
    //                 INSERT INTO transactions (productOrderedIds, branchId, staffId, totalPrice, cashPrice, changePrice) 
    //                     VALUES (?, ?, ?, ?, ?, ?)";
    //             $database->prepexec($query, $productIDListJson, $branch_id, $session->get('account')['id'], $total, $received, $change);
    //             $session->set('success-message', "Transaction saved successfully!");
    //         } else {
    //             $offlineTransactionsFile = '../json/offline_transactions.json';
    //             $offlineTransactions = file_exists($offlineTransactionsFile)
    //                 ? json_decode(file_get_contents($offlineTransactionsFile), true)
    //                 : [];

    //             $branchName = $transactionData['branchName'];
    //             if (!isset($offlineTransactions[$branchName])) {
    //                 $offlineTransactions[$branchName] = [];
    //             }
    //             $offlineTransactions[$branchName][] = $transactionData;
    //             file_put_contents($offlineTransactionsFile, json_encode($offlineTransactions, JSON_PRETTY_PRINT));
    //             $session->set('success-message', "Transaction saved offline for Branch $branchName. Upload when online.");
    //         }

    //         $session->set('last_transaction', $transactionData);
    //         $session->set('branch-cart-product', []);
    //         $session->set('branch-pos-page', 1);
    //         header("Location: ../branch.php");
    //         exit;
    //     } else {
    //         $session->set('error-message', "Transaction error!");
    //         header("Location: ../branch.php");
    //         exit;
    //     }
    // }


    static function uploadTransaction()
    {
        $database = new MySQLDatabase();
        $session = new Session();
        $offlineTransactionsFile = '../json/offline_transactions.json';

        if (file_exists($offlineTransactionsFile)) {
            $offlineTransactions = json_decode(file_get_contents($offlineTransactionsFile), true);

            $found = false;
            if ($offlineTransactions) {
                $branchName = $session->get('account')['branchName'];
                foreach ($offlineTransactions as $branch_name => $transactions) {
                    if (
                        $branchName !== "All Branch" &&
                        $branchName !== $branch_name
                    )
                        continue;

                    foreach ($transactions as $transaction) {
                        $found = true;
                        $productIDList = [];
                        foreach ($transaction['productOrderedIds'] as $product) {
                            $productId = $product['product_id'];
                            $quantity = $product['quantity'];

                            $query = "INSERT INTO productOrdered (productId, numberProduct) VALUES (?, ?)";
                            $database->prepexec($query, $productId, $quantity);
                            $productOrderedId = $database->getLastInsertedId();
                            $productIDList[] = $productOrderedId;

                            $updateQuery = "UPDATE products SET productStock = productStock - ? WHERE id = ?";
                            $database->prepexec($updateQuery, $quantity, $productId);
                        }
                        $productIDListJson = json_encode(['id' => $productIDList]);

                        $query = "
                            INSERT INTO transactions
                            (productOrderedIds, branchId, staffId, totalPrice, cashPrice, changePrice) 
                            VALUES (?, ?, ?, ?, ?, ?)";
                        $database->prepexec(
                            $query,
                            $productIDListJson,
                            $transaction['branchId'],
                            $transaction['staffId'],
                            $transaction['totalPrice'],
                            $transaction['cashPrice'],
                            $transaction['changePrice']
                        );
                    }

                }
                if ($branchName === "All Branch") {
                    file_put_contents($offlineTransactionsFile, json_encode([]));
                } else {
                    $offlineTransactions[$branchName] = [];
                    file_put_contents($offlineTransactionsFile, json_encode($offlineTransactions));
                }

                if ($found)
                    $session->set('success-message', "Offline transactions uploaded successfully.");
                else
                    $session->set('error-message', "No offline transactions to upload.");
            } else {
                $session->set('error-message', "No offline transactions to upload.");
            }
        } else {
            $session->set('error-message', "Offline transactions file not found.");
        }
        header("Location: ../{$_POST['direct']}");
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
        $productGeneric = $_POST["productGeneric"];
        if ($productGeneric == "newGeneric") {
            $productGeneric = $_POST["newGenericName"];
        }
        $productCategory = $_POST["productCategory"];
        if ($productCategory == "newCategory") {
            $productCategory = $_POST["newCategoryName"];
        }
        $assignedBranch = $_POST["assignedBranch"];
        $productUnit = $_POST["productUnit"];
        $productPrice = $_POST["productPrice"];
        $productQRCode = $_POST["productQRCode"];

        $productStock = $_POST["productStock"];
        $expirationDate = $_POST["expirationDate"];


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
        (branchId, barCode, genericBrand, productStock, productName, productPrice, productUnit, productCategory, productImage) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $database->prepexec(
            $query,
            $assignedBranch,
            $productQRCode,
            $productGeneric,
            $productStock,
            $productName,
            $productPrice,
            $productUnit,
            $productCategory,
            $productImage
        );

        $last_id = $database->getLastInsertedId();
        $updateQuery = "INSERT INTO stockHistory (productId, staffId, branchId, expirationDate, quantity, remainingStock) VALUES (?, ?, ?, ?, ?, ?)";
        $database->prepexec(
            $updateQuery,
            $last_id,
            $session->get('account')['id'],
            $assignedBranch,
            $expirationDate,
            $productStock,
            $productStock
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
        $assignedBranch = $_POST['assignedBranch'];

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $updateQuery = "INSERT INTO users (firstName, lastName, userName, email, password, assignedBranch)
            VALUES (?, ?, ?, ?, ?, ?)";
        $database->prepexec($updateQuery, $firstName, $lastName, $userName, $email, $hashed, $assignedBranch);

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
        $product_price = $_POST["productPrice"];
        $updateQuery = "UPDATE products SET productPrice = ? WHERE id = ?";
        $database->prepexec($updateQuery, $product_price, $product_id);

        $session->set('success-message', 'Product price changed successfully');
        header("Location: ../admin.php?page=product-report");
        exit;
    }


}


class ProductHandler
{
    static function addStock()
    {
        $database = new MySQLDatabase();
        $session = new Session();

        $user_id = $session->get('account')['id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['productStock'];
        $expiration = $_POST['expirationDate'];
        $branch_id = $session->get('account')['assignedBranch'];

        $updateQuery = "UPDATE products SET productStock = productStock + ? WHERE id = ?";
        $database->prepexec($updateQuery, $quantity, $product_id);
        $updateQuery = "INSERT INTO stockHistory (productId, staffId, branchId, expirationDate, quantity, remainingStock) VALUES (?, ?, ?, ?, ?, ?)";
        $database->prepexec($updateQuery, $product_id, $user_id, $branch_id, $expiration, $quantity, $quantity);

        $session->set('success-message', 'Successfully restock items');
        header("Location: ..{$session->get('current_url')}");
        exit;
    }

    static function discardSingle()
    {
        $database = new MySQLDatabase();
        $session = new Session();

        $productId = $_POST["productId"];
        $historyId = $_POST["historyId"];
        $remainingStock = $_POST["remainingStock"];

        $updateQuery = "UPDATE products SET productStock = productStock - ? WHERE id = ?";
        $database->prepexec($updateQuery, $remainingStock, $productId);

        $updateQuery = "UPDATE stockHistory SET discarded = TRUE WHERE id = ?";
        $database->prepexec($updateQuery, $historyId);

        $session->set('success-message', 'Successfully dicarded an items');
        header("Location: ../admin.php?page=product-report");
    }
}

function login()
{
    $session = new Session();
    $email = $_POST['email'];
    $password = $_POST['pass'];

    $cache = $session->get('cache_account');
    if (@fsockopen('www.google.com', 80) == null) {
        if (is_array($cache) && isset($cache[$email])) {
            $user = $cache[$email];
            if (password_verify($password, $user['password'])) {
                $userData = [
                    'id' => $user['id'],
                    'userName' => $user['userName'],
                    'firstName' => $user['firstName'],
                    'lastName' => $user['lastName'],
                    'email' => $user['email'],
                    'isAdmin' => $user['isAdmin'],
                    'assignedBranch' => $user['assignedBranch'],
                    'branchName' => $user['branchName'],
                    'userStatus' => $user['userStatus']
                ];

                $session->set('account', $userData);
                $session->set('success-message', 'Login successful!');

                if ($userData['isAdmin'] == '0')
                    header("Location: ../branch.php");
                else
                    header("Location: ../admin.php");
                exit;
            }
        } else {
            $session->set('error-message', "You are offline, and no cached login record was found for this account.");
            header("Location: ../index.php");
            exit;
        }
    }

    $database = new MySQLDatabase();
    if (empty($email) || empty($password)) {
        $session->set('error-message', 'Email or password cannot be empty.');
        header("Location: login.php");
        exit();
    }

    $query = "
        SELECT users.id AS id, userName, firstName, lastName, email, password, isAdmin, assignedBranch, userStatus, b.branchName AS branchName
        FROM users JOIN branch b ON b.id = users.assignedBranch WHERE email = ? LIMIT 1";

    $result = $database->prepexec($query, $email);
    if ($result->num_rows == 0) {
        $session->set('error-message', 'Invalid email or password.');
        header("Location: ../index.php");
        exit();
    }

    $user = $result->fetch_assoc();
    if (!$user || !password_verify($password, $user['password'])) {
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
        'branchName' => $user['branchName'],
        'userStatus' => $user['userStatus']
    ];

    $session->set('account', $userData);
    $session->set('success-message', 'Login successful!');

    $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
    $cache[$email] = [
        'id' => $user['id'],
        'userName' => $user['userName'],
        'firstName' => $user['firstName'],
        'lastName' => $user['lastName'],
        'email' => $user['email'],
        'password' => $hashedPassword,
        'isAdmin' => $user['isAdmin'],
        'assignedBranch' => $user['assignedBranch'],
        'branchName' => $user['branchName'],
        'userStatus' => $user['userStatus']
    ];
    file_put_contents("../json/cache_account.json", json_encode($cache, JSON_PRETTY_PRINT));

    if ($userData['isAdmin'] == '0')
        header("Location: ../branch.php");
    else
        header("Location: ../admin.php");
    exit;
}

function changePassword()
{
    $database = new MySQLDatabase();
    $session = new Session();
    $userId = $_POST['id'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($newPassword !== $confirmPassword) {
        $session->set('error-message', 'New password and confirmation do not match.');
        header("Location: ../admin.php?page=accounts");
        exit;
    }

    $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
    $updateQuery = "UPDATE users SET password = ? WHERE id = ?";
    $database->prepexec($updateQuery, $newPasswordHash, $userId);

    $session->set('success-message', 'Password changed successfully.');
    header("Location: ../admin.php?page=accounts");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $type = $_POST['type'];
    if ($type == 'client-login')
        login();
    if ($type == 'change-password')
        changePassword();

    if ($type == 'add-stock')
        ProductHandler::addStock();
    if ($type == 'discard-single')
        ProductHandler::discardSingle();

    if ($type == 'update-transaction')
        BranchHandler::updateTransaction();
    if ($type == "upload-transaction")
        BranchHandler::uploadTransaction();
    if ($type == 'branch-stock-item')
        BranchHandler::branchAddStock();
    if ($type == "check-online-status")
        BranchHandler::checkOnlineStatus();
    if ($type == 'branch-unstock-item')
        BranchHandler::branchRemoveStock();
    if ($type == "branch-pos-page")
        BranchHandler::setBranchPosPage();
    if ($type == "branch-transaction-page")
        BranchHandler::setBranchTransactionPage();
    if ($type == "branch-stock-page")
        BranchHandler::setBranchStockPage();
    if ($type == "branch-add-cart") {
        if ($_SESSION['online'])
            BranchHandler::branchAddToCart();
        else
            BranchHandler::branchAddProductOffline($_SESSION['account']['branchName']);
    }
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