<?php
$stockHistory = RequestSQL::getAllStockHistories();
$count = RequestSQL::getAllProductExpired($stockHistory);
$oos = RequestSQL::getOutOfStockItems();
?>
<!-- Low Stock ----->
<div class="card shadow p-3 custom-warning-bg rounded border-0 me-3 flex-fill">

    <!-- Items to Expire either Next Month or Next Year
        depending on the selected date filter above ----->
    <div class="d-flex justify-content-between">
        <h2 class="m-0 display-5"><strong>
                <?php echo $count ?>
            </strong></h2>
        <strong><i class="bi bi-bag-plus-fill display-5"></i></i></strong>
    </div>
    <p class="m-0"><small>Items to Expire</small></p>
</div>

<!-- Out of Stock ----->
<div class="card shadow p-3 custom-danger-bg rounded border-0 flex-fill">

    <!-- Out of Stock Items either This Month or This Year
        depending on the selected date filter above ----->
    <div class="d-flex justify-content-between">
        <h2 class="m-0 display-5 text-white"><strong>
                <?php echo $oos ?>
            </strong></h2>
        <strong><i class="bi bi-bag-x-fill display-5 text-white"></i></strong>
    </div>
    <p class="m-0 text-white"><small>Total Out of Stock Items</small></p>
</div>