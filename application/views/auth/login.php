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
        <link href="/media/css/components.css" rel="stylesheet" type="text/css">
        <link href="/media/css/pages.css" rel="stylesheet" type="text/css">
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
                    <h3 class="text-center m-t-10 text-white"><strong>MEDICAR</strong></h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" id="form-login" action="/login" method="POST">
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error ?></div>
                        <?php endif ?>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" type="text" required="" name="username" placeholder="Usuario">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control input-lg" type="password" required="" name="password" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="form-group text-center m-t-40">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-block btn-lg w-lg waves-effect waves-light" type="submit">Ingresar</button>
                            </div>
                        </div>
                        <?php if (!empty($referrer)): ?>
                            <input class="hidden" value="<?php echo $referrer ?>" name="referrer">
                        <?php endif ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- Main  -->
    </body>
    <!-- Mirrored from moltran.coderthemes.com/dark/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 21 Jan 2016 04:16:00 GMT -->

</html>