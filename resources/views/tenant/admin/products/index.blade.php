@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ config('app.name') }} - Lista de Productos</title>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Lista de Productos</h5>
                <a href="{{ url('products/create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Producto
                </a>
            </div>

            <div class="card-body table-responsive">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-hover" id="datatable-buttons-table">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td style="width: 80px">
                                    <img src="{{ img64($product->image) }}" class="img-fluid rounded" style="max-height: 60px;">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? 'Sin categoría' }}</td>
                                <td>${{ number_format($product->price, 2, ',', '.') }}</td>
                                <td class="text-center align-middle">
                                    <div class="d-flex align-items-center justify-content-center gap-3">
                                        <label class="form-check-label">
                                            <input type="checkbox" name="active" class="form-check-input product-active" data-id="{{ $product->id }}" {{ $product->active ? 'checked' : '' }} disabled>
                                            Activo
                                        </label>
                                    
                                        <label class="form-check-label">
                                            <input type="checkbox" name="visible" class="form-check-input product-visible" data-id="{{ $product->id }}" {{ $product->visible ? 'checked' : '' }}>
                                            Visible
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ url('products/' . $product->id . '/edit') }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>

                                    {{--<form action="{{ url('products/' . $product->id . '/destroy') }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>--}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay productos registrados.</td>
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
<script>
$(document).ready(function () {
    // Manejador para ambos checkboxes
    $('.product-active, .product-visible').on('change', function () {
        const checkbox = $(this);
        const productId = checkbox.data('id');
        const isChecked = checkbox.is(':checked') ? 1 : 0;
        const field = checkbox.hasClass('product-active') ? 'active' : 'visible';

        $.ajax({
            url: "{{ url('products/toggle') }}",
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
