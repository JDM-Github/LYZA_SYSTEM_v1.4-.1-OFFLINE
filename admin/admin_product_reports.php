<?php
$currentUrl = $_SERVER['REQUEST_URI'];
$_SESSION['current_url'] = $currentUrl;
?>
<div class="content ms-3" id="stocks">

    <!-- Add New Product -->
    <div class=" card shadow p-2 bg-body-tertiary rounded border-0 mb-3 ">
        <form action="" method="post">
            <div class="input-group input-group border-0 align-content-center p-2 pb-0">
                <p class=" fw-bold border-start border-3 border-success px-4 mb-3 me-5 align-content-center">
                    All Products
                </p>

                <?php
                $admin = RequestSQL::getSession('admin-stock');

                $sessionSearch = '';
                if ($admin)
                    $sessionSearch = $admin['search'];
                $searchValue = isset($_POST['search-value']) ? $_POST['search-value'] : $sessionSearch;
                ?>

                <input type="text" class="form-control rounded-start mb-3" placeholder="Search..." name='search-value'
                    aria-describedby="search-button-product" value="<?php echo $searchValue ?>">

                <button class="btn btn-sm rounded-end border px-3 mb-3 me-3" type="submit" id="search-button-product">
                    <i class="bi bi-search"></i>
                </button>

                <button class="btn btn-secondary mb-3 rounded" type="button" data-bs-toggle="modal"
                    data-bs-target="#addProductModal">
                    Add Product
                </button>
            </div>
        </form>
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
                $branches = RequestSQL::getAllBranches();

                $sessionCategory = '';
                $sessionBranch = '';
                $sessionStatus = '';
                $sessionArchived = '';

                if ($admin) {
                    $sessionCategory = $admin['category'];
                    $sessionBranch = $admin['branch'];
                    $sessionStatus = $admin['status'];
                    $sessionArchived = $admin['archived'];
                }

                $selectedCategory = isset($_POST['item-category']) ? $_POST['item-category'] : $sessionCategory;
                $selectedBranch = isset($_POST['item-branch']) ? $_POST['item-branch'] : $sessionBranch;
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

                <select class="form-select rounded mb-3 me-3" name="item-branch" id="item-branch">
                    <option value="">-- Select Branches --</option>
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
            $data = RequestSQL::getAllProduct('admin-stock', $selectedCategory, $selectedStatus, $searchValue, $selectedArchived, $selectedBranch);
            $result = $data['result'];
            $currentPage = $data['page'];
            $totalPages = $data['total'];
            AdminClass::loadAllStock($result);
            BranchClass::loadPaginator($currentPage, $totalPages, 'admin-stock-page');
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" method="POST" action="backend/redirector.php" enctype="multipart/form-data">
                    <input type="hidden" name="type" value="admin-add-product">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName"
                            placeholder="Enter product name" required>
                    </div>

                    <?php $generics = RequestSQL::getGenericBrand(); ?>
                    <div class="mb-3">
                        <label for="productGeneric" class="form-label">Generic</label>
                        <select class="form-select" id="productGeneric" name="productGeneric" required
                            onchange="toggleNewGeneric()">
                            <option value="" disabled selected>Select Generic</option>
                            <?php
                            if ($generics) {
                                while ($generic = $generics->fetch_assoc()) {
                                    $genericBrand = $generic['genericBrand'];
                                    echo "<option value='{$genericBrand}'>{$genericBrand}</option>";
                                }
                            }
                            ?>
                            <option value="newGeneric">New Generic</option>
                        </select>
                    </div>
                    <div class="mb-3" id="newGenericDiv" style="display: none;">
                        <label for="newGenericName" class="form-label">New Generic Name</label>
                        <input type="text" class="form-control" id="newGenericName" name="newGenericName"
                            placeholder="Enter new generic name">
                    </div>

                    <?php $categories = RequestSQL::getAllCategories(); ?>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Category</label>
                        <select class="form-select" id="productCategory" name="productCategory" required
                            onchange="toggleNewCategoryDiv()">
                            <option value="" disabled selected>Select Category</option>
                            <?php
                            if ($categories) {
                                while ($category = $categories->fetch_assoc()) {
                                    $category_name = $category['category_name'];
                                    echo "<option value='{$category_name}'>{$category_name}</option>";
                                }
                            }
                            ?>
                            <option value="newCategory">New Category</option>
                        </select>
                    </div>
                    <div class="mb-3" id="newCategoryDiv" style="display: none;">
                        <label for="newCategoryName" class="form-label">New Category Name</label>
                        <input type="text" class="form-control" id="newCategoryName" name="newCategoryName"
                            placeholder="Enter new category name">
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
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Initial Stock</label>
                        <input type="number" class="form-control" id="productStock" name="productStock"
                            placeholder="Enter stock quantity" required>
                    </div>

                    <div class="mb-3">
                        <label for="expirationDate" class="form-label">Initial Expiration Date</label>
                        <input type="date" class="form-control" id="expirationDate" name="expirationDate"
                            placeholder="Enter first stock expiration date" required>
                    </div>

                    <div class="mb-3">
                        <label for="productUnit" class="form-label">Unit</label>
                        <select class="form-select" id="productUnit" name="productUnit" required>
                            <option value="" disabled selected>Select a Unit</option>
                            <option value="Tablet">per Tablet</option>
                            <option value="Box">per Box</option>
                            <option value="Pack">per Pack</option>
                            <option value="Bottle">per Bottle</option>
                            <option value="Sachet">per Sachet</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="productPrice" name="productPrice"
                            placeholder="Enter price" required>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input class="form-control" type="file" id="productImage" name="productImage" accept="image/*"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="productQRCode" class="form-label">Product QR Code</label>
                        <input type="text" class="form-control" id="productQRCode" name="productQRCode"
                            placeholder="Scan QR code" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary rounded" form="addProductForm">Add Product</button>
            </div>
        </div>
    </div>
</div>

<script>
    // const productQRCodeInput = document.getElementById('productQRCode');

    // // DETECT THE QR CODE (TEST NIO NALANG)
    // productQRCodeInput.addEventListener('input', function (event) {
    //     const scannedData = event.target.value;
    //     // alert("Scanned QR Code Data:", scannedData);
    //     productQRCodeInput.value = scannedData;
    // });
</script>

<script>
    function toggleNewCategoryDiv() {
        const newCategoryDiv = document.getElementById("newCategoryDiv");
        const selectedCategory = document.getElementById("productCategory").value;

        if (selectedCategory === "newCategory") {
            newCategoryDiv.style.display = "block";
        } else {
            newCategoryDiv.style.display = "none";
        }
    }

    function toggleNewGeneric() {
        const newGenericDiv = document.getElementById("newGenericDiv");
        const selectedGeneric = document.getElementById("productGeneric").value;

        if (selectedGeneric === "newGeneric") {
            newGenericDiv.style.display = "block";
        } else {
            newGenericDiv.style.display = "none";
        }
    }
    function confirmArchive(check) {
        let confirmation = "None";
        if (check == "Archived")
            confirmation = confirm("Are you sure you want to archived this product?");
        else
            confirmation = confirm("Are you sure you want to unarchived this product?");
        return confirmation;
    }
</script>