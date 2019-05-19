@extends('layouts.mainlayout')

@section('content')
    <!--/ Carousel Start /-->
    <div class="intro intro-carousel">
        <div id="carousel" class="owl-carousel owl-theme">
            @foreach($properties as $p)
                <div class="carousel-item-a intro-item bg-image" style="background-image: url({{asset($p->image_path)}})">
                    <div class="overlay overlay-a"></div>
                    <div class="intro-content display-table">
                        <div class="table-cell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="intro-body">
                                            <p class="intro-title-top">{{$p->pais}}
                                                <br> {{$p->provincia}} <br> {{$p->localidad}}</p>
                                            <h1 class="intro-title mb-4">
                                                <span class="color-b">{{$p->numero}} </span> {{$p->calle}}</h1>
                                            <p class="intro-subtitle intro-price">
                                                <a href="{{ url('property?id=').$p->id }}"><span class="price-a">Ver más</span></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--/ Carousel end /-->

    <!--/ Services Start /-->
    <section class="section-services section-t8">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                            <h2 class="title-a">Nuestros servicios</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card-box-c foo">
                        <div class="card-header-c d-flex">
                            <div class="card-box-ico">
                                <span class="fas fa-gavel"></span>
                            </div>
                            <div class="card-title-c align-self-center">
                                <h2 class="title-c">SUBASTA</h2>
                            </div>
                        </div>
                        <div class="card-body-c">
                            <p class="content-c">
                                Nulla porttitor accumsan tincidunt. Curabitur aliquet quam id dui posuere blandit. Mauris blandit
                                aliquet elit, eget tincidunt
                                nibh pulvinar a.
                            </p>
                        </div>
                        <div class="card-footer-c">
                            <a href="#" class="link-c link-icon">Ver más
                                <span class="ion-ios-arrow-forward"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-box-c foo">
                        <div class="card-header-c d-flex">
                            <div class="card-box-ico">
                                <span class="fas fa-fire"></span>
                            </div>
                            <div class="card-title-c align-self-center">
                                <h2 class="title-c">HOTSALE</h2>
                            </div>
                        </div>
                        <div class="card-body-c">
                            <p class="content-c">
                                Nulla porttitor accumsan tincidunt. Curabitur aliquet quam id dui posuere blandit. Mauris blandit
                                aliquet elit, eget tincidunt
                                nibh pulvinar a.
                            </p>
                        </div>
                        <div class="card-footer-c">
                            <a href="#" class="link-c link-icon">Ver más
                                <span class="ion-ios-arrow-forward"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-box-c foo">
                        <div class="card-header-c d-flex">
                            <div class="card-box-ico">
                                <span class="fas fa-ticket-alt"></span>
                            </div>
                            <div class="card-title-c align-self-center">
                                <h2 class="title-c">PREMIUM</h2>
                            </div>
                        </div>
                        <div class="card-body-c">
                            <p class="content-c">
                                Nulla porttitor accumsan tincidunt. Curabitur aliquet quam id dui posuere blandit. Mauris blandit
                                aliquet elit, eget tincidunt
                                nibh pulvinar a.
                            </p>
                        </div>
                        <div class="card-footer-c">
                            <a href="#" class="link-c link-icon">Ver más
                                <span class="ion-ios-arrow-forward"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Services End /-->

    <!--/ Property grid Start /-->
    <section class="section-property section-t8">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                            <h2 class="title-a">Últimas propiedades agregadas</h2>
                        </div>
                        <div class="title-link">
                            <a href={{ url('properties') }}>Ver todas
                                <span class="ion-ios-arrow-forward"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="property-carousel" class="owl-carousel owl-theme">
                @foreach($properties as $p)
                    <div class="carousel-item-b">
                        <div class="card-box-a card-shadow">
                            <div class="img-box-a">
                                <img src="{{asset($p->image_path)}}" alt="" class="img-a img-fluid">
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
                                            <a href="{{ url('property?id=').$p->id }}"> {{$p->localidad}},
                                                <br /> {{$p->provincia}},
                                                <br /> {{$p->pais}}</a>
                                        </h2>
                                    </div>
                                    <div class="card-body-a">
                                        <div class="price-box d-flex">
                                            @switch($weeks[$loop->index])
                                                @case(0)
                                                <span class="alert-danger">0 subastas en inscripción</span>
                                                @break
                                                @case(1)
                                                <span class="alert-info">1 subasta en inscripción</span>
                                                @break
                                                @default
                                                <span class="alert-info">{{ $weeks[$loop->index] }} subastas en inscripción</span>
                                                @break
                                            @endswitch
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
        </div>
    </section>
    <!--/ Property grid End /-->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <div id="preloader"></div>
@endsection