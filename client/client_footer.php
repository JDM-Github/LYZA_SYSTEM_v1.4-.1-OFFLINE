<footer class="banner-foot pt-2">
    <div class="container d-flex justify-content-between">
        <div class="d-flex">
            <img src="img/LyzaVectorLogoWhite.png" class="me-3 align-self-center" alt="Lyza Drugmart" width="32"
                height="32">
            <span class="text-white align-self-center"><small>Copyright © 2024 Lyza Drugmart. All Rights
                    Reserved.</small></span>
        </div>

        <div class="d-flex">
            <i class="bi bi-telephone-fill text-white align-self-center me-3"></i>
            <small>
                <span class="badge m-0 border border-light text-white">0933-320-4510</span>
                <span class="badge m-0 text-bg-light text-success">096-3340-5214</span>
            </small>
        </div>
    </div>
</footer>

<!--- AJAX Script ----->
<script>
    $(document).ready(function () {
        // Category filter click event
        $('.category-pill').on('click', function (e) {
            e.preventDefault();
            $('.category-pill').removeClass('active');
            $(this).addClass('active');
            filterProducts(); // Call the function to filter products
        });

        // Search button click event
        $('#search-button-home').on('click', function () {
            filterProducts(); // Call the function to filter products
        });

        // Enter key press event on the search input field
        $('#search-input').on('keypress', function (e) {
            if (e.which == 13) { // 13 is the Enter key code
                filterProducts(); // Trigger the search when "Enter" is pressed
            }
        });

        // Function to filter products based on selected category and search term
        function filterProducts() {
            var selectedCategory = $('.category-pill.active').attr('data-category'); // Get selected category
            var searchTerm = $('#search-input').val(); // Get search term from the search input

            $.ajax({
                url: 'get_products.php', // Call to the PHP script
                method: 'POST', // Use POST method
                data: {
                    category: selectedCategory,
                    searchTerm: searchTerm // Send category and search term to PHP
                },
                dataType: 'json',
                success: function (response) {
                    $('#product-grid').empty(); // Clear existing products

                    // Check if there are any products in the response
                    if (response.length > 0) {
                        // Loop through the response and generate product cards
                        $.each(response, function (index, product) {
                            var productCard = `
                            <div class="col-md-3">
                                <div class="card shadow bg-body-tertiary rounded border-0">
                                    <img src="img/${product.image_path}" class="card-img-top rounded" height="250" width="auto" alt="${product.product_name}">
                                    <div class="card-body">
                                        <span class="badge text-bg-secondary p-1 mb-1">${product.category}</span>
                                        <p class="m-0">${product.product_name}</p>
                                        <div class="d-flex justify-content-between">
                                            <p class="fw-bold m-0">₱${product.price}</p>
                                            <p class="m-0">${product.stock} item/s</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                            $('#product-grid').append(productCard); // Append each product to the grid
                        });
                    } else {
                        // Display message if no products are found
                        $('#product-grid').append('<p>No products found.</p>');
                    }
                }
            });
        }
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>