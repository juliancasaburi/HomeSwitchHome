@extends('layouts.mainlayout-no-footer')

@section('title', '- Mi Cuenta')

@section('css')
    <link href="{{ asset('lib/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
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

                    <table class="table table-striped table-bordered first">
                        <thead>
                        <tr>
                            <th>Propiedad</th>
                            <th>Fecha</th>
                            <th>Valor</th>
                            <th>Modo</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($reservations as $r)
                            <tr>
                                <td><a href={{ url('property?id=').$r->week->property->id }}>{{ $r->week->property->nombre}}</a></td>
                                <td>{{ $r->week->fecha}}</td>
                                <td>{{ $r->valor_reservado}}</td>
                                @if($r->modo_reserva == 0)
                                    <td><i class="fas fa-gavel fa-fw fa-sm"></i> Subasta</td>
                                @elseif($r->modo_reserva == 1)
                                    <td><i class="fas fa-ticket-alt fa-fw fa-sm text-success"></i> Reserva Directa (Premium)</td>
                                @else
                                    <td><i class="fas fa-fire fa-fw fa-sm text-hotsale"></i>Hotsale</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Propiedad</th>
                            <th>Fecha</th>
                            <th>Valor</th>
                            <th>Modo</th>
                        </tr>
                        </tfoot>
                    </table>



                    <!-- ============================================================== -->
                    <!-- end content  -->
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
