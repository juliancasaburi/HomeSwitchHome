@extends('layouts.mainlayout')

@section('title', ' - Propiedad '.$property->nombre)

@section('content')
    <!--/ Property Single Start /-->
    <section class="property-single nav-arrow-b">
        <div class="container">
                <div class="col-sm-12 ">
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
                            <div class="property-price d-flex justify-content-center">
                                <div class="card-header-c d-flex">
                                    <div class="card-box-ico">
                                        <span class="ion-money">$</span>
                                    </div>
                                    <div class="card-title-c align-self-center">
                                        <h5 class="title-c">{{ $property->precio }}</h5>
                                    </div>
                                </div>
                            </div>
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
                        <div class="col-md-6 col-lg-6 intro-single">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="title-box-d">
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
        </div>
    </section>
    <!--/ Property Single End /-->


    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <div id="preloader"></div>
@endsection