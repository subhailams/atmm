<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Case Management - All Cases</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                            class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/logs") ?>"> Cases</a></li>
            <li class="active">All Cases</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="showallCases" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th> Victim Name</th>
                                <th> Offence Date</th>
                                <th> Mobile No</th>
                                <th> Email id</th>
                                 <th> Status</th>
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
        table = $('#showallCases').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },

            ],
        });
    });
</script>