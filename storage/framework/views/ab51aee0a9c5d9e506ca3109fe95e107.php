

<?php $__env->startSection('metadata'); ?>
<title><?php echo e(config('app.name')); ?> - Orden #<?php echo e($order->id); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="col-sm-12">
            <!-- Shopping cart start -->
            <div class="card">
                <div class="card-header">
                    <h5>Orden #<?php echo e($order->id); ?></h5>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Datos del Cliente</h5>
                            <hr>
                        </div>
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
                            <h5></h5>
                            <ul>
                                <li><strong>Tipo de Pedido:</strong> <?php echo e($order->tipo_pedido); ?></li>
                                <li><strong>Método de Pago:</strong> <?php echo e($order->metodo_pago); ?></li>
                                <li><strong>Total:</strong> $<?php echo e(number_format($order->total, 2, '.', ',')); ?></li>
                            </ul>
                        </div>

                        <div class="col-md-12">
                            <h5 class="mb-2">Items de la Orden</h5>
                            <table class="table table-responsive table-striped dt-responsive nowrap dataTable no-footer dtr-inline cart-page"
                                role="grid" style="width: 100%;">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="sorting_disabled"
                                            rowspan="1" colspan="1"
                                            style="width: 125px;">
                                            </th>
                                        <th class="sorting_disabled"
                                            rowspan="1" colspan="1"
                                            style="width: 1023px;">
                                            Producto</th>
                                        <th class="sorting_disabled"
                                            rowspan="1" colspan="1"
                                            style="width: 153px;">
                                            Precio Unitario</th>
                                        <th class="sorting_disabled"
                                            rowspan="1" colspan="1"
                                            style="width: 100px;">
                                            Cantidad</th>
                                        <th class="sorting_disabled"
                                            rowspan="1" colspan="1"
                                            style="width: 134px;text-align:center">
                                            Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $order->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="odd">
                                        <td class="pro-list-img"
                                            tabindex="0">
                                            <img src="<?php echo e(asset($product->product->image)); ?>"
                                                class="img-fluid"
                                                alt="tbl">
                                        </td>
                                        <td class="pro-name">
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
                                        <td>$<?php echo e(number_format($product->subtotal, 2, '.', ',')); ?></td>

                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Shopping cart start -->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ds_webmarket\resources\views/tenant/admin/orders/show.blade.php ENDPATH**/ ?>