<canvas id="inventoryChart"></canvas>

<script>
    const ctx = document.getElementById('inventoryChart').getContext('2d');
    const inventoryChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($products->pluck('name')) !!},
            datasets: [{
                label: 'Product Quantity',
                data: {!! json_encode($products->pluck('quantity')) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        }
    });
</script>
