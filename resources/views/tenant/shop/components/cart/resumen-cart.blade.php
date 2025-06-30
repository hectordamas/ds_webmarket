@if(Cart::count() > 0)
    <ul class="list-group mb-3">
        @foreach(Cart::content() as $item)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div>
                    <span class="fw-semibold">{{ $item->name }}</span>
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