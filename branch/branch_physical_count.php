<div class="content ms-3 flex-fill content-section" id="stocks">

    <!-- Add New Product -->
    <div class="card shadow p-1 bg-body-tertiary rounded border-0 mb-3">
        <div class="d-flex justify-content-between">
            <p class="fw-bold border-start border-3 border-success px-4 m-3 mb-4">
                Physical Counting
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
                    type="button" onclick="printPhysicalCount()">Download
                    History</button>
                <button class="btn btn-secondary me-2 mt-1 mb-1 " data-bs-toggle="modal"
                    data-bs-target="#addPhysicalCountModal" type="button">
                    Add Physical Count
                </button>
            </form>

        </div>
    </div>

    <!-- Product Table-->
    <div class="card card shadow p-3 bg-body-tertiary rounded border-0">
        <div class="input-group input-group-sm border-0 align-content-center">
            <!-- <p class=" fw-bold border-start border-3 border-success px-4 mb-3 me-5 align-content-center">
                Filter
            </p> -->

            <!-- <form action="" class="form-control border-0 d-flex bg-body-tertiary" method="post">
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
            </form> -->

        </div>

        <div>
            <?php
            $branchTarget = RequestSQL::getSession('account')['assignedBranch'];
            $data = RequestSQL::getAllPhysicalCount(
                null,
                null,
                $branchTarget
            );
            $result = $data['result'];
            $currentPage = $data['page'];
            $totalPages = $data['total'];
            $physicalArray = BranchClass::loadAllPhysicalCounts($result);
            BranchClass::loadPaginator($currentPage, $totalPages, 'branch-physical-page');
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="addPhysicalCountModal" tabindex="-1" aria-labelledby="addPhysicalCountModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="backend/redirector.php">
                <input type="hidden" name="type" value="add-physical-count">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPhysicalCountModalLabel">Add Physical Count</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Brand Name -->
                    <div class="mb-3">
                        <label for="brandName" class="form-label">Brand Name</label>
                        <input type="text" name="brandName" id="brandName" class="form-control" required>
                    </div>
                    <!-- Generic Name -->
                    <div class="mb-3">
                        <label for="genericName" class="form-label">Generic Name</label>
                        <input type="text" name="genericName" id="genericName" class="form-control" required>
                    </div>
                    <!-- Expiry Date -->
                    <div class="mb-3">
                        <label for="expiryDate" class="form-label">Expiry Date</label>
                        <input type="date" name="expiryDate" id="expiryDate" class="form-control" required>
                    </div>
                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="0" required>
                    </div>
                    <!-- Hidden Fields for Branch and Staff -->

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary">Save</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once "admin/script/print_physical.php";
?>