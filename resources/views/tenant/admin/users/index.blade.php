@extends('tenant.layouts.admin')

@section('metadata')
    <title>Usuarios - {{ env('APP_NAME') }}</title>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Lista de Usuarios</h5>
                    <a href="{{ url('usuarios/create') }}" class="btn btn-success">
                        <i class="fas fa-user-plus me-1"></i> Nuevo Usuario
                    </a>
                </div>
                <div class="card-block">


                    @if ($users->count())
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="datatable-buttons-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Registrado</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id}}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                            <td class="text-end">
                                                <a href="{{ url("usuarios/{$user->id}/edit") }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ url("usuarios/{$user->id}") }}" method="POST" class="d-inline"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                    
                    @else
                        <div class="alert alert-info">
                            No hay usuarios registrados aún.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection


