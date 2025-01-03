<?php
session_start();

require_once("../backend/config.php");
require_once("../backend/database.php");
require_once("../backend/session.php");
require_once("../backend/main_req.php");
require_once "../backend/functions.php";
?>
<!----- Best Seller Tab ----->
<div class="col-md-12 overflow-x overflow-x-scroll overflow-y-hidden" id="bestsellerTab">
    <div class="d-flex">

        <?php
        $product = RequestSQL::getBestSellerProduct();

        foreach ($product as $row): ?>
        <div class="col-sm-2 mb-3 mx-2">
            <div class="card shadow border-0 rounded-4 featured-card same-height-card">
                <img src="img/<?php echo $row['productImage']; ?>" alt=""
                    class="img-thumbnail border-0 rounded-top-4 mx-auto" width="150">
                <div class="text-center">
                    <span class="badge bg-secondary">
                        <?php echo $row['productCategory']; ?>
                    </span>
                    <p class="text-center" style="font-size: 14px; !important">
                        <?php echo $row['productName']; ?>
                    </p>
                    <h1 class="fw-bold">₱
                        <?php echo $row['productPrice']; ?>
                    </h1>
                    <p class="text-muted">Per
                        <?php echo $row['productUnit']; ?>
                    </p>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>
</div>