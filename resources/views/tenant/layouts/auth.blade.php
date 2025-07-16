<!DOCTYPE html>
<html lang="en">

<head>
    @yield('metadata')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="#">
    <meta name="keywords"
        content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
	<!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon"> 
	
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
	
	<!-- Required Framework -->
	<link rel="stylesheet" href="{{ asset('files/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
	
	<!-- Themify Icons -->
	<link rel="stylesheet" href="{{ asset('files/assets/icon/themify-icons/themify-icons.css') }}">
	
	<!-- Icofont -->
	<link rel="stylesheet" href="{{ asset('files/assets/icon/icofont/css/icofont.css') }}">
	
	<!-- Custom Style -->
	<link rel="stylesheet" href="{{ asset('files/assets/css/style.css') }}">

</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login-block">
        <!-- Container-fluid starts -->
			@yield('content')
        <!-- end of container-fluid -->
    </section>

	<script src="{{ asset('files/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('files/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('files/bower_components/popper.js/dist/umd/popper.min.js') }}"></script>
	<script src="{{ asset('files/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

	<!-- jquery slimscroll js -->
	<script src="{{ asset('files/bower_components/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

	<!-- modernizr js -->
	<script src="{{ asset('files/bower_components/modernizr/modernizr.js') }}"></script>
	<script src="{{ asset('files/bower_components/modernizr/feature-detects/css-scrollbars.js') }}"></script>

	<!-- i18next -->
	<script src="{{ asset('files/bower_components/i18next/i18next.min.js') }}"></script>
	<script src="{{ asset('files/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js') }}"></script>
	<script src="{{ asset('files/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js') }}"></script>
	<script src="{{ asset('files/bower_components/jquery-i18next/jquery-i18next.min.js') }}"></script>

	<!-- Common JS -->
	<script src="{{ asset('files/assets/js/common-pages.js') }}"></script>

    <script src="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}"></script>

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
</body>

</html>