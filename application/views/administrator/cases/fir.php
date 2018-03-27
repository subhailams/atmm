<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $this->lang->line('fir_form') ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                        class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">New Case</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">


                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/FirRegisterSave") ?> ">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FIR Number"><?= $this->lang->line('fir_no') ?> </label>
                                        <input class="form-control" id="FIR Number" placeholder="Enter FIR Number" type="text" name="fir_no" required="true">
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Policestation"><?= $this->lang->line('police_station') ?> </label>
                                        <input class="form-control" id="Police Station" placeholder="Enter Police Station Name" type="text" name="police_station" required="true">
                                    </div>
                                </div> 

                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="district"><?= $this->lang->line('district') ?></label>
                                        <select class="form-control" id="vdistrict" name="district" placeholder="Select District" required="true">
                                            <option>Select District</option>
                                            <?php foreach ($this->db->where(array("districtshow" => "Y"))->order_by("districtname", "asc")->get('district')->result() as $detail) { ?>
                                                <option value="<?= $detail->dist_id ?>"> <?= strtoupper($detail->districtname) ?> </option>
                                            <?php } ?>                         

                                        </select>

                                    </div>
                                </div>   

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="year"><?= $this->lang->line('year') ?></label>
                                        <input class="form-control" id="year" placeholder="Enter Year" type="number" name="year" >
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date"><?= $this->lang->line('date') ?></label>
                                        <input type="date" class="form-control" id="date" name="date"
                                               placeholder="Enter date " required="true">
                                    </div>
                                </div>

                            </div>
                            <div class="row">


                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="act1"><?= $this->lang->line('act1') ?></label>
                                        <input type="text" class="form-control" id="act1" name="act1"
                                               placeholder="Enter Act">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="Section1"><?= $this->lang->line('section1') ?></label>
                                        <input type="text" class="form-control" id="Section1" name="section1"
                                               placeholder="Enter Section" required="true">
                                    </div>
                                </div>

                            </div>
                            <div class="row">


                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="act2"><?= $this->lang->line('act2') ?></label>
                                        <input type="text" class="form-control" id="act2" name="act2"
                                               placeholder="Enter Act">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="Section2"><?= $this->lang->line('section2') ?></label>
                                        <input type="text" class="form-control" id="Section1" name="section2"
                                               placeholder="Enter Section" required="true">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="offence_day"><?= $this->lang->line('offence_day') ?></label>
                                        <input type="text" class="form-control" id="offence_day" name="offence_day"
                                               placeholder="Enter Offence Day " required="true">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Date_from"><?= $this->lang->line('date_from') ?></label>
                                        <input type="date" class="form-control" id="date_from" name="date_from"
                                               placeholder="Enter From Date " required="true">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Date_to"><?= $this->lang->line('date_to') ?></label>
                                        <input type="date" class="form-control" id="date_to" name="date_to"
                                               placeholder="Enter To Date " required="true">

                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Time_from"><?= $this->lang->line('time_from') ?></label>
                                        <input type="text" class="form-control" id="time_from" name="time_from"
                                               placeholder="Enter From Time " required="true">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Time_to"><?= $this->lang->line('time_to') ?></label>
                                        <input type="text" class="form-control" id="time_to" name="time_to"
                                               placeholder="Enter To Time " required="true">

                                    </div>
                                </div>




                            </div>
                            <hr>
                            <h4><?= $this->lang->line('information_received_at_police_station') ?></h4>
                            <br>
                            <div class="row">
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="date"><?= $this->lang->line('date') ?></label>
                                        <input type="date" class="form-control" id="date" name="receiveddate"
                                               placeholder="Enter Offence date " required="true">
                                    </div></div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="time"><?= $this->lang->line('time') ?></label>
                                        <input type="text" class="form-control" id="time" name="time"
                                               placeholder="Enter time " required="true">
                                    </div></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="place_of_occurrence"><?= $this->lang->line('place_of_occurrence') ?></label>
                                        <input type="text" class="form-control" id="place_of_occurrence" name="place_of_occurrence"
                                               placeholder="Enter Of Occurrence " required="true">

                                    </div>
                                </div>
                            </div>
                            <div class="row">   
                                    <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="type_of_information"><?= $this->lang->line('type_of_information') ?></label>
                                        <input type="text" class="form-control" id="type_of_information" name="type_of_information"
                                               placeholder="Enter Type Of Information " required="true">
                                    </div></div>
                             </div>
                            <h4><?= $this->lang->line('complianant/informant') ?></h4>
                            <br>
                            <div class="row">
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="name"><?= $this->lang->line('complianantname') ?></label>
                                        <input type="text" class="form-control" id="complianantname" name="complianantname"
                                               placeholder="Enter Complianant Name " required="true">
                                    </div></div>

                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="date"><?= $this->lang->line('complianantdob') ?></label>
                                        <input type="date" class="form-control" id="complianantdob" name="complianantdob"
                                               placeholder="Enter Date Of Birth " required="true">
                                    </div></div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="nationality"><?= $this->lang->line('nationality') ?></label>
                                        <input type="text" class="form-control" id="nationality" name="nationality"
                                               placeholder="Enter Nationality " required="true">
                                    </div></div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="occupation "><?= $this->lang->line('occupation') ?></label>
                                        <input type="text" class="form-control" id="occupation " name="occupation"
                                               placeholder="Enter Occupation  " required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="address "><?= $this->lang->line('address') ?></label>
                                        <input type="text" class="form-control" id="address " name="address"
                                               placeholder="Enter Address  " required="true">
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?= $this->lang->line('suspectparticulars') ?></label>
                                            <input class="form-control" id="others" placeholder="suspectparticulars" type="text" name="suspectparticulars">

                                        </div>
                                    </div>
                                </div>
                            <div class="row">
                                <center><div class="form-group">
                                            <input    type="checkbox" name="send_to_sjsa" > <?= $this->lang->line('send_to_sjsa') ?>

                                        </div>
                                </center>
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

<script type="text/javascript">
    $("#vdistrict").on("change", function (event, r) {
        LastUrl = "";
        AjaxCall("index.php/" + role + "/FetchCities", "id=" + $(this).val(), "vcity", "id");
    });
    $("#odistrict").on("change", function (event, r) {
        LastUrl = "";
        AjaxCall("index.php/" + role + "/FetchCities", "id=" + $(this).val(), "ocity", "id");
    });
</script>

