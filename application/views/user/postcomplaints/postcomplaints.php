<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<!--    <section class="content">
        <div class="box">
             /.box-header 
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <table id="showallcomplaints" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th> <?= $this->lang->line('complaints') ?></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script type="text/javascript">
    var table;
    var base_url = '<?php echo base_url(); ?>';
    $(document).ready(function () {
        //datatables
        table = $('#showallcomplaints').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . '/posted_complaints_ajax_list/postedcomplaints') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [-1, -2, -3, -4], //last column
                    "orderable": false, //set not orderable
                },
            ],
        });
    });
</script>-->
    <section class="content-header">
        <h1><?= $this->lang->line('postcomplaints') ?></h1>

    </section>
    <br>
    <section class="content">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="box-header">
                            <h3 class="box-title"> <?= $this->lang->line('complainthere') ?>
                            </h3>
                        </div>
                        <form method="post"
                              action="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/PostComplaintSave") ?> " autocomplete="off">
                            <div class="box-body pad">
                                <textarea class="textarea"
                                          placeholder="<?= $this->lang->line('postyourcomplaintshere') ?>"
                                          name="comments"
                                          style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <div class="box-footer">

                                <div class="pull-right">
                                    <button type="submit"
                                            class="btn btn-md  btn-primary"><?= $this->lang->line('post') ?></button>
                                </div>

                            </div>
                        </form> 

                    </div>

                </div>
            </div>
        </div>
    </section>



</div>