@foreach($notificacionesTenant as $order)
    <li class="px-3 py-2 {{ $order->is_read ? '' : 'bg-light' }}" onclick="window.location.href = '{{ url('orders/ver-detalles/' . $order->id) }}'" >
        <div class="d-flex">
            <div class="flex-shrink-0">
                @if(!$order->is_read)
                    {{-- Punto como reemplazo del avatar --}}
                    <span class="d-inline-block rounded-circle pulse" style="width: 10px; height: 10px; margin-top: 6px; background-color: red;"></span>
                @else
                    {{-- Espacio vacío para mantener alineación 
                    <span class="d-inline-block" style="width: 10px; height: 10px; visibility: hidden;"></span>--}}
                @endif
            </div>
            <div class="flex-grow-1 ms-3">
                <h5 class="notification-user mb-1 {{ $order->is_read ? 'text-dark' : '' }}">{{ $order->nombre }}</h5>
                <p class="notification-msg text-muted mb-1 small">
                    Tienes una nueva orden del cliente: {{ $order->nombre }}
                </p>
                <span class="notification-time text-muted small">{{ $order->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </li>
@endforeach


<style>
@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.5); opacity: 0.5; }
    100% { transform: scale(1); opacity: 1; }
}

span.pulse {
    animation: pulse 1.5s infinite;
}
</style>