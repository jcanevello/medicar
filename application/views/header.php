<div class="topbar">
    <?php if (!empty($error->msj)): ?>
        <input class="msj-show hidden" data-type="<?php echo $error->tipo ?>" value="<?php echo $error->msj ?>">
    <?php endif; ?>
    <div class="topbar-left">
        <div class="text-center"><a href="/" class="logo"><i class="md md-terrain"></i> <span>Medicar</span></a></div>
    </div>
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left"><i class="fa fa-bars"></i></button> <span class="clearfix"></span></div>
                <form class="navbar-form pull-left " role="search" action="/vehiculo/search" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control search-bar" placeholder="Buscar por placa" name="placa" required="">
                        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"><img src="/media/images/users/avatar-1.jpg" alt="user-img" class="img-circle"></a>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>