<?php
$total = RequestSQL::getAllRevenue($selectedGroup)->fetch_assoc()['total_price'];
$oldTotal = RequestSQL::getAllRevenue($selectedGroup, true)->fetch_assoc()['total_price'];

$increase = ($total ? number_format($total, 2) : 0) >= ($oldTotal ? number_format($oldTotal, 2) : 0);

?>
<!-- Total Revenue ----->
<div class="card shadow p-3 custom-success-bg rounded border-0 me-3 flex-fill">
    <div class="d-flex justify-content-between">
        <h2 class="m-0 display-5 text-white">
            <strong>₱
                <?php echo $total ? number_format($total, 2) : 0 ?>
            </strong>

            <!-- Comparison between previous and present month/year
                depending on the filter selected ----->

            <i class="bi bi-chevron-double-up opacity-<?php echo $increase ? '100' : '50' ?> fs-3 pb-2"></i>
            <i class="bi bi-chevron-double-down opacity-<?php echo $increase ? '50' : '100' ?> fs-3 pb-2"></i>
        </h2>
        <strong><i class="bi bi-stars display-5 text-white"></i></strong>
    </div>
    <p class="m-0 text-white"><small>Total Revenue</small></p>
</div>

<div class="card shadow p-3 bg-body-tertiary rounded border-0" style="flex: 1;">
    <p class="fw-bold border-start border-3 border-success ps-4">Latest Transactions</p>

    <?php
    $data = RequestSQL::getAllAdminLatestTransaction($selectedGroup);
    $transactions = $data['result'];
    $currentPage = $data['page'];
    $totalPages = $data['total'];
    AdminClass::loadAllLatestTransaction($transactions);
    BranchClass::loadPaginator($currentPage, $totalPages, 'admin-transactions-page');
    ?>

</div>