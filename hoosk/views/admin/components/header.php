<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ESIC Directory <?=isset($title)?" | ".$title:"";?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">


    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?= base_url()?>assets/vendors/datatables/responsive.bootstrap.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url()?>assets/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_url()?>assets/css/_all-skins.min.css">
    <link href="<?= base_url()?>assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <![endif]-->
    <style type="text/css" media="screen">
     .add-New-container{
            text-align: right;
            padding: 5px 0px;
      }
      .addNewBtn{
            background-color: #337ab7;
            color: #fff;
            padding: 5px 20px;
      }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper compo-header">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?=base_url('Admin')?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>E</b>sic</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>ESIC</b> Admin</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?=base_url()?>assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"> <?php echo $this->session->userdata('userName'); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?=base_url()?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                     <?php echo $this->session->userdata('userName'); ?>
                                    <small></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?=base_url()?>Login/logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
<!--                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>-->
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('admin/components/main-sidebar/main'); ?>
