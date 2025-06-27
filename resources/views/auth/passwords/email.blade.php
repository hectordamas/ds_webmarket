@extends('layouts.auth')
@section('metadata')
<title>{{ env('APP_NAME') }} - Olvidé mi Contraseña</title>
@endsection
@section('content')
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('assets/img/logo-color.png') }}" alt="Logo {{ env('APP_NAME') }}" width="180" style="margin-bottom: 25px;">
                                </div>
                                <p>¿Olvidaste tu contraseña? Ingresa tu correo para recibir el enlace de recuperación.</p>

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label><strong>Correo Electrónico</strong></label>
                                        <input type="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-block">Enviar enlace de recuperación</button>
                                    </div>
                                </form>

                                <div class="new-account mt-3">
                                    <p>¿Ya recuerdas tu contraseña? <a href="{{ route('login') }}">Inicia sesión</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
