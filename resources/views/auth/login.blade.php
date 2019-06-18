@extends('layouts.login')

@section('title', '- Iniciar Sesión')

@section('content')
    <section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center mb-4">
                        <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
                        <p>No tienes una cuenta?<p>
                            <a href={{ url('register') }}>Registrate!</a>
                    </div>
                    <form class="form-signin" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-label-group">
                            <input type="email" name="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required="true" autofocus="">
                            <label for="email">Email</label>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input type="password" name="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" required="true">
                            <label for="inputPassword">Contraseña</label>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-label-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                        <div class="form-label-group">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Olvidaste tu contraseña?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                @if(isset($property))
                    <div class="col-md-4">
                        <h1 class="h3 mb-3 font-weight-normal">Propiedad aleatoria</h1>
                        <div class="card-box-a card-shadow mt-5 mb-5">
                            <div class="img-box-a">
                                @if($property->image_path == null)
                                    <img src="{{'https://via.placeholder.com/683x1024?text='.$property->nombre}}" alt="" class="img-a img-fluid">
                                @else
                                    <img src="{{asset($property->image_path)}}" alt="" class="img-a img-fluid">
                                @endif
                            </div>
                            <div class="card-overlay">
                                <div class="price-box d-flex float-right">
                                    <h2 class="stars-text">{{ $property->estrellas }}<i class="fas fa-star fa-fw star"></i></h2>
                                </div>
                                <div class="card-overlay-a-content">
                                    <div class="card-header-a">
                                        <h2 class="card-title-a">
                                            <a href="{{ url('property?id=').$property->id }}"> {{$property->localidad}},
                                                <br /> {{$property->provincia}},
                                                <br /> {{$property->pais}}</a>
                                        </h2>
                                    </div>
                                    <div class="card-body-a">
                                        <a href={{ url('property?id=').$property->id }} class="link-a"> Ver info y semanas</a>
                                        <span class="ion-ios-arrow-forward"></span>
                                    </div>
                                    <div class="card-footer-a">
                                        <ul class="card-info d-flex justify-content-around">
                                            <li>
                                                <h4 class="card-info-title">Capacidad</h4>
                                                <span>{{$property->capacidad}}</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">Habitaciones</h4>
                                                <span>{{$property->habitaciones}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(isset($week))
                    <div class="col-md-4">
                        <h1 class="h3 mb-3 font-weight-normal">Subasta aleatoria</h1>
                        <div class="card-box-a card-shadow mt-5 mb-5">
                            <div class="img-box-a">
                                @if($week->property->image_path == null)
                                    <img src="{{'https://via.placeholder.com/683x1024?text='.$week->property->nombre}}" alt="" class="img-a img-fluid">
                                @else
                                    <img src="{{asset($week->property->image_path)}}" alt="" class="img-a img-fluid">
                                @endif
                            </div>
                            <div class="card-overlay">
                                <div class="price-box d-flex float-right">
                                    <h2 class="stars-text">{{ $week->property->estrellas }}<i class="fas fa-star fa-fw star"></i></h2>
                                </div>
                                <div class="card-overlay-a-content">
                                    <div class="card-header-a">
                                        <h2 class="card-title-a">
                                            <a href="{{ url('property?id=').$week->property->id }}"> {{$week->property->localidad}},
                                                <br /> {{$week->property->provincia}},
                                                <br /> {{$week->property->pais}}</a>
                                        </h2>
                                    </div>
                                    <div class="card-body-a">
                                        <div class="price-box d-flex">
                                            <span class="alert-info">Subasta en inscripción</span>
                                        </div>
                                        <a href={{ url('week?id=').$week->id }} class="link-a"> Ver semana</a>
                                        <span class="ion-ios-arrow-forward"></span>
                                    </div>
                                    <div class="card-footer-a">
                                        <ul class="card-info d-flex justify-content-around">
                                            <li>
                                                <h4 class="card-info-title">Fecha</h4>
                                                <span>{{$week->fecha}}</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">Precio inicial</h4>
                                                <span>${{$week->auction->precio_inicial}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
