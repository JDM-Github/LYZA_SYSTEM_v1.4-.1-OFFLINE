<div class="content ms-3">


    <div id="main-content">
        <div class="card shadow p-1 bg-body-tertiary rounded border-0 mb-3">
            <div class="d-flex justify-content-between">
                <p class="fw-bold border-start border-3 border-success px-4 m-3 mb-3">
                    Dashboard
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
                    <button id="printChartButton" class="btn btn-success ms-3 border-dark-green" type="button"
                        onclick="printStockHistory()">Download
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

                    $staffs = RequestSQL::getAllStaff(true, $selectedBranch);

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
                        <option value="daily" <?php echo isSelected('daily', $selectedGroup); ?>>Daily</option>
                        <option value="weekly" <?php echo isSelected('weekly', $selectedGroup); ?>>Weekly</option>
                        <option value="monthly" <?php echo isSelected('monthly', $selectedGroup); ?>>Monthly</option>
                        <option value="semi-annually" <?php echo isSelected('semi-annually', $selectedGroup); ?>>
                            Semi-Annually</option>
                        <option value="annually" <?php echo isSelected('annually', $selectedGroup); ?>>Annually</option>
                    </select>

                    <button class="btn btn-secondary mb-3 rounded" type="submit">Search</button>
                </form>
            </div>

            <div>
                <?php
                $data = RequestSQL::getAllStockHistory($selectedBranch, $selectedStaff);
                $histories = $data['result'];
                $currentPage = $data['page'];
                $totalPages = $data['total'];
                AdminClass::loadAllStockHistory($histories);
                BranchClass::loadPaginator($currentPage, $totalPages, 'admin-stock-history-page');

                $histories = RequestSQL::getAllStockAdmin($selectedBranch, $selectedStaff);
                $historiesArray = [];
                while ($row = $histories->fetch_assoc()) {
                    $historiesArray[] = $row;
                }
                ?>
            </div>

        </div>
    </div>
</div>

<script>

    const ctx = document.getElementById('stockChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Overall Stock', 'Overall Demand'],
            datasets: [{
                label: 'Rate',
                data: [12, 19],

                backgroundColor: [
                    '#EE6055'
                ],
                borderWidth: 0
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

</script>

<div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
    aria-atomic="true" style="position: absolute; top: 20px; right: 20px; display: none;">
    <div class="d-flex">
        <div class="toast-body">No stock history.</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" aria-label="Close"
            onclick="closeToast('errorToast')"></button>
    </div>
</div>

<?php include_once "admin/script/print_stock.php" ?>