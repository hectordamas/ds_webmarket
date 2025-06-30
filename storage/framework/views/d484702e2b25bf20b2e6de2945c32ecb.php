<?php $__env->startSection('metadata'); ?>
<title>Editar Tenant - <?php echo e(env('APP_NAME')); ?> </title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
               <h5>Editar Tenant</h5> 
            </div>
            <div class="card-block row">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('tenants.update', $tenant->id)); ?>" method="POST" class="row">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="form-group col-md-3 mb-3">
                        <label for="id" class="form-label">Prefijo del Subdominio</label>
                        <input type="text" id="id" class="form-control" value="<?php echo e($tenant->id); ?>" disabled>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="database" class="form-label">Nombre de la Base de Datos</label>
                        <input type="text" name="database" id="database" class="form-control"
                            value="<?php echo e(old('database', $tenant->data['tenancy_db_name'] ?? '')); ?>" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="username" class="form-label">Usuario de la BD</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="<?php echo e(old('username', $tenant->data['tenancy_db_username'] ?? '')); ?>" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="password" class="form-label">Contraseña de la BD</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Dejar en blanco para no cambiar">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control"
                            value="<?php echo e(old('fecha_vencimiento', $tenant->fecha_vencimiento ? \Carbon\Carbon::parse($tenant->fecha_vencimiento)->format('Y-m-d') : '')); ?>" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="form-label d-block">Activo</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="activo" id="activo"
                                <?php echo e(old('activo', $tenant->activo) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="activo">Habilitado</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <a href="<?php echo e(route('tenants.index')); ?>" class="btn btn-secondary me-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Tenant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('central.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ds_webmarket\resources\views/central/admin/tenant/edit.blade.php ENDPATH**/ ?>