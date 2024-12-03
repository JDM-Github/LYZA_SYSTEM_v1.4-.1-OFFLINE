<?php
$stockHistory = RequestSQL::getAllStockHistories();
$expiringProducts = RequestSQL::getExpiringProducts($stockHistory);
$count = count($expiringProducts);
$oosProducts = RequestSQL::getOutOfStockItems();
?>
<!-- Low Stock ----->
<div class="card shadow p-3 custom-warning-bg rounded border-0 me-3 flex-fill" data-bs-toggle="modal"
    data-bs-target="#expiringProductsModal" style="cursor: pointer;">
    <div class="d-flex justify-content-between">
        <h2 class="m-0 display-5"><strong>
                <?php echo $count; ?>
            </strong></h2>
        <strong><i class="bi bi-bag-plus-fill display-5"></i></strong>
    </div>
    <p class="m-0"><small>Items to Expire</small></p>
</div>


<div class="modal fade" id="expiringProductsModal" tabindex="-1" aria-labelledby="expiringProductsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="expiringProductsModalLabel">Expiring Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if (!empty($expiringProducts)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Stock ID</th>
                            <th>Product Name</th>
                            <th>Branch</th>
                            <th>Expiration Date</th>
                            <th>Remaining Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($expiringProducts as $product): ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($product['stockHistoryId']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($product['productName']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($product['branchName']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($product['expirationDate']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($product['remainingStock']); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p>No expiring products found.</p>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="card shadow p-3 custom-danger-bg rounded border-0 flex-fill" data-bs-toggle="modal"
    data-bs-target="#outOfStockModal" style="cursor: pointer;">
    <div class="d-flex justify-content-between">
        <h2 class="m-0 display-5 text-white"><strong>
                <?php echo count($oosProducts); ?>
            </strong></h2>
        <strong><i class="bi bi-bag-x-fill display-5 text-white"></i></strong>
    </div>
    <p class="m-0 text-white"><small>Total Out of Stock Items</small></p>
</div>

<div class="modal fade" id="outOfStockModal" tabindex="-1" aria-labelledby="outOfStockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="outOfStockModalLabel">Out of Stock Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Branch</th>
                            <th>Unit</th>
                            <th>Barcode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($oosProducts as $product): ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($product['productName']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($product['productCategory']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($product['branchName']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($product['productUnit']); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($product['barCode']); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>