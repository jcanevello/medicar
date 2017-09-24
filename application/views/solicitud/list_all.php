<div class="panel panel-border panel-info">
    <div class="panel panel-heading">
        <h3>Lista de mantenimientos</h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                    <td>N° Solicitud</td>
                    <td>Servicio</td>
                    <td>Placa</td>
                    <td>Precio</td>
                    <td>Fecha</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aSolicitudes as $oSolicitudes): ?>
                    <tr>
                        <?php $oserv = $oSolicitudes->oServicio2() ?>
                        <td><a href="/solicitud/detail/<?php echo $oSolicitudes->placa ?>"><?php echo $oSolicitudes->id ?></a></td>
                        <td><?php echo $oserv['nombre'] ?></td>
                        <td><?php echo $oSolicitudes->placa ?></td>
                        <td><?php echo $oserv['precio'] ?></td>
                        <td><?php echo Util::date_format_text($oSolicitudes->created_at) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>