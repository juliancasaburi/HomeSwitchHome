<div class="click-closed"></div>
<!--/ Form Search Start /-->
<div class="box-collapse">
    <div class="title-box-d">
        <h3 class="title-d">Buscar propiedades</h3>
    </div>
    <span class="close-box-collapse right-boxed ion-ios-close"></span>
    <div class="box-collapse-wrap form">
        <form class="form-a" action="{{url('properties')}}" method="get">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="Type">Buscar</label>
                        <input type="text" class="form-control form-control-lg form-control-a" placeholder="Ingrese algo aquí">
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="form-group">
                        <label for="fechaDesde">Fecha desde</label>
                        <input type="date" class="form-control form-control-lg form-control-a" id="fechaDesde">
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="pais">País</label>
                        <select class="form-control form-control-lg form-control-a" id="pais">
                            <option>Pais1</option>
                            <option>Pais2</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="provincia">Provincia/Estado</label>
                        <select class="form-control form-control-lg form-control-a" id="provincia">
                            <option>Provincia1</option>
                            <option>Provincia2</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-group">
                        <label for="ciudad">Localidad</label>
                        <select class="form-control form-control-lg form-control-a" id="localidad">
                            <option>Localidad1</option>
                            <option>Localidad2</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="habitaciones">Habitaciones</label>
                        <select class="form-control form-control-lg form-control-a" id="habitaciones">
                            <option>Cualquier cantidad</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="garages">Garages</label>
                        <select class="form-control form-control-lg form-control-a" id="garages">
                            <option>Cualquier cantidad</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="baños">Baños</label>
                        <select class="form-control form-control-lg form-control-a" id="baños">
                            <option>Cualquier cantidad</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="precioMin">Precio Desde</label>
                        <select class="form-control form-control-lg form-control-a" id="precioMin">
                            <option>Sin mínimo</option>
                            <option>$50,000</option>
                            <option>$100,000</option>
                            <option>$150,000</option>
                            <option>$200,000</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="form-group">
                        <label for="precioMax">Precio Hasta</label>
                        <select class="form-control form-control-lg form-control-a" id="precioMax">
                            <option>Sin máximo</option>
                            <option>$50,000</option>
                            <option>$100,000</option>
                            <option>$150,000</option>
                            <option>$200,000</option>
                        </select>
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