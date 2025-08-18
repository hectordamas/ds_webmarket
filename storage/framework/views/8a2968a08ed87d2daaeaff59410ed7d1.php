<div class="container">

    
    <div class="row mb-2">
        <div class="col">
            <h4 class="fw-bold"><i class="fas fa-user me-2"></i>Datos del Cliente</h4>
        </div>
    </div>

    
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="bg-light p-3 rounded shadow-sm h-100">
                <ul class="list-unstyled mb-0">
                    <li><i class="fas fa-user me-2 text-dark"></i><strong>Nombre:</strong> <?php echo e($order->nombre); ?></li>
                    <li><i class="fas fa-id-card me-2 text-dark"></i><strong>Cédula:</strong> <?php echo e($order->tipo_documento); ?><?php echo e($order->cedula); ?></li>
                    <li><i class="fas fa-phone me-2 text-dark"></i><strong>Teléfono:</strong> +58 <?php echo e($order->telefono); ?></li>
                    <?php if($order->tipo_pedido == 'Delivery'): ?>
                        <li><i class="fas fa-map-marker-alt me-2 text-dark"></i><strong>Dirección:</strong> <?php echo e($order->direccion); ?></li>
                        <li class="ms-4"><?php echo e($order->detalle_direccion); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="bg-light p-3 rounded shadow-sm h-100">
                <ul class="list-unstyled mb-0">
                    <li>
                        <i class="fas fa-file-invoice me-2 text-dark"></i> <strong>Número de Orden:</strong> <?php echo e($order->numero_orden); ?>

                    </li>
                    <li><i class="fas fa-truck me-2 text-dark"></i><strong>Tipo de Pedido:</strong> <?php echo e($order->tipo_pedido); ?></li>
                    <li><i class="fas fa-credit-card me-2 text-dark"></i><strong>Método de Pago:</strong> <?php echo e($order->payment->name); ?></li>
                    <?php
                        $statusColors = [
                            'Pendiente'   => 'warning',
                            'Confirmado'  => 'info',
                            'Enviado'     => 'primary',
                            'Entregado'   => 'success',
                            'Cancelado'   => 'danger',
                        ];
                        $color = $statusColors[$order->status] ?? 'dark';
                    ?>
                    <li>
                        <i class="fas fa-info-circle me-2 text-dark"></i><strong>Status:</strong>
                        <span class="badge bg-<?php echo e($color); ?>"><?php echo e($order->status); ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12 table-responsive">
            <table class="table table-bordered align-middle table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th colspan="2">Producto</th>
                        <th>SKU</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center" style="width:70px;">
                            <img src="<?php echo e(img64($product->product->image)); ?>" alt="Producto" class="img-thumbnail rounded" style="width: 60px; height: auto;">
                        </td>
                        <td>
                            <h6 class="mb-1"><?php echo e($product->product->name); ?></h6>
                            <p class="text-muted mb-1"><?php echo e(Str::limit($product->product->description, 50, '...')); ?></p>

                            <?php if($product->options->count()): ?>
                                <ul class="small ps-3 mb-1">
                                    <?php $__currentLoopData = $product->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($opt->option_group_name); ?>: <?php echo e($opt->option_name); ?> - $<?php echo e(number_format($opt->option_price, 2, '.', ',')); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>

                            <?php if($product->observations): ?>
                                <p class="small text-info mb-0"><strong>Nota:</strong> <?php echo e($product->observations); ?></p>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo e($product->product->sku ?? 'N/A'); ?></td>
                        <td class="text-center">$<?php echo e(number_format($product->unit_price, 2, '.', ',')); ?></td>
                        <td class="text-center"><?php echo e($product->quantity); ?></td>
                        <td class="text-center fw-bold">$<?php echo e(number_format($product->subtotal, 2, '.', ',')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot class="table-dark text-end">
                    <tr>
                        <td colspan="5"><strong>Total:</strong></td>
                        <td><strong>$ <?php echo e(number_format($order->total, 2, '.', ',')); ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/orders/partials/detalle.blade.php ENDPATH**/ ?>