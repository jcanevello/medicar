<form class="cmxform form-horizontal tasi-form" id="commentForm" method="POST" action="/user/new">
    <div class="form-group">
        <label for="profile" class="control-label col-lg-4">Perfil:</label>
        <div class="col-lg-6">
            <select class="form-control" id="profile" name="profile_id" aria-required="true" required="required">
                <option value="">Selecciona una opción</option>
                <?php foreach ($aProfile as $oProfile): ?>
                    <option value="<?php echo $oProfile->id ?>"><?php echo $oProfile->name ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="first_name" class="control-label col-sm-4">Nombre:</label>
        <div class="col-sm-6">
            <input class="form-control" id="first_name" type="text" name="name" required="required">
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">Apellidos:</label>
        <div class="col-sm-6">
            <input class="form-control" id="second_last_name" type="text" name="last_name" required="required">
        </div>
    </div>
    <div class="form-group">
        <label for="second_last_name" class="control-label col-sm-4">Username:</label>
        <div class="col-sm-6">
            <input class="form-control" id="second_last_name" type="text" name="username" required="required">
        </div>
    </div>
    <input class="hidden" value="<?php echo $token ?>" name="token">
    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-8">
            <button class="btn btn-success waves-effect waves-light" type="submit">Guardar</button>
            <a href="#" class="btn btn-default waves-effect" data-dismiss="modal" >Cancelar</a>
        </div>
    </div>
</form>