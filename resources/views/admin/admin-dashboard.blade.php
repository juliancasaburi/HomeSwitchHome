@extends('layouts.admin-dashboard-layout')

@section('title', '- Admin Dashboard')

@section('content')
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        @include('layouts.partials.admin-sidebar')
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Admin Dashboard</h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Home</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <h3 class="pb-5">Estadisticas</h3>
                    <div class="ecommerce-widget">
                        <h3>Usuarios</h3>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Usuarios</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $userCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Usuarios normales</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $userCount - $premiumUserCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Precio subscripción</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">${{ $normalUserSubscriptionPrice }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Usuarios premium</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $premiumUserCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Precio Plus Premium</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">${{ $premiumPlusPrice }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>Propiedades</h3>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Propiedades</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $propertyCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Semanas</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $weekCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>Reservas</h3>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Reservas por Subastas</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $auctionReservationCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Reservas Premium</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $premiumReservationCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Reservas por HotSale</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $hotSalesReservationCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>HotSales</h3>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Activas</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $activeHotSaleCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>Subastas</h3>
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">En espera</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $pendingAuctionCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">En período de inscripción</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $inscriptionAuctionCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">En curso</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $activeAuctionCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total inscripciones</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $inscriptionCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total pujas</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $bidCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
@endsection