@extends('layouts.mainlayout')

@section('title', '- Propiedades')

@section('content')
    <!--/ Intro Single star /-->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">Nuestras propiedades</h1>
                        <span class="color-text-a">Ordenalas según tu preferencia</span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href={{ url('/') }}>Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Propiedades
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--/ Intro Single End /-->

    <!--/ Property Grid Start /-->
    <section class="property-grid grid">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="grid-option">
                        <form>
                            <select class="custom-select">
                                <option selected>Sin orden</option>
                                <option selected>Nombre</option>
                                <option selected>Precio</option>
                            </select>
                        </form>
                    </div>
                </div>
                @foreach($properties as $p)
                    <div class="col-md-4">
                        <div class="card-box-a card-shadow">
                            <div class="img-box-a">
                                <img src="img/property-1.jpg" alt="" class="img-a img-fluid">
                            </div>
                            <div class="card-overlay">
                                <div class="price-box d-flex float-right">
                                    @for ($i = 1; $i <= $p->estrellas; $i++)
                                        <span><i class="far fa-star fa-2x fa-fw star"></i></span>
                                    @endfor
                                </div>
                                <div class="card-overlay-a-content">
                                    <div class="card-header-a">
                                        <h2 class="card-title-a">
                                            <a href="#"> {{$p->localidad}},
                                                <br /> {{$p->provincia}},
                                                <br /> {{$p->pais}}</a>
                                        </h2>
                                    </div>
                                    <div class="card-body-a">
                                        <div class="price-box d-flex">
                                            <span class="alert-info">0 inscripciones</span>
                                        </div>
                                        <div class="price-box d-flex">
                                            <span class="alert-info">0 subastas</span>
                                        </div>
                                        <a href={{ url('property?id=').$p->id }} class="link-a"> Ver info y semanas</a>
                                        <span class="ion-ios-arrow-forward"></span>
                                    </div>
                                    <div class="card-footer-a">
                                        <ul class="card-info d-flex justify-content-around">
                                            <li>
                                                <h4 class="card-info-title">Capacidad</h4>
                                                <span>{{$p->capacidad}}</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">Habitaciones</h4>
                                                <span>{{$p->habitaciones}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <nav class="pagination-a">
                        {{ $properties->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--/ Property Grid Start /-->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <div id="preloader"></div>
@endsection