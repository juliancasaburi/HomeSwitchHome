<!--/ Nav Start /-->
<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
                aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a class="navbar-brand text-brand" href="/">Home<span class="color-b">Switch</span>Home</a>
        {{-- <a href="/"><img id="logo" src="{{ asset('img/HSH-Complete.svg') }}" alt="" height="20%" width="20%"></a> --}}
        <span data-placement="bottom" data-toggle="tooltip" title="Buscar propiedades">
      <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
              data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="fa fa-search" aria-hidden="true"></span>
      </button>
      </span>
        <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    @guest
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <span class="ion-ios-person"></span>Acceder
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="login">Iniciar Sesión</a>
                            <a class="dropdown-item" href="register">Crear cuenta</a>
                        </div>
                    @endguest
                    @auth
                        <a class="nav-link dropdown-toggle" href = "#" id = "navbarDropdown" role = "button" data-toggle = "dropdown"
                           aria - haspopup = "true" aria - expanded = "false" >
                            <span class="ion-ios-person" ></span > {{ Auth::user()->nombre }}
                        </a >
                        <div class="dropdown-menu" aria - labelledby = "navbarDropdown" >
                            <a class="dropdown-item" href = "perfil" > Mi cuenta </a >
                            <a class="dropdown-item" href = "logout" > Cerrar Sesión </a >
                        </div >
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contacto">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color:orangered;" href="contacto"><span class="fa fa-fire"></span>HOTSALE</a>
                </li>
            </ul>
        </div>
        <span data-placement="bottom" data-toggle="tooltip" title="Buscar propiedades">
      <button type="button" class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block" data-toggle="collapse"
              data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="fa fa-search" aria-hidden="true"></span>
      </button>
        </span>
    </div>
</nav>
<!--/ Nav End /-->