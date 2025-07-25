@extends('tenant.layouts.admin')

@section('metadata')
    <title>Usuarios - {{ config('app.name') }}</title>
@endsection

@section('content')
<!-- Modal -->
<div class="modal fade" id="modalCrearUsuario" tabindex="-1" aria-labelledby="modalCrearUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCrearUsuarioLabel">Crear Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('usuarios/store') }}" method="POST" id="formCrearUsuario">
                    @csrf

                    <div class="row">
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
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Lista de Usuarios</h5>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">
                        <i class="fas fa-user-plus me-1"></i> Nuevo Usuario
                    </button>
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
                                        <th>Estado</th>
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
                                            <td class="text-center align-middle">
                                                <div class="d-flex align-items-center justify-content-center gap-3">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" name="activo" class="form-check-input users-active" data-id="{{ $user->id }}" {{ $user->activo ? 'checked' : '' }}>
                                                        Activo
                                                    </label>
                                                
                                                </div>
                                            </td>
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

@section('scripts')
<script>
$(document).ready(function () {
    // Manejador para ambos checkboxes
    $('.users-active').on('change', function () {
        const checkbox = $(this);
        const userId = checkbox.data('id');
        const isChecked = checkbox.is(':checked') ? 1 : 0;
        const field = checkbox.hasClass('users-active') ? 'activo' : 'visible';

        $.ajax({
            url: "{{ url('usuarios/toggle') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: userId,
                field: field,
                checked: isChecked
            },
            success: function (response) {
                if (!response.success) {
                    alert('Ocurrió un error al actualizar el estado.');
                    checkbox.prop('checked', !isChecked); // revertir el cambio si falla
                }
            },
            error: function () {
                alert('No se pudo actualizar el estado del usuario.');
                checkbox.prop('checked', !isChecked); // revertir el cambio si falla
            }
        });
    });
});
</script>
@endsection