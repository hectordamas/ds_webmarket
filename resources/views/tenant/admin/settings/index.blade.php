@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Configuración</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header"><h5>Configuración General</h5></div>
            <div class="card-block">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ url('settings/update') }}" enctype="multipart/form-data" class="row">
                    @csrf

                    <div class="form-group col-md-3 mb-3">
                        <label>Logo actual:</label><br>
                        <img src="{{ img64($settings['logo'] ?? 'assets/img/logo-color.png') }}" height="60" alt="Logo actual">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="logo">Subir nuevo logo:</label>
                        <input type="file" name="logo" id="logo" class="form-control">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="whatsapp_human">Número de WhatsApp:</label>
                        <input type="text" name="whatsapp_human" id="whatsapp_human" class="form-control" value="{{ $settings['whatsapp_human'] ?? '' }}" placeholder="+58 424-1234567">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="color_primary">Color Primario:</label>
                        <input type="color" name="color_primary" id="color_primary" class="form-control" value="{{ $settings['color_primary'] ?? '#00b894' }}">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="facebook">Enlace Facebook:</label>
                        <input type="text" name="facebook" id="facebook" class="form-control" value="{{ $settings['facebook'] ?? '' }}">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="instagram">Enlace Instagram:</label>
                        <input type="text" name="instagram" id="instagram" class="form-control" value="{{ $settings['instagram'] ?? '' }}">
                    </div>

                    <div class="col-md-12">
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
