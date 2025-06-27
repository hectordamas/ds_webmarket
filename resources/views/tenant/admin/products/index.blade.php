@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Lista de Productos</title>
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
                                    @if ($product->image)
                                        <img src="{{ asset($product->image) }}" class="img-fluid rounded" style="max-height: 60px;">
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? 'Sin categoría' }}</td>
                                <td>${{ number_format($product->price, 2, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-{{ $product->active ? 'success' : 'secondary' }}">
                                        {{ $product->active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ url('products/' . $product->id . '/edit') }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>

                                    <form action="{{ url('products/' . $product->id . '/destroy') }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay productos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Paginación si usas paginate() --}}
                {{-- {{ $products->links() }} --}}
            </div>
        </div>
    </div>
</div>

@endsection
