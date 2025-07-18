

<?php $__env->startSection('metadata'); ?>
<title><?php echo e(config('app.name')); ?> - Registrar Usuario</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Registrar Nuevo usuario</h5>
            </div>
            <div class="card-block">
                <form method="POST" action="<?php echo e(route('users.store')); ?>" class="row">
                    <?php echo csrf_field(); ?>

                    <div class="col-md-3 form-group">
                        <label for="">Nombre Completo</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">E-Mail</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="">Contraseña</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Crear Usuario">
                        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary">Volver a Usuarios</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/central/admin/users/create.blade.php ENDPATH**/ ?>