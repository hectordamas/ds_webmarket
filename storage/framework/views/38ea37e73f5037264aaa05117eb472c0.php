

<?php $__env->startSection('metadata'); ?>
    <title>Nuevo Usuario - <?php echo e(config('app.name')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-tenant text-white">
            <h5 class="mb-0">Modificar Usuario</h5>
        </div>
        <div class="card-body">
            <form action="<?php echo e(url('usuarios/' . $user->id )); ?>" method="POST" class="row">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="mb-3 col-md-4">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" value="<?php echo e($user->name); ?>" required>
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" value="<?php echo e($user->email); ?>" required>
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Cambiar Contraseña</label>
                    <input type="password" name="password" class="form-control" >
                </div>

                <div class="col-md-12">
                    <a href="<?php echo e(url('usuarios')); ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/users/edit.blade.php ENDPATH**/ ?>