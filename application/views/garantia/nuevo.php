<form class="form-horizontal" action="/garantia/nuevo/<?php echo $oSolicitud->id ?>" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-4">Personal Técnico:</label>
        <div class="col-sm-8">
            <select name="tecnico_id" class="form-control">
                <?php foreach ($aTecnico as $oTecnico): ?>
                    <option value="<?php echo $oTecnico->id ?>"><?php echo $oTecnico->fullName() ?></option>
                <?php endforeach ?>
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