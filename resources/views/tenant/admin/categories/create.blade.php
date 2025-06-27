@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Crear Categoría</title>
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h5>Crea una Nueva Categoría</h5>
            </div>
            <div class="card-block">
                <form method="POST" action="{{ url('categories/store') }}" class="row">
                    @csrf

                    <div class="form-group col-md-4">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Este campo ya no es necesario si el slug se genera en el backend --}}
                    {{-- <div class="form-group col-md-4">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">
                        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
                    </div> --}}

                    <div class="form-group col-md-4">
                        <label for="active">Estado</label>
                        <select name="active" id="active" class="form-control">
                            <option value="1" {{ old('active') == '1' ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ old('active') == '0' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('active') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar
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

@section('scripts')
<script>
    $(document).ready(function () {
        $('#name').on('input', function () {
            let slug = $(this).val()
                .toLowerCase()
                .normalize("NFD").replace(/[\u0300-\u036f]/g, "") // quitar acentos
                .replace(/[^a-z0-9]+/g, '-') // reemplazar espacios y caracteres no válidos
                .replace(/^-+|-+$/g, ''); // limpiar guiones al inicio o final

            $('#slug').val(slug);
        });
    });
</script>
@endsection
