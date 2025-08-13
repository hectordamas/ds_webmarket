@extends('central.layouts.main')
@section('metadata')
<title>{{ config('app.name') }} - Crea tu catálogo en línea integrado con Saint</title>
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset('landing/assets/css/plugins.css') }}">
  <link rel="stylesheet" href="{{ asset('landing/assets/css/style.css') }}">
  <link rel="preload" href="{{ asset('landing/assets/css/fonts/dm.css') }}" as="style" onload="this.rel='stylesheet'">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <style>
    /* ===============================
       COLORES CORPORATIVOS DS WEBMARKET
       =============================== */
    :root {
      --bs-primary: #1AA765;
      --bs-primary-rgb: 26, 167, 101;
    }

    /* Títulos en verde DS WebMarket */
    .text-primary {
      color: var(--bs-primary) !important;
    }

    /* Botones principales en verde */
    .btn-primary {
      background-color: var(--bs-primary) !important;
      border-color: var(--bs-primary) !important;
      color: #fff !important;
      font-weight: bold;
    }
    .btn-primary:hover {
      background-color: #158a54 !important;
      border-color: #158a54 !important;
    }

    /* Cambiar color de bullets */
    .bullet-soft-primary {
      background-color: transparent !important;
    }

    .bg-soft-primary {
      background-color: rgba(26, 167, 101, 0.1) !important;
    }

    /* Logos recoloreados a verde DS WebMarket (#1AA765) */
    .recolor-logo {
      filter: brightness(0) saturate(100%) invert(12%) sepia(3%) saturate(300%) hue-rotate(180deg) brightness(40%) contrast(90%);
    }

    .icon-list.bullet-soft-primary.bullet-bg i {
      background-color: #1AA765 !important; /* verde corporativo */
      color: #fff !important; /* ícono en blanco */
    }
    .display-2{
      font-family: 'Poppins';
      font-weight: 600 !important;
    }
  </style>
@endsection

@section('content')
  <section class="wrapper bg-soft-primary">
    <div class="container pt-10 pb-12 pt-md-14 pb-md-17">
      <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">

        {{-- Texto y llamado a la acción --}}
        <div class="col-lg-6 text-center text-lg-start" data-cues="slideInDown" data-group="page-title" data-delay="300">
          <h1 class="display-2 mb-4 fw-bold text-dark">
            Crea tu catálogo online <span class="text-primary">integrado con Saint</span>
          </h1>
          <p class="lead fs-lg mb-6">
            Muestra tus productos, recibe pedidos por WhatsApp y aumenta tus ventas sin complicaciones.
          </p>
          <ul class="icon-list bullet-bg bullet-soft-primary mb-6">
            <li>
              <i class="uil uil-check"></i> Compatible con Saint
            </li>
            <li>
              <i class="uil uil-check"></i> Catálogo responsive y rápido
            </li>
            <li>
              <i class="uil uil-check"></i> Pedidos por WhatsApp en un click
            </li>
          </ul>
        </div>

        {{-- Formulario --}}
        <div class="col-lg-6">
          <div class="card shadow-lg border-0 rounded-4 p-4" data-cue="slideInUp" data-delay="600">
            <div class="text-center my-5">
              <img src="{{ asset('central/assets/img/logo-color.png') }}" alt="DS WebMarket" style="aspect-ratio: auto; object-fit: contain; width: 180px;">
              <h5 class="mt-3">💚 ¡Prueba gratis por 3 días!</h5>
            </div>

            <form method="POST" action="{{ url('solicitudes/store') }}" class="row g-3">
              @csrf
              <div class="col-md-6">
                <input type="text" class="form-control" name="nombre" placeholder="Nombre y apellido *" required>
              </div>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" placeholder="Correo electrónico *" required>
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" name="negocio" placeholder="Nombre de su empresa *" required>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-text bg-light shadow-lg">+58</span>
                  <input type="text" class="form-control" name="whatsapp" placeholder="412-1234567" required>
                </div>
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control" name="instagram" placeholder="Instagram (opcional)">
              </div>
              <div class="col-md-6">
                <textarea class="form-control" name="actividad" rows="2" placeholder="¿A qué se dedica su negocio? *" required></textarea>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-primary w-100 rounded shadow">¡Quiero mi prueba gratis!</button>
              </div>

              <div class="col-12 my-4">
                <div class="text-center text-primary">
                  <p>Desarrollado Por:</p>
                </div>
                {{-- Logos --}}
                <div class="text-center">
                    <img src="{{ asset('central/assets/img/saint-light.png') }}" 
                         class="me-1 recolor-logo" 
                         alt="Saint" style="aspect-ratio: auto; object-fit: contain; width: 100px;">

                    <img src="{{ asset('central/assets/img/dsapps.png') }}" 
                         class="recolor-logo" 
                         alt="DS Apps" style="aspect-ratio: auto; object-fit: contain; width: 100px;">
                </div>
              </div>
            </form>
          </div>


        </div>

      </div>
    </div>
  </section>
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
  <script src="{{ asset('landing/assets/js/plugins.js') }}"></script>
  <script src="{{ asset('landing/assets/js/theme.js') }}"></script>
@endsection