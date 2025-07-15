<?php $__currentLoopData = $notificacionesTenant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="px-3 py-2 <?php echo e($order->is_read ? '' : 'bg-light'); ?>" onclick="window.location.href = '<?php echo e(url('orders/ver-detalles/' . $order->id)); ?>'" >
        <div class="d-flex">
            <div class="flex-shrink-0">
                <?php if(!$order->is_read): ?>
                    
                    <span class="d-inline-block rounded-circle pulse" style="width: 10px; height: 10px; margin-top: 6px; background-color: red;"></span>
                <?php else: ?>
                    
                <?php endif; ?>
            </div>
            <div class="flex-grow-1 ms-3">
                <h5 class="notification-user mb-1"><?php echo e($order->nombre); ?></h5>
                <p class="notification-msg text-muted mb-1 small">
                    Tienes una nueva orden del cliente: <?php echo e($order->nombre); ?>

                </p>
                <span class="notification-time text-muted small"><?php echo e($order->created_at->diffForHumans()); ?></span>
            </div>
        </div>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<style>
@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.5); opacity: 0.5; }
    100% { transform: scale(1); opacity: 1; }
}

span.pulse {
    animation: pulse 1.5s infinite;
}
</style><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/orders/partials/notifications.blade.php ENDPATH**/ ?>