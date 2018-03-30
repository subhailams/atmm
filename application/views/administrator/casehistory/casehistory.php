<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $this->lang->line('casehistory') ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                        class="fa fa-dashboard"></i> <?= $this->lang->line('home') ?></a></li>
            <li><a href="#"><?= $this->lang->line('cases') ?></a></li>
            <li class="active"></li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="box-header">
                            <h3 class="box-title"><?= $this->lang->line('victim_details') ?></h3>
                        </div>

                        <table id="showallNotices" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <tbody>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('name') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['VictimName'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('gender') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['VictimGender'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px">
                                        <b><?= $this->lang->line('mobile_number') ?></b></td>
                                    <td width="50%"
                                        style="line-height: 10px"> <?= $casedatabase['VictimMobile'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('victimdob') ?></b>
                                    </td>

                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['VictimDob'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('email_id') ?></b>
                                    </td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['VictimEmail'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px">
                                        <b><?= $this->lang->line('victim_address') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['VictimAddress'] ?></td>
                                </tr>

                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('state') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['VictimState'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('district') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['VictimDistrict'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('city') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['VictimCity'] ?></td>
                                </tr>

                        </table>
                    </div>
                    </centre>
                    <div class="col-sm-6">
                        <div class="box-header">
                            <h3 class="box-title"><?= $this->lang->line('offender_details') ?></h3>
                        </div>

                        <table id="showallNotices" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <tbody>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('name') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['OffenderName'] ?></td>

                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('gender') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['OffenderGender'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px">
                                        <b><?= $this->lang->line('offender_address') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['OffenderAddress'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('city') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['Time'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('state') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['Time'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('fir_no') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casedatabase['FirNumber'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3
                                    class="box-title"><?= $this->lang->line('case_description') ?></h3>
                            </div>
                            <div class="box-body">
                                <blockquote class="pull-left">
                                    <?= $casedatabase['CaseDescription'] ?>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $this->lang->line('postedcomments') ?></h3>
                            </div>
                            <ul class="timeline">
                                <!-- timeline item -->
                                <?php foreach ($casecomments as $comments): ?>
                                    <li>
                                        <i class="fa fa-envelope bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> <?= time_elapsed_string($comments['CreatedOn']) ?></span>
                                            <h3 class="timeline-header"><a href="#"><?= $comments['CreatedBy'] . " ( " . $comments['RoleName'] . " ) " ?></a> posted a comment</h3>
                                            <div class="timeline-body">
                                                <?= $comments ['CaseHistoryDesc'] ?>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END timeline item -->
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> <?= $this->lang->line('commenthere') ?>
                        </h3>
                    </div>
                    <!-- /.comment body -->
                    <form method="post"
                          action="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/CaseHistorySave") ?> ">
                        <input type="hidden" name="caseid" value="<?= $casedatabase['CaseID'] ?>"/>
                        <div class="box-body pad">
                            <textarea class="textarea"
                                      placeholder="<?= $this->lang->line('typeyourcommenthere') ?>"
                                      name="casehistory"
                                      style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                        <div class="box-footer">
                            <!-- submit button -->
                            <div class="pull-right">

                                <button type="submit"
                                        class="btn btn-lg  btn-primary"><?= $this->lang->line('post') ?></button>
                            </div>
                            <!-- /. submit button -->
                        </div>
                    </form> 
                </div>
            </div>
            <!-- /.col-->
        </div>

    </section>
</div>



