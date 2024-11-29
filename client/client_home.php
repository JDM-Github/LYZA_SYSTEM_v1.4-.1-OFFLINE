<!--- Homepage ------------------------------------------------------------------------------->
<div class="page-content">
    <div class="container">

        <!----- Banner ----->
        <div class="row">
            <!----- Banner Carousel ----->
            <div class="col-md-8">
                <div id="adsCarousel" class="custom-carousel carousel slide rounded-4 shadow" data-bs-ride="carousel">
                    <!----- Carousel Items ----->
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="1000">
                            <div class="card border-0 rounded-4">
                                <img src="img/banner-carousel1.png" class="d-block w-100 rounded-4 mx-auto" alt="">
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <div class="card border-0 rounded-4">
                                <img src="img/banner-carousel2.png" class="d-block w-100 rounded-4 mx-auto" alt="">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="card border-0 rounded-4">
                                <img src="img/banner-carousel3.png" class="d-block w-100 rounded-4 mx-auto" alt="">
                            </div>
                        </div>
                    </div>

                    <!----- Carousel Controls ----->
                    <button class="carousel-control-prev" type="button" data-bs-target="#adsCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#adsCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-md-4 my-auto">
                <div class="card shadow border-0 rounded-4 my-2">
                    <img src="img/banner-ad1.png" class="img-thumbnail rounded-4" alt="">
                </div>
                <div class="card shadow border-0 rounded-4 my-2">
                    <img src="img/banner-ad2.png" class="img-thumbnail rounded-4" alt="">
                </div>
            </div>
        </div>

        <hr>
        <h1 class="fw-bolder display-4 text-center my-5" style="color: var(--dark)">Explore by Category</h1>

        <!----- Categories ----->
        <div class="col-12">
            <div class="row gx-5 gy-2 justify-content-center mb-5">

                <!----- Medicine ----->
                <div class="col-sm-1">
                    <a page-target='home' href="category=Medicine" class="link-underline link-underline-opacity-0">
                        <div class="card shadow border-0 category-card rounded-4">
                            <img src="img/category_medicine.png" alt="" class="img-thumbnail border-0 rounded-top-4">
                            <h5 class="text-center my-3">Medicine</h5>
                        </div>
                    </a>
                </div>

                <!----- Supplement ----->
                <div class="col-sm-1">
                    <a page-target='home' href="category=Supplement" class="link-underline link-underline-opacity-0">
                        <div class="card shadow border-0 category-card rounded-4">
                            <img src="img/category_supplement.png" alt="" class="img-thumbnail border-0 rounded-top-4">
                            <h5 class="text-center my-3">Supplement</h5>
                        </div>
                    </a>
                </div>

                <!----- Personal Care ----->
                <div class="col-sm-1">
                    <a page-target='home' href="category=Personal%20Care"
                        class="link-underline link-underline-opacity-0">
                        <div class="card shadow border-0 category-card rounded-4">
                            <img src="img/category_care.png" alt="" class="img-thumbnail border-0 rounded-top-4">
                            <h5 class="text-center my-3">Personal Care</h5>
                        </div>
                    </a>
                </div>

                <!----- Contraceptive ----->
                <div class="col-sm-1">
                    <a page-target='home' href="category=Contraceptive" class="link-underline link-underline-opacity-0">
                        <div class="card shadow border-0 category-card rounded-4">
                            <img src="img/category_contraceptive.png" alt=""
                                class="img-thumbnail border-0 rounded-top-4">
                            <h5 class="text-center my-3">Contraceptive</h5>
                        </div>
                    </a>
                </div>

                <!----- Baby Essential ----->
                <div class="col-sm-1">
                    <a page-target='home' href="category=Baby%20Essential"
                        class="link-underline link-underline-opacity-0">
                        <div class="card shadow border-0 category-card rounded-4">
                            <img src="img/category_baby.png" alt="" class="img-thumbnail border-0 rounded-top-4">
                            <h5 class="text-center my-3">Baby Essential</h5>
                        </div>
                    </a>
                </div>

                <!----- More ----->
                <div class="col-sm-1">
                    <a page-target='home' href="category=all" class="link-underline link-underline-opacity-0">
                        <div class="card shadow border-0 category-card rounded-4">
                            <img src="img/category_more.png" alt="" class="img-thumbnail border-0 rounded-top-4">
                            <h5 class="text-center my-3">More</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <hr class="mt-5">
        <h1 class="fw-bolder display-4 text-center my-5" style="color: var(--dark)">Featured Items</h1>

        <!----- New Items and Best Sellers ----->
        <div class="featured-items">
            <div class="container bg-body-secondary rounded-5 p-4 d-flex justify-content-between">
                <h2 class="fw-bold my-auto ms-3" style="color: var(--dark);">
                    <i class="bi bi-stars fs-1"></i> Check this out
                </h2>

                <!----- Navigation | Featured Items ----->
                <ul class="nav nav-pills custom-nav-pills justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active rounded-pill fs-5 px-4 py-3" aria-current="page" href="#"
                            id="bestsellerToggler">Best Sellers <i class="bi bi-trophy-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rounded-pill fs-5 px-4 py-3" href="#" id="newproductToggler">
                            New Product <i class="bi bi-plus-square-dotted"></i></a>
                    </li>
                </ul>
            </div>

            <!----- Featured Items Row ----->
            <div class="item-grid overflow-x-hidden py-5" id="grid-content">

            </div>
        </div>
    </div>
</div>

<!----- Featured Items Row | Tab Switching ----->
<script>
    // Function AJAX
    function loadContent(url) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                $('#grid-content').html(response);
            },
            error: function () {
                $('#grid-content').html('<p>Error loading content.</p>');
            }
        });
    }

    $(document).ready(function () {
        // Best Sellers default
        loadContent('client/client_bestseller.php');

        // Handle Best Sellers tab click
        $('#bestsellerToggler').on('click', function (event) {
            event.preventDefault();
            // Switch tabs
            $('#bestsellerToggler').addClass('active');
            $('#newproductToggler').removeClass('active');
            // Load Best Sellers content
            loadContent('client/client_bestseller.php');
        });

        // Handle New Products tab click
        $('#newproductToggler').on('click', function (event) {
            event.preventDefault();
            // Switch tabs
            $('#newproductToggler').addClass('active');
            $('#bestsellerToggler').removeClass('active');
            // Load New Products content
            loadContent('client/client_newproduct.php');
        });
    });
</script>