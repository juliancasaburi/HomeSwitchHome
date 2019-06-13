@extends('layouts.admin-dashboard-layout')

@if(isset($week))
    @section('title', '- Admin Dashboard - Datos de la semana ' . $week->fecha)
@else
    @section('title', '- Admin Dashboard - Semana no disponible')
@endif

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
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Semanas</a></li>
                                        <li class="breadcrumb-item"><a href={{url('admin/dashboard/weeks-list')}} class="breadcrumb-link">Ver todas</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Detalles de la semana</li>
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
                    <!-- week table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            @if(isset($week))
                                <h5 class="card-header">Detalles de la semana: {{ $week->fecha}}</h5>
                            @else
                                <h5 class="card-header">Semana no disponible</h5>
                            @endif
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="singleWeekTable" class="table table-striped table-bordered first">
                                        <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Foto</th>
                                            <th>Propiedad</th>
                                            <th>Estrellas</th>
                                            <th>Provincia</th>
                                            <th>Localidad</th>
                                            <th>Calle</th>
                                            <th>Numero</th>
                                            <th>Creacion</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($week))
                                            <tr>
                                                <td>{{$week->fecha}}</td>
                                                <td>
                                                    @if($week->property->image_path == null)
                                                        <a href="{{ url($propertyURL.$week->property->id) }}"><img src="{{'https://via.placeholder.com/683x1024?text='.$week->property->nombre}}" alt="propertyPhoto" width="250"></a>
                                                    @else
                                                        <a href="{{ url($propertyURL.$week->property->id) }}"><img src="{{ asset($week->property->image_path) }}" alt="propertyPhoto" width="250"></a>
                                                    @endif
                                                </td>
                                                <td><a href="{{ url($propertyURL.$week->property->id) }}">{{$week->property->nombre}}</a></td>
                                                <td>{{$week->property->estrellas}}</td>
                                                <td>{{$week->property->provincia}}</td>
                                                <td>{{$week->property->localidad}}</td>
                                                <td>{{$week->property->calle}}</td>
                                                <td>{{$week->property->numero}}</td>
                                                <td>{{$week->created_at}}</td>
                                                <td><button class="btn-outline-danger pt-2 pb-2" id="deleteWeekButton" data-toggle="modal" data-target="#deleteWeekModal" data-wid="{{ $week->id }}" data-wdate="{{ $week->fecha }}" data-wpropertyname="{{$week->property->nombre}}">
                                                        <i class="fas fa-trash"></i>Eliminar
                                                    </button></td>
                                            </tr>
                                        @endif
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Foto</th>
                                            <th>Propiedad</th>
                                            <th>Estrellas</th>
                                            <th>Provincia</th>
                                            <th>Localidad</th>
                                            <th>Calle</th>
                                            <th>Numero</th>
                                            <th>Creacion</th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end week table  -->
                    <!-- ============================================================== -->
                    <div>
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
                    @endif
                    <!-- ============================================================== -->
                        <!-- End Alerts  -->
                        <!-- ============================================================== -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->

    <!-- Delete week Modal -->
    <div class="modal fade" id="deleteWeekModal" tabindex="-1" role="dialog" aria-labelledby="deleteWeekModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteWeekModalLabel">Desea eliminar la semana?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="weekPropertyText">aa</p>
                    <p id="weekDateText">aa</p>
                    <form id="deleteWeekForm" action="{{ route('admin.deleteWeek') }}" role="form" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="id" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="button" id="btn-createauction" class="btn btn-primary" onclick="deleteWeekForm_submit()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete property Modal -->
@endsection

@section('js')
    <script> // Delete Week
        // Fill week id for request
        $('#deleteWeekModal').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('wid');
            var date = $(event.relatedTarget).data('wdate');
            var property = $(event.relatedTarget).data('wpropertyname');
            document.getElementById("weekPropertyText").innerHTML = "Propiedad: ".concat(property);
            document.getElementById("weekDateText").innerHTML = "Fecha: ".concat(date);
            $(event.currentTarget).find('input[name="id"]').attr('value',id);
        });

        // Submit form
        function deleteWeekForm_submit() {
            $('#deleteWeekButton').attr('disabled','disabled');
            $('#deleteWeekModal').modal('hide');
            document.getElementById("deleteWeekForm").submit();
        }
    </script>
@endsection
