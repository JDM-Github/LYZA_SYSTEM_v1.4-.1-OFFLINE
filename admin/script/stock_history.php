<script>
    const stockLabels = <?php echo $stockHistoryLabels; ?>;
    const stockData = <?php echo $stockHistoryData; ?>;

    new Chart(document.getElementById('stockHistoryChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: stockLabels,
            datasets: [{
                label: 'Stock Quantity',
                data: stockData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
                x: {
                    title: {
                        display: true,
                        text: '<?php echo ucfirst($selectedGroup); ?>'
                    }
                }
            }
        }
    });
</script>