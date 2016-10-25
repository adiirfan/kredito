<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo APP_NAME;?> Admnistrative</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url(); ?>/assets/img/favicon.png" type="image/png">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">

    <!-- jquery CSS -->
    <link href="<?php echo base_url(); ?>assets/jquery/css/jquery-ui.min.css" rel="stylesheet" type="text/css">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/metisMenu/css/metisMenu.min.css" rel="stylesheet" type="text/css">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url(); ?>assets/morrisjs/css/morris.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/custom/css/admin-template.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/custom/css/admin.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/custom/css/admin-datatable.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/custom/css/modal-popup.css" rel="stylesheet" type="text/css">
    
    <!-- Script-->
    <script src="<?php echo base_url();?>assets/jquery/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/jquery/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url();?>assets/jquery/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript"><?php include 'assets/custom/js/admin_myprofile.php'; ?></script>
    <script type="text/javascript"><?php include 'assets/custom/js/filter.php'; ?></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url();?>admin/home">Credit Direct v1.0.0.1</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Seow Ming: No function, leave it</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Seow Ming: No function, leave it</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> Seow Ming: No function, leave it
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo get_cookie('admin_fullname');?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" data-modal-id="popup_profile"><i class="fa fa-user fa-fw"></i> My Profile</a>
                        </li>
                        <li><a href="#" data-modal-id="popup_password"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url();?>admin/signout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url();?>admin/home"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li class="<?php if(isset($pLoan) == '1'){echo $pLoan;}else{echo '';} ?>">
                            <a href="#"><i class="fa fa-dollar fa-fw"></i> Loan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url();?>workspace/loan/new">New</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>workspace/loan/processing">Processing</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>workspace/loan/success">Success</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>workspace/loan/rejected">Rejected</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>workspace/loan/cancelled">Cancelled</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>workspace/user/borrower">Borrower List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php if(isset($pInvestment) == '1'){echo $pInvestment;}else{echo '';} ?>">
                            <a href="#"><i class="fa fa-line-chart fa-fw"></i> Investment<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url();?>workspace/investment/new">New</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>workspace/investment/processing">Processing</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>workspace/investment/success">Success</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>workspace/investment/rejected">Rejected</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>workspace/investment/cancelled">Cancelled</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>workspace/user/investor">Investor List</a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php if(isset($pConfiguration) == '1'){echo $pConfiguration;}else{echo '';} ?>">
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Configuration<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url();?>configuration/salutation">Salutation</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>configuration/loan_purpose">Loan Purpose</a>
                                </li>
                                <li>
                                    <a href="#">Investor Preference <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="<?php echo base_url();?>configuration/paid_up_capital">Company Paid Up Capital</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url();?>configuration/man_power">Company Man Power</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url();?>configuration/revenue">Company Revenue</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php if(isset($pAdministration) == '1'){echo $pAdministration;}else{echo '';} ?>">
                            <a href="#"><i class="fa fa-users fa-fw"></i> Administration<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url();?>admin/user_profile">User Profile</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>admin/user_group">User Group</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>admin/activity_log">Activity Log</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        
