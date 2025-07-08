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
                                    <a href="javascript:void(0)" data-id="{{ $order->id }}" class="btn btn-dark btn-sm viewDetailsButton">
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

<!-- Modal -->
<div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewDetailsModalLabel">Detalles de la Orden</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="orderDetails">
        <div id="spinner" class="d-flex justify-content-center align-items-center" style="height: 150px;">
          <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Cargando...</span>
          </div>
        </div>
        <div id="orderContent"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).on('click', '.viewDetailsButton', function(){
        var id = $(this).data('id');

        $('#orderContent').html('');      // Limpia contenido anterior
        $('#spinner').show().addClass('d-flex');

        $('#viewDetailsModal').modal('show');  // Mostrar modal ya para que se vea el spinner

        $.ajax({
            method: 'POST',
            url: "{{ url('orden-detalle') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            },
            success: function(response){
                $('#spinner').hide().removeClass('d-flex');
                $('#orderContent').html(response);  // Muestra detalle
            },
            error: function(){
                $('#spinner').hide().removeClass('d-flex');
                $('#orderContent').html(''); // Limpia contenido

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo cargar el detalle de la orden'
                });
            }
        });
    });

</script>
@endsection
