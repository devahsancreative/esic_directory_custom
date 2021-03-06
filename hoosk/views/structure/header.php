<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript"> base_url = '<?= base_url();?>';</script>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?php echo $page['pageTitle']; ?> | <?php echo $settings['siteTitle']; ?> </title>
    <meta name="description"    content="<?= $page['pageDescription']; ?> " />
    <meta name="keywords"       content="<?= $page['pageKeywords']; ?>" />
    <meta name="viewport"       content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="<?= THEME_FOLDER; ?>css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <link href="<?= base_url();?>assets/css/form2.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/css/boxlisting2.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
    <!--link href="<?= base_url();?>assets/css/listing.css" rel="stylesheet"-->
    <link href="<?= THEME_FOLDER; ?>/css/socicon.css" rel="stylesheet">
    <link href="<?= THEME_FOLDER; ?>/css/styles.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" integrity="sha384-dNpIIXE8U05kAbPhy3G1cz+yZmTzA6CY8Vg/u2L9xRnHjJiAK76m2BIEaSEV+/aU" crossorigin="anonymous">
    <!--script src="https://code.jquery.com/jquery-1.12.4.js"  integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
            crossorigin="anonymous"></script-->
 <script src="<?= base_url();?>theme/admin/js/jquery-1.12.4.js"></script>
    <!--script src="<?= ADMIN_THEME; ?>/js/jquery-1.10.2.min.js"></script-->
    <script src="<?= base_url();?>assets/js/jquery-ui.js" type="text/javascript"></script>
    <script src="<?= base_url();?>assets/js/bootstrap-datepicker.js" type="text/javascript" async defer></script>
    <script src="<?= base_url();?>assets/js/daterangepicker.js" type="text/javascript" async defer></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url();?>assets/js/moment.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="<?= base_url();?>assets/js/form.js" type="text/javascript" async defer></script>
    <style type="text/css">
    	.modal-dialog {
			left: 0!important;
		}
    </style>
</head>
<body ng-app="main-App">
<nav class="navbar navbar-fixed-top navbar-inverse navbar-inverse2">
    <div id="wrapper">
        <div class="overlay"></div>
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <div class="leftsidebar"><?php hooskNav('sidebar') ?>
                <ul class="nav navbar-nav left-login-b">
                    <?php  if(!$UserLoggedIn){ ?>
                            <li>
                                <a href="<?= BASE_URL ?>/register" >
                                    Sign Up
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL ?>/admin" >
                                    login
                                </a>
                            </li>
                    <?php }else{ ?>
                            <li>
                                <a href="<?= BASE_URL ?>/logout" >
                                    Logout
                                </a>
                            </li>
                    <?php } ?>
                </ul>
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
        <a class="" href="<?php echo BASE_URL; ?>">
            <img class="img-responsive_logo " src="<?php echo BASE_URL; ?>/images/<?php echo $settings['siteLogo']; ?>" alt="Hoosk" />
        </a>
    </div>
    <ul class="nav navbar-nav login_button">
        <?php 
            if(!$UserLoggedIn){
        ?>
                <li>
                    <a href="<?= BASE_URL ?>/register" >
                        <i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>/admin" >
                        <i class="fa fa-sign-in" aria-hidden="true"></i> login
                    </a>
                </li>
            <?php }else{ ?>
                <li>
                    <a href="<?= BASE_URL ?>/logout" >
                        <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                    </a>
                </li>
        <?php } ?>
    </ul>
    <!-- /#wrapper -->
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse right_sidebar">
            <div class="searchbar">
                <form id="demo-2">
                    <input type="search" placeholder="Find an ESIC">
                </form>
            </div>
            <?php hooskNav('header') ?>
            <script type="text/javascript">
                if(typeof(tosJSON) != "undefined" && tosJSON !== null) {
                    var data_array = JSON.parse(tosJSON);
                }else{
                    var data_array = '';
                }
            </script>
            <style>
                .login_button{
                    float: right;
                    margin-right: 1%;
                }
                .login-icon{

                }
                /*search box style */
                .searchbar   {
                    width: 244px;
                    display: block;
                    position: relative;
                    float: left;
                }
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
                    background-color: #fff !important;
                    -webkit-appearance: textfield;
                    -webkit-box-sizing: content-box;
                    font-family: inherit;
                    font-size: 100%;
                }
                .searchbar input::-webkit-search-decoration,
                .searchbar input::-webkit-search-cancel-button {
                    /*display: none;*/
                }


                .searchbar input[type=search] {
                    background: #fff url(http://ctsdemo.com/demos/esic_directory/images/search-icon.png) no-repeat 9px center;
                    border: solid 1px #ccc;
                    padding: 3px 5px 5px 5px;
                    margin: 13px 10%;
                    width: 55px;

                    -webkit-border-radius: 10em;
                    -moz-border-radius: 10em;
                    border-radius: 10em;

                    -webkit-transition: all .5s;
                    -moz-transition: all .5s;
                    transition: all .5s;
                }
                .searchbar input[type=search]:focus {
                    width: 148px !important;
                    background-color: #fff;
                    border-color: #66CC75;

                    -webkit-box-shadow: 0 0 5px rgba(109,207,246,.5);
                    -moz-box-shadow: 0 0 5px rgba(109,207,246,.5);
                    box-shadow: 0 0 5px rgba(109,207,246,.5);
                }


                .searchbar input:-moz-placeholder {
                    color: black  ;
                    font-family: "Open Sans";
                    padding-left: 10px;
                }
                .searchbar input::-webkit-input-placeholder {
                    color: black  ;
                    font-family: "Open Sans";
                    padding-left: 30px;
                }

                /* Demo 2 */
                .searchbar #demo-2 input[type=search] {
                    width: 170px;
                    font-family: "Open Sans";
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
                    color: black  ;
                    font-family: "Open Sans";
                    padding-left: 30px;
                }
                .searchbar #demo-2 input::-webkit-input-placeholder {
                    color: black;
                    font-family: "Open Sans";
                    padding-left: 30px;
                }
                @media (min-width: 767px){
                    #navbar-collapse-main{
                        display: block!important;
                    }
                }
                @media (max-width: 768px){
                    #navbar-collapse-main{
                        display: none;
                    }
                }
            </style>
        </div>
    </div>    <!-- /.container -->
</nav><!-- /.navbar -->

