{{-- Tracking animación --}}
<div class="text-center mb.4 d-flex justify-content-center">
    <dotlottie-player
        src="{{ asset('assets/img/reloj.lottie') }}"
        background="transparent"
        speed="1"
        style="width: 120px; height: 120px"
        loop
        autoplay>
    </dotlottie-player>
</div>

{{-- Cabecera Pedido --}}
<div class="card shadow-sm mb-3">
    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div>
            <span class="badge bg-success mb-2 mb-md-0">
                {{ $order->tipo_pedido === 'Pickup' ? 'Recoger en local' : 'Delivery' }}
            </span>
            <div class="fw-bold fs-5">
                Pedido #{{ $order->id }}
                <small class="text-muted ms-2">{{ $order->created_at->format('d/m/Y h:i A') }}</small>
            </div>
        </div>
        <div class="text-md-end mt-2 mt-md-0">
            @php
                $statusColors = [
                    'Pendiente'   => 'secondary',
                    'Confirmado'  => 'info',
                    'Enviado'     => 'primary',
                    'Entregado'   => 'success',
                    'Cancelado'   => 'danger',
                ];
                $color = $statusColors[$order->status] ?? 'dark';
            @endphp
            <span class="badge bg-{{ $color }} fs-6">Estatus: {{ $order->status }}</span>
        </div>
    </div>
</div>

<div class="row">
    {{-- Datos del Cliente --}}
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Datos del Cliente</h6>
                <p class="mb-1"><strong>Nombre:</strong> {{ $order->nombre }}</p>
                <p class="mb-1"><strong>Cédula:</strong> {{ $order->cedula }}</p>
                <p class="mb-1"><strong>Teléfono:</strong> +58 {{ $order->telefono }}</p>
                @if($order->direccion)
                    <p class="mb-0"><strong>Dirección:</strong> {{ $order->direccion }}</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Método de Pago --}}
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Método de Pago</h6>
                <p class="mb-1">{{ $order->payment->name }}</p>
                <p class="mb-0"><strong>Nota:</strong> {{ $order->nota ?? '—' }}</p>
            </div>
        </div>
    </div>
</div>


{{-- Productos --}}
<div class="card shadow-sm mb-3">

    <div class="card-body">
        <h6>Productos</h6>
        <hr>
        @foreach ($order->products as $item)
            <div class="pb-2 {{ !$loop->last ? 'mb-3 border-bottom' : '' }}">
                <div class="fw-semibold">
                    {{ $item->product->name }}  x {{ $item->quantity }}
                </div>
                <div class="text-muted small">
                    ${{ number_format($item->unit_price, 2) }} c/u = ${{ number_format($item->subtotal, 2) }}
                </div>

                @if ($item->options->count())
                    <ul class="small text-muted ps-3 mt-1 mb-1">
                        @foreach ($item->options as $opt)
                            <li>{{ $opt->option_group_name }}: {{ $opt->option_name }}</li>
                        @endforeach
                    </ul>
                @endif

                @if ($item->observations)
                    <div class="small"><strong>Nota:</strong> {{ $item->observations }}</div>
                @endif
            </div>
        @endforeach
    </div>
</div>

{{-- Totales --}}
<div class="card shadow-sm mb-3">
    <div class="card-body d-flex justify-content-between align-items-center">
        <span class="fw-bold fs-5">Total:</span>
        <span class="fs-5 text-success fw-bold">$ {{ number_format($order->total, 2) }}</span>
    </div>
</div>

{{-- Footer --}}
<div class="text-center small text-muted mt-5">
    <img src="{{ asset($settings['logo'] ?? 'assets/img/logo-color.png') }}" alt="{{ tenant('nombre_empresa') }} logo" style="width: 140px;">
    <p class="mt-2 mb-0">Soportado por <a href="http://{{ env('CENTRAL_DOMAIN') }}" target="_blank">{{ env('APP_NAME') }}</a></p>
</div>
