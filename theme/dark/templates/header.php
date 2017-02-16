<!DOCTYPE html>
<html lang="en">

	<head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title><?php echo $page['pageTitle']; ?> | <?php echo $settings['siteTitle']; ?> </title>
		<meta name="description" content="<?php echo $page['pageDescription']; ?> " />
		<meta name="keywords" content="<?php echo $page['pageKeywords']; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="<?php echo THEME_FOLDER; ?>css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="<?php echo THEME_FOLDER; ?>/css/socicon.css" rel="stylesheet">
		<link href="<?php echo THEME_FOLDER; ?>/css/styles.css" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
	</head>
<body>



<nav class="navbar navbar-fixed-top navbar-inverse navbar-inverse2">

	<!---- left side menu ------>

	<div id="wrapper">
		<div class="overlay"></div>

		<!-- Sidebar -->
		<nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">

		<div class="leftsidebar">	<?php hooskNav('sidebar') ?>
			<ul class="nav navbar-nav"><li><a href="<?= BASE_URL ?>/admin" >login</a></li></ul>
		</div>

		</nav>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">
			<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
				<span class="hamb-top"></span>
				<span class="hamb-middle"></span>
				<span class="hamb-bottom"></span>
			</button>

		</div>
		<!-- /#page-content-wrapper -->

	</div>
	<!-- /#wrapper -->
    <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--<a class="navbar-brand" href="<?php // echo BASE_URL; ?>">
          <img src="<?php // echo BASE_URL; ?>/images/<?php // echo $settings['siteLogo']; ?>" alt="Hoosk">
      </a>--->


	</div>


    <div class="collapse navbar-collapse">


<?php hooskNav('header') ?>
		<div class="searchbar">
		   <form id="demo-2">
			  <input type="search" placeholder="Search">
		   </form>
		</div>

<style>

	.searchbar a {
		color: #69C;
		text-decoration: none;
	}
	.searchbar a:hover {
		color: #F60;
	}
	.searchbar h1 {
		font: 1.7em;
		line-height: 110%;
		color: #000;
	}
	.searchbar p {
		margin: 0 0 20px;
	}


	.searchbar input {
		outline: none;
	}
	.searchbar input[type=search] {
		background-color: #f7f4f4 !important;
		-webkit-appearance: textfield;
		-webkit-box-sizing: content-box;
		font-family: inherit;
		font-size: 100%;
	}
	.searchbar input::-webkit-search-decoration,
	.searchbar input::-webkit-search-cancel-button {
		display: none;
	}


	.searchbar input[type=search] {
		background: #ededed url(http://static.tumblr.com/ftv85bp/MIXmud4tx/search-icon.png) no-repeat 9px center;
		border: solid 1px #ccc;
		padding: 8px 12px 8px 8px;
		margin: 9px  10%;
		width: 55px;

		-webkit-border-radius: 10em;
		-moz-border-radius: 10em;
		border-radius: 10em;

		-webkit-transition: all .5s;
		-moz-transition: all .5s;
		transition: all .5s;
	}
	.searchbar input[type=search]:focus {
		width: 200px !important;
		background-color: #C2CCD1;
		border-color: #66CC75;

		-webkit-box-shadow: 0 0 5px rgba(109,207,246,.5);
		-moz-box-shadow: 0 0 5px rgba(109,207,246,.5);
		box-shadow: 0 0 5px rgba(109,207,246,.5);
	}


	.searchbar input:-moz-placeholder {
		color: #999;
	}
	.searchbar input::-webkit-input-placeholder {
		color: #999;
	}

	/* Demo 2 */
	.searchbar #demo-2 input[type=search] {
		width: 15px;
		padding-left: 10px;
		color: transparent;
		cursor: pointer;
	}
	.searchbar #demo-2 input[type=search]:hover {
		background-color: #fff;
	}
	.searchbar #demo-2 input[type=search]:focus {
		width: 130px;
		padding-left: 32px;
		color: #000;
		background-color: #fff;
		cursor: auto;
	}
	.searchbar #demo-2 input:-moz-placeholder {
		color: transparent;
	}
	.searchbar #demo-2 input::-webkit-input-placeholder {
		color: transparent;
	}
</style>

</div>

    </div><!-- /.container -->
</nav><!-- /.navbar -->

