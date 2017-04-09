<h2 class="page-title">Vehículo: <?php echo $oVehiculo->placa ?></h2>
<div class="panel panel-border panel-success">
    <div class="panel panel-heading">
        <h3 class="panel-title">Detalle del vehículo</h3>
    </div>
    <div class="panel-body">
        <a href="/vehiculo/edit/<?php echo $oVehiculo->placa ?>" class="btn btn-primary btn-sm m-b-15 pull-left" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar información del vehículo">Editar</a>
        <br><br><br>
        <div class="form">
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="first_name" class="control-label col-sm-2">Placa:</label>
                    <div class="col-sm-2">
                        <p class="form-control-static"><?php echo $oVehiculo->placa ?></p>
                    </div>
                    <label for="first_name" class="control-label col-sm-1">Año:</label>
                    <div class="col-sm-2">
                        <p class="form-control-static"><?php echo $oVehiculo->anio ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="first_name" class="control-label col-sm-2">Marca:</label>
                    <div class="col-sm-2">
                        <p class="form-control-static"><?php echo $oVehiculo->get_marca() ?></p>
                    </div>
                    <label for="first_name" class="control-label col-sm-1">Modelo:</label>
                    <div class="col-sm-2">
                        <p class="form-control-static"><?php echo $oVehiculo->get_modelo() ?></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="panel panel-border panel-success">
    <div class="panel panel-heading">
        <h3 class="panel-title">Servicios de mantenimiento registrados</h3>
    </div>
    <div class="panel-body">
        <a class="btn btn-primary btn-sm m-b-15 btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Registrar nueva solicitud" data-action="/solicitud/new/<?php echo $oVehiculo->placa ?>" >Registrar solicitud</a>
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th>#Solicitud</th>
                    <th>Servicio</th>
                    <th>Técnico</th>
                    <th>Estado</th>
                    <th>Fecha registro</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aSolicitud as $oSolicitud): ?>
                    <tr>
                        <td><?php echo $oSolicitud->id ?></td>
                        <td><?php echo $oSolicitud->oServicio()->nombre ?></td>
                        <td><?php echo $oSolicitud->oTecnico()->fullName() ?></td>
                        <td><span class="label <?php echo $oSolicitud->get_estado_label() ?>"><?php echo $oSolicitud->get_estado() ?></span></td>
                        <td><?php echo Util::date_format_text($oSolicitud->created_at) ?></td>
                        <td>
                            <a href="/solicitud/detail/<?php echo $oSolicitud->id ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver detalle de mantenimiento">Ver más</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>