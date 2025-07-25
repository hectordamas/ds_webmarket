@extends('central.layouts.admin')

@section('metadata')
<title>{{ config('app.name') }} - Listado de Usuarios</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Listado de Usuarios</h5>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="far fa-plus-square"></i> Registrar Usuario
                </a>
            </div>
            <div class="card-block dt-responsive table-responsive">
                <table class="table table-bordered table-striped" id="datatable-buttons-table"> 
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>E-Mail</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="activo" class="form-check-input users-active" data-id="{{ $user->id }}" {{ $user->activo ? 'checked' : '' }}>
                                        Activo
                                    </label>
                                
                                </div>
                            </td>
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
            url: "{{ url('users/toggle') }}",
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