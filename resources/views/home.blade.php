@extends('layouts.admin')

@section('content')
<div class="py-4">
    <a href="{{ route('tenants.create') }}" class="btn btn-primary mb-3"><i class="far fa-plus-square"></i> Crear Tenant</a>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-lg">
            <div class="card-header">
                Lista de Tenants
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Dominio</th>
                            <th>BD</th>
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
                                    <div class="btn-group" role="group">
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
