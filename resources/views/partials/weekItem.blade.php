<div class="img-box-a wow fadeInUp" data-wow-duration="1.5">
    @if($w->property->image_path == null)
        <img src="{{'https://via.placeholder.com/683x1024?text='.$w->property->nombre}}" alt="" class="img-a img-fluid">
    @else
        <img src="{{asset($w->property->image_path)}}" alt="" class="img-a img-fluid">
    @endif
</div>
<div class="card-overlay">
    <div class="text-sm-center">
        <h4 class="text-info">{{$w->property->nombre}}</h4>
    </div>
    <div class="price-box d-flex float-right">
        <div class="price-box d-flex float-right">
            <h2 class="stars-text">{{ $w->property->estrellas }}<i class="fas fa-star fa-fw star"></i></h2>
        </div>
    </div>
    <div class="card-overlay-a-content">
        <div class="card-header-a">
            <h2 class="card-title-a">
                <a href="{{ url('property?id=').$w->property->id }}"> {{$w->property->localidad}},
                    <br /> {{$w->property->provincia}},
                    <br /> {{$w->property->pais}}</a>
            </h2>
        </div>
        <div class="card-body-a">
            <div class="price-box d-flex">
                <span class="alert-info">{{$w->activeAuction->state()}}</span>
            </div>
            <a href={{ url('week?id=').$w->id }} class="link-a"> Ver semana</a>
            <span class="ion-ios-arrow-forward"></span>
        </div>
        <div class="card-footer-a">
            <ul class="card-info d-flex justify-content-around">
                <li>
                    <h4 class="card-info-title">Fecha</h4>
                    <span>{{$w->fecha}}</span>
                </li>
                <li>
                    <h4 class="card-info-title">Precio inicial</h4>
                    <span>${{$w->activeAuction->precio_inicial}}</span>
                </li>
            </ul>
        </div>
    </div>
</div>