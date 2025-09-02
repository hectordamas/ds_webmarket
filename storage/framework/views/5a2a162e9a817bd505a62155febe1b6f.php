<?php $__env->startSection('metadata'); ?>
<title><?php echo e(config('app.name')); ?> - Configuración</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h5>Configuración General</h5>
            </div>
            <div class="card-block">

                <!-- Tabs -->
                <ul class="nav nav-tabs md-tabs mb-4" id="settingsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link fw-bold active" id="appearance-tab" data-bs-toggle="tab" href="#appearance" type="button" role="tab">
                            🎨 Apariencia
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link fw-bold" id="info-tab" data-bs-toggle="tab" href="#info" type="button" role="tab">
                            🧾 Información
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link fw-bold" id="preferences-tab" data-bs-toggle="tab" href="#preferences" type="button" role="tab">
                            ⚙️ Preferencias
                        </a>
                        <div class="slide"></div>
                    </li>
                </ul>

                <form method="POST" action="<?php echo e(url('settings/update')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <!-- Contenido de pestañas -->
                    <div class="tab-content" id="settingsTabContent">
                    
                        <!-- Apariencia -->
                        <div class="tab-pane fade show active" id="appearance" role="tabpanel">
                            <div class="bg-light p-4 rounded shadow-sm">
                                <div class="row align-items-center">
                                    <div class="form-group col-md-3 mb-4 text-center">
                                        <label class="fw-semibold d-block mb-2">Logo actual:</label>
                                        <img src="<?php echo e(img64($settings['logo'] ?? 'assets/img/logo-color.png')); ?>" height="60" alt="Logo actual" class="img-thumbnail">
                                    </div>
                                    <div class="form-group col-md-5 mb-4">
                                        <label for="logo" class="fw-semibold">Subir nuevo logo:</label>
                                        <input type="file" name="logo" id="logo" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4 mb-4">
                                        <label for="color_primary" class="fw-semibold">Color Primario:</label>
                                        <input type="color" name="color_primary" id="color_primary" class="form-control form-control-color" value="<?php echo e($settings['color_primary'] ?? '#00b894'); ?>" title="Elige un color">
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Información -->
                        <div class="tab-pane fade" id="info" role="tabpanel">
                            <div class="bg-light p-4 rounded shadow-sm">
                                <div class="row">
                                    <div class="form group col-md-4 mb-3">
                                        <label for="nombre_empresa"  class="form-label">Nombre de la Empresa</label>
                                        <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control" value="<?php echo e(tenant('nombre_empresa')); ?>">
                                    </div>
                                    <div class="form-group col-md-4 mb-4">
                                        <label for="whatsapp_human" class="form-label">Número de WhatsApp:</label>
                                        <input type="text" name="whatsapp_human" id="whatsapp_human" class="form-control" value="<?php echo e($settings['whatsapp_human'] ?? ''); ?>" placeholder="+58 424-1234567">
                                    </div>
                                    <div class="form-group col-md-4 mb-4">
                                        <label for="facebook" class="form-label">Enlace Facebook:</label>
                                        <input type="text" name="facebook" id="facebook" class="form-control" value="<?php echo e($settings['facebook'] ?? ''); ?>">
                                    </div>
                                    <div class="form-group col-md-4 mb-4">
                                        <label for="instagram" class="form-label">Enlace Instagram:</label>
                                        <input type="text" name="instagram" id="instagram" class="form-control" value="<?php echo e($settings['instagram'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Preferencias -->
                        <div class="tab-pane fade" id="preferences" role="tabpanel">
                            <div class="bg-light p-4 rounded shadow-sm"> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="allow_out_of_stock" value="0"> <!-- fallback -->
                                            <input 
                                                class="form-check-input" 
                                                type="checkbox" 
                                                id="allowOutOfStock" 
                                                name="allow_out_of_stock" 
                                                value="1" 
                                                <?php echo e(filter_var($settings['allow_out_of_stock'] ?? false, FILTER_VALIDATE_BOOLEAN) ? 'checked' : ''); ?>

                                            >
                                            <label class="form-check-label" for="allowOutOfStock">
                                                Mostrar productos sin stock
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-light p-4 rounded shadow-sm mt-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="priceList" class="form-label">
                                            Lista de precios a sincronizar
                                        </label>
                                        <select class="form-select" id="priceList" name="price_list">
                                            <option value="precio1" <?php echo e(($settings['price_list'] ?? 'precio1') === 'precio1' ? 'selected' : ''); ?>>Precio 1</option>
                                            <option value="precio2" <?php echo e(($settings['price_list'] ?? '') === 'precio2' ? 'selected' : ''); ?>>Precio 2</option>
                                            <option value="precio3" <?php echo e(($settings['price_list'] ?? '') === 'precio3' ? 'selected' : ''); ?>>Precio 3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    
                    </div>

                    <div class="mt-4">
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