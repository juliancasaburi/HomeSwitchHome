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
                                <option selected>Nombre</option>
                                <option>Sin Orden</option>
                            </select>
                        </form>
                    </div>
                </div>
                @foreach($properties as $p)
                    <div class="col-md-4">
                        <div class="card-box-a card-shadow">
                            <div class="img-box-a">
                                @if($p->image_path == null)
                                    <img src="{{'https://via.placeholder.com/683x1024?text='.$p->nombre}}" alt="" class="img-a img-fluid">
                                @else
                                    <img src="{{asset($p->image_path)}}" alt="" class="img-a img-fluid">
                                @endif
                            </div>
                            <div class="card-overlay">
                                <div class="price-box d-flex float-right">
                                    <div class="price-box d-flex float-right">
                                            <h2 class="stars-text">{{ $p->estrellas }}<i class="fas fa-star fa-fw star"></i></h2>
                                    </div>
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