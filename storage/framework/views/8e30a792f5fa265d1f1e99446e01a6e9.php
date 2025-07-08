

<?php $__env->startSection('metadata'); ?>
<title><?php echo e(env('APP_NAME')); ?> - Métodos de Pago</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Modal -->
<div class="modal fade" id="createPayment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5" id="exampleModalLabel">Crear Método de Pago</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo e(url('payments/store')); ?>" method="POST" class="row">
            <?php echo csrf_field(); ?>

            <div class="col-md-6 form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" required name="name">
            </div>

            <div class="col-md-6 form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="active" checked>
                  <label class="form-check-label" for="checkDefault">
                    Activo
                  </label>
                </div>
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

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Lista de Métodos de Pago</h5>
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createPayment">
                    <i class="fas fa-plus"></i> Nuevo Métodos de Pago

                </a>
            </div>

            <div class="card-body table-responsive">
                <?php if(session('success')): ?>
                    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <table class="table table-bordered table-striped" id="datatable-buttons-table">
                    <thead class="table-dark">
                        <th>#</th>
                        <th>Método de Pago</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($payment->id); ?></td>
                            <td><?php echo e($payment->name); ?></td>
                            <td>
                                <input type="checkbox" <?php echo e($payment->active ? 'checked' : ''); ?> name="active" data-id="<?php echo e($payment->id); ?>" class="active-payment">
                            </td>
                            <td>
                                <form action="<?php echo e(url('payments/destroy/'.$payment->id)); ?>" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este método de pago?');">
                                    <?php echo csrf_field(); ?>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </td>                     
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script>
    $(document).on('change', '.active-payment', function () {
        var id = $(this).data('id');
        var active = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: "<?php echo e(url('payments/toggle-active')); ?>",
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                id: id,
                active: active
            },
            success: function (response) {
                console.log('Estado actualizado');
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo actualizar el estado del método de pago.'
                });
            }
        });
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/payments/index.blade.php ENDPATH**/ ?>