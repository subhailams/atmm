<div class="content-wrapper" style="min-height: 990px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profile Change
            <small>Edit Profile</small>
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
                        <h3 class="box-title">Personal Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="name" class="form-control" id="PersonName" name="PersonName"  placeholder="Enter Full Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select</label>
                                        <select class="form-control" id="Role" name="Role" placeholder="Select Role">
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
                                        <label for="User Name">User Name</label>
                                        <input type="text" class="form-control" id="UserName" name="UserName"
                                               placeholder="Enter User Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Email ID">Email ID</label>
                                        <input type="text" class="form-control" id="Email ID" name="Email ID" data-rule-required="true"
data-rule-email="true" placeholder="Enter Email Id">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Address1">Address1</label>
                                        <input type="text" class="form-control" id="Address1" name="Address1"
                                               placeholder="Enter Address1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Address2">Address2</label>
                                        <input type="text" class="form-control" id="Address2" name="Address2"
                                               placeholder="Enter Address2">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="City">City</label>
                                        <input type="text" class="form-control" id="City" name="City"
                                               placeholder="Enter City">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="State">State</label>
                                        <input type="text" class="form-control" id="State" name="State"
                                               placeholder="Enter State">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                         <label for="Country"><?= $this->lang->line('country') ?></label>
                                        <input type="text" class="form-control" id="Country" name="Country"
                                               placeholder="Enter Country">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="MobileNumber"><?= $this->lang->line('mobile_number') ?></label>
                                        <input type="number" class="form-control" id="Mobile Number"
                                               name="Mobile Number" placeholder="Enter Mobile Number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Aadhaar Number">Aadhaar Number</label>
                                        <input type="number" class="form-control" id="Aadhaar Number"
                                               name="Aadhaar Number" placeholder="Enter Aadhaar Number ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><?= $this->lang->line('submit') ?></button>
                           
                          
                            
                       
                       
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>