<script>

    function printPhysicalCount() {
        const histories = <?php echo json_encode($physicalArray); ?>;
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
                        <h3>Physical Counting Report</h3>
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
                                <th>Staff</th>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Stock</th>
                                <th>Week Range<br/>(Start Date)</th>
                                <th>Week Range<br/>(End Date)</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${histories.map(record => `
                                <tr>
                                    <td>${record.branchName}</td>
                                    <td>${record.userName}</td>
                                    <td>${record.brandName}</td>
                                    <td>${record.genericName}</td>
                                    <td>${record.productStock}</td>
                                    <td>${record.createdAt}</td>
                                    <td>${record.expiryDate}</td>
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