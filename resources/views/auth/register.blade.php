@extends('layouts.login')

{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@section('content')
    <form class="form-signin" action="{{ route('register') }}" method="POST">
        @csrf
        <a class="navbar-brand text-brand" href={{ url('/') }}>Home<span class="color-b">Switch</span>Home</a>
        <h1 class="h3 mb-3 font-weight-normal">Crear una cuenta</h1>
        <label for="inputApellido">Apellido</label>
        <input type="text" name="apellido" id="inputApellido" class="form-control @error('apellido') is-invalid @enderror" placeholder="Apellido" required autofocus>
        @error('apellido')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
        <label for="inputNombre">Nombre</label>
        <input type="text" name="nombre" id="inputNombre" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" required>
        @error('name')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
        <label for="inputNacionalidad">Nacionalidad</label>
        <select class="form-control" name="nacionalidad" id="inputNacionalidad">
            <option value="Argentina">Argentina</option>
            <option value="Otra">Otra</option>
        </select>
        <label for="inputEmail">Email</label>
        <input type="text" name="email" id="inputEmail" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror
        <label for="inputPassword">Password</label>
        <input type="text" name="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" required>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="password-confirm">Confirmar Password</label>
        <input type="text" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Contraseña" required>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="inputFechaNacimiento">Fecha de nacimiento</label>
        <input type="date" class="form-control" name="fecha_nacimiento" id="inputFechaNacimiento" oninput="validarFechaNacimiento()" required>
        <div class="invalid-feedback" id="fechaInvalida"></div>
        <label for="inputDNI">DNI</label>
        <input type="text" name="DNI" id="inputDNI" class="form-control" placeholder="DNI" required>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" id="acceptTOS" onclick="validarRegistro()"> Acepto los términos y condiciones
            </label>
        </div>
        <button class="btn btn-b" type="submit" disabled id="buttonCrear">Crear cuenta</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2019</p>
    </form>
    </body>

    <script src="js/validacionesRegistro.js"></script>
@endsection
