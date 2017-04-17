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
    .message-response li, .message-response p{
        color:red;
    }
    body .register-box {
        max-width: 550px;
        width: 100%;
    }
    .login-box-msg{
        font-size:17px;
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
                        <img src="<?php echo BASE_URL; ?>/images/EsicLogoIcon.png" class="login_logo"
                             style="max-width: 350px;"/> Esic Directory
                    </a>
                </div>
                <div class="register-box-body">
                    <p class="login-box-msg">One account to manage all your Esic Directory services</p>
                    <div class="message-response">
                        <?php if(isset($messages) && !empty($messages)){
                            echo '<ul>';
                                foreach($messages as $message){
                                   echo '<li>'.$message.'</li>';
                                }
                            echo '</ul>';
                        } ?>
                        <?php echo validation_errors(); ?>
                    </div>
                    <form action="<?= base_url().'Register/createmember';?>" method="post">
                        <div class="row">
                            <!--div class="form-group has-feedback col-md-12">
                                <input type="text" class="form-control" name="Username" placeholder="Username" value="<?=$userName;?>">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div-->
                            <div class="form-group has-feedback col-md-6">
                                <input type="text" class="form-control" name="FirstName" placeholder="First Name" value="<?=$FirstName;?>">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <!--div class="form-group has-feedback col-md-6">
                                <input type="text" class="form-control" name="LastName" placeholder="Last Name" value="<?=$LastName;?>">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div-->
                            <div class="form-group has-feedback col-md-6">
                                <input type="email" class="form-control" name="Email" placeholder="Email" value="<?=$Email;?>">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <!--div class="form-group has-feedback col-md-6">
                                <input type="number" class="form-control" name="Phone" placeholder="Phone" value="<?=$Phone;?>">
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                            </div-->
                            <!--div class="form-group has-feedback col-md-6">
                                <input type="password" class="form-control" name="Password" placeholder="Password">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback col-md-6">
                                <input type="password" class="form-control" name="Repassword" placeholder="Retype password">
                                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                            </div-->
                            <div class="col-md-12">
                                    <div class="col-md-8">
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox" name="terms" checked> I agree to the <a target="_blank" href="<?= BASE_URL; ?>/terms-of-uses">terms & conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                                    </div>
                                   <div class="col-md-6">
                                    <a href="<?= BASE_URL; ?>/admin/login" class="btn btn-primary btn-block btn-flat text-center">
                                       Have An Account ?
                                    </a>
                                  </div>
                            </div>
                        </div>
                    </form>

                    <div class="social-auth-links text-center">
                        <p>- OR Sign up using - </p>
                        <div class="row">
                            <div class="col-md-4">
                                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" class="btn btn-block btn-social btn-google btn-flat">
                                    <i class="fa fa-google-plus"></i> Google+
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" class="btn btn-block btn-social btn-twitter btn-flat">
                                    <i class="fa fa-twitter"></i> Twitter
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--div class="already-member">
                        <div class="row">
                            <div class="col-md-offset-2 col-md-8">
                                <a href="<?= BASE_URL; ?>/admin/login" class="btn btn-primary btn-block btn-flat text-center">I already have a membership</a>
                            </div>
                        </div>
                    </div-->
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

