<form class="cmxform form-horizontal tasi-form" id="commentForm" method="POST" action="/solicitud/cerrar/<?php echo $oSolicitud->id ?>">
    <div class="form-group">
        <div class="col-sm-12">
            <p class="form-control-static">¿Estás seguro de cancelar esta solicitud?</p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-8">
            <button class="btn btn-success waves-effect waves-light" type="submit">Si</button>
            <a href="#" class="btn btn-default waves-effect" data-dismiss="modal" >No</a>
        </div>
    </div>
</form>