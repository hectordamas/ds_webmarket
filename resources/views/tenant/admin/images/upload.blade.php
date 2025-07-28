@extends('tenant.layouts.admin')

@section('metadata')
    <title>{{ config('app.name') }} - Carga Masiva de Imágenes</title>
@endsection


@section('styles')
<style>
    .dropzone {
        border: 2px dashed #4e73df !important;
        background: #f8f9fc;
        border-radius: 0.75rem;
        padding: 40px;
        min-height: 200px;
        transition: background-color 0.3s ease;
        font-size: 1rem;
        color: #5a5c69;
    }

    .dropzone:hover {
        background-color: #e9ecef;
        cursor: pointer;
    }

    .dropzone .dz-message {
        font-weight: 500;
        color: #4e73df;
    }

    .dropzone .dz-preview {
        margin-top: 20px;
    }

    .dropzone .dz-image img {
        border-radius: 0.5rem;
    }

    .dropzone .dz-success-mark svg,
    .dropzone .dz-error-mark svg {
        width: 30px;
        height: 30px;
    }

    .dropzone .dz-error-message {
        color: red;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .dropzone .dz-success-message {
        color: green;
        font-size: 0.9rem;
        margin-top: 5px;
    }
</style>
@endsection


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header text-white rounded-top-4 d-flex align-items-center justify-content-between">
                <h5 class="mb-0"><i class="fas fa-upload me-2"></i> Subir Imágenes de Productos</h5>
            </div>
            <div class="card-block">
                <form action="{{url('images/store')}}" class="dropzone" id="dropzone" enctype="multipart/form-data" method="post">
                    <div class="dz-message text-center">
                        <i class="fa fa-cloud-upload-alt" style="font-size: 40px; margin-bottom: 15px;"></i>
                            <h4 class="fw-bold mb-2">Arrastra tus imágenes aquí o haz clic para seleccionar</h4>
                            <p class="text-muted">Las imágenes se vinculan automáticamente si el nombre del archivo coincide con el SKU del producto.</p>

                            <div class="text-start d-inline-block">
                                <h6 class="fw-bold text-dark">Instrucciones:</h6>
                                <ul class="mb-2" style="list-style: disc;">
                                    <li>El <strong>nombre del archivo</strong> debe coincidir con el <strong>SKU</strong> del producto.</li>
                                    <li>Puedes subir <strong>múltiples imágenes a la vez</strong>.</li>
                                    <li>Formatos permitidos: <strong>JPG, PNG, WEBP</strong>.</li>
                                    <li>Tamaño máximo por imagen: <strong>5MB</strong>.</li>
                                    <li>Resolución sugeridad: <strong>500 pixeles x 500 pixeles</strong>.</li>
                            </ul>
                            <div class="alert alert-warning p-2 small mb-0">
                                Evita usar espacios o caracteres especiales en los nombres de archivo.
                            </div>
                        </div>
                    </div>
                    @csrf
                    <input type="file" name="file" multiple  style="display: none;"/>
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
