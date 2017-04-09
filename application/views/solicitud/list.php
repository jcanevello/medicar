<div class="panel panel-default panel-fill">
    <div class="panel-heading">
        <h3><a href="/marca">Marcas</a>/Modelos de <?php echo $oMarca->nombre ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary btn-sm m-b-15 btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Nuevo modelo" data-action="/modelo/new/<?php echo $oMarca->id ?>">Nuevo modelo</a>
                <table class="table table-hover table-custom">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Versión</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aModelo as $oModelo): ?>
                            <tr>
                                <td><?php echo $oModelo->nombre ?></td>
                                <td><?php echo $oModelo->version ?></td>
                                <td>
                                    <a href="#" class="btn btn-success btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Editar modelo" data-action="/modelo/edit/<?php echo $oModelo->id ?>">Editar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>