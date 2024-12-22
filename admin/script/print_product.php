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
    border-collapse: collapse; /* Ensures borders between cells are rendered */
    border: 2px solid #333; /* Table border */
}

.custom-table th, .custom-table td {
    padding: 5px 15px;
    text-align: left;
    border: 1px solid #333; /* Borders for each cell */
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

    .report-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }

        .info {
            max-width: 50%;
            display: flex;
            flex-direction: column;
        }

        .info p {
            margin: 5px 0;
            
        }

        .logo img {
            max-width: 300px;
            height: auto;
        }

        .summary-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .summary-table th,
        .summary-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .summary-table th {
            text-align: center;
        }

        .summary-table td:last-child {
            text-align: right;
        }

                        </style>
                    </head>
                    <body>
                        <h3>Product Status Report</h3>
                        <div class="report-container">
                            <div class="info" style="display: flex; flex-wrap: wrap;">
    <p style="margin-right: 20px;"><strong>Business:</strong> Lyza Drugmart</p>
    <?php
    if (isset($branchTarget) && isset($userName)) {
        $userNameDisplay = isset($userName) ? htmlspecialchars($userName) : 'Unknown';

        echo "<p><strong>Branch:</strong> " . htmlspecialchars($branchTarget) . "</p>";
        echo "<p><strong>Prepared By:</strong> " . $userNameDisplay . "</p>";
    }
    ?>
    <p style="margin-right: 20px;"><strong>Month:</strong> ${new Date().toLocaleString('default', { month: 'long', year: 'numeric' })}</p>
    <p style="margin-right: 20px;"><strong>Week:</strong> ${(() => {
                const startOfWeek = new Date();
                startOfWeek.setDate(startOfWeek.getDate() - startOfWeek.getDay());
                return startOfWeek.toISOString().split('T')[0];
            })()}</p>
    <p><strong>Print Date:</strong> ${new Date().toISOString().split('T')[0]}</p>
</div>


                            <div class="logo">
                                <img src="https://res.cloudinary.com/djheiqm47/image/upload/v1733289561/BusinessName_t78q8i.png" alt="Logo">
                            </div>
                        </div>
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Branch Name</th>
                                    <th>Brand Name</th>
                                    <th>Generic Name</th>
                                    <th>Category</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th>Physical Count</th>
                                    <th>Disperancy</th>
                                    <th>Investigation</th>
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
                                        <td>₱${record.productPrice}</td>
                                        <td>${record.productStock}</td>
                                        <td>${record.status}</td>
                                        <td>${record.physicalCount}</td>
                                        <td>${record.productStock - record.physicalCount}</td>
                                        <td>${record.investigation}</td>
                                        <td>${record.createdAt}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                        <table class="summary-table">
    <thead>
        <tr>
            <th>Summary</th>
            <th>Critical</th>
            <th>Out of Stock</th>
        </tr>
    </thead>
    <tbody>
        ${(() => {
                const stockSummary = histories.reduce((acc, record) => {
                    const branch = record.branchName;
                    const stock = parseInt(record.productStock);
                    const isCritical = stock <= 10;
                    const isOutOfStock = stock === 0;

                    if (!acc[branch]) {
                        acc[branch] = { critical: 0, outOfStock: 0 };
                    }

                    if (isCritical) acc[branch].critical += 1;
                    if (isOutOfStock) acc[branch].outOfStock += 1;

                    return acc;
                }, {});

                let summaryRows = Object.keys(stockSummary).map(branch => `
                <tr>
                    <td>${branch}</td>
                    <td>${stockSummary[branch].critical}</td>
                    <td>${stockSummary[branch].outOfStock}</td>
                </tr>
            `).join('');

                const overallCritical = Object.values(stockSummary).reduce((total, branch) => total + branch.critical, 0);
                const overallOutOfStock = Object.values(stockSummary).reduce((total, branch) => total + branch.outOfStock, 0);

                summaryRows += `
                <tr>
                    <td>Overall Total</td>
                    <td>${overallCritical}</td>
                    <td>${overallOutOfStock}</td>
                </tr>
            `;

                return summaryRows;
            })()}
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