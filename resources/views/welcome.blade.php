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
                                <div>
                                    <a href="#" class="btn btn-success rounded-circle">
                                        <i class="fas fa-search"></i>
                                    </a>
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
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}">
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


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content shadow">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="exampleModalLabel">Detalle del Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <div class="text-center mb-3">
            <img src="https://images.unsplash.com/photo-1550547660-d9450f859349?auto=format&fit=crop&w=500&q=80" alt="Producto" style="max-width: 200px;" class="img-fluid rounded">
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
          <h6 class="fw-bold mt-4">Ingredientes obligatorios</h6>
          <table class="table table-sm table-bordered table-striped">
            <tbody>
              <tr>
                <td><input type="checkbox" name="ingredientes[]" value="Carne" checked disabled> Carne</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="ingredientes[]" value="Queso" checked> Queso</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="ingredientes[]" value="Lechuga" checked> Lechuga</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="ingredientes[]" value="Tomate" checked> Tomate</td>
              </tr>
            </tbody>
          </table>
  
          <!-- Extras opcionales -->
          <h6 class="fw-bold mt-4">Extras opcionales</h6>
          <table class="table table-sm table-bordered table-striped">
            <tbody>
              <tr>
                <td><input type="checkbox" name="extras[]" value="Tocineta"> Tocineta (+$1.00)</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="extras[]" value="Doble queso"> Doble Queso (+$1.50)</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="extras[]" value="Huevo frito"> Huevo frito (+$0.75)</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="extras[]" value="Pepinillos"> Pepinillos (+$0.50)</td>
              </tr>
            </tbody>
          </table>
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
  




<!-- Botón flotante del carrito -->
<a href="{{ url('cart.index') }}" class="btn btn-success position-fixed d-flex align-items-center justify-content-between shadow"
   style="bottom: 20px; right: 20px; z-index: 10; padding: 20px 20px; font-weight: 600; width: 300px;">
    <i class="fas fa-shopping-cart me-2"></i> 
    <span>Su Pedido: ${{ number_format($cartTotal ?? 0, 2, '.', ',') }}</span>
</a>
@endsection