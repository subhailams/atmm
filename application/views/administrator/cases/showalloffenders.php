<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $this->lang->line('alloffenders') ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                        class="fa fa-dashboard"></i><?= $this->lang->line('home') ?></a></li>
            <li class="active"><?= $this->lang->line('all_offenders') ?></li>
        </ol>
    </section>    <!-- Main content -->
    <section class="content">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="showalloffenders" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th> <?= $this->lang->line('offender_name') ?></th>
                                    <th> <?= $this->lang->line('gender') ?></th>
                                    <th> <?= $this->lang->line('mobile_number') ?></th>
                                    <th> <?= $this->lang->line('city') ?></th>
                                    <th> <?= $this->lang->line('district') ?></th>
                                    <th> <?= $this->lang->line('actions') ?></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
<!-- /.row -->

<!-- /.content -->


<script type="text/javascript">
    var table;
    var base_url = '<?php echo base_url(); ?>';
    $(document).ready(function () {
        //datatables
        table = $('#showalloffenders').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('index.php/administrator/offenders_ajax_list/offenders') ?>",
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
