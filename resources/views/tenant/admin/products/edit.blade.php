@extends('tenant.layouts.admin')

@section('metadata')
    <title>{{ config('app.name') }} - Editar Producto</title>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h5>Editar Producto</h5>
            </div>
            <div class="card-block">
                <form method="POST" action="{{ url('products/' . $product->id . '/update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-2 mb-4 text-center">
                            <div data-bs-toggle="modal" data-bs-target="#imageModal" style="cursor:pointer;" onclick="showImageModal('{{ img64($product->image) }}')">
                                @if ($product->image)
                                    <img src="{{ img64($product->image) }}"
                                         width="100"
                                         class="rounded shadow"
                                         style="object-fit: cover;">
                                @else
                                    <span class="text-muted">Sin imagen</span>
                                @endif
                            </div>
                        </div>
                    </div>
                
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="sku" class="form-label fw-semibold">SKU</label>
                            <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control" required readonly>
                            @error('sku') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="name" class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required readonly>
                            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    
                        <div class="col-md-3">
                            <label for="price" class="form-label fw-semibold">Precio</label>
                            <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" class="form-control" required readonly>
                            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    
                        <div class="col-md-3">
                            <label for="stock" class="form-label fw-semibold">Stock</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control" required readonly>
                            @error('stock') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    
                        <div class="col-md-3">
                            <label for="category_id" class="form-label fw-semibold">Categoría</label>
                            <select name="category_id" class="form-select bg-light" required onmousedown="return false;">
                                <option value="">-- Seleccione --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    
                        <div class="col-md-3">
                            <label for="active" class="form-label fw-semibold">Estado</label>
                            <select name="active" class="form-select bg-light" onmousedown="return false;">
                                <option value="1" {{ old('active', $product->active) == '1' ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ old('active', $product->active) == '0' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            @error('active') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    

                        <div class="col-md-6">
                            <label for="image" class="form-label fw-semibold">Subir Imagen</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    
                        <div class="col-md-6">
                            <label for="description" class="form-label fw-semibold">Descripción</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                            @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    
                        <div class="col-12 d-flex justify-content-start gap-2 mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Actualizar
                            </button>
                            <a href="{{ url('products') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Opciones Extras del Producto</h5>
                    <span>Personaliza las opciones para este producto</span>
                </div>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#groupModal">
                    <i class="fas fa-plus"></i> Nuevo Grupo
                </button>
            </div>
            <div class="card-block">

                @if($product->optionGroups->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>Nombre del Grupo</th>
                                    <th>Tipo</th>
                                    <th>Requerido</th>
                                    <th>Opciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product->optionGroups as $group)
                                    <tr>
                                        <td>{{ $group->name }}</td>
                                        <td>{{ ucfirst($group->type) }}</td>
                                        <td>{{ $group->required ? 'Sí' : 'No' }}</td>
                                        <td>
                                            <!-- En la sección de opciones dentro del grupo -->
                                            @foreach($group->options as $option)
                                                <div class="option-item d-flex align-items-center mb-2 p-2 bg-light rounded">
                                                    <div class="flex-grow-1">
                                                        <span class="fw-bold">{{ $option->name }}</span>
                                                        <span class="text-success ms-2">+{{ number_format($option->price, 2) }}</span>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-outline-warning edit-option-btn" 
                                                                data-option="{{ $option->toJson() }}"
                                                                data-group-id="{{ $group->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="{{ route('tenant.options.destroy', $option->id) }}" 
                                                              method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                    onclick="return confirm('¿Eliminar esta opción?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <button class="btn btn-sm btn-success add-option-btn" 
                                                    data-group-id="{{ $group->id }}">
                                                <i class="fas fa-plus-circle"></i> Agregar opción
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning edit-group-btn" 
                                                    data-group="{{ $group->toJson() }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('tenant.option-groups.destroy', $group->id) }}" 
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('¿Eliminar este grupo y todas sus opciones?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-dark mb-0 d-flex align-items-center">
                        <i class="far fa-list-alt fa-2x me-3"></i> No hay grupos de opciones configurados para este producto.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal para Grupos -->
    <div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="groupModalTitle">Nuevo Grupo de Opciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="groupForm" method="POST" action="{{ route("tenant.option-groups.store") }}"> 
                    @csrf
                    <input type="hidden" id="group_id" name="id">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="group_name">Nombre del Grupo *</label>
                                <input type="text" class="form-control" id="group_name" name="name" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="group_type">Tipo *</label>
                                <select class="form-control" id="group_type" name="type" required>
                                    <option value="single">Selección única</option>
                                    <option value="multiple">Selección múltiple</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="group_required">Requerido</label>
                                <select class="form-control" id="group_required" name="required">
                                    <option value="0">No</option>
                                    <option value="1">Sí</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="min_options">Mínimo de opciones</label>
                                <input type="number" class="form-control" id="min_options" name="min_options" min="0">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="max_options">Máximo de opciones</label>
                                <input type="number" class="form-control" id="max_options" name="max_options" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Grupo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Opciones -->
    <div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="optionModalTitle">Nueva Opción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="optionForm" method="POST">
                    @csrf
                    <input type="hidden" id="option_id" name="id">
                    <input type="hidden" id="option_group_id" name="product_option_group_id">

                    <div class="modal-body row">
                        <div class="form-group col-md-6">
                            <label for="option_name">Nombre de la opción *</label>
                            <input type="text" class="form-control" id="option_name" name="name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="option_price">Precio adicional</label>
                            <input type="number" step="0.01" class="form-control" id="option_price" name="price" value="0" min="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Opción</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
<!-- Modal Reutilizable -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-body">
        <img id="modalImage" src="" class="img-fluid w-100 rounded">
      </div>
    </div>
  </div>
</div>


</div>
@endsection


@section('scripts')
<script>
function showImageModal(imageUrl) {
    document.getElementById('modalImage').src = imageUrl;
}
</script>

<script>
$(document).ready(function() {
    // Resetear modal de grupo al cerrar
    $('#groupModal').on('hidden.bs.modal', function () {
        $('#groupForm')[0].reset();
        $('#group_id').val('');
        $('#groupModalTitle').text('Nuevo Grupo de Opciones');
        $('#groupForm').attr('action', '{{ route("tenant.option-groups.store") }}');
        $('input[name="_method"]').remove();
    });
    
    // Editar grupo existente
    $('.edit-group-btn').click(function() {
        const group = $(this).data('group');
        
        $('#groupModalTitle').text('Editar Grupo de Opciones');
        $('#group_id').val(group.id);
        $('#group_name').val(group.name);
        $('#group_type').val(group.type);
        $('#group_required').val(group.required ? '1' : '0');
        $('#min_options').val(group.min_options);
        $('#max_options').val(group.max_options);
        
        $('#groupForm').attr('action', '{{ url("tenant/option-groups") }}/' + group.id);
        $('#groupForm').append('<input type="hidden" name="_method" value="PUT">');
        
        $('#groupModal').modal('show');
    });
    
    // Mostrar modal para nueva opción
    $('.add-option-btn').click(function() {
        const groupId = $(this).data('group-id');
        
        $('#optionModalTitle').text('Nueva Opción');
        $('#option_id').val('');
        $('#option_group_id').val(groupId);
        $('#optionForm')[0].reset();
        $('#optionForm').attr('action', '{{ route("tenant.options.store") }}');
        $('input[name="_method"]').remove();
        
        $('#optionModal').modal('show');
    });
    
    // Editar opción existente
    $(document).on('click', '.edit-option-btn', function() {
        const option = $(this).data('option');
        const groupId = $(this).data('group-id');
        
        $('#optionModalTitle').text('Editar Opción');
        $('#option_id').val(option.id);
        $('#option_group_id').val(groupId);
        $('#option_name').val(option.name);
        $('#option_price').val(option.price);
        
        $('#optionForm').attr('action', '{{ url("options") }}/' + option.id);
        $('#optionForm').append('<input type="hidden" name="_method" value="PUT">');
        
        $('#optionModal').modal('show');
    });
    

    // Resetear modal de opción al cerrar
    $('#optionModal').on('hidden.bs.modal', function () {
        $('#optionForm')[0].reset();
        $('#option_id').val('');
        $('#optionModalTitle').text('Nueva Opción');
        $('#optionForm').attr('action', '{{ route("tenant.options.store") }}');
        $('input[name="_method"]').remove();
    });
});
</script>
@endsection