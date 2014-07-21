<?php
$imii = '<img src="'.base_url().'public/img/inactive.png" alt="">';
$amii = '<img src="'.base_url().'public/img/active.png" alt="">'
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?> | CompetitionDB</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="<?php echo base_url() ?>public/img/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <!-- bootstrap 3.0.2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.min.css">
    <!-- font Awesome -->
    <link href="<?php echo base_url(); ?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="<?php echo base_url(); ?>public/css/ionicons.min.css" rel="stylesheet" type="text/css"/>
    <!-- Morris chart -->
    <link href="<?php echo base_url(); ?>public/css/morris/morris.css" rel="stylesheet" type="text/css"/>
    <!-- jvectormap -->
    <link href="<?php echo base_url(); ?>public/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
          type="text/css"/>
    <!-- fullCalendar -->
    <link href="<?php echo base_url(); ?>public/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
    <!-- Daterange picker -->
    <link href="<?php echo base_url(); ?>public/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet"
          type="text/css"/>
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>public/css/AdminLTE.css" rel="stylesheet" type="text/css"/>
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url(); ?>public/css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>public/css/iCheck/line/blue.css" rel="stylesheet" type="text/css" />
    <!-- slider -->
    <link href="<?php echo base_url(); ?>public/css/bootstrap-slider/slider.css" rel="stylesheet" type="text/css"/>
    <!-- Ion Slider -->
    <link href="<?php echo base_url(); ?>public/css/ionslider/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
    <!-- ion slider Nice -->
    <link href="<?php echo base_url(); ?>public/css/ionslider/ion.rangeSlider.skinNice.css" rel="stylesheet" type="text/css" />
    <!-- ion slider Nice -->
    <link href="<?php echo base_url(); ?>public/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?php echo base_url(); ?>public/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/select2/select2-bootstrap.css">
    <!-- Select -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/select/bootstrap-select.css">
    <!-- Competition Database -->
    <link href="<?php echo base_url(); ?>public/css/cdb.css" rel="stylesheet" type="text/css" />
    
<!--    UPLOAD END-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue fixed">
<!-- header logo: style can be found in header.less -->
<header class="header">
    <a href="<?php echo base_url(); ?>" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        Competition<span class="text-green">DB</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <?php //echo $login_user; ?>
<!--         <div class="fb-like" data-href="competitiondb.io" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true" style="margin-top: 12px; margin-left: 65px;"></div> -->
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <?php if ($is_logged_in): ?>
                    <?php
                        // print_r($is_logged_in);
                        $username = $current_user->username;
                        $user_type = $current_user->position;
                    ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo base_url() ?>public/img/maste-ball.png" alt=""> 
                            <span><?php echo $username ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <img src="<?php echo base_url() ?>public/img/avatar06.png" class="img-circle" alt="User Image" />
                                <p>
                                    <?php echo $username." - ".$user_type ?>
                                    <!-- <small>Member since Nov. 2012</small> -->
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo base_url() ?>admin/account/logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>

</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <!-- <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                    <span class="input-group-btn">
                        <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form> -->
            <ul class="sidebar-menu">
                <li <?php echo(($selected == 'view') ? 'class="active treeview"' : 'class="treeview"'); ?>>
                    <a href="#">
                        <i class="fa fa-book text-green"></i>
                        <span>Codex</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php echo((isset($sub_selected) && $sub_selected == 'view_pokedex') ? 'class="active"' : ""); ?>>
                            <a href="<?php echo site_url('pokedex') ?>">
                                <?php echo((isset($sub_selected) && $sub_selected == 'view_pokedex') ? $amii : $imii); ?>
                                <span>Pokedex</span>
                            </a>
                        </li>
                        <li <?php echo((isset($sub_selected) && $sub_selected == 'view_move') ? 'class="active"' : ""); ?>>
                            <a href="<?php echo site_url('move') ?>">
                                <?php echo((isset($sub_selected) && $sub_selected == 'view_move') ? $amii : $imii); ?>
                                <span>Attack Dex</span>
                            </a>
                        </li>
                        <li <?php echo((isset($sub_selected) && $sub_selected == 'view_ability') ? 'class="active"' : ""); ?>>
                            <a href="<?php echo site_url('ability') ?>">
                                <?php echo((isset($sub_selected) && $sub_selected == 'view_ability') ? $amii : $imii); ?>
                                <span>Abilities Dex</span>
                            </a>
                        </li>
                        <li <?php echo((isset($sub_selected) && $sub_selected == 'view_item') ? 'class="active"' : ""); ?>>
                            <a href="<?php echo site_url('item') ?>">
                                <?php echo((isset($sub_selected) && $sub_selected == 'view_item') ? $amii : $imii); ?>
                                <span>Items Dex</span>
                            </a>
                        </li>
                        <li <?php echo((isset($sub_selected) && $sub_selected == 'view_type') ? 'class="active"' : ""); ?>>
                            <a href="<?php echo site_url('type') ?>">
                                <?php echo((isset($sub_selected) && $sub_selected == 'view_type') ? $amii : $imii); ?>
                                <span>Types</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li <?php echo(($selected == 'tools') ? 'class="active treeview"' : 'class="treeview"'); ?>>
                    <a href="#">
                        <i class="fa fa-cog text-blue"></i>
                        <span>Tools</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php echo((isset($sub_selected) && $sub_selected == 'calc') ? 'class="active"' : ""); ?>>
                            <a href="<?php echo site_url('tools/calc') ?>">
                                <i class="fa fa-terminal"></i>
                                <span>Calculators</span>
                            </a>
                        </li>
                        <li <?php echo((isset($sub_selected) && $sub_selected == 'xytools') ? 'class="active"' : ""); ?>>
                            <a href="<?php echo site_url('tools/xytools') ?>">
                                <i class="fa fa-plus"></i>
                                <span>X/Y Tools</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li <?php echo (($selected == "team_builder") ? 'class="active treeview"' : 'class=""') ?>>
                    <a href="<?php echo site_url('teambuilder') ?>">
                        <i class="fa fa-fire text-red"></i> <span>Team Builder</span>
                    </a>
                </li>
                <?php if ($is_logged_in): ?>
                <li <?php echo(($selected == 'admin') ? 'class="active treeview"' : 'class="treeview"'); ?>>
                    <a href="#">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>Admin</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php echo((isset($sub_selected) && $sub_selected == 'database_control') ? 'class="active"' : ""); ?>>
                            <a href="<?php echo site_url('admin/control_panel/database') ?>">
                                <i class="fa fa-database"></i>
                                <span>Manage Database</span>
                            </a>
                        </li>
                        <li <?php echo((isset($sub_selected) && $sub_selected == 'users_control') ? 'class="active"' : ""); ?>>
                            <a href="<?php echo site_url('admin/control_panel/users') ?>">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Manage Users</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif ?>
                <li <?php echo(($selected == 'faqs') ? 'class="active treeview"' : 'class=""'); ?>>
                    <a href="<?php echo site_url('faqs') ?>">
                        <i class="fa fa-question"></i> <span>FAQs</span>
                    </a>
                </li>
            </ul>
            <span class="col-md-12" style="text-align: center;">
                <p class="text-muted">©<?php echo '2014'; if(date('Y') > 2014) echo " - ".date('Y'); ?> Wildcat</p>
            </span>
        </section>
        <!-- /.sidebar -->
    </aside>