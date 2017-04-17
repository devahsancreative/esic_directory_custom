<?php echo $header; ?>
<?php
$userName  = '';
$FirstName = '';
$LastName  = '';
$Email     = '';
$Phone     = '';
if(isset($userData) && !empty($userData)) {
    $userName   = $userData['Username'];
    $FirstName  = $userData['FirstName'];
    $LastName   = $userData['LastName'];
    $Email      = $userData['Email'];
    $Phone      = $userData['Phone'];
}
?>
<style>
    .container .checkbox {
        /* float: left; */
        -ms-transform: scale(1);
        -moz-transform: scale(1);
        -webkit-transform: scale(1);
        -o-transform: scale(1);
        padding: 0px 15px;
    }
    .register-box .register-logo {
        margin-bottom: 5px;
    }
    .register-box-body , .register-box-body form {
        margin-bottom:0px;
    }
    body {
        background: #d2d6de !important;
    }
    body .form-control-feedback {
        right: 10px;
    }
    .has-feedback .form-control {
        font-size: 12px;
    }
    body .register-box {
        max-width: 550px;
        width: 100%;
    }
    .login-box-msg{
        font-size:17px;
    }
    .Listing-body{}
    .Listing-body ul{
        list-style-type: none;
        border: solid thin #777;
        max-width: 50%;
        margin: 0px auto 20px;
        background: rgba(0, 0, 0, 0.88);
        padding: 0px;

    }
    .Listing-body ul li{
        font-size: 18px;
        margin: 10px;
    }
    .Listing-body ul li:hover{
        background: #fff;
    }
    .Listing-body ul li:hover a{
        color: #000;
    }
    .Listing-body ul li a{
        color: #fff;
        padding: 10px;
        display:block;
    }


</style>
<div class="container">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="register-box">
                <div class="login-logo register-logo">
                    <a href="#">
                        <img src="<?= BASE_URL; ?>/images/EsicLogoIcon.png" class="login_logo"
                             style="max-width: 350px;"/> Esic Directory
                    </a>
                </div>
                <div class="register-box-body">
                    <p class="login-box-msg">Thank You <br> Your Account Is Created Please Check Your Email <br>
                    - OR - <br>
                    Start Add Listing</p>
                    <div class="row Listing-body">
                        <div class="col-md-12">
                            <ul class="">
                                <li><a href="<?= BASE_URL; ?>/Esic">Esic</a></li>
                                <li><a href="<?= BASE_URL; ?>/Investor">Investor</a></li>
                                <li><a href="<?= BASE_URL; ?>/Lawyer">Lawyer</a></li>
                                <li><a href="<?= BASE_URL; ?>/Accelerator">Accelerator</a></li>
                                <li><a href="<?= BASE_URL; ?>/GrantConsultant">Grant Consultant</a></li>
                                <li><a href="<?= BASE_URL; ?>/Rnd">Research Partner</a></li>
                                <li><a href="<?= BASE_URL; ?>/RndConsultant">R&amp;D Tax Consultant</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= BASE_URL; ?>/" class="btn btn-primary btn-block btn-flat text-center">
                                Home
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= BASE_URL; ?>/esic_database" class="btn btn-primary btn-block btn-flat text-center">
                                Find Esic
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= BASE_URL; ?>/contact" class="btn btn-primary btn-block btn-flat text-center">
                                Contact
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="<?php echo ADMIN_THEME; ?>/js/jquery.js">
</script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo ADMIN_THEME; ?>/js/bootstrap.min.js">
</script>
<script>
    $(function(){
        // Initiate Facebook JS SDK
        window.fbAsyncInit = function() {
            FB.init({
                appId   : '1854896641432731', // Your app id o
                cookie  : true,  // enable cookies to allow the server to access the session
                xfbml   : false  // disable xfbml improves the page load time
            });
        }
    });
</script>
</body>
</html>

