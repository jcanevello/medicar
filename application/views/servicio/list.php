<div class="panel panel-default panel-fill">
    <div class="panel-heading">
        <h3>Servicios</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary btn-sm m-b-15 btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Nuevo servicio" data-action="/servicio/new">Nuevo servicio</a>
                <table class="table table-hover table-custom">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Tipo</th>
                            <th>Garantía(meses)</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aServicio as $oServicio): ?>
                            <tr>
                                <td><?php echo $oServicio->nombre ?></td>
                                <td>S/. <?php echo $oServicio->precio ?></td>
                                <td><?php echo $oServicio->get_tipo() ?></td>
                                <td><?php echo (empty($oServicio->tiempo_garantia)) ? 0 : $oServicio->tiempo_garantia ?></td>
                                <td><span class="label <?php echo $oServicio->get_estado_label() ?>"><?php echo $oServicio->get_estado() ?></span></td>
                                <td><a href="#" class="btn btn-success btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Editar servicio" data-action="/servicio/edit/<?php echo $oServicio->id ?>">Editar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>