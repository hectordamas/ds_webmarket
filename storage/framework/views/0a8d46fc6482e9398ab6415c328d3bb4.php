

<?php $__env->startSection('metadata'); ?>
<title><?php echo e(config('app.name')); ?> - Listado de Usuarios</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Listado de Usuarios</h5>
                <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary">
                    <i class="far fa-plus-square"></i> Registrar Usuario
                </a>
            </div>
            <div class="card-block dt-responsive table-responsive">
                <table class="table table-bordered table-striped" id="datatable-buttons-table"> 
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>E-Mail</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($user->id); ?></td>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td class="text-center align-middle">
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="activo" class="form-check-input users-active" data-id="<?php echo e($user->id); ?>" <?php echo e($user->activo ? 'checked' : ''); ?>>
                                        Activo
                                    </label>
                                
                                </div>
                            </td>
                            <td>
                                <a href="<?php echo e(route('users.edit', [ $user ])); ?>" class="btn btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botón para eliminar -->
                                <form action="<?php echo e(route('users.destroy', [ $user ])); ?>" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    $('.users-active').on('change', function () {
        const checkbox = $(this);
        const userId = checkbox.data('id');
        const isChecked = checkbox.is(':checked') ? 1 : 0;
        const field = checkbox.hasClass('users-active') ? 'activo' : 'visible';

        $.ajax({
            url: "<?php echo e(url('users/toggle')); ?>",
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                id: userId,
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
                alert('No se pudo actualizar el estado del usuario.');
                checkbox.prop('checked', !isChecked); // revertir el cambio si falla
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/central/admin/users/index.blade.php ENDPATH**/ ?>