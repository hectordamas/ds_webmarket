@extends('layouts.app')
@section('content')

@php
    $categories = collect([
        (object) [
            'name' => 'Hamburguesas',
        ],
        (object) [
            'name' => 'Pizzas',
        ],
        (object) [
            'name' => 'Pastas',
        ],
        (object) [
            'name' => 'Sopa',
        ],
        (object) [
            'name' => 'Snacks',
        ],
        (object) [
            'name' => 'Bebidas',
        ],
    ]);
    
    $products = collect([
        (object)[
            'name' => 'Hamburguesa Clásica',
            'price' => 5.99,
            'category' => 'Hamburguesas',
            'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349?auto=format&fit=crop&w=500&q=80',
            'whatsapp' => 'https://wa.me/584241234567?text=Quiero+una+Hamburguesa+Clásica',
        ],
        (object)[
            'name' => 'Pizza Margarita',
            'price' => 8.50,
            'category' => 'Pizzas',
            'image' => 'https://www.hunts.com/sites/g/files/qyyrlu211/files/uploadedImages/img_6934_48664.jpg',
            'whatsapp' => 'https://wa.me/584241234567?text=Quiero+una+Pizza+Margarita',
        ],
        (object)[
            'name' => 'Pasta Alfredo',
            'price' => 7.25,
            'category' => 'Pastas',
            'image' => 'https://images.unsplash.com/photo-1627308595229-7830a5c91f9f?auto=format&fit=crop&w=500&q=80',
            'whatsapp' => 'https://wa.me/584241234567?text=Quiero+una+Pasta+Alfredo',
        ],
        (object)[
            'name' => 'Sopa de Pollo',
            'price' => 3.75,
            'category' => 'Sopa',
            'image' => 'https://newmansown.com/wp-content/uploads/2023/08/cumin-and-thyme-pumpkin-chicken-soup.jpg',
            'whatsapp' => 'https://wa.me/584241234567?text=Quiero+una+Sopa+de+Pollo',
        ],
    ]);

@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="row">
                <div class="col-md-12 text-center py-5 mt-2">
                    <img src="{{ asset('assets/img/logo-color.png') }}" alt="" style="max-width: 250px; max-height: 200px;">
                </div>
                <div class="col-md-12 pb-3">
                    <div class="card border-0 bar-container">
                        <div class="card-body shadow">
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Contenedor de categorías con la clase `categories-container` -->
                                <div class="categories-container d-flex gap-2">
                                    @foreach ($categories as $item)
                                        <a class="btn btn-outline-dark fw-semibold text-uppercase rounded-pill px-3 py-2"
                                           style="font-size: 0.7rem;">
                                            {{ $item->name }}
                                        </a>
                                    @endforeach
                                </div>
                                <!-- Botón de búsqueda -->
                                <div class="position-relative">
                                    <!-- Botón para abrir buscador -->
                                    <a href="javascript:void(0)" class="btn btn-success rounded-circle search_trigger">
                                        <i class="fas fa-search"></i>
                                    </a>
                                
                                    <!-- Overlay y contenedor del buscador -->
                                    <div class="search_overlay"></div>
                                    <div class="search_wrap">
                                        <span class="close-search"><i class="fas fa-times"></i></span>
                                        <form>
                                            <input type="text" placeholder="Buscar Producto" class="form-control" id="search_input">
                                            <button type="submit" class="search_icon"><i class="fas fa-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($categories as $item)
                <div class="col-md-12 pt-4 pb-3">
                    <h4>{{ $item->name }}</h4>
                </div>

                <div class="col-md-12">

                    <div class="row">

                        @foreach($products as $product)
                        <div class="col-md-6">
                            <div class="card mb-3 shadow border-0" style="height: 90%; position: relative;">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-8 d-flex flex-column justify-content-between">
                                            <h6 class="fw-bold">{{ $product->name }}</h6>
                                            <p class="text-muted" style="font-size: 12px;">
                                                {{ Str::limit('Lorem ipsum dolor sit amet consectetur adipisicing elit. A delectus quidem tempora laudantium neque deserunt...', 150) }}
                                            </p>

                                            <div class="d-flex justify-content-start align-items-center">
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                                <span class="text-success mx-2 price">${{ number_format($product->price, 2, '.', ',') }}</span>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @endforeach

                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 px-0">
            <footer class="bg-dark text-light py-4 mt-5">
                <div class="container text-center">
                    <div class="mb-2">
                        <a href="#" class="text-light mx-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light mx-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light mx-2"><i class="fab fa-whatsapp"></i></a>
                    </div>
                    <p class="mb-0" style="font-size: 14px;">
                        &copy; {{ date('Y') }} TuCatálogoApp. Todos los derechos reservados.
                    </p>
                </div>
            </footer>
        </div>
    </div>
