@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ env('APP_NAME') }} - Lista de Órdenes</title>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">Lista de Órdenes</h5>
            </div>

            <div class="card-body table-responsive">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-hover table-striped" id="datatable-buttons-table">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Cedula</th>
                            <th>Método de Pago</th>
                            <th>Total</th>
                            <th></th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->nombre }}</td>
                                <td>{{ $order->cedula }}</td>
                                <td>{{ $order->metodo_pago }}</td>
                                <td class="text-success fw-bold">${{ number_format($order->total, 2, '.', ',') }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    <a href="{{ url('orders/ver-detalles/' . $order->id) }}" class="btn btn-dark btn-sm">
                                        <i class="fas fa-list"></i> Ver Detalles
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                                        <i class="far fa-edit"></i> Actualizar Estatus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatuslLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateStatuslLabel">Actualizar Estado de la Orden</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ url('') }}" class="row">
            <div class="col-md-6 form-group">
                <label for="">
                    Estatus
                </label>
                <select name="" id="" class="form-control">
                    
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
    
</script>
@endsection
