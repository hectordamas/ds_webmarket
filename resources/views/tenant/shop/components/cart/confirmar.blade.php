<div class="flex-grow-1 overflow-auto px-2" style="max-height: calc(100vh - 270px);">

    <div class="pt-2">
        <h6 class="fw-bold">Datos del Cliente</h6>
        <hr>
        <div class="mt-3">
            <p class="mb-1"><strong>Nombre:</strong> <span id="summaryNombre">—</span></p>
            <p class="mb-1"><strong>Cédula:</strong> <span id="summaryCedula">—</span></p>
            <p class="mb-1"><strong>Teléfono:</strong> <span id="summaryTelefono">—</span></p>
            <p class="mb-1"><strong>Método de Pago:</strong> <span id="summaryMetodoDePago">—</span></p>
            <p class="mb-1 direccion"><strong>Dirección:</strong> <span id="summaryDireccion">—</span></p>
            <p class="mb-1"><strong>Tipo de Pedido:</strong> <span id="summaryTipoDePedido">—</span></p>
        </div>
    </div>

    <hr>
    <h6 class="fw-bold">Resumen del Pedido</h6>
    <div id="resumen-cart">
        @include('tenant.shop.components.cart.resumen-cart')
    </div>

</div>

<div class="pt-2 px-2">
    <div class="mb-2">
        <a href="#" class="btn btn-tenant w-100" id="enviarWhatsapp">
            <i class="fab fa-whatsapp"></i> Enviar Pedido por WhatsApp
        </a>
    </div>
    <div class="mb-2">
        <button class="btn btn-dark w-100" onclick="goToTab('checkout')">
           <i class="fas fa-arrow-left ms-2"></i> Volver 
        </button>
    </div>
</div>