

<?php $__env->startSection('metadata'); ?>
    <title><?php echo e(config('app.name')); ?> - Carga Masiva de Imágenes</title>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header text-white rounded-top-4 d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class="fas fa-upload me-2"></i> Subir Imágenes de Productos</h5>
            </div>
                        <form action="<?php echo e(url('images/store')); ?>" class="dropzone" id="dropzone" enctype="multipart/form-data" method="post">
                            <div class="dz-message text-center">
                                <i class="fa fa-upload" style="font-size:30px; margin-bottom:20px;"></i>
                                <h4>Subir Imágenes</h4>
                            </div>
                            <?php echo csrf_field(); ?>
                            <input type="imagenes" name="imagenes" multiple accept=".jpg" style="display: none;"/>
                        </form>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
Dropzone.autoDiscover = false;

$(document).ready(function () {
    // Inicialización manual SIN duplicar
    new Dropzone("#dropzone", {
        acceptedFiles: "image/*",
        maxFilesize: 5, // opcional: tamaño máximo en MB
        success: function (file, response) {
            console.log("Subido correctamente:", response);
        },
        error: function (file, response) {
            console.error("Error al subir:", response);
        }
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/images/upload.blade.php ENDPATH**/ ?>