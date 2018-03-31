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
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Compose New Message</h3>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" method="post" action="<?= base_url('index.php/' . strtolower($this->router->fetch_class()) . "/EmailSave") ?> ">
                        <div class="box-body">
                            <div class="form-group">

                                
                                <label for="Email To"><?= $this->lang->line('to') ?></label>
                                <select class="form-control" id="email" name="emailto" placeholder="Select Mail ID" required="true">
                                    <option>Select User Name</option>
                                    <?php foreach ($this->db->where(array("isactive" => "Y"))->order_by("username", "asc")->join("roles", "roleid=role")->get('users')->result() as $detail) { ?>
                                        <option value="<?= $detail->user_id ?>"> <?= $detail->username . " - " . $detail->rolename ?> </option>
                                    <?php } ?>                         

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Subject"></label>
                                <input class="form-control" placeholder="Subject:" name="subject">
                            </div>
                            <div class="form-group">
                                <ul class="wysihtml5-toolbar" style=""></ul><li class="dropdown">
                                        <a class="btn btn-default dropdown-toggle " data-toggle="dropdown">

                                            <span class="glyphicon glyphicon-font"></span>

                                            <span class="current-font">Normal text</span>
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p" tabindex="-1" href="javascript:;" unselectable="on">Normal text</a></li>
                                            <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" tabindex="-1" href="javascript:;" unselectable="on">Heading 1</a></li>
                                            <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" tabindex="-1" href="javascript:;" unselectable="on">Heading 2</a></li>
                                            <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3" tabindex="-1" href="javascript:;" unselectable="on">Heading 3</a></li>
                                            <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h4" tabindex="-1" href="javascript:;" unselectable="on">Heading 4</a></li>
                                            <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h5" tabindex="-1" href="javascript:;" unselectable="on">Heading 5</a></li>
                                            <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h6" tabindex="-1" href="javascript:;" unselectable="on">Heading 6</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="btn-group">
                                            <a class="btn  btn-default" data-wysihtml5-command="bold" title="CTRL+B" tabindex="-1" href="javascript:;" unselectable="on">Bold</a>
                                            <a class="btn  btn-default" data-wysihtml5-command="italic" title="CTRL+I" tabindex="-1" href="javascript:;" unselectable="on">Italic</a>
                                            <a class="btn  btn-default" data-wysihtml5-command="underline" title="CTRL+U" tabindex="-1" href="javascript:;" unselectable="on">Underline</a>
                                            <a class="btn  btn-default" data-wysihtml5-command="small" title="CTRL+S" tabindex="-1" href="javascript:;" unselectable="on">Small</a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="btn  btn-default" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="blockquote" data-wysihtml5-display-format-name="false" tabindex="-1" href="javascript:;" unselectable="on">
                                            <span class="glyphicon glyphicon-quote"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="btn-group">
                                            <a class="btn  btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered list" tabindex="-1" href="javascript:;" unselectable="on">
                                                <span class="glyphicon glyphicon-list"></span>
                                            </a>
                                            <a class="btn  btn-default" data-wysihtml5-command="insertOrderedList" title="Ordered list" tabindex="-1" href="javascript:;" unselectable="on">

                                                <span class="glyphicon glyphicon-th-list"></span>

                                            </a>
                                            <a class="btn  btn-default" data-wysihtml5-command="Outdent" title="Outdent" tabindex="-1" href="javascript:;" unselectable="on">

                                                <span class="glyphicon glyphicon-indent-right"></span>

                                            </a>
                                            <a class="btn  btn-default" data-wysihtml5-command="Indent" title="Indent" tabindex="-1" href="javascript:;" unselectable="on">

                                                <span class="glyphicon glyphicon-indent-left"></span>

                                            </a>
                                        </div>
                                    </li>
                                    <div class="box">
                                        <div class="box-header">
                                        </div>
                                        <!-- /.comment body -->
                                        <!--<form>-->
                                        <div class="box-body pad">

                                            <textarea class="textarea" placeholder="Type your email here" name="emaildetail"
                                                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

                                        </div>

                                        <!--                    </form>-->
                                    </div>

                            </div>
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i>  <?= $this->lang->line('attachment') ?>
                                    <input type="file" name="attachment">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                            </div>
                        </div>
                    </form>

                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
        </div>
    </section>
</div>
