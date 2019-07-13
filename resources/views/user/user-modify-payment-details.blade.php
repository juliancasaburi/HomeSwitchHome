@extends('layouts.mainlayout-no-footer')

@section('title', '- Mi Cuenta - Modificar datos de pago')

@section('css')
    <link href="{{ asset('lib/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        @include('layouts.partials.user-sidebar')
        <div class="dashboard-wrapper">
            <div class="dashboard-influence">
                <div class="container-fluid dashboard-content">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h3 class="mb-2">Mi Cuenta</h3>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href={{ url('profile') }} class="breadcrumb-link">Mi Cuenta</a></li>
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Modificar datos</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Modificar datos de pago</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- content  -->
                    <!-- ============================================================== -->
                    <h5>Datos de la Tarjeta actual</h5>
                    <h6 class="text-muted">Marca</h6>
                    <p>{{ Auth::user()->card->marca }}</p>
                    <h6 class="text-muted">Número (Últimos 4 dígitos)</h6>
                    <p>{{ substr(Auth::user()->card->numero, -4)}}</p>
                    <form class="needs-validation" action="{{ route('user.modifyPaymentDetails') }}" role="form" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autofocus>
                            @error('passsword')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputNumeroTarjeta">Numero</label>
                            <input type="text" name="numero_tarjeta" id="inputNumeroTarjeta" class="form-control @error('numero_tarjeta') is-invalid @enderror" placeholder="**** **** **** ****" minlength="16" maxlength="16" required autocomplete="off">
                            @error('numero_tarjeta')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputMarca">Marca</label>
                            <input type="text" name="marca" id="inputMarca" class="form-control @error('marca') is-invalid @enderror" required>
                            @error('marca')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputTitular">Nombre del Titular</label>
                            <input type="text" name="nombre_titular" id="inputTitular" class="form-control @error('nombre_titular') is-invalid @enderror" required>
                            @error('nombre_titular')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputFechaVencimiento">Fecha de Vencimiento</label>
                            <input type="month" name="fecha_vencimiento" id="inputFechaVencimiento" class="form-control @error('fecha_vencimiento') is-invalid @enderror" placeholder="MM/AA" required autocomplete="off">
                            @error('fecha_vencimiento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputCvv">CVV</label>
                            <input type="text" name="cvv" id="inputCvv" class="form-control @error('cvv') is-invalid @enderror" placeholder="123" minlength="3" maxlength="3" required autocomplete="off">
                            @error('cvv')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Modificar</button>
                    </form>
                    <!-- ============================================================== -->
                    <!-- end content  -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- Alerts  -->
                    <!-- ============================================================== -->
                    @if(session()->has('alert-success'))
                        <div class="alert alert-success alert-dismissible" data-expires="10000">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {{ session()->get('alert-success') }}
                        </div>
                    @elseif (session()->has('alert-error'))
                        <div class="alert alert-danger alert-dismissible" data-expires="10000">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {{ session()->get('alert-error') }}
                        </div>
                    @elseif ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                <!-- ============================================================== -->
                    <!-- End Alerts  -->
                    <!-- ============================================================== -->
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
@endsection

@section('js')

    <!-- Optional JavaScript -->
    <!-- dashboard js -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!-- slimscroll js -->
    <script src="{{ asset('lib/slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- morris-chart js -->
    <script src="{{ asset('lib/charts/morris-bundle/raphael.min.js') }}"></script>
    <script src="{{ asset('lib/charts/morris-bundle/morris.js') }}"></script>
    <!-- chart js -->
    <script src="{{ asset('lib/charts/charts-bundle/Chart.bundle.js') }}"></script>
    <script src="{{ asset('lib/charts/charts-bundle/chartjs.js') }}"></script>
    <!-- dashboard js -->
    <script src="{{ asset('lib/charts/charts-bundle/chartjs.js') }}"></script>
@endsection

