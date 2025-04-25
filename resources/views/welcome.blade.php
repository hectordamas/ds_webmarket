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
                    <div class="card border-0">
                        <div class="card-body shadow">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="categories-container d-flex gap-2">
                                    @foreach ($categories as $item)
                                        <a class="btn btn-outline-dark fw-semibold text-uppercase rounded-pill px-3 py-2"
                                           style="font-size: 0.7rem;">
                                            {{ $item->name }}
                                        </a>
                                    @endforeach
                                </div>
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
                            <div class="card mb-3 shadow border-0" style="height: 90%;">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-8">
                                            <h6 class="fw-bold">{{ $product->name }}</h6>
                                            <p class="text-muted" style="font-size: 12px;">
                                                {{ Str::limit('Lorem ipsum dolor sit amet consectetur adipisicing elit. A delectus quidem tempora laudantium neque deserunt...', 150) }}
                                            </p>
                                            <div>
                                                <a href="{{ $product->whatsapp }}" class="btn btn-success">
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

<!-- Botón flotante del carrito -->
<a href="{{ url('cart.index') }}" class="btn btn-success position-fixed d-flex align-items-center justify-content-between shadow"
   style="bottom: 20px; right: 20px; z-index: 9999; padding: 20px 20px; font-weight: 600; width: 300px;">
    <i class="fas fa-shopping-cart me-2"></i> 
    <span>Su Pedido: ${{ number_format($cartTotal ?? 0, 2, '.', ',') }}</span>
</a>
@endsection