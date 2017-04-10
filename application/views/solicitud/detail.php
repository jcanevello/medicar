<h2 class="page-title"><a href="/vehiculo/detail/<?php echo $oVehiculo->placa ?>">Vehículo: <?php echo $oVehiculo->placa ?></a> / Solicitud N° <?php echo $oSolicitud->id ?></h2>
<div class="panel panel-border panel-success">
    <div class="panel panel-heading">
        <h3 class="panel-title">Detalle del vehículo</h3>
    </div>
    <div class="panel-body">
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
        <h3 class="panel-title">Detalle de solicitud N° <?php echo $oSolicitud->id ?></h3>
    </div>
    <div class="panel-body">
        <div class="panel-body">
            <div class="form">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="first_name" class="control-label col-sm-2">Nª Solicitud:</label>
                        <div class="col-sm-2">
                            <p class="form-control-static"><?php echo $oSolicitud->id ?></p>
                        </div>
                        <label for="first_name" class="control-label col-sm-2">Servicio Genérico:</label>
                        <div class="col-sm-2">
                            <p class="form-control-static"><?php echo $oSolicitud->oServicio()->nombre ?></p>
                        </div>
                        <label for="first_name" class="control-label col-sm-2">Servicio Especial:</label>
                        <div class="col-sm-2">
                            <p class="form-control-static"><?php echo $oSolicitud->oServicioE()->nombre ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first_name" class="control-label col-sm-2">Estado:</label>
                        <div class="col-sm-2">
                            <p class="form-control-static"><span class="label <?php echo $oSolicitud->get_estado_label() ?>"><?php echo $oSolicitud->get_estado() ?></span></p>
                        </div>
                        <label for="first_name" class="control-label col-sm-2">Fecha de registro:</label>
                        <div class="col-sm-2">
                            <p class="form-control-static"><?php echo Util::date_format_text($oSolicitud->created_at) ?></p>
                        </div>
                        <label for="first_name" class="control-label col-sm-2">Técnico:</label>
                        <div class="col-sm-2">
                            <p class="form-control-static"><?php echo $oSolicitud->oTecnico()->fullName() ?></p>
                        </div>
                    </div>
                </form>
                <?php if ($oSolicitud->estado == 1): ?>
                    <a class="btn btn-inverse btn-sm m-b-10 btn-modal-global pull-right" data-toggle="modal" data-target="#modal-global" data-title="Cancelar Solicitud" data-action="/solicitud/cerrar/<?php echo $oSolicitud->id ?>" >Cancelar solicitud</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-border panel-success">
    <div class="panel panel-heading">
        <h3 class="panel-title">Trabajos de garantía</h3>
    </div>
    <div class="panel-body">
        <div class="panel-body">
            <?php if ($oGarantia->estado == 1): ?>
                <a class="btn btn-primary btn-sm m-b-10 btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Registrar trabajo de garantía" data-action="/garantia/nuevo/<?php echo $oSolicitud->id ?>" >Registrar trabajo de garantía</a>
            <?php endif ?>
            <div class="form-horizontal">
                <div class="form-group">
                    <label for="first_name" class="control-label col-sm-3">Fecha Vencimiento de garantía:</label>
                    <div class="col-sm-3">
                        <p class="form-control-static"><?php echo Util::date_format_text($oGarantia->f_final) ?></p>
                    </div>
                    <label for="first_name" class="control-label col-sm-3">Estado:</label>
                    <div class="col-sm-3">
                        <p class="form-control-static"><span class="label <?php echo $oGarantia->get_estado_label() ?>"><?php echo $oGarantia->get_estado() ?></span></p>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Fecha registro</th>
                        <th>Técnico</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aGarantiaM as $oGarantiaM): ?>
                        <tr>
                            <td><?php echo Util::date_format_text($oGarantiaM->created_at) ?></td>
                            <td><?php echo $oGarantiaM->oTecnico()->fullName() ?></td>
                            <td><span class="label <?php echo $oGarantiaM->get_estado_label() ?>"><?php echo $oGarantiaM->get_estado() ?></span></td>
                            <td>
                                <?php if ($oGarantiaM->estado == 1): ?>
                                    <a class="btn btn-inverse btn-sm m-b-10 btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Cancelar" data-action="/garantia/cancelar/<?php echo $oGarantiaM->id ?>" >Cancelar</a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>