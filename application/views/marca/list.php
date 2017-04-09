<div class="panel panel-default panel-fill">
    <div class="panel-heading">
        <h3>Marcas de vehículos</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary btn-sm m-b-15 btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Nueva marca" data-action="/marca/new">Nueva marca</a>
                <table class="table table-hover table-custom">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Origen</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aMarca as $oMarca): ?>
                            <tr>
                                <td><?php echo $oMarca->nombre ?></td>
                                <td><?php echo $oMarca->origen ?></td>
                                <td>
                                    <a href="#" class="btn btn-success btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Editar marca" data-action="/marca/edit/<?php echo $oMarca->id ?>">Editar</a>
                                    <a href="/modelo/list/<?php echo $oMarca->id ?>" class="btn btn-info">Ver Modelos</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>