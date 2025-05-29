<!DOCTYPE html>
<html lang="en" class="h-100">
<head>

    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="MotaAdmin - Bootstrap Admin Dashboard" />
	<meta property="og:title" content="MotaAdmin - Bootstrap Admin Dashboard" />
	<meta property="og:description" content="MotaAdmin - Bootstrap Admin Dashboard" />
	<meta property="og:image" content="https://motaadmin.dexignlab.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
    @yield('metadata')
	
	<!-- FAVICONS ICON -->
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
	
    <link href="{{ asset('authAssets/css/style.css') }} " rel="stylesheet">
	
</head>
<body class="h-100">

    @yield('content')

    <script src="{{ asset('authAssets/vendor/global/global.min.js')}}"></script>
	<script src="{{ asset('authAssets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ asset('authAssets/js/custom.min.js')}}"></script>
    <script src="{{ asset('authAssets/js/deznav-init.js')}}"></script>

</body>

</html>