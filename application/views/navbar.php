<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="user-details">
            <div class="pull-left"><img src="/media/images/users/avatar-1.jpg" alt="" class="thumb-md img-circle"></div>
            <div class="user-info">
                <div class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $oUser->fullName() ?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/logout"><i class="md md-settings-power"></i> Cerrar Sesión</a></li>
                    </ul>
                </div>
                <p class="text-muted m-0"><?php echo $oUser->oProfile->name ?></p>
            </div>
        </div>
        <!--- Divider -->
        <div id="sidebar-menu" class="hidden">
            <ul>
                <li class="">
                    <a href="/vehiculo/new" class="waves-effect waves-light">
                        <i class="md md-directions-car"></i>
                        Registrar Auto
                    </a>
                </li>
                <li class="">
                    <a href="/boleta/buscarservicios/" class="waves-effect waves-light">
                        <i class="md md-attach-money"></i>
                        Caja
                    </a>
                </li>
                <li class="">
                    <a href="/garantia/buscar" class="waves-effect waves-light">
                        <i class="md md-star"></i>
                        Garantía
                    </a>
                </li>
                <li class="has_sub"><a href="#" class="waves-effect waves-light"><i class="md md-settings"></i> <span>Configuración</span> <span class="pull-right"><i class="md md-add"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="/marca">Marcas y modelos de automoviles</a></li>
                        <li><a href="/servicio">Servicios</a></li>
                        <li><a href="/mecanico">Mecánicos</a></li>
                        <li><a href="/user">Usuarios</a></li>
                        <li><a href="/profile">Perfiles</a></li>
                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>