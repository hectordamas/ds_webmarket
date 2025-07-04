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

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between">
                    <h5>Usuarios del Tenant</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createUserModal">
                        <i class="fa-solid fa-plus"></i> Crear Usuario
                    </button>
                </div>
                <div class="card-block dt-responsive table-responsive">
                    @if($users->count() > 0)
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <td>#</td>
                                <td>Fecha de Registro</td>
                                <td>Usuario</td>
                                <td>E-Mail</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->created_at->format('d-m-Y h:i A') }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <!-- Botón para abrir el modal de edición -->
                                    <button type="button" class="btn btn-sm btn-outline-success btn-edit-user"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                
                                    <!-- Botón para eliminar -->
                                    <form action="{{ url('tenant/users/destroy') }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        @csrf
                                        <input type="hidden" value="{{$tenant->id}}" name="tenant_id">
                                        <input type="hidden" value="{{$user->id}}" name="id">

                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-dark mb-0 d-flex align-items-center">
                        <i class="far fa-user fa-2x me-3"></i> No hay usuarios registrados para este tenant.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de creación de usuario -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="crateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="createUserForm" method="POST" action="{{ url('tenant/users/store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Registrar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="{{$tenant->id}}" name="tenant_id">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Registrar Usuario</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Modal de edición de usuario -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editUserForm" method="POST">
        @csrf
        <input type="hidden" value="{{$tenant->id}}" name="tenant_id">
        <input type="hidden" name="id" class="user_id">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editUserName" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" id="editUserName" required>
                </div>
                <div class="mb-3">
                    <label for="editUserEmail" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" id="editUserEmail" required>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.btn-edit-user').on('click', function () {
            var userId = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');

            // Rellenar los campos del formulario
            $('#editUserName').val(name);
            $('#editUserEmail').val(email);
            $('.user_id').val(userId)

            // Cambiar la acción del formulario con la URL adecuada
            $('#editUserForm').attr('action', "{{ url('tenant/users/update') }}"); // Ajusta esta ruta si es diferente

            // Abrir el modal
            $('#editUserModal').modal('show');
        });
    });
</script>
@endsection
