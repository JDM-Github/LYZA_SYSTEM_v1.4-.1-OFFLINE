<!-- Total Revenue ----->
<?php
$total = RequestSQL::getAllRevenue($selectedGroup)->fetch_assoc()['total_price'];
$low = RequestSQL::getLowStockItems();
$oos = RequestSQL::getOutOfStockItems();
?>
<div class="card shadow p-3 custom-success-bg rounded border-0 me-3 flex-fill">
    <div class="d-flex justify-content-between">
        <h2 class="m-0 display-5 text-white"><strong>₱
                <?php echo $total ? number_format($total, 2) : 0 ?>
            </strong></h2>
        <strong><i class="bi bi-stars display-5 text-white"></i></strong>
    </div>
    <p class="m-0 text-white"><small>Total Revenue</small></p>
</div>

<!-- Low Stock ----->
<div class="card shadow p-3 custom-warning-bg rounded border-0 me-3 flex-fill">
    <div class="d-flex justify-content-between">
        <h2 class="m-0 display-5"><strong>
                <?php echo $low ?>
            </strong></h2>
        <strong><i class="bi bi-bag-plus-fill display-5"></i></i></strong>
    </div>
    <p class="m-0"><small>Total Low Stock Items</small></p>
</div>

<!-- Out of Stock ----->
<div class="card shadow p-3 custom-danger-bg rounded border-0 flex-fill">
    <div class="d-flex justify-content-between">
        <h2 class="m-0 display-5 text-white"><strong>
                <?php echo $oos ?>
            </strong></h2>
        <strong><i class="bi bi-bag-x-fill display-5 text-white"></i></strong>
    </div>
    <p class="m-0 text-white"><small>Total Out of Stock Items</small></p>
</div>