   {{-- Estado de pedido --}}
    <div class="text-center mb-4 d-flex flex-column align-items-center">
        <dotlottie-player
            src="{{ asset('assets/img/reloj.lottie') }}"
            background="transparent"
            speed="1"
            style="width: 100px;"
            loop
            autoplay
        ></dotlottie-player>   
        <h4 class="mt-3 fw-bold text-warning">Esperando confirmación</h4>
    </div>

    {{-- Cabecera --}}
    <div class="bg-light border p-3 mb-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <span class="badge bg-success">
                {{ $order->tipo_pedido === 'pickup' ? 'Para llevar o recoger en local' : 'Delivery' }}
            </span>
            <div class="fw-bold">
                Pedido: {{ $order->id }} 
                <span class="text-muted small ms-2">{{ $order->created_at->format('d/m/Y - h:i A') }}</span>
            </div>
        </div>
    </div>

    {{-- Cliente --}}
    <div class="mb-3">
        <h6 class="fw-bold">Datos del Cliente</h6>
        <p class="mb-1"><span class="fw-semibold">Nombre:</span> {{ $order->nombre }}</p>
        <p class="mb-1"><span class="fw-semibold">Teléfono:</span> {{ $order->telefono }}</p>
    </div>

    {{-- Productos --}}
    <div class="mb-3">
        <h6 class="fw-bold">Productos</h6>
        @foreach ($order->products as $item)
            <div class="mb-2 border-bottom pb-2">
                <div class="fw-semibold">
                    {{ $item->quantity }} x {{ $item->product->name }}
                </div>
                <div class="text-muted">$ {{ number_format($item->unit_price, 2) }} = $ {{ number_format($item->subtotal, 2) }}</div>

                @if ($item->options->count())
                    <ul class="mb-0 small ps-3 text-muted">
                        @foreach ($item->options as $opt)
                            <li>{{ $opt->option_group_name }}: {{ $opt->option_name }}</li>
                        @endforeach
                    </ul>
                @endif
                @if ($item->observations)
                    <p class="mb-0 small mt-1"><strong>Nota:</strong> {{ $item->observations }}</p>
                @endif
            </div>
        @endforeach
    </div>

    {{-- Totales --}}
    <div class="mb-3">
        <div class="d-flex justify-content-between fw-bold fs-5">
            <span>Total:</span>
            <span>$ {{ number_format($order->total, 2) }}</span>
        </div>
    </div>

    {{-- Método de pago --}}
    <div class="mb-3">
        <p class="mb-1"><strong>Método de pago:</strong> {{ $order->metodo_pago }}</p>
        <p class="mb-0"><strong>Nota:</strong> {{ $order->nota ?? '—' }}</p>
    </div>

    {{-- Footer --}}
    <div class="text-center small text-muted mt-5">
        <img src="{{ asset($settings['logo'] ?? 'assets/img/logo-color.png') }}" alt="{{ tenant('nombre_empresa') }} logo" style="width: 150px;">
        <p class="mt-2 mb-0">Soportado por <a href="http://{{ env('CENTRAL_DOMAIN') }}" target="_blank">{{ env('APP_NAME') }}</a></p>
    </div> 
