<div class="content ms-3" style="width: 100%">
    <div id="main-content">
        <div class=" card shadow p-2 bg-body-tertiary rounded border-0 mb-3 ">
            <form action="" method="post">
                <div class="input-group input-group border-0 align-content-center p-2 pb-0">
                    <p class=" fw-bold border-start border-3 border-success px-4 mb-3 me-5 align-content-center">
                        All Accounts
                    </p>

                    <?php
                    $admin = RequestSQL::getSession('admin-stock');

                    $sessionSearch = '';
                    if ($admin)
                        $sessionSearch = $admin['search'];
                    $searchValue = isset($_POST['search-value']) ? $_POST['search-value'] : $sessionSearch;
                    ?>

                    <input type="text" class="form-control rounded-start mb-3" placeholder="Search..."
                        name='search-value' aria-describedby="search-button-product" value="<?php echo $searchValue ?>">

                    <button class="btn btn-sm rounded-end border px-3 mb-3 me-3" type="submit">
                        <i class="bi bi-search"></i>
                    </button>

                    <!-- <button class="btn btn-secondary mb-3 rounded me-3" type="button" data-bs-toggle="modal"
                        data-bs-target="#createBranchModal">Add Branch</button> -->
                    <button class="btn btn-secondary mb-3 rounded" type="button" data-bs-toggle="modal"
                        data-bs-target="#addAccountModal">Add Account</button>
                </div>
            </form>
        </div>

        <!-- Staff Accounts Data ----->
        <div class="card shadow p-3 bg-body-tertiary rounded border-0">
            <div class="input-group input-group-sm border-0 align-content-center">
                <p class=" fw-bold border-start border-3 border-success px-4 mb-3 me-5 align-content-center">
                    Filter
                </p>

                <form action="" class="form-control border-0 d-flex bg-body-tertiary" method="post">
                    <?php
                    $branches = RequestSQL::getAllBranches();
                    $sessionBranch = '';
                    $sessionStatus = '';

                    $admin = RequestSQL::getSession('admin-account');
                    if ($admin) {
                        $sessionBranch = $admin['branch'];
                        $sessionStatus = $admin['status'];
                    }
                    $selectedBranch = isset($_POST['item-branch']) ? $_POST['item-branch'] : $sessionBranch;
                    $selectedStatus = isset($_POST['item-status']) ? $_POST['item-status'] : $sessionStatus;

                    function isSelected($option, $selectedValue)
                    {
                        return $option === $selectedValue ? 'selected' : '';
                    }
                    ?>

                    <select class="form-select rounded mb-3 me-3" name="item-branch" id="item-branch">
                        <option value="">-- Assigned Branches --</option>
                        <?php
                        if ($branches) {
                            while ($branch = $branches->fetch_assoc()) {
                                $branchName = $branch['branch_name'];
                                echo "<option value='{$branchName}' " . isSelected($branchName, $selectedBranch) . ">{$branchName}</option>";
                            }
                        }
                        ?>
                    </select>

                    <select class="form-select rounded mb-3 me-3" name="item-status" id="item-status">
                        <option value="">-- Status --</option>
                        <?php
                        echo "<option value='active' " . isSelected('active', $selectedStatus) . ">ACTIVE</option>";
                        echo "<option value='disabled' " . isSelected('disabled', $selectedStatus) . ">DISABLED</option>";
                        echo "<option value='removed' " . isSelected('removed', $selectedStatus) . ">REMOVED</option>";
                        ?>
                    </select>

                    <button class="btn btn-secondary mb-3 rounded" type="submit">Search</button>
                </form>
            </div>

            <div>
                <!-- Major Change: 
                    Please include "Change Password Privilege for the admin for staff accounts"
                -->
                <?php
                $data = RequestSQL::getAdminStaff($selectedBranch, $selectedStatus, $searchValue);
                $account = $data['result'];
                $currentPage = $data['page'];
                $totalPages = $data['total'];
                AdminClass::loadAllAccounts($account);
                BranchClass::loadPaginator($currentPage, $totalPages, 'admin-account-page');
                ?>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAccountModalLabel">Add User Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAccountForm" method="post" action="backend/redirector.php">
                    <input type="hidden" name="type" value="admin-add-account">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="userName" class="form-label">Username</label>
                        <input type="text" class="form-control" id="userName" name="userName" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password"
                                pattern="^(?=.*[a-z])(?=.*[A-Z])[a-zA-Z]{6,}$"
                                title="Password must be at least 6 characters long and include both uppercase and lowercase letters. No special symbols allowed."
                                required>
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                <i class="bi bi-eye-slash" id="passwordIcon"></i>
                            </button>
                        </div>
                    </div>

                    <?php $branches = RequestSQL::getAllBranches(); ?>
                    <div class="mb-3">
                        <label for="assignedBranch" class="form-label">Assigned Branch</label>
                        <select class="form-select" id="assignedBranch" name="assignedBranch" required>
                            <option value="" disabled selected>Select a branch</option>
                            <?php
                            if ($branches) {
                                while ($branch = $branches->fetch_assoc()) {
                                    $branch_id = $branch['id'];
                                    $branchName = $branch['branch_name'];
                                    echo "<option value='{$branch_id}'>{$branchName}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="dataPrivacyCheck" name="dataPrivacyCheck"
                            required>
                        <label for="dataPrivacyCheck" class="form-check-label">
                            I agree to the Privacy Policy and consent to the collection and use of my personal data in
                            accordance with the Data Privacy Act of 2012.
                        </label>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary" form="addAccountForm">Create Account</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const passwordIcon = document.getElementById('passwordIcon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.classList.replace('bi-eye-slash', 'bi-eye');
        } else {
            passwordField.type = 'password';
            passwordIcon.classList.replace('bi-eye', 'bi-eye-slash');
        }
    });
</script>

<div class="modal fade" id="createBranchModal" tabindex="-1" aria-labelledby="createBranchModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBranchModalLabel">Create New Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createBranchForm" method="POST" action="backend/redirector.php">
                    <div class="mb-3">
                        <label for="branchName" class="form-label">Branch Name</label>
                        <input type="hidden" name="type" value="admin-add-branch">
                        <input type="text" class="form-control" id="branchName" name="branchName"
                            placeholder="Enter branch name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary" form="createBranchForm">Create Branch</button>
            </div>
        </div>
    </div>
</div>


<script>
    function confirmDeactivate() {
        let confirmation = confirm("Are you sure you want to mark this account as deactivated?");
        return confirmation;
    }
    function confirmActivate() {
        let confirmation = confirm("Are you sure you want to mark this account as active?");
        return confirmation;
    }
    function confirmRemoval() {
        let confirmation = confirm("Are you sure you want to mark this account as removed?");
        return confirmation;
    }
</script>