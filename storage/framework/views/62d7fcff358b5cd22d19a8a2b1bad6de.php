<?php $__env->startSection('metadata'); ?>
<title><?php echo e(env('APP_NAME')); ?> - Lista de Tenants</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Lista de Tenants</h5>
                
                <a href="<?php echo e(route('tenants.create')); ?>" class="btn btn-primary mb-3 shadow"><i class="far fa-plus-square"></i> Crear Tenant</a>
            </div>
            <div class="card-block">
                <table class="table table-striped" id="datatable-buttons-table">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Dominio</th>
                            <th>Empresa</th>
                            <th>Base de Datos</th>
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
                                    <div class="d-flex gap-1">
                                        <a href="<?php echo e(route('tenants.edit', $tenant)); ?>" class="btn btn-sm btn-warning">Editar</a>
                                    
                                        <form action="<?php echo e(route('tenants.destroy', $tenant)); ?>" method="POST" onsubmit="return confirm('¿Seguro?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
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
<script></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('central.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/central/admin/tenant/index.blade.php ENDPATH**/ ?>