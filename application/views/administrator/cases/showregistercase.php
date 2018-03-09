<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Case Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/index") ?>"><i
                        class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Cases</a></li>
            <li class="active">New Case</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">Registration Form</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input class="form-control" id="exampleInputEmail1" placeholder="Enter name" type="text">
                                </div>
                            </div>   
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Date Of Incident</label>
                                    <input class="form-control" id="exampleInputPassword1" placeholder="date" type="date">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Case Details</label>
                                    <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option selected="selected">select details</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                        <option>Others</option>
                                    </select>
                                    <span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 100%;">
                                        <span class="selection">


                                            <span class="select2-selection__arrow" role="presentation">
                                                <b role="presentation"></b>
                                            </span>
                                        </span>
                                    </span>
                                    <span class="dropdown-wrapper" aria-hidden="true"> </span>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>If Others</label>
                                    <input class="form-control" id="others" placeholder="Others" type="text">

                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-12">   
                                    <label>Case Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>   
                            </div>


                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div>