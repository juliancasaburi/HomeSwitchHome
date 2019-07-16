@extends ('layouts.mainlayout')

@section('title', '- Contacto')

@section('content')
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">Información de contacto</h1>
                        <span class="color-text-a">Aut voluptas consequatur unde sed omnis ex placeat quis eos. Aut natus officia corrupti qui autem fugit consectetur quo. Et ipsum eveniet laboriosam voluptas beatae possimus qui ducimus. Et voluptatem deleniti. Voluptatum voluptatibus amet. Et esse sed omnis inventore hic culpa.</span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href={{ url('/') }}>Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Contacto
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact-map box wow fadeInUp" data-wow-duration="1.5s">
                        <div id="map" class="contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3272.116747977639!2d-57.93816005690638!3d-34.90351957542984!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95a2e66a8fcdf951%3A0x9191a5ff1fbbe5d5!2sUNLP+-+Facultad+de+Inform%C3%A1tica!5e0!3m2!1ses-419!2sar!4v1553286342958" width="100%" height="450" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 section-t8" id="contactForm">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="title-box-d">
                                <h3 class="title-d">Dejanos un mensaje</h3>
                            </div>
                            <!-- Form Start -->
                            <form class="form-a contactForm wow fadeInUp" action="{{ route('contact.sendMail') }}" role="form" method="POST" data-wow-duration="1.5s">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control form-control-lg form-control-a @error('name') is-invalid @enderror" placeholder="Nombre" minlength="4" required>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input name="email" type="email" class="form-control form-control-lg form-control-a @error('email') is-invalid @enderror" placeholder="Email" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="subject" class="form-control form-control-lg form-control-a @error('subject') is-invalid @enderror" placeholder="Asunto" minlength="4" required>
                                            @error('subject')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" cols="45" rows="8" placeholder="Mensaje" minlength="4" required></textarea>
                                            @error('message')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-a">Enviar mensaje</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Form End -->
                        </div>
                        <div class="col-md-5 section-md-t3 section-t4 wow fadeInUp" data-wow-duration="1.5s">
                            <div class="icon-box section-b2">
                                <div class="icon-box-icon">
                                    <span class="ion-ios-paper-plane"></span>
                                </div>
                                <div class="icon-box-content table-cell">
                                    <div class="icon-box-title">
                                        <h4 class="icon-title">Contactanos</h4>
                                    </div>
                                    <div class="icon-box-content">
                                        <span class="color-text-b">Email</span>
                                        <a href="mailto:contacto@homeswitchhome.online" target="_top">contacto@homeswitchhome.online</a></li>
                                    </div>
                                </div>
                            </div>
                            <div class="icon-box section-b2">
                                <div class="icon-box-icon">
                                    <span class="ion-ios-pin"></span>
                                </div>
                                <div class="icon-box-content table-cell">
                                    <div class="icon-box-title">
                                        <h4 class="icon-title">Nuestra ubicación</h4>
                                    </div>
                                    <div class="icon-box-content">
                                        <p class="mb-1">
                                            Calle 50 &, Av. 120,
                                            <br> La Plata, Buenos Aires
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- ============================================================== -->
                <!-- Alerts  -->
                <!-- ============================================================== -->
                @if(session()->has('alert-success'))
                    <div class="alert alert-success alert-dismissible" data-expires="10000">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ session()->get('alert-success') }}
                    </div>
                @endif
                <!-- ============================================================== -->
                <!-- End Alerts  -->
                <!-- ============================================================== -->
            </div>
        </div>
    </section>
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
@endsection
