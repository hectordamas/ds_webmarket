@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ config('app.name') }} - Editar Categoría</title>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h5>Editar Categoría</h5>
            </div>
            <div class="card-block">
                <form method="POST" action="{{ url('categories/' . $category->id . '/update') }}" class="row">
                    @csrf

                    <div class="form-group col-md-4">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $category->name) }}" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="active">Estado</label>
                        <select name="active" id="active" class="form-control">
                            <option value="1" {{ old('active', $category->active) == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('active', $category->active) == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('active') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                        <a href="{{ url('categories') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
