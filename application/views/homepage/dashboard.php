<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Atrocity Tracking and Management</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link type="text/css" rel="stylesheet"
              href="<?= base_url('assets/plugins/bootstrap/dist/css/bootstrap.min.css') ?>"/>
        <!-- Font Awesome -->
        <link type="text/css" rel="stylesheet"
              href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css') ?>"/>
        <!-- Ionicons -->
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/Ionicons/css/ionicons.min.css') ?>"/>
        <!-- Theme style -->
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/AdminLTE.min.css') ?>"/>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/skins/skin-blue-light.css') ?>"/>
        <!-- Morris chart -->
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/morris.js/morris.css') ?>"/>
        <!-- jvectormap -->
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/jvectormap/jquery-jvectormap.css') ?>"/>
        <!-- Date Picker -->
        <link type="text/css" rel="stylesheet"
              href="<?= base_url('assets/plugins//bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>"/>
        <!-- Daterange picker -->
        <link type="text/css" rel="stylesheet"
              href="<?= base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') ?>"/>
        <!-- bootstrap wysihtml5 - text editor -->
        <link type="text/css" rel="stylesheet"
              href="<?= base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>"/>
        <!-- DataTables -->
        <link type="text/css" rel="stylesheet"
              href="<?= base_url('assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

        <!-- jQuery 3 -->
        <script src="<?= base_url('assets/plugins/jquery/dist/jquery.min.js') ?>"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?= base_url('assets/plugins/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
        <!-- DataTables -->
        <script src="<?= base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
        <!-- daterangepicker -->
        <script src="<?= base_url('assets/plugins/moment/min/moment.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
        <!-- datepicker -->
        <script src="<?= base_url('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?= base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
        <!-- Slimscroll -->
        <script src="<?= base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
        <!-- FastClick -->
        <script src="<?= base_url('assets/plugins/fastclick/lib/fastclick.js') ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url('assets/js/adminlte.min.js') ?>"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?= base_url('assets/js/pages/index.js') ?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?= base_url('assets/js/demo.js') ?>"></script>


        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <script>  var Geo = "";
            function GeoLocaiton(Json) {
                Geo = Json;
            }
            var base_url = "<?= base_url(); ?>";
            var role = "<?= $this->router->fetch_class(); ?>";
        </script>
    </head>

    <body class="hold-transition skin-blue-light layout-top-nav">
        <div class="wrapper">

            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="../../index2.html" class="navbar-brand">Atrocity Case Management</a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                        
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                                <li><a href="#">Link</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">One more separated link</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </header>
            <!-- Full Width Column -->
            <div class="content-wrapper">
                <div class="container">
                    <!-- Main content -->
                    <section class="content">
                        <div class="callout callout-info">
                            <h4>Tip!</h4>

                            <p>Add the layout-top-nav class to the body tag to get this layout. This feature can also be used
                                with a
                                sidebar! So use this class if you want to remove the custom dropdown menus from the navbar and
                                use regular
                                links instead.</p>
                        </div>
                        <div class="callout callout-danger">
                            <h4>Warning!</h4>

                            <p>The construction of this layout differs from the normal one. In other words, the HTML markup of
                                the navbar
                                and the content will slightly differ than that of the normal layout.</p>
                        </div>
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Blank Box</h3>
                            </div>
                            <div class="box-body">
                                The great content goes here
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                Developed by <strong>RMK Engineering College</strong> and Designed by <a href="https://adminlte.io">Almsaeed
                    Studio</a>
            </footer>
        </div>
        <!-- ./wrapper -->
    </body>
</html>