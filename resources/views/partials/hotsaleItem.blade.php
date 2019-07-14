<div class="img-box-a wow fadeInUp" data-wow-duration="1.5">
    @if($h->week->property->image_path == null)
        <img src="{{'https://via.placeholder.com/683x1024?text='.$w->property->nombre}}" alt="" class="img-a img-fluid">
    @else
        <img src="{{asset($h->week->property->image_path)}}" alt="" class="img-a img-fluid">
    @endif
</div>
<div class="card-overlay">
    <div class="text-sm-center">
        <h4 class="text-info">{{$h->week->property->nombre}}</h4>
    </div>
    <div class="price-box d-flex float-right">
        <div class="price-box d-flex float-right">
            <h2 class="stars-text">{{ $h->week->property->estrellas }}<i class="fas fa-star fa-fw star"></i></h2>
        </div>
    </div>
    <p class="text-hotsale"><i class="fas fa-fire fa-fw fa-4x color-d"></i>HotSale</p>
    <div class="card-overlay-a-content">
        <div class="card-header-a">
            <h2 class="card-title-a">
                <a href="{{ url('property?id=').$h->week->property->id }}"> {{$h->week->property->localidad}},
                    <br /> {{$h->week->property->provincia}},
                    <br /> {{$h->week->property->pais}}</a>
            </h2>
        </div>
        <div class="card-body-a">
            <a href={{ url('hotsale-week?id=').$h->id }} class="link-a"> Ver semana</a>
            <span class="ion-ios-arrow-forward" style="color: white"></span>
        </div>
        <div class="card-footer-a">
            <ul class="card-info d-flex justify-content-around">
                <li>
                    <h4 class="card-info-title">Fecha</h4>
                    <span>{{$h->week->fecha}}</span>
                </li>
                <li>
                    <h4 class="card-info-title">Precio</h4>
                    <span>${{$h->precio}}</span>
                </li>
            </ul>
        </div>
    </div>
</div>