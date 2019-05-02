@extends('layouts.mainlayout')

@section('content')
    <section class="section-services section-t8">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Verifica tu dirección de e-mail') }}</div>

                        <div class="card-body">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('Te hemos enviado un e-mail de confirmación') }}
                                </div>
                            @endif

                            {{ __('Por favor, confirma tu e-mail') }}
                            {{ __('Si no has recibido ningún e-mail') }}, <a href="{{ route('verification.resend') }}">{{ __('haz click aquí para solicitar un reenvio') }}</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