</div>


<!-- Offcanvas del Carrito con pestañas -->
<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasCartLabel">🛒 Carrito de Compras</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column">
        <!-- Navegación de pestañas -->
        <ul class="nav nav-tabs nav-justified mb-3" id="cartTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link disabled active text-success fw-semibold d-flex flex-column align-items-center py-2" id="pedido-tab" data-bs-toggle="tab" data-bs-target="#pedido" type="button" role="tab" aria-controls="pedido" aria-selected="true">
                    <i class="fas fa-shopping-bag mb-1 fs-5"></i>
                    Pedido
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link disabled text-muted fw-semibold d-flex flex-column align-items-center py-2" id="checkout-tab" data-bs-toggle="tab" data-bs-target="#checkout" type="button" role="tab" aria-controls="checkout" aria-selected="false">
                    <i class="fas fa-credit-card mb-1 fs-5"></i>
                    Checkout
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link disabled text-muted fw-semibold d-flex flex-column align-items-center py-2" id="confirmar-tab" data-bs-toggle="tab" data-bs-target="#confirmar" type="button" role="tab" aria-controls="confirmar" aria-selected="false">
                    <i class="fas fa-check-double mb-1 fs-5"></i>
                    Confirmar
                </button>
            </li>
        </ul>


        <!-- Contenido de las pestañas -->
        <div class="tab-content flex-grow-1" id="cartTabsContent">
            <!-- TAB: Pedido -->
            <div class="tab-pane fade show active" id="pedido" role="tabpanel" aria-labelledby="pedido-tab">
                @if(true)
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
                    <!-- Item 1 -->
                    <div class="d-flex align-items-center border-bottom py-2">
                        <img src="https://images.unsplash.com/photo-1550547660-d9450f859349?auto=format&fit=crop&w=100&q=80" alt="Producto" class="rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <strong class="d-block">Hamburguesa Clásica</strong>
                            <small class="text-muted">x2</small>
                        </div>
                        <div class="text-end">
                            <span class="text-success fw-bold">$11.98</span><br>
                            <a href="#" class="text-danger small">Eliminar</a>
                        </div>
                    </div>

                    <div class="d-flex align-items-center border-bottom py-2">
                        <img src="https://images.unsplash.com/photo-1550547660-d9450f859349?auto=format&fit=crop&w=100&q=80" alt="Producto" class="rounded me-3" style="width: 70px; height: 70px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <strong class="d-block">Hamburguesa Clásica</strong>
                            <small class="text-muted">x2</small>
                        </div>
                        <div class="text-end">
                            <span class="text-success fw-bold">$11.98</span><br>
                            <a href="#" class="text-danger small">Eliminar</a>
                        </div>
                    </div>

                </div>
                <div class="mt-4">
                    <h5>Total: $<span id="cartTotal">0.00</span></h5>
                </div>

                <div class="mb-2">
                    <button class="btn btn-success w-100" onclick="goToTab('checkout')">
                        Siguiente <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
                @endif
            </div>

            <!-- TAB: Checkout -->
            <div class="tab-pane fade" id="checkout" role="tabpanel" aria-labelledby="checkout-tab">
                <form id="checkoutForm" class="pt-2">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nombre</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingrese su nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Teléfono</label>
                        <input type="tel" class="form-control" name="telefono" placeholder="+58..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Dirección</label>
                        <textarea class="form-control" name="direccion" rows="2" placeholder="Dirección de entrega" required></textarea>
                    </div>
                </form>
                <div class="mb-2">
                    <button class="btn btn-success w-100" onclick="goToTab('confirmar')">
                        Siguiente <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
                <div class="mb-2">
                    <button class="btn btn-secondary w-100" onclick="goToTab('pedido')">
                       <i class="fas fa-arrow-left ms-2"></i> Volver 
                    </button>
                </div>
            </div>

            <!-- TAB: Confirmar -->
            <div class="tab-pane fade" id="confirmar" role="tabpanel" aria-labelledby="confirmar-tab">
                <div class="pt-2">
                    <h6 class="fw-bold">Resumen del Pedido</h6>
                    <div id="orderSummary">
                        <p class="text-muted">Cargando resumen...</p>
                    </div>

                    <div class="mt-3">
                        <h6 class="fw-bold">Datos del Cliente</h6>
                        <p class="mb-1"><strong>Nombre:</strong> <span id="summaryNombre">—</span></p>
                        <p class="mb-1"><strong>Teléfono:</strong> <span id="summaryTelefono">—</span></p>
                        <p class="mb-1"><strong>Dirección:</strong> <span id="summaryDireccion">—</span></p>
                    </div>

                    <div class="mb-2">
                        <a href="#" class="btn btn-success w-100" id="enviarWhatsapp">
                            <i class="fab fa-whatsapp"></i> Enviar Pedido por WhatsApp
                        </a>
                    </div>
                    <div class="mb-2">
                        <button class="btn btn-secondary w-100" onclick="goToTab('checkout')">
                           <i class="fas fa-arrow-left ms-2"></i> Volver 
                        </button>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

