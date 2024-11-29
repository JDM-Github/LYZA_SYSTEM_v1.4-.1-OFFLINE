<script>
    function printStockHistory() {
        const histories = <?php echo json_encode($transactionArray); ?>;
        const printContainer = document.createElement('div');
        printContainer.style.display = 'none';
        document.body.appendChild(printContainer);

        printContainer.innerHTML = `
                <html>
                    <head>
                        <title>Print Transaction History</title>
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
                        <h3>Transaction History</h3>
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Total</th>
                                    <th>Cash</th>
                                    <th>Change</th>
                                    <th>Discount Type</th>
                                    <th>Transaction Date</th>
                                    <th>Staff</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${histories.map(record => `
                                    <tr>
                                        <td>${record.id}</td>
                                        <td>${record.total_amount}</td>
                                        <td>${record.cash_received}</td>
                                        <td>${record.cash_change}</td>
                                        <td>${record.pwdDiscount == "1" && record.seniorDiscount == "1" ? "Senior & PWD Discount" : record.pwdDiscount == "1" ? "PWD Discount" : record.seniorDiscount == "1" ? "Senior Citizen Discount" : "NONE"}</td>
                                        <td>${record.createdAt}</td>
                                        <td>${record.staff_acc}</td>   
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