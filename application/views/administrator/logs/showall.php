<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Log Management - All Errors</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("dashboard.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                            class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url("dashboard.php/" . strtolower($this->router->fetch_class()) . "/logs") ?>"> Logs</a></li>
            <li class="active">All</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="showall" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th> Error String</th>
                                <th> Error File</th>
                                <th> Error Line</th>
                                <th> Time</th>
                                <th> Actions</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>

<script type="text/javascript">
    var table;
    var base_url = '<?php echo base_url();?>';
    $(document).ready(function () {
        //datatables
        table = $('#showall').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('dashboard.php/administrator/logs_ajax_list/all') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [ 0 ], //first column
                    "orderable": false, //set not orderable
                },
                {
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },

            ],
        });
    });
</script>