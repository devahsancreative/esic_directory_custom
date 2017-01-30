





<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo SITE_NAME; ?>  <?=isset($title)?" | ".$title:"";?></title>

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

    <link rel="stylesheet" href="<?= ADMIN_THEME ?>/css/esic-admin.css">
    



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>



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



<script src="<?php echo ADMIN_THEME; ?>/js/jquery-1.10.2.min.js"></script> 



<script src="<?php echo ADMIN_THEME; ?>/js/jquery-ui-1.9.2.js"></script> 

<script src="<?php echo ADMIN_THEME; ?>/js/jquery.nestable.js"></script>



    <script type="text/javascript">

        var base_url = '<?=base_url()?>';

    </script>



<script src="<?php echo ADMIN_THEME; ?>/js/excanvas.min.js"></script> 

<!--script src="<?php //echo ADMIN_THEME; ?>/js/bootstrap.js"></script-->

<script src="<?php echo ADMIN_THEME; ?>/js/base.js"></script>

<?php 

$class   = $this->router->fetch_class();   // it is use only in add new page and edit page condition is use to safe 
if($class   == 'Pages'){?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>  
    
    <script>
	 tinymce.init({
    selector: "body div.st-text-block",
    theme: "modern",
	menubar: false,
	 plugins: [
        ["advlist autolink link image lists charmap preview hr anchor pagebreak spellchecker"],
        ["searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking"],
        ["save table contextmenu directionality emoticons template paste"]
    ],
	
    add_unload_trigger: false,
    schema: "html5",
    inline: true,
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image     | print preview media| table",
    statusbar: false
    });
       /* tinymce.init({
    selector: "body div.st-text-block",
    theme: "modern",
	 plugins: [
        ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker"],
        ["searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking"],
        ["save table contextmenu directionality emoticons template paste"]
    ],
	
    add_unload_trigger: false,
    schema: "html5",
    inline: true,
    toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image     | print preview media",
    statusbar: false
    });*/
	///tinyMCE.execCommand('mceAddControl', true, ".st-text-block");
    
    
    </script>
<?php } ?>    


</head>

<body class="hold-transition skin-blue sidebar-mini">

<div id="wrapper" class="wrapper">

    <header class="main-header">

         

        <a href="<?=base_url('Admin')?>" class="logo">

               

            <span class="logo-mini"><b>E</b>sic</span>

              

            <span class="logo-lg"><b>ESIC</b> <?php // echo $this->session->userdata('userName'); ?></span>

        </a>

        
          
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
           <?php  
		         $userRole = $this->session->userdata('userRole');
		         $userID   = $this->session->userdata('userID');
				 $image    = $this->Common_model->user_logo($userID,$userRole); 
			  
			 
			  if(!empty($image[0]->p_image) && $userRole == 1){?>
				  <img src="<?=base_url()."uploads/admin/". $image[0]->p_image;?>" class="user-image" alt="User Image">
				 <?php } 
                 
			  elseif(!empty($image[0]->logo) && $userRole == 2){// super admin logo  ?>
                 <img src="<?=base_url(). $image[0]->logo;?>" class="user-image" alt="User Image">
			   <?php } 
			  elseif(!empty($image[0]->image) && $userRole == 3){?>
              
				 <img src="<?=base_url()."uploads/investor/". $image[0]->image;?>" class="user-image" alt="User Image">
               <?php }
			  else{?>
				 
				 <img src="<?=base_url()?>assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
				 <?php } ?>
			

                 

                 <span class="hidden-xs"><?php echo $this->session->userdata('userName'); ?></span>

                        </a>

                        <ul class="dropdown-menu">

                            <!-- User image -->

 <li class="user-header">

 <?php
               if(!empty($image[0]->p_image) && $userRole == 1){?>
				  <img src="<?=base_url()."uploads/admin/". $image[0]->p_image;?>" class="img-circle" alt="User Image">
			    <?php } 
                 
			  elseif(!empty($image[0]->logo) && $userRole == 2){// super admin logo  ?>
                 <img src="<?=base_url(). $image[0]->logo;?>" class="img-circle" alt="User Image">
			   <?php } 
			  elseif(!empty($image[0]->image) && $userRole == 3){?>
              
				 <img src="<?=base_url()."uploads/investor/". $image[0]->image;?>" class="img-circle" alt="User Image">
               <?php }
			  else{?>
				 <img src="<?=base_url()?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
				 <?php } ?>
 <p>
     <?php echo $this->session->userdata('userName'); ?>
  </p>

  </li>

                            <!-- Menu Footer-->

                            <li class="user-footer">

                                <div class="pull-left">
<?php 
             if($userRole == 1){?>
				  <a href="<?= base_url()?>admin/users/edit/<?=$userID?>" class="btn btn-default btn-flat">Profile</a>
			    <?php } 
                 
			  elseif($userRole == 2){// super admin logo  ?>
                  <a href="<?= base_url()?>admin/details/<?=$userID?>" class="btn btn-default btn-flat">Profile</a>
			   <?php } 
			  elseif($userRole == 3){?>
              
				 <a href="<?= base_url()?>admin/investor/edit_profile/<?=$userID?>" class="btn btn-default btn-flat">Profile</a>
               <?php }
			  else{?>
				 
				 <a href="#" class="btn btn-default btn-flat">Profile</a>
				 <?php } ?>

                                </div>

                                <div class="pull-right">

                                   

                                    <a href="<?php echo BASE_URL ; ?>/admin/logout" class="btn btn-default btn-flat">Sign out</a>

                                </div>

                            </li>
                                     
                          

                        </ul>

                    </li>

                     

                </ul>

            </div>

        </nav>
 
    </header>



    <!-- Left side column. contains the logo and sidebar -->

    <?php $this->load->view('admin/components/main-sidebar/main'); ?>

        <!-- Navigation -->



    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->



        <div id="page-wrapper">