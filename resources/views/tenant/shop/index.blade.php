@extends('tenant.layouts.app')
@section('metadata')
    <title>{{ tenant('id') }} - {{ env('APP_NAME') }}</title>
    @include('tenant.shop.styles')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="row">
                <div class="col-md-12 text-center py-5 mt-2">
                    <img src="{{ asset($settings['logo'] ?? 'assets/img/logo-color.png') }}" alt="" class="logo-main">
                </div>
                <div class="col-md-12 pb-3">
                    <div class="card border-0 bar-container">
                        <div class="card-body shadow">
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Contenedor de categorías con la clase `categories-container` -->
                                <div class="categories-container d-flex gap-2">
                                    @foreach ($categories as $item)
                                        <a href="{{ url('/#' . $item->slug) }}" class="btn btn-outline-dark fw-semibold text-uppercase rounded-pill px-3 py-2 category-btn">
                                            {{ $item->name }}
                                        </a>
                                    @endforeach
                                </div>
                                <!-- Botón de búsqueda -->
                                <div class="position-relative">
                                    <!-- Botón para abrir buscador -->
                                    <a href="javascript:void(0)" class="btn rounded-circle search_trigger btn-search-trigger btn-tenant">
                                        <i class="fas fa-search"></i>
                                    </a>

                                
                                    <!-- Overlay y contenedor del buscador -->
                                    <div class="search_overlay"></div>
                                    <div class="search_wrap">
                                        <span class="close-search"><i class="fas fa-times"></i></span>
                                        <form id="searchForm" onsubmit="return false;">
                                            <input type="text" placeholder="Buscar Producto" class="form-control" id="search_input" autocomplete="off">
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
                    <div class="col-md-12 pt-4 pb-3 category-title" id="{{ $item->slug }}">
                        <h4>{{ $item->name }}</h4>
                    </div>

                    @foreach($item->products as $product)
                    <div class="col-md-6">
                        <div class="card mb-3 shadow border-0 product-card" data-name="{{ $product->name }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 d-flex flex-column justify-content-between">
                                        <h6 class="fw-bold">{{ $product->name }}</h6>
                                        <p class="text-muted" style="font-size: 12px;">
                                            {{ Str::limit($product->description, 150) }}
                                        </p>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <a href="javascript:void(0);" 
                                               class="btn btn-sm btn-tenant show-product-btn"
                                               data-product-id="{{ $product->id }}"
                                               data-bs-toggle="modal" 
                                               data-bs-target="#productModal">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                            <span class="mx-2 price text-tenant">${{ number_format($product->price, 2, '.', ',') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" 
                                            class="show-product-btn"
                                            data-product-id="{{ $product->id }}"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#productModal"
                                            style="cursor:pointer;"
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endforeach

                <div class="col-md-12 no-results d-none text-center text-muted py-3">
                    <em>No se encontraron productos con ese nombre.</em>
                </div>
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
                        &copy; {{ date('Y') }} {{ env('APP_NAME') }}. Todos los derechos reservados.
                    </p>
                </div>
            </footer>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Manejar clic en botón de producto
        $(document).on('click', '.show-product-btn', function() {
            const productId = $(this).data('product-id');
            const modal = $('#productModal');
            // Mostrar spinner mientras carga
            $('#productModalBody').html(`
                <div class="text-center py-5">
                    <div class="spinner-border text-tenant" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
            `);
            
            // Hacer petición AJAX
            $.ajax({
                url: '{{ url("products") }}/' + productId + "/show",
                type: 'GET',
                success: function(response) {
                    if(response.success) {
                        $('#productModalBody').html(response.html);
                    }
                },
                error: function() {
                    $('#productModalBody').html(`
                        <div class="alert alert-danger">
                            Error al cargar el producto. Intente nuevamente.
                        </div>
                    `);
                }
            });
        });

        // Manejar cantidad
        $(document).on('click', '#increaseQty', function() {
            const input = $('#productQuantity');
            input.val(parseInt(input.val()) + 1);
        });
        $(document).on('click', '#decreaseQty', function() {
            const input = $('#productQuantity');
            if(parseInt(input.val()) > 1) {
                input.val(parseInt(input.val()) - 1);
            }
        }); 
    });
</script>

