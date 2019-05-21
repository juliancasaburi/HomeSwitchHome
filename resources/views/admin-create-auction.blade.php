@extends('layouts.admin-dashboard-layout')

@section('title', '- Admin Dashboard - Crear semana')

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
                            <h2 class="pageheader-title">Admin Dashboard</h2>
                            <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href={{ url('admin/dashboard') }} class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Subastas</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Crear Subasta</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->

                <div class="row">
                    <!-- ============================================================== -->
                    <!-- Auction creation form -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Crear una subasta</h5>
                            <form class="needs-validation" action="{{ route('auction.create') }}" role="form" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <label for="inputIdPropiedad">Propiedad</label>
                                        <select class="form-control" name="idPropiedad" id="inputIdPropiedad" required autofocus>
                                            <option value="" selected>
                                                Seleccione una propiedad
                                            </option>
                                            @foreach ($properties as $p)
                                                <option value={{ $p->id}}>{{ $p->id}} - {{ $p->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <label for="inputSemana">Semana desde el dia</label>
                                        <select id="inputSemana" class="form-control input-sm" name="semana" required>
                                            <option>--Semana--</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 ">
                                        <label for="fechaApertura">Inscripción fecha apertura</label>
                                        <input type="datetime-local" name="inscripcionFechaApertura" class="form-control" id="fechaApertura" required>
                                        <div class="valid-feedback">
                                            Válido
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 ">
                                        <label for="inscripcionFechaCierre">Inscripción fecha finaliza</label>
                                        <input type="datetime-local" name="inscripcionFechaCierre" class="form-control" id="inscripcionFechaCierre" required>
                                        <div class="valid-feedback">
                                            Válido
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                        <label for="subastaFechaApertura">Subasta fecha comienzo</label>
                                        <input type="datetime-local" name="subastaFechaApertura" class="form-control" id="subastaFechaApertura" required>
                                        <div class="valid-feedback">
                                            Válido
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 ">
                                        <label for="subastaFechaCierre">Subasta fecha finaliza</label>
                                        <input type="datetime-local" name="subastaFechaCierre" class="form-control" id="subastaFechaCierre" required>
                                        <div class="valid-feedback">
                                            Válido
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                        <label for="subastaFechaCierre">Precio inicial (Piso)</label>
                                        <input type="number" step=0.01 name="precioInicial" class="form-control" id="precioInicial" required>
                                        <div class="valid-feedback">
                                            Válido
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-2 mt-4">
                                    <button class="btn btn-primary" type="submit">Crear subasta</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Auction creation form -->
                <!-- ============================================================== -->
                @if(session()->has('alert-success'))
                    <div class="alert alert-success" data-expires="5000">
                        {{ session()->get('alert-success') }}
                    </div>
                @elseif (session()->has('alert-error'))
                    <div class="alert alert-danger" data-expires="5000">
                        {{ session()->get('alert-error') }}
                    </div>
                @elseif ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
@endsection

@section('js')
    <script>
        $('select[name="idPropiedad"]').on('change', function(){
            var propiedadId = $(this).val();
            if(propiedadId) {
                $.ajax({
                    url: '/weeks/get/'+propiedadId,
                    type:"GET",
                    dataType:"json",
                    beforeSend: function(){
                        $('#loader').css("visibility", "visible");
                    },

                    success:function(data) {

                        $('select[name="semana"]').empty();

                        $.each(data, function(key, value){

                            $('select[name="semana"]').append('<option value="'+ value +'">' + value + '</option>');

                        });
                    },
                    complete: function(){
                        $('#loader').css("visibility", "hidden");
                    }
                });
            } else {
                $('select[name="semana"]').empty();
            }

        });
    </script>
@endsection