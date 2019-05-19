@extends('layouts.mainlayout')

@section('title', ' - Subasta ')

@section('content')
    <!--/ Auction Start /-->
    <section class="auction nav-arrow-b">
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
                <div class="row card-header">
                    <h3 class="title-a color-b">{{ $auction->property->nombre }}</h3>
                </div>
                <div class="row justify-content-between card-header">
                    <div class="col-xl-4">
                        <div class="col-sm-12">
                            <div class="title-box-d section-t4">
                                <h3 class="title-d">Subasta </h3>
                                <h8 class="title-d">De la semana {{ $auction->week->fecha }}</h8>
                                <br>
                            </div>
                            <div class="summary-list">
                                <ul class="list">
                                    <li class="d-flex justify-content-between">
                                        <strong>Duración</strong>
                                        <span>{{ $auction->inicio }} <br> al <br> {{ $auction->fin }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <strong>Precio inicial</strong>
                                        <span>${{ $auction->precio_inicial }}</span>
                                    </li>
                                    @auth
                                        <li class="d-flex justify-content-between">
                                            <strong>Mi última puja:</strong>
                                            <span>$ {{ $myLatestBid->first()->monto }} <br> {{ $myLatestBid->first()->created_at }}</span>
                                        </li>
                                    @endauth
                                    <li class="d-flex justify-content-between">
                                        <strong>Última puja:</strong>
                                        @if($auction->bids->count() == 0)
                                            <span> Nadie participó aún <i class="fas fa-frown"></i></span>
                                        @else
                                            <span>$ {{ $latestBid->monto }} ({{ $latestBid->user->nombre }}) <br> {{ $latestBid->created_at }}</span>
                                        @endif
                                    </li>
                                    @auth
                                        <button class="btn btn-b" data-toggle="modal" data-target="#bidModal" data-uid="{{ Auth::id() }}">Pujar</button>
                                    @endauth
                                    @guest
                                        <a href="{{'/register'}}">Registrate o inicia sesión para participar en las subastas</a>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card-box-d">
                            <div class="card-img-d">
                                <img src="{{asset($auction->property->image_path)}}" alt="" class="img-d img-fluid">
                            </div>
                            <div class="card-overlay card-overlay-hover">
                                <div class="card-header-d section-t4">
                                    <div class="card-title-d align-self-center">
                                        <h3 class="title-d">
                                            Última
                                            <br> Puja
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body-d">
                                    <p class="content-d color-text-a">
                                        {{ $latestBid->user->nombre }}
                                    </p>
                                    <div class="info-agents color-a">
                                        <p>
                                            <strong>Monto: </strong>$ {{ $latestBid->monto }}</p>
                                        <strong>Fecha: </strong> {{ $latestBid->created_at }}</p>
                                    </div>
                                </div>
                                <div class="card-footer-d text-center">
                                    @auth
                                        <button class="btn btn-a" data-toggle="modal" data-target="#bidModal" data-uid="{{ Auth::id() }}">Pujar</button>
                                    @endauth
                                    @guest
                                        <a href="{{'/register'}}">Registrate o inicia sesión para participar en las subastas</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Auction End -->

    <!-- Modal -->
    <div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bidModalLabel">Pujar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" id="bidForm" action="{{ url('auction/bid') }}" role="form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="userID"></label>
                                <input type="text" name="userID" class="form-control" id="userID" value="{{ Auth::id() }}" hidden>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="auctionID"></label>
                                <input type="text" name="auctionID" class="form-control" id="auctionID" value="{{ $auction->id }}" hidden>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="amount">Monto</label>
                                <input type="number" step="0.01" name="amount" class="form-control" id="amount" placeholder="">
                                <div class="valid-feedback">
                                    Válido
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver a la información</button>
                    <button type="button" class="btn btn-primary" onclick="form_submit()">Pujar</button>
                </div>
            </div>
        </div>
    </div>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <div id="preloader"></div>
@endsection

@section('js')
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script> // Edit User

        // Reset modal input after closing it
        $('#bidModal').on('hidden.bs.modal', function(e)
        {
            $("#bidModal .modal-body input").val("")
        }) ;

        // Button
        function form_submit() {
            document.getElementById("bidForm").submit();
        }
    </script>
@endsection