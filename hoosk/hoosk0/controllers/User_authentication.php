<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_Authentication extends My_Controller
{
    function __construct() {
		parent::__construct();
		// Load user model
		//$this->load->model('user');
    }
    
    public function index(){
		// Include the facebook api php libraries
		include_once APPPATH."libraries/facebook-api-php-codexworld/facebook.php";
       // echo APPPATH;
		// Facebook API Configuration
		$appId = '1854896641432731';
		$appSecret = 'd9fdf021543cc3b533a7917877f99483';
        //$redirectUrl = base_url() . 'user_authentication/';
        //$redirectUrl = base_url() . 'user_authentication/';
		$fbPermissions = 'email';
		
		//Call Facebook API
		$facebook = new Facebook(array(
		  'appId'  => $appId,
		  'secret' => $appSecret
		
		));
	 	$fbuser = $facebook->getUser();

        if ($fbuser) {
			$userProfile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
            // Preparing data for database insertion



		echo 	$userData['oauth_provider'] = 'facebook';
            echo 	$userData['oauth_uid'] = $userProfile['id'];
            echo   $userData['first_name'] = $userProfile['first_name'];
            echo $userData['last_name'] = $userProfile['last_name'];
            echo $userData['email'] = $userProfile['email'];
            echo $userData['gender'] = $userProfile['gender'];
            echo $userData['locale'] = $userProfile['locale'];
            echo $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
            echo $userData['picture_url'] = $userProfile['picture']['data']['url'];
			// Insert or update user data

            $userID = $this->user->checkUser($userData);
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            } else {
               $data['userData'] = array();
            }
        } else {
			$fbuser = '';
            $data['authUrl'] = $facebook->getLoginUrl(array('redirect_uri'=>$redirectUrl,'scope'=>$fbPermissions));
        }
		$this->load->view('user_authentication/index',$data);
    }
	
	public function logout() {
		$this->session->unset_userdata('userData');
        $this->session->sess_destroy();
		redirect('/user_authentication');
    }
}
