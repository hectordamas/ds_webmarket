@extends('tenant.layouts.admin')

@section('metadata')
<title>{{ config('app.name') }} - Lista de Órdenes</title>
@endsection
@section('styles')
<style>
    .status-card {
        cursor: pointer;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .status-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    .status-card:active {
        transform: scale(0.95);
    }
</style>
@endsection
@section('content')
<div class="row">
    @php
        $estatusCollection = [
            ['id' => 1, 'name' => 'Pendientes',   'count' => 0, 'color' => 'c-yellow', 'icon' => 'fas fa-hourglass-start'],     // reloj esperando
            ['id' => 2, 'name' => 'Confirmados',  'count' => 0, 'color' => 'info',    'icon' => 'fas fa-check'],               // check simple
            ['id' => 3, 'name' => 'Enviados',     'count' => 0, 'color' => 'primary', 'icon' => 'fas fa-paper-plane'],         // enviado
            ['id' => 4, 'name' => 'Entregados',   'count' => 0, 'color' => 'c-green', 'icon' => 'fas fa-box-open'],            // entregado
            ['id' => 5, 'name' => 'Cancelados',   'count' => 0, 'color' => 'c-pink',  'icon' => 'fas fa-ban'],  
            ['id' => 6, 'name' => 'Ventas Totales',   'count' => 0, 'color' => 'c-blue',  'icon' => 'fas fa-dollar'],                 // cancelado
        ];
    @endphp


    @foreach($estatusCollection as $status)
    <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6">
        <div class="card text-white bg-{{ $status['color'] }} shadow-sm status-card getPresupuestosByStatus" data-id="{{ $status['id'] }}">
            <div class="card-body text-center">
                <i class="{{ $status['icon'] }} fa-2x mb-2"></i>
                <h5 class="my-2">{{ $status['name'] }}</h5>
                <h5 class="fw-bold count{{ $status['id'] }}">0</h5>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5>Consultar Órdenes</h5>
                <span>🛒 Filtra las Órdenes recibidas por período de tiempo.</span>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-12">
                        <form method="GET" class="mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <label class="fw-bold">Filtrar por Rango:</label>
                                <select name="range" class="form-select w-auto" id="range">
                                    <option value="today">Hoy</option>
                                    <option value="week">Esta semana</option>
                                    <option value="month">Este mes</option>
                                    <option value="year">Este año</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">Lista de Órdenes</h5>
            </div>

            <div class="card-block">                
                
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <ul class="nav nav-tabs md-tabs mb-4" id="ordersTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link fw-bold active" id="appearance-tab" data-bs-toggle="tab" href="#delivery" type="button" role="tab">
                            🎨 Delivery
                        </a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link fw-bold" id="info-tab" data-bs-toggle="tab" href="#pickup" type="button" role="tab">
                            🧾 Entrega en el Local
                        </a>
                        <div class="slide"></div>
                    </li>
                </ul>

                <div class="tab-content" id="ordersTabContent">
                    <div class="tab-pane fade show active table-responsive" id="delivery" role="tabpanel">
                        <table class="table table-hover ordersTable" id="ordersDeliveryTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Número</th>
                                    <th>Cliente</th>
                                    <th>Cedula</th>
                                    <th>Método de Pago</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="ordersDeliveryTbodyTable"></tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade table-responsive" id="pickup" role="tabpanel">
                        <table class="table table-hover ordersPickupTable" id="ordersPickupTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Número</th>
                                    <th>Cliente</th>
                                    <th>Cedula</th>
                                    <th>Método de Pago</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="ordersPickupTbodyTable"></tbody>
                        </table>
                    </div>
                <div>

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
        <h5 class="modal-title" id="viewDetailsModalLabel">Detalles de la Orden: </h5><strong class="ms-2">#</strong><strong id="orderNumeroTitle"></strong>
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
    function getOrdersData(updated){
        $("#loadingSpinner").css("display", "flex"); 

        let range = $('#range').val();

        if ($.fn.DataTable.isDataTable('#ordersDeliveryTable')) {
            $('#ordersDeliveryTable').dataTable().fnClearTable();
			$('#ordersDeliveryTable').dataTable().fnDestroy();
        }

        if ($.fn.DataTable.isDataTable('#ordersPickupTable')) {
            $('#ordersPickupTable').dataTable().fnClearTable();
			$('#ordersPickupTable').dataTable().fnDestroy();
        }

        $('#ordersDeliveryTable').DataTable({
            order: [[0, 'desc']],
            "bDeferRender": true,
            "bProcessing": true,
            "sAjaxSource": "{{ url('orders/getOrdersDeliveryData') }}",
            "fnServerData": function ( sSource, aoData, fnCallback ) {
				$.getJSON( sSource, aoData, function (json) { 
					fnCallback(json)
                    $("#loadingSpinner").css("display", "none"); 

                    $('.count1').html(json.pendientes);
                    $('.count2').html(json.confirmados);
                    $('.count3').html(json.enviados);
                    $('.count4').html(json.entregados);
                    $('.count5').html(json.cancelados);
                    $('.count6').html(json.totalVentas);

                    if(updated){
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El estado de la orden fue actualizado correctamente.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
				} );
			},
            columns: [
                { data: 'id' },
                { data: 'numero_orden' },
                { data: 'nombre' },
                { data: 'cedula' },
                { data: 'metodo_pago' },
                { data: 'total' },
                { data: 'estatus' },
                { data: 'fecha' },
                { data: 'acciones' },
            ],
            createdRow: function(row, data, dataIndex) {
                // Aquí puedes agregar data-id, clases, estilos, etc.
                $(row).attr('data-id', data.id);
                $(row).addClass('order_row_' + data.id);
                if (!data.is_read) {
                    $(row).addClass('table-secondary');
                }
            },
            "bPaginate": true,
            "sPaginationType":"full_numbers",
            "iDisplayLength": 20,
            "fnServerParams": function ( aoData ) {
                aoData.push( { "name": "range", "value": range } );
            },
            dom: 'Bfrtip',
			buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],	        
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            pageLength: 20,
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
                "sInfoFiltered": "(filtrado de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                }
            }
        });

        $('#ordersPickupTable').DataTable({
            order: [[0, 'desc']],
            "bDeferRender": true,
            "bProcessing": true,
            "sAjaxSource": "{{ url('orders/getOrdersPickupData') }}",
            "fnServerData": function ( sSource, aoData, fnCallback ) {
				$.getJSON( sSource, aoData, function (json) { 
					fnCallback(json)
                    if(updated){
                        Swal.fire({
                            icon: 'success',
                            title: '¡Actualizado!',
                            text: 'El estado de la orden fue actualizado correctamente.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
				} );
			},
            columns: [
                { data: 'id' },
                { data: 'numero_orden' },
                { data: 'nombre' },
                { data: 'cedula' },
                { data: 'metodo_pago' },
                { data: 'total' },
                { data: 'estatus' },
                { data: 'fecha' },
                { data: 'acciones' },
            ],
            createdRow: function(row, data, dataIndex) {
                // Aquí puedes agregar data-id, clases, estilos, etc.
                $(row).attr('data-id', data.id);
                $(row).addClass('order_row_' + data.id);
                if (!data.is_read) {
                    $(row).addClass('table-secondary');
                }
            },
            "bPaginate": true,
            "sPaginationType":"full_numbers",
            "iDisplayLength": 20,
            "fnServerParams": function ( aoData ) {
                aoData.push( { "name": "range", "value": range } );
            },
            dom: 'Bfrtip',
			buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],	        
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            pageLength: 20,
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 a 0 de 0 registros",
                "sInfoFiltered": "(filtrado de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                }
            }
        });

    }

    $(function(){
        getOrdersData();
    });

    $('#range').on('change', function() {
        getOrdersData();
    });

    $(document).on('click', '.viewDetailsButton', function(){
        var id = $(this).data('id');

        $('#orderContent').html('');      // Limpia contenido anterior
        $('#spinner').show().addClass('d-flex');

        $('#viewDetailsModal').modal('show');  // Mostrar modal ya para que se vea el spinner
        $('.point' + id).removeClass('d-inline-block');
        $('.point' + id).addClass('d-none');
        $('.order_row_' + id).removeClass('table-secondary');
        $.ajax({
            method: 'POST',
            url: "{{ url('orden-detalle') }}",
            data: {
                _token: '{{ csrf_token() }}',
                id: id
            },
            success: function(response){
                $('#spinner').hide().removeClass('d-flex');
                $('#orderContent').html(response.html);  // Muestra detalle
                $('#orderNumeroTitle').html(response.order.numero_orden);
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



                // Opcional: recargar la página o actualizar directamente el texto
                getOrdersData(true);
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
