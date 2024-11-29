<script>
    function printStockHistory() {
        const branchName = "<?php echo $selectedBranch == '-- Select Branches --' || $selectedBranch == '' ? 'All Branch' : $selectedBranch; ?>";
        const histories = <?php echo json_encode($productArray); ?>;
        const printContainer = document.createElement('div');
        printContainer.style.display = 'none';
        document.body.appendChild(printContainer);

        printContainer.innerHTML = `
                <html>
                    <head>
                        <title>Print Product History</title>
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
                        <h3>${branchName} Product Report</h3>
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Branch Name</th>
                                    <th>Brand Name</th>
                                    <th>Generic Name</th>
                                    <th>Category</th>
                                    <th>Unit</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${histories.map(record => `
                                    <tr>
                                        <td>${record.branchName}</td>
                                        <td>${record.productName}</td>
                                        <td>${record.genericBrand}</td>
                                        <td>${record.productCategory}</td>
                                        <td>${record.productUnit}</td>
                                        <td>${record.productStock}</td>
                                        <td>${record.status}</td>
                                        <td>₱${record.productPrice}</td>
                                        <td>${record.createdAt}</td>
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

</script>