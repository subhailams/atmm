<div class="content-wrapper" style="min-height: 990px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $this->lang->line('change_password') ?>

            <small><?= $this->lang->line('edit_password') ?></small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i><?= $this->lang->line('home') ?></a></li>
            <li><a href="#"><?= $this->lang->line('users') ?></a></li>
            <li class="active"><?= $this->lang->line('mobile_number') ?></li>
        </ol>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">

                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="<?= base_url('index.php/user/UpdatePassword') ?> ">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Exampleinputoldpassword"><?= $this->lang->line('old_password') ?></label>
                                        <input type="password" class="form-control" id="oldpassword" name="oldpassword"
                                               placeholder="Enter Old Password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password"><?= $this->lang->line('new_password') ?></label>
                                        <input type="password" class="form-control" id="newpassword" name="newpassword"
                                               placeholder="Enter New Password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="ConfirmationPassword"><?= $this->lang->line('confirmation_password') ?></label>
                                        <input type="password" class="form-control" id="confirmationpassword"
                                               name="confirmationpassword" placeholder="Enter Confirmation Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><?= $this->lang->line('submit') ?></button>

                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>