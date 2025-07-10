<?php $__env->startSection('metadata'); ?>
<title><?php echo e(env('APP_NAME')); ?> - Configuración</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header"><h5>Configuración General</h5></div>
            <div class="card-block">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(url('settings/update')); ?>" enctype="multipart/form-data" class="row">
                    <?php echo csrf_field(); ?>

                    <div class="form-group col-md-3 mb-3">
                        <label>Logo actual:</label><br>
                        <img src="<?php echo e(img64($settings['logo'] ?? 'assets/img/logo-color.png')); ?>" height="60" alt="Logo actual">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="logo">Subir nuevo logo:</label>
                        <input type="file" name="logo" id="logo" class="form-control">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="whatsapp_human">Número de WhatsApp:</label>
                        <input type="text" name="whatsapp_human" id="whatsapp_human" class="form-control" value="<?php echo e($settings['whatsapp_human'] ?? ''); ?>" placeholder="+58 424-1234567">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="color_primary">Color Primario:</label>
                        <input type="color" name="color_primary" id="color_primary" class="form-control" value="<?php echo e($settings['color_primary'] ?? '#00b894'); ?>">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="facebook">Enlace Facebook:</label>
                        <input type="text" name="facebook" id="facebook" class="form-control" value="<?php echo e($settings['facebook'] ?? ''); ?>">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="instagram">Enlace Instagram:</label>
                        <input type="text" name="instagram" id="instagram" class="form-control" value="<?php echo e($settings['instagram'] ?? ''); ?>">
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar Configuración
                        </button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/settings/index.blade.php ENDPATH**/ ?>