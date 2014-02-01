<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NAPS ADMIN</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?= base_url(); ?>css/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url(); ?>css/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="<?= base_url(); ?>css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?= base_url(); ?>css/dashboard/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url(); ?>index.php/">NAPS</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i><?= $user_name ?> <div><?= $user_mail ?></div></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?= base_url();?>index.php/session/destroy"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

        </nav>
        <!-- /.navbar-static-top -->

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="dashboard"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users fa-fw"></i> Users<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="admin_user">Administrator Users</a>
                            </li>
                            <li>
                                <a href="#">Normal Users</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-table fa-fw"></i> Topics</a>
                    </li>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?= $module_name ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?= $content; ?>
                </div>
            </div>
            <!-- /.row -->
        </div>

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page 
jquery-1.11.0.min.js-->
    <script src="<?= base_url(); ?>js/jquery/jquery-1.11.0.min.js"></script>
    <script src="<?= base_url(); ?>css/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="<?= base_url(); ?>js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="<?= base_url(); ?>js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?= base_url(); ?>js/dashboard/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="<?= base_url(); ?>js/demo/dashboard-demo.js"></script>

</body>

</html>
