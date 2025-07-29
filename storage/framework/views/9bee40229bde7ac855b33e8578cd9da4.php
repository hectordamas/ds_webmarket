<?php $__env->startSection('metadata'); ?>
<title><?php echo e(config('app.name')); ?> - Lista de Productos</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xl-3">
        <div class="card bg-c-green order-card shadow-sm">
            <div class="card-block">
                <h6>Total Inventario</h6>
                <h2 id="totalInventario">...</h2>
                <i class="card-icon fas fa-boxes-stacked"></i>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="card bg-c-blue order-card shadow-sm">
            <div class="card-block">
                <h6>Total Productos</h6>
                <h2 id="totalDeProductos">...</h2>
                <i class="card-icon feather icon-box"></i>
            </div>
        </div>
    </div>
    <div class="col-xl-3">
        <div class="card bg-c-pink order-card shadow-sm">
            <div class="card-block">
                <h6>Total Unidades</h6>
                <h2 id="totalUnidades">...</h2>
                <i class="card-icon fas fa-warehouse"></i>
            </div>
        </div>
    </div>
        <div class="col-xl-3">
        <div class="card bg-c-yellow order-card shadow-sm">
            <div class="card-block">
                <h6>Productos Agotados</h6>
                <h2 id="productosAgotados">...</h2>
                <i class="card-icon fas fa-triangle-exclamation"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Lista de Productos</h5>
            </div>

            <div class="card-block table-responsive">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <table class="table table-bordered table-hover" id="productsTable">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Imagen</th>
                            <th>SKU</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                            <th>Existencia</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Modal Reutilizable -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-body">
        <img id="modalImage" src="" class="img-fluid w-100 rounded">
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function showImageModal(imageUrl) {
    document.getElementById('modalImage').src = imageUrl;
}
</script>

<script>
$(document).ready(function () {
    // Manejador para ambos checkboxes
    $('.product-active, .product-visible').on('change', function () {
        const checkbox = $(this);
        const productId = checkbox.data('id');
        const isChecked = checkbox.is(':checked') ? 1 : 0;
        const field = checkbox.hasClass('product-active') ? 'active' : 'visible';

        $.ajax({
            url: "<?php echo e(url('products/toggle')); ?>",
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                id: productId,
                field: field,
                checked: isChecked
            },
            success: function (response) {
                if (!response.success) {
                    alert('Ocurrió un error al actualizar el estado.');
                    checkbox.prop('checked', !isChecked); // revertir el cambio si falla
                }
            },
            error: function () {
                alert('No se pudo actualizar el estado del producto.');
                checkbox.prop('checked', !isChecked); // revertir el cambio si falla
            }
        });
    });
});
</script>

<script>
    function getProductsData(updated){
        $("#loadingSpinner").css("display", "flex"); 

        if ($.fn.DataTable.isDataTable('#productsTable')) {
            $('#productsTable').dataTable().fnClearTable();
			$('#productsTable').dataTable().fnDestroy();
        }

        $('#productsTable').DataTable({
            order: [[0, 'desc']],
            "bDeferRender": true,
            "bProcessing": true,
            "sAjaxSource": "<?php echo e(url('products/getProductsData')); ?>",
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
            "columns": [
                { data: "id" },
                { data: "image" },
                { data: "sku" },
                { data: "name" },
                { data: "category" },
                { data: "price" },
                { data: "stock" },
                { data: "estado" },
                { data: "acciones" }
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

<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/products/index.blade.php ENDPATH**/ ?>