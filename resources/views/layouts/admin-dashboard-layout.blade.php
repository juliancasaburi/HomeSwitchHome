<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Switch Home @yield('title')</title>
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">
    <link href="{{ asset('img/favicon.ico') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{ asset('lib/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style-dashboard.css') }}">
    <link href="{{ asset('lib/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('lib/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/charts/chartist-bundle/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('libcharts/c3charts/c3.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fonts/flag-icon-css/flag-icon.min.css') }}">

    <link href="{{ asset('css/themes.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/widgets.min.css') }}" rel="stylesheet">

    <!-- Additional per-page css -->
    @yield('css')

</head>

{{-- Navbar --}}
@include('layouts.partials.admin-nav')

<body>
<div>
    @yield('content')

</div>

{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script --}}
<!-- JavaScript Libraries -->
<script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('lib/jquery/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('lib/popper/popper.min.js') }}"></script>
<script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- dashboard js -->
<script src="{{ asset('js/dashboard.js') }}"></script>
<!-- slimscroll js -->
<script src="{{ asset('lib/slimscroll/jquery.slimscroll.js') }}"></script>
<!-- sparkline js -->
<script src="{{ asset('lib/charts/sparkline/jquery.sparkline.js') }}"></script>
<!-- morris js -->
<script src="{{ asset('lib/charts/morris-bundle/raphael.min.js') }}"></script>
<script src="{{ asset('lib/charts/morris-bundle/morris.js') }}"></script>
<!-- chart c3 js -->
<script src="{{ asset('lib/charts/c3charts/c3.min.js') }}"></script>
<script src="{{ asset('lib/charts/c3charts/d3-5.4.0.min.js') }}"></script>
<script src="{{ asset('lib/charts/c3charts/C3chartjs.js') }}"></script>
<script src="{{ asset('assets/libs/js/dashboard-ecommerce.js') }}"></script>

<script>
    // Result alert
    $(".alert").fadeTo(10000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });
</script>

<!-- Include per-page JS -->
@yield('js')

</body>
</html>