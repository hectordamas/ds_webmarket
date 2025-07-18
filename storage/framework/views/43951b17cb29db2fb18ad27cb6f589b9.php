<div class="text-center px-3 py-4">
    
    <div class="mb-3">
        <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
            <i class="fas fa-check text-white fs-3"></i>
        </div>
        <h5 class="mt-3 fw-bold text-success">¡Pedido confirmado!</h5>
    </div>

    
    <p class="mb-1 text-muted">Su número de pedido es:</p>
    <h2 class="fw-bold text-tenant mb-3" id="numeroPedido"><?php echo e($order->id ?? '—'); ?></h2>

    
    <p class="small  mb-3">
        <i class="fas fa-hourglass-half me-1"></i> 
        Tiempo de entrega: Entrega estimada de su pedido 30 minutos.
    </p>

    
    <div class="alert alert-light border shadow-sm text-dark small mb-4">
        <i class="fas fa-check-circle text-success me-1"></i>
        ¡Gracias! Tu pedido ha finalizado y será enviado en <strong>5 segundos</strong> a nuestro WhatsApp:
    </div>

    
    <button class="btn btn-success w-100 fw-semibold py-2 mb-3" id="enviarWhatsapp">
        <i class="fas fa-shopping-bag me-2"></i> 
        <i class="fab fa-whatsapp me-2"></i> 
        PULSE PARA ENVIAR SU PEDIDO
    </button>

    
    <div class="d-grid gap-2 mb-4">
        <a href="<?php echo e(url('track-order-page/' . $order->id)); ?>" target="_blank" class="btn btn-tenant">Seguimiento del pedido</a>
        <a href="<?php echo e(url('/')); ?>" target="_blank"  class="btn btn-outline-dark">Hacer otro pedido</a>
    </div>

    
    <div class="text-center small text-muted">
        <a href="http://<?php echo e(env('CENTRAL_DOMAIN')); ?>" target="_blank" class="text-decoration-none">Desarrollado por <?php echo e(config('app.name')); ?></a>
    </div>
</div><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/shop/components/cart/completed.blade.php ENDPATH**/ ?>