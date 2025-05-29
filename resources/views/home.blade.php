@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 col-xl-4 mb-3">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-3 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-primary rounded me-4 me-sm-0">
                            <i class="fas fa-shopping-cart fa-2x"></i>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="h5">Total Pedidos</h2>
                            <h3 class="fw-extrabold mb-1">{{ $pedidos }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-9 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0">Total Pedidos</h2>
                            <h3 class="fw-extrabold mb-2">{{ $pedidos }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4 mb-3">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-3 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-success rounded me-4 me-sm-0">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="fw-extrabold h5"> Clientes Activos</h2>
                            <h3 class="mb-1">{{ $clientes }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-9 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0"> Clientes Activos</h2>
                            <h3 class="fw-extrabold mb-2">{{ $clientes }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4 mb-3">
        <div class="card border-0 shadow">
            <div class="card-body">
                <div class="row d-block d-xl-flex align-items-center">
                    <div class="col-12 col-xl-3 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                        <div class="icon-shape icon-shape-info rounded me-4 me-sm-0">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                        <div class="d-sm-none">
                            <h2 class="fw-extrabold h5"> Visitantes</h2>
                            <h3 class="mb-1">{{ $clientes }}</h3>
                        </div>
                    </div>
                    <div class="col-12 col-xl-9 px-xl-0">
                        <div class="d-none d-sm-block">
                            <h2 class="h6 text-gray-400 mb-0"> Visitantes</h2>
                            <h3 class="fw-extrabold mb-2">{{ $clientes }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pedidos por Estado -->
    <div class="col-12 col-xl-4 mb-3">
        <div class="card border-0 shadow h-100">
            <div class="card-header">
                <h6 class="mb-0">Pedidos por Estado</h6>
            </div>
            <div class="card-body">
                <canvas id="pedidosChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-8 mb-3">
        <div class="card border-0 shadow h-100">
            <div class="card-header">
                Ingresos por Ventas
            </div>
            <div class="card-body" style="height: 300px;">
                <canvas id="ventasLineChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Últimos Pedidos -->
    <div class="col-12 col-xl-4 mb-3">
        <div class="card border-0 shadow h-100">
            <div class="card-header">
                <h6 class="mb-0">Últimos Pedidos</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($ultimosPedidos as $pedido)
                        <li class="list-group-item">
                            <strong>#{{ $pedido->id }}</strong> - {{ $pedido->cliente->nombre }}<br>
                            <small class="text-muted">{{ $pedido->created_at->format('d/m/Y') }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

        <!-- Categorías con mayor trafico -->
    <div class="col-12 col-xl-4 mb-3">
        <div class="card border-0 shadow h-100">
            <div class="card-header">
                <h6 class="mb-0">Categorias de mayor interés</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($ultimosPedidos as $pedido)
                        <li class="list-group-item">
                            <strong>#{{ $pedido->id }}</strong> - {{ $pedido->cliente->nombre }}<br>
                            <small class="text-muted">{{ $pedido->created_at->format('d/m/Y') }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('pedidosChart').getContext('2d');
    const pedidosChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_keys($pedidosPorEstado)) !!},
            datasets: [{
                label: 'Cantidad',
                data: {!! json_encode(array_values($pedidosPorEstado)) !!},
                backgroundColor: ['#F0BC74', '#2361ce', '#292959', '#0EA271'],
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true
        }
    });


    const ctxVentas = document.getElementById('ventasLineChart').getContext('2d');
    const ventasLineChart = new Chart(ctxVentas, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
            datasets: [{
                label: 'Ventas (USD)',
                data: [1200, 1900, 3000, 2500, 3200, 4000],
                fill: true,
                tension: 0.3,
                borderColor: '#0050D9',
                backgroundColor: 'rgba(0, 80, 217, 0.1)',
                pointBackgroundColor: '#0050D9',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: '#0050D9'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '$' + value;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
