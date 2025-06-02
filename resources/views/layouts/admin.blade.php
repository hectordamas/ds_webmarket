<!DOCTYPE html>
<html lang="en">

<head> 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!-- Primary Meta Tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ env('APP_NAME') }} - Panel Administrativo</title>
  	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />

  <!-- Sweet Alert -->
  <link type="text/css" href="{{ asset('adminAssets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">

  <!-- Notyf -->
  <link type="text/css" href="{{ asset('adminAssets/vendor/notyf/notyf.min.css') }}" rel="stylesheet">

  <!-- Volt CSS -->
  <link type="text/css" href="{{ asset('adminAssets/css/volt.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

  @php
      $menus = collect([
          [
            'name' => 'Dashboard',
            'icon' => '<i class="fas fa-chart-pie"></i>',
            'ruta' => 'home',
            'subitems' => []
          ],
          [
              'name' => 'Productos',
              'icon' => '<i class="fas fa-box"></i>',
              'ruta' => 'products',
              'subitems' => [
                  [
                      'name' => 'Lista de Productos',
                      'icon' => '<i class="fas fa-list"></i>',
                      'ruta' => 'products'
                  ],
                  [
                      'name' => 'Crear Productos',
                      'icon' => '<i class="far fa-plus-square"></i>',
                      'ruta' => 'products/create'
                  ]
              ]
          ], 
          [
            'name' => 'Categorias',
            'icon' => '<i class="fas fa-tag"></i>',
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
            'name' => 'Órdenes',
            'icon' => '<i class="fas fa-shopping-cart"></i>',
            'ruta' => 'orders',
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
  @endphp

</head>

<body>


  <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
      <a class="navbar-brand me-lg-5" href="{{ url('/') }}">
        <img class="img-fluid" src="{{ asset('assets/img/logo-light.png') }}" style="max-width: 150px;" alt="{{ env('APP_NAME') }} Logo" />
      </a>
      <div class="d-flex align-items-center">
          <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      </div>
  </nav>

  <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
      <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
        <div class="d-flex align-items-center">
          <div class="avatar-lg me-4">
              <img class="avatar rounded-circle" src="{{ asset('adminAssets/assets/img/team/profile-picture-3.jpg') }}" alt="{{ Auth::user()->name }} foto de perfil">
          </div>
          <div class="d-block">
            <h2 class="h5 mb-3">Hola, {{ Auth::user()->name }} </h2>
            <form action="{{ url('logout') }}" method="POST" class="logout-form">
              @csrf
            </form>
            <a href="javascript:void(0)" class="btn btn-secondary btn-sm d-inline-flex align-items-center logout-button">
              <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>            
              Salir
            </a>
          </div>
        </div>
        <div class="collapse-close d-md-none">
          <a href="#sidebarMenu" data-bs-toggle="collapse"
              data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true"
              aria-label="Toggle navigation">
              <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
        </div>
      </div>
      <ul class="nav flex-column pt-3 pt-md-0">
        <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link d-flex align-items-center">
              <img class="img-fluid" src="{{ asset('assets/img/logo-light.png') }}" style="max-width: 150px;" alt="{{ env('APP_NAME')}} Logo" >
          </a>
        </li>
        <li role="separator" class="dropdown-divider border-gray-700"></li>
        @foreach($menus as $index => $menu)
          @if (!empty($menu->subitems))
            <li class="nav-item">
              <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-{{ $index }}">
                <span>
                  <span class="sidebar-icon">
                    {!! $menu->icon !!}
                  </span>
                  <span class="sidebar-text">{{ $menu->name }}</span>
                </span>
                <span class="link-arrow">
                  <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                </span>
              </span>
            
              <div class="collapse multi-level" role="list" aria-expanded="false" id="submenu-{{ $index }}">
                <ul class="nav flex-column">
                  @foreach($menu->subitems as $sub)
                    <li class="nav-item" style="margin-left: -15px;">
                      <a href="{{ url($sub->ruta) }}" class="nav-link">
                        <span class="sidebar-text">{{ $sub->name }}</span>
                      </a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </li>
          @else
            <li class="nav-item">
              <a href="{{ url($menu->ruta) }}" class="nav-link">
                <span class="sidebar-icon">
                  {!! $menu->icon !!}
                </span>
                <span class="sidebar-text">{{ $menu->name }}</span>
              </a>
            </li>
          @endif
          @if($menu->name == 'Dashboard' || $menu->name == 'Órdenes')
            <li role="separator" class="dropdown-divider border-gray-700"></li>
          @endif
        @endforeach
      </ul>
    </div>
  </nav>
    
<main class="content">

    <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0 bg-light">
      <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
          <div class="d-flex align-items-center">
            <!-- Search form -->
            <form class="navbar-search form-inline" id="navbar-search-main">
              <div class="input-group input-group-merge search-bar">
                  <span class="input-group-text" id="topbar-addon">
                    <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                    </svg>
                  </span>
                  <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search" aria-label="Search" aria-describedby="topbar-addon">
              </div>
            </form>
            <!-- / Search form -->
          </div>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center">
            <li class="nav-item dropdown">
              <a class="nav-link text-dark notification-bell unread dropdown-toggle" data-unread-notifications="true" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                <svg class="icon icon-sm text-gray-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center mt-2 py-0">
                <div class="list-group list-group-flush">
                  <a href="#" class="text-center text-primary fw-bold border-bottom border-light py-3">Notifications</a>
                  <a href="#" class="list-group-item list-group-item-action border-bottom">
                    <div class="row align-items-center">
                        <div class="col-auto">
                          <!-- Avatar -->
                          <img alt="Image placeholder" src="{{ asset('adminAssets/assets/img/team/profile-picture-1.jpg') }}" class="avatar-md rounded">
                        </div>
                        <div class="col ps-0 ms-2">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                <h4 class="h6 mb-0 text-small">Jose Leos</h4>
                              </div>
                              <div class="text-end">
                                <small class="text-danger">a few moments ago</small>
                              </div>
                          </div>
                          <p class="font-small mt-1 mb-0">Added you to an event "Project stand-up" tomorrow at 12:30 AM.</p>
                        </div>
                    </div>
                  </a>
                  <a href="#" class="list-group-item list-group-item-action border-bottom">
                    <div class="row align-items-center">
                        <div class="col-auto">
                          <!-- Avatar -->
                          <img alt="Image placeholder" src="{{ asset('adminAssets/assets/img/team/profile-picture-2.jpg') }}" class="avatar-md rounded">
                        </div>
                        <div class="col ps-0 ms-2">
                          <div class="d-flex justify-content-between align-items-center">
                              <div>
                                <h4 class="h6 mb-0 text-small">Neil Sims</h4>
                              </div>
                              <div class="text-end">
                                <small class="text-danger">2 hrs ago</small>
                              </div>
                          </div>
                          <p class="font-small mt-1 mb-0">You've been assigned a task for "Awesome new project".</p>
                        </div>
                    </div>
                  </a>
                  <a href="#" class="dropdown-item text-center fw-bold rounded-bottom py-3">
                    <svg class="icon icon-xxs text-gray-400 me-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                    View all
                  </a>
                </div>
              </div>
            </li>
            <li class="nav-item dropdown ms-lg-3">
              <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="media d-flex align-items-center">
                  <img class="avatar rounded-circle" alt="Image placeholder" src="{{ asset('adminAssets/assets/img/team/profile-picture-3.jpg') }}">
                  <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                    <span class="mb-0 font-small fw-bold text-gray-900">{{ Auth::user()->name }}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>
                  My Profile
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                  Settings
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z" clip-rule="evenodd"></path></svg>
                  Messages
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"></path></svg>
                  Support
                </a>
                <div role="separator" class="dropdown-divider my-1"></div>
                <a class="dropdown-item d-flex align-items-center logout-button" href="javascript:void(0)">
                  <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>                
                  Salir
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="py-4">
        <div class="dropdown">
            <button class="btn btn-gray-800 d-inline-flex align-items-center me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                New Task
            </button>
            <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path></svg>
                    Add User
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>                            
                    Add Widget
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path><path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path></svg>                            
                    Upload Files
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    Preview Security
                </a>
                <div role="separator" class="dropdown-divider my-1"></div>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <svg class="dropdown-icon text-danger me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
                    Upgrade to Pro
                </a>
            </div>
        </div>
    </div>

    @yield('content')



    <footer class="bg-white rounded shadow p-5 mb-4 mt-4">
        <div class="row">
            <div class="col-12 col-md-4 col-xl-6 mb-4 mb-md-0">
                <p class="mb-0 text-center text-lg-start">© 2019-<span class="current-year"></span> <a class="text-primary fw-normal" href="https://themesberg.com" target="_blank">Themesberg</a></p>
            </div>
            <div class="col-12 col-md-8 col-xl-6 text-center text-lg-start">
                <!-- List -->
                <ul class="list-inline list-group-flush list-group-borderless text-md-end mb-0">
                    <li class="list-inline-item px-0 px-sm-2">
                        <a href="https://themesberg.com/about">About</a>
                    </li>
                    <li class="list-inline-item px-0 px-sm-2">
                        <a href="https://themesberg.com/themes">Themes</a>
                    </li>
                    <li class="list-inline-item px-0 px-sm-2">
                        <a href="https://themesberg.com/blog">Blog</a>
                    </li>
                    <li class="list-inline-item px-0 px-sm-2">
                        <a href="https://themesberg.com/contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</main>

<!-- Core -->
<script src="{{ asset('assets/jquery.js') }}"></script>

<script src="{{ asset('adminAssets/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('adminAssets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Vendor JS -->
<script src="{{ asset('adminAssets/vendor/onscreen/dist/on-screen.umd.min.js') }}"></script>

<!-- Slider -->
<script src="{{ asset('adminAssets/vendor/nouislider/distribute/nouislider.min.js') }}"></script>

<!-- Smooth scroll -->
<script src="{{ asset('adminAssets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

<!-- Charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('adminAssets/vendor/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('adminAssets/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>

<!-- Datepicker -->
<script src="{{ asset('adminAssets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>

<!-- Sweet Alerts 2 -->
<script src="{{ asset('adminAssets/vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<!-- Moment JS (CDN sigue bien) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

<!-- Notyf -->
<script src="{{ asset('adminAssets/vendor/notyf/notyf.min.js') }}"></script>

<!-- Simplebar -->
<script src="{{ asset('adminAssets/vendor/simplebar/dist/simplebar.min.js') }}"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Volt JS -->
<script src="{{ asset('adminAssets/assets/js/volt.js') }}"></script>

<script>
  $(document).ready(function(){
    $('.logout-button').click(function(){
      $('.logout-form').submit();
    })
  });
</script>

@yield('scripts')

    
</body>

</html>
