<?php $__env->startSection('metadata'); ?>
<title><?php echo e(config('app.name')); ?> - Lista de Tenants</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Lista de Tenants</h5>
                
                <a href="<?php echo e(route('tenants.create')); ?>" class="btn btn-primary mb-3 shadow"><i class="far fa-plus-square"></i> Crear Tenant</a>
            </div>
            <div class="card-block dt-responsive table-responsive">
                <table class="table table-striped" id="datatable-buttons-table">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Dominio</th>
                            <th>Empresa</th>
                            <th>Base de Datos</th>
                            <th>Activo</th>
                            <th>Fecha de Expiracion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $tenants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($tenant->id); ?></td>
                                <td>
                                    <?php echo e($tenant->domains->first()->domain ?? 'Sin dominio'); ?>

                                </td>
                                <td><?php echo e($tenant->nombre_empresa); ?></td>
                                <td><?php echo e($tenant->tenancy_db_name); ?></td>
                                <td>
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input class="form-check-input toggle-activo" type="checkbox"
                                            data-id="<?php echo e($tenant->id); ?>"
                                            <?php echo e($tenant->activo ? 'checked' : ''); ?>>
                                    </div>
                                </td>
                                <td>
                                    <?php echo e($tenant->fecha_vencimiento ? \Carbon\Carbon::parse($tenant->fecha_vencimiento)->format('d-m-Y') : ''); ?>

                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="<?php echo e(route('tenants.edit', $tenant)); ?>" class="btn btn-sm btn-warning">Editar</a>
                                    
                                        
                                    </div>
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
$(document).ready(function() {
    $('.toggle-activo').change(function() {
        var checkbox = $(this);
        var tenantId = checkbox.data('id');
        var checked = checkbox.is(':checked');

        $.ajax({
            url: '/tenants/' + tenantId + '/toggle-activo',
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                if (!response.success) {
                    alert('Error al actualizar el estado.');
                    checkbox.prop('checked', !checked); // revertir
                }
            },
            error: function() {
                alert('Error en el servidor.');
                checkbox.prop('checked', !checked); // revertir
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('central.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/central/admin/tenant/index.blade.php ENDPATH**/ ?>