<!-- Botón flotante del carrito -->
<a href="javascript:void(0);" id="btnCartManual"
    class="btn btn-success position-fixed d-flex align-items-center justify-content-between shadow-lg"
   style="bottom: 20px; right: 20px; z-index: 10; padding: 20px 20px; font-weight: 600; width: 300px;">
    <i class="fas fa-shopping-cart me-2"></i> 
    <span>Su Pedido: ${{ number_format($cartTotal ?? 0, 2, '.', ',') }}</span>
</a>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content shadow">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="exampleModalLabel">Detalles del Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="text-center mb-3" style="cursor: pointer;">
            <img src="https://images.unsplash.com/photo-1550547660-d9450f859349?auto=format&fit=crop&w=500&q=80" alt="Producto" style="max-width: 200px; cursor: pointer;" class="img-fluid rounded">
          </div>
          <div class="d-flex justify-content-between">
            <div>
                <h6 class="fw-bold" id="modalProductName">Hamburguesa Clásica</h6>
                <p class="text-muted small" id="modalProductDescription">Jugosa hamburguesa con queso, lechuga y tomate.</p>
            </div>

            <div>
                <h5 class="text-success fw-bold" id="modalProductPrice">$5.99</h5>
            </div>

          </div>
  
          <!-- Ingredientes obligatorios -->
          <h6 class="fw-bold mt-4 mb-2">Ingredientes obligatorios</h6>
          <table class="table table-sm table-striped">
            <tbody>
              <tr>
                <td>Carne</td>
                <td class="text-end"><input type="checkbox" name="ingredientes[]" value="Carne" checked > </td>
              </tr>
              <tr>
                <td>Queso</td>
                <td class="text-end"><input type="checkbox" name="ingredientes[]" value="Queso" checked > </td>
              </tr>
              <tr>
                <td>Lechuga</td>
                <td class="text-end"><input type="checkbox" name="ingredientes[]" value="Lechuga" checked > </td>
              </tr>
              <tr>
                <td>Tomate</td>
                <td class="text-end"><input type="checkbox" name="ingredientes[]" value="Tomate" checked > </td>
              </tr>
            </tbody>
          </table>
  
          <!-- Extras opcionales -->
          <h6 class="fw-bold mt-4 mb-2">Extras opcionales</h6>
          <table class="table table-sm table-striped">
            <tbody>
              <tr>
                <td>Tocineta (+$1.00)</td>
                <td class="text-end"><input type="checkbox" name="extras[]" value="Tocineta" checked disabled> </td>
              </tr>
              <tr>
                <td>Doble Queso (+$1.50)</td>
                <td class="text-end"><input type="checkbox" name="extras[]" value="Doble queso" checked disabled> </td>
              </tr>
              <tr>
                <td>Huevo frito (+$0.75)</td>
                <td class="text-end"><input type="checkbox" name="extras[]" value="Huevo frito" checked disabled> </td>
              </tr>
              <tr>
                <td>Pepinillos (+$0.50)</td>
                <td class="text-end"><input type="checkbox" name="extras[]" value="Pepinillos" checked disabled> </td>
              </tr>
            </tbody>
          </table>

            <div class="mt-4">
                <label for="modalObservations" class="fw-bold mb-2">Observaciones</label>
                <textarea class="form-control" id="modalObservations" rows="2" placeholder="Sin cebolla, bien cocido, etc."></textarea>
            </div>
  
        </div>


        <div class="modal-footer shadow-lg">
            <div class="d-flex w-100 gap-2">
              <div class="w-50">
                <label for="modalQuantity" class="fw-bold mb-2">Cantidad</label>
                <div class="input-group" style="width: 140px;">
                  <button class="btn btn-outline-dark" type="button" id="decreaseQty">−</button>
                  <input type="number" class="form-control text-center" value="1" min="1" id="modalQuantity">
                  <button class="btn btn-outline-dark" type="button" id="increaseQty">+</button>
                </div>
              </div>
              <button type="button" class="btn btn-success w-100 py-2" id="addToCartButton">
                <i class="fas fa-shopping-cart"></i> Agregar al Carrito
              </button>
            </div>
          </div>

      </div>
    </div>
</div>
@endsection