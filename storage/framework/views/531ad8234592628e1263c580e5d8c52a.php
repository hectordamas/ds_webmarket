

<?php $__env->startSection('metadata'); ?>
<title><?php echo e(env('APP_NAME')); ?> - Orden <?php echo e($order->id); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Detalles de la Orden</h5>
                <a href="<?php echo e(url('orders')); ?>" class="btn btn-primary">Lista de Órdenes</a>
            </div>
            <div class="card-block">
                <?php echo $__env->make('tenant.admin.orders.partials.detalle', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/orders/show.blade.php ENDPATH**/ ?>