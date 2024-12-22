<?php
session_start();

require_once("../backend/config.php");
require_once("../backend/database.php");
require_once("../backend/session.php");
require_once("../backend/main_req.php");
require_once "../backend/functions.php";

if (isset($_GET['category'])) {
    $category = $_GET['category'] === 'all' ? '' : $_GET['category'];
    $_SESSION['client-category-active'] = $category;
}

if (isset($_GET['search-value'])) {
    $_SESSION['client-search-value'] = $_GET['search-value'];
}

$categoryActive = isset($_SESSION['client-category-active']) ? $_SESSION['client-category-active'] : '';
$searchValue = isset($_SESSION['client-search-value']) ? $_SESSION['client-search-value'] : '';

?>

<!--- Productpage ------------------------------------------------------------------------------->
<div class="page-content">
    <div class="container">
        <div class="about-content my-5 px-5">
            <span class="text-muted pb-5" style="color: var(--dark)">Home > <strong>Products</strong></span><br>
            <hr>
            <h1 class="fw-bolder display-1 text-center my-5" style="color: var(--dark)">Our Products</h1>

            <!---- Search Bar ---->
            <form method="post">
                <div class="input-group input-group-lg mb-3">

                    <button class="input-group-text rounded-start-4" id="search-icon">
                        <i class="bi bi-search text-muted"></i>
                    </button>
                    <input type="text" class="form-control rounded-end-4" placeholder="Search Product..."
                        name='search-value' aria-label="Searchbar" aria-describedby="search-icon"
                        value="<?php echo $searchValue ?>">
                </div>
            </form>

            <!---- Category Filter ---->
            <div class="p-4 rounded-4 bg-body-secondary">
                <nav class="nav nav-pills flex-column flex-sm-row custom-category-pills">

                    <?php
                    $categories = RequestSQL::getAllCategories();
                    $isActive = $categoryActive ? '' : 'active';
                    echo "
                    <li class='nav-item'>
                        <a page-target='products' class='flex-sm-fill text-sm-center nav-link $isActive' aria-current='page' href='category=all'>ALL</a>
                    </li>
                    ";

                    if ($categories->num_rows != 0) {
                        foreach ($categories as $category) {
                            $isActive = $categoryActive === $category['category_name'] ? 'active' : '';
                            echo "
                            <li class='nav-item'>
                                <a page-target='products' class='flex-sm-fill text-sm-center nav-link $isActive' href='category={$category['category_name']}'>{$category['category_name']}</a>
                            </li>
                            ";
                        }
                    }
                    ?>
                </nav>
            </div>

            <!---- Product Grid Display ---->
            <div class="py-5" id="product-grid">
                <!---- Should be dynamically loaded by script or AJAX ---->

                <!---- Sample Content ---->
                <div class="row g-3">

                    <?php
                    $product = RequestSQL::getAllProduct('client', $categoryActive, null, $searchValue, null, null, null)['result'];

                    while ($row = $product->fetch_assoc()): ?>
                        <div class="col-sm-2">
                            <div class="card shadow border-0 rounded-4 mb-3 same-height-card">
                                <img src="img/<?php echo $row['productImage']; ?>" alt=""
                                    class="img-thumbnail border-0 rounded-top-4 mx-auto" width="150">
                                <div class="text-center">
                                    <span class="badge bg-secondary"><?php echo $row['productCategory']; ?></span>
                                    <p class="text-center" style="font-size: 14px; !important">
                                        <?php echo $row['productName']; ?>
                                    </p>
                                    <h1 class="fw-bold">₱
                                        <?php echo $row['productPrice']; ?>
                                    </h1>
                                    <p class="text-muted">Per <?php echo $row['productUnit']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>
            </div>
            <hr>
        </div>
    </div>
</div>