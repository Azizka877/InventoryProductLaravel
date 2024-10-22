@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Tableau de Bord - Inventaire</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Produits</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalProducts }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Quantité Totale</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalQuantity }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Top 5 Produits (par Quantité)
        </div>
        <div class="card-body">
            <canvas id="topProductsChart"></canvas>
        </div>
    </div>
</div>

<script>
    const labels = {!! json_encode($labels) !!};
    const data = {
        labels: labels,
        datasets: [{
            label: 'Quantité',
            data: {!! json_encode($data) !!},
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    const topProductsChart = new Chart(
        document.getElementById('topProductsChart'),
        config
    );
</script>
@endsection
