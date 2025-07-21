@extends('central.layouts.app')

@section('metadata')
<title>{{ config('app.name') }} - Error Interno</title>
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
            <i class="bi bi-bug-fill text-danger" style="font-size: 3rem;"></i>
        </div>

        {{-- Título --}}
        <h2 class="fw-bold mb-2" style="color: #ff4e50;">500</h2>
        <h4 class="fw-bold mb-4" style="color: #ff4e50;">Error interno del servidor</h4>

        {{-- Mensaje --}}
        <p class="text-light mb-4" style="font-size: 1rem;">
            Algo salió mal en nuestro servidor.<br>
            Por favor intenta nuevamente más tarde o contacta a soporte si el problema persiste.
        </p>

        {{-- Botón --}}
        <a href="{{ url('/') }}" class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold">
            Volver al inicio
        </a>
    </div>
</div>
@endsection
