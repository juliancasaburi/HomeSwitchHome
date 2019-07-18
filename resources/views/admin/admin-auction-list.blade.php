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

                <!-- ============================================================== -->
                <!-- Alerts  -->
                <!-- ============================================================== -->
                @if(session()->has('alert-success'))
                    <div class="alert alert-success alert-dismissible" data-expires="10000">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ session()->get('alert-success') }}
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
                                            <th>Índice</th>
                                            <th>Administrar</th>
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
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($auctions as $a)
                                            <tr>
                                                <td>{{ $loop->index }}</td>
                                                @if($a->wasCancelled())
                                                    <td>Cancelada</td>
                                                @elseif($a->hasFinished())
                                                    <td>Finalizada</td>
                                                @elseif($a->inscripcion_inicio > \Carbon\Carbon::now())
                                                    <td><button class="btn-outline-primary pt-2 pb-2" id="modifyAuctionButton" data-toggle="modal" data-target="#modifyAuctionModal" data-aid="{{ $a->id }}" data-apropertyname="{{$a->week->property->nombre}}" data-adate="{{$a->week->fecha}}" data-aprecio="{{ $a->precio_inical }}" data-ainscriptionb="{{ $a->inscripcion_inicio }}" data-ainscriptione="{{ $a->inscripcion_fin }}" data-abegin="{{ $a->inicio }}" data-aend="{{ $a->fin }}">
                                                    <i class="fas fa-calendar-alt"></i>Modificar</button></td>
                                                @else
                                                    <td>
                                                      <button class="btn-outline-primary disabled"><i class="fas fa-tools"></i>Administrar</button>
                                                    </td>
                                                @endif
                                                <td><a href="{{ url('auction?id=').$a->id }}">{{ $a->id }}</a></td>
                                                <td><a href="{{ url('week?id=').$a->week->id }}">ID: {{ $a->week->id }} "{{ $a->week->fecha }}"</a></td>
                                                <td><a href="{{ url('property?id=').$a->week->property->id }}">ID: {{ $a->week->property->id }} "{{ $a->week->property->nombre }}"</a></td>
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
                                                <td>
                                                    @if($a->isDeletable())
                                                        <button class="btn-outline-danger pt-2 pb-2" id="deleteAuctionButton" data-toggle="modal" data-target="#deleteAuctionModal" data-aid="{{ $a->id }}" data-aname="{{$a->property->nombre}}" data-adate="{{$a->week->fecha}}">
                                                            <i class="fas fa-trash"></i>Eliminar
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Índice</th>
                                            <th>Administrar</th>
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
                                            <th></th>
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

    <!-- Delete auction Modal -->
    <div class="modal fade" id="deleteAuctionModal" tabindex="-1" role="dialog" aria-labelledby="deleteAuctionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAuctionModalLabel">Desea eliminar la subasta?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="propertyText">aa</p>
                    <p id="dateText">aa</p>
                    <form id="deleteAuctionForm" action="{{ route('admin.deleteAuction') }}" role="form" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="id" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    <button type="button" id="btn-deleteauction" class="btn btn-primary" onclick="deleteAuctionForm_submit()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete property Modal -->

    <!-- Modify Auction Modal -->
    <div class="modal fade" id="modifyAuctionModal" tabindex="-1" role="dialog" aria-labelledby="modifyAuctionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyAuctionModalLabel">Modificar Subasta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="modifyPropertyText">aa</p>
                    <p id="modifyWeekText">aa</p>
                    <form id="modifyAuctionForm" action="{{ route('admin.modifyAuction') }}" role="form" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="id" value="">
                        <label for="precio_inicial">Precio inicial: </label>
                        <input type="number" class="form-control" id="precio_inicial" name="precio_inicial" step="0.01"><br>
                        <label for="inicio_inscripcion">Fecha inicio de inscripción: </label>
                        <input type="datetime-local" class="form-control" id="inicio_inscripcion" name="inicio_inscripcion"><br>
                        <label for="fin_inscripcion">Fecha fin de inscripción: </label>
                        <input type="datetime-local" class="form-control" id="fin_inscripcion" name="fin_inscripcion"><br>
                        <label for="inicio">Fecha inicio: </label>
                        <input type="datetime-local" class="form-control" id="inicio" name="inicio"><br>
                        <label for="fin">Fecha fin: </label>
                        <input type="datetime-local" class="form-control" id="fin" name="fin"><br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Descartar cambios</button>
                    <button type="button" class="btn btn-primary" onclick="modifyAuctionForm_submit()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modify Auction Modal -->

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

    <script> // Delete auction
        // Fill property id for request
        $('#deleteAuctionModal').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('aid');
            var name = $(event.relatedTarget).data('aname');
            var fecha = $(event.relatedTarget).data('adate');
            document.getElementById("propertyText").innerHTML = "Propiedad: ".concat(name);
            document.getElementById("dateText").innerHTML = "Fecha: ".concat(fecha);
            $(event.currentTarget).find('input[name="id"]').attr('value',id);
        });

        // Submit form
        function deleteAuctionForm_submit() {
            $('#deleteAuctionButton').attr('disabled','disabled');
            $('#deleteAuctionModal').modal('hide');
            document.getElementById("deleteAuctionForm").submit();
        }
    </script>

    <script> // Modify Auction
        // Fill auction id for request
        $('#modifyAuctionModal').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('aid');
            var property = $(event.relatedTarget).data('apropertyname');
            var date = $(event.relatedTarget).data('adate');
            var precio_inicial = $(event.relatedTarget).data('aprecio');
            var inicio_inscripcion = $(event.relatedTarget).data('ainscriptionb');
            var fin_inscripcion = $(event.relatedTarget).data('ainscriptione');
            var inicio = $(event.relatedTarget).data('abegin');
            var fin = $(event.relatedTarget).data('aend');
            document.getElementById("modifyPropertyText").innerHTML = "Propiedad: ".concat(property);
            document.getElementById("modifyWeekText").innerHTML = "Semana: ".concat(date);
            document.getElementById("precio_inicial").value = precio_inicial;
            document.getElementById("inicio_inscripcion").value = inicio_inscripcion;
            document.getElementById("fin_inscripcion").value = fin_inscripcion;
            document.getElementById("inicio").value = inicio;
            document.getElementById("fin").value = fin;
            $(event.currentTarget).find('input[name="id"]').attr('value',id);
        });

        // Submit form
        function modifyAuctionForm_submit(){
            $('#modifyAuctionButton').attr('disabled','disabled');
            $('#modifyAuctionModal').modal('hide');
            document.getElementById("modifyAuctionForm").submit();
        }
    </script>
@endsection
