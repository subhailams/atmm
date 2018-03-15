<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $this->lang->line('casedetails') ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("dashboard.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                        class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Cases</a></li>
            <li class="active">New Case</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
<!--                <centre> <div class="row">
                                <div class="col-sm-6">

                                     <h4><?= $this->lang->line('victim_details') ?></h4>  
                                </div>
                    </div>
                </centre>-->


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
                                    <td width="50%" style="line-height: 10px"> <span class="label label-info">Notice</span></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('gender') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $noticeinformation['ErrorLine'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('mobilenumber') ?></b></td>
                                    <td width="50%"
                                        style="line-height: 10px"> <?= $noticeinformation['ErrorFilename'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('victimdob') ?></b></td>

                                    <td width="50%" style="line-height: 10px"> <?= time_elapsed_string($noticeinformation['Time']) ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('email_id') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $noticeinformation['ErrorString'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b<?= $this->lang->line('victim_address') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= time_elapsed_string($noticeinformation['Time']) ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('city') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= time_elapsed_string($noticeinformation['Time']) ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('state') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= time_elapsed_string($noticeinformation['Time']) ?></td>
                                </tr>
                        </table>
                    </div></centre>
                    <div class="col-sm-6">
                        <div class="box-header">
                            <h3 class="box-title"><?= $this->lang->line('offender_details') ?></h3>
                        </div>

                        <table id="showallNotices" class="table table-bordered table-striped dataTable" role="grid"
                               aria-describedby="example1_info">
                            <tbody>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('name') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <span class="label label-info">Notice</span></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('gender') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= $noticeinformation['ErrorLine'] ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('address') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= time_elapsed_string($noticeinformation['Time']) ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('city') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= time_elapsed_string($noticeinformation['Time']) ?></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="line-height: 10px"><b><?= $this->lang->line('state') ?></b></td>
                                    <td width="50%" style="line-height: 10px"> <?= time_elapsed_string($noticeinformation['Time']) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
        <div class="form-group">
            <label>Posted Comments</label>
<!--            <div style ="overflow: auto; width: 100%; height: 1000px;">-->

                <select multiple="" class="form-control" disabled="">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 2</option>
                    <option>option 2</option>
                    <option>option 2</option>
                    <option>option 2</option>

                </select>
<!--            </div>-->

        </div>
        <!--        <div class="row">
                    <div class="col-md-6">
                        <div class="box box-solid">
                            <div class="box-header with-border">
        
                                <h3 
        
                                    class="box-title"><?= $this->lang->line('postedby') ?></h3>
                                <div class="pull-right">
                                    <h3 class="box-title">09-03-2018</h3>
                                </div>
                            </div>
                             /.box-header 
                            <div class="box-body">
                                <blockquote class="pull-left">
                                    <p>comment content</p>
        
                                </blockquote>
                            </div>
                             /.comment-body 
                        </div>
                    </div>
                </div>-->

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">

                        <h3 

                            class="box-title"> <?= $this->lang->line('commenthere') ?>  

                        </h3>

                    </div>
                    <!-- /.comment body -->
                    <form method="post" action="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/casehistorysave") ?> ">
                        <div class="box-body pad">

                            <textarea class="textarea" placeholder="<?= $this->lang->line('typeyourcommenthere') ?>" name="casehistory"
                                      style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

                        </div>
                        <div class="box-footer">
                            <!-- submit button -->
                            <div class="pull-right">

                                <button type="submit" class="btn btn-lg  btn-primary"><?= $this->lang->line('post') ?></button>

                            </div>
                            <!-- /. submit button -->
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.col-->
        </div>
</div>
</div>
</section>
</div>

