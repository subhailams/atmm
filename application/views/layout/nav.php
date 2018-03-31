<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>ATM</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?= $this->lang->line('atrocity_tracking') ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
                        <span class="hidden-xs"><?= $_SESSION['UserFullName'] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php
                            if ($profileurl == null):
                                $profileurl = 'user4-128x128.jpg';
                            endif;
                            ?>
                            <img src="<?= base_url("assets/img/" . $profileurl) ?>" class="img-circle"
                                 alt="User Image">
                            <p>
                                <?= $_SESSION['UserFullName'] ?>
                            </p>
                            <p><small><?= $_SESSION['UserRoleName'] ?></small></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">

                            <div class="pull-right">
                                <a href="<?= base_url('index.php/' . $this->router->fetch_class() . '/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url("assets/img/" . $profileurl) ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $_SESSION['UserFullName'] ?></p>
                <a href="#"><?= $_SESSION['UserRoleName'] ?></a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Navigation Menu</li>
            <li>
                <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/index") ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span><?= $this->lang->line('user_management') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/updateprofile") ?>"><i
                                class="fa fa-circle-o"></i><?= $this->lang->line('update_profile') ?></a></li>
                    <li>
                        <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/changepassword") ?>"><i
                                class="fa fa-circle-o"></i><?= $this->lang->line('change_password') ?></a></li>
                    
                    
                    


                        <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/offencesandcompensations") ?>"><i
                                class="fa fa-circle-o"></i><?= $this->lang->line('offences_and_compensations') ?></a></li>
                                <li>
                        <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/postcomplaints") ?>"><i
                                class="fa fa-circle-o"></i><?= $this->lang->line('post_complaints') ?></a></li>

                </ul>
            </li>
            <?php if (strtoupper($_SESSION['UserRoleName']) == "ADMINISTRATOR"): ?>
               
            <?php endif; ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-paper-plane"></i>
                    <span><?= $this->lang->line('case_management') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php if (strtolower($_SESSION['UserRoleName']) != "organization" && strtolower($_SESSION['UserRoleName']) != "user"): ?>
                        <li>
                            <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/newcase") ?>"><i
                                    class="fa fa-circle-o"></i> <?= $this->lang->line('register_new_case')?></a></li>      
                        <?php endif; ?>
                    <li>
                        <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/allcases") ?>"><i
                                class="fa fa-circle-o"></i></<?= $this->lang->line('show_all_cases') ?></a></li>
                        <?php if (strtolower($_SESSION['UserRoleName']) != "user"): ?>
                        <li>
                            <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/cases/alloffenders") ?>"><i
                                    class="fa fa-circle-o"></i> Show all Offenders</a></li>
                        <?php endif; ?>
                    <li>
                        <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/complaint/allcomplaints") ?>"><i
                                class="fa fa-circle-o"></i> Show all User Complaints</a></li>
                        <?php if (strtolower($_SESSION['UserRoleName']) == "user"): ?>
                        <li>
                            <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/postcomplaints") ?>"><i
                                    class="fa fa-circle-o"></i>Post Complaints</a></li>
                        <?php endif; ?>
                </ul>
            </li>

            <li>
                <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/messages/show") ?>">
                    <i class="fa fa-medium"></i> <span>Messages</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/logout") ?>">
                    <i class="fa fa-power-off"></i> <span>Logout</span>
                </a>
            </li>
            <li class="header">Change Language</li>
            <li>
                <?php if (!$this->session->userdata('site_lang') == 'english'): ?>
                    <a href="#">
                    <?php else: ?>
                        <a href="<?= base_url("index.php/LanguageSwitcher/switchLang/english") ?>">
                        <?php endif; ?>
                        <i class="fa fa-language"></i> <span>English</span>
                        <span class="pull-right-container"></span>
                        <?php if ($this->session->userdata('site_lang') == 'english'): ?>
                            <i class="fa fa-check pull-right" style="color: green"></i>
                        <?php endif; ?>
                    </a>
            </li>
            <li>
                <?php if ($this->session->userdata('site_lang') == 'marathi'): ?>
                    <a href="#">
                    <?php else: ?>
                        <a href="<?= base_url("index.php/LanguageSwitcher/switchLang/marathi") ?>">
                        <?php endif; ?>
                        <i class="fa fa-language"></i> <span> मराठी - (Marathi)</span>
                        <span class="pull-right-container"></span>
                        <?php if ($this->session->userdata('site_lang') == 'marathi'): ?>
                            <i class="fa fa-check pull-right" style="color: green"></i>
                        <?php endif; ?>
                    </a>
            </li>
            <li>
                <?php if ($this->session->userdata('site_lang') == 'hindi'): ?>
                    <a href="#">
                    <?php else: ?>
                        <a href="<?= base_url("index.php/LanguageSwitcher/switchLang/hindi") ?>">
                        <?php endif; ?>
                        <i class="fa fa-language"></i> <span> हिंदी - (Hindi) </span>
                        <span class="pull-right-container"></span>
                        <?php if ($this->session->userdata('site_lang') == 'hindi'): ?>
                            <i class="fa fa-check pull-right" style="color: green"></i>
                        <?php endif; ?>
                    </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar-->
</aside>