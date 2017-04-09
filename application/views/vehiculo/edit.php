<h2 class="page-title">Vehículo: <a href="/vehiculo/detail/<?php echo $oVehiculo->placa ?>"><?php echo $oVehiculo->placa ?></a></h2>
<div class="panel panel-border panel-success">
    <div class="panel panel-heading">
        <h3 class="panel-title">Editar</h3>
    </div>
    <div class="panel-body">
        <form class="cmxform form-horizontal tasi-form form-modal" id="commentForm" method="POST" action="/vehiculo/edit/<?php echo $oVehiculo->placa ?>">
            <div class="form-group">
                <label for="first_name" class="control-label col-sm-3">Placa:</label>
                <div class="col-sm-7">
                    <p class="form-control-static"><?php echo $oVehiculo->placa ?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="second_last_name" class="control-label col-sm-3">Marca:</label>
                <div class="col-sm-7">
                    <select class="form-control select-selected select-parent3" data-info='<?php echo json_encode($aMarca) ?>' data-selected='<?php echo $oVehiculo->oMarca()->id ?>' data-action="/vehiculo/get_modelo" data-childid="id_modelo" required=""></select>
                </div>
            </div>
            <div class="form-group">
                <label for="second_last_name" class="control-label col-sm-3">Modelo:</label>
                <div class="col-sm-7">
                    <select class="form-control select-selected" id="id_modelo" name="modelo_id" data-selected='<?php echo $oVehiculo->modelo_id ?>' required=""></select>
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="control-label col-sm-3">Año:</label>
                <div class="col-sm-7">
                    <select class="form-control" name="anio" required="required">
                        <?php for ($i = (int) date('Y'); $i >= 1970; $i--): ?>
                            <option value="<?php echo $i ?>" <?php echo ($oVehiculo->anio == $i) ? 'selected' : NULL ?>><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-3 col-lg-4">
                    <button class="btn btn-success waves-effect waves-light" type="submit">Guardar</button>
                    <a href="/vehiculo/detail/<?php echo $oVehiculo->placa ?>" class="btn btn-default waves-effect" data-dismiss="modal" >Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>