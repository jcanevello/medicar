<h2 class="page-title">Detalle de Boleta N°: <?php echo str_pad($oBoleta->num_boleta, 6, "0", STR_PAD_LEFT) ?></h2>
<div class="panel panel-border panel-success">
    <div class="panel panel-heading">
        <h3 class="panel-title">Detalle</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div col-sm-12>
                <div style="border: 1px solid #006699; border-radius: 6px;background: #ffffff; padding: 5px; display: table;">
                    <div style="width: 360px; display: inline-block;">
                        <span style="    font-weight: bold;
                              color: #484c8a;
                              font-size: 40px;">MEDICAR</span>
                        <span style="display: block; color: #484c8a; font-size: 10px; font-family: Arial; margin-bottom: -4px;">E-mail: consultas@medicar.com</span>
                        <span style="display: block; color: #484c8a; font-size: 10px; font-family: Arial; margin-bottom: -4px;">Telf.: 01 359-0858 / Celular: 923815297</span>
                        <span style="display: block; color: #484c8a; font-size: 10px; font-family: Arial; margin-bottom: -4px;">Dirección Av. Nicolás Arriola 960 - La Victoria</span>
                    </div>
                    <div style="display: inline-block; width: 177px; position: relative; bottom: 0px;margin-right: 15px;">
                        <label style="color: #484c8a; font-size: 16px; font-weight: bold; text-align: center; display: block;margin-bottom: 0px;">BOLETA</label>
                        <div style="border-radius: 6px; border: 1px solid #484c8a; width: 100%; padding: 5px; text-align: center; margin-bottom: 5px;">
                            <span style="font-weight: bold; color: red;">N° <?php echo str_pad($oBoleta->num_boleta, 6, "0", STR_PAD_LEFT) ?></span>
                        </div>
                        <div style="border: 1px solid #484c8a; border-radius: 6px;">
                            <div style="background: #484c8a; color: #FFFFFF;">
                                <div style="display: inline-block; width: 55px; text-align: center;"><span>DÍA</span></div>
                                <div style="display: inline-block; width: 55px; text-align: center;"><span>MES</span></div>
                                <div style="display: inline-block; width: 55px; text-align: center;"><span>AÑO</span></div>
                            </div>
                            <div style="border-top: 1px solid #484c8a; margin-top: 1px;">
                                <div style="display: inline-block; width: 55px; text-align: center;"><span><?php echo date('d', strtotime($oBoleta->created_at)) ?></span></div>
                                <div style="display: inline-block; width: 55px; text-align: center; border-right: 1px solid #484c8a; border-left: 1px solid #484c8a;"><span><?php echo date('m', strtotime($oBoleta->created_at)) ?></span></div>
                                <div style="display: inline-block; width: 55px; text-align: center;"><span><?php echo date('y', strtotime($oBoleta->created_at)) ?></span></div>
                            </div>
                        </div>
                    </div>
                    <span style="display: block; color: #484c8a; font-size: 20px; font-family: Arial; margin-bottom: -4px; font-weight: bold; text-align: right;    margin-top: 10px;
                          margin-right: 15px;">R.U.C. 30254985522</span>
                    <table style="width: 100%; margin-top: 20px; margin-bottom: 20px;">
                        <tr>
                            <td colspan="4">
                                <span style="color: #484c8a; width: 95px; display: inline-block; margin-bottom: 10px;">Client: </span>
                                <span style="border-bottom: 1px solid #484c8a; border-bottom-style: dashed; display: inline-block; width: 436px;"><?php echo $oBoleta->nombre ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <span style="color: #484c8a; width: 95px; display: inline-block; margin-bottom: 10px;">N° Solicitud: </span>
                                <span style="border-bottom: 1px solid #484c8a; border-bottom-style: dashed; display: inline-block; width: 436px;"><?php echo $oSolicitud->id ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <span style="color: #484c8a; width: 95px; display: inline-block; margin-bottom: 20px;">Placa: </span>
                                <span style="border-bottom: 1px solid #484c8a; border-bottom-style: dashed; display: inline-block; width: 436px;"><?php echo $oSolicitud->placa ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"style="text-align: center;border: 1px solid #484c8a;">
                                <span style="color: #484c8a; font-weight: bold; text-align: center;">POR CONCEPTO DE:</span>
                            </td>
                            <td style="border: 1px solid #484c8a;text-align: center">
                                <span style="color: #484c8a; font-weight: bold; text-align: right;">S/.</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="width: 250px; color: #484c8a; text-align: center;border: 1px solid #484c8a;padding: 10px;">
                                <span>Servicio General <?php echo $oServicioG['nombre'] ?></span>
                            </td>
                            <td style="color: #484c8a; width: 136px;border: 1px solid #484c8a;text-align: right;padding: 10px;">
                                <span><?php echo number_format($oServicioG['precio'], 2) ?></span></td>
                        </tr>
                        <?php if (!empty($oServicioE)): ?>
                            <tr>
                                <td colspan="3" style="width: 250px; color: #484c8a; text-align: center;border: 1px solid #484c8a;padding: 10px;">
                                    <span>Servicio Especial <?php echo $oServicioE['nombre'] ?></span>
                                </td>
                                <td style="color: #484c8a; width: 136px;border: 1px solid #484c8a;text-align: right;padding: 10px;">
                                    <span><?php echo number_format($oServicioE['precio'], 2) ?></span></td>
                            </tr>
                        <?php endif ?>
                        <tr>
                            <td> </td>
                            <td style="color: #484c8a;"></td>
                            <td><span style="padding: 10px;color: #484c8a; text-align: right; display: block; font-size: 20px;font-weight: bold;margin-right: 10px;">TOTAL:</span></td>
                            <td style="color: #484c8a; width: 136px;text-align: right;padding: 10px;">
                                <span style="color: #484c8a; text-align: right; display: block; font-size: 20px;font-weight: bold;margin-right: 0px;"><?php echo number_format($monto, 2) ?></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>