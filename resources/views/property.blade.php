@extends('layouts.mainlayout')

@section('title', ' - Propiedad '.$property->nombre)
@section('content')
    <!--/ Property Single Start /-->
    @if($property->image_path != null)
        <!--/ Carousel Start /-->
        <div class="intro intro-carousel">
            <div id="carousel" class="owl-carousel owl-theme">
                <div class="carousel-item-a intro-item bg-image" style="background-image: url({{asset($property->image_path)}})">
                    <div class="overlay overlay-a"></div>
                    <div class="intro-content display-table">
                        <div class="table-cell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="intro-body">
                                            <p class="intro-title-top">{{$property->pais}}
                                                <br> {{$property->provincia}} <br> {{$property->localidad}}</p>
                                            <h1 class="intro-title mb-4">
                                                <span class="color-b">{{$property->numero}} </span> {{$property->calle}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Carousel end /-->
    @endif
    <div class="col-sm-12">
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
        <div class="row card-header">
            <h3 class="title-a color-b">{{ $property->nombre }}</h3>
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
                                <span>{{ $property->capacidad }}</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <strong>Habitaciones:</strong>
                                <span>{{ $property->habitaciones }}</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <strong>Baños:</strong>
                                <span>{{ $property->baños }}</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <strong>Capacidad Vehiculos:</strong>
                                <span>{{ $property->capacidad_vehiculos }}</span>
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
                                    <span>{{ $property->id }}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <strong>Nombre:</strong>
                                    <span>{{ $property->nombre }}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <strong>Estrellas:</strong>
                                    <h5 class="stars-text">{{ $property->estrellas }}<i class="fas fa-star fa-fw star"></i></h5>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <strong>Ubicación:</strong>
                                    <span>{{ $property->calle }}, {{ $property->numero }}, <br> {{ $property->localidad }}, {{ $property->provincia }}, {{ $property->pais }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($weeks->count() == 0)
            <div class="row justify-content-between card-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box-d section-t4">
                            <h3 class="title-d">Subastas en período de inscripción para esta propiedad</h3>
                        </div>
                        <h6> No hay subastas en período de inscripción para esta propiedad</h6>
                        @guest
                            <a href="{{'/register'}}">Registrate o inicia sesión para participar en las subastas</a>
                        @endguest
                    </div>
                </div>
            </div>
        @else
            <div class="row justify-content-between card-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box-d section-t4">
                            <h3 class="title-d">Subastas en período de inscripción para esta propiedad</h3>
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
                            <th>Número</th>
                            <th>Estadía</th>
                            <th>Piso</th>
                            <th>Plazo inscripción</th>
                            @auth
                                <th></th>
                            @endauth
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($weeks as $w)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><a href="{{'/week?id='.$w->id}}">{{ $w->fecha }} hasta {{ date('Y-m-d', strtotime($w->fecha. ' + 7 days'))}} <br> Ver semana</a></td>
                                <td>${{ $w->activeAuction->precio_inicial }}</td>
                                <td>{{ $w->activeAuction->inscripcion_inicio }} hasta {{ $w->activeAuction->inscripcion_fin }}</td>
                                @auth
                                    <td>
                                        <div class="row ml-5 justify-content-center">
                                            @if($w->activeAuction()->whereHas('inscriptions', function ($query){
                                                $query->where('usuario_id', Auth::user()->id);
                                                })->count() == 0 &&  Auth::user()->creditos > 0)
                                                <button class="btn-primary" data-toggle="modal" data-target="#inscriptionModal" data-uid="{{ Auth::user()->id }}" data-auid="{{ $w->activeAuction->id }}" data-wd="{{ $w->fecha }}" data-aup="{{ $w->activeAuction->precio_inicial }}"><i class="fas fa-signature"></i>Inscribirse</button>
                                            @elseif(Auth::user()->creditos == 0)
                                                <button class="btn-secondary" disabled><i class="fas fa-signature"></i>Sin créditos</button>
                                            @else
                                                <button class="btn-secondary" disabled><i class="fas fa-signature"></i>Inscripto</button>
                                            @endif
                                        </div>
                                        <div class="row ml-5 mt-5 justify-content-center">
                                            @if(Auth::user()->premium)
                                                @if(Auth::user()->creditos >=1)
                                                    <button class="btn-primary" data-toggle="modal" data-target="#bookingModal" data-wid="{{$w->id}}"><i class="fas fa-ticket-alt"></i>Adjudicar</button>
                                                @else
                                                    <button class="btn-outline-primary" disabled><i class="fas fa-ticket-alt"></i>Adjudicar</button>
                                                    <h6 class="text-danger mt-2">No tienes créditos disponibles</h6>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                @endauth
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Número</th>
                            <th>Estadía</th>
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
        @endif
        @auth
            <div class="row justify-content-between card-header" id="comments">
                <div class="title-box-d section-t4">
                    <h3 class="title-d">Comentarios</h3>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            @include('partials.commentsDisplay', ['comments' => Auth::user()->comments, 'propiedad_id' => $property->id])

                            <hr />
                            <h4>Agregar un comentario</h4>
                            <form method="post" action="{{ route('comments.store'   ) }}">
                                @csrf
                                <div class="form-group">
                                    <textarea placeholder="Comenta algo..." name="texto"></textarea>
                                    <input type="hidden" name="propiedad_id" value="{{ $property->id }}" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-b" value="Comentar    " />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>

    <!-- Inscription Modal -->
    <div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="inscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inscriptionModalLabel">Inscribirse a una subasta</h5>
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
    <!-- End Inscription Modal -->

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Quieres adjudicarte esta semana?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="bookingForm" action="{{ route('week.premiumBooking') }}" role="form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="weekID"></label>
                                <input type="text" name="weekID" class="form-control" id="weekID" value="" hidden>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="submitBooking" class="btn btn-primary" onclick="bookingForm_submit()">Adjudicar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Booking Modal -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
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
            $('#inscriptionModal').modal('hide');
            document.getElementById("inscriptionForm").submit();
        }
    </script>

    <script> // Booking modal

        // Reset modal input after closing it
        $('#bookingModal').on('hidden.bs.modal', function(e)
        {
            $("#bookingModal .modal-body input").val("");

            var weekID = document.getElementById('weekID');

            // removing everything inside the node
            while (date.firstChild) {
                date.removeChild(date.firstChild);
            }
        }) ;

        // Display user data
        $('#bookingModal').on('show.bs.modal', function (event) {
            var weekID = $(event.relatedTarget).data('wid');

            $(event.currentTarget).find('input[name="weekID"]').attr('value', weekID);
        });

        // Button
        function bookingForm_submit() {
            $('#bookingModal').modal('hide');
            document.getElementById("bookingForm").submit();
        }
    </script>
@endsection