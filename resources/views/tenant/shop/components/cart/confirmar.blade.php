<div class="flex-grow-1 overflow-auto px-2" style="max-height: calc(100vh - 270px);">

    <div class="pt-2">
        <h6 class="fw-bold">Resumen del Pedido</h6>
        <hr>
        <div class="mt-3">
            <h6>Datos del Cliente</h6>
            <p class="mb-1"><strong>Nombre:</strong> <span id="summaryNombre">—</span></p>
            <p class="mb-1"><strong>Cédula:</strong> <span id="summaryCedula">—</span></p>
            <p class="mb-1"><strong>Teléfono:</strong> <span id="summaryTelefono">—</span></p>
            <p class="mb-1"><strong>Método de Pago:</strong> <span id="summaryMetodoDePago">—</span></p>
            <p class="mb-1 direccion"><strong>Dirección:</strong> <span id="summaryDireccion">—</span></p>
        </div>
    </div>

    <hr>
    @if(Cart::count() > 0)
        <ul class="list-group mb-3">
            @foreach(Cart::content() as $item)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-semibold">{{ $item->name }}</div>
                        <small class="text-muted">x{{ $item->qty }}</small>
                        <ul class="small ps-3 mt-1 mb-0">
                            @foreach($item->options->extras as $group => $opts)
                                <li><strong>{{ $group }}:</strong> {{ implode(', ', $opts) }}</li>
                            @endforeach
                            @if($item->options->observations)
                                <li><em>📝 {{ $item->options->observations }}</em></li>
                            @endif
                        </ul>
                    </div>
                    <span class="fw-bold text-tenant">${{ number_format($item->price * $item->qty, 2) }}</span>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between">
                <strong>Total:</strong>
                <strong class="text-tenant">${{ Cart::subtotal() }}</strong>
            </li>
        </ul>
    @else
        <div class="text-muted text-center">No hay productos en el carrito.</div>
    @endif
</div>

<div class="pt-2">
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