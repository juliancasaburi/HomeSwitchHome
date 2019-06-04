@extends('layouts.mainlayout')

@section('title', ' - Semana '. $week->fecha. ' de Propiedad '.$week->property->nombre)

@section('content')
    <!--/ Property Single Start /-->
    <section class="property-single nav-arrow-b">
        <div class="container">
            <div class="col-sm-12 ">
                <!-- ============================================================== -->
                <!-- Alerts  -->
                <!-- ============================================================== -->
                @if(session()->has('alert-success'))
                    <div class="alert alert-success alert-dismissible" data-expires="10000">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ session()->get('alert-success') }}
                    </div>
                @elseif (session()->has('alert-error'))
                    <div class="alert alert-error alert-dismissible" data-expires="10000">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ session()->get('alert-error') }}
                    </div>
                @endif
                <!-- ============================================================== -->
                <!-- End Alerts  -->
                <!-- ============================================================== -->
                @if($week->property->image_path != null)
                    <div id="property-single-carousel" class="owl-carousel owl-arrow gallery-property">
                        <div class="carousel-item-a">
                            <img src="{{asset($week->property->image_path)}}" alt="" class="img-a img-fluid">
                        </div>
                        <div class="carousel-item-a">
                            <img src="{{asset($week->property->image_path)}}" alt="" class="img-a img-fluid">
                        </div>
                        <div class="carousel-item-a">
                            <img src="{{asset($week->property->image_path)}}" alt="" class="img-a img-fluid">
                        </div>
                    </div>
                @endif
                <div class="row card-header">
                    <h3 class="title-a color-b">{{ $week->property->nombre }} | Semana {{ $week->fecha }}</h3>
                </div>
                <div class="row justify-content-between card-header">
                    <div class="col-md-4 col-lg-4">
                        <div class="property-summary">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="title-box-d section-t4">
                                        <h3 class="title-d">Comodidades</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="summary-list">
                                <ul class="list">
                                    <li class="d-flex justify-content-between">
                                        <strong>Capacidad:</strong>
                                        <span>{{ $week->property->capacidad }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <strong>Habitaciones:</strong>
                                        <span>{{ $week->property->habitaciones }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <strong>Baños:</strong>
                                        <span>{{ $week->property->baños }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <strong>Capacidad Vehiculos:</strong>
                                        <span>{{ $week->property->capacidad_vehiculos }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="property-summary">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="title-box-d section-t4">
                                        <h3 class="title-d">Datos</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="property-description">
                                <div class="summary-list">
                                    <ul class="list">
                                        <li class="d-flex justify-content-between">
                                            <strong>ID:</strong>
                                            <span>{{ $week->property->id }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <strong>Nombre:</strong>
                                            <span>{{ $week->property->nombre }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <strong>Estrellas:</strong>
                                            <ul class="list">
                                                <li class="d-flex justify-content-between">
                                                    <span>{{ $week->property->estrellas }}</span>
                                                    @for ($i = 1; $i <= $week->property->estrellas; $i++)
                                                        <i class="far fa-star fa-xs fa-fw fa-sm text-primary"></i>
                                                        <br>
                                                    @endfor
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <strong>Ubicación:</strong>
                                            <span>{{ $week->property->calle }}, {{ $week->property->numero }}, <br> {{ $week->property->localidad }}, {{ $week->property->provincia }}, {{ $week->property->pais }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="title-box-d section-t4">
                                <h3 class="title-d">Subasta para esta semana</h3>
                            </div>
                            @guest
                                <a href="{{'/register'}}">Registrate o inicia sesión para participar en las subastas</a>
                            @endguest
                        </div>
                    </div>
                    <div class="table-responsive section-t4">
                        <table class="table table-striped table-bordered first">
                            <thead>
                            <tr>
                                <th>Piso</th>
                                <th>Plazo inscripción</th>
                                @auth
                                    <th></th>
                                @endauth
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>${{ $week->auction->precio_inicial }}</td>
                                <td>{{ $week->auction->inscripcion_inicio }} hasta {{ $week->auction->inscripcion_fin }}</td>
                                @auth
                                    @if($week->auction->inscripcion_inicio <= Carbon\Carbon::now() && $week->auction->inscripcion_fin > Carbon\Carbon::now())
                                        @if($week->auction()->whereHas('inscriptions', function ($query){
                                            $query->where('usuario_id', Auth::user()->id);
                                            })->count() == 0 &&  Auth::user()->creditos > 0)
                                            <td><button class="btn-primary" data-toggle="modal" data-target="#inscriptionModal" data-uid="{{ Auth::user()->id }}" data-auid="{{ $week->auction->id }}" data-wd="{{ $week->fecha }}" data-aup="{{ $week->auction->precio_inicial }}"><i class="fas fa-signature"></i>Inscribirse</button></td>
                                        @elseif(Auth::user()->creditos == 0)
                                            <td><button class="btn-secondary" disabled><i class="fas fa-signature"></i>Sin créditos</button></td>
                                        @else
                                            <td><button class="btn-secondary" disabled><i class="fas fa-signature"></i>Inscripto</button></td>
                                        @endif
                                    @else
                                        <td><button class="btn-secondary" disabled><i class="fas fa-signature"></i>Inscripcion finalizada</button></td>
                                    @endif
                                @endauth
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Piso</th>
                                <th>Plazo inscripción</th>
                                @auth
                                    <th></th>
                                @endauth
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="inscriptionModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inscriptionModalLabel">Inscribirse a la subasta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 id="weekDate">Semana:</h3>
                        <h3 id="initialPrice">Precio inicial:</h3>
                        <form class="needs-validation" id="inscriptionForm" action="{{ route('auction.signIn') }}" role="form" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="uid"></label>
                                    <input type="text" name="uid" class="form-control" id="uid" value="" hidden>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="auid"></label>
                                    <input type="text" name="auid" class="form-control" id="auid" value="" hidden>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No inscribir</button>
                        <button type="button" id="submitInscription" class="btn btn-primary" onclick="form_submit()">Inscribir</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Property Single End /-->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <div id="preloader"></div>
@endsection

@section('js')
    <script> // Inscription modal

        // Reset modal input after closing it
        $('#inscriptionModal').on('hidden.bs.modal', function(e)
        {
            $("#inscriptionModal .modal-body input").val("");

            var date = document.getElementById('weekDate');

            // removing everything inside the node
            while (date.firstChild) {
                date.removeChild(date.firstChild);
            }

            // appending new text node
            date.appendChild(document.createTextNode('Semana: '));

            var initialPrice = document.getElementById('initialPrice');

            // removing everything inside the node
            while (initialPrice.firstChild) {
                initialPrice.removeChild(initialPrice.firstChild);
            }

            // appending new text node
            initialPrice.appendChild(document.createTextNode('Precio Inicial: '));
        }) ;

        // Display user data
        $('#inscriptionModal').on('show.bs.modal', function (event) {
            var weekDate = $(event.relatedTarget).data('wd');
            var auctionPrice = $(event.relatedTarget).data('aup');
            var auctionID = $(event.relatedTarget).data('auid');
            var userID = $(event.relatedTarget).data('uid');

            $(event.currentTarget).find('input[name="auid"]').attr('value', auctionID);
            $(event.currentTarget).find('input[name="uid"]').attr('value', userID);

            var date = document.getElementById('weekDate');
            // appending new text node
            date.appendChild(document.createTextNode(weekDate));

            var initialPrice = document.getElementById('initialPrice');
            // appending new text node
            initialPrice.appendChild(document.createTextNode(auctionPrice));
        });

        // Button
        function form_submit() {
            document.getElementById("inscriptionForm").submit();
        }
    </script>
@endsection