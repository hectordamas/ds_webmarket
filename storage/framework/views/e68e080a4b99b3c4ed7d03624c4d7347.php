<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo e(asset('central/assets/img/favicon.png')); ?>" type="image/x-icon">
        <?php echo $__env->yieldContent('metadata'); ?>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="<?php echo e(asset('central/assets/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="<?php echo e(asset('central/assets/css/style.css')); ?>">

        <?php echo $__env->yieldContent('styles'); ?>

    </head>
    <body>

        <?php echo $__env->yieldContent('content'); ?>
        
        <script src="<?php echo e(asset('central/assets/jquery.js')); ?>"></script>
        <script src="<?php echo e(asset('central/assets/bootstrap/js/bootstrap.min.js')); ?>"></script>
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
        <script src="<?php echo e(asset('central/assets/sweetalert2/sweetalert2.all.min.js')); ?>"></script>

        <?php if(session()->has('success')): ?>
        <script>	
            Swal.fire({
                text: "<?php echo e(session('success')); ?>",
                icon: "success",
                confirmButtonText: "Continuar", 
                confirmButtonColor: '#28a745'
            });
        </script>
        <?php endif; ?>	

        <?php if(session()->has('error')): ?>
        <script>	
            Swal.fire({
                text: "<?php echo e(session('error')); ?>",
                icon: "error",
                confirmButtonText: "Entendido!", 
                confirmButtonColor: '#dc3545'
            });
        </script>
        <?php endif; ?>	

        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <script>	
            Swal.fire({
                text: "<?php echo e($error); ?>",
                icon: "error",
                confirmButtonText: "Entendido!", 
                confirmButtonColor: '#dc3545'
            });
        </script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php echo $__env->yieldContent('scripts'); ?>

    </body>
</html>
<?php /**PATH C:\laragon\www\dswebmarket\resources\views/central/layouts/main.blade.php ENDPATH**/ ?>