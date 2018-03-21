<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?= $usercount ?></h3>

                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="user/showallusers/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $casecount ?></h3>

                        <p>Total Cases</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= $solvedcount ?></h3>
                        <p>Solved Cases</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= $pendingcount ?></h3>

                        <p>Pending Cases</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">New Cases</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Pending Cases</a></li>
                        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Solved Cases</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <br/>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>FIR No</th>
                                        <th>Case Victim Name</th>
                                        <th>Mobile Number</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($newcase as $new): ?>
                                       <tr>
                                            <td><?= $new['FIR'] ?> </td>
                                            <td><?= $new['VictimName'] ?></td>
                                            <td><?= $new['VictimMobile'] ?></td>
                                            <td><span class="label label-info">Filed</span></td>
                                        </tr>

                                        </div>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <br/>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>FIR No</th>
                                        <th>Case Victim Name</th>
                                        <th>Mobile Number</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendingcase as $pending): ?>
                                       <tr>
                                            <td><?= $pending['FIR'] ?> </td>
                                            <td><?= $pending['VictimName'] ?></td>
                                            <td><?= $pending['VictimMobile'] ?></td>
                                            <td><span class="label label-info">Police Tracking</span></td>
                                        </tr>

                                        </div>
                                    <?php endforeach; ?>
 
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_3">
                            <br/>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>FIR No</th>
                                        <th>Case Victim Name</th>
                                        <th>Mobile Number</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($solvedcase as $solved): ?>
                                       <tr>
                                            <td><?= $solved['FIR'] ?> </td>
                                            <td><?= $solved['VictimName'] ?></td>
                                            <td><?= $solved['VictimMobile'] ?></td>
                                            <td><span class="label label-info">Solved</span></td>
                                        </tr>

                                        </div>
                                    <?php endforeach; ?>
 
                                    
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </section>
    <!-- /.content -->
</div>