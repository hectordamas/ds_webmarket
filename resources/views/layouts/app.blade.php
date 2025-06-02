<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
        @yield('metadata')

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="{{ asset('assets/css/style.css?v=1') }}">

        @yield('styles')

    </head>
    <body>

        <!-- LOADER -->
        <div id="loader" class="loader-overlay">
            <dotlottie-player 
                src="{{ asset('assets/img/loading.lottie') }}" 
                background="transparent" 
                style="max-width: 250px;"
                speed="1" 
                loop 
                autoplay>
            </dotlottie-player>
        </div>

        @yield('content')
        
        <script src="{{ asset('assets/jquery.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

        <script>
            // Función para manejar el sticky de las categorías
            window.onscroll = function() { toggleSticky() };
        
            var categoriesContainer = document.querySelector('.bar-container');
            var stickyOffset = categoriesContainer.offsetTop;
        
            function toggleSticky() {
                if (window.pageYOffset > stickyOffset) {
                    categoriesContainer.classList.add('fixed');
                } else {
                    categoriesContainer.classList.remove('fixed');
                }
            }
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const qtyInput = document.getElementById('modalQuantity');
                const btnDecrease = document.getElementById('decreaseQty');
                const btnIncrease = document.getElementById('increaseQty');
            
                btnDecrease.addEventListener('click', () => {
                    let value = parseInt(qtyInput.value);
                    if (value > 1) qtyInput.value = value - 1;
                });
            
                btnIncrease.addEventListener('click', () => {
                    qtyInput.value = parseInt(qtyInput.value) + 1;
                });
            });
        </script>

        <script>
            function goToTab(tabId) {
                const tabTrigger = new bootstrap.Tab(document.querySelector(`#${tabId}-tab`));
                tabTrigger.show();


                $(`#pedido-tab`).removeClass('text-success').addClass('text-muted');
                $(`#checkout-tab`).removeClass('text-success').addClass('text-muted');
                $(`#confirmar-tab`).removeClass('text-success').addClass('text-muted');

                $(`#${tabId}-tab`).addClass('text-success').removeClass('text-muted');

            }
        </script>

        <script>
            document.getElementById('btnCartManual').addEventListener('click', function () {
                const offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasCart'));
                offcanvas.show();
            });
        </script>

        <script>
            $(document).ready(function () {
                $('.search_trigger').on('click', function () {
                    $('.search_overlay, .search_wrap').addClass('open');
                    $('#search_input').focus();
                });
            
                $('.close-search, .search_overlay').on('click', function () {
                    $('.search_overlay, .search_wrap').removeClass('open');
                });
            
                $(document).on('keydown', function (e) {
                    if (e.key === "Escape") {
                        $('.search_overlay, .search_wrap').removeClass('open');
                    }
                });
            
                // Evita que el clic dentro del form cierre el overlay
                $('.search_wrap form').on('click', function (e) {
                    e.stopPropagation();
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                $('#loader').fadeOut();
            });
        </script>

        @yield('scripts')

    </body>
</html>
