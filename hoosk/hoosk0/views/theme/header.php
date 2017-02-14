
<!--this header is use for custom pages that are use to direct link contact us and in other forms --->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title><?php if ($page['pageTitle']==""){echo "ESIC Directory";}else{ echo $page['pageTitle']; ?> | <?php }echo $settings['siteTitle']; ?> </title>
		<meta name="description" content="<?php echo $page['pageDescription']; ?> " />
		<meta name="keywords" content="<?php echo $page['pageKeywords']; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="<?php echo THEME_FOLDER; ?>css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

        
		<!--link href="<?php// echo THEME_FOLDER; ?>css/bootstrap.min.css" rel="stylesheet"-->
	    <link href="<?php echo THEME_FOLDER; ?>css/socicon.css" rel="stylesheet">
		<link href="<?php echo THEME_FOLDER; ?>css/styles.css" rel="stylesheet">  
    <!--  End   -->
   
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
        
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        
     
          <!--script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script-->
        
<link href="<?= base_url();?>assets/css/form2.css" rel="stylesheet">
<link href="<?= base_url();?>assets/css/boxlisting2.css" rel="stylesheet">
<link href="<?= base_url();?>assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />


 <!--script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script-->
   <script src="https://code.jquery.com/jquery-1.12.4.js"  integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
  crossorigin="anonymous"></script>
<script src="<?= base_url();?>assets/js/jquery-ui.js" type="text/javascript"></script>

<script src="<?= base_url();?>assets/js/bootstrap-datepicker.js" type="text/javascript" async defer></script>
<script src="<?= base_url();?>assets/js/daterangepicker.js" type="text/javascript" async defer></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/moment.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="<?= base_url();?>assets/js/form.js" type="text/javascript" async defer></script>
	</head>
<body>


<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      </div>
    <div class="collapse navbar-collapse">
           
 
<?php hooskNav('header') ?>
        <ul class="nav navbar-nav"><li><a href="<?= base_url()?>admin" >login</a></li></ul>
</div>
    </div><!-- /.container -->
</nav><!-- /.navbar -->
