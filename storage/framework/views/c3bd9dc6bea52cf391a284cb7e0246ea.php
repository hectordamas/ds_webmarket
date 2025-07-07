<div class="flex-grow-1 overflow-auto px-2" style="max-height: calc(100vh - 290px);">

    <div class="pt-2">
        <h6 class="fw-bold">Datos del Cliente</h6>
        <hr>
        <div class="mt-3">
            <p class="mb-1"><span class="fw-semibold">Nombre:</span> <span id="summaryNombre">—</span></p>
            <p class="mb-1"><span class="fw-semibold">Cédula:</span> <span id="summaryCedula">—</span></p>
            <p class="mb-1"><span class="fw-semibold">Teléfono:</span> <span id="summaryTelefono">—</span></p>
            <p class="mb-1"><span class="fw-semibold">Método de Pago:</span> <span id="summaryMetodoDePago">—</span></p>
            <p class="mb-1 direccion"><span class="fw-semibold">Dirección:</span> <span id="summaryDireccion">—</span></p>
            <p class="mb-1"><span class="fw-semibold">Tipo de Pedido:</span> <span id="summaryTipoDePedido">—</span></p>
        </div>
    </div>

    <hr>
    <h6 class="fw-bold">Resumen del Pedido</h6>
    <div id="resumen-cart">
        <?php echo $__env->make('tenant.shop.components.cart.resumen-cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

</div>

<div class="pt-2 px-2">
    <div class="mb-2">
        <button id="btnConfirmar" class="btn btn-tenant w-100">
            Confirmar Orden
        </button>

        <!--
        <a href="#" class="btn btn-tenant w-100" id="enviarWhatsapp">
            <i class="fab fa-whatsapp"></i> Enviar Pedido por WhatsApp
        </a>-->
    </div>
    <div class="mb-2">
        <button class="btn btn-dark w-100" onclick="goToTab('checkout')">
           <i class="fas fa-arrow-left ms-2"></i> Volver 
        </button>
    </div>
</div><?php /**PATH C:\laragon\www\dswebmarket\resources\views/tenant/shop/components/cart/confirmar.blade.php ENDPATH**/ ?>