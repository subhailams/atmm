<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <th> <?= $this->lang->line('dashboard') ?></th>
            <small> <?= $this->lang->line('control_panel') ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">District Cases</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">New Cases</a>
                        </li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Pending Cases</a></li>
                        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Solved Cases</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <br/>
                            <table id="examples1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>FIR No</th>
                                        <th>Case Victim Name</th>
                                        <th>Mobile Number</th>
<!--                                        <th>Status</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($newcase as $new): ?>
                                        <tr>
                                            <td><?= $new['FIR'] ?> </td>
                                            <td><?= $new['VictimName'] ?></td>
                                            <td><?= $new['VictimMobile'] ?></td>
<!--                                            <td><?= $new['CaseStatus'] ?></td>-->

    <!--                                            <td><span class="label label-info">Filed</span></td>-->
                                        </tr>
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="tab_2">
                            <br/>
                            <table id="examples3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>FIR No</th>
                                        <th>Case Victim Name</th>
                                        <th>Mobile Number</th>
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
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="tab_3">
                            <br/>
                            <table id="examples2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>FIR No</th>
                                        <th>Case Victim Name</th>
                                        <th>Mobile Number</th>
                                        <th>Status</th>
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
                                        </div>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- /.col -->
</div>
</section>
<!-- /.content -->
</div>
<script type="text/javascript">
    var table;
    var base_url = '<?php echo base_url(); ?>';
    $(document).ready(function () {
        //datatables
        table = $('#examples1').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('index.php/administrator/map_ajax_list/cases') ?>",
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
        table = $('#examples2').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('index.php/administrator/map_ajax_list/solvedcases') ?>",
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
        table = $('#examples3').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('index.php/administrator/map_ajax_list/pendingcases') ?>",
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
