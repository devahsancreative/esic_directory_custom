<?php echo $header; ?>
<style>
    .btn-signin{
         background-color: #00a65a;
     }
    .btn-fb-signin a {
        color: #fff8f8;
    }
    .fa-facebook {
        margin-right: 10px;
    }
    </style>
 <div class="container">

        <div class="row">

            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">

                    <div class="panel-heading">



<?php /*?><?php echo BASE_URL; ?>/images/<?php echo $settings['siteLogo']; ?><?php */?>
                    <img src="<?php echo ADMIN_THEME; ?>/images/large_logo.png" class="login_logo"

                    style="max-width: 350px;"/>

                    </div>

                    <div class="panel-body">

 <?php if (isset($error)){

					if ($error == "1"){

						echo "<div class='alert alert-danger'>".$this->lang->line('login_incorrect')."</div>";

					}

				} ?>

                        <?php echo form_open(BASE_URL.'/admin/login/check'); ?>

                            <fieldset>

                                <div class="form-group">

                                    <label for="username"><?php echo $this->lang->line('login_username'); ?></label>

										<?php 	$data = array(

                                              'name'        => 'username',

                                              'id'          => 'username',

                                              'class'       => 'form-control',

                                              'value'		=> set_value('username'),

                                              'placeholder'	=> $this->lang->line('login_username')

                                            );



                                            echo form_input($data); ?>

                                </div>

                                <div class="form-group">

                                    <label for="password"><?php echo $this->lang->line('login_password'); ?>:</label>

									 <?php 	$data = array(

                                          'name'        => 'password',

                                          'id'          => 'password',

                                          'class'       => 'form-control',

                                          'value'		=> set_value('password'),

                                          'placeholder'	=> $this->lang->line('login_password')

                                        );



                                        echo form_password($data); ?>

                                </div>


                                <div class="form-group">

                                	<input type="submit" class="btn btn-success btn-signin btn-block" value="<?php echo $this->lang->line('login_signin'); ?>">

                                </div>


                                <div class="form-group">

                                    <button class="btn btn-info btn-block btn-fb-signin"> <a class="button button--social-login button--facebook" id="fbLogin" href="<?php echo $this->facebook->login_url(); ?>">
                                    <i class="icon fa fa-facebook"></i>Login With Facebook</a></button>
                                </div>
                                <a href="<?php echo BASE_URL; ?>/admin/user/forgot" class="text-info"><?php echo $this->lang->line('login_reset'); ?></a>

                            </fieldset>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

<!-- jQuery -->

    <script src="<?php echo ADMIN_THEME; ?>/js/jquery.js"></script>



    <!-- Bootstrap Core JavaScript -->

    <script src="<?php echo ADMIN_THEME; ?>/js/bootstrap.min.js"></script>



</body>



</html>

<script>
    $(function(){

        // Initiate Facebook JS SDK
        window.fbAsyncInit = function() {
            FB.init({
                appId   : '1854896641432731', // Your app id o
                cookie  : true,  // enable cookies to allow the server to access the session
                xfbml   : false,  // disable xfbml improves the page load time

