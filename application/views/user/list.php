<div class="panel panel-default panel-fill">
    <div class="panel-heading">
        <h3>Usuarios</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary btn-sm m-b-15 btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Nuevo usuario" data-action="/user/new">Nuevo usuario</a>

                <table class="table table-hover table-custom">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aUser as $oUser): ?>
                            <?php if ($oUser->username == 'master') continue ?>
                            <tr>
                                <td><?php echo $oUser->fullName() ?></td>
                                <td><?php echo $oUser->username ?></td>
                                <td><?php echo $oUser->oProfile->name ?></td>
                                <td><?php echo $oUser->status() ?></td>
                                <td>
                                    <a href="/user/detail/<?php echo $oUser->id ?>" class="btn btn-info" data-toggle="tooltip" data-placement="top" data-original-title="Ver Información"><i class="md md-visibility"></i></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>