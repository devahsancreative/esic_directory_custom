<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MY_Controller {
    function __construct(){
        parent::__construct();
    }

    public function login(){
        $this->load->helper('form');
        $data['settings'] = $this->Hoosk_model->getSettings();
        $data['header'] = $this->load->view('admin/headerlog', '', true);
        $data['footer'] = $this->load->view('admin/footer', '', true);
        $this->load->view('admin/login',$data);
    }
    public function loginCheck(){
        $username=$this->input->post('username');
        $password=md5($this->input->post('password').SALT);
        $result=$this->Hoosk_model->login($username,$password);
        if($result) {
            redirect('/admin', 'refresh');
        }else{
            $this->data['error'] = "1";
            $this->login();
        }
    }
    public function logout(){
        $data = array(
                'userID'    =>  '',
                'userName'  =>  '',
                'logged_in' =>  FALSE,
        );
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        $this->facebook->destroy_session();
        $this->login();
    }
/*
    public function index()
    {
        $data=array();
        //First Check If User Needs the Login Page or Not.
        //Lets Load the Login Page First.
        $user_id = $this->session->userdata('UserID');
        if (empty($user_id) || strlen($user_id) <= 0) {
            $this->load->helper('form');
            $this->load->view('admin/login',$data);
        }else{
            $lastPage = $this->session->userdata('last_page');
            if(!isset($lastPage) || empty($lastPage) || strtolower($lastPage) == strtolower(base_url()."login/login")){
                //If There is No Last Page, Then Redirect User According to Its Permissions.
                $userRole = $this->session->userdata('Role');
                //What if No Role is Defined Then We Really Need Him to log back in.
                if(!isset($userRole) || empty($userRole)){
                    $this->session->unset_userdata('UserID');
                    $this->session->sess_destroy();
                    $this->load->view('login',$data);
                    return;
                }
                redirect('Admin/index');
            }else{
                //checking if valid
                $headerStatus =  get_headers($lastPage, 1);
                if ($headerStatus === 'HTTP/1.1 200 OK'){
                    redirect($lastPage); // redirect to the main URI of the Site for the current
                }else{
                    $this->session->unset_userdata('last_page');
                    $this->index();
                }
            }

            echo "If You are seeing this Message, Please Report to The Respected Administrator To Solve This Issue.";
        }
    }

    public function login(){

        //Redirect User if did Accessed to This Page Directly
        if(!$this->input->post()){
            redirect(PreviousURL());
        }
        $this->load->library('form_validation');

        $this->form_validation->set_rules('Username', 'Username', 'trim|required|min_length[5]|max_length[50]|strtolower|xss_clean');
        $this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[5]|max_length[50]|xss_clean');
        $this->form_validation->run();

        $username = $this->input->post('Username');
        $password = $this->input->post('Password');

        $where = 'password = "'.$password.'" AND (username = "'.$username.'" OR email = "'.$username.'")';
        $result = $this->Users_auth->login($where);

        // if the user successfully logged in, then result will be TRUE
        if($result === TRUE){

            $lastPage = $this->session->userdata('last_page');
            if(!isset($lastPage) || empty($lastPage)){
                //If There is No Last Page, Then Redirect User According to Its Permissions.
                redirect('Admin/index');

            }
            redirect($lastPage); // redirect to the main URI of the Site for the current
        }else{
            $alertMsg = "Email or Password does not match::error::Invalid Credentials";
            $this->session->set_flashdata('alertMsg',$alertMsg);
            $this->index();
            return;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'Admin', 'refresh');
    }*/
}