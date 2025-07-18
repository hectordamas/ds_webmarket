

<?php $__env->startSection('metadata'); ?>
<title><?php echo e(config('app.name')); ?> - Editar Usuario</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Editar Usuario #<?php echo e($user->id); ?></h5>
            </div>
            <div class="card-block">
                <form method="POST" action="<?php echo e(route('users.update', $user)); ?>" class="row">
                    <?php echo method_field('PUT'); ?>
                    <?php echo csrf_field(); ?>

                    <div class="col-md-3 form-group">
                        <label for="">Nombre Completo</label>
                        <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>" required>
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">E-Mail</label>
                        <input type="email" class="form-control" name="email" value="<?php echo e($user->email); ?>" required>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="">Contraseña</label>
                        <input type="password" class="form-control" name="password">
                    </div>

                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Actualizar Usuario">
                        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary">Volver a Usuarios</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ds_webmarket\resources\views/central/admin/users/edit.blade.php ENDPATH**/ ?>