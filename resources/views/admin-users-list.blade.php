@extends('layouts.admin-dashboard-layout')

@section('title', '- Admin Dashboard - Listado de Usuarios')

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
                            <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href={{ url('admin/dashboard') }} class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Usuarios</a></li>
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
                    <!-- users table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Listado de Usuarios</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                        <tr>
                                            <th>Nombre y Apellido</th>
                                            <th>Email</th>
                                            <th>Tipo</th>
                                            <th>Pais</th>
                                            <th>Fecha de nacimiento</th>
                                            <th>DNI</th>
                                            <th>Creditos</th>
                                            <th>Saldo</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($users as $u)
                                        <tr>
                                            <td>{{ $u->nombre}} {{$u->apellido}}</td>
                                            <td>{{ $u->email }}</td>
                                            @if($u->premium == 1)
                                                <td><i class="fas fa-ticket-alt"></i>Premium</td>
                                            @else
                                                <td><i class="fas fa-user"></i>Regular</td>
                                            @endif
                                            <td>{{ $u->pais }}</td>
                                            <td>{{ $u->fecha_nacimiento }}</td>
                                            <td>{{ $u->DNI }}</td>
                                            <td>{{ $u->creditos }}</td>
                                            <td>{{ $u->saldo }}</td>
                                        </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Nombre y Apellido</th>
                                            <th>Email</th>
                                            <th>Tipo</th>
                                            <th>Pais</th>
                                            <th>Fecha de nacimiento</th>
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
                    <!-- end users table  -->
                    <!-- ============================================================== -->
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
@endsection

@section('js')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection