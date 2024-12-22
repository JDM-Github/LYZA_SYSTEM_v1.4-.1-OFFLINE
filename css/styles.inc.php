<style>
    /*======== Globals =======================*/

    :root {
        --green: #56ab91;
        --red: #EE6055;
        --base: #f2f2f2;
        --dark: #6c757d;
    }

    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Montserrat", sans-serif;
        background-color: var(--base);
        height: 100dvh;
        overflow: hidden;
        display: grid;
        grid-template-rows: auto 1fr auto;
    }

    header {
        position: fixed;
        width: 100%;
        z-index: 1000;
    }

    section {
        min-height: 77dvh;
    }

    html {
        font-size: 0.70rem;
    }

    .same-height-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        /* Makes all cards the same height */
    }


    /* Custom Modal Styles */
    .custom-modal2 {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        overflow: auto;
    }

    .custom-modal2 .custom-modal-content {
        background-color: #fff;
        margin: 10px auto;
        padding: 20px;
        width: 90%;
        max-width: 400px;
        border-radius: 8px;
        position: relative;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .custom-modal2 .custom-close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
    }

    .custom-modal2 .custom-close-btn:hover {
        color: red;
    }

    .custom-modal2 .custom-submit-btn {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .custom-modal2 .custom-submit-btn:hover {
        background-color: #0056b3;
    }



    /*======== Content =======================*/
    .forgot-class {
        cursor: pointer;
    }

    .forgot-class:hover {
        color: var(--green);
    }

    .heading-filler {
        width: 100%;
        height: 135px;
        border: 0;
        background-color: var(--dark);
    }

    /*---------- Foot Navigation ----------*/
    .foot-nav {
        position: relative;
        width: 100%;
        min-height: 250px;
        border: 0;
        background-color: var(--dark);
        color: var(--base);
    }

    .foot-nav a {
        color: var(--base);
    }

    /*---------- landing-copyright ----------*/
    .landing-copyright {
        position: relative;
        width: 100%;
        height: 200px;
        border: 0;
        background-color: var(--green);
    }

    /*---------- Navbar ----------*/
    .custom-nav-header {
        background-color: var(--red);
        width: 100%;
        height: 15px;
    }

    .custom-nameplate {
        align-content: center;
        align-items: center;
        padding: 15px 0 15px;
        height: 80px;
        background-color: var(--base);
    }

    .custom-navbar {
        background-color: var(--green);
        padding-left: auto;
        padding-right: auto;
        top: 95px;
        position: fixed;
        z-index: 999;
        width: 100%;
    }

    .custom-nav-item {
        color: var(--base);
        text-align: center;
        border-radius: 20px 20px 20px;
    }

    .custom-nav-item.active {
        background-color: var(--base);
        border-radius: 20px 20px 20px;
    }

    .custom-nav-item.active span {
        color: var(--green);
    }

    .custom-nav-item span:hover {
        color: var(--green);
    }

    .custom-nav-item:hover {
        background-color: var(--base);
        border-radius: 20px 20px 20px;
        transition: ease-in-out 0.2s;
    }

    /*======== Page Tabs =======================*/

    /*---------- Home Tab ----------*/
    .custom-carousel {
        /*-- Banner Carousel --*/
        max-width: 800px;
    }

    .custom-carousel img {
        max-width: 800px;
    }

    .banner-ads {
        margin-left: -70px;
    }

    .banner-ads img {
        min-width: 500px;
    }

    .category-card {
        /*-- Category card --*/
        min-width: 105px;
        min-height: 140px;
    }

    .category-card:hover {
        transform: scale(1.15);
        z-index: 500;
    }

    .category-card h5 {
        font-size: 0.98rem;
    }

    .custom-nav-pills .nav-item a {
        /*-- Featured Items --*/
        color: var(--dark);
        text-align: center;
    }

    .custom-nav-pills .nav-item a.active {
        background-color: var(--green);
    }

    .custom-nav-pills .nav-item a.active {
        color: var(--base);
    }

    .custom-nav-pills .nav-item a:hover {
        color: var(--green);
        font-weight: bolder;
    }

    .featured-card {
        max-height: 300px;
        min-height: 270px;
    }

    .socials {
        /*-- Socials --*/
        background-image: url(img/socials-bar.png);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .social-content {
        padding-top: 50px;
        padding-bottom: 50px;
    }

    /*---------- Products Tab ----------*/
    .custom-category-pills a {
        color: var(--dark)
    }

    .custom-category-pills a:hover {
        color: var(--green);
        font-weight: bolder;
    }

    .custom-category-pills .nav-link.active {
        background-color: var(--green);
        color: var(--base);
        border-radius: 20px;
    }

    /*---------- Stores Tab ----------*/

    .branch-1 {
        background-image: url(img/branch1-viewA.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top;
        width: 100%;
        height: 300px;
    }

    .branch-2 {
        background-image: url(img/branch2-view.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top;
        width: 100%;
        height: 300px;
    }

    /*---------- About Us Tab ----------*/
    .about-cover-photo {
        background-image: url(img/aboutus-cover.png);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        height: 250px;
        width: 100%;
        margin-top: -30px;
        opacity: 0.2;
    }

    /*=== Custom Global Buttons ================*/

    .custom-btn-success {
        background-color: var(--green);
        color: var(--base);
        border: 0;
    }

    .custom-btn-success:hover {
        color: var(--green);
        background-color: var(--base);
        font-weight: bold;
        border: 0;
    }

    .custom-btn-danger {
        background-color: var(--red);
        color: var(--base);
        border: 0;
    }

    .custom-btn-danger:hover {
        color: var(--red);
        background-color: var(--base);
        font-weight: bold;
        border: 0;
    }

    .custom-btn-secondary {
        background-color: var(--dark);
        color: var(--base);
        border: 0;
    }

    .custom-btn-secondary:hover {
        color: var(--dark);
        background-color: var(--base);
        font-weight: bold;
        border: 0;
    }

    .custom-btn-white {
        background-color: var(--base);
        color: var(--green);
        border: 0;
    }

    .custom-btn-white:hover {
        color: var(--base);
        background-color: var(--dark);
        font-weight: bold;
        border: 0;
    }

    .custom-btn-border {
        background-color: var(--base);
        color: var(--green);
        border: 1px;
        border-color: var(--green);
    }

    .custom-btn-border:hover {
        color: var(--base);
        background-color: var(--green);
        font-weight: bold;
        border: 1px;
        border-color: var(--green);
    }
</style>