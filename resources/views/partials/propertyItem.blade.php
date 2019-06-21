<div class="img-box-a">
    <img src="{{asset($p->image_path)}}" alt="" class="img-a img-fluid">
</div>
<div class="card-overlay">
    <div class="text-sm-center">
        <h4 class="text-info">{{$p->nombre}}</h4>
    </div>
    <div class="price-box d-flex float-right">
        <h2 class="stars-text">{{ $p->estrellas }}<i class="fas fa-star fa-fw star"></i></h2>
    </div>
    <div class="card-overlay-a-content">
        <div class="card-header-a">
            <h2 class="card-title-a">
                <a href="{{ url('property?id=').$p->id }}"> {{$p->localidad}},
                    <br /> {{$p->provincia}},
                    <br /> {{$p->pais}}</a>
            </h2>
        </div>
        <div class="card-body-a">
            <div class="price-box d-flex">
                @switch($weeks)
                    @case(0)
                    <span class="alert-danger">0 subastas en inscripción</span>
                    @break
                    @case(1)
                    <span class="alert-info">1 subasta en inscripción</span>
                    @break
                    @default
                    <span class="alert-info">{{ $weeks }} subastas en inscripción</span>
                    @break
                @endswitch
            </div>
            <a href={{ url('property?id=').$p->id }} class="link-a"> Ver info y semanas</a>
            <span class="ion-ios-arrow-forward"></span>
        </div>
        <div class="card-footer-a">
            <ul class="card-info d-flex justify-content-around">
                <li>
                    <h4 class="card-info-title">Capacidad</h4>
                    <span>{{$p->capacidad}}</span>
                </li>
                <li>
                    <h4 class="card-info-title">Habitaciones</h4>
                    <span>{{$p->habitaciones}}</span>
                </li>
            </ul>
        </div>
    </div>
</div>