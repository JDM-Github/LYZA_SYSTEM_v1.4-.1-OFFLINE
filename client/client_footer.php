<!-- Banner-Foot --------------------------------------------------------------------------------------------------------->

<footer class="landing-copyright pt-2">
    <div class="container d-flex justify-content-center">
        <img src="img/LyzaVectorLogoWhite.png" class="me-3 align-self-center" alt="Lyza Drugmart" width="32"
            height="32">
        <span class="text-white align-self-center"><small>Copyright © 2024 Lyza Drugmart. All Rights
                Reserved.</small></span>
    </div>
</footer>

<!--- AJAX Script | Tab switching ----->
<script>
    $(document).ready(function () {
        $('#content').load('client/client_products.php', function () {
            $('#content').load('client/client_home.php', function () {
                $('#content').on('click', 'a[page-target="home"]', function (e) {
                    e.preventDefault();
                    var href = $(this).attr('href');
                    $('#content').load(`client/client_products.php?${href}`, function () {
                        setActiveTab($('#productsTab'));
                    });
                });
            });
        });

        $('#homeTab').click(function (e) {
            e.preventDefault();
            $('#content').load('client/client_home.php', function () {
                $('#content').on('click', 'a[page-target="home"]', function (e) {
                    e.preventDefault();
                    var href = $(this).attr('href');
                    $('#content').load(`client/client_products.php?${href}`, function () {
                        setActiveTab($('#productsTab'));
                    });
                });
            });
            setActiveTab($(this));
        });
        $('#productsTab').click(function (e) {
            e.preventDefault();
            $('#content').load('client/client_products.php', function () {
                $('#content').on('click', 'a[page-target="products"]', function (e) {
                    e.preventDefault();
                    var href = $(this).attr('href');
                    $('#content').load(`client/client_products.php?${href}`);
                });

                $('#content').on('submit', 'form', function (e) {
                    e.preventDefault();
                    var searchValue = $(this).find('input[name="search-value"]').val();
                    $('#content').load(`client/client_products.php?search-value=${searchValue}`);
                });
            });
            setActiveTab($(this));
        });

        $('#storeTab').click(function (e) {
            e.preventDefault();
            $('#content').load('client/client_store.php');
            setActiveTab($(this));
        });

        $('#aboutusTab').click(function (e) {
            e.preventDefault();
            $('#content').load('client/client_aboutus.php');
            setActiveTab($(this));
        });

        // Footer Quick Links Switching
        $('#homeFooter').click(function (e) {
            e.preventDefault();
            $('#content').load('client/client_home.php');
        });

        $('#productsFooter').click(function (e) {
            e.preventDefault();
            $('#content').load('client/client_products.php');
        });

        $('#storeFooter').click(function (e) {
            e.preventDefault();
            $('#content').load('client/client_store.php');
        });

        $('#aboutusFooter').click(function (e) {
            e.preventDefault();
            $('#content').load('client/client_aboutus.php');
        });

        // Active Class Toggler for Navbar
        function setActiveTab(currentTab) {
            $('.navbar-nav .nav-link').removeClass('active');
            currentTab.addClass('active');
        }
    });
</script>

<!--- Navbar Collapse Toggler ----->
<script>
    // Collapse the navbar when a nav-item is clicked
    document.querySelectorAll('.nav-link').forEach(item => {
        item.addEventListener('click', function () {
            const navbarCollapse = document.getElementById('landingMenu');
            if (navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
                const toggler = document.querySelector('.navbar-toggler');
                toggler.setAttribute('aria-expanded', 'false');
            }
        });
    });

    // Collapse the navbar when the toggler button is clicked
    document.querySelector('.navbar-toggler').addEventListener('click', function () {
        const navbarCollapse = document.getElementById('landingMenu');
        navbarCollapse.classList.toggle('show');
        const expanded = navbarCollapse.classList.contains('show');
        this.setAttribute('aria-expanded', expanded);
    });
</script>

<!--- See Password ----->
<script>
    function togglePassword() {
        var passwordField = document.getElementById("pass");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>

<!--- Bootstrap JS ----->
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>