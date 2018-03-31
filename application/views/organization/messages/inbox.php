<div class="content-wrapper"> 
    <section class="content-header">
        <h1><?= $this->lang->line('mail_box')?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                        class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Messages</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/messages/composemail") ?>" class="btn btn-primary btn-block margin-bottom"> <?= $this->lang->line('compose') ?></a>
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"> <?= $this->lang->line('folder') ?></h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/messages/show") ?>"><i class="fa fa-inbox"></i>  <?= $this->lang->line('inbox') ?>
                                    <span class="label label-primary pull-right"></span></a></li>
                            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/messages/sent") ?>"><i class="fa fa-envelope-o"></i>  <?= $this->lang->line('sent') ?></a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> <?= $this->lang->line('inbox') ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <?php foreach ($inboxMessages as $email): ?>
                                        <tr>
                                            <td><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div></td>
                                            <td class="mailbox-name"><a href="#"><?= $email['SenderName'] ?></a></td>
                                            <td class="mailbox-subject"><b><?= $email['MessageSubject'] ?></b> <?= $email['Messagedetails'] ?></td>
                                            <td class=" pull-right mailbox-date"> <?= time_elapsed_string($email['CreatedOn']) ?></td>
                                        </tr>
                                    <?php endforeach;
                                    ?>
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
    </section>

</div>


