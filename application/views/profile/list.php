<div class="panel panel-default panel-fill">
    <div class="panel-heading">
        <h3>Perfiles</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aProfile as $oProfile): ?>
                            <tr>
                                <td><?php echo $oProfile->name ?></td>
                                <td><?php echo $oProfile->status() ?></td>
                                <td>
                                    <a href="/profile/edit/<?php echo $oProfile->id ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" data-original-title="Editar información"><i class="md md-edit"></i></a>
                                    <!--<a href="/configuration/delete/<?php // echo $oElement->id  ?>/<?php // echo $tabla  ?>" class="btn btn-danger"><i class="md md-clear"></i></a>-->
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>