

<?php $__env->startSection('metadata'); ?>
    <title>Usuarios - <?php echo e(config('app.name')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Lista de Usuarios</h5>
                    <a href="<?php echo e(url('usuarios/create')); ?>" class="btn btn-success">
                        <i class="fas fa-user-plus me-1"></i> Nuevo Usuario
                    </a>
                </div>
                <div class="card-block">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>

                    <?php if($users->count()): ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="datatable-buttons-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Registrado</th>
                                        <th class="text-end">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($user->id); ?></td>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e($user->email); ?></td>
                                            <td><?php echo e(ucfirst($user->role ?? 'N/A')); ?></td>
                                            <td><?php echo e($user->created_at->format('d/m/Y')); ?></td>
                                            <td class="text-end">
                                                <a href="<?php echo e(url("usuarios/{$user->id}/edit")); ?>" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="<?php echo e(url("usuarios/{$user->id}")); ?>" method="POST" class="d-inline"
                                                    onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    
                    
                    <?php else: ?>
                        <div class="alert alert-info">
                            No hay usuarios registrados aún.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ds_webmarket\resources\views/tenant/admin/users/index.blade.php ENDPATH**/ ?>