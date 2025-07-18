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

                <table class="table table-bordered table-hover table-striped ordersTable" id="datatable-buttons-table">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>Cliente</th>
                            <th>Cedula</th>
                            <th>Método de Pago</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            @include('tenant.admin.orders.partials._rows')
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
            <input type="hidden" id="order_id">

            <div class="col-md-6 form-group">
                <label for="status">
                    Estatus
                </label>
                <select name="status" id="status" class="form-control" required>
                    <option value="">Seleccione una Opción</option>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Confirmado">Confirmado</option>
                    <option value="Enviado">Enviado</option>
                    <option value="Entregado">Entregado</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
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

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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

<script>
    let selectedOrderId = null;

    // Abrir modal y cargar ID
    $(document).on('click', '.updateStatusBtn', function () {
        selectedOrderId = $(this).data('id');
        $('#order_id').val(selectedOrderId);
        $('#status').val($(this).data('current-status'));
    });

    // Guardar cambios
    $('.btn-primary').on('click', function () {
        const newStatus = $('#status').val();
        const id = $('#order_id').val();

        if (!newStatus) {
            Swal.fire({
                icon: 'warning',
                title: 'Selecciona un estado',
                text: 'Por favor selecciona un estatus antes de guardar'
            });
            return;
        }

        $.ajax({
            url: "{{ url('orders/update-status') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                status: newStatus
            },
            success: function () {
                $('#updateStatusModal').modal('hide');

                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'El estado de la orden fue actualizado correctamente.',
                    timer: 1500,
                    showConfirmButton: false
                });

                // Opcional: recargar la página o actualizar directamente el texto
                setTimeout(() => location.reload(), 1000);
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo actualizar el estado de la orden.'
                });
            }
        });
    });
</script>

@endsection
