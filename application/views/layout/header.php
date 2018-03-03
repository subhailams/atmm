<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Atrocity Tracking and Management</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/dist/css/bootstrap.min.css') ?>" />
    <!-- Font Awesome -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css') ?>" />
    <!-- Ionicons -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/Ionicons/css/ionicons.min.css') ?>" />
    <!-- Theme style -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/AdminLTE.min.css') ?>" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/skins/skin-blue-light	.css') ?>" />
    <!-- Morris chart -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/morris.js/morris.css') ?>" />
    <!-- jvectormap -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/jvectormap/jquery-jvectormap.css') ?>" />
    <!-- Date Picker -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins//bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>" />
    <!-- Daterange picker -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') ?>" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="<?= base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <script>  var Geo = "";
            function GeoLocaiton(Json) {
                Geo = Json;
            }
            var base_url = "<?= base_url(); ?>";
            var role = "<?= $this->router->fetch_class(); ?>";
        </script>
    </head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

        <!-- END HEADER-->
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
        <!-- /Notifications -->
