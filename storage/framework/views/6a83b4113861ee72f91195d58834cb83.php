
<div class="text-center mb.4 d-flex justify-content-center">
    <dotlottie-player
        src="<?php echo e(asset('assets/img/reloj.lottie')); ?>"
        background="transparent"
        speed="1"
        style="width: 120px; height: 120px"
        loop
        autoplay>
    </dotlottie-player>
</div>


<div class="card shadow-sm mb-3">
    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div>
            <span class="badge bg-success mb-2 mb-md-0">
                <?php echo e($order->tipo_pedido === 'Pickup' ? 'Recoger en local' : 'Delivery'); ?>

            </span>
            <div class="fw-bold fs-5">
                Pedido #<?php echo e($order->id); ?>

                <small class="text-muted ms-2"><?php echo e($order->created_at->format('d/m/Y h:i A')); ?></small>
            </div>
        </div>
        <div class="text-md-end mt-2 mt-md-0">
            <?php
                $statusColors = [
                    'Pendiente'   => 'secondary',
                    'Confirmado'  => 'info',
                    'Enviado'     => 'primary',
                    'Entregado'   => 'success',
                    'Cancelado'   => 'danger',
                ];
                $color = $statusColors[$order->status] ?? 'dark';
            ?>
            <span class="badge bg-<?php echo e($color); ?> fs-6">Estatus: <?php echo e($order->status); ?></span>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Datos del Cliente</h6>
                <p class="mb-1"><strong>Nombre:</strong> <?php echo e($order->nombre); ?></p>
                <p class="mb-1"><strong>Cédula:</strong> <?php echo e($order->cedula); ?></p>
                <p class="mb-1"><strong>Teléfono:</strong> <?php echo e($order->telefono); ?></p>
                <?php if($order->direccion): ?>
                    <p class="mb-0"><strong>Dirección:</strong> <?php echo e($order->direccion); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Método de Pago</h6>
                <p class="mb-1"><?php echo e($order->payment->name); ?></p>
                <p class="mb-0"><strong>Nota:</strong> <?php echo e($order->nota ?? '—'); ?></p>
            </div>
        </div>
    </div>
</div>



<div class="card shadow-sm mb-3">
    <div class="card-header bg-light">
        <h6>Productos</h6>
    </div>
    <div class="card-body">
        <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-3 border-bottom pb-2">
                <div class="fw-semibold">
                    <?php echo e($item->product->name); ?>  x <?php echo e($item->quantity); ?>

                </div>
                <div class="text-muted small">
                    $<?php echo e(number_format($item->unit_price, 2)); ?> c/u = $<?php echo e(number_format($item->subtotal, 2)); ?>

                </div>

                <?php if($item->options->count()): ?>
                    <ul class="small text-muted ps-3 mt-1 mb-1">
                        <?php $__currentLoopData = $item->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($opt->option_group_name); ?>: <?php echo e($opt->option_name); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>

                <?php if($item->observations): ?>
                    <div class="small"><strong>Nota:</strong> <?php echo e($item->observations); ?></div>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>


<div class="card shadow-sm mb-3">
    <div class="card-body d-flex justify-content-between align-items-center">
        <span class="fw-bold fs-5">Total:</span>
        <span class="fs-5 text-success fw-bold">$ <?php echo e(number_format($order->total, 2)); ?></span>
    </div>
</div>


<div class="text-center small text-muted mt-5">
    <img src="<?php echo e(asset($settings['logo'] ?? 'assets/img/logo-color.png')); ?>" alt="<?php echo e(tenant('nombre_empresa')); ?> logo" style="width: 140px;">
    <p class="mt-2 mb-0">Soportado por <a href="http://<?php echo e(env('CENTRAL_DOMAIN')); ?>" target="_blank"><?php echo e(env('APP_NAME')); ?></a></p>
</div>
<?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/shop/orders/track-content.blade.php ENDPATH**/ ?>