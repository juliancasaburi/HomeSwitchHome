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
                        <label for="semana">Semana</label>
                        <input type="date" class="form-control form-control-lg form-control-a" id="semana">
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="inscripcion_inicio">Inscripcion desde</label>
                        <input type="date" class="form-control form-control-lg form-control-a" id="inscripcion_inicio">
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="inscripcion_hasta">Inscripcion hasta</label>
                        <input type="date" class="form-control form-control-lg form-control-a" id="inscripcion_hasta">
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