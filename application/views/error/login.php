<!DOCTYPE html>
<html lang="en">
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
    <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/skins/skin-blue-light	.css') ?>"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
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
<?php
$config = array("question_format" => "numeric",
    "operation" => "addition");
$this->mathcaptcha->init($config);
$data = $this->mathcaptcha->get_question();
$breadcrumb = $this->uri->segment(3);
?>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html">Atrocity Tracking Management System</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <form action="../../index2.html" method="post">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-md-6 col-md-offset-3">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <br/>
        <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- BEGIN WEBSITE JAVASCRIPT -->
<script src="<?= base_url('assets/plugins/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets/plugins/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>

<!-- END WEBSITE JAVASCRIPT -->
</body>
</html>