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
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Cantidad Usuarios</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $usersCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Precio subscripción</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">${{ $normalUserSubscriptionPrice }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Cantidad premium</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $premiumUsersCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
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
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Cantidad Propiedades</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $propertiesCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Cantidad Semanas</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $weeksCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>Subastas</h3>
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Cantidad en espera</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $pendingAuctionsCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Cantidad en período de inscripción</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $inscriptionAuctionsCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Cantidad en curso</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ $activeAuctionsCount }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Cantidad inscripciones</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">0</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Cantidad pujas</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">0</h1>
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