<?php $__env->startSection('metadata'); ?>
<title>Editar Tenant - <?php echo e(env('APP_NAME')); ?> </title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
               <h5>Editar Tenant</h5> 
            </div>
            <div class="card-block row">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('tenants.update', $tenant->id)); ?>" method="POST" class="row">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="form-group col-md-3 mb-3">
                        <label for="id" class="form-label">Prefijo del Subdominio</label>
                        <input type="text" id="id" class="form-control" value="<?php echo e($tenant->id); ?>" disabled>
                    </div>
                    <div class="form group col-md-3 mb-3">
                        <label for="nombre_empresa"  class="form-label">Nombre de la Empresa</label>
                        <input type="text" name="nombre_empresa" id="nombre_empresa" class="form-control" value="<?php echo e($tenant->nombre_empresa); ?>">
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="database" class="form-label">Nombre de la Base de Datos</label>
                        <input type="text" name="database" id="database" class="form-control"
                            value="<?php echo e($tenant->tenancy_db_name); ?>" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="username" class="form-label">Usuario de la BD</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="<?php echo e($tenant->tenancy_db_username); ?>" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label for="password" class="form-label">Contraseña de la BD</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Dejar en blanco para no cambiar">
                    </div>

                    <div class="form-group col-md-3 mb-3">
                        <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control"
                            value="<?php echo e($tenant->fecha_vencimiento ? \Carbon\Carbon::parse($tenant->fecha_vencimiento)->format('Y-m-d') : ''); ?>" required>
                    </div>
                    <div class="form-group col-md-3 mb-3">
                        <label class="form-label d-block">Activo</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="activo" id="activo"
                                <?php echo e($tenant->activo ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="activo">Habilitado</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <a href="<?php echo e(route('tenants.index')); ?>" class="btn btn-secondary me-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Tenant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between">
                    <h5>Usuarios del Tenant</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createUserModal">
                        <i class="fa-solid fa-plus"></i> Crear Usuario
                    </button>
                </div>
                <div class="card-block dt-responsive table-responsive">
                    <?php if($users->count() > 0): ?>
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <td>#</td>
                                <td>Fecha de Registro</td>
                                <td>Usuario</td>
                                <td>E-Mail</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($user->id); ?></td>
                                <td><?php echo e($user->created_at->format('d-m-Y h:i A')); ?></td>
                                <td><?php echo e($user->name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td>
                                    <!-- Botón para abrir el modal de edición -->
                                    <button type="button" class="btn btn-sm btn-outline-success btn-edit-user"
                                        data-id="<?php echo e($user->id); ?>"
                                        data-name="<?php echo e($user->name); ?>"
                                        data-email="<?php echo e($user->email); ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                
                                    <!-- Botón para eliminar -->
                                    <form action="<?php echo e(url('users/destroy')); ?>" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" value="<?php echo e($tenant->id); ?>" name="tenant_id">
                                        <input type="hidden" value="<?php echo e($user->id); ?>" name="id">

                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <div class="alert alert-dark mb-0 d-flex align-items-center">
                        <i class="far fa-user fa-2x me-3"></i> No hay usuarios registrados para este tenant.
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de creación de usuario -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="crateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="createUserForm" method="POST" action="<?php echo e(url('users/store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Registrar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="<?php echo e($tenant->id); ?>" name="tenant_id">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Registrar Usuario</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Modal de edición de usuario -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editUserForm" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" value="<?php echo e($tenant->id); ?>" name="tenant_id">
        <input type="hidden" name="id" class="user_id">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="editUserName" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" id="editUserName" required>
                </div>
                <div class="mb-3">
                    <label for="editUserEmail" class="form-label">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" id="editUserEmail" required>
                </div>
                <div class="mb-3">
                    <label  class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function () {
        $('.btn-edit-user').on('click', function () {
            var userId = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');

            // Rellenar los campos del formulario
            $('#editUserName').val(name);
            $('#editUserEmail').val(email);
            $('.user_id').val(userId)

            // Cambiar la acción del formulario con la URL adecuada
            $('#editUserForm').attr('action', "<?php echo e(url('users/update')); ?>"); // Ajusta esta ruta si es diferente

            // Abrir el modal
            $('#editUserModal').modal('show');
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('central.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ds_webmarket\resources\views/central/admin/tenant/edit.blade.php ENDPATH**/ ?>