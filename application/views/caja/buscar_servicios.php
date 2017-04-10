<div class="panel panel-border panel-primary">
    <div class="panel panel-heading">
        <h3 class="panel-title">Buscar servicios realizados</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <form class="form" action="" method="POST">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Ingrese la placa del vehículo: </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="placa" required="required">
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
                <?php if ($result): ?>
                    <?php if (!empty($mensaje)): ?>
                        <p><?php echo $mensaje ?></p>
                    <?php else: ?>
                        <h3>Vehículo <?php echo $placa ?></h3>
                        <h4>Servicios por pagar</h4>
                        <hr>
                        <?php foreach ($aSolicitud as $oSolicitud): ?>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td rowspan="2" style="width: 150px; text-align: center; vertical-align: middle;"><strong>Solicitud N° <?php echo $oSolicitud->id ?></strong></td>
                                        <?php $servicioG = $oSolicitud->oServicio2() ?>
                                        <td style="width: 400px;">Servicio General <?php echo $servicioG['nombre'] ?></td>
                                        <td>S/. <?php echo $servicioG['precio'] ?></td>
                                        <td rowspan="2" style="text-align: left; vertical-align: middle;">
                                            <a href="/boleta/generar/<?php echo $oSolicitud->id ?>" target="_blank" class="btn btn-success btn-lg">Generar Boleta</a>
                                        </td>
                                    </tr>
                                    <?php $servicioE = $oSolicitud->oServicioE2() ?>
                                    <?php if (!empty($servicioE)): ?>
                                        <tr>
                                            <td>Servicio Especial <?php echo $servicioE['nombre'] ?></td>
                                            <td>S/. <?php echo $servicioE['precio'] ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        <?php endforeach ?>
                        <h4>Servicios por garantia</h4>
                        <hr>
                        <?php foreach ($aGarantiaM as $oGarantiaM): ?>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><strong>Servicio General <?php echo $oGarantiaM->oSolicitud()->oServicio2()['nombre'] ?> - S/. 0</strong></td>
                                        <td>
                                            <?php if ($oGarantiaM->estado == 1): ?>
                                                <a class="btn btn-inverse m-b-10 btn-lg btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Terminar" data-action="/garantiamecanico/terminar/<?php echo $oGarantiaM->id ?>" >Terminar trabajo</a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php endforeach ?>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>




