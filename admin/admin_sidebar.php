<div id="sidebar" class="card shadow bg-body-tertiary rounded border-0 ">
    <div class="p-3 custom-link-hover align-items-bottom">
        <!----- Dashboard ----->
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex" href="admin.php" id="dashboard-tab">
            <i class="bi bi-house-door-fill m-3"></i>
            <p class="my-3"></p>
        </a><br>

        <!----- Reports ----->
        <small><span class="text-muted mx-3 mb-0 p-0 d-flex "></span></small>
        <!----- Transactions ----->
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex" href="admin.php?page=transaction-report"
            id="transactions-tab">
            <i class="bi bi-file-earmark-text-fill m-3"></i>
            <p class="my-3"></p>
        </a>
        <!----- Stock History ----->
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex" href="admin.php?page=stock-report"
            id="stocks-tab">
            <i class="bi bi-bag-fill m-3"></i>
            <p class="my-3"></p>
        </a>
        <!----- Product Status ----->
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex" href="admin.php?page=product-report"
            id="products-tab">
            <i class="bi bi-cart-fill m-3"></i>
            <p class="my-3"></p>
        </a><br>

        <!----- Accounts ----->
        <small><span class="text-muted mx-3 mb-0 p-0 d-flex "></span></small>
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex" href="admin.php?page=accounts"
            id="accounts-tab">
            <i class="bi bi-people-fill m-3"></i>
            <p class="my-3"></p>
        </a>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentUrl = window.location.href;
        const links = document.querySelectorAll('#sidebar a');
        links.forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add('disabled');
                link.style.pointerEvents = 'none';
                link.style.color = 'gray';
                ed
            }
        });
    });
</script>

<style>
    .disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>