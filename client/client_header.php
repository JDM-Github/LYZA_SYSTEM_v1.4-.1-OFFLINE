<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Lyza Drugmart</title>
    <link rel="icon" type="image" href="img/BoxLogo-1.png" sizes="16x16">
    <link rel="icon" type="image" href="img/BoxLogo-1.png" sizes="32x32">

    <!--- Montserrat Font ----->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <!--- Bootstrap ----->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="icons/bootstrap-icons.css">

    <!--- Custom CSS ----->
    <?php include "css/styles.inc.php"; ?>
    <link rel="stylesheet" href="css/modal.css">

    <!--- JQuery ----->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <header>
        <div class="custom-nav-header"><!-- Custom Header Line ----></div>

        <div class="custom-nameplate" id="navbar">
            <div class="container d-flex justify-content-between align-items-center">
                <!----- Logo/Brand ----->
                <div class="justify-content-start align-self-center">
                    <img class="align-self-start" src="img/BusinessName.png" alt="Lyza Drugmart" width="190"
                        height=""><br>
                    <span class="pt-0 fw-bold" style="color: var(--dark);">BRANDED & GENERIC MEDICINES</span>
                </div>

                <!----- Toggle Offcanvass | Login Form ----->
                <div class="align-content-center">
                    <button class="btn rounded-pill custom-btn-success py-2 px-3" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#login-form-offcanvass"
                        aria-controls="login-form-offcanvass">
                        LOG IN
                    </button>
                </div>
            </div>
        </div>

        <!----- Offcanvass Body | Login Form ----->
        <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="login-form-offcanvass"
            aria-labelledby="login-form-label">

            <div class="offcanvas-header mb-0 pb-0">
                <!----- Close Form ----->
                <button type="button" class="btn-close" id="login-form-offcanvass-button-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <!----- Login Form Body ----->
            <div class="offcanvas-body">
                <?php
                include "includes/login.inc.php";
                ?>
            </div>
        </div>

    </header>