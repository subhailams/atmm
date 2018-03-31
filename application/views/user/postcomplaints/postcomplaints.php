<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                                  action="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/CaseHistorySave") ?> " autocomplete="off" enctype="multipart/form-data">
                                <input type="hidden" name="caseid" value="<?= $casevictimdatabase['CaseID'] ?>"/>
                                <div class="box-body pad">
                                    <textarea class="textarea"
                                              placeholder="<?= $this->lang->line('postyourcomplaintshere') ?>"
                                              name="casehistory"
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