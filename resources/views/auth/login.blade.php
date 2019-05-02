@extends('layouts.login')

@section('title', '- Iniciar Sesión')

@section('content')
    <section class="intro-single">
        <div class="container">
            <div class="text-center mb-4">
                <a class="navbar-brand text-brand" href="index.php">Home<span class="color-b">Switch</span>Home</a>
                <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
                <p>No tienes una cuenta?<p>
                    <a href="registro.html">Registrate!</a>
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

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
