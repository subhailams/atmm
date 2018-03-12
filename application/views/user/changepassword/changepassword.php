<div class="content-wrapper" style="min-height: 990px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Change Password

            <small>Edit Profile</small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Users</a></li>
            <li class="active">Mobile Number</li>
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
                    <form role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?= $this->lang->line('old_password') ?></label>
                                        <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Enter Old Password">
                                    </div>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Password"><?= $this->lang->line('new_password') ?></label>
                                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter New Password">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Confirmation Password"><?= $this->lang->line('confirmation_password') ?></label>
                                        <input type="password" class="form-control" id="ConfirmationPassword" name="ConfirmationPassword" placeholder="Enter Confirmation Password">
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