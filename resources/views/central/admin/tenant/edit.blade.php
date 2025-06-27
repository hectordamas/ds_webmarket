@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12 pt-5">
        <div class="card shadow">
            <div class="card-header">
                Editar Tenant
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tenants.update', $tenant->id) }}" method="POST" class="row">
                    @csrf
                    @method('PUT')

                    <div class="form-group col-md-3 mb-3">
                        <label for="id" class="form-label">ID del Tenant</label>
                        <input type="text" id="id" class="form-control" value="{{ $tenant->id }}" disabled>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="database" class="form-label">Nombre de la Base de Datos</label>
                        <input type="text" name="database" id="database" class="form-control"
                            value="{{ old('database', $tenant->data['tenancy_db_name'] ?? '') }}" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="username" class="form-label">Usuario de la BD</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username', $tenant->data['tenancy_db_username'] ?? '') }}" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="password" class="form-label">Contraseña de la BD</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Dejar en blanco para no cambiar">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="domain" class="form-label">Dominio</label>
                        <input type="text" name="domain" id="domain" class="form-control"
                            value="{{ old('domain', $tenant->domains->first()->domain ?? '') }}" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control"
                            value="{{ old('fecha_vencimiento', $tenant->fecha_vencimiento ? $tenant->fecha_vencimiento->format('Y-m-d') : '') }}" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="form-label d-block">Activo</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="activo" id="activo"
                                {{ old('activo', $tenant->activo) ? 'checked' : '' }}>
                            <label class="form-check-label" for="activo">Habilitado</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('tenants.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Tenant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
