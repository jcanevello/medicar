<div class="panel panel-default panel-fill">
    <div class="panel-heading">
        <h3><a href="/user">Usuarios</a></h3>
        <h3 class="panel-title"><?php echo $oUser->fullName() ?> <i>(<?php echo $oUser->oProfile->name?>)</i></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-3">
                <h5>General</h5>
                <div class="list-group list-group-custom">
                    <a href="#" class="list-group-item">Detalles del usuario</a> 
                </div>
            </div>
            <div class="col-sm-9">
                <?php echo $content_user ?>
            </div>
        </div>
    </div>
</div>
