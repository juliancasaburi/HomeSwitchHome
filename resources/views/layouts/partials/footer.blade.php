<!--/ footer Start /-->
<section class="section-footer">
    <div class="container text-center">
        <div class="row">
            <div class="col-sm-12">
                <div class="widget-a">
                    <div class="w-header-a">
                            <a href="{{ url('/') }}"><img id="logo" src="{{ asset('img/HSH-Complete.svg') }}" alt="Home Switch Home Logo" height="20%" width="20%"></a>
                    </div>
                    <div class="w-body-a">
                        <p class="w-text-a color-text-a">
                           Cadena de residencias
                        </p>
                    </div>
                    <div class="w-footer-a">
                        <ul class="list-unstyled">
                            <li class="color-b">
                                <span class="color-text-b">Email</span>
                                <a href="mailto:contacto@homeswitchhome.online" target="_top">contacto@homeswitchhome.online</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="nav-footer">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href={{ url('/') }}>Home</a>
                        </li>
                        <li class="list-inline-item">
                            <a href={{ url('faq') }}>FAQ</a>
                        </li>
                        <li class="list-inline-item">
                            <a href={{ url('contact') }}>Contacto</a>
                        </li>
                        <li class="list-inline-item">
                            <a data-toggle="modal" href="#modalTOS">Términos y condiciones</a>
                        </li>
                    </ul>
                </nav>
                <div class="socials-a">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-facebook-square" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fab fa-twitter-square" aria-hidden="true"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="copyright-footer">
                    <a class="copyright color-text-a" href="{{ url('/') }}">
                        &copy; Copyright
                        <span class="color-a">Home Switch Home</span> All Rights Reserved.
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--/ Footer End /-->

<!-- Modal TOS -->
<div class="modal fade" id="modalTOS" tabindex="-1" role="dialog" aria-labelledby="modalTOSTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTOSLongTitle">Términos y Condiciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="width:100%" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>