@extends('central.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Editar Usuario</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Editar Usuario #{{$user->id}}</h5>
            </div>
            <div class="card-block">
                <form action="{{ route('users.update', $user) }}" class="row">
                    @method('PUT')
                    @csrf

                    <div class="col-md-3 form-group">
                        <label for="">Nombre Completo</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                    </div>
                    
                    <div class="col-md-3 form-group">
                        <label for="">E-Mail</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->email }}" required>
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="">Contraseña</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary" value="Actualizar Usuario">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection