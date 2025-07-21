@extends('central.layouts.app')

@section('metadata')
<title>{{ config('app.name') }} - Sitio no encontrado
</title>
@endsection
@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh; background: linear-gradient(135deg, #f0f2f5, #d9e2ec);">
    <div class="text-center p-5 rounded-4 shadow-lg bg-white" style="max-width: 500px; width: 100%;">
        
        {{-- Logo --}}
        <div class="mb-4">
            <img src="{{ asset('central/assets/img/logo-color.png') }}" alt="Logo" style="max-width: 160px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">
        </div>

        {{-- Icono --}}
        <div class="mb-4">
            <i class="bi bi-globe2 text-danger" style="font-size: 3rem;"></i>
        </div>

        {{-- Título --}}
        <h3 class="text-dark fw-bold mb-3">Página no encontrada</h3>

        {{-- Mensaje --}}
        <p class="text-muted mb-4" style="font-size: 1.1rem;">
            La página que estás intentando acceder no existe o ha sido desactivada.
            Si crees que esto es un error, contáctanos.
        </p>

        {{-- Botón --}}
        <a href="{{ url(env('WHATSAPP_SUPPORT_URL')) }}" target="_blank" class="btn btn-success rounded-pill px-4 py-2 fw-semibold">
            Contactar Soporte
        </a>
    </div>
</div>
@endsection
