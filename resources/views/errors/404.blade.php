@extends('central.layouts.app')

@section('metadata')
<title>{{ config('app.name') }} - Página no encontrada</title>
@endsection

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 100vh; background: linear-gradient(135deg, #141e30, #243b55);">
    <div class="text-center p-5 rounded-4 shadow-lg" style="max-width: 480px; width: 100%; background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.1); color: #fff;">
        
        {{-- Logo --}}
        <div class="mb-4">
            <img src="{{ asset('central/assets/img/logo-light.png') }}" alt="Logo DS WebMarket" style="max-width: 180px; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));">
        </div>

        {{-- Icono --}}
        <div class="mb-3">
            <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
        </div>

        {{-- Título --}}
        <h2 class="fw-bold mb-2" style="color: #00ffa2;">404</h2>
        <h4 class="fw-bold mb-4" style="color: #00ffa2;">Página no encontrada</h4>

        {{-- Mensaje --}}
        <p class="text-light mb-4" style="font-size: 1rem;">
            La Página que estás intentando visitar no existe o ha sido eliminada.
            Verifica la dirección o contacta a soporte.
        </p>

        {{-- Botón --}}
        <a href="{{ url('/') }}" target="_blank" class="btn btn-success rounded-pill px-4 py-2 fw-semibold">
            Volver a la Página Principal
        </a>
    </div>
</div>
@endsection
