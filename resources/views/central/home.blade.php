@extends('central.layouts.admin')
@section('metadata')
<title>{{ env('APP_NAME') }} - Lista de Tenants</title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Lista de Tenants</h5>
                
                <a href="{{ route('tenants.create') }}" class="btn btn-primary mb-3 shadow"><i class="far fa-plus-square"></i> Crear Tenant</a>
            </div>
            <div class="card-block">
                <table class="table table-striped" id="datatable-buttons-table">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Dominio</th>
                            <th>Base de Datos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tenants as $tenant)
                            <tr>
                                <td>{{ $tenant->id }}</td>
                                <td>
                                    {{ $tenant->domains->first()->domain ?? 'Sin dominio' }}
                                </td>
                                <td>{{ $tenant->tenancy_db_name }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('tenants.edit', $tenant) }}" class="btn btn-sm btn-warning">Editar</a>
                                    
                                        <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" onsubmit="return confirm('¿Seguro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script></script>
@endsection
