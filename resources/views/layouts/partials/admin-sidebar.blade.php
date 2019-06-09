<!-- ============================================================== -->
<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ url('admin/dashboard') }}"><i class="fab fa-fw fa-black-tie"></i>Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-hotel"></i>Propiedades</a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/dashboard/property-list') }}">Ver todas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href={{ url('admin/dashboard/create-property') }}>Crear Propiedad</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Modificar Propiedad</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Eliminar Propiedad</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="far fa-calendar-alt"></i>Semanas</a>
                        <div id="submenu-3" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/dashboard/weeks-list') }}">Ver todas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/dashboard/create-week') }}">Crear Semana</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Eliminar Semana</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-signature"></i></i>Inscripciones a subastas</a>
                        <div id="submenu-4" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Ver todas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Eliminar Inscripcion</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-gavel"></i></i>Subastas</a>
                        <div id="submenu-5" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/dashboard/auction-list') }}">Ver todas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/dashboard/active-auctions') }}">Ver subastas activas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/dashboard/create-auction') }}">Crear Subasta</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Modificar Subasta</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Eliminar Subasta</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-calendar-check"></i>Reservas</a>
                        <div id="submenu-6" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/dashboard/reservation-list') }}">Ver todas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Cancelar una Reserva</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7" aria-controls="submenu-7"><i class="fas fa-users"></i>Usuarios</a>
                        <div id="submenu-7" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href={{ url('admin/dashboard/user-list') }}>Ver todos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href={{ url('admin/dashboard/premium-request-list') }}>Ver Solicitudes Premium</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ url('admin/dashboard/prices') }}"><i class="fas fa-cash-register"></i>Precios</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->
<!-- ============================================================== -->
