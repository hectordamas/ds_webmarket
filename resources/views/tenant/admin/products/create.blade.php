@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ config('app.name') }} - Crear Producto</title>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h5>Crear Nuevo Producto</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('products/store') }}" method="POST" enctype="multipart/form-data" class="row">
                    @csrf

                    <div class="form-group col-md-3">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name') }}" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="price">Precio</label>
                        <input type="number" name="price" id="price" step="0.01" min="0"
                            class="form-control" value="{{ old('price') }}" required>
                        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="category_id">Categoría</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Seleccione una Categoría</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>


                    <div class="form-group col-md-3">
                        <label for="active">Estado</label>
                        <select name="active" id="active" class="form-control">
                            <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('active') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>


                    <div class="form-group col-md-3">
                        <label for="image">Imagen</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-8"></div>



                    <div class="form-group col-md-8">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                        <a href="{{ url('products') }}" class="btn btn-secondary">Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
