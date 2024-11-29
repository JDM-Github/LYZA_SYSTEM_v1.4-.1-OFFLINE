<?php


class AdminClass
{
    static function isSelected($option, $selectedValue)
    {
        return $option === $selectedValue ? 'selected' : '';
    }

    static function getStringModal(
        $modalId,
        $modalTitle,
        $value,
        $productId,
        $branchId,
        $productName,
        $genericBrand,
        $categoryName,
        $branchName,
        $productStock,
        $unit,
        $price,
        $productImage,
        $qrCode,
        $isAddProductStock = false,
        $isDiscardProductStock = false,
        $isChangePrice = false,
        $editProduct = false,
        $discardModalId = null,
    ) {
        return "
        <div class='modal fade' id='$modalId' tabindex='-1' aria-labelledby='$modalId-label' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='$modalId-label'>$modalTitle</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        <form id='$modalId-form' method='POST' action='backend/redirector.php'>
                            <input type='hidden' name='type' value='$value'>
                            <input type='hidden' name='product_id' value='$productId'>
                            <input type='hidden' name='branch_id' value='$branchId'>

                            <div class='mb-3'>
                                <label for='productName' class='form-label'>Product ID</label>
                                <input type='text' class='form-control' value='$productId' disabled>
                            </div>

                            " .
            (!$editProduct ?
                "<div class='mb-3'>
                                <label for='productName' class='form-label'>Product Name</label>
                                <input type='text' class='form-control' value='$productName' disabled>
                            </div>"
                :
                "<div class='mb-3'>
                                <label for='productName' class='form-label'>Brand Name</label>
                                <input type='text' class='form-control' id='productName' name='productName'
                                    placeholder='Enter product name' value='$productName' required>
                            </div>")
            . "

            " .
            (!$editProduct ?
                "<div class='mb-3'>
                                <label for='productGeneric' class='form-label'>Generic</label>
                                <select class='form-select' disabled>
                                    <option selected>{$genericBrand}</option>';
                                </select>
                            </div>"
                :
                "<div class='mb-3' id='newGenericDiv'>
                                <label for='newGenericName' class='form-label'>Generic Name</label>
                                <input type='text' class='form-control' id='newGenericName' name='newGenericName'
                                    placeholder='Enter new generic name' value='$genericBrand' required>
                            </div>"
            ) . "

            " .
            (!$editProduct ?
                "<div class='mb-3'>
                                <label for='productCategory' class='form-label'>Category</label>
                                <select class='form-select' disabled>
                                    <option selected>{$categoryName}</option>';
                                </select>
                            </div>"
                :
                "<div class='mb-3' id='newCategory'>
                                <label for='newCategoryName' class='form-label'>Category</label>
                                <input type='text' class='form-control' id='newCategoryName' name='newCategoryName'
                                    placeholder='Enter new category name' value='$categoryName' required>
                            </div>"
            ) . "

                            <div class='mb-3'>
                                <label for='assignedBranch' class='form-label'>Assigned Branch</label>
                                <select class='form-select' disabled>
                                    <option selected>{$branchName}</option>';
                                </select>
                            </div>

                            <div class='mb-3'>
                                <label for='productStock' class='form-label'>Old Stock</label>
                                <input type='number' class='form-control' disabled value='$productStock'>
                            </div>

                            " .
            ($isAddProductStock ?
                "
                            <div class='mb-3'>
                                <label for='productStock' class='form-label'>Add Stock</label>
                                <input type='number' class='form-control' id='productStock' name='productStock'
                                    value='0' min='0' placeholder='Enter stock quantity' required>
                            </div>
                            <div class='mb-3'>
                                <label for='expirationDate' class='form-label'>Add Expiration Date</label>
                                <input 
                                    type='date' 
                                    class='form-control' 
                                    id='expirationDate' 
                                    name='expirationDate'
                                    placeholder='Enter expiration date' 
                                    required 
                                    
                                >
                            </div>" : "")
            . "

                            " .
            ($isDiscardProductStock ?
                "
                            <div class='mb-3'>
                                <label for='productStock' class='form-label'>Discard</label>
                                <input type='number' class='form-control' id='productStock' name='productStock'
                                    value='0' placeholder='Enter stock quantity' required>
                            </div>" : "")
            . "

                            <div class='mb-3'>
                                <label for='productUnit' class='form-label'>Unit</label>
                                <select class='form-select' disabled>
                                    <option selected>per $unit</option>
                                </select>
                            </div>
        
                            <div class='mb-3'>
                                <label for='productPrice' class='form-label'>Price</label>
                                <input type='text' class='form-control' disabled value='$price'>
                            </div>

                            " .
            ($isChangePrice || $editProduct ?
                "
                            <div class='mb-3'>
                                <label for='productPrice' class='form-label'>New Price</label>
                                <input type='number' class='form-control' id='productPrice' name='productPrice'
                                    placeholder='Enter price' value='$price' required>
                            </div>" : "")
            . "

                            <div class='mb-3'>
                                <label for='productImage' class='form-label'>Product Image</label>
                                <input class='form-control' disabled value='$productImage'>
                            </div>
                            <div class='mb-3'>
                                <label for='productQRCode' class='form-label'>Product QR Code</label>
                                <input type='text' class='form-control' disabled value='$qrCode'>
                            </div>
                        </form>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>
                        "
            . ($isAddProductStock
                ? "<button type='button' class='btn btn-secondary' 
                        onclick=\"(function() { 
                            var currentModal = bootstrap.Modal.getInstance(document.querySelector('.modal.show'));
                            if (currentModal) {
                                currentModal.hide();
                            }
                            var backdrop = document.querySelector('.modal-backdrop');
                            if (backdrop) {
                                backdrop.remove();
                            }
                            setTimeout(function() {
                                var nextModal = new bootstrap.Modal(document.getElementById('u$modalId'));
                                nextModal.show();
                            }, 100);
                        })()\">Discard Stock</button>"
                : "") . "
                        <button type='submit' class='btn btn-secondary rounded' form='$modalId-form'>UPDATE</button>
                    </div>
                </div>
            </div>
        </div>";
    }

    static function getStockStatus($expirationDate)
    {
        $today = new DateTime();
        $expDate = new DateTime($expirationDate);
        $interval = $today->diff($expDate);

        if ($expDate < $today) {
            return "Expired";
        } elseif ($interval->m < 1) {
            return "Close to Expiring";
        } else {
            return "Good";
        }
    }

    static function getDiscardStockHistory($modalId, $productName, $productId)
    {

        $stockHistory = RequestSQL::getAllProductHistory($productId);
        $modalContent = "<div class='modal fade' id='u$modalId' tabindex='-1' aria-labelledby='stockHistoryModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='stockHistoryModalLabel'>$productName Stock History</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>Quantity</th>
                                <th>Remaining Stock</th>
                                <th>Expiration Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";

        if (count($stockHistory) > 0) {
            foreach ($stockHistory as $history) {
                $modalContent .= "
                    <tr>
                        <td>" . htmlspecialchars($history['quantity']) . "</td>
                        <td>" . htmlspecialchars($history['remainingStock']) . "</td>
                        <td>" . htmlspecialchars($history['expirationDate']) . "</td>
                        <td>" . AdminClass::getStockStatus($history['expirationDate']) . "</td>
                        <td>
                            <form method='POST' action='backend/redirector.php'>
                                <input type='hidden' name='type' value='discard-single'>
                                <input type='hidden' name='productId' value='" . htmlspecialchars($productId) . "'>
                                <input type='hidden' name='remainingStock' value='" . htmlspecialchars($history['remainingStock']) . "'>
                                <input type='hidden' name='historyId' value='" . htmlspecialchars($history['id']) . "'>
                                <button type='submit' class='btn btn-danger'>Discard</button>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            $modalContent .= "
                <tr>
                    <td colspan='5' class='text-center'>No stock history available.</td>
                </tr>";
        }

        $modalContent .= "
                    </tbody>
                </table>
                </div>
                <div class='modal-footer'>
                    <button class='btn btn-secondary rounded' type='button'
                        onclick=\"(function() { 
                            var currentModal = bootstrap.Modal.getInstance(document.getElementById('u$modalId'));
                            if (currentModal) {
                                currentModal.hide();
                            }
                            var backdrop = document.querySelector('.modal-backdrop');
                            if (backdrop) {
                                backdrop.remove();
                            }
                            setTimeout(function() {
                                var nextModal = new bootstrap.Modal(document.getElementById('$modalId'));
                                nextModal.show();
                            }, 100);
                        })()\">Add Stock</button>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                </div>
            </div>
        </div>
    </div>";

        return $modalContent;
    }


    static function getProductStocksView($modalId, $productName, $productId, $productStock)
    {
        $stockHistory = RequestSQL::getAllProductHistory($productId);
        $modalContent = "<div class='modal fade' id='$modalId' tabindex='-1' aria-labelledby='stockHistoryModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='stockHistoryModalLabel'>$productName Stocks</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <div class='mb-3'>
                        <label for='productStock' class='form-label'>All Stock</label>
                        <input type='number' class='form-control' disabled value='$productStock'>
                    </div>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>Quantity</th>
                                <th>Remaining Stock</th>
                                <th>Expiration Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>";

        if (count($stockHistory) > 0) {
            foreach ($stockHistory as $history) {
                $modalContent .= "
                    <tr>
                        <td>" . htmlspecialchars($history['quantity']) . "</td>
                        <td>" . htmlspecialchars($history['remainingStock']) . "</td>
                        <td>" . htmlspecialchars($history['expirationDate']) . "</td>
                        <td>" . AdminClass::getStockStatus($history['expirationDate']) . "</td>
                        <td>
                            <form method='POST' action='backend/redirector.php'>
                                <input type='hidden' name='type' value='discard-single'>
                                <input type='hidden' name='productId' value='" . htmlspecialchars($productId) . "'>
                                <input type='hidden' name='remainingStock' value='" . htmlspecialchars($history['remainingStock']) . "'>
                                <input type='hidden' name='historyId' value='" . htmlspecialchars($history['id']) . "'>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            $modalContent .= "
                <tr>
                    <td colspan='5' class='text-center'>No stock history available.</td>
                </tr>";
        }

        $modalContent .= "
                    </tbody>
                </table>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                </div>
            </div>
        </div>
    </div>";

        return $modalContent;
    }

    static function loadAllAccounts($accounts)
    {
        echo "<table class='table table-sm table-hover'>";
        if ($accounts->num_rows != 0) {
            while ($account = $accounts->fetch_assoc()) {
                $status = strtolower($account['userStatus']);

                $isRemoved = $status === 'removed' || $account['isAdmin'] == "1";
                $isActive = $status === 'active';
                $isDisabled = $status === 'disabled';

                $isAdmin = $account['isAdmin'] == "1" ? "ADMIN" : "CLIENT";
                $isStatus = $account['isAdmin'] == "1" ? "badge bg-success" : "badge bg-secondary";

                $modalId = "change-pass-" . $account["id"];
                echo
                    "<tr>
                        <td class='align-content-center ps-4'>
                            <small><span class='text-muted'>Account ID</span></small><br>
                            <small><span class='badge text-bg-secondary'>{$account['id']}</span></small>
                        </td>

                        <td class='align-content-center ps-4'>
                            <small><span class='text-muted'>Full Name</span></small><br>
                            <small><span>{$account['firstName']} {$account['lastName']}</span></small>
                        </td>

                        <td class='align-content-center ps-4'>
                            <small><span class='text-muted'>Email</span></small><br>
                            <small><span>{$account['email']}</span></small>
                        </td>

                        <td class='align-content-center ps-4'>
                            <small><span class='text-muted'>Assigned Branch</span></small><br>
                            <small><span>{$account['branchName']}</span></small>
                        </td>

                        <td class='align-content-center ps-4'>
                            <small><span class='text-muted'>STATUS</span></small><br>
                            <small><span class='{$isStatus}'>{$isAdmin}</span></small>
                        </td>

                        <td class='align-content-center ms-auto d-flex p-3'>
                            <button class='btn btn-secondary p-1 me-3' type='submit' id='change-pass' data-bs-toggle='modal' data-bs-target='#$modalId'>
                                <small><span>Forgot Password</span></small>
                            </button>

                            <div class='modal fade' id='$modalId' tabindex='-1' aria-labelledby='$modalId-label' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-top'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='$modalId-label'>{$account['userName']} Forgot Password</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <form id='$modalId-form' method='POST' action='backend/redirector.php'>
                                                <input type='hidden' name='type' value='change-password'>
                                                <input type='hidden' name='id' value='{$account['id']}'>
                                                
                                                <div class='mb-3'>
                                                    <label for='newPassword' class='form-label'>New Password</label>
                                                    <input type='password' class='form-control' id='newPassword' name='newPassword' required>
                                                </div>
                                                <div class='mb-3'>
                                                    <label for='confirmPassword' class='form-label'>Confirm New Password</label>
                                                    <input type='password' class='form-control' id='confirmPassword' name='confirmPassword' required>
                                                </div>
                                            </form>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Cancel</button>
                                            <button type='submit' form='$modalId-form' class='btn btn-secondary'>Update Password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form action='backend/redirector.php' method='POST' onsubmit='return confirmDeactivate()'>
                                <input type='hidden' name='user_id' value='{$account['id']}'>
                                <input type='hidden' name='userStatus' value='disabled'>
                                <input type='hidden' name='type' value='admin-set-user-status'>
                                <button class='btn btn-danger p-1 me-3' type='submit' id='deactivate-btn' 
                                    " . ($isDisabled || $isRemoved ? "disabled" : "") . ">
                                    <small><i class='bi bi-trash-fill me-2'></i><span>Deactivate</span></small>
                                </button>
                            </form>

                            <form action='backend/redirector.php' method='POST' onsubmit='return confirmActivate()'>
                                <input type='hidden' name='user_id' value='{$account['id']}'>
                                <input type='hidden' name='userStatus' value='active'>
                                <input type='hidden' name='type' value='admin-set-user-status'>

                                <button class='btn btn-success p-1 me-3' type='submit' id='activate-btn' 
                                        " . ($isActive || $isRemoved ? "disabled" : "") . ">
                                    <small><i class='bi bi-check-circle-fill me-2'></i><span>Activate</span></small>
                                </button>
                            </form>

                            <form action='backend/redirector.php' method='POST' onsubmit='return confirmRemoval()'>
                                <input type='hidden' name='user_id' value='{$account['id']}'>
                                <input type='hidden' name='userStatus' value='removed'>
                                <input type='hidden' name='type' value='admin-set-user-status'>

                                <button class='btn btn-secondary p-1' type='submit' id='removed-btn' 
                                    " . ($isRemoved ? 'disabled' : '') . ">
                                    <small><i class='bi bi-x-circle-fill me-2'></i><span>Removed</span></small>
                                </button>
                            </form>
                        </td>


                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>No accounts found</td></tr>";
        }
        echo "</table>";
    }

    static function loadAllStockHistory($histories)
    {
        echo "<table class='table table-sm table-hover'>";
        if ($histories->num_rows != 0) {
            while ($history = $histories->fetch_assoc()) {
                echo
                    "<tr>
                        <td class='align-content-center ps-4'>
                            <small><span class='text-muted'>Stock ID</span></small><br>
                            <small><span class='badge text-bg-secondary'>{$history['id']}</span></small>
                        </td>

                        <td class='align-content-center ps-4'>
                            <small><span class='text-muted'>Branch Name</span></small><br>
                            <small><span>{$history['branchName']}</span></small>
                        </td>

                        <td class='align-content-center ps-4'>
                            <small><span class='text-muted'>Product Name</span></small><br>
                            <small><span>{$history['productName']}</span></small>
                        </td>

                        <td class='align-content-center ps-4'>
                            <small><span class='text-muted'>Stock Quantity</span></small><br>
                            <small><span>{$history['quantity']}</span></small>
                        </td>

                        <td class='align-content-center ps-4'>
                            <small><span class='text-muted'>Stock Quantity</span></small><br>
                            <small><span>{$history['firstName']} {$history['lastName']}</span></small>
                        </td>

                        <td class='align-content-center ps-4'>
                            <small><span class='text-muted'>Created At</span></small><br>
                            <small><span>{$history['createdAt']}</span></small>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>No stock history found</td></tr>";
        }
        echo "</table>";
    }

    static function loadAllLatestTransaction($transactions)
    {
        echo "<table class='table table-sm table-hover'>";
        if ($transactions->num_rows != 0) {
            foreach ($transactions as $row) {
                $modalId = 'details-modal-' . $row['id'];

                $products = RequestSQL::getAllProductIDS($row['product_ordered_list']);
                $all_products = '';

                foreach ($products as $product) {
                    $all_products .= "
                    <span class='d-flex justify-content-between'>
                        <span class='text-muted'>" . $product['numberProduct'] . "x " . htmlspecialchars($product['productName']) . "</span>
                        <span class='text-muted fw-bold'>" . number_format($product['productPrice'] * $product['numberProduct'], 2) . "</span>
                    </span>";
                }
                echo "
                <tr>
                    <td class='align-content-center ps-4'>
                        <small><span class='text-muted'>Transaction ID</span></small><br>
                        <small><span class='fw-bold'>{$row['id']}</span></small>
                    </td>
                    <td class='align-content-center'>
                        <small><span class='text-muted'>Amount</span></small><br>
                        <small><span class='fw-bold'>₱&nbsp;{$row['total_amount']}</span></small>
                    </td>
                    <td class='align-content-center'>
                        <small>{$row['transaction_date']}</small>
                    </td>
                    <td class='align-content-center'>
                        <a class='link-offset-2 link-underline link-underline-opacity-0 d-flex' href='#' id='details-modal' data-bs-toggle='modal' data-bs-target='#$modalId'>
                            <small><i class='bi bi-three-dots fs-4 text-secondary'></i></small>
                        </a>

                        <!-- Details Modal -----> 
                        <div class='modal fade shadow border-0' id='$modalId' tabindex='-1' aria-labelledby='{$modalId}-label' aria-hidden='true'>
                            <div class='modal-dialog'>

                                <div class='modal-content'>
                                    <!------- Modal Header ----------> 
                                    <div class='modal-header border-0'>
                                        <h1 class='modal-title fs-5' id='{$modalId}-label'></h1>
                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                    </div>

                                    <!------- Modal Body ----------> 
                                    <div class='modal-body px-5'>
                                        <span class='text-muted fw-bold'>Transaction Details</span><br>
                                        <span class='text-muted'>Timestamp: {$row['transaction_date']}</span><br>
                                        <span class='text-muted'>Account: {$row['staff_acc']}</span><br><br>
                                        
                                        <div class='d-flex justify-content-between'>
                                            <span class='text-muted fw-bold'>Product</span>
                                            <span class='text-muted fw-bolder'>Amount</span>
                                        </div>
                                        $all_products

                                        <div class='justify-content-center'>
                                            <small>
                                                <span class='text-muted'>
                                                - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                                                </span>
                                            </small>
                                        </div>
                                        
                                        <div class='d-flex justify-content-between'>
                                            <small><span class='text-muted'>Total Amount Payable    :</span></small>
                                            <span class='text-muted fw-bolder text-end'>₱ {$row['total_amount']}</span></small>
                                        </div> 
                                        
                                        <div class='justify-content-center'>
                                            <small>
                                                <span class='text-muted'>
                                                - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
                                                </span>
                                            </small>
                                        </div> 
                                        <div class='d-flex justify-content-between'>
                                            <small><span class='text-muted'>Cash received:</span></small>
                                            <span class='text-muted text-end'>₱ {$row['cash_received']}</span></small>
                                        </div> 
                                        <div class='d-flex justify-content-between mb-3'>
                                            <small><span class='text-muted'>Change :</span></small>
                                            <span class='text-muted fw-bolder text-end'>₱ {$row['cash_change']}</span></small>
                                        </div> 
                                    </div>      
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>No transaction found</td></tr>";
        }
        echo "</table>";
    }


    static function loadAllStock($products)
    {
        echo "<table class='table table-sm table-hover'>";
        echo '  <tr >
                    <th class="ps-4">
                        <small><span class="fw-bold">Branch Name</span></small>
                    </th>
                    <th>
                        <small><span class="fw-bold">Brand Name</span></small>
                    </th>
                    <th class="ps-4">
                        <small><span class="fw-bold">Generic Name</span></small>
                    </th>
                    <th class="ps-4">
                        <small><span class="fw-bold">Category</span></small>
                    </th>
                    
                    <th class="ps-4">
                        <small><span class="fw-bold">Unit</span></small>
                    </th>
                    <th>
                        <small><span class="fw-bold">Stock</span></small>
                    </th>
                    <th>
                        <small><span class="fw-bold">Status</span></small>
                    </th>
                    <th>
                        <small><span class="fw-bold">Price</span></small>
                    </th>
                    <th colspan=2>
                        <small><span class="fw-bold">Action</span></small>
                    </th>
                </tr>';

        $productArray = [];
        if ($products->num_rows != 0) {
            while ($product = $products->fetch_assoc()) {
                $stockStatus = '';
                $statusClass = '';

                if ($product['productStock'] == 0) {
                    $stockStatus = 'Out of Stock';
                    $statusClass = 'badge bg-secondary';
                } elseif ($product['productStock'] <= 10) {
                    $stockStatus = 'Critical';
                    $statusClass = 'badge bg-danger';
                } else {
                    $stockStatus = 'Good';
                    $statusClass = 'badge bg-success';
                }


                $isArchived = $product['isArchived'] == "0" ? 'Archived' : 'Unarchived';
                $modalId = 'change-modal-' . $product['id'];
                $stockModalId = 'stock-modal-' . $product['id'];
                $discardStockModalId = 'discard-stock-modal-' . $product['id'];
                $editStockModalID = 'edit-stock-modal-' . $product['id'];

                $product["status"] = $stockStatus;
                $product["archive"] = $isArchived;
                $productArray[] = $product;

                echo
                    "<tr>
                        <td class='align-content-center ps-4'>
                            <small><span>{$product['branchName']}</span></small>
                        </td>
                        <td class='align-content-center'>
                            <span>{$product['productName']}</span>
                        </td>
                        <td class='align-content-center ps-4'>
                            <span>{$product['genericBrand']}</span>
                        </td>
                        <td class='align-content-center ps-4'>
                            <small><span class='badge text-bg-secondary'>{$product['productCategory']}</span></small>
                        </td>
                        <td class='align-content-center ps-4'>
                            <small><span class='badge text-bg-secondary'>{$product['productUnit']}</span></small>
                        </td>
                        <td class='align-content-center'>
                            <small><span class='fw-bold'>x{$product['productStock']}</span></small>
                        </td>
                        <td class='align-content-center'>
                            <small><span class='{$statusClass}'>{$stockStatus}</span></small>
                        </td>
                        <td class='align-content-center'>
                            <small><span class='fw-bold'>₱ {$product['productPrice']}</span></small>
                        </td>

                        <td class='align-content-center d-flex'>
                            <form method='post' action='backend/redirector.php' onsubmit='return confirmArchive(\"{$isArchived}\")'>
                                <input type='hidden' name='type' value='archive-product'>
                                <input type='hidden' name='id' value='{$product['id']}'>
                                <input type='hidden' name='is_archived' value='{$isArchived}'>
                                <button class='btn custom-remove-btn p-1 me-2' type='submit'>
                                    <small><i class='bi bi-trash-fill me-2'></i></i><span>{$isArchived}</span></small>
                                </button>
                            </form>
                            <!--
                            <button class='btn btn-secondary p-1 me-2' type='button' data-bs-toggle='modal' data-bs-target='#$modalId'>
                                <small>Change Price</small>
                            </button>


                            " . AdminClass::getStringModal(
                            $modalId,
                            "Change {$product['productName']} Price",
                            "admin-change-price",
                            "{$product['id']}",
                            "{$product['branch_id']}",
                            "{$product['productName']}",
                            "{$product['genericBrand']}",
                            "{$product['productCategory']}",
                            "{$product['branchName']}",
                            "{$product['productStock']}",
                            "{$product['productUnit']}",
                            "{$product['productPrice']}",
                            "{$product['productImage']}",
                            "{$product['barCode']}",
                            false,
                            false,
                            true
                        ) . "
                        -->

                        <button class='btn btn-secondary p-1 me-2 ps-2 pe-2' type='button' data-bs-toggle='modal' data-bs-target='#$editStockModalID'>
                                <small>Details</small>
                            </button>

                            " . AdminClass::getStringModal(
                            $editStockModalID,
                            "Edit {$product['productName']} Stock",
                            "edit-stock-details",
                            "{$product['id']}",
                            "{$product['branch_id']}",
                            "{$product['productName']}",
                            "{$product['genericBrand']}",
                            "{$product['productCategory']}",
                            "{$product['branchName']}",
                            "{$product['productStock']}",
                            "{$product['productUnit']}",
                            "{$product['productPrice']}",
                            "{$product['productImage']}",
                            "{$product['barCode']}",
                            false,
                            false,
                            false,
                            true
                        ) . "
                        
                            <button class='btn btn-success p-1 ps-2 pe-2' type='button' data-bs-toggle='modal' data-bs-target='#$stockModalId'>
                                <small>Stock</small>
                            </button>

                            "
                    .
                    AdminClass::getProductStocksView($stockModalId, $product['productName'], $product['id'], $product['productStock'])
                    .
                    "
                    <!--
                            " . AdminClass::getStringModal(
                            $stockModalId,
                            "Edit {$product['productName']} Stock",
                            "add-stock",
                            "{$product['id']}",
                            "{$product['branch_id']}",
                            "{$product['productName']}",
                            "{$product['genericBrand']}",
                            "{$product['productCategory']}",
                            "{$product['branchName']}",
                            "{$product['productStock']}",
                            "{$product['productUnit']}",
                            "{$product['productPrice']}",
                            "{$product['productImage']}",
                            "{$product['barCode']}",
                            true
                        ) . "
                        <button class='btn btn-danger p-1' type='button' data-bs-toggle='modal' data-bs-target='#$discardStockModalId'>
                                <small>Discard Stock</small>
                            </button>
                            "
                    .
                    AdminClass::getDiscardStockHistory($discardStockModalId, $product['productName'], $product['id'])
                    .
                    "
                    -->
                        </td>

                    </tr>";
            }
        } else {
            echo "<tr><td colspan='9' class='text-center'>No products found</td></tr>";
        }
        echo "</table>";
        return $productArray;
    }
}



class BranchClass
{
    static function loadBranchDesign($branch)
    {
        echo "
            <button type='button' class='btn border-0 float-end' data-bs-toggle='modal' data-bs-target='#branch-modal-{$branch['id']}'>
                <i class='bi bi-map-fill fs-2 text-white'></i>
            </button>

            <!-- Modal -->
            <div class='modal fade' id='branch-modal-{$branch['id']}' tabindex='-1' aria-labelledby='branch-modal-label-{$branch['id']}' aria-hidden='true'>
                <div class='modal-dialog modal-lg modal-dialog-centered'>
                    <div class='modal-content'>

                        <div class='modal-header border-0'>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
    
                        <!-- Google Map Embed -->
                        <iframe
                            src='{$branch['pb']}'
                            width='100%' height='450' style='border:0;' allowfullscreen='' loading='lazy'
                            referrerpolicy='no-referrer-when-downgrade'>
                        </iframe>

                        <div class='modal-body border-0 p-4'>

                            <!-- Details -->
                            <h3 class='fs-5 fw-bolder border-bottom border-1 border-success py-3'>Lyza Drugmart {$branch['branch_name']}</h3>
                            <div class='py-3'>
                                <p><i class='bi bi-compass text-success me-3 py-2 fs-5'></i>{$branch['coordinates']}</p>
                                <p><i class='bi bi-signpost-split text-success me-3 py-2 fs-5'></i>{$branch['addressLine']}</p>
                                <p><i class='bi bi-geo-alt text-success me-3 py-2 fs-5'></i>{$branch['city']}, {$branch['province']}</p>
                                <p><i class='bi bi-clock-history text-success me-3 py-2 fs-5'></i>{$branch['operatingHours']}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
    }
    static function loadAllPosProduct($products)
    {
        echo "<table class='table table-sm table-hover'>";
        if ($products->num_rows != 0) {
            while ($product = $products->fetch_assoc()) {
                if ($product['isArchived'] || $product['productStock'] <= 0)
                    continue;

                echo "<tr>";
                echo "<td class='align-content-center ps-4'>";
                echo "<small><span class='badge text-bg-secondary'>" . htmlspecialchars($product['productCategory']) . "</span></small><br>";
                echo "<span class='fw-bold'>" . htmlspecialchars($product['productName']) . "</span>";
                echo "</td>";
                echo "<td class='align-content-center'>";
                echo "<small><span class='badge text-bg-secondary'>Generic</span></small><br>";
                echo "<small><span>" . htmlspecialchars($product['genericBrand']) . "</span></small>";
                echo "</td>";
                echo "<td class='align-content-center'>";
                echo "<small><span>x" . htmlspecialchars($product['productStock']) . " in stock</span></small>";
                echo "</td>";
                echo "<td class='align-content-center'>";
                echo "<small><span>₱ " . htmlspecialchars($product['productPrice']) . "</span></small>";
                echo "</td>";
                echo "<td class='align-content-center'>";
                echo "<form method='post' action='backend/redirector.php'>";
                echo "<input type='hidden' name='type' value='branch-add-cart'>";
                echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($product['id']) . "'>";
                echo "<input type='hidden' name='branch_id' value='" . htmlspecialchars($product['branchId']) . "'>";
                echo "<input type='hidden' name='product_barcode' value='" . htmlspecialchars($product['barCode']) . "'>";
                echo "<input type='hidden' name='product_name' value='" . htmlspecialchars($product['productName']) . "'>";
                echo "<input type='hidden' name='product_price' value='" . htmlspecialchars($product['productPrice']) . "'>";
                echo "<input type='hidden' name='product_stock' value='" . htmlspecialchars($product['productStock']) . "'>";
                echo "<button class='btn btn-secondary' type='submit'><small>Add</small></button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>No products found</td></tr>";
        }
        echo "</table>";
    }


    static function loadAllTransaction($transactions)
    {
        $transactionArray = [];
        echo "<table class='table table-sm table-hover'>";
        if ($transactions->num_rows != 0) {
            foreach ($transactions as $row) {
                $transactionArray[] = $row;

                $modalId = 'details-modal-' . $row['id'];
                $products = RequestSQL::getAllProductIDS($row['product_ordered_list']);

                $createdAt = new DateTime($row['createdAt']);
                $currentDate = new DateTime();
                $interval = $currentDate->diff($createdAt);

                $all_products = '';
                foreach ($products as $product) {
                    $all_products .= "<tr>";
                    $all_products .= "<td class='align-content-center ps-4'><span>" . htmlspecialchars($product['branchName']) . "</span></td>";
                    $all_products .= "<td class='align-content-center'><small><span>" . htmlspecialchars($product['productName']) . "</span></small></td>";
                    $all_products .= "<td class='align-content-center'><small><span>" . htmlspecialchars($product['numberProduct']) . "</span></small></td>";
                    $all_products .= "<td class='align-content-center'><small><span>₱" . htmlspecialchars($product['productPrice']) . "</span></small></td>";
                    $all_products .= "<td class='align-content-center'><small><span>₱" . htmlspecialchars($product['productPrice'] * $product['numberProduct']) . "</span></small></td>";
                    $all_products .= "</tr>";
                }
                $overall_subtotal = 0;
                $overall_discount = 0;
                $all_print_products = '';
                foreach ($products as $index => $product) {
                    $is_first = $index == 0 ? "first-child" : "";
                    $overall_subtotal += $product['productPrice'] * $product['numberProduct'];
                    $all_print_products .= "<tr>";
                    $all_print_products .= "<td class='$is_first text-start'><small><span style='font-size: 1.2em;'>" . htmlspecialchars($product['numberProduct']) . "</span></small></td>";
                    $all_print_products .= "<td class='$is_first text-start'><small><span style='font-size: 1.2em;'>" . htmlspecialchars($product['productName']) . "</span></small></td>";
                    $all_print_products .= "<td class='$is_first text-end price'><small><span style='font-size: 1.2em;'>₱" . htmlspecialchars(number_format($product['productPrice'] * $product['numberProduct'], 2)) . "</span></small></td>";
                    $all_print_products .= "</tr>";
                }

                $discount_type = "";
                if ($row['seniorDiscount'] && $row['pwdDiscount']) {
                    $discount_type = "Senior & PWD Discount";
                    $overall_discount = $overall_subtotal * 0.2;
                } elseif ($row['seniorDiscount']) {
                    $discount_type = "Senior Citizen Discount";
                    $overall_discount = $overall_subtotal * 0.2;
                } elseif ($row['pwdDiscount']) {
                    $discount_type = "PWD Discount";
                    $overall_discount = $overall_subtotal * 0.2;
                } else
                    $discount_type = "NONE";

                $all_transaction = '';
                foreach ($products as $index => $product) {
                    $max_product = ($product['productStock'] + $product['numberProduct']);
                    $all_transaction .= "
                    <tr>
                        <td>{$product['productId']}</td>
                        <td>{$product['productName']}</td>

                        <td>
                            <input type='hidden' class='form-control' name='itemId[]' value='{$product['id']}'>
                            <input type='hidden' class='form-control' name='productIds[]' value='{$product['productId']}'>
                            <input type='number' class='form-control' name='itemQuantity[]' value='{$product['numberProduct']}' min='1' max='$max_product' required>
                        </td>
                        <td>₱ {$product['productPrice']}</td>
                    </tr>";
                }
                echo "
            <tr>
                <td class='align-content-center ps-4'>
                    <small><span class='text-muted'>Transaction ID</span></small><br>
                    <small><span class='fw-bold'>{$row['id']}</span></small>
                </td>
                <td class='align-content-center'>
                    <small><span class='text-muted'>Total</span></small><br>
                    <small><span class='fw-bold'>₱&nbsp;{$row['total_amount']}</span></small>
                </td>
                <td class='align-content-center'>
                    <small><span class='text-muted'>Cash</span></small><br>
                    <small><span class='text-muted'><strong>₱&nbsp;{$row['cash_received']}</strong></span></small>
                </td>
                <td class='align-content-center'>
                    <small><span class='text-muted'>Change</span></small><br>
                    <small><span class='text-muted'>₱&nbsp;{$row['cash_change']}</span></small>
                </td>
                <td class='align-content-center'>
                    <small><span class='text-muted'>Discount Type</span></small><br>
                    <small><span class='text-muted'>{$discount_type}</span></small>
                </td>
                <td class='align-content-center'>
                    <small><span class='text-muted'>Transaction Date</span></small><br>
                    <small>{$row['transaction_date']}</small>
                </td>
                <td class='align-content-center'>
                    <small><span class='text-muted'>Staff</span></small><br>
                    <span class='text-muted'>{$row['staff_acc']}</span>
                </td>
                <td class='align-content-center'>
                    <input type='hidden' id='product_ordered_list' value='" . htmlspecialchars($row['product_ordered_list']) . "'>
                    " .

                    ($interval->days <= 1 ?
                        "
                        <button class='btn btn-secondary' type='button' data-bs-toggle='modal' data-bs-target='#edit-$modalId'>
                            <small>Edit</small>
                        </button>
                        " : ""
                    )
                    . "
                    <button class='btn btn-secondary' type='button' data-bs-toggle='modal' data-bs-target='#$modalId'>
                        <small>Details</small>
                    </button>

                    <div class='modal fade' id='edit-$modalId' tabindex='-1' aria-labelledby='edit-$modalId-label' aria-hidden='true'>
                        <div class='modal-dialog modal-lg'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='edit-$modalId-label'>Edit Transaction ID: {$row['id']}</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <div class='modal-body'>
                                    <form id='edit-$modalId-form' method='POST' action='backend/redirector.php'>
                                        <input type='hidden' name='type' value='update-transaction'>
                                        <input type='hidden' name='transactionId' value='{$row['id']}'>

                                        <div class='mb-3'>
                                            <label for='cashReceived' class='form-label'>Cash Received</label>
                                            <input type='text' class='form-control' id='cashReceived' name='cashReceived' value='{$row['cash_received']}' required>
                                        </div>

                                        <div class='mb-3'>
                                            <label for='items' class='form-label'>Items in Transaction</label>
                                            <table class='table table-sm table-hover'>
                                                <thead>
                                                    <tr>
                                                        <th>Product ID</th>
                                                        <th>Product Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    $all_transaction
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class='ms-3 form-check'>
                                            <input class='form-check-input' type='radio' id='seniorDiscount' name='discount' value='senior'
                                                " . ($row['seniorDiscount'] ? 'checked' : '') . ">
                                            <label class='form-check-label' for='seniorDiscount'>
                                                Senior Citizen Discount
                                            </label>
                                        </div>
                                        <div class='ms-3 form-check'>
                                            <input class='form-check-input' type='radio' id='pwdDiscount' name='discount' value='pwd'
                                                " . ($row['pwdDiscount'] ? 'checked' : '') . ">
                                            <label class='form-check-label' for='pwdDiscount'>
                                                Person with Disability Discount
                                            </label>
                                        </div>
                                        <div class='ms-3 form-check'>
                                            <input class='form-check-input' type='radio' id='seniorAndPwdDiscount' name='discount' value='seniorAndPwd'
                                                " . (($row['seniorDiscount'] && $row['pwdDiscount']) ? 'checked' : '') . ">
                                            <label class='form-check-label' for='seniorAndPwdDiscount'>
                                                Senior & PWD Discount
                                            </label>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>Close</button>
                                    <button type='submit' class='btn btn-secondary' form='edit-$modalId-form'>Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='modal fade' id='$modalId' tabindex='-1' aria-labelledby='{$modalId}-label' aria-hidden='true'>
                        <div class='modal-dialog modal-lg'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title fw-bold border-start border-3 border-success px-4 mb-3 me-5 align-content-center'
                                        id='productDetailsModalLabel'>
                                        <b>Transaction Details</b>
                                    </h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                
                                <div class='card card shadow p-2 bg-body-tertiary rounded border-1'>
                                    <div class='modal-body'>
                                        <table class='table table-sm table-hover' id='productDetailsTable'>
                                            <thead>
                                                <tr>
                                                    <th class='ps-4'><small><span class='fw-bold'>Branch Name</span></small></th>
                                                    <th class=''><small><span class='fw-bold'>Product Name</span></small></th>
                                                    <th class=''><small><span class='fw-bold'>Quantity</span></small></th>
                                                    <th class=''><small><span class='fw-bold'>Price</span></small></th>
                                                    <th class=''><small><span class='fw-bold'>Total Price</span></small></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                $all_products
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class='modal fade' id='print-$modalId' tabindex='-1' aria-labelledby='print-{$modalId}-label' aria-hidden='true'>
                        <div class='modal-dialog modal-lg'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title fw-bold border-start border-3 border-success px-4 mb-3 me-5 align-content-center'
                                        id='productDetailsModalLabel'>
                                        <b>Transaction Details</b>
                                    </h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                
                                <div class='card card shadow p-2 bg-body-tertiary rounded border-1'>
                                    <div class='modal-body'>
                                        <table class='table table-sm table-hover' id='productDetailsTable'>
                                            <thead>
                                                <tr>
                                                    <th class='text-start' style='font-size: 1.2em;'>Qty</th>
                                                    <th class='text-start' style='font-size: 1.2em;'>Item</th>
                                                    <th class='text-right price' style='font-size: 1.2em;'>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                $all_print_products
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </td>
                <td class='align-content-center pe-4'>
                    <a class='link-offset-2 link-underline link-underline-opacity-0 d-flex' 
                        href='#' 
                        onclick=\"printReceipt('print-{$modalId}', '{$row['id']}',$overall_subtotal, $overall_discount, '{$row['total_amount']}', '{$row['cash_received']}', '{$row['cash_change']}',
                            '{$row['staff_acc']}', '{$row['branchName']}')\">
                        <small><i class='bi bi-printer-fill fw-bolder fs-4 text-secondary'></i></small>
                    </a>
                </td>
            </tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>No transaction found</td></tr>";
        }
        echo "</table>";
        return $transactionArray;
    }


    static function loadAllStock($products)
    {
        echo "<table class='table table-sm table-hover'>";
        echo '  <tr >
                    <th class="ps-4">
                        <small><span class="fw-bold">Branch Name</span></small>
                    </th>
                    <th >
                        <small><span class="fw-bold">Brand Name</span></small>
                    </th>
                    <th>
                        <small><span class="fw-bold">Generic Name</span></small>
                    </th>
                    <th class="ps-4">
                        <small><span class="fw-bold">Category</span></small>
                    </th>
                    <th class="ps-4">
                        <small><span class="fw-bold">Unit</span></small>
                    </th>
                    <th>
                        <small><span class="fw-bold">Stock</span></small>
                    </th>
                    <th>
                        <small><span class="fw-bold">Status</span></small>
                    </th>
                    <th>
                        <small><span class="fw-bold">Price</span></small>
                    </th>
                    <th>
                        <small><span class="fw-bold">Action</span></small>
                    </th>
                </tr>';

        $productArray = [];
        if ($products->num_rows != 0) {
            while ($product = $products->fetch_assoc()) {
                $stockStatus = '';
                $statusClass = '';

                if ($product['productStock'] == 0) {
                    $stockStatus = 'Out of Stock';
                    $statusClass = 'badge bg-secondary';
                } elseif ($product['productStock'] <= 10) {
                    $stockStatus = 'Critical';
                    $statusClass = 'badge bg-danger';
                } else {
                    $stockStatus = 'Good';
                    $statusClass = 'badge bg-success';
                }
                $product["status"] = $stockStatus;
                $productArray[] = $product;

                $isArchived = $product['productPrice'] ? 'Archived' : 'Unarchived';
                $modalId = 'details-modal-' . $product['id'];
                echo
                    "<tr>
                        <td class='align-content-center ps-4'>
                            <span>{$product['branchName']}</span>
                        </td>
                        <td class='align-content-center'>
                            <span>{$product['productName']}</span>
                        </td>
                        <td class='align-content-center'>
                            <span>{$product['genericBrand']}</span>
                        </td>
                        <td class='align-content-center ps-4'>
                            <small><span class='badge text-bg-secondary'>{$product['productCategory']}</span></small>
                        </td>
                        <td class='align-content-center ps-4'>
                            <small><span class='badge text-bg-secondary'>{$product['productUnit']}</span></small>
                        </td>
                        
                        <td class='align-content-center'>
                            <small><span class='fw-bold'>x{$product['productStock']}</span></small>
                        </td>
                        <td class='align-content-center'>
                            <small><span class='{$statusClass}'>{$stockStatus}</span></small>
                        </td>
                        <td class='align-content-center'>
                            <small><span class='fw-bold'>₱ {$product['productPrice']}</span></small>
                        </td>
                        <td class='align-content-center'>
                            <button class='btn btn-sm btn-secondary rounded' type='button' data-bs-toggle='modal'
                                data-bs-target='#$modalId'>Stock</button>

                            " . AdminClass::getStringModal(
                            $modalId,
                            "Add {$product['productName']} Stock",
                            "add-stock",
                            "{$product['id']}",
                            "{$product['branch_id']}",
                            "{$product['productName']}",
                            "{$product['genericBrand']}",
                            "{$product['productCategory']}",
                            "{$product['branchName']}",
                            "{$product['productStock']}",
                            "{$product['productUnit']}",
                            "{$product['productPrice']}",
                            "{$product['productImage']}",
                            "{$product['barCode']}",
                            true
                        ) . "
                        <!--
                            <button class='btn btn-sm btn-danger rounded' type='button' data-bs-toggle='modal'
                                data-bs-target='#u$modalId'>Discard</button>
                                -->

                            " .
                    AdminClass::getDiscardStockHistory("$modalId", $product['productName'], $product['id'])
                    . "
                        </td>

                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>No products found</td></tr>";
        }
        echo "</table>";
        return $productArray;
    }


    static function loadPaginator($currentPage, $totalPages, $name)
    {
        echo '<nav class="d-flex justify-content-between">';
        echo '<ul class="pagination custom-pagination">';
        if ($currentPage > 1) {
            echo "
                <li class='page-item'>
                    <a class='page-link' href='#' data-page='" . ($currentPage - 1) . "'>
                        <i class='bi bi-arrow-left'></i>
                    </a>
                </li>";
        } else {
            echo
                "<li class='page-item disabled'>
                    <a class='page-link' href='#'>
                        <i class='bi bi-arrow-left'></i>
                    </a>
                </li>";
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($i == $currentPage) ? 'active' : '';
            echo
                "<form action='backend/redirector.php' method='POST'>
                    <li class='page-item $activeClass'>
                        <input type='hidden' name='page' value='{$i}'>
                        <input type='hidden' name='type' value='$name'>
                        <button class='page-link' type='submit'>$i</button>
                    </li>
                </form>";
        }
        if ($currentPage < $totalPages) {
            echo
                "<li class='page-item'>
                    <a class='page-link' href='#' data-page='" . ($currentPage + 1) . "'>
                        <i class='bi bi-arrow-right'></i>
                    </a>
                </li>";
        } else {
            echo
                "<li class='page-item disabled'>
                    <a class='page-link' href='#'>
                        <i class='bi bi-arrow-right'></i>
                    </a>
                </li>";
        }
        echo '</ul>';
        // echo "<button class='btn btn-secondary' type='submit'><small>SUBMIT</small></button>";
        echo '</nav>';
    }
}


?>