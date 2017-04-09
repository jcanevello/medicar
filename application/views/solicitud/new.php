<form class="cmxform form-horizontal tasi-form" id="commentForm" method="POST" action="/solicitud/new/<?php echo $oVehiculo->placa ?>">
    <div class="form-group">
        <label for="first_name" class="control-label col-sm-4">Servicio General:</label>
        <div class="col-sm-6">
            <select name="serviciog_id" class="form-control" required="required">
                <?php foreach ($aServicioG as $oServicioG): ?>
                    <option value="<?php echo $oServicioG->id ?>"><?php echo $oServicioG->nombre ?> - S/. <?php echo $oServicioG->precio ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">Servicio Especial:</label>
        <div class="col-sm-6">
            <select name="servicioe_id" class="form-control">
                <option value="">Ninguno</option>
                <?php foreach ($aServicioE as $oServicioE): ?>
                    <option value="<?php echo $oServicioE->id ?>"><?php echo $oServicioE->nombre ?> - S/. <?php echo $oServicioE->precio ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">Personal Técnico:</label>
        <div class="col-sm-6">
            <select name="mecanico_id" class="form-control" required="required">
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