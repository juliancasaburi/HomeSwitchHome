@extends('layouts.mainlayout-no-footer')

@section('title', '- Mi Cuenta')

@section('css')
    <link href="{{ asset('lib/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('ib/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
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
                                <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Mi Cuenta</a></li>
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
                    <form method="post" action="{{url('profile/modify-password')}}">
                      {{csrf_field()}}
                      <div class="form-group">
                        <label for="mypassword">Contraseña actual</label>
                        <input type="password" name="mypassword" class="form-control">
                        <div class="text-danger">{{$errors->first('mypassword')}}</div>
                      </div>
                      <div class="form-group">
                        <label for="password">Contraseña nueva</label>
                        <input type="password" name="password" class="form-control">
                        <div class="text-danger">{{$errors->first('password')}}</div>
                      </div>
                      <div class="form-group">
                        <label for="mypassword">Confirmar contraseña nueva</label>
                        <input type="password" name="password_confirmation" class="form-control">
                      </div>
                      <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                    </form>
                    <!-- ============================================================== -->
                    <!-- end content  -->
                    <!-- ============================================================== -->

                    @if (Session::has('message'))
                      <div class="text-danger">
                        {{Session::get('massage')}}
                      </div>
                    @endif
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
    <script src="{{ asset('lib/charts/morris-bundle/morrisjs.html') }}"></script>
    <!-- chart js -->
    <script src="{{ asset('lib/charts/charts-bundle/Chart.bundle.js') }}"></script>
    <script src="{{ asset('lib/charts/charts-bundle/chartjs.js') }}"></script>
    <!-- dashboard js -->
    <script src="{{ asset('lib/charts/charts-bundle/chartjs.js') }}"></script>
@endsection
