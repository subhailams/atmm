<!DOCTYPE html>
<html lang="en">
    <head>
        <title>STAFF APPRAISAL PORTAL - RMKEC</title>

        <!-- BEGIN META -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="your,keywords">
        <meta name="description" content="Short explanation about this website">
        <!-- END META -->

        <!-- BEGIN STYLESHEETS -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css') ?>" />
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>" />
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>" />
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/iconic-font.css') ?>" />
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/theme-default/libs/select2/select2-1422823373.css') ?>" />
    </head>
    <?php
    $config = array("question_format" => "numeric",
        "operation" => "addition");
    $this->mathcaptcha->init($config);
    $data = $this->mathcaptcha->get_question();
    $breadcrumb = $this->uri->segment(3);
    ?>
    <body class="menubar-hoverable header-fixed ">
        <!-- BEGIN LOGIN SECTION -->
        <section class="section-account">
            <div class="card contain-sm style-transparent">
                <div class="card-body">
                    <div class="row">
                        <?php if (!empty($Error)) { ?>
                            <div class="alert alert-danger" role="alert"><?= $Error ?></div>
                        <?php } ?>
                        <div class="col-md-12">
                            <center><img src="<?= base_url('assets/img/logo.png') ?>" alt="RMK">
                            <span class="text-lg text-bold text-center text-primary">RMKEC STAFF APPRAISAL PORTAL</span>
                            <img src="<?= base_url('assets/img/dnv.png') ?>" alt="RMK"></center>
                            <br/>
                            <form class="form floating-label" action="<?= base_url('index.php/Administrator') ?>" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="username" name="username" required="true">
                                    <label for="username">Username</label>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <label for="password">Password</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control select2-list" name="role" required="true" id="role">
                                                <option value=""></option>
                                                <?php foreach ($this->db->where(array("role_status" => "Y"))->order_by("role_name", "asc")->get('user_role')->result() as $detail) { ?>
                                                    <option value="<?= $detail->role_id ?>"> <?= strtoupper($detail->role_show) ?> </option> 
                                                <?php } ?>
                                            </select>
                                            <label>Choose Role</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="form-control select2-list" name="academicyear" required="true">
                                                <option value=""></option>
                                                <?php foreach ($this->db->where(array("aca_display" => "Y"))->order_by("aca_name", "asc")->get('academicyear')->result() as $detail) { ?>
                                                    <option value="<?= $detail->aca_id ?>"> <?= strtoupper($detail->aca_name) ?> </option> 
                                                <?php } ?>

                                            </select>
                                            <label>Choose Academic Year</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input  type="text" class="form-control" required="true" name="answer" id="answer">
                                    <input type="hidden" name="question" value="<?= $data['number1'] + $data['number2'] ?>"> 
                                    <label for="username"><?= $data['question']; ?></label>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-xs-6 text-left">

                                    </div><!--end .col -->
                                    <div class="col-xs-6 text-right">
                                        <button class="btn btn-primary btn-raised" type="submit">Login</button>
                                    </div><!--end .col -->
                                </div><!--end .row -->
                            </form>
                        </div><!--end .col -->
                    </div><!--end .row -->
                </div><!--end .card-body -->
            </div><!--end .card -->
        </section>
        <!-- END LOGIN SECTION -->

        <!-- BEGIN WEBSITE JAVASCRIPT -->
        <script src="<?= base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery-migrate-1.2.1.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/libs/spin.js/spin.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/libs/autosize/jquery.autosize.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/libs/nanoscroller/jquery.nanoscroller.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/core/cache/63d0445130d69b2868a8d28c93309746.js') ?>"></script>
        <script src="<?= base_url('assets/js/libs/select2/select2.min.js') ?>"></script>


        <script src="<?= base_url('assets/js/Script.js') ?>"></script>
        <!-- END WEBSITE JAVASCRIPT -->
    </body>
</html>