@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Configuración</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h5>Configuración General</h5>
            </div>
            <div class="card-block">

                <!-- Tabs -->
                <ul class="nav nav-tabs nav-pills mb-4" id="settingsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="appearance-tab" data-bs-toggle="tab" data-bs-target="#appearance" type="button" role="tab">
                            🎨 Apariencia
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
                            🧾 Información
                        </button>
                    </li>
                </ul>

                <form method="POST" action="{{ url('settings/update') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- Contenido de pestañas -->
                    <div class="tab-content" id="settingsTabContent">
                    
                        <!-- Apariencia -->
                        <div class="tab-pane fade show active" id="appearance" role="tabpanel">
                            <div class="bg-light p-4 rounded shadow-sm">
                                <div class="row align-items-center">
                                    <div class="form-group col-md-4 mb-4 text-center">
                                        <label class="fw-semibold d-block mb-2">Logo actual:</label>
                                        <img src="{{ img64($settings['logo'] ?? 'assets/img/logo-color.png') }}" height="60" alt="Logo actual" class="img-thumbnail">
                                    </div>
                                    <div class="form-group col-md-4 mb-4">
                                        <label for="logo" class="fw-semibold">Subir nuevo logo:</label>
                                        <input type="file" name="logo" id="logo" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4 mb-4">
                                        <label for="color_primary" class="fw-semibold">Color Primario:</label>
                                        <input type="color" name="color_primary" id="color_primary" class="form-control form-control-color" value="{{ $settings['color_primary'] ?? '#00b894' }}" title="Elige un color">
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Información -->
                        <div class="tab-pane fade" id="info" role="tabpanel">
                            <div class="bg-light p-4 rounded shadow-sm">
                                <div class="row">
                                    <div class="form-group col-md-4 mb-4">
                                        <label for="whatsapp_human" class="fw-semibold">Número de WhatsApp:</label>
                                        <input type="text" name="whatsapp_human" id="whatsapp_human" class="form-control" value="{{ $settings['whatsapp_human'] ?? '' }}" placeholder="+58 424-1234567">
                                    </div>
                                    <div class="form-group col-md-4 mb-4">
                                        <label for="facebook" class="fw-semibold">Enlace Facebook:</label>
                                        <input type="text" name="facebook" id="facebook" class="form-control" value="{{ $settings['facebook'] ?? '' }}">
                                    </div>
                                    <div class="form-group col-md-4 mb-4">
                                        <label for="instagram" class="fw-semibold">Enlace Instagram:</label>
                                        <input type="text" name="instagram" id="instagram" class="form-control" value="{{ $settings['instagram'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Guardar Configuración
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
