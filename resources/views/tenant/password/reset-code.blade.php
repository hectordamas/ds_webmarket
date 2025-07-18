@extends('tenant.layouts.auth')

@section('metadata')
<title>{{ config('app.name') }} - Restablecer Contraseña</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-sm-12">
            <form class="md-float-material form-material" method="POST" action="{{ url('password/reset-code') }}">
                @csrf
                <div class="text-center mb-3">
                    <img src="{{ asset('assets/img/logo-light.png') }}" alt="Logo {{ config('app.name') }}" width="180">
                </div>
                <div class="auth-box card">
                    <div class="card-block">
                        <div class="row m-b-20">
                            <div class="col-md-12">
                                <h3 class="text-center">Restablecer Contraseña</h3>
                                <p class="text-center text-muted">Ingresa el código recibido por correo y una nueva contraseña</p>
                            </div>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger text-center">{{ session('error') }}</div>
                        @endif

                        <div class="mb-3 form-primary">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required placeholder="Correo Electrónico">
                            <span class="form-bar"></span>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-primary">
                            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                   placeholder="Código recibido" required>
                            <span class="form-bar"></span>
                            @error('code')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-primary">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Nueva contraseña" required>
                            <span class="form-bar"></span>
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-primary">
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Confirmar contraseña" required>
                            <span class="form-bar"></span>
                        </div>

                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-md waves-effect waves-light text-center m-b-20">
                                        Restablecer contraseña
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ url('login') }}" class="f-w-600">← Volver al inicio de sesión</a>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-10">
                                <p class="text-inverse text-start m-b-0">Gracias por usar DS WebMarket.</p>
                                <p class="text-inverse text-start">
                                    <a href="{{ url('/') }}"><b class="f-w-600">Volver al sitio</b></a>
                                </p>
                            </div>
                            <div class="col-2 text-end">
                                <img src="{{ asset('assets/img/favicon.png') }}" class="w-100" alt="Logo pequeño">
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
