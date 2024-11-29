<?php
$currentUrl = $_SERVER['REQUEST_URI'];
$_SESSION['current_url'] = $currentUrl;
?>
<!-- Item Browser -->
<div class="content ms-3 flex-fill content-section active" id="pos">

    <!-- Search / Category Navigation -->

    <div class=" card shadow p-2 bg-body-tertiary rounded border-0 mb-3 ">
        <form action="" method="post">
            <div class="input-group input-group border-0 align-content-center p-2 pb-0">
                <p class=" fw-bold border-start border-3 border-success px-4 mb-3 me-5 align-content-center">
                    Point of Sale
                </p>

                <?php if (RequestSQL::getSession('online')) { ?>
                    <?php
                    $branch = RequestSQL::getSession('branch-pos');
                    $sessionSearch = '';
                    if ($branch)
                        $sessionSearch = $branch['search'];
                    $searchValue = isset($_POST['search-value']) ? $_POST['search-value'] : $sessionSearch;
                    ?>

                    <input type="text" class="form-control rounded-start mb-3" placeholder="Search..." name='search-value'
                        aria-describedby="search-button-product" value="<?php echo $searchValue ?>">

                    <button class="btn btn-sm rounded-end border px-3 mb-3 me-3" type="submit" id="search-button-product">
                        <i class="bi bi-search"></i>
                    </button>
                <? } ?>

            </div>
        </form>
    </div>

    <!-- Product Grid -->


    <div class="card card shadow p-3 bg-body-tertiary rounded border-0">
        <div class="input-group input-group-sm border-0 align-content-center">

            <p class=" fw-bold border-start border-3 border-success px-4 me-5 align-content-center">
                Products
            </p>

        </div>

        <div>
            <?php
            $data = RequestSQL::getAllProduct(
                'branch-pos',
                null,
                null,
                $searchValue,
                null,
                RequestSQL::getSession('account')['branchName']
            );
            $products = $data['result'];
            $currentPage = $data['page'];
            $totalPages = $data['total'];
            BranchClass::loadAllPosProduct($products);
            ?>
            <div class="d-flex justify-content-between">
                <?php
                BranchClass::loadPaginator($currentPage, $totalPages, 'branch-pos-page');
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Cart and Payment -------------------------------------------------------------------------->

