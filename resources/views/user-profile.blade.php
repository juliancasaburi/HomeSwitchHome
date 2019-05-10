@extends('layouts.mainlayout-no-footer')

@section('title', '- Mi Cuenta')

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
							<li class="nav-item ">
								<a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Mi Cuenta <span class="badge badge-success">6</span></a>
								<div id="submenu-1" class="collapse submenu" style="">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-2" aria-controls="submenu-1-2">Modificar Datos</a>
											<div id="submenu-1-2" class="collapse submenu" style="">
												<ul class="nav flex-column">
													<li class="nav-item">
														<a class="nav-link" href="index.html">Modificar email</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" href="ecommerce-product.html">Modificar contraseña</a>
													</li>
												</ul>
											</div>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-divider">
								Acciones
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-history"></i>Historial de Actividad</a>
								<div id="submenu-2" class="collapse submenu" style="">
									<ul class="nav flex-column">
										<li class="nav-item">
											<a class="nav-link" href="pages/cards.html">Reservas pasadas <span class="badge badge-secondary">New</span></a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="pages/general.html">Reservas activas</a>
										</li>
									</ul>
								</div>
							</li>
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
								<p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
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
														<h2 class="mb-1">Nombre del Usuario</h2>
													</div>
													<div class="rating-star  d-inline-block">
														<i class="fas fa-ticket-alt"></i>
														<p class="d-inline-block text-dark">PREMIUM </p>
													</div>
												</div>
												<div class="user-avatar-address">
													<p>
														<span class="d-xl-inline-block d-block mb-2"><i class="fa fa-map-marker-alt mr-2 text-primary "></i>País</span>
														<span class="mb-2 ml-xl-4 d-xl-inline-block d-block">Se unió el: 1 Enero, 2017  </span>
														<span class=" mb-2 d-xl-inline-block d-block ml-xl-4">Hombre
	                                                                </span>
														<span class=" mb-2 d-xl-inline-block d-block ml-xl-4">21 Años </span>
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
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="card">
								<div class="card-body">
									<div class="d-inline-block">
										<h5 class="text-muted">Créditos</h5>
										<h2 class="mb-0"> 0</h2>
									</div>
									<div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
										<i class="fas fa-coins fa-fw fa-sm text-info"></i>
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
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
							<div class="card">
								<div class="card-body">
									<div class="d-inline-block">
										<h5 class="text-muted">Saldo</h5>
										<h2 class="mb-0"> 1,000,000</h2>
									</div>
									<div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
										<i class="fas fa-money-check-alt fa-fw fa-sm text-primary"></i>
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
											<th class="border-0">Propiedad</th>
											<th class="border-0">Nombre propiedad</th>
											<th class="border-0">Fecha</th>
											<th class="border-0">Tipo de reserva</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td>
												<div class="m-r-10"><img src="img/dribbble.png" alt="user" width="35"></div>
											</td>
											<td>Rino Venda Road Five </td>
											<td>9 Mayo, 2019</td>
											<td><i class="fas fa-gavel fa-fw fa-sm"></i> Subasta</td>
										</tr>
										<tr>
											<td>
												<div class="m-r-10"><img src="{{ asset('img/dribbble.png') }}" alt="user" width="35"></div>
											</td>
											<td>Mount Olive, Road Two </td>
											<td>1 Mayo, 2019</td>
											<td><i class="fas fa-fire fa-fw fa-sm text-hotsale"></i> Hotsale</td>
										</tr>
										<tr>
											<td>
												<div class="m-r-10"><img src="{{ asset('img/dribbble.png') }}" alt="user" width="35"></div>
											</td>
											<td>Alira Roan, Road One </td>
											<td>1 Enero, 2018</td>
											<td><i class="fas fa-ticket-alt fa-fw fa-sm text-success"></i> Reserva Directa (Premium)</td>
										</tr>
										</tbody>
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
	<script src="{{ asset('lib/charts/morris-bundle/morrisjs.html') }}"></script>
	<!-- chart js -->
	<script src="{{ asset('lib/charts/charts-bundle/Chart.bundle.js') }}"></script>
	<script src="{{ asset('lib/charts/charts-bundle/chartjs.js') }}"></script>
	<!-- dashboard js -->
	<script src="{{ asset('lib/charts/charts-bundle/chartjs.js') }}js/dashboard-influencer.js"></script>
@endsection