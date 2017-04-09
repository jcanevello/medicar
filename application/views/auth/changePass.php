<!DOCTYPE html>
<html>
<!-- Mirrored from moltran.coderthemes.com/dark/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Jan 2016 04:16:00 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <link rel="shortcut icon" href="/media/images/favicon_1.ico">
    <title>Progresa</title>
    <link href="/media/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/media/css/core.css" rel="stylesheet" type="text/css">
    <link href="/media/css/icons.css" rel="stylesheet" type="text/css">
    <link href="/media/css/components.css" rel="stylesheet" type="text/css">
    <link href="/media/css/pages.css" rel="stylesheet" type="text/css">
    <link href="/media/css/menu.css" rel="stylesheet" type="text/css">
    <link href="/media/css/responsive.css" rel="stylesheet" type="text/css">
    <!--<script src="/media/js/modernizr.min.js"></script>-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>

<body>
    <div class="wrapper-page">
        <div class="panel panel-color panel-primary panel-pages">
            <div class="panel-heading bg-img">
                <div class="bg-overlay"></div>
                <h3 class="text-center m-t-10 text-white">Cambio de Contraseña</h3></div>
            <div class="panel-body">
                <form class="form m-t-20" action="" method="POST">
                    <?php if(!empty($error)): ?>
                    <p class="text-danger">
                        <?php foreach ($error as $value): ?>
                        <span><?php echo $value ?></span><br>
                        <?php endforeach ?>
                    </p>
                    <?php endif ?>
                    <div class="form-group">
                        <label>Nueva Contraseña</label>
                        <input class="form-control input-lg" type="password" required="" name="pass_nuevo">
                        <p class="help-block"> Mínimo 10 caracteres entre mayúscula, minúscula, números y caracteres no alfanuméricos.</p>
                    </div>
                    <div class="form-group">
                        <label>Repetir nueva contraseña</label>
                        <input class="form-control input-lg" type="password" required="" name="pass_nuevo_repetido">
                    </div>
                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="submit">Guardar</button>
                            <a href="/" class="btn btn-default btn-lg w-lg waves-effect waves-light">Cancelar</a>
                            <br><br>
                            <a href="/logout">Cerrar Sesion</a>
                        </div>
                    </div>
                </form>
            </div>
<?php // die('asd') ?>
        </div>
    </div>
    <!-- Main  -->
    <script src="/media/js/jquery.min.js"></script>
    <script src="/media/js/bootstrap.min.js"></script>
    <script src="/media/js/detect.js"></script>
    <script src="/media/js/fastclick.js"></script>
    <script src="/media/js/jquery.slimscroll.js"></script>
    <script src="/media/js/jquery.blockUI.js"></script>
    <script src="/media/js/waves.js"></script>
    <script src="/media/js/wow.min.js"></script>
    <script src="/media/js/jquery.nicescroll.js"></script>
    <script src="/media/js/jquery.scrollTo.min.js"></script>
    <script src="/media/js/jquery.app.js"></script>
</body>
<!-- Mirrored from moltran.coderthemes.com/dark/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Jan 2016 04:16:00 GMT -->

</html>