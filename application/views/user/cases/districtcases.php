<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <th> <?= $this->lang->line('cases') ?></th>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i class="fa fa-dashboard"></i><?= $this->lang->line('home') ?></a></li>
            <li class="active"><?= $this->lang->line('cases') ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

        <div class="box">

            <!-- /.row -->
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $this->lang->line('new_cases') ?></h3>
                            </div>

                            <table id="NewCase" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th> <?= $this->lang->line('fir_no') ?></th>
                                        <th> <?= $this->lang->line('victim_name') ?></th>
                                        <th> <?= $this->lang->line('mobile_number') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($newcase as $new): ?>
                                        <tr>
                                            <td><?= $new['FIR'] ?> </td>
                                            <td><?= $new['VictimName'] ?></td>
                                            <td><?= $new['VictimMobile'] ?></td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br/>
    <section class="content">
        <div class="box">

            <!-- /.row -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $this->lang->line('solved_cases') ?></h3>
                            </div>

                            <table id="SolvedCases" class="table table-bordered table-striped">

                                <thead>

                                    <tr>
                                        <th> <?= $this->lang->line('fir_no') ?></th>
                                        <th> <?= $this->lang->line('victim_name') ?></th>
                                        <th> <?= $this->lang->line('mobile_number') ?></th>
                                        <!--<th>Status</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendingcase as $pending): ?>
                                        <tr>
                                            <td><?= $pending['FIR'] ?> </td>
                                            <td><?= $pending['VictimName'] ?></td>
                                            <td><?= $pending['VictimMobile'] ?></td>

                                            <td><span class="label label-info">Police Tracking</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br/>
    <section class="content">
        <div class="box">

            <!-- /.row -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $this->lang->line('pending_cases') ?></h3>
                            </div>

                            <table id="PendingCases" class="table table-bordered table-striped">

                                <thead>

                                    <tr>
                                        <th> <?= $this->lang->line('fir_no') ?></th>
                                        <th> <?= $this->lang->line('victim_name') ?></th>
                                        <th> <?= $this->lang->line('mobile_number') ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($solvedcase as $solved): ?>
                                        <tr>
                                            <td><?= $solved['FIR'] ?> </td>
                                            <td><?= $solved['VictimName'] ?></td>
                                            <td><?= $solved['VictimMobile'] ?></td>
                                            <td><span class="label label-info">Solved</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>



<!-- /.col -->
<!-- /.content -->
<script type="text/javascript">
    var table;
    var base_url = '<?php echo base_url(); ?>';
    $(document).ready(function () {
        //datatables
        table = $('#NewCase').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . '/map_ajax_list/cases/' . $districtID) ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                },
            ],
        });
    });
</script>
<script type="text/javascript">
    var table;
    var base_url = '<?php echo base_url(); ?>';
    $(document).ready(function () {
        //datatables
        table = $('#SolvedCases').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . '/map_ajax_list/solvedcases/' . $districtID) ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                },
            ],
        });
    });
</script>
<script type="text/javascript">
    var table;
    var base_url = '<?php echo base_url(); ?>';
    $(document).ready(function () {
        //datatables
        table = $('#PendingCases').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . '/map_ajax_list/pendingcases/' . $districtID) ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1], //last column
                    "orderable": false, //set not orderable
                },
            ],
        });
    });
</script>
