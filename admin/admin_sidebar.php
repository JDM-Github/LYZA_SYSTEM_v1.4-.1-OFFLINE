<div id="sidebar" class="card shadow bg-body-tertiary rounded border-0 ">
    <div class="p-2 custom-link-hover justify-content-center my-5">
        <!----- Dashboard ----->
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex justify-content-center" href="admin.php"
            id="dashboard-tab">
            <i class="bi bi-house-door-fill fs-4 py-3 px-4"></i>
        </a><br>

        <!----- Reports ----->
        <small><span class="text-muted mx-3 mb-0 p-0 d-flex "></span></small>
        <!----- Transactions ----->
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex justify-content-center"
            href="admin.php?page=transaction-report" id="transactions-tab">
            <i class="bi bi-file-earmark-text-fill fs-4 py-3 px-4"></i>
        </a>
        <!----- Stock History ----->
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex justify-content-center"
            href="admin.php?page=stock-report" id="stocks-tab">
            <i class="bi bi-bag-fill fs-4 py-3 px-4"></i>
        </a>
        <!----- Physical Count Status ----->
        <!-- <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex justify-content-center"
            href="admin.php?page=physical-count" id="products-tab">
            <i class="bi bi-boxes fs-4 py-3 px-4"></i>
        </a><br> -->
        <!----- Product Status ----->
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex justify-content-center"
            href="admin.php?page=product-report" id="products-tab">
            <i class="bi bi-cart-fill fs-4 py-3 px-4"></i>
        </a><br>

        <!----- Accounts ----->
        <small><span class="text-muted mx-3 mb-0 p-0 d-flex "></span></small>
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex justify-content-center"
            href="admin.php?page=accounts" id="accounts-tab">
            <i class="bi bi-people-fill fs-4 py-3 px-4"></i>
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