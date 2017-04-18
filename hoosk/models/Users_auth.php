<?php
/**
 * Created by PhpStorm.
 * User: COD3R
 * Date: 9/18/2015
 * Time: 2:26 PM
 */

class Users_auth extends CI_Model
{
    //Constructor
    function __construct(){
        //Load All From Parent Class Constructor
        parent::__construct();
    }

    public function login($Where){
        $UserTable = 'hoosk_user';
        $q = $this->db->get_where($UserTable,$Where);
        $users = $q->result_array();
        if(empty($users)){return FALSE;}
        $user = $users[0];
        if(count($user)){
            $data=array(
                'UserID'    => $user['userID'],  
                'Username'  => $user['userName'], 
                'firstName' => $user['firstName'], 
                'lastName'  => $user['lastName'], 
                'Email'     => $user['email'],
                'phone'     => $user['phone'], 
                'p_image'   => $user['p_image'], 
                'userrole'  => $user['userRole'], 
                'LoggedIn'  => TRUE
            );
            //Set the User Role ID also in the Session for Later Use.
            if(isset($roleUserID) && !empty($roleUserID) && is_numeric($roleUserID)){
                $data['UserRoleID'] = $roleUserID;
            }

            $this->session->set_userdata($data);
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function is_logged_in()
    {
        $user_id = $this->session->userdata('UserID');
        if (strlen($user_id) <= 0) {
            // No Login Information Found in the session Object
            // So now we will check if we have in cookies
            if (get_cookie('Username')==true&& get_cookie('Password')==true) {
                $this->authenticate("USE_COOKIES");
            }else
                // nothing found in cookies
                //Store Current Url to Session For Later Use.
                $this->session->set_userdata('last_page', current_url());
            redirect('Login/index');
        }
        return true;
    }
}