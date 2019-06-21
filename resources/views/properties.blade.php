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
                            @include('partials/propertyItem', ['weeks' => $weeks[$loop->index]])
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