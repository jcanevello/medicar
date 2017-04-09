<form class="cmxform form-horizontal tasi-form" id="commentForm" method="POST" action="/servicio/edit/<?php echo $oServicio->id ?>">
    <div class="form-group">
        <label for="first_name" class="control-label col-sm-4">Nombre:</label>
        <div class="col-sm-6">
            <input class="form-control" id="first_name" type="text" name="nombre" required="required" value="<?php echo $oServicio->nombre ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">Precio:</label>
        <div class="col-sm-6">
            <input class="form-control" id="second_last_name" type="text" name="precio" required="required"  value="<?php echo $oServicio->precio ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">Tipo:</label>
        <div class="col-sm-6">
            <select name="estado" required="required" class="form-control">
                <option value="1" <?php echo ($oServicio->tipo == 1) ? 'selected' : null ?>>General</option>
                <option value="2" <?php echo ($oServicio->tipo == 2) ? 'selected' : null ?>>Especial</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">Tiempo de garantía(meses):</label>
        <div class="col-sm-6">
            <input class="form-control" id="second_last_name" type="number" name="tiempo_garantia"  value="<?php echo $oServicio->tiempo_garantia ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">Estado:</label>
        <div class="col-sm-6">
            <select name="estado" required="required" class="form-control">
                <option value="1" <?php echo ($oServicio->estado == 1) ? 'selected' : null ?>>Activo</option>
                <option value="2" <?php echo ($oServicio->estado == 2) ? 'selected' : null ?>>Inactivo</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-8">
            <button class="btn btn-success waves-effect waves-light" type="submit">Guardar</button>
            <a href="#" class="btn btn-default waves-effect" data-dismiss="modal" >Cancelar</a>
        </div>
    </div>
</form>