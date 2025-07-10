@extends('central.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Solicitudes</title>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Listado de Solicitudes</h5>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle mb-0" id="datatable-buttons-table">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Negocio</th>
                                <th>Whatsapp</th>
                                <th>Actividad</th>
                                <th>Instagram</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($solicitudes as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nombre }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->negocio }}</td>
                                    <td>+58 {{ $item->whatsapp }}</td>
                                    <td>{{ $item->actividad }}</td>
                                    <td>{{ $item->instagram ?? '-' }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">No hay solicitudes registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
