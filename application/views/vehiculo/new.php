<div class="panel panel-border panel-success">
    <div class="panel panel-heading">
        <h3 class="panel-title">Registrar auto</h3>
    </div>
    <div class="panel-body">
        <form class="cmxform form-horizontal tasi-form" id="commentForm" method="POST" action="">
            <div class="form-group">
                <label for="first_name" class="control-label col-sm-2">Placa:</label>
                <div class="col-sm-1">
                    <input class="form-control" id="first_name" type="text" name="parte1" maxlength="3" required="">
                </div>
                <div class="col-sm-1">
                    <input class="form-control" id="first_name" type="text" name="parte2" maxlength="3" required="">
                </div>
            </div>
            <div class="form-group">
                <label for="second_last_name" class="control-label col-sm-2">Marca:</label>
                <div class="col-sm-4">
                    <select class="form-control select-selected select-parent3" data-info='<?php echo json_encode($aMarca) ?>' data-action="/vehiculo/get_modelo" data-childid="id_modelo" id="" required=""></select>
                </div>
            </div>
            <div class="form-group">
                <label for="second_last_name" class="control-label col-sm-2">Modelo:</label>
                <div class="col-sm-4">
                    <select class="form-control select-selected" id="id_modelo" name="modelo_id" required=""></select>
                </div>
            </div>
            <div class="form-group">
                <label for="first_name" class="control-label col-sm-2">Año:</label>
                <div class="col-sm-4">
                    <select class="form-control" name="anio" required="required">
                        <?php for ($i = (int)date('Y'); $i >= 1970; $i--): ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-4">
                    <button class="btn btn-success waves-effect waves-light" type="submit">Guardar</button>
                    <!--<a href="#" class="btn btn-default waves-effect" data-dismiss="modal" >Cancelar</a>-->
                </div>
            </div>
        </form>
    </div>
</div>
