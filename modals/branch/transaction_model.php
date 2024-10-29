<div class="modal fade" id="productDetailsModal" tabindex="-1" aria-labelledby="productDetailsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold border-start border-3 border-success px-4 mb-3 me-5 align-content-center"
                    id="productDetailsModalLabel">
                    <b>Transaction Details</b>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="card card shadow p-2 bg-body-tertiary rounded border-1">
                <div class="modal-body">
                    <table class='table table-sm table-hover' id="productDetailsTable">
                        <thead>
                            <tr>
                                <th class="ps-4"><small><span class="fw-bold">Branch Name</span></small></th>
                                <th class=""><small><span class="fw-bold">Product Name</span></small></th>
                                <th class=""><small><span class="fw-bold">Quantity</span></small></th>
                                <th class=""><small><span class="fw-bold">Price</span></small></th>
                                <th class=""><small><span class="fw-bold">Total Price</span></small></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function showDetails(button) {
        var productOrderedList = document.getElementById('product_ordered_list').value;
        var products = JSON.parse(productOrderedList);
        var productIds = products.id;

        alert(productIds);

        fetch("backend/fetch/transaction_details.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "productOrderedIds=" + JSON.stringify(productIds)
        })
            .then(response => response.text())
            .then(data => {
                document.querySelector('#productDetailsModal tbody').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>