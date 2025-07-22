<div class="text-center mb-3">
    <img src="<?php echo e(img64($product->image)); ?>" alt="<?php echo e($product->name); ?>" class="img-fluid rounded" style="max-height: 200px;">
    <?php if($product->stock < 1): ?>
        <span class="badge bg-danger position-absolute top-0 start-0 m-2">No Disponible</span>
    <?php else: ?>
        <span class="badge bg-success position-absolute top-0 start-0 m-2"><?php echo e($product->stock); ?> Disponible<?php echo e($product->stock > 1 ? 's' : ''); ?></span>
    <?php endif; ?>
</div>

<div class="d-flex justify-content-between">
    <div>
        <h6 class="fw-bold"><?php echo e($product->name); ?></h6>
        <p class="text-muted small"><?php echo e($product->description); ?></p>
    </div>
    <div>
        <h5 class="text-tenant fw-bold">$<?php echo e(number_format($product->price, 2)); ?></h5>
    </div>
</div>

<?php $__currentLoopData = $product->optionGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <h6 class="fw-bold mt-4 mb-2"><?php echo e($group->name); ?> <?php if($group->required): ?> * <?php endif; ?></h6>
    <table class="table table-sm table-striped">
        <tbody class="option-group" data-group-id="<?php echo e($group->id); ?>">
            <?php $__currentLoopData = $group->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <?php echo e($option->name); ?>

                    <?php if($option->price > 0): ?>
                        (+$<?php echo e(number_format($option->price, 2)); ?>)
                    <?php endif; ?>
                </td>
                <td class="text-end">
                    <?php if($group->type == 'single'): ?>
                        <input type="radio" name="options[<?php echo e($group->id); ?>]" 
                               value="<?php echo e($option->id); ?>" 
                               data-price="<?php echo e($option->price); ?>"
                               <?php echo e($loop->first ? 'checked' : ''); ?>>
                    <?php else: ?>
                        <input type="checkbox" name="options[<?php echo e($group->id); ?>][]" 
                               value="<?php echo e($option->id); ?>"
                               data-price="<?php echo e($option->price); ?>">
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class="my-4">
    <label for="productObservations" class="fw-bold mb-2">Observaciones</label>
    <textarea class="form-control" id="productObservations" rows="2" placeholder="Especificaciones adicionales..."></textarea>
</div>

<div class="modal-footer shadow-lg">
    <div class="d-flex w-100 gap-2">
        <div class="w-50">
            <label for="productQuantity" class="fw-bold mb-2">Cantidad</label>
            <div class="input-group" style="width: 140px;">
                <button class="btn btn-outline-dark" type="button" id="decreaseQty" <?php if($product->stock < 1): ?> disabled <?php endif; ?>>−</button>
                <input type="number" class="form-control text-center" value="1" min="1" id="productQuantity" readonly>
                <button class="btn btn-outline-dark" type="button" id="increaseQty" <?php if($product->stock < 1): ?> disabled <?php endif; ?>>+</button>
            </div>
        </div>
        <button type="button" class="btn btn-tenant w-100 py-2 add-to-cart-btn" <?php if($product->stock < 1): ?> disabled <?php endif; ?>
                data-product-id="<?php echo e($product->id); ?>">
            <i class="fas fa-shopping-cart"></i> Agregar al Carrito
        </button>
    </div>
</div><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/shop/components/products/modal-content.blade.php ENDPATH**/ ?>