<?php $__env->startSection('metadata'); ?>
<title><?php echo e(env('APP_NAME')); ?> - Lista de Productos</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Lista de Productos</h5>
                <a href="<?php echo e(url('products/create')); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Producto
                </a>
            </div>

            <div class="card-body table-responsive">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <table class="table table-bordered table-hover" id="datatable-buttons-table">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($product->id); ?></td>
                                <td style="width: 80px">
                                    <img src="<?php echo e(img64($product->image)); ?>" class="img-fluid rounded" style="max-height: 60px;">
                                </td>
                                <td><?php echo e($product->name); ?></td>
                                <td><?php echo e($product->category->name ?? 'Sin categoría'); ?></td>
                                <td>$<?php echo e(number_format($product->price, 2, ',', '.')); ?></td>
                                <td class="text-center align-middle">
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="active" class="form-check-input product-active" data-id="<?php echo e($product->id); ?>" <?php echo e($product->active ? 'checked' : ''); ?>>
                                            Activo
                                        </label>
                                    
                                        <label class="form-check-label">
                                            <input type="checkbox" name="visible" class="form-check-input product-visible" data-id="<?php echo e($product->id); ?>" <?php echo e($product->visible ? 'checked' : ''); ?>>
                                            Visible
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="<?php echo e(url('products/' . $product->id . '/edit')); ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>

                                    <form action="<?php echo e(url('products/' . $product->id . '/destroy')); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="text-center">No hay productos registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function () {
    // Manejador para ambos checkboxes
    $('.product-active, .product-visible').on('change', function () {
        const checkbox = $(this);
        const productId = checkbox.data('id');
        const isChecked = checkbox.is(':checked') ? 1 : 0;
        const field = checkbox.hasClass('product-active') ? 'active' : 'visible';

        $.ajax({
            url: "<?php echo e(url('products/toggle')); ?>",
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                id: productId,
                field: field,
                checked: isChecked
            },
            success: function (response) {
                if (!response.success) {
                    alert('Ocurrió un error al actualizar el estado.');
                    checkbox.prop('checked', !isChecked); // revertir el cambio si falla
                }
            },
            error: function () {
                alert('No se pudo actualizar el estado del producto.');
                checkbox.prop('checked', !isChecked); // revertir el cambio si falla
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/products/index.blade.php ENDPATH**/ ?>