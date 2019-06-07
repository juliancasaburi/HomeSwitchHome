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
                    <!-- Property table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Listado de propiedades</h5>
                            <div class="card-body">
                                <input class="form-control" id="tableSearch" type="text" placeholder="Buscar">
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>País</th>
                                            <th>Provincia</th>
                                            <th>Localidad</th>
                                            <th>Calle</th>
                                            <th>Numero</th>
                                            <th>Estrellas</th>
                                            <th>Capacidad</th>
                                            <th>Habitaciones</th>
                                            <th>Baños</th>
                                            <th>Garages</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($properties as $p)
                                            <tr>
                                                <td><button class="btn-primary"  data-toggle="modal" data-target="#adminPropertyModal" data-pid="{{ $p->id }}"><i class="fas fa-tools"></i>Administrar</button></td>
                                                <td>{{ $p->id }}</td>
                                                <td><a href={{ url('property?id=').$p->id }}>{{ $p->nombre}}</a></td>
                                                <td>{{ $p->pais }}</td>
                                                <td>{{ $p->provincia }}</td>
                                                <td>{{ $p->localidad }}</td>
                                                <td>{{ $p->calle }}</td>
                                                <td>{{ $p->numero }}</td>
                                                <td>{{ $p->estrellas }}</td>
                                                <td>{{ $p->capacidad }}</td>
                                                <td>{{ $p->habitaciones }}</td>
                                                <td>{{ $p->baños }}</td>
                                                <td>{{ $p->capacidad_vehiculos }}</td>
                                                <td><button class="btn-primary"><i class="fas fa-tools"></i>Editar</button></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>País</th>
                                            <th>Provincia</th>
                                            <th>Localidad</th>
                                            <th>Calle</th>
                                            <th>Numero</th>
                                            <th>Estrellas</th>
                                            <th>Capacidad</th>
                                            <th>Habitaciones</th>
                                            <th>Baños</th>
                                            <th>Garages</th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end Property table  -->
                    <!-- ============================================================== -->
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->

    <!-- Modal -->
    <div class="modal fade" id="adminPropertyModal" tabindex="-1" role="dialog" aria-labelledby="adminPropertyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="adminPropertyModalLabel">Administrar propiedad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <a id="btn-createweek" class="btn btn-secondary" href="">Crear semana</a>
                    <button type="button" id="btn-createauction" class="btn btn-primary">Crear subasta</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/dashboard.js') }}"></script>

    <script>
        $(document).ready(function(){
            $("#tableSearch").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection