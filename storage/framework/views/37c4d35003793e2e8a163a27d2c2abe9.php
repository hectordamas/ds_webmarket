<?php if(Cart::count() > 0): ?>
    <ul class="list-group mb-3">
        <?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div>
                    <span class="fw-semibold"><?php echo e($item->name); ?></span>
                    <small class="text-muted">x<?php echo e($item->qty); ?></small>
                    <ul class="small ps-3 mt-1 mb-0">
                        <?php $__currentLoopData = $item->options->extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $opts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><strong><?php echo e($group); ?>:</strong> <?php echo e(implode(', ', $opts)); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->options->observations): ?>
                            <li><em>📝 <?php echo e($item->options->observations); ?></em></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <span class="fw-bold text-tenant">$<?php echo e(number_format($item->price * $item->qty, 2)); ?></span>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <li class="list-group-item d-flex justify-content-between">
            <strong>Total:</strong>
            <strong class="text-tenant">$<?php echo e(Cart::subtotal()); ?></strong>
        </li>
    </ul>
<?php else: ?>
    <div class="text-muted text-center">No hay productos en el carrito.</div>
<?php endif; ?><?php /**PATH C:\laragon\www\ds_webmarket\resources\views/tenant/shop/components/cart/resumen-cart.blade.php ENDPATH**/ ?>