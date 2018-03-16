<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Atrocity Tracking and Management</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link type="text/css" rel="stylesheet"
              href="<?= base_url('assets/plugins/bootstrap/dist/css/bootstrap.min.css') ?>"/>
        <!-- Font Awesome -->
        <link type="text/css" rel="stylesheet"
              href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css') ?>"/>
        <!-- Ionicons -->
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/Ionicons/css/ionicons.min.css') ?>"/>
        <!-- Theme style -->
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/AdminLTE.min.css') ?>"/>
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/css/skins/skin-blue-light.css') ?>"/>
        <!-- Morris chart -->
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/morris.js/morris.css') ?>"/>
        <!-- jvectormap -->
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/jvectormap/jquery-jvectormap.css') ?>"/>
        <!-- Date Picker -->
        <link type="text/css" rel="stylesheet"
              href="<?= base_url('assets/plugins//bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>"/>
        <!-- Daterange picker -->
        <link type="text/css" rel="stylesheet"
              href="<?= base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') ?>"/>
        <!-- bootstrap wysihtml5 - text editor -->
        <link type="text/css" rel="stylesheet"
              href="<?= base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>"/>
        <!-- DataTables -->
        <link type="text/css" rel="stylesheet"
              href="<?= base_url('assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>"/>

        <!-- Sweetalert -->
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert/sweetalert.css') ?>"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

        <!-- jQuery 3 -->
        <script src="<?= base_url('assets/plugins/jquery/dist/jquery.min.js') ?>"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?= base_url('assets/plugins/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
        <!-- DataTables -->
        <script src="<?= base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
        <!-- daterangepicker -->
        <script src="<?= base_url('assets/plugins/moment/min/moment.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
        <!-- datepicker -->
        <script src="<?= base_url('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?= base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
        <!-- Slimscroll -->
        <script src="<?= base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
        <!-- FastClick -->
        <script src="<?= base_url('assets/plugins/fastclick/lib/fastclick.js') ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url('assets/js/adminlte.min.js') ?>"></script>
        <!-- Sweetalert -->
        <script src="<?= base_url('assets/plugins/sweetalert/sweetalert.js') ?>"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?= base_url('assets/js/demo.js') ?>"></script>


        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <script>  var Geo = "";
            function GeoLocaiton(Json) {
                Geo = Json;
            }
            var base_url = "<?= base_url(); ?>";
            var role = "<?= $this->router->fetch_class(); ?>";
        </script>
    </head>

    <body class="hold-transition skin-blue-light layout-top-nav">

        <!-- Notifications -->
        <?php if (!empty($this->session->flashdata('ME_ERROR'))) : ?>
            <script>
                var msg = "<?= $this->session->flashdata('ME_ERROR') ?>";
                swal("Oops...!", msg, "error")
            </script>
        <?php elseif (!empty($this->session->flashdata('ME_SUCCESS'))) : ?>
            <script>
                var msg = "<?= $this->session->flashdata('ME_SUCCESS') ?>";
                swal("SUCCESS!", msg, "success")
            </script>
        <?php endif; ?>
        <div class="wrapper">
            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="#" class="navbar-brand">Atrocity Case Management</a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="<?= base_url('index.php/homepage/index') ?>">Home</a></li>
                                <li><a href="#">Offences and Punishments</a></li>
                                <li><a href="<?= base_url('index.php/administrator') ?>">Login</a></li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </header>
            <!-- Full Width Column -->
            <div class="content-wrapper">
                <div class="container">
                    <!-- Main content -->


                   
              
                        <input type="hidden" name="dd" id="dd" value="11">
                      
                        <div class="row">
                            <div class="col-md-4">
						
                                <img title="Government of India" alt="Government of India" src="https://tbncdn.freelogodesign.org/107ab3d4-4d1a-4ba1-9ed8-e3f149a609d0-watermark.png?20180316" align="middle" width="300" height="200">
                                </div>
                            <div class="col-md-8"><br><br><br>
                                <h1> ATROCITY CASE MANAGEMENT </h1>
                            </div>
                            </div>
                       
                  <div id="myCarousel" class="carousel slide" data-ride="carousel" style="width:100%;height:"600" ; margin:="" auto="" float:left="" border:="" 3px="" solid="" #1aa1f0="">

 <div class="carousel-inner" role="listbox">
     
    

      <div class="item">        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYwEEVbNxZv_XUW7Mh6qUmlrIJpqlIBooCP-vLxuU-er6Hw4RbyQ" alt="" align="middle" style="height: 180px;" width="100%" height="400">
         
      </div>
      <div class="item">        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKfMbb1YGN38e5Xf80sklTaweQhzYO_KWoVT9sM2gX7apy345u" alt="" style="height: 180px;" width="100%" height="400">
         
      </div>

      <div class="item active">        <img src="data:image/jpeg;base64,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" alt="" style="height: 180px;" width="100%" height="400">
         
      </div>
     

     
     
          </div>
</div>
                    <section class="content">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="bg-light-blue-active color-palette"><span  style="font-size: 20px " >Notifications</span></div>
                                <br>
                                <div class="box box-primary">
                                    <table width="265px" border="0" style="padding-left:30px">
                                        <tbody><tr>
                                                <td><h6 style="font-size: 20px; color:#0145ab">Total Email : </h6> </td>
                                                <td style="font-size: 20px; color:#0145ab"> <strong>1583</strong></td>
                                            </tr>
                                            <tr>
                                                <td><h6 style="font-size: 20px; color:#0145ab">Total Cases  &nbsp;&nbsp;&nbsp;: </h6></td>
                                                <td style="font-size: 20px; color:#0145ab"> <strong>2584</strong></td>
                                            </tr>
                                        </tbody></table>
                                    <br> <br><br>
                                </div>
                            </div>


                            <div class="col-md-6">

                                <div class="bg-light-blue-active color-palette"><span  style="font-size: 20px " >Search Cases</span></div>
                                <br>
                                <div class="box box-primary">
                                    <br>
                                    <form name="frmSearch" id="frmSearch" action="action/search-action.php" method="POST">
                                        <input type="hidden" name="page_action" value="search">

                                        <select name="state_id" id="state_id" style="width:190px;">
                                            <option value="">Select state</option>
                                            <option value="3">Andhra Pradesh</option>

                                            <option value="4">Arunachal Pradesh</option>

                                            <option value="5">Assam</option>

                                            <option value="6">Bihar</option>

                                            <option value="7">Chandigarh</option>

                                            <option value="30">Chattisgarh</option>

                                            <option value="25">Delhi</option>

                                            <option value="9">Goa</option>

                                            <option value="10">Gujarat</option>

                                            <option value="11">Haryana</option>

                                            <option value="12">Himachal Pradesh</option>

                                            <option value="13">Jammu n Kashmir</option>

                                            <option value="14">Jharkhand</option>

                                            <option value="27">Karnataka</option>

                                            <option value="15">Kerela</option>

                                            <option value="23">Madhya Pradesh</option>

                                            <option value="21">Maharashtra</option>

                                            <option value="24">Odisha</option>

                                            <option value="29">Pondicherry</option>

                                            <option value="22">Punjab</option>

                                            <option value="2">Rajasthan</option>

                                            <option value="20">Sikkim</option>

                                            <option value="26">Tamil Nadu</option>

                                            <option value="31">Telangana</option>

                                            <option value="28">Uttar Pradesh</option>


                                        </select>
                                        </p>

                                        <p>
                                            <span id="ajax-loader" style="display:none;"><img src="images/ajax-loader.gif"></span>
                                        </p><div id="distr_show">
                                            <select name="distr_id" id="distr_id" style="width:190px;">
                                                <option value="">Select district</option>

                                            </select>

                                        </div>

                                        <p></p>

                                        <p>
                                            <select name="atrocity_type_id" id="atrocity_type_id" style="width:190px;">
                                                <option value="">Select atrocity type</option>
                                                <option value="50">Abuses by caste name in any place within public view</option>

                                                <option value="70">After the poll, causes hurt or assault and threatens to impose Social or Economic boycott or prevents availing benefit of Public service</option>

                                                <option value="27">Begar or other forms of forced or bonded labour</option>

                                                <option value="67">Being a public servant wilful neglect of duties required to be performed by him under SC/ST Act</option>

                                                <option value="73">By words either written or spoken Disrespects any late person held in high esteem</option>

                                                <option value="52">By words either written or spoken or by signs promotes or attempts to promote feelings of enmity, hatred or ill-will</option>

                                                <option value="65">Causes physical harm or mental agony on the allegation of practicing witchcraft or being a witch</option>

                                                <option value="75">Commits mischief by fire (Arson) or any other explosive substance causing damage to house, property or place of worship</option>

                                                <option value="71">Commits offence against Dalit/Adivasi person for having voted or not having voted for a particular Candidate</option>

                                                <option value="28">Compels to dispose or carry human or animal carcasses, or to dig graves</option>

                                                <option value="31">Corrupts or fouls the water of any spring, reservoir or any other source</option>

                                                <option value="12">Counter case against Dalit/Adivasi</option>

                                                <option value="4">Dacoity</option>

                                                <option value="32">Denies customary right of passage to a place of public resort</option>

                                                <option value="17">Destroys damages or defiles any object generally known to be held sacred or in high esteem</option>

                                                <option value="18">Discrimination or harassment or insult or denying or limiting access to opportunities in any educational institutions, hospital, dispensary and Primary Health centre</option>

                                                <option value="22">Dumps excreta, sewage, carcasses or any other obnoxious substance in premises</option>

                                                <option value="57">Forces or causes to leave his house, village or other place of residence</option>

                                                <option value="21">Forces to drink or eat such inedible or obnoxious substance</option>

                                                <option value="24">Forcible tonsuring of head, removing moustaches</option>

                                                <option value="69">Forcing not to vote or vote for a particular candidate, not to file nomination or not to support nomination of a SC/ST Candidate</option>

                                                <option value="35">Gang Rape</option>

                                                <option value="23">Garlands with footwear or parades naked or semi-naked</option>

                                                <option value="74">Gives or fabricates false evidence against SC/ST person</option>

                                                <option value="13">Imposes, blackmail or threatens a social or economic boycott of any person or a family or a group</option>

                                                <option value="48">Institutes false, malicious or vexatious suit or criminal or other legal proceedings against a member of SC/ST</option>

                                                <option value="49">Intentionally insults or intimidates with intent to humiliate</option>

                                                <option value="53">Intentionally touches a woman when such act of touching is of a sexual nature and is without the recipient�s consent</option>

                                                <option value="41">Interference with the enjoyment of SC/ST rights including forest rights, over any land or premises or water or irrigation facilities</option>

                                                <option value="47">Intimidates or obstructs a Chairperson or a holder of any other office of a Panchayat from performing their normal duties and functions</option>

                                                <option value="3">Kidnapping &amp; Abduction</option>

                                                <option value="29">Manual scavenging or employs or permits the employment of such member for such purpose</option>

                                                <option value="1">Murder</option>

                                                <option value="58">Obstructs or prevents using common property resources of an area, or burial or cremation ground, any river, stream, spring, well, tank, cistern, water-tap or other or any bathing ghat, road or passage</option>

                                                <option value="8">Other Crimes Against SCs</option>

                                                <option value="30">Performs, or promotes dedicating woman to a deity, idol, object of worship, temple as a devdasi</option>

                                                <option value="64">Prevent practicing any profession trade or business or employment in any job</option>

                                                <option value="59">Prevents mounting or riding bicycles or motor cycles or wearing footwear or new clothes in public places</option>

                                                <option value="9">Protection of Civil Rights Act</option>

                                                <option value="16">Ransacking of house hold items and destruction of movable and immovable property</option>

                                                <option value="2">Rape</option>

                                                <option value="11">Refusal to pay wages or contract wages</option>

                                                <option value="25">Removing clothes, painting face or body or any other similar act</option>

                                                <option value="5">Robbery</option>

                                                <option value="10">SC/ST (POA) Act</option>

                                                <option value="61">TBD22</option>

                                                <option value="20">Uses words, acts or gestures of a sexual nature towards a woman</option>

                                                <option value="72">Using lawful power for causing injury or annoyance to a SC/ST person</option>

                                                <option value="7">Voluntarily causing simple hurt and grievous hurt</option>

                                                <option value="26">Wrongfully dispossesses/Cultivates land or premises</option>


                                            </select>
                                        </p>

                                        <p><input type="submit" id="submit_info" value="Search"> <a href="atrocity-cases/any-title/all-states/all-districts/all-atrocities/any-from-date/any-to-date/newer-top" class="read-more">+ Advance search</a> </p>


                                    </form> 
                                </div>









                            </div>
                        </div>
                            <br>

                            <div class="row">


                                <div class='col-md-12'>
                                    <div class="bg-light-blue-active color-palette"><span  style="font-size: 20px " >Case Alerts</span></div>
                                    <div class="pageColumns three">
                                        <div class="column feature">
                                            <div class="columnContent">
                                                <div class="unlimitedAccess">


                                                    <div class="box box-primary">


                                                        <div class="vticker" style="position: relative; height: 196px; overflow: hidden;">
                                                            <ul style="margin: 0px; position: absolute; top: 0px;">		
                                                                <br>
                                                                <li style="margin: 0px;"><span class="blueSpan">1. Sir, Accused Kumar in FIR No 20/2018 under P.S.(ammapet) not yet arrested. Kindly direct the concerned officials to arrest them.SJSA
                                                                        -Maharashtra.</span></li>

                                                                <li style="margin: 0px;"><span class="blueSpan">2. Sir, Spot Inspection report under Rule (6) (1) of PoA Rules in FIR No 20/2018 registered at P.S.(ammapet) on 17-01-2018 not submitted to the state government. Request you to expedite the same.SJSA
                                                                        -Maharashtra.</span></li>

                                                                <li style="margin: 0px;"><span class="blueSpan">3. Sir, Spot Inspection report under Rule (6) (1) of PoA Rules in FIR No 20/2018 registered at P.S.(ammapet) on 17-01-2018 not submitted to the state government. Request you to expedite the same.SJSA
                                                                        -Maharashtra.</span></li>

                                                                <li style="margin: 0px;"><span class="blueSpan">4. Sir, Request you to conduct spot Inspection in FIR No 20/2018 registered under P.S.(ammapet) in atrocity case.SJSA
                                                                        -Maharashtra.</span></li>

                                                                <li style="margin: 0px;"><span class="blueSpan">5. Sir, Request you to conduct spot Inspection in FIR No 20/2018 registered under P.S.(ammapet) in atrocity case.SJSA
                                                                        -Maharashtra.</span></li>




                                                            </span></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                        


                                    </div>




                                </div>


                            </div>
                     

                    </section>









                 
                    <!-- /.content -->
                </div>
                <!-- /.container -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                Developed by <strong>RMK Engineering College</strong> and Designed by <a href="https://adminlte.io">Almsaeed
                    Studio</a>
            </footer>
        </div>
        <!-- ./wrapper -->
    </body>
</html>