<!-- TAB: Checkout -->
<form id="checkoutForm" class="pt-2">
    <!-- Tipo de Pedido -->
    <div class="mb-4">
        <label class="form-label fw-semibold">Tipo de pedido</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tipo_pedido" value="Delivery" checked>
            <label class="form-check-label">Delivery</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tipo_pedido" value="Pickup">
            <label class="form-check-label">Para llevar o recoger en local</label>
        </div>
    </div>
    <!-- Datos del Cliente -->
    <div class="mb-3">
        <label class="form-label fw-semibold">Cédula de identidad</label>
        <div class="input-group">
            <select name="tipo_documento" class="form-select" style="max-width: 80px;" required>
                <option value="V" selected>V</option>
                <option value="E">E</option>
                <option value="P">P</option>
                <option value="R">R</option>
                <option value="J">J</option>
                <option value="G">G</option>
            </select>
            <input type="tel" class="form-control" name="cedula" placeholder="Ej: 12345678" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Nombre y Apellido</label>
        <input type="text" class="form-control" name="nombre" placeholder="Ingrese su nombre completo" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label fw-semibold">Teléfono</label>
        <div class="input-group">
            <span class="input-group-text">+58</span>
            <input type="tel" class="form-control" name="telefono" placeholder="Ej: 4121234567" required>
        </div>
    </div>
    
    <!-- Dirección -->
    <div id="direccionFields">
        <div class="mb-3">
            <label class="form-label fw-semibold">Dirección completa</label>
            <textarea class="form-control" name="direccion" rows="2" placeholder="Ej: Av. Principal, Edif. 10, Piso 2" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Apartamento, oficina, etc <span class="text-muted small">(opcional)</span></label>
            <input type="text" class="form-control" name="detalle_direccion" placeholder="Ej: Apto. 3B">
        </div>
    </div>

    <!-- Método de pago -->
    <div class="mb-3">
        <label class="form-label fw-semibold">Método de pago</label>
        <select class="form-select" name="metodo_pago" required>
            <option value="" selected disabled>Selecciona un método</option>
            <?php if(isset($payments)): ?>
                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($payment->id); ?>"><?php echo e($payment->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </select>
    </div>

</form>
<div class="mb-2">
    <button type="button" class="btn btn-tenant w-100" id="btnToConfirmar">
        Siguiente <i class="fas fa-arrow-right ms-2"></i>
    </button>
</div>
<div class="mb-2">
    <button class="btn btn-dark w-100" onclick="goToTab('pedido')">
       <i class="fas fa-arrow-left ms-2"></i> Volver 
    </button>
</div>
<?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/shop/components/cart/checkout.blade.php ENDPATH**/ ?>