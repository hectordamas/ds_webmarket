<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('central/assets/img/favicon.png') }}" type="image/x-icon">
        @yield('metadata')

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="{{ asset('central/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="{{ asset('central/assets/css/style.css') }}">

        @yield('styles')

    </head>
    <body>
        <div class="content-wrapper">
            @yield('content')
        </div>
        <script src="{{ asset('central/assets/jquery.js') }}"></script>
        <script src="{{ asset('central/assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
        <script src="{{ asset('central/assets/sweetalert2/sweetalert2.all.min.js') }}"></script>

        @if(session()->has('success'))
        <script>	
            Swal.fire({
                text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "Continuar", 
                confirmButtonColor: '#28a745'
            });
        </script>
        @endif	

        @if(session()->has('error'))
        <script>	
            Swal.fire({
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "Entendido!", 
                confirmButtonColor: '#dc3545'
            });
        </script>
        @endif	

        @foreach($errors->all() as $error)
        <script>	
            Swal.fire({
                text: "{{ $error }}",
                icon: "error",
                confirmButtonText: "Entendido!", 
                confirmButtonColor: '#dc3545'
            });
        </script>
        @endforeach

        @yield('scripts')

    </body>
</html>
