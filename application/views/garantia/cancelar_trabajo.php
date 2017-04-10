<form class="form-horizontal" action="/garantia/cancelar/<?php echo $oGarantiaM->id ?>" method="POST">
    <div class="form-group">
        <div class="col-sm-12">
            <p class="form-control-static">¿Estás seguro de cancelar el trabajo?</p>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-8">
            <button class="btn btn-success waves-effect waves-light" type="submit">Si</button>
            <a href="#" class="btn btn-default waves-effect" data-dismiss="modal" >No</a>
        </div>
    </div>
</form>