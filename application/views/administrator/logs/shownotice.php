<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Log Management - Show Notice</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("dashboard.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                            class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url("dashboard.php/" . strtolower($this->router->fetch_class()) . "/logs") ?>">
                    Logs</a></li>
            <li class="active">Show Notice</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="showallNotices" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <tbody>
                            <tr>
                                <td width="20%" style="line-height: 40px"><b>Error Type</b></td>
                                <td width="80%" style="line-height: 40px"> <span class="label label-info">Notice</span></td>
                            </tr>
                            <tr>
                                <td width="20%" style="line-height: 40px"><b>Line Number</b></td>
                                <td width="80%" style="line-height: 40px"> <?= $noticeinformation['ErrorLine'] ?></td>
                            </tr>
                            <tr>
                                <td width="20%" style="line-height: 40px"><b>Error File</b></td>
                                <td width="80%"
                                    style="line-height: 40px"> <?= $noticeinformation['ErrorFilename'] ?></td>
                            </tr>
                            <tr>
                                <td width="20%" style="line-height: 40px"><b>Error Information</b></td>
                                <td width="80%" style="line-height: 40px"> <?= $noticeinformation['ErrorString'] ?></td>
                            </tr>
                            <tr>
                                <td width="20%" style="line-height: 40px"><b>Time</b></td>
                                <td width="80%" style="line-height: 40px"> <?= time_elapsed_string($noticeinformation['Time']) ?></td>
                            </tr>
                            </tbody>
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
