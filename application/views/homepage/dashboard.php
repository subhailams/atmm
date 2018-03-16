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

        <!-- Sweetalert -->
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert/sweetalert.css') ?>"/>
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
        <!-- Sweetalert -->
        <script src="<?= base_url('assets/plugins/sweetalert/sweetalert.js') ?>"></script>
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

        <!-- Notifications -->
        <?php if (!empty($this->session->flashdata('ME_ERROR'))) : ?>
            <script>
                var msg = "<?= $this->session->flashdata('ME_ERROR') ?>";
                swal("Oops...!", msg, "error")
            </script>
        <?php elseif (!empty($this->session->flashdata('ME_SUCCESS'))) : ?>
            <script>
                var msg = "<?= $this->session->flashdata('ME_SUCCESS') ?>";
                swal("SUCCESS!", msg, "success")
            </script>
        <?php endif; ?>
        <div class="wrapper">
            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="#" class="navbar-brand">Atrocity Case Management</a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="<?= base_url('index.php/homepage/index') ?>">Home</a></li>
                                <li><a href="#">Offences and Punishments</a></li>
                                <li><a href="<?= base_url('index.php/administrator') ?>">Login</a></li>
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


                    <div id="bannerWrap">

                        <div id="banner">


                            <div id="jssor_1" style="position: relative; margin: 0px auto; top: 0px; left: 0px; width: 655px; height: 254px; overflow: hidden; visibility: visible;" jssor-slider="true">
                                <!-- Loading Screen -->


                                <!-- Thumbnail Navigator -->

                                <!-- Bullet Navigator -->

                                <!-- Arrow Navigator -->
                                <!--<span data-u="arrowleft" class="jssora05l" style="top:0px;left:8px;width:40px;height:40px;" data-autocenter="2"></span>
                                <span data-u="arrowright" class="jssora05r" style="top:0px;right:8px;width:40px;height:40px;" data-autocenter="2"></span>-->
                                <div style="position: absolute; top: 0px; left: 0px; width: 655px; height: 254px; transform-origin: 0px 0px 0px; transform: scale(1);"><div class="" style="position: relative; margin: 0px auto; top: 0px; left: 0px; width: 655px; height: 254px; overflow: visible; visibility: visible; display: block;"><div data-u="loading" style="position: absolute; top: 0px; left: 0px; width: 655px; height: 254px; display: none;">
                                            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; "></div>
                                            <div style="position:absolute;display:block;background:url('img-slider/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;"></div>
                                        </div><div data-u="slides" style="cursor: default; position: absolute; top: 0px; left: 0px; width: 655px; height: 254px; overflow: hidden; z-index: 0;"><div style="position: absolute; z-index: 0; pointer-events: none; display: none;"></div></div><div data-u="slides" style="cursor: default; position: absolute; top: 0px; left: 0px; width: 655px; height: 254px; overflow: hidden; z-index: 0;"><div style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute; background-color: rgb(0, 0, 0); opacity: 0; display: none;"></div>
                                            <div data-p="112.50" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute; overflow: hidden; perspective: 112.5px; transform: translate3d(655px, 0px, 0px);">
                                                <img data-u="image" src="uploads/home_banner/show-image/data_160713032738_123480.jpg" border="0" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute;">
                                                <div data-u="thumb" style="display: none;"></div>
                                                <div data-u="loading" style="position: absolute; top: 0px; left: 0px; width: 655px; height: 254px; z-index: 1000; display: none;">
                                                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; "></div>
                                                    <div style="position:absolute;display:block;background:url('img-slider/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;"></div>
                                                </div></div>
                                            <div data-p="112.50" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute; overflow: hidden; perspective: 112.5px; transform: translate3d(-655px, 0px, 0px);">
                                                <img data-u="image" src="uploads/home_banner/show-image/data_160713033529_20605.JPG" border="0" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute;">
                                                <div data-u="thumb" style="display: none;"></div>
                                                <div data-u="loading" style="position: absolute; top: 0px; left: 0px; width: 655px; height: 254px; z-index: 1000; display: none;">
                                                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; "></div>
                                                    <div style="position:absolute;display:block;background:url('img-slider/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;"></div>
                                                </div></div>
                                            <div data-p="112.50" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute; overflow: hidden; perspective: 112.5px; transform: translate3d(-655px, 0px, 0px);">
                                                <img data-u="image" src="uploads/home_banner/show-image/data_161020020604_81243.jpg" border="0" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute;">
                                                <div data-u="thumb" style="display: none;"></div>
                                                <div data-u="loading" style="position: absolute; top: 0px; left: 0px; width: 655px; height: 254px; z-index: 1000; display: none;">
                                                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; "></div>
                                                    <div style="position:absolute;display:block;background:url('img-slider/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;"></div>
                                                </div></div>
                                            <div data-p="112.50" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute; overflow: hidden; perspective: 112.5px; transform: translate3d(-655px, 0px, 0px);">
                                                <img data-u="image" src="uploads/home_banner/show-image/data_170817030149_123402.JPG" border="0" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute;">
                                                <div data-u="thumb" style="display: none;"></div>
                                                <div data-u="loading" style="position: absolute; top: 0px; left: 0px; width: 655px; height: 254px; z-index: 1000; display: none;">
                                                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; "></div>
                                                    <div style="position:absolute;display:block;background:url('img-slider/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;"></div>
                                                </div></div>
                                            <div data-p="112.50" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute; overflow: hidden; perspective: 112.5px; transform: translate3d(-655px, 0px, 0px);">
                                                <img data-u="image" src="uploads/home_banner/show-image/data_170804041902_108680.jpg" border="0" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute;">
                                                <div data-u="thumb" style="display: none;"></div>
                                                <div data-u="loading" style="position: absolute; top: 0px; left: 0px; width: 655px; height: 254px; z-index: 1000; display: none;">
                                                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; "></div>
                                                    <div style="position:absolute;display:block;background:url('img-slider/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;"></div>
                                                </div></div>
                                            <div data-p="112.50" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute; overflow: hidden; perspective: 112.5px; transform: translate3d(-655px, 0px, 0px);">
                                                <img data-u="image" src="uploads/home_banner/show-image/data_170817030524_211500.JPG" border="0" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute;">
                                                <div data-u="thumb" style="display: none;"></div>
                                                <div data-u="loading" style="position: absolute; top: 0px; left: 0px; width: 655px; height: 254px; z-index: 1000; display: none;">
                                                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; "></div>
                                                    <div style="position:absolute;display:block;background:url('img-slider/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;"></div>
                                                </div></div>
                                            <div data-p="112.50" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute; overflow: hidden; perspective: 112.5px; transform: translate3d(-655px, 0px, 0px);">
                                                <img data-u="image" src="uploads/home_banner/show-image/data_170817030823_41724.JPG" border="0" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute;">
                                                <div data-u="thumb" style="display: none;"></div>
                                                <div data-u="loading" style="position: absolute; top: 0px; left: 0px; width: 655px; height: 254px; z-index: 1000; display: none;">
                                                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; "></div>
                                                    <div style="position:absolute;display:block;background:url('img-slider/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;"></div>
                                                </div></div>
                                            <div data-p="112.50" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute; overflow: hidden; perspective: 112.5px;">
                                                <img data-u="image" src="uploads/home_banner/show-image/data_170817033045_87590.JPG" border="0" style="top: 0px; left: 0px; width: 655px; height: 254px; position: absolute;">
                                                <div data-u="thumb" style="display: none;"></div>
                                                <div data-u="loading" style="position: absolute; top: 0px; left: 0px; width: 655px; height: 254px; z-index: 1000; display: none;">
                                                    <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; "></div>
                                                    <div style="position:absolute;display:block;background:url('img-slider/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;"></div>
                                                </div></div>


                                        </div><div data-u="thumbnavigator" class="jssort09-600-45" style="position: absolute; bottom: 0px; left: 0px; width: 655px; visibility: visible; height: 0px;" jssor-slider="true">

                                            <!-- Thumbnail Item Skin Begin -->

                                            <!-- Thumbnail Item Skin End -->
                                            <div style="position: absolute; top: 0px; left: 0px; width: 655px; height: 0px; transform-origin: 0px 0px 0px; transform: scale(1);"><div class="jssort09-600-45" style="position: relative; bottom: 0px; left: 0px; width: 655px; visibility: visible; display: block; top: 0px; overflow: visible;"><div style="position: absolute; top: 0; left: 0; width: 100%; height:100%; background-color: #000; filter:alpha(opacity=40.0); opacity:0.4;"></div><div data-u="slides" style="cursor: default; position: absolute; overflow: hidden; left: 27.5px; top: -12.5px; width: 600px; height: 25px; z-index: 0;"><div style="position: absolute; z-index: 0; pointer-events: none; transform: translate3d(600px, 0px, 0px);"></div></div><div data-u="slides" style="cursor: default; position: absolute; overflow: hidden; left: 27.5px; top: -12.5px; width: 600px; height: 25px; z-index: 0;"><div style="top: 0px; left: 0px; width: 600px; height: 25px; position: absolute; background-color: rgb(0, 0, 0); opacity: 0;"></div>

                                                        <div style="top: 0px; left: 0px; width: 600px; height: 25px; position: absolute; overflow: hidden; transform: translate3d(600px, 0px, 0px);"><div data-u="prototype" class="p" style="left: 0px; top: 0px;">
                                                                <div data-u="thumb" class="t" style=""></div>
                                                            </div><div style="top: 0px; left: 0px; width: 600px; height: 25px; z-index: 1000; display: none;"></div></div><div style="top: 0px; left: 0px; width: 600px; height: 25px; position: absolute; overflow: hidden; transform: translate3d(-600px, 0px, 0px);"><div data-u="prototype" class="p" style="left: 0px; top: 0px;">
                                                                <div data-u="thumb" class="t" style=""></div>
                                                            </div><div style="top: 0px; left: 0px; width: 600px; height: 25px; z-index: 1000; display: none;"></div></div><div style="top: 0px; left: 0px; width: 600px; height: 25px; position: absolute; overflow: hidden; transform: translate3d(-600px, 0px, 0px);"><div data-u="prototype" class="p" style="left: 0px; top: 0px;">
                                                                <div data-u="thumb" class="t" style=""></div>
                                                            </div><div style="top: 0px; left: 0px; width: 600px; height: 25px; z-index: 1000; display: none;"></div></div><div style="top: 0px; left: 0px; width: 600px; height: 25px; position: absolute; overflow: hidden; transform: translate3d(-600px, 0px, 0px);"><div data-u="prototype" class="p" style="left: 0px; top: 0px;">
                                                                <div data-u="thumb" class="t" style=""></div>
                                                            </div><div style="top: 0px; left: 0px; width: 600px; height: 25px; z-index: 1000; display: none;"></div></div><div style="top: 0px; left: 0px; width: 600px; height: 25px; position: absolute; overflow: hidden; transform: translate3d(-600px, 0px, 0px);"><div data-u="prototype" class="p" style="left: 0px; top: 0px;">
                                                                <div data-u="thumb" class="t" style=""></div>
                                                            </div><div style="top: 0px; left: 0px; width: 600px; height: 25px; z-index: 1000; display: none;"></div></div><div style="top: 0px; left: 0px; width: 600px; height: 25px; position: absolute; overflow: hidden; transform: translate3d(-600px, 0px, 0px);"><div data-u="prototype" class="p" style="left: 0px; top: 0px;">
                                                                <div data-u="thumb" class="t" style=""></div>
                                                            </div><div style="top: 0px; left: 0px; width: 600px; height: 25px; z-index: 1000; display: none;"></div></div><div style="top: 0px; left: 0px; width: 600px; height: 25px; position: absolute; overflow: hidden; transform: translate3d(-600px, 0px, 0px);"><div data-u="prototype" class="p" style="left: 0px; top: 0px;">
                                                                <div data-u="thumb" class="t" style=""></div>
                                                            </div><div style="top: 0px; left: 0px; width: 600px; height: 25px; z-index: 1000; display: none;"></div></div><div style="top: 0px; left: 0px; width: 600px; height: 25px; position: absolute; overflow: hidden;"><div data-u="prototype" class="p pav" style="left: 0px; top: 0px;">
                                                                <div data-u="thumb" class="t" style=""></div>
                                                            </div><div style="top: 0px; left: 0px; width: 600px; height: 25px; z-index: 1000; display: none;"></div></div></div></div></div></div><div data-u="navigator" class="jssorb01" style="bottom: 14px; right: 14px; width: 182px; height: 14px;">

                                            <div data-u="prototype" style="width: 14px; height: 14px; position: absolute; left: 0px; top: 0px;" class=""></div><div data-u="prototype" style="width: 14px; height: 14px; position: absolute; left: 24px; top: 0px;" class=""></div><div data-u="prototype" style="width: 14px; height: 14px; position: absolute; left: 48px; top: 0px;" class=""></div><div data-u="prototype" style="width: 14px; height: 14px; position: absolute; left: 72px; top: 0px;" class=""></div><div data-u="prototype" style="width: 14px; height: 14px; position: absolute; left: 96px; top: 0px;" class=""></div><div data-u="prototype" style="width: 14px; height: 14px; position: absolute; left: 120px; top: 0px;" class=""></div><div data-u="prototype" style="width: 14px; height: 14px; position: absolute; left: 144px; top: 0px;" class=""></div><div data-u="prototype" style="width: 14px; height: 14px; position: absolute; left: 168px; top: 0px;" class="av"></div></div></div></div></div>


                        </div>
                        <input type="hidden" name="dd" id="dd" value="11">

                        <div id="rightBanner">
                            <!--- bABASAHEB -->
                            <div id="quote-ambedkar">
                                <h2>&nbsp;
                                </h2>
                            </div>
                            <div id="external-link"><a href="http://ccnmtl.columbia.edu/projects/mmt/ambedkar/web/index.html" target="_blank"><img src="images/home_right.jpg"></a></div>					




                            <!---- bABASAHEB -->
                        </div>

                    </div>
                    <section class="content">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="bg-light-blue-active color-palette"><span  style="font-size: 20px " >Notifications</span></div>
                                <br>
                                <div class="box box-primary">
                                    <table width="265px" border="0" style="padding-left:30px">
                                        <tbody><tr>
                                                <td><h6 style="font-size: 20px; color:#0145ab">Total Email : </h6> </td>
                                                <td style="font-size: 20px; color:#0145ab"> <strong>1583</strong></td>
                                            </tr>
                                            <tr>
                                                <td><h6 style="font-size: 20px; color:#0145ab">Total Cases  &nbsp;&nbsp;&nbsp;: </h6></td>
                                                <td style="font-size: 20px; color:#0145ab"> <strong>2584</strong></td>
                                            </tr>
                                        </tbody></table>
                                    <br> <br><br>
                                </div>
                            </div>


                            <div class="col-md-6">

                                <div class="bg-light-blue-active color-palette"><span  style="font-size: 20px " >Search Cases</span></div>
                                <br>
                                <div class="box box-primary">
                                    <br>
                                    <form name="frmSearch" id="frmSearch" action="action/search-action.php" method="POST">
                                        <input type="hidden" name="page_action" value="search">

                                        <select name="state_id" id="state_id" style="width:190px;">
                                            <option value="">Select state</option>
                                            <option value="3">Andhra Pradesh</option>

                                            <option value="4">Arunachal Pradesh</option>

                                            <option value="5">Assam</option>

                                            <option value="6">Bihar</option>

                                            <option value="7">Chandigarh</option>

                                            <option value="30">Chattisgarh</option>

                                            <option value="25">Delhi</option>

                                            <option value="9">Goa</option>

                                            <option value="10">Gujarat</option>

                                            <option value="11">Haryana</option>

                                            <option value="12">Himachal Pradesh</option>

                                            <option value="13">Jammu n Kashmir</option>

                                            <option value="14">Jharkhand</option>

                                            <option value="27">Karnataka</option>

                                            <option value="15">Kerela</option>

                                            <option value="23">Madhya Pradesh</option>

                                            <option value="21">Maharashtra</option>

                                            <option value="24">Odisha</option>

                                            <option value="29">Pondicherry</option>

                                            <option value="22">Punjab</option>

                                            <option value="2">Rajasthan</option>

                                            <option value="20">Sikkim</option>

                                            <option value="26">Tamil Nadu</option>

                                            <option value="31">Telangana</option>

                                            <option value="28">Uttar Pradesh</option>


                                        </select>
                                        </p>

                                        <p>
                                            <span id="ajax-loader" style="display:none;"><img src="images/ajax-loader.gif"></span>
                                        </p><div id="distr_show">
                                            <select name="distr_id" id="distr_id" style="width:190px;">
                                                <option value="">Select district</option>

                                            </select>

                                        </div>

                                        <p></p>

                                        <p>
                                            <select name="atrocity_type_id" id="atrocity_type_id" style="width:190px;">
                                                <option value="">Select atrocity type</option>
                                                <option value="50">Abuses by caste name in any place within public view</option>

                                                <option value="70">After the poll, causes hurt or assault and threatens to impose Social or Economic boycott or prevents availing benefit of Public service</option>

                                                <option value="27">Begar or other forms of forced or bonded labour</option>

                                                <option value="67">Being a public servant wilful neglect of duties required to be performed by him under SC/ST Act</option>

                                                <option value="73">By words either written or spoken Disrespects any late person held in high esteem</option>

                                                <option value="52">By words either written or spoken or by signs promotes or attempts to promote feelings of enmity, hatred or ill-will</option>

                                                <option value="65">Causes physical harm or mental agony on the allegation of practicing witchcraft or being a witch</option>

                                                <option value="75">Commits mischief by fire (Arson) or any other explosive substance causing damage to house, property or place of worship</option>

                                                <option value="71">Commits offence against Dalit/Adivasi person for having voted or not having voted for a particular Candidate</option>

                                                <option value="28">Compels to dispose or carry human or animal carcasses, or to dig graves</option>

                                                <option value="31">Corrupts or fouls the water of any spring, reservoir or any other source</option>

                                                <option value="12">Counter case against Dalit/Adivasi</option>

                                                <option value="4">Dacoity</option>

                                                <option value="32">Denies customary right of passage to a place of public resort</option>

                                                <option value="17">Destroys damages or defiles any object generally known to be held sacred or in high esteem</option>

                                                <option value="18">Discrimination or harassment or insult or denying or limiting access to opportunities in any educational institutions, hospital, dispensary and Primary Health centre</option>

                                                <option value="22">Dumps excreta, sewage, carcasses or any other obnoxious substance in premises</option>

                                                <option value="57">Forces or causes to leave his house, village or other place of residence</option>

                                                <option value="21">Forces to drink or eat such inedible or obnoxious substance</option>

                                                <option value="24">Forcible tonsuring of head, removing moustaches</option>

                                                <option value="69">Forcing not to vote or vote for a particular candidate, not to file nomination or not to support nomination of a SC/ST Candidate</option>

                                                <option value="35">Gang Rape</option>

                                                <option value="23">Garlands with footwear or parades naked or semi-naked</option>

                                                <option value="74">Gives or fabricates false evidence against SC/ST person</option>

                                                <option value="13">Imposes, blackmail or threatens a social or economic boycott of any person or a family or a group</option>

                                                <option value="48">Institutes false, malicious or vexatious suit or criminal or other legal proceedings against a member of SC/ST</option>

                                                <option value="49">Intentionally insults or intimidates with intent to humiliate</option>

                                                <option value="53">Intentionally touches a woman when such act of touching is of a sexual nature and is without the recipient�s consent</option>

                                                <option value="41">Interference with the enjoyment of SC/ST rights including forest rights, over any land or premises or water or irrigation facilities</option>

                                                <option value="47">Intimidates or obstructs a Chairperson or a holder of any other office of a Panchayat from performing their normal duties and functions</option>

                                                <option value="3">Kidnapping &amp; Abduction</option>

                                                <option value="29">Manual scavenging or employs or permits the employment of such member for such purpose</option>

                                                <option value="1">Murder</option>

                                                <option value="58">Obstructs or prevents using common property resources of an area, or burial or cremation ground, any river, stream, spring, well, tank, cistern, water-tap or other or any bathing ghat, road or passage</option>

                                                <option value="8">Other Crimes Against SCs</option>

                                                <option value="30">Performs, or promotes dedicating woman to a deity, idol, object of worship, temple as a devdasi</option>

                                                <option value="64">Prevent practicing any profession trade or business or employment in any job</option>

                                                <option value="59">Prevents mounting or riding bicycles or motor cycles or wearing footwear or new clothes in public places</option>

                                                <option value="9">Protection of Civil Rights Act</option>

                                                <option value="16">Ransacking of house hold items and destruction of movable and immovable property</option>

                                                <option value="2">Rape</option>

                                                <option value="11">Refusal to pay wages or contract wages</option>

                                                <option value="25">Removing clothes, painting face or body or any other similar act</option>

                                                <option value="5">Robbery</option>

                                                <option value="10">SC/ST (POA) Act</option>

                                                <option value="61">TBD22</option>

                                                <option value="20">Uses words, acts or gestures of a sexual nature towards a woman</option>

                                                <option value="72">Using lawful power for causing injury or annoyance to a SC/ST person</option>

                                                <option value="7">Voluntarily causing simple hurt and grievous hurt</option>

                                                <option value="26">Wrongfully dispossesses/Cultivates land or premises</option>


                                            </select>
                                        </p>

                                        <p><input type="submit" id="submit_info" value="Search"> <a href="atrocity-cases/any-title/all-states/all-districts/all-atrocities/any-from-date/any-to-date/newer-top" class="read-more">+ Advance search</a> </p>


                                    </form> 
                                </div>









                            </div>
                        </div>
                            <br>

                            <div class="row">


                                <div class='col-md-12'>
                                    <div class="bg-light-blue-active color-palette"><span  style="font-size: 20px " >Case Alerts</span></div>
                                    <div class="pageColumns three">
                                        <div class="column feature">
                                            <div class="columnContent">
                                                <div class="unlimitedAccess">


                                                    <div class="box box-primary">


                                                        <div class="vticker" style="position: relative; height: 196px; overflow: hidden;">
                                                            <ul style="margin: 0px; position: absolute; top: 0px;">		
                                                                <br>
                                                                <li style="margin: 0px;"><span class="blueSpan">1. Sir, Accused Kumar in FIR No 20/2018 under P.S.(ammapet) not yet arrested. Kindly direct the concerned officials to arrest them.NCSPOA-New Delhi.</span></li>

                                                                <li style="margin: 0px;"><span class="blueSpan">2. Sir, Spot Inspection report under Rule (6) (1) of PoA Rules in FIR No 20/2018 registered at P.S.(ammapet) on 17-01-2018 not submitted to the state government. Request you to expedite the same.NCSPOA
                                                                        -New Delhi.</span></li>

                                                                <li style="margin: 0px;"><span class="blueSpan">3. Sir, Spot Inspection report under Rule (6) (1) of PoA Rules in FIR No 20/2018 registered at P.S.(ammapet) on 17-01-2018 not submitted to the state government. Request you to expedite the same.NCSPOA
                                                                        -New Delhi.</span></li>

                                                                <li style="margin: 0px;"><span class="blueSpan">4. Sir, Request you to conduct spot Inspection in FIR No 20/2018 registered under P.S.(ammapet) in atrocity case.NCSPOA-New Delhi.</span></li>

                                                                <li style="margin: 0px;"><span class="blueSpan">5. Sir, Request you to conduct spot Inspection in FIR No 20/2018 registered under P.S.(ammapet) in atrocity case.NCSPOA-New Delhi.</span></li>




                                                            </span></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        


                                    </div>




                                </div>


                            </div>
                     

                    </section>









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