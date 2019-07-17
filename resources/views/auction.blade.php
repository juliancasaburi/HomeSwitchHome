@extends('layouts.mainlayout')

@section('title', ' - Subasta - Semana '.$auction->week->fecha. ' - De propiedad '.$auction->week->property->nombre)

@section('content')
	<section class="auction nav-arrow-b">
		<!--/ Auction Start /-->
		<div class="col-sm-12 ">
			<!-- ============================================================== -->
			<!-- Alerts  -->
			<!-- ============================================================== -->
			@if(session()->has('alert-success'))
				<div class="alert alert-success alert-dismissible" data-expires="10000">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					{{ session()->get('alert-success') }}
				</div>
			@elseif (session()->has('alert-error'))
				<div class="alert alert-error alert-dismissible" data-expires="10000">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
					{{ session()->get('alert-error') }}
				</div>
		@endif
		<!-- ============================================================== -->
			<!-- End Alerts  -->
			<!-- ============================================================== -->
			<div class="row card-header">
				<h3 class="title-a color-b">{{ $auction->property->nombre }}</h3>
			</div>
			<div class="row justify-content-between card-header">
				<div class="col-sm-8">
					<div class="col-sm-8">
						<div class="title-box-d section-t4">
							<h3 class="title-a color-b">Subasta </h3>
							<h8 class="title-d">De la semana {{ $auction->week->fecha }}</h8>
							<br>
						</div>
						<div class="summary-list">
							<strong>Duración</strong>
							<br>
							<span>{{ $auction->inicio }} al {{ $auction->fin }}</span>
							<br>
							<strong>Precio inicial</strong>
							<br>
							<span>${{ $auction->precio_inicial }}</span>
							<br>
							@if($enabled == true)
								@auth
									@if($myLatestBid)
										<strong>Mi puja más reciente:</strong>
										<br>
										<span>$ {{ $myLatestBid->monto }} <br> {{ $myLatestBid->created_at }}</span>
										<br>
									@else
										<strong>Mi puja más reciente:</strong>
										<br>
										<span>Aún no participaste en esta puja</span>
										<br>
									@endif
								@endauth
								<strong>Puja más reciente:</strong>
								<br>
								@if(!$latestBid)
									<span> Nadie participó aún <i class="fas fa-frown"></i></span>
								@else
									<span>Monto: <strong>$ {{ $latestBid->monto }}</strong> <br>Usuario: <strong>({{ $latestBid->user->nombre }}) </strong> <br>Fecha: <strong>{{ $latestBid->created_at }}</strong></span>
								@endif
								<br>
								@auth
									<button class="btn btn-b mt-5" data-toggle="modal" data-target="#bidModal" data-uid="{{ Auth::id() }}">Pujar</button>
								@endauth
							@else
								@if(!$auction->trashed() && $auction->inscripcion_inicio <= \Carbon\Carbon::now() && $auction->inscripcion_fin > \Carbon\Carbon::now())
									<br>
									<h8>La subasta está en período de inscripción.</h8>
									@auth
										<h8>Puedes inscribirte clickeando el siguiente botón</h8>
										<br>
										@if($auction->whereHas('inscriptions', function ($query){
                                            $query->where('usuario_id', '=', Auth::user()->id);
                                            })->count() == 0 &&  Auth::user()->creditos > 0)
											<td><button class="btn-primary mt-5" data-toggle="modal" data-target="#inscriptionModal" data-uid="{{ Auth::user()->id }}" data-auid="{{ $auction->id }}" data-wd="{{ $auction->week->fecha }}" data-aup="{{ $auction->precio_inicial }}"><i class="fas fa-signature"></i>Inscribirse</button></td>
										@elseif(Auth::user()->creditos == 0)
											<td><button class="btn-secondary mt-5" disabled><i class="fas fa-signature"></i>Sin créditos</button></td>
										@else
											<td><button class="btn-secondary mt-5" disabled><i class="fas fa-signature"></i>Inscripto</button></td>
										@endif
									@endauth
								@else
									<h6 class="title-d mt-5">La subasta aún no ha comenzado o ha finalizado</h6>
								@endif
							@endif
							@guest
								<p><span><a href="{{'/register'}}">Registrate</a></span> o <span><a href="{{'/login'}}">inicia sesión</a></span> para participar en las subastas</p>
							@endguest
						</div>
					</div>
				</div>
				<div class="col-sm-4 section-t4">
					<div class="card-box-d">
						<div class="card-img-d">
							<img src="{{asset($auction->property->image_path)}}" alt="" class="img-d img-fluid">
						</div>
						@if($enabled == true)
							<div class="card-overlay card-overlay-hover">
								<div class="card-header-d section-t4">
									<div class="card-title-d align-self-center">
										<h3 class="title-d">
											Última
											<br> Puja
										</h3>
									</div>
								</div>
								@if($latestBid)
									<div class="card-body-d">
										<p class="content-d color-text-a">
											{{ $latestBid->user->nombre }}
										</p>
										<div class="info-agents color-a">
											<p>
												<strong>Monto: </strong>$ {{ $latestBid->monto }}</p>
											<strong>Fecha: </strong> {{ $latestBid->created_at }}</p>
										</div>
									</div>
								@else
									<div class="card-body-d">
										<p class="content-d color-text-a">
											Aún no hubo una puja
										</p>
									</div>
								@endif
								<div class="card-footer-d text-center">
									@auth
										<button class="btn btn-a" data-toggle="modal" data-target="#bidModal" data-uid="{{ Auth::id() }}">Pujar</button>
									@endauth
									@guest
										<p><span><a href="{{'/register'}}">Registrate</a></span> o <span><a href="{{'/login'}}">inicia sesión</a></span> para participar en las subastas</p>
									@endguest
								</div>
							</div>
						@else
							<div class="card-overlay card-overlay-hover">
								<div class="card-header-d section-t4">
									<div class="card-title-d align-self-center">
										<h3 class="title-d">La subasta aún no ha comenzado o ha finalizado</h3>
									</div>
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Auction End -->

	<!-- Bid Modal -->
	<div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="bidModalLabel">Pujar</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="needs-validation" id="bidForm" action="{{ url('auction/bid') }}" role="form" method="POST">
						@csrf
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<label for="auctionID"></label>
								<input type="text" name="auctionID" class="form-control" id="auctionID" value="{{ $auction->id }}" hidden>
							</div>
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<label for="amount">Monto</label>
								<input type="number" step="0.01" name="amount" class="form-control" id="amount" placeholder="" autofocus>
								<div class="valid-feedback">
									Válido
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Volver a la información</button>
					<button type="button" class="btn btn-primary" onclick="bid_submit()">Pujar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Inscription Modal -->
	<div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="inscriptionModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="inscriptionModalLabel">Inscribirse a una subasta</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h3 id="weekDate">Semana:</h3>
					<h3 id="initialPrice">Precio inicial:</h3>
					<form class="needs-validation" id="inscriptionForm" action="{{ route('auction.signIn') }}" role="form" method="POST">
						@csrf
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<label for="auid"></label>
								<input type="text" name="auid" class="form-control" id="auid" value="" hidden>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No inscribir</button>
					<button type="button" id="submitInscription" class="btn btn-primary" onclick="inscription_submit()">Inscribir</button>
				</div>
			</div>
		</div>
	</div>

	<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
