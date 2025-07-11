@extends('central.layouts.auth')

@section('metadata')
    <title>{{ env('APP_NAME') }} - Inicia Sesión</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-sm-12">
            <form class="md-float-material form-material" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="text-center mb-3">
                    <img src="{{ asset('central/assets/img/logo-light.png') }}" alt="Logo {{ env('APP_NAME') }}" width="180">
                </div>
                <div class="auth-box card">
                    <div class="card-block">
                        <div class="row m-b-20">
                            <div class="col-md-12">
                                <h3 class="text-center">Inicia Sesión</h3>
                            </div>
                        </div>

                        <div class="mb-3 form-primary">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required autofocus placeholder="Correo Electrónico">
                            <span class="form-bar"></span>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-primary">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                   required placeholder="Contraseña">
                            <span class="form-bar"></span>
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row m-t-25 text-start">
                            <div class="col-12 d-flex justify-content-between align-items-center">
                                <div class="checkbox-fade fade-in-primary">
                                    <label class="form-label">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                        <span class="text-inverse">Recuérdame</span>
                                    </label>
                                </div>
                                <div class="forgot-phone text-end f-right">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="f-w-600">¿Olvidaste tu contraseña?</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-md waves-effect waves-light text-center m-b-20">
                                        Entrar
                                    </button>
                                </div>
                            </div>
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
                                <img src="{{ asset('central/assets/img/favicon.png') }}" class="w-100" alt="Logo pequeño">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
