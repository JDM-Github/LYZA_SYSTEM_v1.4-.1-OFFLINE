<div class="content ms-3 flex-fill content-section" id="stocks">

    <!-- Add New Product -->
    <div class="card shadow p-1 bg-body-tertiary rounded border-0 mb-3">
        <div class="d-flex justify-content-between">
            <p class="fw-bold border-start border-3 border-success px-4 m-3 mb-4">
                Branch Products
            </p>

            <form action="" class="border-0 d-flex m-1" method="post">

                <style>
                    .border-dark-green {
                        background: #56AB91;
                    }

                    .border-dark-green:hover {
                        background: #369B71;
                    }
                </style>
                <button id="printChartButton" class="btn custom-btn-success me-2 mt-1 mb-1 border-dark-green"
                    type="button" onclick="printStockHistory()">Download
                    History</button>
            </form>

        </div>
    </div>

    <!-- Product Table-->
    <div class="card card shadow p-3 bg-body-tertiary rounded border-0">
        <div class="input-group input-group-sm border-0 align-content-center">
            <p class=" fw-bold border-start border-3 border-success px-4 mb-3 me-5 align-content-center">
                Filter
            </p>

            <form action="" class="form-control border-0 d-flex bg-body-tertiary" method="post">
                <?php
                $categories = RequestSQL::getAllCategories();

                $sessionCategory = '';
                $sessionStatus = '';
                $sessionArchived = '';

                $branch = RequestSQL::getSession('branch-stock');
                if ($branch) {
                    $sessionCategory = $branch['category'];
                    $sessionStatus = $branch['status'];
                    $sessionArchived = $branch['archived'];
                }

                $selectedCategory = isset($_POST['item-category']) ? $_POST['item-category'] : $sessionCategory;
                $selectedStatus = isset($_POST['item-status']) ? $_POST['item-status'] : $sessionStatus;
                $selectedArchived = isset($_POST['item-archived']) ? $_POST['item-archived'] : $sessionArchived;

                function isSelected($option, $selectedValue)
                {
                    return $option === $selectedValue ? 'selected' : '';
                }
                ?>

                <select class="form-select rounded mb-3 me-3" name="item-category" id="item-category">
                    <option value="">-- Select Category --</option>
                    <?php
                    if ($categories) {
                        while ($category = $categories->fetch_assoc()) {
                            $categoryName = $category['category_name'];
                            echo "<option value='{$categoryName}' " . isSelected($categoryName, $selectedCategory) . ">{$categoryName}</option>";
                        }
                    }
                    ?>
                </select>

                <select class="form-select rounded mb-3 me-3" name="item-status" id="item-status">
                    <option value="">-- Select Status --</option>
                    <option value="good" <?php echo isSelected('good', $selectedStatus); ?>>Good</option>
                    <option value="critical" <?php echo isSelected('critical', $selectedStatus); ?>>Critical</option>
                    <option value="out-of-stock" <?php echo isSelected('out-of-stock', $selectedStatus); ?>>Out of Stock
                    </option>
                </select>

                <select class="form-select rounded mb-3 me-3" name="item-archived" id="item-archived">
                    <option value="narchived" <?php echo isSelected('narchived', $selectedArchived); ?>>
                        Not Archived
                    </option>
                    <option value="archived" <?php echo isSelected('archived', $selectedArchived); ?>>
                        Archived
                    </option>
                </select>

                <button class="btn btn-secondary mb-3 rounded" type="submit">Search</button>
            </form>

        </div>

        <div>
            <?php
            $branchTarget = RequestSQL::getSession('account')['branchName'];
            $data = RequestSQL::getAllProduct(
                'branch-stock',
                $selectedCategory,
                $selectedStatus,
                null,
                $selectedArchived,
                $branchTarget
            );
            $result = $data['result'];
            $currentPage = $data['page'];
            $totalPages = $data['total'];
            $productArray = BranchClass::loadAllStock($result);
            BranchClass::loadPaginator($currentPage, $totalPages, 'branch-stock-page');
            ?>
        </div>
    </div>
</div>
<?php include_once "admin/script/print_branch_product.php" ?>