@endsection

@section('js')
	<script src="{{ asset('js/dashboard.js') }}"></script>
	<script> // Bid modal

		// Reset modal input after closing it
		$('#bidModal').on('hidden.bs.modal', function(e)
		{
			$("#bidModal .modal-body input").val("")
		}) ;

		// Set autofocus atribute
		$('#bidModal').on('shown.bs.modal', function (event) {
			$(event.currentTarget).find('[autofocus]').focus();
		});

		// Button
		function bid_submit() {
			$('#bidModal').modal('hide');
			document.getElementById("bidForm").submit();
		}
	</script>

	<script> // Inscription modal

		// Reset modal input after closing it
		$('#inscriptionModal').on('hidden.bs.modal', function(e)
		{
			$("#inscriptionModal .modal-body input").val("");

			var date = document.getElementById('weekDate');

			// removing everything inside the node
			while (date.firstChild) {
				date.removeChild(date.firstChild);
			}

			// appending new text node
			date.appendChild(document.createTextNode('Semana: '));

			var initialPrice = document.getElementById('initialPrice');

			// removing everything inside the node
			while (initialPrice.firstChild) {
				initialPrice.removeChild(initialPrice.firstChild);
			}

			// appending new text node
			initialPrice.appendChild(document.createTextNode('Precio Inicial: '));
		}) ;

		// Display user data
		$('#inscriptionModal').on('show.bs.modal', function (event) {
			var weekDate = $(event.relatedTarget).data('wd');
			var auctionPrice = $(event.relatedTarget).data('aup');
			var auctionID = $(event.relatedTarget).data('auid');
			var userID = $(event.relatedTarget).data('uid');

			$(event.currentTarget).find('input[name="auid"]').attr('value', auctionID);
			$(event.currentTarget).find('input[name="uid"]').attr('value', userID);

			var date = document.getElementById('weekDate');
			// appending new text node
			date.appendChild(document.createTextNode(weekDate));

			var initialPrice = document.getElementById('initialPrice');
			// appending new text node
			initialPrice.appendChild(document.createTextNode(auctionPrice));
		});

		// Button
		function inscription_submit() {
			$('#inscriptionModal').modal('hide');
			document.getElementById("inscriptionForm").submit();
		}
	</script>
@endsection