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
                'userID'    => '',
                'userName'  => '',
                'firstName' => '',
                'lastName'  => '',
                'Email'     => '',
                'phone'     => '',
                'p_image'   => '',
                'userRole'  => '',
                'logged_in' =>  FALSE,
        );
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        $this->facebook->destroy_session();
        $this->login();
    }
}