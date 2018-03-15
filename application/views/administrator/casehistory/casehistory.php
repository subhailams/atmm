<div class="content-wrapper"> 
    <section class="content-header">
        <h1><?= $this->lang->line('casehistory') ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("dashboard.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                        class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Logs</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        
                        <h3 
                            
                            class="box-title"><?= $this->lang->line('postedby') ?></h3>
                         <div class="pull-right">
                                <h3 class="box-title">09-03-2018</h3>
                            </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <blockquote class="pull-left">
                            <p>comment content</p>
                           
                        </blockquote>
                    </div>
                    <!-- /.comment-body -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        
                        <h3 
                          
                          class="box-title"> <?= $this->lang->line('commenthere') ?>  
                            
                        </h3>

                    </div>
                    <!-- /.comment body -->
                    <form method="post" action="<?= base_url('index.php/'.strtolower($this->router->fetch_class()) . "/casehistorysave") ?> ">
                        <div class="box-body pad">
                           
                            <textarea class="textarea" placeholder="<?= $this->lang->line('typeyourcommenthere') ?>" name="casehistory"
                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

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

