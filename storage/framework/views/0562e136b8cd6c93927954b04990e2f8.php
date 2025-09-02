<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon.png')); ?>" type="image/x-icon">
        <?php echo $__env->yieldContent('metadata'); ?>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="<?php echo e(asset('assets/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css?v=1')); ?>">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <?php echo $__env->yieldContent('styles'); ?>

    </head>
    <body>

        <style>
            .loader-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: #141e30; /* Fondo oscuro o el que prefieras */
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
            }
        
            /* Spinner CSS */
            .spinner {
                width: 50px;
                height: 50px;
                border: 6px solid rgba(255, 255, 255, 0.2);
                border-top: 6px solid #00ffa2; /* Color principal */
                border-radius: 50%;
                animation: spin 0.8s linear infinite;
            }
        
            @keyframes spin {
                100% { transform: rotate(360deg); }
            }
        </style>
        
        <!-- LOADER -->
        <div id="loader" class="loader-overlay">
            <div class="spinner"></div>
        </div>

        <?php echo $__env->yieldContent('content'); ?>

        <?php if(request()->is('/') && tenant('activo')): ?>
            <?php echo $__env->make('tenant.shop.components.cart.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('tenant.shop.components.products.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        
        <script src="<?php echo e(asset('assets/jquery.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/bootstrap/js/bootstrap.min.js')); ?>"></script>
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
        <script src="<?php echo e(asset('assets/sweetalert2/sweetalert2.all.min.js')); ?>"></script>
        <?php echo $__env->yieldContent('scripts'); ?>

        <script>
            // Función para manejar el sticky de las categorías
            window.onscroll = function() { toggleSticky() };
        
            var categoriesContainer = document.querySelector('.bar-container');
            var stickyOffset = categoriesContainer.offsetTop;
        
            function toggleSticky() {
                if (window.pageYOffset > stickyOffset) {
                    categoriesContainer.classList.add('fixed');
                } else {
                    categoriesContainer.classList.remove('fixed');
                }
            }
        </script>


        <script>
            function goToTab(tabId) {
                const tabTrigger = new bootstrap.Tab(document.querySelector(`#${tabId}-tab`));
                tabTrigger.show();


                $(`#pedido-tab`).removeClass('text-tenant').addClass('text-muted');
                $(`#checkout-tab`).removeClass('text-tenant').addClass('text-muted');
                $(`#confirmar-tab`).removeClass('text-tenant').addClass('text-muted');

                $(`#${tabId}-tab`).addClass('text-tenant').removeClass('text-muted');

            }
        </script>

        <script>
            document.getElementById('btnCartManual').addEventListener('click', function () {
                const offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasCart'));
                offcanvas.show();
            });
        </script>

        <script>
            $(document).ready(function () {
                $('.search_trigger').on('click', function () {
                    $('.search_overlay, .search_wrap').addClass('open');
                    setTimeout(() => {
                        $('#search_input').trigger('focus');
                    }, 100);                
                });
            
                $('.close-search, .search_overlay').on('click', function () {
                    $('.search_overlay, .search_wrap').removeClass('open');
                });
            
                $(document).on('keydown', function (e) {
                    if (e.key === "Escape") {
                        $('.search_overlay, .search_wrap').removeClass('open');
                    }
                });
            
                // Evita que el clic dentro del form cierre el overlay
                $('.search_wrap form').on('click', function (e) {
                    e.stopPropagation();
                });

                $('.search_wrap form').on('submit', function(e) {
                    e.preventDefault(); // Evita el reload
                    $('.search_overlay, .search_wrap').removeClass('open');
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                $('#loader').fadeOut();
            });
        </script>


    </body>
</html>
<?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/layouts/app.blade.php ENDPATH**/ ?>