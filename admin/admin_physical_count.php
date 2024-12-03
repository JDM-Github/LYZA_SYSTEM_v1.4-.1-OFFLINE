<div class="content ms-3" style="width: 100%">

    <div id="main-content">
        <div class="card shadow p-1 bg-body-tertiary rounded border-0 mb-3">
            <div class="d-flex justify-content-between">
                <p class="fw-bold border-start border-3 border-success px-4 m-3 mb-3">
                    Physical Count Table
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
                    <button id="printChartButton" class="btn custom-btn-success ms-3 border-dark-green" type="button"
                        onclick="printPhysicalCount()">Download
                        History</button>
                </form>

            </div>
        </div>


        <div class="card shadow p-3 bg-body-tertiary rounded border-0">
            <div class="input-group input-group-sm border-0 align-content-center">
                <p class=" fw-bold border-start border-3 border-success px-4 mb-3 me-5 align-content-center">
                    Filter
                </p>
                <form action="" class="form-control border-0 d-flex bg-body-tertiary" method="post">

                    <?php
                    $branches = RequestSQL::getAllBranches();
                    $sessionBranch = '';
                    $sessionStaff = '';
                    $sessionGroup = '';

                    $admin = RequestSQL::getSession('admin-stock-history');
                    if ($admin) {
                        $sessionBranch = $admin['branch'];
                        $sessionStaff = $admin['staff'];
                        $sessionGroup = $admin['groupBy'];
                    }
                    $selectedBranch = isset($_POST['item-branch']) ? $_POST['item-branch'] : $sessionBranch;
                    $selectedStaff = isset($_POST['staff']) ? $_POST['staff'] : $sessionStaff;
                    $selectedGroup = isset($_POST['group-by']) ? $_POST['group-by'] : $sessionGroup;

                    $staffs = RequestSQL::getAllStaff(false, $selectedBranch);

                    function isSelected($option, $selectedValue)
                    {
                        return $option === $selectedValue ? 'selected' : '';
                    }
                    ?>

                    <select class="form-select rounded mb-3 me-3" name="item-branch" id="item-branch">
                        <option value="">-- Select Branches --</option>
                        <?php
                        if ($branches) {
                            while ($branch = $branches->fetch_assoc()) {
                                $branch_id = $branch['id'];
                                $branchName = $branch['branch_name'];
                                echo "<option value='{$branch_id}' " . isSelected($branch_id, $selectedBranch) . ">{$branchName}</option>";
                            }
                        }
                        ?>
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

                    <button class="btn btn-secondary mb-3 rounded" type="submit">Search</button>
                </form>
            </div>

            <div>
                <?php
                $data = RequestSQL::getAllPhysicalCount(
                    null,
                    $selectedStaff,
                    $selectedBranch,
                    $selectedGroup,
                );
                $result = $data['result'];
                $currentPage = $data['page'];
                $totalPages = $data['total'];
                $physicalArray = BranchClass::loadAllPhysicalCounts($result);
                BranchClass::loadPaginator($currentPage, $totalPages, 'admin-physical-page');
                ?>
            </div>

        </div>
    </div>
</div>

<div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
    aria-atomic="true" style="position: absolute; top: 20px; right: 20px; display: none;">
    <div class="d-flex">
        <div class="toast-body">No stock history.</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" aria-label="Close"
            onclick="closeToast('errorToast')"></button>
    </div>
</div>


<?php
include_once "admin/script/print_physical.php";
?>