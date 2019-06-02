@extends('layouts.admin-dashboard-layout')

@section('title', '- Admin Dashboard - Listado de Solicitudes Premium')

@section('css')
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
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href={{ url('admin/dashboard') }} class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Usuarios</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Ver Solicitudes Premium</li>
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
                    <!-- Premium Requests table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Listado de Solicitudes</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                        <tr>
                                            <th>Accion</th>
                                            <th>ID</th>
                                            <th>Fecha Solicitud</th>
                                            <th>Nombre/s</th>
                                            <th>Apellido/s</th>
                                            <th>Email</th>
                                            <th>Pais</th>
                                            <th>Fecha de nacimiento & Edad</th>
                                            <th>DNI</th>
                                            <th>Creditos</th>
                                            <th>Saldo</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($requests as $r)
                                            <tr>
                                                <td>
                                                    <div class="row mb-5">
                                                        <button class="btn-primary pt-2 pb-2" data-toggle="modal" data-target="#acceptRequestModal" data-uid="{{ $r->user->id }}" data-rid="{{ $r->id }}"><i class="fas fa-vote-yea" style="color:lawngreen"></i>Aceptar</button>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <button class="btn-primary pt-2 pb-2" data-toggle="modal" data-target="#rejectRequestModal" data-uid="{{ $r->user->id }}" data-rid="{{ $r->id }}"><i class="fas fa-trash" style="color:red"></i>Rechazar</button>
                                                    </div>
                                                </td>
                                                <td>{{ $r->user->id}}</td>
                                                <td>{{ $r->created_at}}</td>
                                                <td>{{ $r->user->nombre}}</td>
                                                <td>{{ $r->user->apellido }}</td>
                                                <td>{{ $r->user->email }}</td>
                                                <td>{{ $r->user->pais }}</td>
                                                <td>{{ $r->user->fecha_nacimiento }} ({{ $r->user->age}})</td>
                                                <td>{{ $r->user->DNI }}</td>
                                                <td>{{ $r->user->creditos }}</td>
                                                <td>{{ $r->user->saldo }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Accion</th>
                                            <th>ID</th>
                                            <th>Fecha Solicitud</th>
                                            <th>Nombre/s</th>
                                            <th>Apellido/s</th>
                                            <th>Email</th>
                                            <th>Pais</th>
                                            <th>Fecha de nacimiento & Edad</th>
                                            <th>DNI</th>
                                            <th>Creditos</th>
                                            <th>Saldo</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end Premium Requests table  -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- Alerts  -->
                    <!-- ============================================================== -->
                    @if(session()->has('alert-success'))
                        <div class="alert alert-success alert-dismissible" data-expires="10000">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {{ session()->get('alert-success') }}
                        </div>
                    @elseif (session()->has('alert-warning'))
                        <div class="alert alert-warning alert-dismissible" data-expires="10000">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            {{ session()->get('alert-warning') }}
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
    <!-- end main wrapper -->
    <!-- ============================================================== -->

    <!-- Accept Request Modal -->
    <div class="modal fade" id="acceptRequestModal" tabindex="-1" role="dialog" aria-labelledby="acceptRequestLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acceptRequestLabel">Aceptar solicitud</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="acceptRequestForm" action="{{ url('admin/dashboard/premium-request-accept') }}" role="form" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="userID" class="form-control" id="userID" value="" hidden>
                        <input type="text" name="requestID" class="form-control" id="requestID" value="" hidden>
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary" onclick="acceptRequestForm_submit()">Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Accept Request Modal -->

    <!-- Reject Request Modal -->
    <div class="modal fade" id="rejectRequestModal" tabindex="-1" role="dialog" aria-labelledby="rejectRequestLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectRequestLabel">Rechazar solicitud</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="rejectRequestForm" action="{{ url('admin/dashboard/premium-request-reject') }}" role="form" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="text" name="userID" class="form-control" id="userID" value="" hidden>
                        <input type="text" name="requestID" class="form-control" id="requestID" value="" hidden>
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary" onclick="rejectRequestForm_submit()">Continuar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Reject Request Modal -->

@endsection

@section('js')
    <script> // Accept Request
        // Fill (user & request) data for request
        $('#acceptRequestModal').on('show.bs.modal', function (event) {
            var uid = $(event.relatedTarget).data('uid');
            var rid = $(event.relatedTarget).data('rid');
            $(event.currentTarget).find('input[name="userID"]').attr('value',uid);
            $(event.currentTarget).find('input[name="requestID"]').attr('value',rid);
        });

        // Button
        function acceptRequestForm_submit() {
            document.getElementById("acceptRequestForm").submit();
        }
    </script>

    <script> // Reject Request
        // Fill (user & request) data for request
        $('#rejectRequestModal').on('show.bs.modal', function (event) {
            var uid = $(event.relatedTarget).data('uid');
            var rid = $(event.relatedTarget).data('rid');
            $(event.currentTarget).find('input[name="userID"]').attr('value',uid);
            $(event.currentTarget).find('input[name="requestID"]').attr('value',rid);
        });

        // Button
        function rejectRequestForm_submit() {
            document.getElementById("rejectRequestForm").submit();
        }
    </script>
@endsection