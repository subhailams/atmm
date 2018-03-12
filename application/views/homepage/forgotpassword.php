<div class="content-wrapper" style="min-height: 990px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $this->lang->line('Forgot Password') ?>

           
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forgot Password</a></li>
            <li class="active">Password Change</li>
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
                                        <label for="exampleInputEmail1"><?= $this->lang->line('Email ID') ?></label>
                                        <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Enter Email ID">
                                    </div>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Password"><?= $this->lang->line('Verification Code') ?></label>
                                        <input type="number" class="form-control" id="verificationcode" name="verificationcode" placeholder="Enter Verification Code">
                                    </div>
                                </div>
                           
                            </div>
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Password"><?= $this->lang->line('New Password') ?></label>
                                        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter New Password">
                                    </div>
                                </div>
                           
                            </div>
                               <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Password"><?= $this->lang->line('Confirmation Password') ?></label>
                                        <input type="password" class="form-control" id="confirmayionpassword" name="confirmationpassword" placeholder="Enter Confirmation Password">
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
