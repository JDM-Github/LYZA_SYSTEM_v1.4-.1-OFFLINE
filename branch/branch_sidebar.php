<div id="sidebar" class="card shadow bg-body-tertiary rounded border-0 ">
    <div class="p-2 custom-link-hover justify-content-center my-5">
        <!-- Point of Sale -->
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex justify-content-center" href="branch.php"
            id="pos-tab">
            <i class="bi bi-house-door-fill fs-4 py-3 px-4"></i>
        </a>

        <!-- Transactions -->
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex justify-content-center"
            href="branch.php?page=transactions" id="transaction-branch-tab">
            <i class="bi bi-file-earmark-text-fill fs-4 py-3 px-4"></i>
        </a>

        <!-- <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex justify-content-center"
            href="branch.php?page=counts" id="transaction-branch-tab">
            <i class="bi bi-boxes fs-4 py-3 px-4"></i>
        </a> -->
        <!-- Products -->
        <a class="link-offset-2 link-underline link-underline-opacity-0 d-flex justify-content-center"
            href="branch.php?page=stocks" id="stock-branch-tab">
            <i class="bi bi-cart-fill fs-4 py-3 px-4"></i>
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