<script>
    // Cerrar modal completamente
    function closeModalCompletely() {
        var $modal = $('#productModal');
        // Ocultar el modal
        $modal.modal('hide');
        // Esperar que termine la animación
        setTimeout(function() {
            // Eliminar el backdrop específico de este modal
            $('.modal-backdrop').remove();
            // Restaurar estilos del body
            $('body').css({
                'overflow': 'auto',
                'padding-right': ''
            });
            // Resetear el estado del modal
            $modal.removeClass('show');
            $modal.css('display', 'none');
        }, 300); // Tiempo igual a la duración de la animación
    }
    
    // Evento al cerrar el modal
    $('#productModal').on('hidden.bs.modal', function() {
        // Limpieza adicional por si acaso
        $('body').removeClass('modal-open');
        $('body').css({
            'overflow': 'auto',
            'padding-right': ''
        });    
        $('#btnCartManual').focus(); // Puede ser un botón en tu header
    });

    //Agregar al Carrito 
    $(document).on('click', '.add-to-cart-btn', function() {
        const productId = $(this).data('product-id');
        const pedido = $('#pedido');
        const btnCartManual = $('#btnCartManual');
        
        const quantity = $('#productQuantity').val();
        const observations = $('#productObservations').val();
        const selectedOptions = {};
        

        // Recopilar opciones seleccionadas
        $('.option-group').each(function () {
            const groupId = $(this).data('group-id');
            const selected = $(`input[name="options[${groupId}]"]:checked, input[name="options[${groupId}][]"]:checked`);
        
            selectedOptions[groupId] = [];
        
            selected.each(function () {
                selectedOptions[groupId].push($(this).val());
            });
        });

        // Enviar al servidor
        $.ajax({
            url: '{{ url("add") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: quantity,
                options: selectedOptions,
                observations: observations
            },
            success: function(response) {

                closeModalCompletely();

                if (response.success) {
                    pedido.html(response.items)
                    btnCartManual.html(response.buttonContent)
                    Swal.fire({
                        icon: 'success',
                        title: '¡Producto agregado!',
                        text: 'Se ha agregado al carrito correctamente.',
                        confirmButtonColor: "{{ $settings['color_primary'] ?? '#198754' }}", // o usa el color del tenant
                        confirmButtonText: 'Seguir comprando'
                    });
                }
                if(response.error){
                    Swal.fire({
                        icon: "error", 
                        text: response.error,
                        confirmButtonColor: "{{ $settings['color_primary'] ?? '#198754' }}",
                        confirmButtonText: "Entendido"
                    });
                }

            },
            error: function(err) {
            }
        });
    });

    $(document).on('click', '.remove-from-cart', function () {
        const rowId = $(this).data('rowid');

        $.ajax({
            url: '{{ url("cart/remove") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                rowId: rowId
            },
            success: function (response) {
                if (response.success) {
                    $('#pedido').html(response.items);
                    $('#btnCartManual').html(response.buttonContent);
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto eliminado',
                        text: 'El producto fue eliminado del carrito.',
                        confirmButtonColor: "{{ $settings['color_primary'] ?? '#198754' }}",
                        confirmButtonText: 'Aceptar'
                    });

                }
            },
            error: function () {
                Swal.fire("Error", "No se pudo eliminar el producto del carrito", "error");
            }
        });
    });

    
    $(document).on('click', '.destroy-cart', function () {
        $.ajax({
            url: '{{ url("cart/destroy") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                if (response.success) {
                    $('#pedido').html(response.items);
                    $('#btnCartManual').html(response.buttonContent);
                    Swal.fire({
                        icon: 'success',
                        text: 'Carrito vaciado con éxito!.',
                        confirmButtonColor: "{{ $settings['color_primary'] ?? '#198754' }}",
                        confirmButtonText: 'Aceptar'
                    });

                }
            },
            error: function () {
                Swal.fire("Error", "No se pudo vaciar el carrito", "error");
            }
        });
    });

    //Search 
    $('#search_input').on('input', function() {
        const query = $(this).val().toLowerCase().trim();
        let matches = 0;

        if(query.length > 0){
            $('.category-title').addClass('d-none');
        }else{
            $('.category-title').removeClass('d-none');
        }

        $('.product-card').each(function() {
            const productName = $(this).data('name').toLowerCase().trim();

            if (productName.includes(query)) {
                $(this).closest('.col-md-6').show();
                matches++;
            } else {
                $(this).closest('.col-md-6').hide();
            }
        });

        if (matches === 0) {
            $('.no-results').removeClass('d-none');
        } else {
            $('.no-results').addClass('d-none');
        }
    });

    // Click en botón de categoría
    $(document).on('click', '.category-btn', function(e) {
        e.preventDefault();

        const rawHref = $(this).attr('href');     // "/#carnes"
        const hash = rawHref.split('#')[1];       // "carnes"
        const targetEl = $('#' + hash);           // ID de la categoría

        // Resetear búsqueda
        $('#search_input').val('');
        $('.product-card').closest('.col-md-6').show();
        $('.category-title').removeClass('d-none');
        $('.no-results').addClass('d-none');

        // Hacer scroll suave a la categoría
        if (targetEl.length) {
            $('html, body').animate({
                scrollTop: targetEl.offset().top - 100
            }, 500);
        }
    });

    //Pickup o Delivery 
    $(document).ready(function () {
        function toggleDireccionFields() {
            const tipo = $('input[name="tipo_pedido"]:checked').val();
            if (tipo === 'pickup') {
                $('#direccionFields').slideUp();
                $('#direccionFields').find('textarea, input').prop('required', false);
            } else {
                $('#direccionFields').slideDown();
                $('#direccionFields').find('textarea[name="direccion"]').prop('required', true);
            }
        }

        // Detectar cambio en el tipo de pedido
        $('input[name="tipo_pedido"]').on('change', toggleDireccionFields);

        // Ejecutar al cargar por si ya está seleccionado "pickup"
        toggleDireccionFields();
    });

</script>

<script>
    $(document).ready(function () {


        $('#btnToConfirmar').on('click', function () {
            const nombre = $('[name="nombre"]').val().trim();
            const cedula = $('[name="cedula"]').val().trim();
            const telefono = $('[name="telefono"]').val().trim();
            const tipoPedido = $('input[name="tipo_pedido"]:checked').val();
            const direccion = $('[name="direccion"]').val().trim();

            let errores = [];

            if (!nombre) errores.push("El nombre es obligatorio.");
            if (!cedula) errores.push("La cédula es obligatoria.");
            if (!telefono) errores.push("El teléfono es obligatorio.");
            if (tipoPedido === 'delivery' && !direccion) errores.push("La dirección es obligatoria para Delivery.");

            if (errores.length > 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos incompletos',
                    html: errores.map(e => `<div>${e}</div>`).join(''),
                    confirmButtonColor: "{{ $settings['color_primary'] ?? '#198754' }}",
                    confirmButtonText: "Entendido"
                });
                return;
            }

            // Si pasa validación, mostrar resumen
            goToTab('confirmar');
        });
    });
</script>
@endsection
