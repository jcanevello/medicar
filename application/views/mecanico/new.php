<form class="cmxform form-horizontal tasi-form" id="commentForm" method="POST" action="/mecanico/new">
    <div class="form-group">
        <label for="first_name" class="control-label col-sm-4">Nombres:</label>
        <div class="col-sm-6">
            <input class="form-control" id="first_name" type="text" name="nombre" required="required">
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">Apellidos:</label>
        <div class="col-sm-6">
            <input class="form-control" id="second_last_name" type="text" name="apellidos" required="required">
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">edad:</label>
        <div class="col-sm-6">
            <input class="form-control" id="second_last_name" type="text" name="edad" required="required">
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">DNI:</label>
        <div class="col-sm-6">
            <input class="form-control" id="second_last_name" type="text" name="dni" required="required">
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-8">
            <button class="btn btn-success waves-effect waves-light" type="submit">Guardar</button>
            <a href="#" class="btn btn-default waves-effect" data-dismiss="modal" >Cancelar</a>
        </div>
    </div>
</form>