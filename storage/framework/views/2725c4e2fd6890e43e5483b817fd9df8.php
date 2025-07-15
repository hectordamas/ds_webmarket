<?php
    $menus = collect([
        [
            'name' => 'Dashboard',
            'icon' => '<i class="fas fa-chart-pie"></i>',
            'ruta' => 'home',
            'subitems' => []
        ],
        [
            'name' => 'Productos',
            'icon' => '<i class="fas fa-hamburger"></i>',
            'ruta' => 'products',
            'subitems' => [
                [
                    'name' => 'Lista de Productos',
                    'icon' => '<i class="fas fa-list"></i>',
                    'ruta' => 'products'
                ],
                [
                    'name' => 'Crear Producto',
                    'icon' => '<i class="far fa-plus-square"></i>',
                    'ruta' => 'products/create'
                ]
            ]
        ],
        [
            'name' => 'Categorías',
            'icon' => '<i class="fas fa-layer-group"></i>',
            'ruta' => 'categories',
            'subitems' => [
                [
                    'name' => 'Lista de Categorías',
                    'icon' => '<i class="fas fa-list"></i>',
                    'ruta' => 'categories'
                ],
                [
                    'name' => 'Crear Categoría',
                    'icon' => '<i class="far fa-plus-square"></i>',
                    'ruta' => 'categories/create'
                ]
            ]
        ],
        [
            'name' => 'Órdenes',
            'icon' => '<i class="fas fa-receipt"></i>',
            'ruta' => 'orders',
            'subitems' => [
                [
                    'name' => 'Lista de Órdenes',
                    'icon' => '<i class="fas fa-list"></i>',
                    'ruta' => 'orders'
                ],
            ]
        ],
        [
            'name' => 'Usuarios',
            'icon' => '<i class="fas fa-user"></i>',
            'ruta' => 'orders',
            'subitems' => [
                [
                    'name' => 'Lista de Usuarios',
                    'icon' => '<i class="fas fa-list"></i>',
                    'ruta' => 'usuarios'
                ],
                [
                    'name' => 'Registrar Usuario',
                    'icon' => '<i class="fas fa-plus"></i>',
                    'ruta' => 'usuarios/create'
                ]
            ]
        ],
        [
            'name' => 'Métodos de Pago', 
            'icon' => '<i class="far fa-credit-card"></i>',
            'ruta' => 'payments',
            'subitems' => []
        ],
        [
            'name' => 'Configuración',
            'icon' => '<i class="fas fa-cog"></i>',
            'ruta' => 'settings',
            'subitems' => []
        ]
    ])->map(function ($item) {
        $item['subitems'] = collect($item['subitems'])->map(fn($sub) => (object) $sub)->all();
        return (object) $item;
    });
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->yieldContent('metadata'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('assets/img/favicon.png')); ?>" type="image/x-icon"> 

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('files/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">

    <!-- Radial Chart CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('files/assets/pages/chart/radial/css/radial.css')); ?>" media="all">

    <!-- Feather Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('files/assets/icon/feather/css/feather.css')); ?>">


    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('files/assets/pages/data-table/extensions/buttons/css/buttons.dataTables.min.css')); ?>">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('files/bower_components/select2/dist/css/select2.min.css')); ?>" />

    <!-- Multi Select CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('files/bower_components/bootstrap-multiselect/dist/css/bootstrap-multiselect.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('files/bower_components/multiselect/css/multi-select.css')); ?>" />

    <!-- Main Styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('files/assets/css/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('files/assets/css/jquery.mCustomScrollbar.css')); ?>">



    <!-- Style.css -->
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<!-- Menu sidebar static layout -->

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="<?php echo e(url('home')); ?>">
                            <img class="img-fluid w-100" style="max-width:160px;" src="<?php echo e(asset('assets/img/logo-light.png')); ?>" alt="<?php echo e(env('APP_NAME')); ?> Logo" />
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container">
                        <ul class="nav-left">
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close">
										<i class="feather icon-x input-group-text"></i>
									</span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn">
										<i class="feather icon-search input-group-text"></i>
									</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                <i class="full-screen feather icon-maximize"></i>
                            </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="feather icon-bell"></i>
                                        
                                        <span id="badge-container" class="<?php echo e($notificacionesNoLeidas > 0 ? '' : 'd-none'); ?>">
                                            <span id="notificaciones-badge" class="badge bg-c-pink">
                                                <?php echo e($notificacionesNoLeidas); ?>

                                            </span>
                                        </span>

                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <h6>Notificaciones</h6>
                                            <?php if($notificacionesNoLeidas > 0): ?>
                                                <label class="form-label label label-danger">Nuevo</label>
                                            <?php endif; ?>
                                        </li>

                                        <div class="notifications-list">
                                            <?php echo $__env->make('tenant.admin.orders.partials.notifications', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>

                                    </ul>
                                </div>
                            </li>
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <img src="<?php echo e(asset('files/assets/images/avatar-4.jpg')); ?>" class="img-radius"
                                            alt="<?php echo e(Auth::user()->name); ?> foto de perfil">
                                        <span><?php echo e(Auth::user()->name); ?></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <a href="javascript:void(0);">
                                                <i class="feather icon-log-out"></i> Salir
                                            </a>
                                        
                                            <form id="logout-form" action="<?php echo e(url('logout')); ?>" method="POST" class="d-none">
                                                <?php echo csrf_field(); ?>
                                            </form>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="pcoded-navigatio-lavel">Menú</div>
                            <!-- Luego en el loop -->

                            <ul class="pcoded-item pcoded-left-item">
                                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="<?php echo e(count($menu->subitems) ? 'pcoded-hasmenu' : ''); ?> <?php echo e(isMenuActive($menu)); ?>">
                                        <a href="<?php echo e(count($menu->subitems) ? 'javascript:void(0)' : url($menu->ruta)); ?>">
                                            <span class="pcoded-micon"><?php echo $menu->icon; ?></span>
                                            <span class="pcoded-mtext"><?php echo e($menu->name); ?></span>
                                        </a>
                                    
                                        <?php if(count($menu->subitems)): ?>
                                            <ul class="pcoded-submenu">
                                                <?php $__currentLoopData = $menu->subitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li class="<?php echo e(request()->is($sub->ruta) ? 'active' : ''); ?>">
                                                        <a href="<?php echo e(url($sub->ruta)); ?>">
                                                            <?php echo $sub->icon; ?>

                                                            <span class="pcoded-mtext"><?php echo e($sub->name); ?></span>
                                                        </a>
                                                    </li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                      <?php echo $__env->yieldContent('content'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('files/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/popper.js/dist/umd/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/jquery-slimscroll/jquery.slimscroll.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/modernizr/modernizr.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/modernizr/feature-detects/css-scrollbars.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/chart.js/dist/Chart.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/widget/gauge/gauge.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/widget/amchart/amcharts.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/widget/amchart/serial.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/widget/amchart/gauge.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/widget/amchart/pie.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/widget/amchart/light.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/js/pcoded.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/js/vartical-layout.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/js/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>

    <script src="<?php echo e(asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/data-table/js/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/data-table/js/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/data-table/js/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/data-table/extensions/buttons/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/data-table/extensions/buttons/js/buttons.flash.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/data-table/extensions/buttons/js/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/data-table/extensions/buttons/js/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/data-table/extensions/buttons/js/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
    
    <script src="<?php echo e(asset('files/assets/pages/data-table/js/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/data-table/extensions/buttons/js/extension-btns-custom.js')); ?>"></script>

    <script src="<?php echo e(asset('files/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
    <!-- Multiselect js -->
    <script src="<?php echo e(asset('files/bower_components/bootstrap-multiselect/dist/js/bootstrap-multiselect.js')); ?>"></script>
    <script src="<?php echo e(asset('files/bower_components/multiselect/js/jquery.multi-select.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/js/jquery.quicksearch.js')); ?>"></script>
    <script src="<?php echo e(asset('files/assets/pages/advance-elements/select2-custom.js')); ?>"></script>

    <script src="<?php echo e(asset('files/assets/js/script.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/sweetalert2/sweetalert2.all.min.js')); ?>"></script>

    <?php echo $__env->yieldContent('scripts'); ?>

    <script src="<?php echo e(asset('files/admin/script.js')); ?>"></script>

    <script>
        // contador global que se actualiza con cada polling
        let contadorActual = <?php echo e($notificacionesNoLeidas ?? 0); ?>;
        let originalTitle = document.title;

        function fetchNotificaciones() {
            $.ajax({
                url: "<?php echo e(url('notificaciones/polling')); ?>",
                method: "GET",
                success: function (data) {
                    $('.notifications-list').html(data.html);

                    // Actualizar badge
                    const badgeContainer = $('#badge-container');
                    const badge =  $('#notificaciones-badge');
                    if (data.contador > 0) {
                        badge.text(data.contador)
                        badgeContainer.removeClass('d-none');

                        document.title = `(${data.contador}) ${originalTitle.replace(/^\(\d+\)\s*/, '')}`;
                    } else {
                        badgeContainer.addClass('d-none');

                        document.title = originalTitle.replace(/^\(\d+\)\s*/, '');
                    }
                    
                    // Reproducir sonido solo si el nuevo contador es mayor
                    if (data.contador > contadorActual) {
                        const sonido = new Audio("<?php echo e(asset('assets/notificacion.mp3')); ?>");
                        sonido.play().catch((e) => {
                            console.warn("Error al reproducir sonido:", e);
                        });
                    }

                    // Actualizar el contador global con el más reciente
                    contadorActual = data.contador;
                }
            });
        }

        // Iniciar polling cada 15 segundos
        setInterval(fetchNotificaciones, 15000);
    </script>

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
</body>

</html><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/layouts/admin.blade.php ENDPATH**/ ?>