<div class="panel panel-default panel-fill">
    <div class="panel-heading">
        <h3>Mecánicos</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary btn-sm m-b-15 btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Nuevo mecánico" data-action="/mecanico/new">Nuevo mecánico</a>
                <table class="table table-hover table-custom">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>DNI</th>
                            <th>Edad</th>
                            <th>Estado</th>
                            <th>Fecha de registro</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aMecanico as $oMecanico): ?>
                            <tr>
                                <td><?php echo $oMecanico->nombre ?></td>
                                <td><?php echo $oMecanico->apellidos ?></td>
                                <td><?php echo $oMecanico->dni ?></td>
                                <td><?php echo $oMecanico->edad ?></td>
                                <td><span class="label <?php echo $oMecanico->get_estado_label() ?>"><?php echo $oMecanico->get_estado() ?></span></td>
                                <td><?php echo $oMecanico->created_at ?></td>
                                <td><a href="#" class="btn btn-success btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Editar mecánico" data-action="/mecanico/edit/<?php echo $oMecanico->id ?>">Editar</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>