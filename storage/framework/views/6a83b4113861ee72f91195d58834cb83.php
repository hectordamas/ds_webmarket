   
    <div class="text-center mb-4 d-flex flex-column align-items-center">
        <dotlottie-player
            src="<?php echo e(asset('assets/img/reloj.lottie')); ?>"
            background="transparent"
            speed="1"
            style="width: 100px;"
            loop
            autoplay
        ></dotlottie-player>   

    </div>

    
    <div class="bg-light border p-3 mb-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <span class="badge bg-success">
                <?php echo e($order->tipo_pedido === 'pickup' ? 'Para llevar o recoger en local' : 'Delivery'); ?>

            </span>
            <div class="fw-bold">
                Pedido: <?php echo e($order->id); ?> 
                <span class="text-muted small ms-2"><?php echo e($order->created_at->format('d/m/Y - h:i A')); ?></span>
            </div>
        </div>
    </div>

    
    <div class="row mb-3">
        <div class="col-md-6">
            <h6 class="fw-bold">Datos del Cliente</h6>
            <p class="mb-1"><span class="fw-semibold">Nombre:</span> <?php echo e($order->nombre); ?></p>
            <p class="mb-1"><span class="fw-semibold">Teléfono:</span> <?php echo e($order->telefono); ?></p>        

        </div>
        <div class="col-md-6 text-end">
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
            <h6 class="mt-3 fw-bold">
                Estatus: <span class="badge bg-<?php echo e($color); ?>"><?php echo e($order->status); ?></span>
            </h6>
        </div>
    </div>

    
    <div class="mb-3">
        <h6 class="fw-bold">Productos</h6>
        <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-2 border-bottom pb-2">
                <div class="fw-semibold">
                    <?php echo e($item->quantity); ?> x <?php echo e($item->product->name); ?>

                </div>
                <div class="text-muted">$ <?php echo e(number_format($item->unit_price, 2)); ?> = $ <?php echo e(number_format($item->subtotal, 2)); ?></div>

                <?php if($item->options->count()): ?>
                    <ul class="mb-0 small ps-3 text-muted">
                        <?php $__currentLoopData = $item->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($opt->option_group_name); ?>: <?php echo e($opt->option_name); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endif; ?>
                <?php if($item->observations): ?>
                    <p class="mb-0 small mt-1"><strong>Nota:</strong> <?php echo e($item->observations); ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div class="mb-3">
        <div class="d-flex justify-content-between fw-bold fs-5">
            <span>Total:</span>
            <span>$ <?php echo e(number_format($order->total, 2)); ?></span>
        </div>
    </div>

    
    <div class="mb-3">
        <p class="mb-1"><strong>Método de pago:</strong> <?php echo e($order->metodo_pago); ?></p>
        <p class="mb-0"><strong>Nota:</strong> <?php echo e($order->nota ?? '—'); ?></p>
    </div>

    
    <div class="text-center small text-muted mt-5">
        <img src="<?php echo e(asset($settings['logo'] ?? 'assets/img/logo-color.png')); ?>" alt="<?php echo e(tenant('nombre_empresa')); ?> logo" style="width: 150px;">
        <p class="mt-2 mb-0">Soportado por <a href="http://<?php echo e(env('CENTRAL_DOMAIN')); ?>" target="_blank"><?php echo e(env('APP_NAME')); ?></a></p>
    </div> 
<?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/shop/orders/track-content.blade.php ENDPATH**/ ?>