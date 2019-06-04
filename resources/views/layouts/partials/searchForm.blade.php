<div class="click-closed"></div>
<!--/ Form Search Start /-->
<div class="box-collapse">
    <div class="title-box-d">
        <h3 class="title-d">Buscar estadías</h3>
    </div>
    <span class="close-box-collapse right-boxed ion-ios-close"></span>
    <div class="box-collapse-wrap form">
        <form class="form-a" action="/properties-of-a-specific-day" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="semana">Semana  (Debe ser un Lunes)</label>
                        <input type="date" class="form-control form-control-lg form-control-a" id="semana" name="fecha">
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