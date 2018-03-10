header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>ATM</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Atrocity Tracking</b></span>
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
                        <span class="hidden-xs">Alexander Pierce</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= base_url("assets/img/user2-160x160.jpg") ?>" class="img-circle"
                                 alt="User Image">
                            <p>
                                Alexander Pierce - Web Developer
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat">Sign out</a>
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
                <img src=<?= base_url("assets/img/user2-160x160.jpg") ?> class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
                    <span>User Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/updateprofile") ?>"><i
                                    class="fa fa-circle-o"></i> Update Profile</a></li>
                    <li>
                        <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/changepassword") ?>"><i
                                    class="fa fa-circle-o"></i> Change Password</a></li>
                    <li>
                        <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/importantcontacts") ?>"><i
                                    class="fa fa-circle-o"></i> Important Contacts</a></li>

                    <li>
                        <a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/offencesandpunishments") ?>"><i
                                    class="fa fa-circle-o"></i>Offences and Punishments</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-black-tie"></i>
                    <span>Role Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> Create New Role</a></li>
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> Role Users</a></li>
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> All Roles</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-paper-plane"></i>
                    <span>Case Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> Register New Case</a></li>
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> Show all Cases</a></li>
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> Case History</a></li>
                </ul>
            </li>

            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-medium"></i> <span>Messages</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>Admin Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url("index.php/" . strtolower($this->router->fetch_class()) . "/logs") ?>"><i
                                    class="fa fa-circle-o"></i> Show Logs</a></li>
                </ul>
            </li>
            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-power-off"></i> <span>Logout</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="header">Change Language</li>
            <li>
                <a href="<?= base_url("index.php/LanguageSwitcher/switchLang/english") ?>">
                    <i class="fa fa-language"></i> <span>English</span>
                    <span class="pull-right-container"></span>
                    <?php if ($this->session->userdata('site_lang') == 'english'): ?>
                        <i class="fa fa-check pull-right" style="color: green"></i>
                    <?php endif; ?>
                </a>
            </li>
            <li>
                <a href="<?= base_url("index.php/LanguageSwitcher/switchLang/marathi") ?>">
                    <i class="fa fa-language"></i> <span> मराठी</span>
                    <span class="pull-right-container"></span>
                    <?php if ($this->session->userdata('site_lang') == 'marathi'): ?>
                        <i class="fa fa-check pull-right" style="color: green"></i>
                    <?php endif; ?>
                </a>
            </li>
            <li>
                <a href="<?= base_url("index.php/LanguageSwitcher/switchLang/hindi") ?>">
                    <i class="fa fa-language"></i> <span> हिंदी</span>
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