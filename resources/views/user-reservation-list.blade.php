@extends('layouts.mainlayout-no-footer')

@section('title', '- Mi Cuenta - Reservas')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs//datatables/css/select.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/css/fixedHeader.bootstrap4.css') }}">
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
    @include('layouts.partials.user-sidebar')
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
                            <h3 class="mb-2">Mi Cuenta</h3>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href={{ url('profile') }} class="breadcrumb-link">Acciones</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Historial de actividad</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Reservas</li>
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
                    <!-- inscription table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Listado de Inscripciones</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                        <tr>
                                            <th>Cancelar</th>
                                            <th>Numero</th>
                                            <th>Propiedad</th>
                                            <th>Semana</th>
                                            <th>Obtenida el</th>
                                            <th>Monto</th>
                                            <th>Modo reserva</th>
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
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href={{ url('property?id=').$r->week->property->id }}>{{ $r->week->property->nombre }}</a></td>
                                                <td><a href={{ url('week?id=').$r->week->id }}>{{ $r->week->fecha }} al {{ date('Y-m-d', strtotime($r->week->fecha. ' + 7 days'))}} </a></td>
                                                <td>{{ $r->created_at }}</td>
                                                <td>${{ $r->valor_reservado }}</td>
                                                @if($r->modo_reserva == 0)
                                                    <td><a href={{ url('auction?id=').$r->id }}><i class="fas fa-gavel fa-fw fa-sm"></i> Subasta</a></td>
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
                                            <th>Numero</th>
                                            <th>Propiedad</th>
                                            <th>Semana</th>
                                            <th>Obtenida el</th>
                                            <th>Monto</th>
                                            <th>Modo reserva</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end inscription table  -->
                    <!-- ============================================================== -->
                    @if(session()->has('alert-success'))
                        <div class="alert alert-success" data-expires="5000">
                            <h3>{{ session()->get('alert-success-title') }}</h3>
                            <p class="mt-4">{{ session()->get('alert-success') }}</p>
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
                    <form class="needs-validation" id="cancelReservationForm" action="{{ route('user.cancelReservation') }}" role="form" method="POST">
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
    <script src="{{ asset('js/dashboard.js') }}"></script>

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