<div class="content ms-3">


    <div id="main-content">
        <div class="card shadow p-1 bg-body-tertiary rounded border-0 mb-3">
            <div class="d-flex justify-content-between">
                <p class="fw-bold border-start border-3 border-success px-4 m-3 mb-3">
                    Dashboard
                </p>

                <form action="" class="border-0 d-flex m-1" method="post">
                    <?php

                    $sessionGroup = '';
                    $admin = RequestSQL::getSession('admin-transactions');
                    if ($admin)
                        $sessionGroup = $admin['groupBy'];

                    function isSelected($option, $selectedValue)
                    {
                        return $option === $selectedValue ? 'selected' : '';
                    }
                    $selectedGroup = isset($_POST['group-by']) ? $_POST['group-by'] : $sessionGroup;
                    ?>


                    <select class="form-select w-auto ms-3 me-3" name="group-by" id="group-by">
                        <option value="option1">-- Select Date --</option>
                        <option value="daily" <?php echo isSelected('daily', $selectedGroup); ?>>Daily</option>
                        <option value="weekly" <?php echo isSelected('weekly', $selectedGroup); ?>>Weekly</option>
                        <option value="monthly" <?php echo isSelected('monthly', $selectedGroup); ?>>Monthly</option>
                        <option value="semi-annually" <?php echo isSelected('semi-annually', $selectedGroup); ?>>
                            Semi-Annually</option>
                        <option value="annually" <?php echo isSelected('annually', $selectedGroup); ?>>Annually</option>
                    </select>

                    <style>
                        .border-dark-green {
                            background: #56AB91;
                        }

                        .border-dark-green:hover {
                            background: #369B71;
                        }
                    </style>
                    <button class="btn btn-secondary rounded" type="submit">Search</button>
                    <button id="printChartButton" class="btn btn-success ms-3 border-dark-green" type="button">Print
                        Chart</button>

                </form>

            </div>
        </div>

        <div class="d-flex mb-3">
            <?php include "admin/admin_figure.php"; ?>
        </div>

        <div class="d-flex">
            <div class="card shadow p-3 bg-body-tertiary rounded border-0 me-3" style="flex: 1;">
                <p class="fw-bold border-start border-3 border-success ps-4">Latest Transactions</p>
                <div>
                    <?php
                    $data = RequestSQL::getAllAdminLatestTransaction($selectedGroup);
                    $transactions = $data['result'];
                    $currentPage = $data['page'];
                    $totalPages = $data['total'];
                    AdminClass::loadAllLatestTransaction($transactions);
                    BranchClass::loadPaginator($currentPage, $totalPages, 'admin-transactions-page');
                    ?>
                </div>
            </div>

            <div class="card shadow p-3 bg-body-tertiary rounded border-0" style="width: 400px;">
                <p class="fw-bold border-start border-3 border-success ps-4">Most Sold Products</p>
                <canvas id="mostSoldProductsChart" style="max-height: 300px;"></canvas>

                <?php
                $mostSoldProducts = RequestSQL::getMostSoldProducts($selectedGroup);
                $labels = [];
                $data = [];

                if ($mostSoldProducts->num_rows <= 0) {
                    $noProducts = true;

                } else {
                    foreach ($mostSoldProducts as $product) {
                        $labels[] = $product['productName'];
                        $data[] = (int) $product['totalSold'];
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include_once "admin/script/product_sold.php" ?>