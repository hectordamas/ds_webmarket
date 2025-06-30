@extends('central.layouts.admin')
@section('metadata')
<title>Editar Tenant - {{ env('APP_NAME') }} </title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
               <h5>Editar Tenant</h5> 
            </div>
            <div class="card-block row">
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
                        <label for="id" class="form-label">Prefijo del Subdominio</label>
                        <input type="text" id="id" class="form-control" value="{{ $tenant->id }}" disabled>
                    </div>
                    <div class="form group col-md-3 mb-3">
                        <label for="nombre_empresa"  class="form-label">Nombre de la Empresa</label>
                        <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control" value="{{ $tenant->nombre_empresa }}">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="database" class="form-label">Nombre de la Base de Datos</label>
                        <input type="text" name="database" id="database" class="form-control"
                            value="{{ $tenant->tenancy_db_name }}" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="username" class="form-label">Usuario de la BD</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ $tenant->tenancy_db_username }}" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="password" class="form-label">Contraseña de la BD</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Dejar en blanco para no cambiar">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control"
                            value="{{  $tenant->fecha_vencimiento ? \Carbon\Carbon::parse($tenant->fecha_vencimiento)->format('Y-m-d') : '' }}" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="form-label d-block">Activo</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="activo" id="activo"
                                {{ $tenant->activo ? 'checked' : '' }}>
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
