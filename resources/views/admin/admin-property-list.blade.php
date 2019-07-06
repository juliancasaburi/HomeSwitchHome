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
                                            <th>Índice</th>
                                            <th>Editar</th>
                                            <th>Foto</th>
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
                                                <td>{{ $loop->index }}</td>
                                                <td><button class="btn-outline-primary"><i class="fas fa-tools"></i>Editar</button></td>
                                                <td>
                                                    @if($p->image_path == null)
                                                        <a href={{ url($propertyURL.$p->id) }}><img src="{{'https://via.placeholder.com/683x1024?text='.$p->nombre}}" alt="propertyPhoto" width="50"></a>
                                                    @else
                                                        <a href={{ url($propertyURL.$p->id) }}><img src="{{ asset($p->image_path) }}" alt="propertyPhoto" width="50"></a>
                                                    @endif
                                                </td>
                                                <td>{{ $p->id }}</td>
                                                <td><a href={{ url($propertyURL.$p->id) }}>{{ $p->nombre}}</a></td>
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
                                                <td>
                                                    <button class="btn-outline-danger pt-2 pb-2" id="deletePropertyButton" data-toggle="modal" data-target="#deletePropertyModal" data-pid="{{ $p->id }}" data-pname="{{ $p->nombre }}">
                                                        <i class="fas fa-trash"></i>Eliminar
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Índice</th>
                                            <th>Editar</th>
                                            <th>Foto</th>
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
                <!-- ============================================================== -->
                <!-- Alerts  -->
                <!-- ============================================================== -->
                @if(session()->has('alert-success'))
                    <div class="alert alert-success alert-dismissible" data-expires="10000">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ session()->get('alert-success') }}
                    </div>
                @elseif(session()->has('alert-danger'))
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
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->

    <!-- Admin Property Modal -->
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
    <!-- End Admin Property Modal -->

    <!-- Delete property Modal -->
    <div class="modal fade" id="deletePropertyModal" tabindex="-1" role="dialog" aria-labelledby="deletePropertyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePropertyModalLabel">Desea eliminar la propiedad?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="propertyText">aa</h5>
                    <form id="deletePropertyForm" action="{{ route('admin.deleteProperty') }}" role="form" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="id" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="button" id="btn-createauction" class="btn btn-primary" onclick="deletePropertyForm_submit()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete property Modal -->
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

    <script> // Delete Property
        // Fill property id for request
        $('#deletePropertyModal').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('pid');
            var name = $(event.relatedTarget).data('pname');
            document.getElementById("propertyText").innerHTML = name;
            $(event.currentTarget).find('input[name="id"]').attr('value',id);
        });

        // Submit form
        function deletePropertyForm_submit() {
            $('#deletePropertyButton').attr('disabled','disabled');
            $('#deletePropertyModal').modal('hide');
            document.getElementById("deletePropertyForm").submit();
        }
    </script>
@endsection