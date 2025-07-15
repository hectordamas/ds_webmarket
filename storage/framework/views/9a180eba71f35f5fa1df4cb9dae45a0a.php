

<?php $__env->startSection('metadata'); ?>
<title><?php echo e(env('APP_NAME')); ?> - Lista de Órdenes</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">Lista de Órdenes</h5>
            </div>

            <div class="card-body table-responsive">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <input type="hidden" id="lastOrderId" value="<?php echo e($orders->first()?->id ?? 0); ?>">

                <table class="table table-bordered table-hover table-striped" id="datatable-buttons-table">
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
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('tenant.admin.orders.partials._rows', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <form action="<?php echo e(url('')); ?>" class="row">
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
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).on('click', '.viewDetailsButton', function(){
        var id = $(this).data('id');

        $('#orderContent').html('');      // Limpia contenido anterior
        $('#spinner').show().addClass('d-flex');

        $('#viewDetailsModal').modal('show');  // Mostrar modal ya para que se vea el spinner

        $.ajax({
            method: 'POST',
            url: "<?php echo e(url('orden-detalle')); ?>",
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
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
            url: "<?php echo e(url('orders/update-status')); ?>",
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
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


<script>
    function updateOrdersPolling() {
        let lastId = $('#lastOrderId').val(); // Leer el valor actual

      $.ajax({
        url: "<?php echo e(url('orders/polling')); ?>", // Endpoint que devuelve solo filas nuevas o actualizadas
        method: 'GET',
        data: { last_id: lastId }, // Enviamos el last_id como parámetro
        success: function(response) {
          // response puede ser JSON con array de filas en HTML o datos
          // Ejemplo: response.orders = [{id:1, html: "<tr>...</tr>"}, ...]

          response.orders.forEach(order => {
            let existingRow = $(`#datatable-buttons-table tbody tr[data-id="${order.id}"]`);

            if (existingRow.length) {
              // Si ya existe fila, la reemplazamos para actualizar datos
              existingRow.replaceWith(order.html);
            
              // Animación de highlight (fade in/out)
              let newRow = $(`#datatable-buttons-table tbody tr[data-id="${order.id}"]`);
              newRow.addClass('table-warning');
              setTimeout(() => newRow.removeClass('table-warning'), 2000);

            } else {
              // Si no existe, la agregamos al inicio
              $('#datatable-buttons-table tbody').prepend(order.html);

              // Animación de highlight para fila nueva
              let newRow = $(`#datatable-buttons-table tbody tr[data-id="${order.id}"]`);
              newRow.addClass('table-success');
              setTimeout(() => newRow.removeClass('table-success'), 2000);
            }

            // Actualizar el input oculto si llega un ID mayor
            if (order.id > lastId) {
                $('#lastOrderId').val(order.id);
            }
          });
        }
      });
    }

    // Ejecutar polling cada 10 segundos
    setInterval(updateOrdersPolling, 10000);
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/orders/index.blade.php ENDPATH**/ ?>