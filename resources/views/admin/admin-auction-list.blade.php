@extends('layouts.admin-dashboard-layout')

@section('title', '- Admin Dashboard - Listado de subastas')

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
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Subastas</a></li>
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
                    <!-- Auction table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Listado de Subastas</h5>
                            <br>
                            <div class="card-body">
                                <input class="form-control" id="tableSearch" type="text" placeholder="Buscar">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Semana</th>
                                            <th>Propiedad</th>
                                            <th>Cantidad Inscriptos</th>
                                            <th>Cantidad Participantes</th>
                                            <th>Cantidad Pujas</th>
                                            <th>Puja más reciente</th>
                                            <th>Precio Inicial</th>
                                            <th>Plazo inscripción</th>
                                            <th>Comienza</th>
                                            <th>Finaliza</th>
                                            <th>Creada</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($auctions as $a)
                                            <tr>
                                                @if($a->deleted_at <= $a->fin && $a->deleted_at != null)
                                                    <td>Cancelada</td>
                                                @elseif($a->trashed())
                                                    <td>Finalizada</td>
                                                @else
                                                    <td><button class="btn-outline-primary"><i class="fas fa-tools"></i>Administrar</button></td>
                                                @endif
                                                <td><a href="{{ url('auction?id=').$a->id }}">{{ $a->id }}</a></td>
                                                <td><a href={{ url('week?id=').$a->week->id }}>ID: {{ $a->week->id }} "{{ $a->week->fecha }}"</a></td>
                                                <td><a href={{ url('property?id=').$a->week->property->id }}>ID: {{ $a->week->property->id }} "{{ $a->week->property->nombre }}"</a></td>
                                                <td>{{ $a->inscriptions->count() }}</td>
                                                <td>{{ $a->uniqueBidders($a->id) }}</td>
                                                <td>{{ $a->bids->count() }}</td>
                                                @if($a->latestBid)
                                                    <td>${{ $a->latestBid->monto }}</td>
                                                @else
                                                    <td>SIN PUJAS</td>
                                                @endif
                                                <td>{{ $a->precio_inicial }}</td>
                                                <td>{{ $a->inscripcion_inicio }} -- {{ $a->inscripcion_fin }}</td>
                                                <td>{{ $a->inicio }}</td>
                                                <td>{{ $a->fin }}</td>
                                                <td>{{ $a->created_at }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Semana</th>
                                            <th>Propiedad</th>
                                            <th>Cantidad Inscriptos</th>
                                            <th>Cantidad Participantes</th>
                                            <th>Cantidad Pujas</th>
                                            <th>Puja más reciente</th>
                                            <th>Precio Inicial</th>
                                            <th>Plazo inscripción</th>
                                            <th>Comienza</th>
                                            <th>Finaliza</th>
                                            <th>Creada</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end Auction table  -->
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