@extends('layouts.auth')
@section('metadata')
<title>{{ env('APP_NAME') }} - Regístrate</title>
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
                                    <img src="{{ asset('assets/img/logo-color.png') }}" alt="Logo {{ env('APP_NAME') }}" width="180"  style="margin-bottom: 25px;">
                                </div>
                                <p>Regístrate para crear una cuenta y gestionar tu catálogo</p>

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label><strong>Nombre Completo</strong></label>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}" required autofocus>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Correo Electrónico</strong></label>
                                        <input type="email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Contraseña</strong></label>
                                        <input type="password" name="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               required>
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label><strong>Confirmar Contraseña</strong></label>
                                        <input type="password" name="password_confirmation"
                                               class="form-control" required>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-block">Registrarse</button>
                                    </div>
                                </form>

                                <div class="new-account mt-3">
                                    <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia Sesión</a></p>
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
