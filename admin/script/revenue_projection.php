<script>
    const historicalRevenue = <?php echo $historyJson; ?>;
    const projectedRevenue = <?php echo $calculatedJson; ?>;

    const revenueLabels = ['-3', '-2', '-1', 'Current', '+1', '+2', '+3']; // Example labels

    const data = {
        labels: revenueLabels,
        datasets: [
            {
                label: 'Historical Revenue',
                data: [...historicalRevenue],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: false,
            },
            {
                label: 'Projected Revenue',
                data: [historicalRevenue[historicalRevenue.length - 1], ...projectedRevenue],
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: false,
                borderDash: [5, 5] // Dashed line for projections
            }
        ]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        },
    };

    const revenueProjectionChart = new Chart(
        document.getElementById('revenueProjectionChart'),
        config
    );
</script>