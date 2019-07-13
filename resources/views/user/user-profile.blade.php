@extends('layouts.mainlayout-no-footer')

@section('title', '- Mi Cuenta')

@section('css')
	<link href="{{ asset('lib/fonts/circular-std/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('style-dashboard.css') }}">
	<link rel="stylesheet" href="{{ asset('lib/charts/morris-bundle/morris.css') }}">
	<link rel="stylesheet" href="{{ asset('lib/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
@endsection

@section('content')
	<!-- ============================================================== -->
	<!-- main wrapper -->
	<!-- ============================================================== -->
	<div class="dashboard-main-wrapper">
		@include('layouts.partials.user-sidebar')
		<div class="dashboard-wrapper">
			<div class="dashboard-influence">
				<div class="container-fluid dashboard-content">
					<!-- ============================================================== -->
					<!-- pageheader  -->
					<!-- ============================================================== -->
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="page-header">
								<h3 class="mb-2">Mi Cuenta</h3>
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
					<!-- content  -->
					<!-- ============================================================== -->
					<!-- ============================================================== -->
					<!-- user profile  -->
					<!-- ============================================================== -->
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							<div class="card influencer-profile-data">
								<div class="card-body">
									<div class="row">
										<div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-12">
											<div class="user-avatar-info">
												<div class="m-b-20">
													<div class="user-avatar-name">
														<h2 class="mb-1">{{ Auth::user()->nombre }} {{ Auth::user()->apellido }}</h2>
													</div>
													@if (Auth::user()->premium == 1)
														<div class="rating-star  d-inline-block">
															<i class="fas fa-ticket-alt text-success"></i>
															<p class="d-inline-block text-dark">USUARIO PREMIUM</p>
															<br>
															<p class="d-inline-block text-dark">Costo subscripción: ${{ $normalUserSubscriptionPrice }} + Plus Premium: ${{ $premiumPlusPrice }}</p>
														</div>
													@else
														<div class="rating-star  d-inline-block">
															<i class="fas fa-user"></i>
															<p class="d-inline-block text-dark">USUARIO BÁSICO</p>
															<br>
															<p class="d-inline-block text-dark">Costo subscripción: ${{ $normalUserSubscriptionPrice }}</p>
														</div>
													@endif
												</div>
												<div class="user-avatar-address">
													<p>
														<span class="d-xl-inline-block d-block mb-2"><i class="fa fa-map-marker-alt mr-2 text-primary "></i>{{ Auth::user()->pais }}</span>
														<span class="mb-2 ml-xl-4 d-xl-inline-block d-block">Se unió el: {{ Auth::user()->created_at }}  </span>
														<span class=" mb-2 d-xl-inline-block d-block ml-xl-4">{{ Auth::user()->age }} años </span>
														<span class=" mb-2 d-xl-inline-block d-block ml-xl-4">Próximo ciclo de facturación: {{ Auth::user()->created_at->addMonths(1)}} </span>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- ============================================================== -->
					<!-- end user profile  -->
					<!-- ============================================================== -->
					<!-- ============================================================== -->
					<!-- widgets   -->
					<!-- ============================================================== -->
					<div class="row">
						<!-- ============================================================== -->
						<!-- four widgets   -->
						<!-- ============================================================== -->
						<!-- ============================================================== -->
						<!-- Credits   -->
						<!-- ============================================================== -->
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="card">
								<div class="card-body">
									<div class="d-inline-block">
										<h5 class="text-muted">Créditos</h5>
										<h5 class="mb-0">{{ Auth::user()->creditos }}</h5>
									</div>
									<div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
										<i data-toggle="tooltip" data-placement="bottom" title="Se renovarán el {{Auth::user()->created_at->addYear()}}" class="fas fa-coins fa-fw fa-sm text-info"></i>
									</div>
								</div>
							</div>
						</div>
						<!-- ============================================================== -->
						<!-- end Credits   -->
						<!-- ============================================================== -->
						<!-- ============================================================== -->
						<!-- Balance  -->
						<!-- ============================================================== -->
						<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
							<div class="card">
								<div class="card-body">
									<div class="d-inline-block">
										<h5 class="text-muted">Saldo</h5>
										<h5 class="mb-0">{{ Auth::user()->saldo }}</h5>
									</div>
									<div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
										<span data-toggle="modal" data-target="#premiumModal">
											<a href="#" data-toggle="tooltip" data-placement="bottom" title="Cargar Saldo"><i class="fas fa-wallet fa-fw fa-sm text-primary"></i></a>
										</span>
									</div>
								</div>
							</div>
						</div>
						<!-- ============================================================== -->
						<!-- end Balance   -->
						<!-- ============================================================== -->
						<!-- ============================================================== -->
					</div>
					<div class="row">
						<!-- ============================================================== -->
						<!-- user activity  -->
						<!-- ============================================================== -->
						<div class="col-lg-12">
							<div class="section-block">
								<h3 class="section-title">Mi Historial</h3>
							</div>
							<div class="card">
								<div class="campaign-table table-responsive">
									<table class="table">
										<thead>
										<tr class="border-0">
											<th class="border-0">Actividad</th>
											<th class="border-0">Propiedad</th>
											<th class="border-0">Semana</th>
											<th class="border-0">Fecha</th>
										</tr>
										</thead>
										<tbody>
										@foreach($activities as $a)
											<tr>
												@switch(class_basename($a))
													@case('InscriptionForFutureAuction')
													<td>
														<p>
															<i class="fas fa-signature fa-fw fa-sm inscriptionIcon"></i>
															Inscripción
														</p>
													</td>
													@break
													@case('Bid')
													<td>
														<p>
															<i class="fas fa-gavel fa-fw fa-sm auctionIcon"></i>
															Puja
														</p>
													</td>
													@break
													@case('Reservation')
													<td>
														<p>
															<i class="fas fa-calendar-check fa-fw fa-sm reservationIcon"></i>
															Reserva
														</p>
														@switch($a->modo_reserva)
															@case(0)
															<p class="text-muted">
																<i class="fas fa-gavel fa-fw fa-xs"></i>
																Modo: Subasta
															</p>
															@break
															@case(1)
															<p class="text-muted">
																<i class="fas fa-ticket-alt fa-fw fa-xs"></i>
																Modo: Premium
															</p>
															@break
															@case(2)
															<p class="text-muted">
																<i class="fas fa-fire fa-fw fa-xs"></i>
																Modo: HotSale
															</p>
															@break
														@endswitch
													</td>
													@break
												@endswitch
												<td>
													<div class="m-r-10">
														<a href={{ url($propertyURL).$a->property->id }}><img src="{{$a->property->image_path}}" alt="user" width="128"></a>
														<a href={{ url($propertyURL).$a->property->id }}>{{$a->property->nombre}}</a>
													</div>
												</td>
												<td>
													<a href={{ url($weekURL).$a->week->id }}>{{$a->week->fecha}}</a>
												</td>
												<td>{{$a->created_at}}</td>
											</tr>
										@endforeach
										</tbody>
										<tfoot>
										<tr class="border-0">
											<th class="border-0">Actividad</th>
											<th class="border-0">Propiedad</th>
											<th class="border-0">Semana</th>
											<th class="border-0">Fecha</th>
										</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
						<!-- ============================================================== -->
						<!-- end user activity -->
						<!-- ============================================================== -->
					</div>
					<!-- ============================================================== -->
					<!-- end content -->
					<!-- ============================================================== -->
					@if(session()->has('alert-success'))
						<div class="alert alert-success alert-dismissible wow slideInUp" data-expires="10000">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							{{ session()->get('alert-success') }}
						</div>
					@elseif (session()->has('alert-warning'))
						<div class="alert alert-warning alert-dismissible" data-expires="10000">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							{{ session()->get('alert-success') }}
						</div>
					@elseif ($errors->any())
						<div class="alert alert-danger alert-dismissible" data-expires="10000">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
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
		<!-- ============================================================== -->
		<!-- end wrapper  -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- end main wrapper  -->
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
	<!-- chart js -->
	<script src="{{ asset('lib/charts/charts-bundle/Chart.bundle.js') }}"></script>
	<script src="{{ asset('lib/charts/charts-bundle/chartjs.js') }}"></script>
	<!-- dashboard js -->
	<script src="{{ asset('lib/charts/charts-bundle/chartjs.js') }}"></script>

@endsection