@extends('layouts.auth')
@section('metadata')
<title>{{ env('APP_NAME') }} - Inicia Sesión</title>
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
                                    <img src="{{ asset('assets/img/logo-color.png') }}" alt="Logo {{ env('APP_NAME') }}" width="180"  style="margin-bottom: 20px;">
                                </div>
                                <p>Bienvenido a DS WebMarket, inicia sesión para gestionar tu SAAS</p>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group pr-1">
                                        <label><strong>Correo Electrónico</strong></label>
                                        <input type="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" required autofocus
                                               >
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group pr-1">
                                        <label><strong>Contraseña</strong></label>
                                        <input type="password" name="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               required >
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember">Recuérdame</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-block">Entrar</button>
                                    </div>
                                </form>

                                <div class="new-account mt-3">
                                    <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
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
