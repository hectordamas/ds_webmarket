@extends('central.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Listado de Usuarios</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Listado de Usuarios</h5>
            </div>
            <div class="card-block">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>E-Mail</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('users.edit', [ $user ]) }}" class="btn btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botón para eliminar -->
                                <form action="{{ route('users.destroy', [ $user ]) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection