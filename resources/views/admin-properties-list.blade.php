@extends('layouts.admin-dashboard-layout')

@section('title', '- Admin Dashboard - Listado de propiedades')

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
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Propiedades</a></li>
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
                            <h5 class="card-header">Listado de propiedades</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>País</th>
                                            <th>Provincia</th>
                                            <th>Localidad</th>
                                            <th>Calle</th>
                                            <th>Numero</th>
                                            <th>Precio</th>
                                            <th>Estrellas</th>
                                            <th>Capacidad</th>
                                            <th>Habitaciones</th>
                                            <th>Baños</th>
                                            <th>Garages</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($properties as $p)
                                            <tr>
                                                <td>{{ $p->nombre}}</td>
                                                <td>{{ $p->pais }}</td>
                                                <td>{{ $p->provincia }}</td>
                                                <td>{{ $p->localidad }}</td>
                                                <td>{{ $p->calle }}</td>
                                                <td>{{ $p->numero }}</td>
                                                <td>{{ $p->precio }}</td>
                                                <td>{{ $p->estrellas }}</td>
                                                <td>{{ $p->capacidad }}</td>
                                                <td>{{ $p->habitaciones }}</td>
                                                <td>{{ $p->baños }}</td>
                                                <td>{{ $p->garages }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>País</th>
                                            <th>Provincia</th>
                                            <th>Localidad</th>
                                            <th>Calle</th>
                                            <th>Numero</th>
                                            <th>Precio</th>
                                            <th>Estrellas</th>
                                            <th>Capacidad</th>
                                            <th>Habitaciones</th>
                                            <th>Baños</th>
                                            <th>Garages</th>
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