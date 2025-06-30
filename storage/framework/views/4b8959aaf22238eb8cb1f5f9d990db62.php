<?php $__env->startSection('metadata'); ?>
<title>Crear Tenant - <?php echo e(env('APP_NAME')); ?> </title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h5>Crear Nuevo Tenant</h5>
            </div>
            <div class="card-block">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form action="<?php echo e(route('tenants.store')); ?>" method="POST" class="row">
                    <?php echo csrf_field(); ?>
                    <div class="form-group col-md-3 mb-3">
                        <label for="id" class="form-label">Prefijo del Subdominio</label>
                        <input type="text" name="id" id="id" class="form-control" value="<?php echo e(old('id')); ?>" required>
                    </div>
                    <div class="form group col-md-3 mb-3">
                        <label for="nombre_empresa"  class="form-label">Nombre de la Empresa</label>
                        <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control" value="<?php echo e(old('nombre_empresa')); ?>">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="database" class="form-label">Nombre de la Base de Datos</label>
                        <input type="text" name="database" id="database" class="form-control" value="<?php echo e(old('database')); ?>" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="username" class="form-label">Usuario de la BD</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?php echo e(old('username')); ?>" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="password" class="form-label">Contraseña de la BD</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="<?php echo e(old('fecha_vencimiento')); ?>" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="form-label d-block">Activo</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="activo" id="activo" <?php echo e(old('activo', true) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="activo">Habilitado</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="<?php echo e(route('tenants.index')); ?>" class="btn btn-secondary me-2">Cancelar</a>
                        <button type="submit" class="btn btn-success">Crear Tenant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('central.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ds_webmarket\resources\views/central/admin/tenant/create.blade.php ENDPATH**/ ?>