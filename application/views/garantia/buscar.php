<div class="panel panel-border panel-primary">
    <div class="panel panel-heading">
        <h3 class="panel-title">Buscar Garantía</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form" action="" method="POST">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Ingrese el numero de solicitud de mantenimiento: </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="num_solicitud" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-0">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <?php if (!empty($mensaje)): ?>
                    <p><?php echo $mensaje ?></p>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>




