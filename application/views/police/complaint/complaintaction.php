<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?= $this->lang->line('complaint_action') ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                        class="fa fa-dashboard"></i> <?= $this->lang->line('home') ?></a></li>
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/complaint/allcomplaints") ?>"><?= $this->lang->line('view_all_complaints') ?></a></li>
            <li class="active"><?= $this->lang->line('view_all_complaints') ?></li>
        </ol>
    </section>
    <?php if ($VerifyStatus['AssignedTo'] == 'N'): ?>
        <form role="form" method="post" action="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/ComplaintCommentsSave") ?> ">
            <input type="hidden" name="id" value="<?= $id ?>"/>
            <section class="content">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?= $this->lang->line('police_details') ?><span style="color: red ">*</span></label>
                                    <select class="form-control" id="police" name="policeassigned" placeholder="Choose Police Station" required="true">
                                        <option>Choose  Police Station</option>
                                        <?php foreach ($this->db->where(array("isactive" => "Y", "rolename" => "Police"))->order_by("username", "asc")->join("roles", "roleid=role")->get('users')->result() as $detail) { ?>
                                            <option value="<?= $detail->user_id ?>"> <?= $detail->username . " - " . $detail->rolename ?> </option>
                                        <?php } ?>                
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label><?= $this->lang->line('comments') ?><span style="color: red ">*</span></label>
                                    <textarea class="textarea"
                                              placeholder="Type your comments here"
                                              name="policecomments"
                                              style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </div>
                        </div>

                        <br>

                    </div>
                    <div class="box-footer">
                        <center>  <div class="col-md-12">
                                <button type="submit" class="btn btn-primary"><?= $this->lang->line('submit') ?></button>
                            </div></center>
                    </div>
                </div>
            </section>
        <?php else: ?>
            <div class="error-page">

                <div class="error-content">
                    <h3><i class="fa fa-warning text-red"></i> Already Complaint Assgined</h3>
                </div>
            </div>
        <?php endif; ?>

</div>