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
@media print {
    @page {
        size: auto;
        margin: 10mm;
    }

    h3 {
        margin: 0;
        padding: 0;
    }

    .custom-table {
        width: 100%;
        font-size: 14px;
        margin-top: 10px;
        page-break-before: auto;
    }

    .custom-table th, .custom-table td {
        padding: 5px 15px;
        text-align: left;
    }

    .custom-table {
        border: 2px solid #333;
    }

    body {
        font-size: 14px;
        font-family: 'Helvetica', 'Arial', sans-serif;
    }

    .no-print {
        display: none;
    }

    .custom-table tbody tr:hover {
        background-color: transparent;
    }
}
    </style>
            </head>
            <body>
                <h3>Stock History</h3>
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