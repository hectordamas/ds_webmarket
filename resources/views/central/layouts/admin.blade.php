@php
    $menus = collect([
        [
          'name' => 'Dashboard',
          'icon' => '<i class="fas fa-chart-pie"></i>',
          'ruta' => 'home',
          'subitems' => []
        ],
        [
            'name' => 'Dominios',
            'icon' => '<i class="fas fa-globe"></i>',
            'ruta' => 'products',
            'subitems' => [
                [
                    'name' => 'Lista de Dominios',
                    'icon' => '<i class="fas fa-list"></i>',
                    'ruta' => 'home'
                ],
                [
                    'name' => 'Crear Dominios',
                    'icon' => '<i class="far fa-plus-square"></i>',
                    'ruta' => 'tenants/create'
                ]
            ]
        ], 
        [
          'name' => 'Usuarios',
          'icon' => '<i class="fas fa-user"></i>',
          'ruta' => 'categories',
            'subitems' => [
                [
                    'name' => 'Lista de Categorías',
                    'icon' => '<i class="fas fa-list"></i>',
                    'ruta' => 'categories'
                ],
                [
                    'name' => 'Crear Categorías',
                    'icon' => '<i class="far fa-plus-square"></i>',
                    'ruta' => 'categories/create'
                ]
            ]          
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
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    @yield('metadata')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords"
        content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('central/assets/img/favicon.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('central/files/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <!-- Radial Chart -->
    <link rel="stylesheet" type="text/css" href="{{ asset('central/files/assets/pages/chart/radial/css/radial.css') }}">

    <!-- Feather Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('central/files/assets/icon/feather/css/feather.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />


    <link rel="stylesheet" type="text/css" href="{{ asset('central/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('central/files/assets/pages/data-table/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('central/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('central/files/assets/pages/data-table/extensions/buttons/css/buttons.dataTables.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('central/files/bower_components/select2/dist/css/select2.min.css') }}" />

    <!-- Multi Select CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('central/files/bower_components/bootstrap-multiselect/dist/css/bootstrap-multiselect.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('central/files/bower_components/multiselect/css/multi-select.css') }}" />

    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('central/files/assets/css/style.css') }}">

    <!-- Custom Scrollbar -->
    <link rel="stylesheet" type="text/css" href="{{ asset('central/files/assets/css/jquery.mCustomScrollbar.css') }}">

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
                        <a href="{{ url('home') }}">
                            <img class="img-fluid w-100" style="max-width:160px;" src="{{ asset('central/assets/img/logo-light.png') }}" alt="{{ env('APP_NAME') }} Logo" />
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

                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <img src="{{ asset('central/files/assets/images/avatar-4.jpg') }}" class="img-radius"
                                            alt="{{ Auth::user()->name }} foto de perfil">
                                        <span>{{ Auth::user()->name }}</span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu"
                                        data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <a href="javascript:void(0);">
                                                <i class="feather icon-log-out"></i> Salir
                                            </a>
                                        
                                            <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sidebar inner chat start-->
            <div class="showChat_inner">
                <div class="media chat-inner-header">
                    <a class="back_chatBox">
                        <i class="feather icon-chevron-left"></i> Josephin Doe
                    </a>
                </div>
                <div class="d-flex chat-messages">
                    <div class="flex-shrink-0">
                        <a class="media-left photo-table" href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="../files/assets/images/avatar-3.jpg"
                                alt="Generic placeholder image">
                        </a>
                    </div>
                    <div class="flex-grow-1 chat-menu-content">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex chat-messages">
                    <div class="flex-grow-1 chat-menu-reply">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="media-right photo-table">
                            <a href="#!">
                                <img class="media-object img-radius img-radius m-t-5"
                                    src="../files/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="chat-reply-box p-b-20">
                    <div class="right-icon-control">
                        <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                        <div class="form-icon">
                            <i class="feather icon-navigation"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="pcoded-navigatio-lavel">Menú</div>

                            <ul class="pcoded-item pcoded-left-item">
                                @foreach ($menus as $menu)
                                    <li class="{{ count($menu->subitems) ? 'pcoded-hasmenu' : '' }} {{ isMenuActive($menu) }}">
                                        <a href="{{ count($menu->subitems) ? 'javascript:void(0)' : url($menu->ruta) }}">
                                            <span class="pcoded-micon">{!! $menu->icon !!}</span>
                                            <span class="pcoded-mtext">{{ $menu->name }}</span>
                                        </a>
                                    
                                        @if (count($menu->subitems))
                                            <ul class="pcoded-submenu">
                                                @foreach ($menu->subitems as $sub)
                                                    <li class="{{ request()->is($sub->ruta) ? 'active' : '' }}">
                                                        <a href="{{ url($sub->ruta) }}">
                                                            {!! $sub->icon !!}
                                                            <span class="pcoded-mtext">{{ $sub->name }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                      @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('central/files/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/modernizr/modernizr.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/modernizr/feature-detects/css-scrollbars.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/chart.js/dist/Chart.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/widget/gauge/gauge.min.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/widget/amchart/amcharts.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/widget/amchart/serial.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/widget/amchart/gauge.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/widget/amchart/pie.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/widget/amchart/light.js') }}"></script>
    <script src="{{ asset('central/files/assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('central/files/assets/js/vartical-layout.min.js') }}"></script>
    <script src="{{ asset('central/files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/dashboard/crm-dashboard.min.js') }}"></script>

    <script src="{{ asset('central/files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/data-table/js/jszip.min.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/data-table/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/data-table/extensions/buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/data-table/extensions/buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/data-table/extensions/buttons/js/jszip.min.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/data-table/extensions/buttons/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/data-table/extensions/buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    
    <script src="{{ asset('central/files/assets/pages/data-table/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/data-table/extensions/buttons/js/extension-btns-custom.js') }}"></script>

    <script src="{{ asset('central/files/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- Multiselect js -->
    <script src="{{ asset('central/files/bower_components/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('central/files/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('central/files/assets/js/jquery.quicksearch.js') }}"></script>
    <script src="{{ asset('central/files/assets/pages/advance-elements/select2-custom.js') }}"></script>

    <script src="{{ asset('central/files/assets/js/script.js') }}"></script>
    <script src="{{ asset('central/assets/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('central/files/assets/js/script.js') }}"></script>
    <script src="{{ asset('central/assets/sweetalert2/sweetalert2.all.min.js') }}"></script>

    @yield('scripts')

    <script src="{{ asset('central/files/admin/script.js') }}"></script>

    @if(session()->has('success'))
    <script>	
        Swal.fire({
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "Continuar", 
            confirmButtonColor: '#28a745'
        });
    </script>
    @endif	

    @if(session()->has('error'))
    <script>	
        Swal.fire({
            text: "{{ session('error') }}",
            icon: "error",
            confirmButtonText: "Entendido!", 
            confirmButtonColor: '#dc3545'
        });
    </script>
    @endif	

    @foreach($errors->all() as $error)
    <script>	
        Swal.fire({
            text: "{{ $error }}",
            icon: "error",
            confirmButtonText: "Entendido!", 
            confirmButtonColor: '#dc3545'
        });
    </script>
    @endforeach
</body>

</html>