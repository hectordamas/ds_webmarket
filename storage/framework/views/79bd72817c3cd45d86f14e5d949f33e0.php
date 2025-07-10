

<?php $__env->startSection('metadata'); ?>
<title><?php echo e(env('APP_NAME')); ?> - Solicitudes</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Listado de Solicitudes</h5>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle mb-0" id="datatable-buttons-table">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Negocio</th>
                                <th>Whatsapp</th>
                                <th>Actividad</th>
                                <th>Instagram</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $solicitudes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->nombre); ?></td>
                                    <td><?php echo e($item->email); ?></td>
                                    <td><?php echo e($item->negocio); ?></td>
                                    <td>+58 <?php echo e($item->whatsapp); ?></td>
                                    <td><?php echo e($item->actividad); ?></td>
                                    <td><?php echo e($item->instagram ?? '-'); ?></td>
                                    <td><?php echo e($item->created_at->format('d/m/Y H:i')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted">No hay solicitudes registradas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('central.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/central/admin/formRequests/index.blade.php ENDPATH**/ ?>