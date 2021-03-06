@extends('layouts.mainlayout-no-footer')

@section('title', '- Mi Cuenta - Inscripciones a subastas')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style-dashboard.css') }}">
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
                                        <li class="breadcrumb-item active" aria-current="page">Inscripciones a subastas</li>
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
                    <!-- User Inscription table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Listado de Inscripciones</h5>
                            <div class="card-body">
                                <input class="form-control" id="tableSearch" type="text" placeholder="Buscar">
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="table">
                                        <thead>
                                        <tr>
                                            <th>Índice</th>
                                            <th>Numero</th>
                                            <th>Propiedad</th>
                                            <th>Semana</th>
                                            <th>Subasta</th>
                                            <th>Inscripcion realizada</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($inscriptions as $i)
                                            <tr>
                                                <td>{{ $loop->index }}</td>
                                                <td>{{ $i->id }}</td>
                                                <td><a href={{ url($propertyURL.$i->property->id) }}>{{ $i->property->nombre }}</a></td>
                                                <td>{{ $i->auction->week->fecha }} al {{ date('Y-m-d', strtotime($i->auction->week->fecha. ' + 7 days'))}} </td>
                                                <td><a href={{ url($auctionURL.$i->auction->id) }}>Ver subasta</a></td>
                                                <td>{{ $i->created_at }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Índice</th>
                                            <th>Numero</th>
                                            <th>Propiedad</th>
                                            <th>Semana</th>
                                            <th>Subasta</th>
                                            <th>Inscripcion realizada</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end Useer Inscription table  -->
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