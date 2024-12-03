<script>
    const stockPortionLabels = <?php echo $stockPortionLabels; ?>;
    const stockPortionData = <?php echo $stockPortionData; ?>;

    new Chart(document.getElementById('stockPortionsChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: stockPortionLabels,
            datasets: [{
                label: 'Stock Status',
                data: stockPortionData,
                backgroundColor: [
                    'rgba(220, 53, 69, 0.7)',
                    'rgba(255, 193, 7, 0.7)',
                    'rgba(40, 167, 69, 0.7)'
                ],
                borderColor: [
                    'rgba(220, 53, 69, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(40, 167, 69, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom'
                }
            }
        }
    });
</script>