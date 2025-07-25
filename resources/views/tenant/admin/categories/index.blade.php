@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ config('app.name') }} - Lista de Categorías</title>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Lista de Categorías</h5>
                {{--
                <a href="{{ url('categories/create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Nueva Categoría
                </a>--}}
            </div>

            <div class="card-block table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Slug</th>
                            <th>Estado</th>
                            {{--<th>Acciones</th>--}}
                        </tr>
                    </thead>
                    <tbody id="sortable-categories">
                        @forelse ($categories as $category)
                            <tr data-id="{{ $category->id }}">
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td class="text-center align-middle">
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="active" class="form-check-input category-active" data-id="{{ $category->id }}" {{ $category->active ? 'checked' : '' }} disabled>
                                            Activo
                                        </label>
                                    
                                        <label class="form-check-label">
                                            <input type="checkbox" name="visible" class="form-check-input category-visible" data-id="{{ $category->id }}" {{ $category->visible ? 'checked' : '' }}>
                                            Visible
                                        </label>
                                    </div>
                                </td>
                                {{--<td>
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
                                </td>--}}
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

        // Manejador para ambos checkboxes
    $('.category-active, .category-visible').on('change', function () {
        const checkbox = $(this);
        const productId = checkbox.data('id');
        const isChecked = checkbox.is(':checked') ? 1 : 0;
        const field = checkbox.hasClass('category-active') ? 'active' : 'visible';

        $.ajax({
            url: "{{ url('categories/toggle') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: productId,
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
                alert('No se pudo actualizar el estado del producto.');
                checkbox.prop('checked', !isChecked); // revertir el cambio si falla
            }
        });
    });
});
</script>
@endsection
