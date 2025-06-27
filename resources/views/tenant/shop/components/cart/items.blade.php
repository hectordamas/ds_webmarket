@if(Cart::count() < 1)
    <div class="d-flex justify-content-center align-items-center flex-column text-center py-5">
        <dotlottie-player
            src="{{ asset('assets/img/cart-empty.lottie') }}"
            background="transparent"
            speed="1"
            style="width: 200px;"
            loop
            autoplay
        ></dotlottie-player>                     
        <h6 class="text-muted">Tu carrito está vacío</h6>
        <p class="text-muted small">¡Explora nuestro catálogo y agrega tus productos favoritos!</p>
    </div>
@else
<div id="cartItems">
    @foreach(Cart::content() as $cartItem)
    <div class="d-flex align-items-center border-bottom py-2">
        <img src="{{ asset($cartItem->options->image ?? 'assets/img/product-default.png') }}" alt="{{ $cartItem->name }}" class="rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
        <div class="flex-grow-1">
            <strong>{{ $cartItem->name }}</strong>
            <small class="text-muted">x{{ $cartItem->qty }}</small>
            <ul class="list-unstyled small mt-2 mb-0">
                @foreach($cartItem->options->extras as $group => $opts)
                    <li class="mb-1">
                        <span class="text-dark fw-semibold">{{ $group }}:</span><br>
                        <span class="text-muted">– {{ implode('<br>– ', $opts) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="text-end">
            <span class="text-tenant fw-bold">${{ number_format($cartItem->price * $cartItem->qty, 2) }}</span><br>
            <a href="javascript:void(0);" 
               class="text-danger small remove-from-cart" 
               data-rowid="{{ $cartItem->rowId }}">
               <i class="far fa-trash-alt"></i> Eliminar
            </a>        
        </div>
    </div>
    @endforeach
</div>
<div class="mt-4">
    <h5>Total: $<span id="cartTotal">{{ Cart::subtotal() }}</span></h5>
</div>
<div class="mb-2">
    <button class="btn btn-tenant w-100 mb-2" onclick="goToTab('checkout')">
        Siguiente <i class="fas fa-arrow-right ms-2"></i>
    </button>
    <button class="btn btn-dark w-100 mb-3 destroy-cart">
        <i class="fas fa-shopping-cart me-2"></i> Vaciar Carrito
    </button>
</div>
@endif