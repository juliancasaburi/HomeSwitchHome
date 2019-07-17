@extends('layouts.mainlayout')

@section('title', ' - Semana '. $week->fecha. ' de Propiedad '.$week->property->nombre)

@section('content')
    <!--/ Property Single Start /-->
    @if($week->property->image_path != null)
        <!--/ Carousel Start /-->
        <div class="intro intro-carousel">
            <div id="carousel" class="owl-carousel owl-theme">
                <div class="carousel-item-a intro-item bg-image" style="background-image: url({{asset($week->property->image_path)}})">
                    <div class="overlay overlay-a"></div>
                    <div class="intro-content display-table">
                        <div class="table-cell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="intro-body">
                                            <p class="intro-title-top">{{$week->property->pais}}
                                                <br> {{$week->property->provincia}} <br> {{$week->property->localidad}}</p>
                                            <h1 class="intro-title mb-4">
                                                <span class="color-b">{{$week->property->numero}} </span> {{$week->property->calle}}</h1>
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
                                    <h5 class="stars-text">{{ $week->property->estrellas }}<i class="fas fa-star fa-fw star"></i></h5>
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
        @auth
            <div class="row justify-content-center card-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-box-d section-t4">
                            <h3 class="title-d">Semana en hotsale</h3>
                        </div>
                        <div align="center">
                            <h4 class="text-hotsale">Precio: ${{ $hotsale->precio }}</h4>
                            @if($enabled && (Auth::user()->saldo >= $hotsale->precio) && (Auth::user()->creditos >= 1))
                                <button class="btn-primary fa-3x" data-toggle="modal" data-target="#bookingModal"><i class="fas fa-fire fa-fw fa-sm hotsaleIcon"></i>Adquirir</button>
                            @elseif($enabled && (Auth::user()->saldo < $hotsale->precio))
                                <button class="btn-outline-primary" disabled><i class="fas fa-fire fa-fw fa-sm hotsaleIcon"></i>Adquirir</button>
                                <h6 class="text-danger mt-2">No tienes saldo suficiente</h6>
                            @elseif($enabled && (Auth::user()->creditos == 0))
                                <button class="btn-outline-primary" disabled><i class="fas fa-fire fa-fw fa-sm hotsaleIcon"></i>Adquirir</button>
                                <h6 class="text-danger mt-2">No tienes créditos</h6>
                            @else
                                <button class="btn-outline-primary" disabled><i class="fas fa-fire fa-fw fa-sm hotsaleIcon"></i>Adquirir</button>
                                <h6 class="text-warning mt-2">La semana ya ha sido reservada.</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>
    <!--/ Property Single End /-->

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">Quieres adquirir esta semana?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="bookingForm" action="{{ route('week.hotsaleBooking') }}" role="form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="weekID"></label>
                                <input type="text" name="weekID" class="form-control" id="weekID" value="{{ $week->id }}" hidden>
                                <input type="text" name="valorReservado" class="form-control" id="valorReservado" value="{{ $hotsale->precio }}" hidden>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="submitBooking" class="btn btn-primary" onclick="bookingForm_submit()">Adquirir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Booking Modal -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
@endsection

@section('js')
    <script> // Booking Modal
        // Button
        function bookingForm_submit() {
            $('#bookingModal').modal('hide');
            document.getElementById("bookingForm").submit();
        }
    </script>
@endsection