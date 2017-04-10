<div class="panel panel-border panel-info">
    <div class="panel panel-heading">
        <h3>Lista de vehículos registrados</h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                    <td>Placa</td>
                    <td>Marca</td>
                    <td>Modelo</td>
                    <td>Año</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($aVehiculo as $oVehiculo): ?>
                    <tr>
                        <td><a href="/vehiculo/detail/<?php echo $oVehiculo->placa ?>"><?php echo $oVehiculo->placa ?></a></td>
                        <td><?php echo $oVehiculo->get_marca() ?></td>
                        <td><?php echo $oVehiculo->get_modelo() ?></td>
                        <td><?php echo $oVehiculo->anio ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>