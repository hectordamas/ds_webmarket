<?php $__env->startSection('metadata'); ?>
<title><?php echo e(config('app.name')); ?> - Lista de Categorías</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Lista de Categorías</h5>
                <a href="<?php echo e(url('categories/create')); ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Nueva Categoría
                </a>
            </div>

            <div class="card-body table-responsive">

                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Slug</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-categories">
                        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr data-id="<?php echo e($category->id); ?>">
                                <td><?php echo e($category->name); ?></td>
                                <td><?php echo e($category->slug); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo e($category->active ? 'success' : 'secondary'); ?>">
                                        <?php echo e($category->active ? 'Activo' : 'Inactivo'); ?>

                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo e(url('categories/' . $category->id . '/edit')); ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                
                                    <form action="<?php echo e(url('categories/' . $category->id . '/destroy')); ?>" method="POST" class="d-inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('POST'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4">No hay categorías registradas aún.</td>
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
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
$(function () {
    $('#sortable-categories').sortable({
        update: function () {
            let order = [];
            $('#sortable-categories tr').each(function (index, element) {
                order.push({
                    id: $(element).data('id'),
                    position: index + 1
                });
            });

            $.ajax({
                url: "<?php echo e(url('categories/sort')); ?>",
                method: 'POST',
                data: {
                    order: order,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function (response) {
                    console.log(response.message);
                },
                error: function () {
                    alert('Hubo un error al guardar el orden.');
                }
            });
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ds_webmarket\resources\views/tenant/admin/categories/index.blade.php ENDPATH**/ ?>