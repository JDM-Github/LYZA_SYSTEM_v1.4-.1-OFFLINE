<div class="content ms-3 col-sm-11 content-section" id="transactions">

    <!-- Search / Category Navigation -->
    <div class="card shadow p-0 bg-body-tertiary rounded border-0 mb-3">
        <p class=" fw-bold border-start border-3 border-success px-4 ms-3 my-3">
            Recent Transactions
        </p>
    </div>

    <!-- Product Grid -->
    <div class="card card shadow p-3 bg-body-tertiary rounded border-0">
        <div class="input-group input-group-sm border-0 align-content-center">
            <p class=" fw-bold border-start border-3 border-success px-4 mb-3 me-5 align-content-center">Filter</p>

            <form action="" class="form-control border-0 d-flex bg-body-tertiary" method="post">
                <?php
                $staffs = RequestSQL::getAllStaff();
                $sessionDate = '';
                $sessionGroup = '';
                $sessionOrder = '';
                $sessionStaff = '';

                $branch = RequestSQL::getSession('branch-transaction');
                if ($branch) {
                    $sessionDate = $branch['date'];
                    $sessionGroup = $branch['groupBy'];
                    $sessionOrder = $branch['order'];
                    $sessionStaff = $branch['staff'];
                }
                $selectedDate = isset($_POST['item-date']) ? $_POST['item-date'] : $sessionDate;
                $selectedGroup = isset($_POST['group-by']) ? $_POST['group-by'] : $sessionGroup;
                $selectedOrder = isset($_POST['order-by']) ? $_POST['order-by'] : $sessionOrder;
                $selectedStaff = isset($_POST['staff']) ? $_POST['staff'] : $sessionStaff;
                

                function isSelected($option, $selectedValue)
                {
                    return $option === $selectedValue ? 'selected' : '';
                }
                ?>
                <input class="form-control rounded mb-3 me-3" type="date" name="item-date"
                    value="<?php echo $selectedDate; ?>">
                <select class="form-select rounded mb-3 me-3" name="group-by" id="group-by">
                    <option value="">-- Group By --</option>
                    <option value="daily" <?php echo isSelected('daily', $selectedGroup); ?>>Daily</option>
                    <option value="weekly" <?php echo isSelected('weekly', $selectedGroup); ?>>Weekly</option>
                    <option value="monthly" <?php echo isSelected('monthly', $selectedGroup); ?>>Monthly</option>
                    <option value="semi-annually" <?php echo isSelected('semi-annually', $selectedGroup); ?>>
                        Semi-Annually</option>
                    <option value="annually" <?php echo isSelected('annually', $selectedGroup); ?>>Annually</option>
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
                            $staffName = $staff['userName'];
                            echo "<option value='{$staffID}' " . isSelected($staffID, $selectedStaff) . ">{$staffName}</option>";
                        }
                    }
                    ?>
                </select>

                

                <button class="btn btn-secondary mb-3 rounded" type="submit">Search</button>
            </form>

        </div>

        <div>
            <?php
            $data = RequestSQL::getAllTransaction($selectedDate, $selectedGroup, $selectedOrder, $selectedStaff, 'branch', '1');
            $transactions = $data['result'];
            $currentPage = $data['page'];
            $totalPages = $data['total'];
            BranchClass::loadAllTransaction($transactions);
            BranchClass::loadPaginator($currentPage, $totalPages, 'branch-transaction-page');
            ?>
        </div>

    </div>
</div>

<?php include_once "modals/branch/transaction_model.php" ?>