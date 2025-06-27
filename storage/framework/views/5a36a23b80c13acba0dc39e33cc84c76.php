<div class="flex-grow-1 overflow-auto px-2" style="max-height: calc(100vh - 270px);">

    <div class="pt-2">
        <h6 class="fw-bold">Resumen del Pedido</h6>
        <hr>
        <div class="mt-3">
            <h6>Datos del Cliente</h6>
            <p class="mb-1"><strong>Nombre:</strong> <span id="summaryNombre">—</span></p>
            <p class="mb-1"><strong>Cédula:</strong> <span id="summaryCedula">—</span></p>
            <p class="mb-1"><strong>Teléfono:</strong> <span id="summaryTelefono">—</span></p>
            <p class="mb-1"><strong>Dirección:</strong> <span id="summaryDireccion">—</span></p>
        </div>
    </div>

    <hr>
    <?php if(Cart::count() > 0): ?>
        <ul class="list-group mb-3">
            <?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-semibold"><?php echo e($item->name); ?></div>
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
    <?php endif; ?>
</div>

<div class="pt-2 shadow-lg">
    <div class="mb-2">
        <a href="#" class="btn btn-tenant w-100" id="enviarWhatsapp">
            <i class="fab fa-whatsapp"></i> Enviar Pedido por WhatsApp
        </a>
    </div>
    <div class="mb-2">
        <button class="btn btn-dark w-100" onclick="goToTab('checkout')">
           <i class="fas fa-arrow-left ms-2"></i> Volver 
        </button>
    </div>
</div><?php /**PATH C:\laragon\www\ds_webmarket\resources\views/tenant/shop/components/cart/confirmar.blade.php ENDPATH**/ ?>