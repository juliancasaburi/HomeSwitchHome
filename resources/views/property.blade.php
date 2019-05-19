@extends('layouts.mainlayout')

@section('title', ' - Propiedad '.$property->nombre)

@section('content')
    <!--/ Property Single Start /-->
    <section class="property-single nav-arrow-b">
        <div class="container">
            <div class="col-sm-12 ">
                @if(session()->has('alert-success'))
                    <div class="alert alert-success" data-expires="5000">
                        {{ session()->get('alert-success') }}
                    </div>
                @elseif (session()->has('alert-error'))
                    <div class="alert alert-danger" data-expires="5000">
                        {{ session()->get('alert-error') }}
                    </div>
                @endif
                <div id="property-single-carousel" class="owl-carousel owl-arrow gallery-property">
                    <div class="carousel-item-a">
                        <img src="{{asset($property->image_path)}}" alt="">
                    </div>
                    <div class="carousel-item-a">
                        <img src="{{asset($property->image_path)}}" alt="">
                    </div>
                    <div class="carousel-item-a">
                        <img src="{{asset($property->image_path)}}" alt="">
                    </div>
                </div>
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
                                            <ul class="list">
                                                <li class="d-flex justify-content-between">
                                                    <span>{{ $property->estrellas }}</span>
                                                    @for ($i = 1; $i <= $property->estrellas; $i++)
                                                        <i class="far fa-star fa-xs fa-fw fa-sm text-primary"></i>
                                                        <br>
                                                    @endfor
                                                </li>
                                            </ul>
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
                                    <td>{{ $w->fecha }} hasta {{ date('Y-m-d', strtotime($w->fecha. ' + 7 days'))}}</td>
                                    <td>${{ $w->auction->precio_inicial }}</td>
                                    <td>{{ $w->auction->inscripcion_inicio }} hasta {{ $w->auction->inscripcion_fin }}</td>
                                    @auth
                                        @if($w->auction()->whereHas('inscriptions', function ($query){
                                            $query->where('usuario_id', Auth::user()->id);
                                            })->count() == 0 &&  Auth::user()->creditos > 0)
                                            <td><button class="btn-primary" data-toggle="modal" data-target="#inscriptionModal" data-uid="{{ Auth::user()->id }}" data-auid="{{ $w->auction->id }}" data-wd="{{ $w->fecha }}" data-aup="{{ $w->auction->precio_inicial }}"><i class="fas fa-signature"></i>Inscribirse</button></td>
                                        @elseif(Auth::user()->creditos == 0)
                                            <td><button class="btn-secondary" disabled><i class="fas fa-signature"></i>Sin créditos</button></td>
                                        @else
                                            <td><button class="btn-secondary" disabled><i class="fas fa-signature"></i>Inscripto</button></td>
                                        @endif
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
            </div>
        </div>
        <!-- Modal -->
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