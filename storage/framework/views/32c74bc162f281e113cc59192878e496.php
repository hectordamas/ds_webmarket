
<?php $__env->startSection('metadata'); ?>
    <title><?php echo e(tenant('nombre_empresa')); ?> - <?php echo e(config('app.name')); ?></title>

    <?php echo $__env->make('tenant.shop.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4" style="background: #f9f9f9; min-height: 100vh;">

    <!-- Logo y encabezado -->
    <div class="d-flex justify-content-center align-items-center mb-4">
        <img src="<?php echo e(img64($settings['logo'] ?? 'assets/img/logo-color.png')); ?>" 
             alt="Logo" style="max-width: 180px;">

    </div>

    <div class="row g-4">

        <!-- Órdenes Pendientes -->
        <div class="col-lg-6">
            <div class="card shadow-lg border-0">
                <div class="card-header fw-bold fs-4 text-white" 
                     style="background: var(--tenant-primary-color, #00a884);">
                    🕒 En preparación
                </div>
                <div class="card-body p-4">
                    <div id="pending-orders" class="row g-3">
                        <!-- Aquí se inyectan con JS -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Órdenes Terminadas -->
        <div class="col-lg-6">
            <div class="card shadow-lg border-0">
                <div class="card-header fw-bold fs-4 text-white" 
                     style="background: var(--tenant-primary-color, #00a884);">
                    ✅ Listas para recoger
                </div>
                <div class="card-body p-4">
                    <div id="finished-orders" class="row g-3">
                        <!-- Aquí se inyectan con JS -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    function fetchOrders() {
        $.get("<?php echo e(url('orders-screen/data')); ?>", function (res) {
            // Limpiar contenedores
            $('#pending-orders').empty();
            $('#finished-orders').empty();

            // Renderizar pendientes
            res.pending.forEach(order => {
                $('#pending-orders').append(`
                    <div class="col-6">
                        <div class="p-3 bg-light rounded shadow-sm text-center border" style="border:var(--tenant-primary-color, #00a884);">
                            <h2 class="fw-bold" style="color: var(--tenant-primary-color, #00a884);">
                                #${order.numero}
                            </h2>
                            <p class="mb-0 fw-bold">${order.nombre}</p>
                            <small>${order.tipo_pedido}</small>
                        </div>
                    </div>
                `);
            });

            // Renderizar terminadas
            res.finished.forEach(order => {
                $('#finished-orders').append(`
                    <div class="col-6">
                        <div class="p-3 text-white rounded shadow-sm text-center" style="background: var(--tenant-primary-color, #00a884);">
                            <h2 class="fw-bold">#${order.numero}</h2>
                            <p class="mb-0 fw-bold text-white">${order.nombre}</p>
                            <small>${order.tipo_pedido}</small>
                        </div>
                    </div>
                `);
            });
        });
    }

    // Refrescar cada 10s
    setInterval(fetchOrders, 10000);
    fetchOrders();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('tenant.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/shop/orders/orders-screen.blade.php ENDPATH**/ ?>