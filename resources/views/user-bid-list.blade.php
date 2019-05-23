@extends('layouts.mainlayout-no-footer')

@section('title', '- Mi Cuenta - Mis pujas')

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
                                        <li class="breadcrumb-item active" aria-current="page">Mis pujas</li>
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
                                            <th>Numero</th>
                                            <th>Propiedad</th>
                                            <th>Semana</th>
                                            <th>Subasta</th>
                                            <th>Fecha de la puja</th>
                                            <th>Monto</th>
                                            <th>Estado</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($bids as $b)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href={{ url('property?id=').$b->auction->property->id }}>{{ $b->auction->property->nombre }}</a></td>
                                                <td>{{ $b->auction->week->fecha }} al {{ date('Y-m-d', strtotime($b->auction->week->fecha. ' + 7 days'))}} </td>
                                                <td><a href={{ url('auction?id=').$b->auction->id }}>Ver subasta</a></td>
                                                <td>{{ $b->created_at }}</td>
                                                <td>${{ $b->monto }}</td>
                                                @if($b->auction->latestBid->user->id == Auth::user()->id)
                                                    <td>Ganando</td>
                                                @else
                                                    <td>Perdiendo</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Numero</th>
                                            <th>Propiedad</th>
                                            <th>Semana</th>
                                            <th>Subasta</th>
                                            <th>Fecha de la puja</th>
                                            <th>Monto</th>
                                            <th>Estado</th>
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