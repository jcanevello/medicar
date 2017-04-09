<form class="cmxform form-horizontal tasi-form" id="commentForm" method="POST" action="/servicio/new">
    <div class="form-group">
        <label for="first_name" class="control-label col-sm-4">Nombre:</label>
        <div class="col-sm-6">
            <input class="form-control" id="first_name" type="text" name="nombre" required="required">
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">Precio:</label>
        <div class="col-sm-6">
            <input class="form-control" id="second_last_name" type="number" name="precio" required="required">
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">Tipo de Servicio:</label>
        <div class="col-sm-6">
            <select class="form-control" name="tipo" required="required">
                <option value="1">General</option>
                <option value="2">Especial</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">Tiempo de garantía(meses):</label>
        <div class="col-sm-6">
            <input class="form-control" id="second_last_name" type="number" name="tiempo_garantia" >
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-8">
            <button class="btn btn-success waves-effect waves-light" type="submit">Guardar</button>
            <a href="#" class="btn btn-default waves-effect" data-dismiss="modal" >Cancelar</a>
        </div>
    </div>
</form>