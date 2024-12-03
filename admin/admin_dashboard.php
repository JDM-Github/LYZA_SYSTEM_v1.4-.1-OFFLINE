<div class="content ms-3" style="width: 100%;">

    <div id="main-content">
        <div class="card shadow p-1 bg-body-tertiary rounded border-0 mb-3">
            <div class="d-flex justify-content-between">
                <p class="fw-bold border-start border-3 border-success px-4 m-3 mb-3">
                    Dashboard
                </p>

                <form action="" class="border-0 d-flex m-1" method="post">

                    <?php

                    $sessionGroup = 'monthly';
                    $admin = RequestSQL::getSession('admin-transactions');
                    if ($admin)
                        $sessionGroup = $admin['groupBy'];

                    function isSelected($option, $selectedValue)
                    {
                        return $option === $selectedValue ? 'selected' : '';
                    }
                    $selectedGroup = isset($_POST['group-by']) ? $_POST['group-by'] : $sessionGroup;
                    ?>


                    <style>
                        .border-dark-green {
                            background: #56AB91;
                        }

                        .border-dark-green:hover {
                            background: #369B71;
                        }
                    </style>

                    <!-- <button class="btn btn-secondary rounded" type="submit">Search</button> -->
                    <!-- <button id="printChartButton" class="btn custom-btn-success ms-3 border-dark-green"
                        type="button">Print
                        Chart</button> -->

                </form>

            </div>
        </div>

        <!---- Revenue Visuals --------------->
        <div class="d-flex mb-3">
            <?php include "admin/admin_figure_revenue.php"; ?>
        </div>


        <div class="d-flex mb-3">
            <div class="card shadow p-3 bg-body-tertiary rounded border-0 me-3" style="flex: 1;">
                <p class="fw-bold border-start border-3 border-success ps-4">Revenue Projection</p>

                <?php
                $history = RequestSQL::getRevenueHistory($selectedGroup);
                $calculated = RequestSQL::calculateProjection($history);

                $historyJson = json_encode($history);
                $calculatedJson = json_encode($calculated);
                ?>
                <canvas id="revenueProjectionChart"></canvas>
            </div>

            <div class="card shadow p-3 bg-body-tertiary rounded border-0" style="width: 400px;">
                <!---- Pie graph of Sales --------------->
                <p class="fw-bold border-start border-3 border-success ps-4">Most Selling Products</p>
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

        <!---- Stock Visuals --------------->
        <div class="d-flex mb-3">
            <?php include "admin/admin_figure_stocks.php"; ?>
        </div>

        <div class="d-flex">
            <div class="card shadow p-3 bg-body-tertiary rounded border-0 me-3" style="flex: 1;">
                <!---- Pie graph of stock portions --------->
                <p class="fw-bold border-start border-3 border-success ps-4">Stock Portions</p>
                <?php
                $stockPortions = RequestSQL::getStockPortions();
                $stockPortionLabels = json_encode(array_keys($stockPortions));
                $stockPortionData = json_encode(array_values($stockPortions));
                ?>
                <canvas id="stockPortionsChart" style="max-height: 300px;"></canvas>
            </div>

            <div class="card shadow p-3 bg-body-tertiary rounded border-0" style="width: 400px;">
                <!---- Pie graph of Categories inside Inventory --------------->
                <p class="fw-bold border-start border-3 border-success ps-4">Category Portions</p>
                <?php
                $categoryData = RequestSQL::getCategoryDistribution();
                $categoryLabels = json_encode($categoryData['categories']);
                $categoryCounts = json_encode($categoryData['counts']);
                ?>
                <canvas id="categoryDistributionChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<?php include_once "admin/script/revenue_projection.php" ?>
<?php include_once "admin/script/stock_history.php" ?>
<?php include_once "admin/script/product_sold.php" ?>
<?php include_once "admin/script/category_portion.php" ?>