<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $this->lang->line('casehistory') ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                        class="fa fa-dashboard"></i> <?= $this->lang->line('home') ?></a></li>
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/allcases") ?>"><?= $this->lang->line('cases') ?></a></li>
            <li class="active"><?= $this->lang->line('casehistory') ?></li>
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
                                    <td width="50%" style="line-height: 10px"> <?= $casevictimdatabase['VictimName'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('gender') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casevictimdatabase['VictimGender'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px">
                                        <b><?= $this->lang->line('mobile_number') ?></b></td>
                                    <td width="50%"
                                        style="line-height: 10px"> <?= $casevictimdatabase['VictimMobile'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('victimdob') ?></b>
                                    </td>

                                    <td width="50%" style="line-height: 10px"> <?= $casevictimdatabase['VictimDob'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('email_id') ?></b>
                                    </td>
                                    <td width="50%" style="line-height: 10px"> <?= $casevictimdatabase['VictimEmail'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px">
                                        <b><?= $this->lang->line('victim_address') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casevictimdatabase['VictimAddress'] ?></td>
                                </tr>

                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('state') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casevictimdatabase['VictimState'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('district') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casevictimdatabase['VictimDistrict'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('city') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casevictimdatabase['VictimCity'] ?></td>
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
                                    <td width="50%" style="line-height: 10px"> <?= $caseoffenderdatabase['OffenderName'] ?></td>

                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('gender') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $caseoffenderdatabase['OffenderGender'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px">
                                        <b><?= $this->lang->line('offender_address') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $caseoffenderdatabase['OffenderAddress'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('city') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $caseoffenderdatabase['OffenderCity'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('state') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $caseoffenderdatabase['OffenderState'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('fir_no') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $casevictimdatabase['FirNumber'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-solid box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $this->lang->line('act') ?></h3>
                            </div>
                            <div class="box-body">
                                <blockquote class="pull-left">
                                    <?= $casevictimdatabase['OffenceName'] ?>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-solid box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $this->lang->line('compensation') ?></h3>
                            </div>
                            <div class="box-body">
                                <blockquote class="pull-left text-justify">
                                    <?= $casevictimdatabase['Compensation'] ?>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?= $this->lang->line('case_description') ?></h3>
                            </div>
                            <div class="box-body">
                                <blockquote class="pull-left">
                                    <?= $casevictimdatabase['CaseDescription'] ?>
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
                                            <?php if ($comments['Attachment'] != null || (!empty($comments['Attachment']))): ?>
                                                <div class="timeline-footer">
                                                    <a class="btn btn-info btn-xs" href="<?= base_url('/assets/attachment/' . $comments['Attachment']) ?>" target="_blank">Attachment</a>
                                                </div>
                                            <?php endif; ?>
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
            <?php if ($casedatabase['CaseStatus'] != 2): ?>
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> <?= $this->lang->line('commenthere') ?>
                            </h3>
                        </div>
                        <form method="post"
                              action="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/CaseHistorySave") ?> " autocomplete="off" enctype="multipart/form-data">
                            <input type="hidden" name="caseid" value="<?= $casevictimdatabase['CaseID'] ?>"/>
                            <div class="box-body pad">
                                <textarea class="textarea"
                                          placeholder="<?= $this->lang->line('typeyourcommenthere') ?>"
                                          name="casehistory"
                                          style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                            <div class="box-footer">
                                <div class="pull-left">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image</label>
                                        <input type="file" id="exampleInputFile" name="file" accept="image/x-jpg,image/jpeg">
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit"
                                            class="btn btn-md  btn-primary"><?= $this->lang->line('post') ?></button>
                                </div>

                            </div>
                        </form> 
                    </div>
                </div>

            </div>
        <?php endif; ?>

    </section>
</div>



