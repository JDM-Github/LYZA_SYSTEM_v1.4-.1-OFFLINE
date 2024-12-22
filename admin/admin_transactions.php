<div class="content ms-3" style="width: 100%" id="transactions">

    <!-- Search / Category Navigation -->
    <div class="card shadow p-1 bg-body-tertiary rounded border-0 mb-3">
        <div class="d-flex justify-content-between">
            <p class="fw-bold border-start border-3 border-success px-4 m-3 mb-3">
                Transaction Report
            </p>

            <form action="" class="border-0 d-flex m-1" method="post" id="transaction-form">
                <style>
                    .border-dark-green {
                        background: #56AB91;
                    }

                    .border-dark-green:hover {
                        background: #369B71;
                    }
                </style>
                <button id="printChartButton" class="btn custom-btn-success ms-3 border-dark-green" type="button"
                    onclick="printStockHistory()">Download History</button>
            </form>

        </div>
    </div>

    <!-- Product Grid -->
    <div class="card card shadow p-3 bg-body-tertiary rounded border-0">
        <div class="input-group input-group-sm border-0 align-content-center">
            <p class=" fw-bold border-start border-3 border-success px-4 mb-3 me-5 align-content-center">Filter</p>

            <form action="" class="form-control border-0 d-flex bg-body-tertiary" method="post">
                <?php
                $branches = RequestSQL::getAllBranches();

                $sessionDate = '';
                $sessionBranch = '';
                $sessionGroup = '';
                $sessionOrder = '';
                $sessionStaff = '';

                $admin = RequestSQL::getSession('admin-transaction');
                if ($admin) {
                    $sessionDate = $admin['date'];
                    $sessionBranch = $admin['branch'];
                    $sessionGroup = $admin['groupBy'];
                    $sessionOrder = $admin['order'];
                    $sessionStaff = $admin['staff'];
                }
                $selectedDate = isset($_POST['item-date']) ? $_POST['item-date'] : $sessionDate;
                $selectedBranch = isset($_POST['item-branch']) ? $_POST['item-branch'] : $sessionBranch;
                $selectedGroup = isset($_POST['group-by']) ? $_POST['group-by'] : $sessionGroup;
                $selectedOrder = isset($_POST['order-by']) ? $_POST['order-by'] : $sessionOrder;
                $selectedStaff = isset($_POST['staff']) ? $_POST['staff'] : $sessionStaff;

                $staffs = RequestSQL::getAllStaff(false, $selectedBranch);

                function isSelected($option, $selectedValue)
                {
                    return $option === $selectedValue ? 'selected' : '';
                }
                ?>
                <input class="form-control rounded mb-3 me-3" type="date" name="item-date"
                    value="<?php echo $selectedDate; ?>">
                <select class="form-select rounded mb-3 me-3" name="group-by" id="group-by">
                    <option value="">-- Group By --</option>
                    <option value="lm1" <?php echo isSelected('lm1', $selectedGroup); ?>>Last Month</option>
                    <option value="lm2" <?php echo isSelected('lm2', $selectedGroup); ?>>Last 2 Months</option>
                    <option value="lm3" <?php echo isSelected('lm3', $selectedGroup); ?>>Last 3 Months
                    </option>
                    <option value="weekly" <?php echo isSelected('weekly', $selectedGroup); ?>>Weekly</option>
                    <option value="monthly" <?php echo isSelected('monthly', $selectedGroup); ?>>Monthly</option>
                    <option value="annually" <?php echo isSelected('annually', $selectedGroup); ?>>Annually</option>
                </select>

                <select class="form-select rounded mb-3 me-3" name="item-branch" id="item-branch">
                    <option value="">-- Select Branches --</option>
                    <?php
                    if ($branches) {
                        while ($branch = $branches->fetch_assoc()) {
                            $branchId = $branch['id'];
                            $branchName = $branch['branch_name'];
                            echo "<option value='{$branchId}' " . isSelected($branchId, $selectedBranch) . ">{$branchName}</option>";
                        }
                    }
                    ?>
                </select>

                <select class="form-select rounded mb-3 me-3" name="order-by" id="order-by">
                    <option value="asc" <?php echo isSelected('asc', $selectedOrder); ?>>ASCENDING</option>
                    <option value="desc" <?php echo isSelected('desc', $selectedOrder); ?>>DESCENDING</option>
                </select>

                <select class="form-select rounded mb-3 me-3" name="staff" id="staff">
                    <option value="">-- Select Staff --</option>
                    <?php
                    if ($staffs) {
                        while ($staff = $staffs->fetch_assoc()) {
                            $staffID = $staff['id'];
                            $staffName = $staff['firstName'] . " " . $staff['lastName'];
                            echo "<option value='{$staffID}' " . isSelected($staffID, $selectedStaff) . ">{$staffName}</option>";
                        }
                    }
                    ?>
                </select>

                <button class="btn custom-btn-secondary mb-3 rounded" type="submit">Search</button>
            </form>

        </div>

        <div>
            <?php
            $data = RequestSQL::getAllTransaction($selectedDate, $selectedGroup, $selectedOrder, $selectedStaff, 'admin', $selectedBranch);
            $transactions = $data['result'];

            $currentPage = $data['page'];
            $totalPages = $data['total'];
            $transactionArray = BranchClass::loadAllTransaction($transactions);
            BranchClass::loadPaginator($currentPage, $totalPages, 'admin-transaction-page');
            // $transaction = RequestSQL::getAllTransaction($selectedDate, $selectedGroup, $selectedOrder, $selectedStaff, 'admin', $selectedBranch, 9999, 0)['result'];
            // $transactionArray = [];
            // if ($transaction->num_rows != 0) {
            //     foreach ($transaction as $row) {
            //         $transactionArray[] = $row;
            //     }
            // }
            ?>
        </div>

    </div>
