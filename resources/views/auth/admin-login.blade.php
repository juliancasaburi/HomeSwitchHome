@extends('layouts.login')

@section('title', '- Administrador Iniciar Sesión')

@section('content')
    <section class="login">
        <div class="container">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">Administrador</h1>
                <h2 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h2>
            </div>
            <form class="form-signin" method="POST" action="{{ route('admin.login.submit') }}">
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
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
