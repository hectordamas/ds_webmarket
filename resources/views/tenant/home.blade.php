
@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ config('app.name') }} - Dashboard</title>
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
                <h5 class="mb-0">🛒 Pedidos por Estado</h5>
            </div>
            <div class="card-block" style="height: 300px;">
                @if (array_sum($pedidosOrdenados) === 0)
                    <div class="text-center text-muted h-100 d-flex align-items-center justify-content-center">
                        No hay pedidos en este rango de fechas.
                    </div>
                @else
                    <canvas id="pedidosChart"></canvas>
                @endif
            </div>
        </div>
    </div> 

    <div class="col-12 col-xl-8 mb-3">
        <div class="card border-0 shadow h-100">
            <div class="card-header">
                <h5 class="mb-0">💸 Ingresos por Ventas</h5>
            </div>
            <div class="card-block" style="height: 300px;">
                @if (collect($datosVentas)->sum() > 0)
                    <canvas id="ventasLineChart"></canvas>
                @else
                    <div class="text-center text-muted h-100 d-flex align-items-center justify-content-center">
                        No hay ventas en este rango de fechas.
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="col-md-4">

        <div class="card widget-card-1 shadow">
            <div class="card-block-small">
                <i class="fas fa-dollar-sign bg-c-green card1-icon"></i>
                <span class="text-c-green f-w-600">Ingresos Totales</span>
                <h4>${{ number_format($ingresos, 2, ',', '.') }}</h4>
            </div>
        </div>

        <div class="card widget-card-1 shadow">
            <div class="card-block-small">
                <i class="fas fa-receipt bg-c-blue card1-icon"></i>
                <span class="text-c-blue f-w-600">Ticket Promedio</span>
                <h4>${{ number_format($ticketPromedio, 2, ',', '.') }}</h4>
            </div>
        </div>

        <div class="card widget-card-1 shadow">
            <div class="card-block-small">
                <i class="fas fa-user-plus bg-c-yellow card1-icon"></i>
                <span class="text-c-yellow f-w-600">Clientes Nuevos</span>
                <h4>{{ $clientesNuevos ?? 0 }}</h4>
            </div>
        </div>

        
        <div class="card widget-card-1 shadow">
            <div class="card-block-small">
                <i class="fas fa-users bg-c-pink card1-icon"></i>
                <span class="text-c-pink f-w-600">Clientes Recurrentes</span>
                <h4>{{ $clientesRecurrentes ?? 0 }}</h4>
            </div>
        </div>


    </div>

    <div class="col-md-8">
      <div class="card shadow border-0" style="height: 95%;">
        @if($productosMasVendidos->isEmpty())
        <div class="card-header">
            <h5 class="mb-0">📦 Productos más vendidos</h5>
        </div>
        @endif
        <div class="card-block pb-0">
          @if($productosMasVendidos->isEmpty())
            <div class="text-center text-muted py-5">
              No hay productos vendidos en este período.
            </div>
          @else
            <div class="table-responsive">
              <table class="table table-hover mb-0 rounded-3">
                <thead class="text-center align-middle">
                  <tr>
                    <th class="border-bottom-0 text-left card-header ps-0">
                        <h5 class="mb-0">📦 Productos más vendidos</h5>
                    </th>
                    <td class="border-bottom-0" style="width:120px;">
                        <span class="badge bg-primary text-small rounded" style="font-size: 11px;" >Unidades Vendidas</span>
                    </td>
                    <td class="border-bottom-0" style="width:140px;">
                        <span class="badge bg-success text-small rounded" style="font-size: 11px;" >Ingresos Generados</span>
                    </td>
                  </tr>
                </thead>
                <tbody>
                  @foreach($productosMasVendidos as $index => $producto)
                    <tr class="align-middle">
                      <td class="text-truncate text-left" style="max-width: 300px;" title="{{ $producto['nombre'] }}">
                         <i class="fas fa-trophy text-warning me-1"></i> {{ $producto['nombre'] }}
                      </td>
                      <td class="text-center fw-bold text-primary">
                        {{ $producto['cantidad'] }}
                      </td>
                      <td class="text-center fw-bold text-success">
                        ${{ number_format($producto['ventas'], 2, '.', ',') }}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>
    </div>



</div>
@endsection

@section('scripts')
<script>
    if($('#pedidosChart').length){
        const ctx = document.getElementById('pedidosChart').getContext('2d');

        const pedidosChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($pedidosOrdenados)) !!},
                datasets: [{
                    label: 'Cantidad',
                    data: {!! json_encode(array_values($pedidosOrdenados)) !!},
                    backgroundColor: [
                        '#FFB74D', // Pendiente - naranja pastel
                        '#4FC3F7', // Confirmado - azul cielo
                        '#42A5F5', // Enviado - azul fuerte
                        '#66BB6A', // Entregado - verde pastel
                        '#EF5350', // Cancelado - rojo suave
                    ],
                }]
            },
            options: {
                maintainAspectRatio: false,
                responsive: true
            }
        });
    }

    if($('#ventasLineChart').length){
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
    }

</script>
@endsection
