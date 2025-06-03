@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12 pt-5">
        <div class="card shadow">
            <div class="card-header">
                Crear Nuevo Tenant
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
                <form action="{{ route('tenants.store') }}" method="POST" class="row">
                    @csrf
                    <div class="form-group col-md-3 mb-3">
                        <label for="id" class="form-label">ID del Tenant</label>
                        <input type="text" name="id" id="id" class="form-control" value="{{ old('id') }}" required>
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
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="domain" class="form-label">Dominio</label>
                        <input type="text" name="domain" id="domain" class="form-control" placeholder="cliente1.midominio.com" value="{{ old('domain') }}" required>
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