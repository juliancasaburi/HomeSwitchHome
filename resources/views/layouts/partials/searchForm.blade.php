<div class="click-closed"></div>
<!--/ Form Search Start /-->
<div class="box-collapse">
    <div class="title-box-d">
        <h3 class="title-d">Buscar estadías</h3>
    </div>
    <span class="close-box-collapse right-boxed ion-ios-close"></span>
    <div class="box-collapse-wrap form">
        <form class="form-a" action="{{url('weeks')}}" method="get">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="searchLocalidad">Localidad</label>
                        <select id="searchLocalidad" class="form-control input-sm" name="searchLocalidad" required>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="semanaDesde">Desde</label>
                        <input type="date" name="semanaDesde" class="form-control form-control-lg form-control-a" id="semanaDesde" min="{{ Carbon\Carbon::now()->addMonths(6)->startOfWeek()->toDateString() }}" max="{{ Carbon\Carbon::now()->addMonths(8)->startOfWeek()->toDateString() }}" value="{{ Carbon\Carbon::now()->addMonths(6)->startOfWeek()->toDateString() }}">
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="semanaHasta">Hasta</label>
                        <input type="date" name="semanaHasta" class="form-control form-control-lg form-control-a" id="semanaHasta" min="{{ Carbon\Carbon::now()->addMonths(6)->startOfWeek()->toDateString() }}" max="{{ Carbon\Carbon::now()->addMonths(8)->startOfWeek()->toDateString() }}" value="{{ Carbon\Carbon::now()->addMonths(6)->startOfWeek()->toDateString() }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-b" name="botonBuscar">Buscar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--/ Form Search End /-->