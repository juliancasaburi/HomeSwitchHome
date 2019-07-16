@extends('layouts.admin-dashboard-layout')

@section('title', '- Admin Dashboard - Listado de Hotsale')

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
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">HotSales</a></li>
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

                <!-- ============================================================== -->
                <!-- Alerts  -->
                <!-- ============================================================== -->
                @if(session()->has('alert-success'))
                    <div class="alert alert-success alert-dismissible" data-expires="10000">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ session()->get('alert-success') }}
                    </div>
                @elseif (session()->has('alert-danger'))
                    <div class="alert alert-danger alert-dismissible" data-expires="10000">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ session()->get('alert-danger') }}
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
                <div class="row">
                    <!-- ============================================================== -->
                    <!-- users table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Listado de HotSales</h5>
                            <div class="card-body">
                                <input class="form-control" id="tableSearch" type="text" placeholder="Buscar">
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first" id="table">
                                        <thead>
                                        <tr>
                                            <th>Índice</th>
                                            <th>Propiedad</th>
                                            <th>Semana</th>
                                            <th>Precio</th>
                                            <th>Fecha inicio</th>
                                            <th>Fecha fin</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($hotsale as $h)
                                            <tr>
                                                <td>{{ $loop->index }}</td>
                                                <td><a href="{{ url('property?id=').$h->week->property->id }}">{{$h->week->property->nombre}}</a></td>
                                                <td><a href="{{ url('admin/dashboard/week-info?id=') .$h->week->id}}">{{$h->week->fecha}}</a></td>
                                                <td>{{$h->precio}}</td>
                                                <td>{{ $h->fecha_inicio}}</td>
                                                <td>{{ $h->fecha_fin}}</td>
                                                <th>
                                                    <button class="btn-outline-primary pt-2 pb-2" id="modifyHotsaleButton" data-toggle="modal" data-target="#modifyHotsaleModal" data-hid="{{ $h->id }}" data-hdate="{{ $h->week->fecha }}" data-hpropertyname="{{$h->week->property->nombre}}" data-hfecha_inicio="{{$h->fecha_inicio}}" data-hfecha_fin="{{$h->fecha_fin}}" data-hprecio="{{$h->precio}}">
                                                        <i class="fas fa-tools"></i>Modificar
                                                    </button>
                                                </th>
                                                <th>
                                                    <button class="btn-outline-warning pt-2 pb-2" id="deleteHotsaleButton" data-toggle="modal" data-target="#deleteHotsaleModal" data-hid="{{ $h->id }}" data-hdate="{{ $h->week->fecha }}" data-hpropertyname="{{$h->week->property->nombre}}">
                                                        <i class="fas fa-undo"></i> Quitar de HotSale
                                                    </button>
                                                </th>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Índice</th>
                                            <th>Propiedad</th>
                                            <th>Semana</th>
                                            <th>Precio</th>
                                            <th>Fecha inicio</th>
                                            <th>Fecha fin</th>
                                            <th></th>
                                            <th></th>
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

    <!-- Delete hotsale Modal -->
    <div class="modal fade" id="deleteHotsaleModal" tabindex="-1" role="dialog" aria-labelledby="deleteHotsaleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteHotsaleModalLabel">Desea sacar la semana de hotsale?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="weekPropertyText">aa</p>
                    <p id="weekDateText">aa</p>
                    <form id="deleteHotsaleForm" action="{{ route('admin.deleteHotsale') }}" role="form" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="id" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="button" id="btn-deleteHotsale" class="btn btn-primary" onclick="deleteHotsaleForm_submit()">Quitar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End delete hotsale Modal -->

    <!-- Modify hotsale Modal -->
    <div class="modal fade" id="modifyHotsaleModal" tabindex="-1" role="dialog" aria-labelledby="modifyHotsaleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyHotsaleModalLabel">Modificar HotSale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modifyWeekPropertyText">aa</p>
                    <p id="modifyWeekDateText">aa</p>
                    <form id="modifyHotsaleForm" action="{{ route('admin.modifyHotsale') }}" role="form" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="id" value="">
                        <label for="fecha_inicio">Fecha inicio: </label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"><br>
                        <label for="fecha_fin" style="margin-top: 15px">Fecha fin: </label>
                        <input type="date" class="form-control"  id="fecha_fin" name="fecha_fin"><br>
                        <label for="precio" style="margin-top: 15px">Precio: </label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="button" id="btn-modifyHotsale" class="btn btn-primary" onclick="modifyHotsaleForm_submit()">Modificar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End modify hotsale Modal -->
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

    <script> // Delete Hotsale
        // Fill hotsale id for request
        $('#deleteHotsaleModal').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('hid');
            var date = $(event.relatedTarget).data('hdate');
            var property = $(event.relatedTarget).data('hpropertyname');
            document.getElementById("weekPropertyText").innerHTML = "Propiedad: ".concat(property);
            document.getElementById("weekDateText").innerHTML = "Fecha: ".concat(date);
            $(event.currentTarget).find('input[name="id"]').attr('value',id);
        });

        // Submit form
        function deleteHotsaleForm_submit() {
            $('#deleteHotsaleButton').attr('disabled','disabled');
            $('#deleteHotsaleModal').modal('hide');
            document.getElementById("deleteHotsaleForm").submit();
        }
    </script>

    <script> // Modify Hotsale
        // Fill hotsale id for request
        $('#modifyHotsaleModal').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('hid');
            var date = $(event.relatedTarget).data('hdate');
            var property = $(event.relatedTarget).data('hpropertyname');
            var fecha_inicio = $(event.relatedTarget).data('hfecha_inicio');
            var fecha_fin = $(event.relatedTarget).data('hfecha_fin');
            var precio = $(event.relatedTarget).data('hprecio');
            document.getElementById("modifyWeekPropertyText").innerHTML = "Propiedad: ".concat(property);
            document.getElementById("modifyWeekDateText").innerHTML = "Fecha: ".concat(date);
            document.getElementById("fecha_inicio").value = fecha_inicio;
            document.getElementById("fecha_fin").value = fecha_fin;
            document.getElementById("precio").value = precio;
            $(event.currentTarget).find('input[name="id"]').attr('value',id);
        });

        // Submit form
        function modifyHotsaleForm_submit() {
            $('#modifyHotsaleButton').attr('disabled','disabled');
            $('#modifyHotsaleModal').modal('hide');
            document.getElementById("modifyHotsaleForm").submit();
        }
    </script>

@endsection