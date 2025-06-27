@extends('central.layouts.auth')

@section('metadata')
    <title>{{ env('APP_NAME') }} - Regístrate</title>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-sm-12">
            <form class="md-float-material form-material" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="text-center mb-3">
                    <img src="{{ asset('central/assets/img/logo-light.png') }}" alt="Logo {{ env('APP_NAME') }}" width="180">
                </div>
                <div class="auth-box card">
                    <div class="card-block">
                        <div class="row m-b-20">
                            <div class="col-md-12">
                                <h3 class="text-center">Regístrate</h3>
                                <p class="text-center">Crea una cuenta para gestionar tu catálogo</p>
                            </div>
                        </div>

                        <div class="mb-3 form-primary">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" required autofocus placeholder="Nombre Completo">
                            <span class="form-bar"></span>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-primary">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required placeholder="Correo Electrónico">
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

                        <div class="mb-3 form-primary">
                            <input type="password" name="password_confirmation" class="form-control"
                                   required placeholder="Confirmar Contraseña">
                            <span class="form-bar"></span>
                        </div>

                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-md waves-effect waves-light text-center m-b-20">
                                        Registrarse
                                    </button>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="text-center">
                            <p>¿Ya tienes una cuenta?
                                <a href="{{ route('login') }}"><b class="f-w-600">Inicia Sesión</b></a>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
