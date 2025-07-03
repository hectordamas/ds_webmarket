@extends('central.layouts.admin')
@section('metadata')
<title>Crear Tenant - {{ env('APP_NAME') }} </title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h5>Crear Nuevo Tenant</h5>
            </div>
            <div class="card-block">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('tenants.store') }}" method="POST" class="row">
                    @csrf
                    <div class="form-group col-md-3 mb-3">
                        <label for="id" class="form-label">Prefijo del Subdominio</label>
                        <input type="text" name="id" id="id" class="form-control" value="{{ old('id') }}" required>
                    </div>
                    <div class="form group col-md-3 mb-3">
                        <label for="nombre_empresa"  class="form-label">Nombre de la Empresa</label>
                        <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control" value="{{ old('nombre_empresa') }}">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="database" class="form-label">Nombre de la Base de Datos</label>
                        <input type="text" name="database" id="database" class="form-control" value="{{ old('database') }}" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="username" class="form-label">Usuario de la BD</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="password" class="form-label">Contraseña de la BD</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{ old('fecha_vencimiento') }}" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="form-label d-block">Activo</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="activo" id="activo" {{ old('activo', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">Habilitado</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr>
                            <h6 class="fw-bold">Usuario Principal</h6>
                        <hr>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>


                    <div class="d-flex justify-content-end">
                        <a href="{{ route('tenants.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                        <button type="submit" class="btn btn-success">Crear Tenant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection