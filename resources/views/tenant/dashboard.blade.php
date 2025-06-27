
@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Dashboard</title>
@endsection

@section('content')
<div class="row">

    <!-- Visitantes -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-c-yellow text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Visitantes</p>
                        <h4 class="m-b-0">{{ $clientes }}</h4>
                    </div>
                    <div class="col col-auto text-end">
                        <i class="feather icon-activity f-50 text-c-yellow"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Clientes Activos -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-c-green text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Clientes Activos</p>
                        <h4 class="m-b-0">{{ $clientes }}</h4>
                    </div>
                    <div class="col col-auto text-end">
                        <i class="feather icon-users f-50 text-c-green"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Productos disponibles -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-c-pink text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Productos</p>
                        <h4 class="m-b-0">{{ 0 }}</h4>
                    </div>
                    <div class="col col-auto text-end">
                        <i class="feather icon-box f-50 text-c-pink"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pedidos -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-c-blue text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Total Pedidos</p>
                        <h4 class="m-b-0">{{ $pedidos }}</h4>
                    </div>
                    <div class="col col-auto text-end">
                        <i class="feather icon-shopping-cart f-50 text-c-blue"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pedidos por Estado -->
    <div class="col-12 col-xl-4 mb-3">
        <div class="card border-0 shadow h-100">
            <div class="card-header">
                <h5 class="mb-0">Pedidos por Estado</h5>
            </div>
            <div class="card-block" style="height: 300px;">
                <canvas id="pedidosChart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-8 mb-3">
        <div class="card border-0 shadow h-100">
            <div class="card-header">
                <h5 class="mb-0">Ingresos por Ventas</h5>
            </div>
            <div class="card-block" style="height: 300px;">
                <canvas id="ventasLineChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Últimos Pedidos -->
    <div class="col-12 col-xl-4 mb-3">
        <div class="card border-0 shadow h-100">
            <div class="card-header">

                <h5 class="mb-0">Últimos Pedidos</h5>
            </div>
            <div class="card-block">
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

                <h5 class="mb-0">Categorias de mayor interés</h5>
            </div>
            <div class="card-block">
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
