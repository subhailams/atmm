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
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center"><?= $OffenderDetails['OffenderName'] ?></h3>
                        <p class="text-muted text-center"> <?= $OffenderDetails['OffenderMobile'] ?></p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>No of Offences</b> <a class="pull-right"></a> <br/>
                            </li>
                            <li class="list-group-item">
                                <b>Offender Age</b> <div class="pull-right"><?= $OffenderDetails['OffenderAge'] ?></div>
                            </li>
                            <li class="list-group-item">
                                <b>Offender Gender</b> <div class="pull-right"><?= $OffenderDetails['GenderName'] ?></div>
                            </li>
                            <li class="list-group-item">
                                <b>Offender State</b> <div class="pull-right"><?= $OffenderDetails['State'] ?></div>
                            </li>
                            <li class="list-group-item">
                                <b>Offender District</b> <div class="pull-right"><?= $OffenderDetails['District'] ?></div>
                            </li>
                            <li class="list-group-item">
                                <b>Offender City</b> <div class="pull-right"><?= $OffenderDetails['City'] ?></div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Offence History of <?= $OffenderDetails['OffenderName'] ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <!-- Post -->
                            <div class="post">
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

                                                <td> <a class="btn btn-xs btn-primary"  href="<?= base_url('index.php/' . $this->router->fetch_class() . '/casehistory/show/' . $case['CaseId']) ?>" title="Edit" target="_blank"><i class="fa fa-eye"></i>   View</a> </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <!-- /.post -->

                        </div>
                        <!-- /.tab-pane -->

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </section>
</div>
<!-- /.row -->