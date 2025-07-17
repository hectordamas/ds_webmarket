<?php $__env->startSection('metadata'); ?>
<title><?php echo e(env('APP_NAME')); ?> - Dashboard</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <form method="GET" class="mb-3">
            <div class="d-flex align-items-center gap-2">
                <label class="fw-bold">Filtrar por Rango:</label>
                <select name="range" class="form-select w-auto" onchange="this.form.submit()">
                    <option value="today" <?php echo e(request('range') == 'today' ? 'selected' : ''); ?>>Hoy</option>
                    <option value="week" <?php echo e(request('range') == 'week' ? 'selected' : ''); ?>>Esta semana</option>
                    <option value="month" <?php echo e(request('range') == 'month' ? 'selected' : ''); ?>>Este mes</option>
                    <option value="year" <?php echo e(request('range') == 'year' ? 'selected' : ''); ?>>Este año</option>
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
                        <h4 class="m-b-0"><?php echo e($visitas); ?></h4>
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
                        <h4 class="m-b-0"><?php echo e($clientes); ?></h4>
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
                        <h4 class="m-b-0"><?php echo e($products); ?></h4>
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
                        <h4 class="m-b-0"><?php echo e($orders); ?></h4>
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
                <?php if(empty($pedidosOrdenados)): ?>
                    <div class="text-center text-muted h-100 d-flex align-items-center justify-content-center">
                        No hay pedidos en este rango de fechas.
                    </div>
                <?php else: ?>
                    <canvas id="pedidosChart"></canvas>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-8 mb-3">
        <div class="card border-0 shadow h-100">
            <div class="card-header">
                <h5 class="mb-0">Ingresos por Ventas</h5>
            </div>
            <div class="card-block" style="height: 300px;">
                <?php if(collect($datosVentas)->sum() > 0): ?>
                    <canvas id="ventasLineChart"></canvas>
                <?php else: ?>
                    <div class="text-center text-muted h-100 d-flex align-items-center justify-content-center">
                        No hay ventas en este rango de fechas.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="col-md-4">

        <div class="card widget-card-1 shadow">
            <div class="card-block-small">
                <i class="fas fa-dollar-sign bg-c-green card1-icon"></i>
                <span class="text-c-green f-w-600">Ingresos Totales</span>
                <h4>$<?php echo e(number_format($ingresos, 2, ',', '.')); ?></h4>
            </div>
        </div>

        <div class="card widget-card-1 shadow">
            <div class="card-block-small">
                <i class="fas fa-receipt bg-c-blue card1-icon"></i>
                <span class="text-c-blue f-w-600">Ticket Promedio</span>
                <h4>$<?php echo e(number_format($ticketPromedio, 2, ',', '.')); ?></h4>
            </div>
        </div>

        <div class="card widget-card-1 shadow">
            <div class="card-block-small">
                <i class="fas fa-user-plus bg-c-yellow card1-icon"></i>
                <span class="text-c-yellow f-w-600">Clientes Nuevos</span>
                <h4><?php echo e($clientesNuevos ?? 0); ?></h4>
            </div>
        </div>

        
        <div class="card widget-card-1 shadow">
            <div class="card-block-small">
                <i class="fas fa-users bg-c-pink card1-icon"></i>
                <span class="text-c-pink f-w-600">Clientes Recurrentes</span>
                <h4><?php echo e($clientesRecurrentes ?? 0); ?></h4>
            </div>
        </div>


    </div>


    <div class="col-md-8">
        <div class="card shadow h-100 border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">📦 Productos más vendidos</h5>
                <small class="text-muted">Unidades</small>
            </div>
            <div class="card-block p-0">
                <?php $__empty_1 = true; $__currentLoopData = $productosMasVendidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width:32px; height:32px;">
                                <i class="fas fa-trophy text-warning"></i>
                            </div>
                            <span class="fw-semibold"><?php echo e($producto['nombre']); ?></span>
                        </div>
                        <span class="badge bg-primary"><?php echo e($producto['cantidad']); ?> </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center text-muted d-flex align-items-center justify-content-center" style="height: 200px">
                        No hay productos vendidos en este período.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    if($('#pedidosChart').length){
        const ctx = document.getElementById('pedidosChart').getContext('2d');

        const pedidosChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode(array_keys($pedidosOrdenados)); ?>,
                datasets: [{
                    label: 'Cantidad',
                    data: <?php echo json_encode(array_values($pedidosOrdenados)); ?>,
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
                labels: <?php echo json_encode($labels, 15, 512) ?>,
                datasets: [{
                    label: 'Ventas (USD)',
                    data: <?php echo json_encode($datosVentas, 15, 512) ?>,
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/home.blade.php ENDPATH**/ ?>