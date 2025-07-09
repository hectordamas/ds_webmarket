<div>
    <h6 class="fw-bold">Datos del Cliente</h6>
    <div class="row">
        <div class="col-md-6 mb-3">
            <ul>
                <li><strong>Nombre:</strong> <?php echo e($order->nombre); ?></li>
                <li><strong>Cédula:</strong> <?php echo e($order->cedula); ?></li>
                <li><strong>Teléfono:</strong> +58 <?php echo e($order->telefono); ?></li>
                <li><strong>Dirección:</strong> <?php echo e($order->direccion); ?></li>
                <li><?php echo e($order->detalle_direccion); ?></li>
            </ul>
        </div>
        <div class="col-md-6 mb-3">
            <ul>
                <li><strong>Tipo de Pedido:</strong> <?php echo e($order->tipo_pedido); ?></li>
                <li><strong>Método de Pago:</strong> <?php echo e($order->metodo_pago); ?></li>
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
                <li><strong>Status:</strong> <span class="badge bg-<?php echo e($color); ?>"><?php echo e($order->status); ?></span></li>
                <li><strong>Total:</strong> $<?php echo e(number_format($order->total, 2, '.', ',')); ?></li>
            </ul>
        </div>
    </div>

    <h5 class="mb-2">Items de la Orden</h5>
    <div class="row">
        <div class="col-md-12 dt-responsive table-responsive">
            <table class="table  table-striped  nowrap">
                <thead class="table-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th style="text-align:center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <img src="<?php echo e(asset($product->product->image)); ?>" alt="Producto" style="width: 80px; height: auto;">
                        </td>
                        <td>
                            <h6><?php echo e($product->product->name); ?></h6>
                            <span><?php echo e(Str::limit($product->product->description, 50, '...')); ?></span>
                            <?php if($product->options->count()): ?>
                                <ul class="mb-0 small ps-3 text-muted">
                                    <?php $__currentLoopData = $product->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($opt->option_group_name); ?>: <?php echo e($opt->option_name); ?> - $<?php echo e(number_format($opt->option_price, 2, '.', ',')); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                            <?php if($product->observations): ?>
                                <p class="mb-0 small mt-1"><strong>Nota:</strong> <?php echo e($product->observations); ?></p>
                            <?php endif; ?>
                        </td>
                        <td>$<?php echo e(number_format($product->unit_price, 2, '.', ',')); ?></td>
                        <td><?php echo e($product->quantity); ?></td>
                        <td style="text-align:center">$<?php echo e(number_format($product->subtotal, 2, '.', ',')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/orders/partials/detalle.blade.php ENDPATH**/ ?>