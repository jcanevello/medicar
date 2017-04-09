<h4>Detalles del usuario</h4>
<br>
<form class="cmxform form-horizontal tasi-form" id="commentForm" method="POST" action="/user/edit/<?php echo $oUser->id ?>">
    <div class="form-group">
        <label for="profile" class="control-label col-lg-4">Username:</label>
        <div class="col-lg-6">
            <p class="form-control-static form-control-static-custom"><?php echo strtolower($oUser->username) ?></p>
        </div>
    </div>
    <div class="form-group">
        <label for="profile" class="control-label col-lg-4">Perfil:</label>
        <div class="col-lg-6">
            <select class="form-control select-selected" id="profile" name="profile_id" data-info='<?php echo json_encode($aProfile) ?>' data-selected="<?php echo $oUser->profile_id ?>"  aria-required="true" required="required">
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="first_name" class="control-label col-sm-4">Nombre:</label>
        <div class="col-sm-6">
            <input class="form-control" id="first_name" type="text" name="name" required="required" value="<?php echo $oUser->name ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="first_last_name" class="control-label col-sm-4">Apellidos:</label>
        <div class="col-sm-6">
            <input class="form-control" id="first_last_name" type="text" name="last_name" required="required"  value="<?php echo $oUser->last_name ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="sede" class="control-label col-sm-4">Estado:</label>
        <div class="col-sm-6">
            <select class="form-control select-selected" name="status" data-info='<?php echo json_encode($aStatus) ?>' data-selected='<?php echo $oUser->status ?>' required="required">
            </select>
        </div>
    </div>
<!--    <div class="form-group">
        <label for="sede" class="control-label col-sm-4">Contraseña:</label>
        
        <div class="col-sm-6">
          <a class="btn btn-primary btn-sm m-t-5 m-b-30 btn-modal-global" data-toggle="modal" data-target="#modal-global" data-title="Cambiar contraseña" data-action="/user/password_reset/<?php // echo $oUser->id ?>">Cambiar contraseña</a>
        </div>
    
    </div>-->
    <input class="hidden" value="<?php echo $token ?>" name="token">
    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-8">
            <button class="btn btn-success waves-effect waves-light" type="submit">Actualizar detalles</button>
        </div>
    </div>
</form>