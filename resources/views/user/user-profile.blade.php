@extends('layouts.mainlayout-no-footer')

@section('title', '- Mi Cuenta')

@section('css')
	<link href="{{ asset('lib/fonts/circular-std/style.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/style-dashboard.css') }}">
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
										<i data-toggle="tooltip" data-placement="bottom" title="Se renovarán el {{Auth::user()->created_at->addYear()}}" class="fas fa-coins fa-fw fa-2x text-info"></i>
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
										<span data-toggle="modal" data-target="#balanceModal">
											<a href="#" data-toggle="tooltip" data-placement="bottom" title="Cargar Saldo"><i class="fas fa-wallet fa-fw fa-2x text-primary"></i></a>
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
					<!-- ============================================================== -->
					<!-- user activity timeline  -->
					<!-- ============================================================== -->
					<section class="cd-timeline js-cd-timeline">
						<div class="cd-timeline__container">
							@foreach($activities as $a)
								<div class="cd-timeline__block js-cd-block">
									@switch(class_basename($a))
										@case('InscriptionForFutureAuction')
										<div class="cd-timeline__i inscriptionBackground js-cd-img">
											<i class="fas fa-signature fa-fw fa-2x inscriptionIcon"></i>
										</div>
										<!-- cd-timeline__i -->
										<div class="cd-timeline__content js-cd-content">
											<h3>Inscripción</h3>
											@break
											@case('Bid')
											<div class="cd-timeline__i auctionBackground js-cd-img">
												<i class="fas fa-gavel fa-fw fa-2x auctionIcon"></i>
											</div>
											<!-- cd-timeline__i -->
											<div class="cd-timeline__content js-cd-content">
												<h3>Puja</h3>
												<h5 class="text-muted"><i class="fas fa-gavel fa-fw fa-1x"></i>Monto: ${{ $a->monto }}</h5>
												@break
												@case('Reservation')
												<div class="cd-timeline__i reservationBackground js-cd-img">
													<i class="fas fa-calendar-check fa-fw fa-2x reservationIcon"></i>
												</div>
												<!-- cd-timeline__i -->
												<div class="cd-timeline__content js-cd-content">
													<h3>Reserva</h3>
													@switch($a->modo_reserva)
														@case(0)
														<h5 class="text-muted"><i class="fas fa-gavel fa-fw fa-1x"></i>Modo: Subasta</h5>
														@break
														@case(1)
														<h5 class="text-muted"><i class="fas fa-ticket-alt fa-fw fa-1x"></i>Modo: Premium</h5>
														@break
														@case(2)
														<h5 class="text-muted"><i class="fas fa-fire fa-fw fa-1x"></i>Modo: HotSale</h5>
													@break
												@endswitch
												@break
												@endswitch
												<!-- cd-timeline__i -->
													<a href={{ url($propertyURL).$a->property->id }}><span><h3 class="text-center">{{$a->property->nombre}}</h3></span></a>
													<a href={{ url($weekURL).$a->week->id }}><span><h5 class="text-muted text-center">{{$a->week->fecha}}</h5></span></a>
													<div class="m-r-10 text-center">
														<a href={{ url($propertyURL).$a->property->id }}><img src="{{$a->property->image_path}}" alt="user" width="256"></a>
													</div>
													<span class="cd-timeline__date text-dark">{{$a->created_at}}</span>
												</div>
												<!-- cd-timeline__content -->
											</div>
											<!-- cd-timeline__block -->
											@endforeach
										</div>
								</div>
						</div>
					</section>
					<!-- cd-timeline -->
					<!-- ============================================================== -->
					<!-- end user activity timeline  -->
					<!-- ============================================================== -->
					<!-- ============================================================== -->
					<!-- end content -->
					<!-- ============================================================== -->
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
	<!-- timeline js -->
	<script src="{{ asset('lib/timeline/js/main.js') }}"></script>

@endsection