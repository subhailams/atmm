<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <th> <?= $this->lang->line('cases') ?></th>
<!--            <small> <?= $this->lang->line('control_panel') ?></small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i><?= $this->lang->line('home') ?></a></li>
            <li class="active"><?= $this->lang->line('cases') ?></li>
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
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><?= $this->lang->line('new_cases') ?></a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><?= $this->lang->line('pending_cases') ?></a></li>
                        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false"><?= $this->lang->line('solved_cases') ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <br/>
                            <table id="examples1" class="table table-bordered table-striped">
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
        table = $('#examples2').DataTable({
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
        table = $('#examples3').DataTable({
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
