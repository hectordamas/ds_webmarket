@extends('tenant.layouts.admin')

@section('metadata')
    <title>Nuevo Usuario - {{ env('APP_NAME') }}</title>
@endsection

@section('content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-tenant text-white">
            <h5 class="mb-0">Crear Usuario</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('users/store') }}" method="POST" class="row">
                @csrf

                <div class="mb-3 col-md-4">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="col-md-12">
                    <a href="{{ url('usuarios') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
