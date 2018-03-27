<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $this->lang->line('log_mgnt') ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("dashboard.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                            class="fa fa-dashboard"></i><?= $this->lang->line('home') ?></a></li>
            <li class="active"><?= $this->lang->line('logs') ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= (!empty($logsNotice)) ? count($logsNotice) : "0" ?></h3>
                        <p> <?= $this->lang->line('notice') ?> </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/logs/notices") ?>"
                       class="small-box-footer"> <?= $this->lang->line('more_info') ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?= (!empty($logsWarning)) ? count($logsWarning) : "0" ?></h3>
                        <p>Warning</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/logs/warnings") ?>"
                       class="small-box-footer"><?= $this->lang->line('more_info') ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= (!empty($logsError)) ? count($logsError) : "0" ?></h3>
                        <p>Error</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/logs/errors") ?>"
                       class="small-box-footer"><?= $this->lang->line('more_info') ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= (!empty($logsAll)) ? count($logsAll) : "0" ?></h3>
                        <p>All</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/logs/all") ?>"
                       class="small-box-footer"><?= $this->lang->line('more_info') ?> <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>