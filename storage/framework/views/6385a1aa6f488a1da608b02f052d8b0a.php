

<?php $__env->startSection('metadata'); ?>
<title><?php echo e(config('app.name')); ?> - Sitio no encontrado
</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh; background: linear-gradient(135deg, #f0f2f5, #d9e2ec);">
    <div class="text-center p-5 rounded-4 shadow-lg bg-white" style="max-width: 500px; width: 100%;">
        
        
        <div class="mb-4">
            <img src="<?php echo e(asset('central/assets/img/logo-color.png')); ?>" alt="Logo" style="max-width: 160px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">
        </div>

        
        <div class="mb-4">
            <i class="bi bi-globe2 text-danger" style="font-size: 3rem;"></i>
        </div>

        
        <h3 class="text-dark fw-bold mb-3">Página no encontrada</h3>

        
        <p class="text-muted mb-4" style="font-size: 1.1rem;">
            La página que estás intentando acceder no existe o ha sido desactivada.
            Si crees que esto es un error, contáctanos.
        </p>

        
        <a href="<?php echo e(url(env('WHATSAPP_SUPPORT_URL'))); ?>" target="_blank" class="btn btn-success rounded-pill px-4 py-2 fw-semibold">
            Contactar Soporte
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('central.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/errors/tenant_not_found.blade.php ENDPATH**/ ?>