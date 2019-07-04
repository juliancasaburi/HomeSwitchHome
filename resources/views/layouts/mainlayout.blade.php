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
    <link href="{{ asset('lib/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/jquery-ui/jquery-ui.theme.css') }}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('css/themes.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/widgets.min.css') }}" rel="stylesheet">

    <!-- Additional per-page css -->
    @yield('css')
</head>

{{-- Navbar --}}
@include('layouts.partials.nav')

<body>
<div>
    <div id="preloader"></div>
    @include('layouts.partials.searchForm')

    @yield('content')

</div>

{{-- Footer --}}
@include('layouts.partials.footer')

{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script --}}
<!-- JavaScript Libraries -->
<script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('lib/jquery/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('lib/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('lib/popper/popper.min.js') }}"></script>
<script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('lib/scrollreveal/scrollreveal.min.js') }}"></script>
<script src="{{ asset('lib/momentjs/moment.min.js') }}"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>

<!-- Template Main Javascript File -->
<script src="{{ asset('js/main.js') }}"></script>

<!-- Include per-page JS -->
@yield('js')

<script>
    new WOW().init();
</script>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    // Result alert
    $(".alert").fadeTo(10000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });
</script>

<script>
    var currentDate = moment().format('YYYY-MM-DD');
    var sixMonths = moment(currentDate).add(6, 'M');
    var fromDate = sixMonths.startOf('isoWeek');
    $('#semanaDesde').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        minDate: fromDate.toDate(),
        dateFormat: "dd-mm-yy",
        onClose: function(selectedDate){
            $('#semanaHasta').prop('disabled', false);
            $('#semanaHasta').datepicker('destroy');
            var formatted = selectedDate.split('-');
            var new_date = formatted[1]+"/"+formatted[0]+"/"+formatted[2];
            $('#semanaHasta').datepicker({
                dateFormat: "dd-mm-yy",
                minDate: (function(){
                    var min = new Date(new_date);
                    var newmin = new Date(new_date);
                    newmin.setDate(min.getDate());
                    return newmin;
                })(),
                maxDate:(function(){
                    var min = new Date(new_date);
                    var newmin = moment(min).add(2, 'M');
                    return newmin.toDate();
                })(),

            });

        }


    });
</script>


</body>
</html>