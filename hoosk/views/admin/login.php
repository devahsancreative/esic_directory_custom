<?php echo $header; ?>
<style>
  .btn-signin{
    background-color: #2c3e50;
    border-color: #2c3e50;
  }
  .btn-fb-signin a {
    color: #fff8f8;
  }
  .fa-facebook {
    margin-right: 10px;
  }
  body.login .panel-default>.panel-heading {
    background: #fff;
  }
  .panel-default {
    border-color: cornflowerblue;
  }
  .btn-success.active, .btn-success:active, .btn-success:hover, .open>.dropdown-toggle.btn-success {
    color: #fff;
    background-color: #1a242f;
    border-color: #161f29;
  }
  .login_logo{
    display: inline-block;
  }
  body .login-box-msg{
    padding:10px 0px;
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
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="<?= base_url(); ?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>

  <div class="row">
    <div class="col-md-4 col-md-offset-4">
       <div class="login-box">
            <div class="login-logo">
                <a href="#"><img src="<?= BASE_URL; ?>/images/EsicLogoIcon.png" class="login_logo"
               style="max-width: 350px;"/> <b>Esic</b> Directory</a>
            </div><!-- /.login-logo -->
      </div><!-- /.login-box -->    
      <div class="login-panel panel panel-default">
        <div class="panel-heading">
            <p class="login-box-msg">Sign in to start your session</p>
        </div>
        <div class="panel-body">
          <?php 
            if (isset($error)){
                if ($error == "1"){
                echo "<div class='alert alert-danger'>".$this->lang->line('login_incorrect')."</div>";
                }
            } 
          ?>
          <?php echo form_open(BASE_URL.'/login/check'); ?>
          <fieldset>
            <div class="form-group">
              <label for="username">
                <?php echo $this->lang->line('login_username'); ?>
              </label>
              <?php     
                    $data = array(
                        'name'        => 'username',
                        'id'          => 'username',
                        'class'       => 'form-control',
                        'value'       => set_value('password'),
                        'placeholder' => $this->lang->line('login_username')
                    );
                    echo form_input($data); ?>
            </div>
            <div class="form-group">
              <label for="password">
                <?php echo $this->lang->line('login_password'); ?>:
              </label>
              <?php     
                $data = array(
                        'name'        => 'password',
                        'id'          => 'password',
                        'class'       => 'form-control',
                        'value'       =>'',
                        'placeholder' => $this->lang->line('login_password')
                        );
                echo form_password($data); 
            ?>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-success btn-signin btn-block" value="<?php echo $this->lang->line('login_signin'); ?>">
            </div>
              <div class="social-auth-links text-center">
                  <p>- OR Sign In using </p>
                  <div class="row">
                      <div class="col-md-6">
                          <a href="<?= $this->facebook->login_url(); ?>" id="fbLogin" class="btn btn-block btn-social btn-facebook btn-fb-signin btn-flat">
                              <i class="fa fa-facebook"></i> Facebook
                          </a>
                      </div>
                      <div class="col-md-6">
                          <a href="#" class="btn btn-block btn-social btn-google btn-flat">
                              <i class="fa fa-google-plus"></i> Google+
                          </a>
                      </div>
                  </div>
              </div>
            <a href="<?php echo BASE_URL; ?>/admin/reset_password/forgot" class="text-info">
              <?php echo $this->lang->line('login_reset'); ?>
            </a>
            <br>
            <a href="<?php echo BASE_URL; ?>/register" class="text-info">
                  Not Have An Account ? Register Now
            </a>
          </fieldset>
          </form>
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

