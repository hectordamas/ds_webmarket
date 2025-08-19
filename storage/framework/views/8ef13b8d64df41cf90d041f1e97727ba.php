

<?php $__env->startSection('metadata'); ?>
<title><?php echo e(config('app.name')); ?> - Lista de Clientes</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Listado de Clientes
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped" id="customersTable">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Creado</th>
                                    <th>Actualizado</th>
                                    <th>Nombre</th>
                                    <th>Documento de identidad</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Detalle Dirección</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
        function getProductsData(updated){
        $("#loadingSpinner").css("display", "flex"); 

        if ($.fn.DataTable.isDataTable('#customersTable')) {
            $('#customersTable').dataTable().fnClearTable();
			$('#customersTable').dataTable().fnDestroy();
        }

        $('#customersTable').DataTable({
            order: [[0, 'desc']],
            "bDeferRender": true,
            "bProcessing": true,
            "sAjaxSource": "<?php echo e(url('getCustomersData')); ?>",
            "fnServerData": function ( sSource, aoData, fnCallback ) {
				$.getJSON( sSource, aoData, function (json) { 
					fnCallback(json)
                    $("#loadingSpinner").css("display", "none"); 

                    $('#totalInventario').html(json.totalInventario)
                    $('#totalDeProductos').html(json.totalDeProductos)
                    $('#totalUnidades').html(json.totalUnidades)
                    $('#productosAgotados').html(json.productosAgotados);
				} );
			},
            columns: [
                { data: "id" },
                { data: "created_at" },
                { data: "updated_at" },
                { data: "nombre" },
                { data: "cedula" },
                { data: "telefono" },
                { data: "direccion" },
                { data: "detalle_direccion" }
            ],
            "bPaginate": true,
            "sPaginationType":"full_numbers",
            "iDisplayLength": 20,
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
        getProductsData();
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/customers/index.blade.php ENDPATH**/ ?>