<div class="card shadow p-3 bg-body-tertiary rounded border-0 ms-3 custom-cart-payment content-section active" id="pos">
    <div class=" d-flex justify-content-between">
        <p class=" fw-bold border-start border-3 border-success px-4 me-5 mb-0">
            Item Cart
        </p>

        <?php
        if (isset($_POST['reset-cart']))
            RequestSQL::setSession('branch-cart-product', []);
        ?>
        <form method="POST" action="">
            <button class="badge bg-secondary p-2" name="reset-cart">Reset</button>
        </form>
    </div>

    <!-- Item list on Cart-->
    <div class="card p-2 mt-3 rounded border-0">
        <table class="table table-borderless">
            <tr>
                <th class="align-content-center">
                    <small><span class="text-muted">Item/s</span></small>
                </th>
                <th class="align-content-center">
                    <small><span class="text-muted">Qty.</span></small>
                </th>
                <th class="align-content-center">
                    <small><span class="text-muted">Amount</span></small>
                </th>
            </tr>


            <?php $branchProducts = RequestSQL::getSession('branch-cart-product'); ?>
            <?php if ($branchProducts): ?>
                <?php foreach ($branchProducts as $branchProd): ?>
                    <tr>
                        <td class="align-content-center">
                            <small><span><?php echo htmlspecialchars($branchProd['product_name']); ?></span></small>
                        </td>
                        <td class="align-content-center">
                            <form method="POST" action="backend/redirector.php">
                                <input type='hidden' name='type' value='branch-add-cart'>
                                <input type="hidden" name="product_id"
                                    value="<?php echo htmlspecialchars($branchProd['product_id']); ?>">
                                <input type="hidden" name="branch_id"
                                    value="<?php echo htmlspecialchars($branchProd['branch_id']); ?>">
                                <input type="hidden" name="productBarcode"
                                    value="<?php echo htmlspecialchars($branchProd['product_barcode']); ?>">
                                <input type="hidden" name="product_name"
                                    value="<?php echo htmlspecialchars($branchProd['product_name']); ?>">
                                <input type="hidden" name="product_price"
                                    value="<?php echo htmlspecialchars($branchProd['product_price']); ?>">
                                <input type="hidden" name="product_stock"
                                    value="<?php echo htmlspecialchars($branchProd['product_stock']); ?>">

                                <button class="btn px-2 border" type="submit" name="action" value="decrement">-</button>
                                <small><span
                                        id="product-quantity"><?php echo htmlspecialchars($branchProd['quantity']); ?></span></small>
                                <button class="btn px-2 border" type="submit" name="action" value="increment">+</button>
                            </form>
                        </td>
                        <td class="align-content-center">
                            <small><span id="total-price-<?php echo htmlspecialchars($branchProd['product_id']); ?>">₱
                                    <?php echo number_format($branchProd['product_price'] * $branchProd['quantity'], 2); ?></span></small>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>


        </table>
    </div>

    <div class="mt-3">

        <div class="d-flex align-content-center rounded p-2 custom-total mb-2">
            <?php
            $total = 0;
            if ($branchProducts) {
                foreach ($branchProducts as $product)
                    $total += $product['product_price'] * $product['quantity'];
            }
            ?>
            <span class="py-0 flex-fill fs-4 text-white">Total:</span>
            <span class="fw-bold flex-fill fs-4 ms-0 ps-0 text-end text-white" id="top-total">
                ₱ <?php echo number_format($total, 2); ?></span>
            <div id="total-amount" style="display: none"><?php echo $total; ?></div>
        </div>

        <div class="input-group align-content-center">
            <label class="form-label text-muted me-5 ps-2 pt-2 " for="cash-input">Cash Received:</label>
            <span class="input-group-text border-0">₱</span>
            <input type="number" min="0" class="form-control rounded pt-2 mb-2 text-end" placeholder="00.00"
                id="cash-input">
        </div>

        <div class="d-flex justify-content-between">
            <span class="text-muted ps-2">Discounted Total:</span>
            <span id="discounted-total" class="text-muted text-end pe-2 mb-3">₱ 00.00</span>
        </div>

        <div class="d-flex justify-content-between">
            <span class="text-muted ps-2">Change:</span>
            <span id="change-display" class="text-muted text-end pe-2 mb-3">₱ 00.00</span>
        </div>


        <div id="idNumberField" class="mt-3 mb-2" style="display: none;">
            <label for="idNumber" class="form-label">Enter ID Number:</label>
            <input type="number" class="form-control" id="idNumber" placeholder="Enter your ID number" required>
        </div>

        <div class="p-3 bg-body-secondary rounded-4">
            <!-- Senior Citizen Discount (20% less per item) -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="discount" id="seniorDiscount" value="senior">
                <label class="form-check-label" for="seniorDiscount">
                    Senior Citizen Discount
                </label>
            </div>
            <!-- PWD Discount (20% less per item) -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="discount" id="pwdDiscount" value="pwd">
                <label class="form-check-label" for="pwdDiscount">
                    Person with Disability Discount
                </label>
            </div>
            <!-- Senior & PWD Discount -->
            <div class="form-check">
                <input class="form-check-input" type="radio" name="discount" id="bothDiscount" value="both">
                <label class="form-check-label" for="bothDiscount">
                    Senior & PWD Discount
                </label>
            </div>
        </div>

        <div class="justify-content-center d-flex mt-3">
            <form method="POST" action="backend/redirector.php" onsubmit="return validateTransaction()">
                <input type="hidden" name="type" value="branch-add-transaction">
                <input type="hidden" id="total-input" name="total" value="0">
                <input type="hidden" id="received-input" name="received" value="0">
                <input type="hidden" id="change-input" name="change" value="0">
                <input type="hidden" id="is-senior" name="is-senior" value="0">
                <input type="hidden" id="is-pwd" name="is-pwd" value="0">
                <button class="btn flex-fill rounded border-1 custom-receipt-btn py-2 fs-4 px-5" type="submit">Save
                    Order</button>
            </form>
        </div>

    </div>
</div>

<div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
    aria-atomic="true" style="position: absolute; top: 20px; right: 20px; display: none;">
    <div class="d-flex">
        <div class="toast-body">Insufficient Cash Received!</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" aria-label="Close"
            onclick="closeToast('errorToast')"></button>
    </div>
</div>


