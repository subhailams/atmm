<div class="content-wrapper" style="min-height: 990px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <?= $this->lang->line('update_profile') ?>
            <small> <?= $this->lang->line('edit_profile') ?></small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= $this->lang->line('personal_information') ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/UpdateProfileSave") ?> ">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?= $this->lang->line('name') ?></label>
                                        <input type="name" class="form-control" id="Name" name="Name"  placeholder="" value="<?php echo $userdatabase['Name']; ?>"
                                        
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputRole"><?= $this->lang->line('select') ?></label>
                                        <select class="form-control" id="Role" name="Role" placeholder="Select Role" >
                                            <option>Select Role</option>
                                            <option>Police</option>
                                            <option>Victim</option>
                                            <option>Organisation</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="User Name"><?= $this->lang->line('user_name') ?></label>
                                        <input type="text" class="form-control" id="UserName" name="UserName"
                                               placeholder="" value="<?php echo $userdatabase['Username']; ?>" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Email ID"><?= $this->lang->line('email_id') ?></label>
                                        <input type="text" class="form-control" id="Email ID" name="EmailID" data-rule-required="true"
                                               data-rule-email="true" placeholder="" value="<?php echo $userdatabase['EmailID']; ?>">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Address1"><?= $this->lang->line('address1') ?></label>
                                        <input type="text" class="form-control" id="Address1" name="Address1"
                                               placeholder="" value="<?php echo $userdatabase['Address1']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Address2"><?= $this->lang->line('address2') ?></label>
                                        <input type="text" class="form-control" id="Address2" name="Address2"
                                               placeholder="" value="<?php echo $userdatabase['Address2']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="City"><?= $this->lang->line('city') ?></label>
                                        <input type="text" class="form-control" id="City" name="City"
                                               placeholder="" value="<?php echo $userdatabase['City']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="State"><?= $this->lang->line('state') ?></label>
                                        <input type="text" class="form-control" id="State" name="State"

                                               

                                               placeholder="" value="<?php echo $userdatabase['State']; ?>">


                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Country"><?= $this->lang->line('country') ?></label>
                                        <input type="text" class="form-control" id="Country" name="Country"
                                               placeholder="" value="<?php echo $userdatabase['Country']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="Mobile Number"><?= $this->lang->line('mobile_number') ?></label>



                                        <input type="number" class="form-control" id="Mobile Number"
                                               name="MobileNumber" placeholder="" value="<?php echo $userdatabase['Mobilenumber']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Aadhaar Number"><?= $this->lang->line('aadhaar_number') ?></label>
                                        <input type="number" class="form-control" id="Aadhaar Number"
                                               name="AadhaarNumber" placeholder="" value="<?php echo $userdatabase['Aadhaarnumber']; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><?= $this->lang->line('submit') ?></button>





                        </div>
                    </form>
                        <!-- /.box -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div>