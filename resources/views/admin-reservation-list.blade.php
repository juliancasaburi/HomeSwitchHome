@extends('layouts.admin-dashboard-layout')

@section('title', '- Admin Dashboard - Listado de reservas')

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
    @include('layouts.partials.admin-sidebar')
    <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Admin Dashboard</h2>
                            <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href={{ url('admin/dashboard') }} class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Reservas</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Ver listado</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- ============================================================== -->
                    <!-- Reservation table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Listado de Reservas</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                        <tr>
                                            <th>Cancelar</th>
                                            <th>ID</th>
                                            <th>Semana ID</th>
                                            <th>Usuario</th>
                                            <th>Propiedad</th>
                                            <th>Fecha</th>
                                            <th>Valor</th>
                                            <th>Modo</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($reservations as $r)
                                            <tr>
                                                @if($r->trashed())
                                                    <td><button class="btn-primary" disabled><i class="fas fa-times-circle text-gray"></i>Cancelada</button></td>
                                                @else
                                                    @if(\Carbon\Carbon::now()->diffInMonths($r->week->fecha) > 0)
                                                        <td><button class="btn-primary" data-toggle="modal" data-target="#cancelReservationModal" data-rid="{{ $r->id }}"><i class="fas fa-times-circle"></i>Cancelar</button></td>
                                                    @else
                                                        <td><button class="btn-primary" disabled><i class="fas fa-times-circle text-gray"></i>Plazo expirado</button></td>
                                                    @endif
                                                @endif
                                                <td>{{ $r->id}}</td>
                                                <td><a href={{ url('week?id=').$r->week->id }}>{{ $r->semana_id }}</a></td>
                                                <td>ID: {{ $r->usuario_id}} <br> {{ $r->user->nombre}} {{ $r->user->apellido}}</td>
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
                                            <th>Cancelar</th>
                                            <th>ID</th>
                                            <th>Semana ID</th>
                                            <th>Usuario</th>
                                            <th>Propiedad</th>
                                            <th>Fecha</th>
                                            <th>Valor</th>
                                            <th>Modo</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end Reservation table  -->
                    <!-- ============================================================== -->
                    @if(session()->has('alert-success'))
                        <div class="alert alert-success" data-expires="5000">
                            {{ session()->get('alert-success') }}
                        </div>
                    @elseif (session()->has('alert-warning'))
                        <div class="alert alert-warning" data-expires="5000">
                            {{ session()->get('alert-warning') }}
                        </div>
                    @elseif ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->

    <!-- Modal -->
    <div class="modal fade" id="cancelReservationModal" tabindex="-1" role="dialog" aria-labelledby="cancelReservationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelReservationModalLabel">Cancelar Reserva</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Deseas cancelar la reserva?</h4>
                    <form class="needs-validation" id="cancelReservationForm" action="{{ route('admin.cancelReservation') }}" role="form" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="reservationID"></label>
                                <input type="text" name="reservationID" class="form-control" id="reservationID" value="" hidden>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Conservar</button>
                    <button type="button" class="btn btn-primary" onclick="form_submit()">Cancelar reserva</button>
                </div>
            </div>
        </div>
    </div>
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

    <script>

        // Display user data
        $('#cancelReservationModal').on('show.bs.modal', function (event) {
            var rID = $(event.relatedTarget).data('rid');
            $(event.currentTarget).find('input[name="reservationID"]').attr('value',rID);
        });


        // Button
        function form_submit() {
            document.getElementById("cancelReservationForm").submit();
        }
    </script>
@endsection