<script>
    document.addEventListener('input', function () {
        // alert('DETECT');
    });
    document.addEventListener("DOMContentLoaded", function () {
        var alert = document.getElementById('message-alert');
        if (alert) {
            setTimeout(function () {
                alert.style.display = 'none';
            }, 3000);
        }
    });

    function updateHiddenInputs() {

        const originalTotalAmount = parseFloat(document.getElementById('total-amount').innerText.replace(/[₱\s,]/g, '')) || 0;
        const cashReceived = parseFloat(document.getElementById('cash-input').value) || 0;
        const seniorDiscount = document.getElementById('seniorDiscount').checked;
        const pwdDiscount = document.getElementById('pwdDiscount').checked;
        const seniorPwdDiscount = document.getElementById('bothDiscount').checked;

        const seniorDiscountRate = 0.20;
        const pwdDiscountRate = 0.20;

        let totalAmount = originalTotalAmount;
        let discountedTotal = 0;
        if (seniorDiscount || seniorPwdDiscount) {
            totalAmount -= originalTotalAmount * seniorDiscountRate;
            discountedTotal += originalTotalAmount * seniorDiscountRate;
        }
        else if (pwdDiscount || seniorPwdDiscount) {
            totalAmount -= originalTotalAmount * pwdDiscountRate;
            discountedTotal += originalTotalAmount * pwdDiscountRate;
        }

        const change = cashReceived - totalAmount;
        document.getElementById('total-input').value = totalAmount.toFixed(2);
        document.getElementById('received-input').value = cashReceived.toFixed(2);
        document.getElementById('change-input').value = change.toFixed(2);
        document.getElementById('is-pwd').value = pwdDiscount || seniorPwdDiscount ? "1" : "0";
        document.getElementById('is-senior').value = seniorDiscount || seniorPwdDiscount ? "1" : '0';
    }

    document.getElementById('cash-input').addEventListener('input', calculateChange);
    document.getElementById('seniorDiscount').addEventListener('change', calculateChange);
    document.getElementById('pwdDiscount').addEventListener('change', calculateChange);
    document.getElementById('bothDiscount').addEventListener('change', calculateChange);

    function calculateChange() {

        const cashReceived = parseFloat(document.getElementById('cash-input').value) || 0;
        if (cashReceived < 0) {
            document.getElementById('cash-input').value = '';
        }
        const originalTotalAmount = parseFloat(document.getElementById('total-amount').innerText) || 0;
        const seniorDiscount = document.getElementById('seniorDiscount').checked;
        const pwdDiscount = document.getElementById('pwdDiscount').checked;
        const seniorPwdDiscount = document.getElementById('bothDiscount').checked;

        const seniorDiscountRate = 0.20;
        const pwdDiscountRate = 0.20;

        let totalAmount = originalTotalAmount;
        let discountedTotal = 0;
        if (seniorDiscount || seniorPwdDiscount) {
            totalAmount -= originalTotalAmount * seniorDiscountRate;
            discountedTotal += originalTotalAmount * seniorDiscountRate;
            document.getElementById('idNumberField').style.display = 'block';
        }
        else if (pwdDiscount || seniorPwdDiscount) {
            totalAmount -= originalTotalAmount * pwdDiscountRate;
            discountedTotal += originalTotalAmount * pwdDiscountRate;
            document.getElementById('idNumberField').style.display = 'block';
        }

        const change = cashReceived - totalAmount;
        document.getElementById('top-total').innerText = "₱ " + totalAmount.toFixed(2);
        document.getElementById('change-display').innerText = '₱ ' + change.toFixed(2);
        document.getElementById('discounted-total').innerText = '₱ ' + discountedTotal.toFixed(2);
        updateHiddenInputs();
    }

    function clearInput() {
        document.getElementById('cash-input').value = '';
        calculateChange();
    }

    function validateTransaction() {

        const total = parseFloat(document.getElementById('total-amount').innerText.replace(/[₱\s,]/g, '')) || 0;
        const received = parseFloat(document.getElementById('cash-input').value) || 0;

        const seniorDiscount = document.getElementById('seniorDiscount').checked;
        const pwdDiscount = document.getElementById('pwdDiscount').checked;
        const seniorPwdDiscount = document.getElementById('bothDiscount').checked;

        let discount = 1;
        if (seniorDiscount || seniorPwdDiscount || seniorPwdDiscount) {
            discount = 0.8;
        }
        if (received < (total * discount)) {
            showToast('errorToast');
            return false;
        }
        return true;
    }

    function showToast(toastId) {
        var toast = document.getElementById(toastId);
        toast.style.display = 'block';
        setTimeout(function () {
            toast.style.display = 'none';
        }, 3000);
    }

    function closeToast(toastId) {
        document.getElementById(toastId).style.display = 'none';
    }
</script>