</div>

<script>
    function printReceipt(modalId, id, subtotal, discount, total, cash, change, staff, branchName) {
        const modalContent = document.querySelector(`#${modalId} .modal-body`).innerHTML;

        const printWindow = window.open('', '_blank', 'width=600,height=400');
        printWindow.document.open();
        printWindow.document.write(`
        <html>
            <head>
                <title>Transaction Receipt</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        padding: 20px;
                        background-color: #f4f4f4; 
                    }
                    .receipt {
                        width: 180px; 
                        margin: auto; 
                        text-align: center; 
                        background-color: #fff;
                        border: 2px dashed black;
                        padding: 20px;
                    }

                    .receipt h2 {
                        margin: 0 0 10px; 
                        font-size: 14px; 
                    }

                    .receipt p {
                        margin: 4px 0; 
                        font-size: 12px; 
                        color: #333;
                    }

                    .receipt hr {
                        border: none; 
                        border-top: 1px dashed #ccc;
                        margin: 5px 0; 
                    }

                    .receipt .total-section {
                        margin-top: 10px; 
                    }

                    .receipt .total-section .total-item {
                        display: flex; 
                        justify-content: space-between; 
                        width: 100%;
                        font-size: 10px; 
                    }

                    .receipt .thank-you {
                        margin-top: 10px; 
                        font-size: 12px; 
                        color: #777;
                    }
                    @media print {
                        body {
                            font-family: 'Courier New', monospace;
                            font-size: 10px !important;
                        }
                        div {
                            text-align: left;
                        }
                        .space {
                            height: 20px;
                        }
                        .invoice {
                            text-align: center;
                            font-size: 12px !important;
                        }
                        table {
                          width: 100%;
                        }
                        th, td {
                            font-size: 10px !important;
                            text-align: left;
                            font-weight: normal !important;
                        }
                        td.first-child {
                            padding-top: 5px;
                        }
                        th {
                            padding-top: 0;
                            margin-top: 0;
                            border-bottom: 1px dashed #ccc;
                            padding-bottom: 5px;
                        }
                        th.price, td.price {
                            text-align: right;
                        }
                    }
                </style>
            </head>
            <body>
                <div class="receipt">
                    <hr>
                    <div class='space'></div>
                    <hr>
                    <div class='invoice'>LYZA DRUGMART</div>
                    <div class='invoice'>Mountain Homes</div>
                    <div class='invoice'>Brgy ${branchName}</div>
                    <div class='invoice'>Sto. Tomas Batangas</div>
                    <div class='invoice'>TIN: 481-311-303</div>
                    <hr>
                    <div class='invoice'>SALES INVOICE</div>
                    <hr>
                    <div>Receipt: #${id}</div>
                    <div>${new Date().toLocaleDateString() + " " + new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true })}</div>
                    <div>${staff}</div>
                    <hr>
                    <table>
                        ${modalContent}
                    </table>

                    <hr>

                    <div class="total-section">
                        <div class="total-item">
                            <span>Subtotal:</span>
                            <span>₱${parseFloat(subtotal).toFixed(2)}</span>
                        </div>
                        <div class="total-item">
                            <span>Discount:</span>
                            <span>₱${parseFloat(discount).toFixed(2)}</span>
                        </div>
                        <div class="total-item">
                            <span>Total:</span>
                            <span>₱${parseFloat(total).toFixed(2)}</span>
                        </div>
                        <div class="total-item">
                            <span>Paid:</span>
                            <span>₱${parseFloat(cash).toFixed(2)}</span>
                        </div>
                        <div class="total-item">
                            <span>Change:</span>
                            <span>₱${parseFloat(change).toFixed(2)}</span>
                        </div>
                    </div>

                    <hr>
                    <p>Thank you!</p>
                    <hr>
                    <div style='height: 5px'></div>
                    <p style="text-align: center;">------TEAR-HERE------</p>
                    <div style='height: 5px'></div>    
                    <hr>
                    <p>How's our Service?</p>
                    <div>If you have recommendations, Please fill out this form then drop to the branch dropbox.</div>
                    <div class='space'></div>    
                    <hr>
                    <div style='height: 5px'></div> 
                    <hr>
                    <div style='height: 5px'></div> 
                    <hr>
                    <div style='height: 5px'></div> 
                </div>
            </body>
        </html>
    `);
        printWindow.document.close();
        printWindow.print();
        printWindow.close();
    }

    // shinare pa saken ung gdrive na video para lang malaman ko daw sino sino un, kase sabe ko diko kilala, kase nga naka dump

</script>
<?php include_once "modals/admin/addTransaction.php" ?>
<?php include_once "admin/script/print_transaction.php" ?>