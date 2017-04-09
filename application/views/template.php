<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="shortcut icon" href="/media/images/favicon_1.ico">
        <title>Progresa</title>
        <link href="/media/plugins/nestable/jquery.nestable.css" rel="stylesheet">
        <link href="/media/plugins/notifications/notification.css" rel="stylesheet">
        <link href="/media/plugins/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
        <link href="/media/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
        <link href="/media/plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css" rel="stylesheet" type="text/css">
        <link href="/media/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="/media/plugins/modal-effect/css/component.css" rel="stylesheet">
        <link href="/media/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="/media/css/core.css" rel="stylesheet" type="text/css">
        <link href="/media/css/icons.css" rel="stylesheet" type="text/css">
        <link href="/media/css/components.css" rel="stylesheet" type="text/css">
        <link href="/media/css/pages.css" rel="stylesheet" type="text/css">
        <link href="/media/css/menu.css" rel="stylesheet" type="text/css">
        <link href="/media/css/responsive.css" rel="stylesheet" type="text/css">
        <!--<link href="/media/css/custom.css" rel="stylesheet" type="text/css">-->
        <!--<script src="/media/js/modernizr.min.js"></script>-->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
            <![endif]-->
        <noscript>
        <?php // Controller::redirect('/bug/noscript') ?>
        <meta http-equiv="refresh" content="0;url=/bug/noscript">
        </noscript>
    </head>

    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <?php echo $header ?>
            <!-- Top Bar End -->
            <!-- ========== Left Sidebar Start ========== -->
            <?php echo $navbar ?>
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <?php echo $content ?>
                    </div>
                    <!-- container -->
                </div>
                <!-- content -->
                <?php echo $footer ?>
            </div>
        </div>
        <!-- END wrapper -->
        <script>
            var resizefunc = [];
        </script>
        <!-- jQuery  -->
        <script src="/media/js/jquery.min.js"></script>
        <script src="/media/js/bootstrap.min.js"></script>
        <script src="/media/js/detect.js"></script>
        <script src="/media/js/fastclick.js"></script>
        <script src="/media/js/jquery.slimscroll.js"></script>
        <script src="/media/js/jquery.blockUI.js"></script>
<!--        <script src="/media/js/waves.js"></script>-->
        <script src="/media/js/wow.min.js"></script>
        <script src="/media/js/jquery.nicescroll.js"></script>
        <script src="/media/js/jquery.scrollTo.min.js"></script>
        <script src="/media/js/jquery.app.js"></script>
        <!-- moment js  -->
        <script src="/media/plugins/moment/moment.js"></script>
        <!-- counters  -->
        <script src="/media/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="/media/plugins/counterup/jquery.counterup.min.js"></script>
        <!-- sweet alert  -->
        <script src="/media/plugins/sweetalert/dist/sweetalert.min.js"></script>
        <!-- flot Chart -->
<!--        <script src="/media/plugins/flot-chart/jquery.flot.js"></script>
        <script src="/media/plugins/flot-chart/jquery.flot.time.js"></script>
        <script src="/media/plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="/media/plugins/flot-chart/jquery.flot.resize.js"></script>
        <script src="/media/plugins/flot-chart/jquery.flot.pie.js"></script>
        <script src="/media/plugins/flot-chart/jquery.flot.selection.js"></script>
        <script src="/media/plugins/flot-chart/jquery.flot.stack.js"></script>
        <script src="/media/plugins/flot-chart/jquery.flot.crosshair.js"></script>-->
        <script src="/media/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/media/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="/media/plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js"></script>
        <!-- todos app  -->
        <script src="/media/pages/jquery.todo.js"></script>
        <!-- chat app  -->
        <script src="/media/pages/jquery.chat.js"></script>
        <!-- dashboard  -->
        <!--<script src="/media/pages/jquery.dashboard.js"></script>-->
        <!--form validation-->
        <script type="text/javascript" src="/media/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
        <!--form validation init-->
        <script src="/media/pages/form-validation-init.js"></script>
        <script type="text/javascript" src="/media/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="/media/plugins/bootstrap-datepicker/js/bootstrap-datepicker.espanol.js"></script>
        <!-- Modal-Effect -->
        <script src="/media/plugins/modal-effect/js/classie.js"></script>
        <script src="/media/plugins/modal-effect/js/modalEffects.js"></script>
        <script src="/media/plugins/notifyjs/dist/notify.min.js"></script>
        <script src="/media/plugins/notifications/notify-metro.js"></script>
        <script src="/media/plugins/notifications/notifications.js"></script>
        <script src="/media/js/custom.js"></script>
<!--        <script src="/media/plugins/nestable/jquery.nestable.js"></script>
        <script src="/media/pages/nestable.js"></script>-->
    </body>

</html>