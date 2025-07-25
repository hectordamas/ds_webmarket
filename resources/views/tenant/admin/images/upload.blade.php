@extends('tenant.layouts.admin')

@section('metadata')
    <title>{{ config('app.name') }} - Carga Masiva de Imágenes</title>
@endsection


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header text-white rounded-top-4 d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class="fas fa-upload me-2"></i> Subir Imágenes de Productos</h5>
            </div>
                        <form action="{{url('images/store')}}" class="dropzone" id="dropzone" enctype="multipart/form-data" method="post">
                            <div class="dz-message text-center">
                                <i class="fa fa-upload" style="font-size:30px; margin-bottom:20px;"></i>
                                <h4>Subir Imágenes</h4>
                            </div>
                            @csrf
                            <input type="imagenes" name="imagenes" multiple accept=".jpg" style="display: none;"/>
                        </form>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
Dropzone.autoDiscover = false;

$(document).ready(function () {
    // Inicialización manual SIN duplicar
    new Dropzone("#dropzone", {
        acceptedFiles: "image/*",
        maxFilesize: 5, // opcional: tamaño máximo en MB
        success: function (file, response) {
            console.log("Subido correctamente:", response);
        },
        error: function (file, response) {
            console.error("Error al subir:", response);
        }
    });
});
</script>

@endsection
