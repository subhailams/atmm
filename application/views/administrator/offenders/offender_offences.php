<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $this->lang->line('alloffenders') ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                        class="fa fa-dashboard"></i><?= $this->lang->line('home') ?></a></li>
            <li class="active"><?= $this->lang->line('all_offenders') ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="offenderoffences" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('offender_name') ?></b></td>


                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('offendermobile') ?></b></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><?= $OffenderDetails['OffenderName'] ?></td>
                                    <td width="50%" style="line-height: 10px"> <?= $OffenderDetails['OffenderMobile'] ?></td>

                                </tr>
                                </thead>
                                                            <tbody></tbody>
                                                       
                        </table>
                        <br>
                       <table id="offenderoffences1" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <thead>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('offencename') ?></b></td>


                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('offence_date') ?></b></td>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('status') ?></b></td>
                                  <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('actions') ?></b></td>
                                </tr>
                                <?php foreach ($OffenderCaseDetails as $case): ?>
                                    <tr>
                                        <td width="80%" style="line-height: 10px"><?= $case['OffenceName'] ?></td>
                                        <td width="80%" style="line-height: 10px"><?= $case['OffenceDate'] ?></td>
                                        <td width="80%" style="line-height: 10px"><?= $case['CaseStatus'] ?></td>
                                        
                                        <td> <a class="btn btn-xs btn-primary"  href="<?= base_url('index.php/' . $this->router->fetch_class() . '/casehistory/show/' . $case['CaseId'] ) ?>" title="Edit" target="_blank"><i class="fa fa-eye"></i>   View</a> </td>
                                    </tr>
                                <?php endforeach; ?>

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