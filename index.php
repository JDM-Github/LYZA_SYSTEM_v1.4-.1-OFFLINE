<?php
session_start();
require_once "backend/request.php";
require_once "backend/functions.php";

$_SESSION['cache_account'] = [];
if (file_exists("json/cache_account.json")) {
    $session_data = json_decode(file_get_contents("json/cache_account.json"), true);
    $_SESSION['cache_account'] = $session_data;
}
$_SESSION['online'] = RequestSQL::isOffline();


$_SESSION['account'] = null;
unset($_SESSION['account']);

$_SESSION['branch-cart-product'] = [];
unset($_SESSION['branch-cart-product']);

include "client/client_header.php";
require_once("modals/modals.php");
include "client/client_navigation.php";

if (isset($_SESSION['success-message'])) {
    echo "<script>showSuccessModal('{$_SESSION['success-message']}');</script>";
    unset($_SESSION['success-message']);
} elseif (isset($_SESSION['error-message'])) {
    echo "<script>showErrorModal('{$_SESSION['error-message']}');</script>";
    unset($_SESSION['error-message']);
}
?>

<div class="heading-filler">
    <!----- Empty Div Under Nav ----->
</div>

<section class="overflow-y-scroll overflow-x-hidden" id="page-content">

    <!-- Content Container ------------------------------------------------------------------------>
    <div id="content" class="w-100 mt-4 mb-5">
        <!-- Loaded by AJAX -->
    </div>

    <!----- Socials ------------------------------------------------------------------------------->
    <div class="socials">
        <div class="container d-flex social-content justify-content-center">
            <i class="bi bi-facebook text-white ms-5 me-2 my-auto display-1"></i>
            <i class="bi bi-tiktok text-white mx-2 my-auto display-1"></i>
            <i class="bi bi-envelope-at-fill text-white mx-2 my-auto display-1"></i>
            <p class="fw-bold display-5 mx-4 ps-4 my-auto text-white border-start border-2 border-white">
                Visit us and Get updates on our Social Media Platforms.
            </p>
        </div>
    </div>

    <!----- Foot-Nav ------------------------------------------------------------------------------>
    <div class="foot-nav">
        <div class="container">
            <div class="row">

                <!-- About -->
                <div class="col-md-5 pt-5 px-5">
                    <h1 class="fw-bold">About Us</h1>
                    <p class="mb-0 text-white-50">
                        Lyza Drugmart, a Sto. Tomas, Batangas-based pharmacy, dedicated in providing high-quality,
                        affordable healthcare products and services. Founded in 2021, our network underscores our
                        mission to enhance community well-being. We continue to expand our reach and services,
                        empowering individuals and families to achieve optimal health and wellness.
                    </p>

                    <!-- Socials and Gmail -->
                    <div class="d-flex">
                        <a class="link-offset-2 link-underline link-underline-opacity-0" href="#">
                            <i class="bi bi-facebook fs-3 me-3"></i>
                        </a>
                        <a class="link-offset-2 link-underline link-underline-opacity-0" href="#">
                            <i class="bi bi-tiktok fs-3 me-3"></i>
                        </a>
                        <a class="link-offset-2 link-underline link-underline-opacity-0" href="#">
                            <i class="bi bi-envelope-at-fill fs-3 me-3"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-md-3 pt-5 px-5">
                    <h1 class="fw-bold">Quick Links</h1>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50 fs-5" id="homeFooter">Home</a></li>
                        <li><a href="#" class="text-white-50 fs-5" id="productsFooter">Products</a></li>
                        <li><a href="#" class="text-white-50 fs-5" id="storeFooter">Store</a></li>
                        <li><a href="#" class="text-white-50 fs-5" id="aboutusFooter">About Us</a></li>
                    </ul>
                </div>

                <!-- Operations -->
                <div class="col-md-4 py-5 px-5 ">
                    <h2 class="fw-bold">Opening Hours</h1>
                        <p class="mb-3 text-white-50">
                            Mon-Sat, 8:00am to 8:00pm
                        </p>

                        <h2 class="fw-bold">Main Office</h1>
                            <p class="mb-3 text-white-50">
                                BLK 12 Lot 38, Mountainview Homes Subd., Brgy. San Miguel, Sto. Tomas, Batangas,
                                Philippines
                            </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "client/client_footer.php"; ?>