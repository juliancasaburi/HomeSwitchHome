@extends('layouts.admin-dashboard-layout')

@section('title', '- Admin Dashboard - Listado de subastas activas')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs//datatables/css/select.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/css/fixedHeader.bootstrap4.css') }}">
@endsection

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
            <div class="container-fluid  dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Mi cuenta</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Mi Cuenta</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Alerts  -->
                <!-- ============================================================== -->
                @if(session()->has('alert-success'))
                    <div class="alert alert-success alert-dismissible" data-expires="10000">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ session()->get('alert-success') }}
                    </div>
                @elseif (session()->has('alert-error'))
                    <div class="alert alert-danger alert-dismissible" data-expires="10000">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ session()->get('alert-error') }}
                    </div>
                @elseif ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- ============================================================== -->
                <!-- End Alerts  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- content  -->
                <!-- ============================================================== -->
                <h5>Modificar Datos</h5>
                <form class="needs-validation" action="{{ route('admin.modifyData') }}" role="form" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" maxlength="40" value="{{ Auth::user()->nombre }}" placeholder="{{ Auth::user()->nombre }}" autofocus>
                        @error('nombre')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido" id="apellido" maxlength="40" value="{{ Auth::user()->apellido }}" placeholder="{{ Auth::user()->apellido }}" autofocus>
                        @error('apellido')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputNewEmail">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="newEmail" id="inputNewEmail" value="{{ Auth::user()->email }}" placeholder="{{ Auth::user()->email }}" autocomplete="off">
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" minlength="8" autocomplete="off">
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                    @enderror
                    <button type="submit" class="btn btn-primary">Modificar</button>
                </form>
                <!-- ============================================================== -->
                <!-- end content  -->
                <!-- ============================================================== -->
            </div>
        </div>
    </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
@endsection