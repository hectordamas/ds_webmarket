<?php $__env->startSection('metadata'); ?>
    <title><?php echo e(config('app.name')); ?> - Editar Producto</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h5>Editar Producto</h5>
            </div>
            <div class="card-block">
                <form method="POST" action="<?php echo e(url('products/' . $product->id . '/update')); ?>" enctype="multipart/form-data" class="row">
                    <?php echo csrf_field(); ?>

                    <div class="form-group col-md-3">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" value="<?php echo e(old('name', $product->name)); ?>" class="form-control" required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="price">Precio</label>
                        <input type="number" name="price" step="0.01" value="<?php echo e(old('price', $product->price)); ?>" class="form-control" required>
                        <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>



                    <div class="form-group col-md-3">
                        <label for="category_id">Categoría</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Seleccione --</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>
                                    <?php echo e($category->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="active">Estado</label>
                        <select name="active" class="form-control">
                            <option value="1" <?php echo e(old('active', $product->active) == '1' ? 'selected' : ''); ?>>Activo</option>
                            <option value="0" <?php echo e(old('active', $product->active) == '0' ? 'selected' : ''); ?>>Inactivo</option>
                        </select>
                        <?php $__errorArgs = ['active'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="image">Imagen (opcional)</label>
                        <input type="file" name="image" class="form-control">
                        <?php if($product->image): ?>
                            <small class="d-block mt-1">Actual: <img src="<?php echo e(img64($product->image)); ?>" height="60"></small>
                        <?php endif; ?>
                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-md-8"></div>

                    <div class="form-group col-md-8">
                        <label for="description">Descripción</label>
                        <textarea name="description" class="form-control" rows="3"><?php echo e(old('description', $product->description)); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <small class="text-danger"><?php echo e($message); ?></small> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group col-md-12 mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Actualizar
                        </button>
                        <a href="<?php echo e(url('products')); ?>" class="btn btn-secondary">Cancelar</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">Opciones Extras del Producto</h5>
                    <span>Personaliza las opciones para este producto</span>
                </div>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#groupModal">
                    <i class="fas fa-plus"></i> Nuevo Grupo
                </button>
            </div>
            <div class="card-block">

                <?php if($product->optionGroups->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>Nombre del Grupo</th>
                                    <th>Tipo</th>
                                    <th>Requerido</th>
                                    <th>Opciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $product->optionGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($group->name); ?></td>
                                        <td><?php echo e(ucfirst($group->type)); ?></td>
                                        <td><?php echo e($group->required ? 'Sí' : 'No'); ?></td>
                                        <td>
                                            <!-- En la sección de opciones dentro del grupo -->
                                            <?php $__currentLoopData = $group->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="option-item d-flex align-items-center mb-2 p-2 bg-light rounded">
                                                    <div class="flex-grow-1">
                                                        <span class="fw-bold"><?php echo e($option->name); ?></span>
                                                        <span class="text-success ms-2">+<?php echo e(number_format($option->price, 2)); ?></span>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-outline-warning edit-option-btn" 
                                                                data-option="<?php echo e($option->toJson()); ?>"
                                                                data-group-id="<?php echo e($group->id); ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <form action="<?php echo e(route('tenant.options.destroy', $option->id)); ?>" 
                                                              method="POST" class="d-inline">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                    onclick="return confirm('¿Eliminar esta opción?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <button class="btn btn-sm btn-success add-option-btn" 
                                                    data-group-id="<?php echo e($group->id); ?>">
                                                <i class="fas fa-plus-circle"></i> Agregar opción
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning edit-group-btn" 
                                                    data-group="<?php echo e($group->toJson()); ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="<?php echo e(route('tenant.option-groups.destroy', $group->id)); ?>" 
                                                  method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('¿Eliminar este grupo y todas sus opciones?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-dark mb-0 d-flex align-items-center">
                        <i class="far fa-list-alt fa-2x me-3"></i> No hay grupos de opciones configurados para este producto.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal para Grupos -->
    <div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="groupModalTitle">Nuevo Grupo de Opciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="groupForm" method="POST" action="<?php echo e(route("tenant.option-groups.store")); ?>"> 
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="group_id" name="id">
                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="group_name">Nombre del Grupo *</label>
                                <input type="text" class="form-control" id="group_name" name="name" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="group_type">Tipo *</label>
                                <select class="form-control" id="group_type" name="type" required>
                                    <option value="single">Selección única</option>
                                    <option value="multiple">Selección múltiple</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="group_required">Requerido</label>
                                <select class="form-control" id="group_required" name="required">
                                    <option value="0">No</option>
                                    <option value="1">Sí</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="min_options">Mínimo de opciones</label>
                                <input type="number" class="form-control" id="min_options" name="min_options" min="0">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="max_options">Máximo de opciones</label>
                                <input type="number" class="form-control" id="max_options" name="max_options" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Grupo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Opciones -->
    <div class="modal fade" id="optionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="optionModalTitle">Nueva Opción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="optionForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="option_id" name="id">
                    <input type="hidden" id="option_group_id" name="product_option_group_id">

                    <div class="modal-body row">
                        <div class="form-group col-md-6">
                            <label for="option_name">Nombre de la opción *</label>
                            <input type="text" class="form-control" id="option_name" name="name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="option_price">Precio adicional</label>
                            <input type="number" step="0.01" class="form-control" id="option_price" name="price" value="0" min="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Opción</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    // Resetear modal de grupo al cerrar
    $('#groupModal').on('hidden.bs.modal', function () {
        $('#groupForm')[0].reset();
        $('#group_id').val('');
        $('#groupModalTitle').text('Nuevo Grupo de Opciones');
        $('#groupForm').attr('action', '<?php echo e(route("tenant.option-groups.store")); ?>');
        $('input[name="_method"]').remove();
    });
    
    // Editar grupo existente
    $('.edit-group-btn').click(function() {
        const group = $(this).data('group');
        
        $('#groupModalTitle').text('Editar Grupo de Opciones');
        $('#group_id').val(group.id);
        $('#group_name').val(group.name);
        $('#group_type').val(group.type);
        $('#group_required').val(group.required ? '1' : '0');
        $('#min_options').val(group.min_options);
        $('#max_options').val(group.max_options);
        
        $('#groupForm').attr('action', '<?php echo e(url("tenant/option-groups")); ?>/' + group.id);
        $('#groupForm').append('<input type="hidden" name="_method" value="PUT">');
        
        $('#groupModal').modal('show');
    });
    
    // Mostrar modal para nueva opción
    $('.add-option-btn').click(function() {
        const groupId = $(this).data('group-id');
        
        $('#optionModalTitle').text('Nueva Opción');
        $('#option_id').val('');
        $('#option_group_id').val(groupId);
        $('#optionForm')[0].reset();
        $('#optionForm').attr('action', '<?php echo e(route("tenant.options.store")); ?>');
        $('input[name="_method"]').remove();
        
        $('#optionModal').modal('show');
    });
    
    // Editar opción existente
    $(document).on('click', '.edit-option-btn', function() {
        const option = $(this).data('option');
        const groupId = $(this).data('group-id');
        
        $('#optionModalTitle').text('Editar Opción');
        $('#option_id').val(option.id);
        $('#option_group_id').val(groupId);
        $('#option_name').val(option.name);
        $('#option_price').val(option.price);
        
        $('#optionForm').attr('action', '<?php echo e(url("options")); ?>/' + option.id);
        $('#optionForm').append('<input type="hidden" name="_method" value="PUT">');
        
        $('#optionModal').modal('show');
    });
    

    // Resetear modal de opción al cerrar
    $('#optionModal').on('hidden.bs.modal', function () {
        $('#optionForm')[0].reset();
        $('#option_id').val('');
        $('#optionModalTitle').text('Nueva Opción');
        $('#optionForm').attr('action', '<?php echo e(route("tenant.options.store")); ?>');
        $('input[name="_method"]').remove();
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('tenant.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/admin/products/edit.blade.php ENDPATH**/ ?>