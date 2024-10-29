<script>
    function printStockHistory() {
        const histories = <?php echo json_encode($historiesArray); ?>;
        if (<?php echo json_encode($histories->num_rows); ?> <= 0) {
            showToast("errorToast");
            return;
        }
        const printContainer = document.createElement('div');
        printContainer.style.display = 'none';
        document.body.appendChild(printContainer);
        printContainer.innerHTML = `
        <html>
            <head>
                <title>Print Stock History</title>
                <style>
                    .custom-table { width: 100%; border-collapse: collapse; }
                    .custom-table th, .custom-table td { border: 1px solid #ddd; padding: 4px; text-align: center; }
                    .custom-table th { background-color: #f2f2f2; }
                </style>
            </head>
            <body>
                <h1>Stock History (${<?php echo strtoupper(json_encode($selectedGroup)); ?>})</h1>
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Staff ID</th>
                            <th>Full Name</th>
                            <th>Quantity</th>
                            <th>Product Name</th>
                            <th>Branch Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${histories.map(record => `
                            <tr>
                                <td>${record.id}</td>
                                <td>${record.staffId}</td>
                                <td>${record.firstName} ${record.lastName}</td>
                                <td>${record.quantity}</td>
                                <td>${record.productName}</td>
                                <td>${record.branchName}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>
            </body>
        </html>
    `;

        const printWindow = window.open('', '_blank');
        printWindow.document.write(printContainer.innerHTML);
        printWindow.document.close();
        printWindow.print();
        printWindow.close();
    }

    function showToast(toastId) {
        var toast = document.getElementById(toastId);
        toast.style.display = 'block';
        setTimeout(function () {
            toast.style.display = 'none';
        }, 3000);
    }
</script>