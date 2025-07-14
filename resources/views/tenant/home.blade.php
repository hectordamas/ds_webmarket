
@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Dashboard</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <form method="GET" class="mb-3">
            <div class="d-flex align-items-center gap-2">
                <label class="fw-bold">Filtrar por Rango:</label>
                <select name="range" class="form-select w-auto" onchange="this.form.submit()">
                    <option value="today" {{ request('range') == 'today' ? 'selected' : '' }}>Hoy</option>
                    <option value="week" {{ request('range') == 'week' ? 'selected' : '' }}>Esta semana</option>
                    <option value="month" {{ request('range') == 'month' ? 'selected' : '' }}>Este mes</option>
                    <option value="year" {{ request('range') == 'year' ? 'selected' : '' }}>Este año</option>
                </select>
            </div>
        </form>
    </div>


    <!-- Visitantes -->
    <div class="col-xl-3 col-md-6">
        <div class="card bg-c-yellow text-white">
            <div class="card-block">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="m-b-5">Nuevos Visitantes</p>
                        <h4 class="m-b-0">{{ $visitas }}</h4>
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
                        <h4 class="m-b-0">{{ $products }}</h4>
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
                        <h4 class="m-b-0">{{ $orders }}</h4>
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
            labels: @json($labels),
            datasets: [{
                label: 'Ventas (USD)',
                data: @json($datosVentas),
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
