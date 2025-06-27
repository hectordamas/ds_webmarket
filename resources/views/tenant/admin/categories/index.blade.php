@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Lista de Categorías</title>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Lista de Categorías</h5>
                <a href="{{ url('categories/create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Nueva Categoría
                </a>
            </div>

            <div class="card-body table-responsive">

                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Slug</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-categories">
                        @forelse ($categories as $category)
                            <tr data-id="{{ $category->id }}">
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <span class="badge bg-{{ $category->active ? 'success' : 'secondary' }}">
                                        {{ $category->active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ url('categories/' . $category->id . '/edit') }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                
                                    <form action="{{ url('categories/' . $category->id . '/destroy') }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No hay categorías registradas aún.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
$(function () {
    $('#sortable-categories').sortable({
        update: function () {
            let order = [];
            $('#sortable-categories tr').each(function (index, element) {
                order.push({
                    id: $(element).data('id'),
                    position: index + 1
                });
            });

            $.ajax({
                url: "{{ url('categories/sort') }}",
                method: 'POST',
                data: {
                    order: order,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response.message);
                },
                error: function () {
                    alert('Hubo un error al guardar el orden.');
                }
            });
        }
    });
});
</script>
@endsection
