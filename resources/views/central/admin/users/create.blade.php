@extends('central.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Registrar Usuario</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Registrar Nuevo usuario</h5>
            </div>
            <div class="card-block">
                <form method="POST" action="{{ route('users.store') }}" class="row">
                    @csrf

                    <div class="col-md-3 form-group">
                        <label for="">Nombre Completo</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">E-Mail</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="">Contraseña</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Crear Usuario">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver a Usuarios</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection