@extends('layouts.admin-dashboard-layout')

@section('title', '- Admin Dashboard - Listado de reservas')

@section('css')
    <link href="{{ asset('lib/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('ib/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
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
                            <h2 class="pageheader-title">Admin Dashboard</h2>
                            <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href={{ url('admin/dashboard') }} class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Reservas</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Ver listado</li>
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
                    <!-- users table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Listado de propiedades</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                          <tr>
                                            <th>ID</th>
                                            <th>Semana ID</th>
                                            <th>Usuario</th>
                                            <th>Propiedad</th>
                                            <th>Fecha</th>
                                            <th>Valor</th>
                                            <th>Modo</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($reservations as $r)
                                          <tr>
                                            <td>{{ $r->id}}</td>
                                            <td><a href={{ url('week?id=').$r->week->id }}>{{ $r->semana_id }}</a></td>
                                            <td>ID: {{ $r->usuario_id}} <br> {{ $r->user->nombre}} {{ $r->user->apellido}}</td>
                                            <td><a href={{ url('property?id=').$r->week->property->id }}>{{ $r->week->property->nombre}}</a></td>
                                            <td>{{ $r->week->fecha}}</td>
                                            <td>{{ $r->valor_reservado}}</td>
                                            @if($r->modo_reserva == 0)
                                              <td><i class="fas fa-gavel fa-fw fa-sm"></i> Subasta</td>
                                            @elseif($r->modo_reserva == 1)
                                              <td><i class="fas fa-ticket-alt fa-fw fa-sm text-success"></i> Reserva Directa (Premium)</td>
                                            @else
                                              <td><i class="fas fa-fire fa-fw fa-sm text-hotsale"></i>Hotsale</td>
                                            @endif
                                          </tr>
                                        @endforeach
                                      </tbody>
                                      <tfoot>
                                      <tr>
                                        <th>ID</th>
                                        <th>Semana ID</th>
                                        <th>Usuario</th>
                                        <th>Propiedad</th>
                                        <th>Fecha</th>
                                        <th>Valor</th>
                                        <th>Modo</th>
                                      </tr>
                                      </tfoot>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- ============================================================== -->
                  <!-- end users table  -->
                  <!-- ============================================================== -->
              </div>
          </div>
      </div>
  </div>
  <!-- ============================================================== -->
  <!-- end main wrapper -->
  <!-- ============================================================== -->
@endsection

@section('js')

    <!-- Optional JavaScript -->
    <!-- dashboard js -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!-- slimscroll js -->
    <script src="{{ asset('lib/slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- morris-chart js -->
    <script src="{{ asset('lib/charts/morris-bundle/raphael.min.js') }}"></script>
    <script src="{{ asset('lib/charts/morris-bundle/morris.js') }}"></script>
    <script src="{{ asset('lib/charts/morris-bundle/morrisjs.html') }}"></script>
    <!-- chart js -->
    <script src="{{ asset('lib/charts/charts-bundle/Chart.bundle.js') }}"></script>
    <script src="{{ asset('lib/charts/charts-bundle/chartjs.js') }}"></script>
    <!-- dashboard js -->
    <script src="{{ asset('lib/charts/charts-bundle/chartjs.js') }}"></script>
@endsection
