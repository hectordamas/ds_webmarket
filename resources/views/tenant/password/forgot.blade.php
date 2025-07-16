@extends('tenant.layouts.auth')

@section('metadata')
<title>{{ env('APP_NAME') }} - Recuperar Contraseña</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-sm-12">
            <form class="md-float-material form-material" method="POST" action="{{ url('password/send-code') }}">
                @csrf
                <div class="text-center mb-3">
                    <img src="{{ asset('assets/img/logo-light.png') }}" alt="Logo {{ env('APP_NAME') }}" width="180">
                </div>
                <div class="auth-box card">
                    <div class="card-block">
                        <div class="row m-b-20">
                            <div class="col-md-12">
                                <h3 class="text-center">Recuperar Contraseña</h3>
                                <p class="text-center text-muted">Ingresa tu correo y te enviaremos un código de recuperación</p>
                            </div>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success text-center">{{ session('status') }}</div>
                        @endif

                        <div class="mb-3 form-primary">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required autofocus placeholder="Correo Electrónico">
                            <span class="form-bar"></span>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-md waves-effect waves-light text-center m-b-20">
                                        Enviar código
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
