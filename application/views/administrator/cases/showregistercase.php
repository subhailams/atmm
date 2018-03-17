<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $this->lang->line('case_management') ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("dashboard.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                        class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Cases</a></li>
            <li class="active">New Case</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title"><?= $this->lang->line('registeration_form') ?></h3>
                    </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/CaseRegisterSave") ?> ">
                        <div class="box-body">
                           <div class="row">
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FIR Number"><?= $this->lang->line('fir_no') ?> <span style="color: red ">*</span></label>
                                        <input class="form-control" id="FIR Number" placeholder="Enter FIR Number" type="text" name="fir_no">
                                    </div>
                                </div> 
                           </div>
                           
                            <h4><?= $this->lang->line('victim_details') ?></h4>  
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Victim Name"><?= $this->lang->line('name') ?> <span style="color: red ">*</span></label>
                                        <input class="form-control" id="Victim Name" placeholder="Enter name" type="text" name="victimname">
                                    </div>
                                </div>   
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender"><?= $this->lang->line('gender') ?></label>
                                        <select class="form-control" id="gender" name="victimgender" placeholder="Select Gender">
                                            <option>Select Gender</option>
                                            <?php foreach ($this->db->where(array("gender_display" => "Y"))->order_by("gender_name", "asc")->get('gender')->result() as $detail) { ?>
                                                <option value="<?= $detail->gender_id ?>"> <?= strtoupper($detail->gender_name) ?> </option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email"><?= $this->lang->line('email_id') ?></label>
                                        <input class="form-control" id="email" placeholder="Enter Email id" type="email" name="victimemail">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mobile no"><?= $this->lang->line('mobile_number') ?><span style="color: red ">*</span></label>
                                        <input type="text" class="form-control" id="mobile no" name="victimmobile"
                                               placeholder="Enter Mobile No">


                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="aadhar"><?= $this->lang->line('aadhaar_number') ?></label>
                                        <input type="text" class="form-control" id="aadhar" name="victimaadhar"
                                               placeholder="Enter Aadhaar No">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="dob"><?= $this->lang->line('victimdob') ?><span style="color: red ">*</span></label>
                                        <input type="date" class="form-control" id="dob" name="victimdob"
                                               placeholder="Enter date of birth">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Address"><?= $this->lang->line('victim_address') ?><span style="color: red ">*</span></label>
                                        <input type="text" class="form-control" id="Address" name="victimaddress"
                                               placeholder="Enter Address">
                                    </div>
                                </div>




                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="City"><?= $this->lang->line('city') ?><span style="color: red ">*</span></label>
                                        <input type="text" class="form-control" id="City" name="victimcity"
                                               placeholder="Enter City">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="State"><?= $this->lang->line('state') ?><span style="color: red ">*</span></label>
                                        <input type="text" class="form-control" id="State" name="victimstate"
                                               placeholder="Enter State">

                                    </div>
                                </div>

                            </div>
                            <hr>

                            <h4><?= $this->lang->line('offender_details') ?></h4>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="offender name"><?= $this->lang->line('name') ?><span style="color: red ">*</span></label>
                                        <input type="text" class="form-control" id="offender name" name="offendername"
                                               placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender"><?= $this->lang->line('gender') ?></label>
                                        <select class="form-control" id="gender" name="offendergender" placeholder="Select Gender">
                                            <option>Select Gender</option>
                                            <?php foreach ($this->db->where(array("gender_display" => "Y"))->order_by("gender_name", "asc")->get('gender')->result() as $detail) { ?>
                                                <option value="<?= $detail->gender_id ?>"> <?= strtoupper($detail->gender_name) ?> </option>
                                            <?php } ?>                         

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mobile no"><?= $this->lang->line('mobile_number') ?></label>
                                        <input type="text" class="form-control" id="mobile no" name="offendermobile"
                                               placeholder="Enter Mobile No">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="emailid"><?= $this->lang->line('email_id') ?></label>
                                        <input type="email" class="form-control" id="emailid" name="offenderemail"
                                               placeholder="Enter  emailid">
                                    </div>
                                </div>
                            </div>
                            <div class="row">   
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Address"><?= $this->lang->line('offender_address') ?><span style="color: red ">*</span></label>
                                        <input type="text" class="form-control" id="Address" name="offenderaddress"
                                               placeholder="Enter Address">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="City"><?= $this->lang->line('city') ?><span style="color: red ">*</span></label>
                                        <input type="text" class="form-control" id="City" name="offendercity"
                                               placeholder="Enter City">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="State"><?= $this->lang->line('state') ?><span style="color: red ">*</span></label>
                                        <input type="text" class="form-control" id="State" name="offenderstate"
                                               placeholder="Enter State">

                                    </div>
                                </div>

                            </div>
                            <hr>

                            <h4><?= $this->lang->line('case_details') ?><span style="color: red ">*</span></h4>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>  </label>
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="offenece">
                                            <option>Select offenses from List</option>
                                            <?php foreach ($this->db->where(array("offshow" => "Y"))->order_by("offid", "asc")->get('offences_master')->result() as $detail) { ?>
                                                <option value="<?= $detail->offid ?>"> <?= strtoupper($detail->offname) ?> </option>
                                            <?php } ?>  
                                        </select>
                                        <span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 100%;">
                                            <span class="selection">


                                                <span class="select2-selection__arrow" role="presentation">
                                                    <b role="presentation"></b>
                                                </span>
                                            </span>
                                        </span>
                                        <span class="dropdown-wrapper" aria-hidden="true"> </span>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?= $this->lang->line('offence_date') ?><span style="color: red ">*</span></label>
                                        <input class="form-control" id="date" placeholder="date" type="date" name="offencedate">

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?= $this->lang->line('if_others') ?></label>
                                        <input class="form-control" id="others" placeholder="Others" type="text" name="ifothers">

                                    </div>
                                </div>
                            </div>
                            <div class="row">


                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-12">   
                                        <label><?= $this->lang->line('case_description') ?><span style="color: red ">*</span></label>
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="casedescription"></textarea>
                                    </div>   
                                </div>


                            </div>

                            <div class="box-footer">
                                <center>   <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary"><?= $this->lang->line('submit') ?></button>
                                    </div></center>
                            </div>

                        </div>

                    </form>




                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>