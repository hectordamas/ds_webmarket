
<?php $__env->startSection('metadata'); ?>
<title>Seguimiento de Pedido #<?php echo e($order->id); ?> - <?php echo e(tenant('nombre_empresa')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container my-4" >
    
    <div id="track-container">

        <?php echo $__env->make('tenant.shop.orders.track-content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function () {
        const orderId = <?php echo e($order->id); ?>;
        const $trackContainer = $('#track-container');

        function updateTrackingContent() {
            $.ajax({
                url: `/track-content/${orderId}`,
                method: 'GET',
                beforeSend: function(){
                    $trackContainer.addClass('opacity-50')
                },
                success: function (data) {
                    $trackContainer.removeClass('opacity-50')
                    $trackContainer.html(data.html)
                },
                error: function (xhr, status, error) {
                    console.error('Error al actualizar el tracking:', error);
                    $trackContainer.removeClass('opacity-50');
                }
            });
        }

        // Ejecutar cada 15 segundos
        setInterval(updateTrackingContent, 15000);
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('tenant.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ds_webmarket\resources\views/tenant/shop/orders/track.blade.php ENDPATH**/ ?>