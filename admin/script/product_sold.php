<script>
    const ctx = document.getElementById('mostSoldProductsChart').getContext('2d');
    let mostSoldProductsChart;

    function renderChart() {
        const labels = <?php echo json_encode($labels); ?>;
        const data = <?php echo json_encode($data); ?>;
        const noProducts = <?php echo isset($noProducts) ? 'true' : 'false'; ?>;

        if (noProducts) {
            mostSoldProductsChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['No Products Sold'],
                    datasets: [{
                        label: 'No Products Sold',
                        data: [0],
                        backgroundColor: ['rgba(211, 211, 211, 1)'],
                        borderColor: ['rgba(169, 169, 169, 1)'],
                        borderWidth: 1
                    }]
                },
            });
            return;
        }

        if (mostSoldProductsChart) {
            mostSoldProductsChart.destroy();
        }

        mostSoldProductsChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Most Sold Products',
                    data: data,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
        renderChart();
        document.getElementById('printChartButton').addEventListener('click', function () {
            printChart();
        });
    });

    function printChart() {
        const canvas = document.getElementById('mostSoldProductsChart');
        const dataUrl = canvas.toDataURL();

        const printWindow = window.open('', '_blank', 'width=600,height=400');
        printWindow.document.open();
        printWindow.document.write(`
        <html>
            <head>
                <title>Most Sold Product Chart</title>
                <style>
                    body {
                        displex: flex;
                        flex-direction: column;
                        font-family: Arial, sans-serif;
                        text-align: center;
                        background-color: #f8f9fa;
                        margin: 0;
                        padding: 20px;
                    }
                    .chart-container {
                        position: relative;
                        displex: flex;
                        justify-content: center;
                        align-items: center;
                        left: 50%;
                        width: 500px;
                        max-width: 500px;
                        transform: translateX(-50%);
                        border: 2px dashed #333;
                    }
                    h1 {
                        color: #666;
                        margin-bottom: 20px;
                    }
                    img {
                        max-width: 90%;
                        height: auto;
                        border-radius: 8px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                        margin-bottom: 20px;
                        padding: 20px;
                    }
                    .print-button {
                        margin-top: 20px;                   
                        padding: 10px 20px;
                        font-size: 16px;
                        color: #fff;
                        background-color: #007bff;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                    }
                    .print-button:hover {
                        background-color: #0056b3;
                    }
                    @media print {
                        body {
                            background-color: white;
                            margin: 0;
                        }
                        button {
                            display: none; /* Hide button when printing */
                        }
                    }
                </style>
            </head>
            <body>
                <div class="chart-container">
                    <h1>Most Sold Products Chart</h1>
                    <img src="${dataUrl}" alt="Most Sold Products Chart" />
                </div>
                <button class="print-button" onclick="window.print();">Print this chart</button>
            </body>
        </html>
    `);
        printWindow.document.close();
        printWindow.print();
        printWindow.focus();
    }

</script>