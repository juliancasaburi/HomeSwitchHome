<!-- ============================================================== -->
<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark pt-3">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Menu</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{( url('/profile') )}}"><i class="fa fa-fw fa-user-circle"></i>Mi cuenta - Inicio</a>
                    </li>
                    <li class="nav-divider">
                        Acciones
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fas fa-user-edit"></i>Modificar datos</a>
                        <div id="submenu-1" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/profile/modify-email') }}">Modificar email</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/profile/modify-password')}}">Modificar contraseña</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/profile/modify-payment-details')}}">Modificar datos de pago</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-history"></i>Historial de Actividad</a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/profile/inscription-list')}}">Inscripciones a subastas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/profile/bid-list')}}">Mis pujas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.reservations') }}">Reservas</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#balanceModal"><i class="fas fa-hand-holding-usd"></i>Cargar Saldo</a>
                    </li>
                    @if(!Auth::user()->premium)
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#premiumModal"><i class="fas fa-ticket-alt"></i>Solicitar Premium</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- wrapper  -->
<!-- ============================================================== -->

<!-- Balance Modal -->
<div class="modal fade" id="balanceModal" tabindex="-1" role="dialog" aria-labelledby="balanceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="balanceModalLabel">Cargar saldo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-muted">Tu saldo actual es: {{Auth::user()->saldo}}</h5>
                <form class="needs-validation" id="balanceForm" action="{{ url('add-balance') }}" role="form" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h5>Datos de pago</h5>
                            <label for="inputNumeroTarjeta">Numero de tarjeta</label>
                            <input type="text" name="numero_tarjeta" id="inputNumeroTarjeta" class="form-control" placeholder="{{Auth::user()->numero_tarjeta}}" disabled>
                        <label for="inputfechaCaducidadTarjeta">Fecha de caducidad</label>
                        <input type="month" name="fecha_caducidad_tarjeta" id="inputFechaCaducidadTarjeta" class="form-control @error('fechaCaducidadTarjeta') is-invalid @enderror" placeholder="MM/AA" required autocomplete="off">
                        @error('fechaCaducidadTarjeta')
                        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                        @enderror
                        <label for="inputCvvTarjeta">CVV</label>
                        <input type="text" name="cvv_tarjeta" id="inputCvvTarjeta" class="form-control @error('cvvTarjeta') is-invalid @enderror" placeholder="123" minlength="3" maxlength="3" required autocomplete="off">
                        @error('cvvTarjeta')
                        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                        @enderror
                        <hr class="hr-primary">
                            <label for="amount">Monto</label>
                            <input type="number" name="amount" class="form-control" id="amount">
                            <div class="valid-feedback">
                                Válido
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-primary" onclick="balance_submit()">Cargar</button>
            </div>
        </div>
    </div>
</div>
<!-- End Balance Modal-->

<!-- Request premium Modal -->
<div class="modal fade" id="premiumModal" tabindex="-1" role="dialog" aria-labelledby="premiumModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="premiumModalLabel">Solicitar Membresía Premium</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-muted">Tu saldo actual es: ${{Auth::user()->saldo}}</h5>
                <h5 class="text-muted">Costo Plus Mensual Membresía Premium: ${{$premiumPlusPrice}}</h5>
                <form class="needs-validation" id="premiumForm" action="{{ url('request-premium') }}" role="form" method="POST">
                    @csrf
                    <div class="row">
                        <input type="text" name="userID" id="userID" value="{{Auth::user()->id}}" hidden>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h5>Datos de pago</h5>
                            <label for="inputNumeroTarjeta">Numero de tarjeta</label>
                            <input type="text" name="numero_tarjeta" id="inputNumeroTarjeta" class="form-control" placeholder="{{Auth::user()->numero_tarjeta}}" disabled>
                            <label for="inputfechaCaducidadTarjeta">Fecha de caducidad</label>
                            <input type="month" name="fecha_caducidad_tarjeta" id="inputFechaCaducidadTarjeta" class="form-control @error('fechaCaducidadTarjeta') is-invalid @enderror" placeholder="MM/AA" required autocomplete="off">
                            @error('fechaCaducidadTarjeta')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                            <label for="inputCvvTarjeta">CVV</label>
                            <input type="text" name="cvv_tarjeta" id="inputCvvTarjeta" class="form-control @error('cvvTarjeta') is-invalid @enderror" placeholder="123" minlength="3" maxlength="3" required autocomplete="off">
                            @error('cvvTarjeta')
                            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-primary" onclick="premiumForm_submit()">Solicitar</button>
            </div>
        </div>
    </div>
</div>
<!-- End Request premium Modal -->

<script>
    // Button
    function balance_submit() {
        document.getElementById("balanceForm").submit();
    }
</script>


<script>
    // Button
    function premiumForm_submit() {
        document.getElementById("premiumForm").submit();
    }
</script>
