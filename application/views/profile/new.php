<div class="panel panel-default panel-fill">
    <div class="panel-heading">
        <h3><a href="/profile">Perfiles</a></h3>
        <h3 class="panel-title"><?php echo $oProfile->name ?></h3>
    </div>
    <div class="panel-body">
        <div class="form">
            <form class="cmxform form-horizontal tasi-form" id="commentForm" method="POST" action="" novalidate="novalidate">
                <div class="form-group">
                    <label for="name" class="control-label col-lg-2">Nombre:</label>
                    <div class="col-lg-2">
                        <input class="form-control" id="name" type="text" name="name" aria-required="true" required="" value="<?php echo $oProfile->name ?>">
                    </div>
                </div>
                <?php if ($oProfile->loaded()): ?>
                    <div class="form-group">
                        <label for="name" class="control-label col-lg-2">Estado:</label>
                        <div class="col-lg-2">
                            <select class="form-control select-selected" data-info='<?php echo json_encode($aStatus) ?>' data-selected="<?php echo ($oProfile->loaded()) ? $oProfile->status : 1 ?>" name="status"></select>
                        </div>
                    </div>
                <?php endif ?>
                <div class="form-group">
                    <label class="control-label col-lg-2">Permisos:</label>
                    <div class="col-sm-offset-2 col-lg-10">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Permiso</th>
                                    <th>Controlador</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($aAction as $oAction): ?>
                                    <tr>
                                        <td>
                                            <input id="checkbox<?php echo $oAction->id ?>" type="checkbox" name="permit[]" value="<?php echo $oAction->id ?>" <?php echo $oProfile->isSelectedAction($oAction->id) ? 'checked' : NULL ?>>
                                        </td>
                                        <td>
                                            <label for="checkbox<?php echo $oAction->id ?>"><?php echo $oAction->name ?></label>
                                        </td>
                                        <td><?php echo $oAction->controller ?></td>
                                        <td><?php echo $oAction->action ?></td>
                                    </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-success waves-effect waves-light" type="submit">Guardar</button>
                        <a href="/profile" class="btn btn-default waves-effect">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
        <!-- .form -->
    </div>
    <!-- panel-body -->
</div>