<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

    function __construct(){
    parent::__construct();
        $this->load->helper('form');
        $this->load->helper('my_site_helper');
        $this->load->model('User');
    }

    public function index()
    {
        $data=array();
        $user_id = $this->session->userdata('UserID');
        $Username = $this->session->userdata('Username');
        if (empty($user_id) || strlen($user_id) <= 0) {
            $this->load->view('admin/register',$data);
        }else{
            echo 'Already A Member and Logged IN as '.$Username.' !!!.';
        }
    }

    public function signup()
    {
        $this->load->library('form_validation');
        $data = array();
        if(!$this->input->post()){
            $data['messages'][0] = '<p class="text-red">All Fields Are Required !!';
            $this->load->view('admin/register', $data);
            return null;
        }
        $this->form_validation->set_rules('terms', 'Terms', 'required',array(
            'required'      => 'You Must Agree With Our Terms & Conditions.',
        ));
        $Username  = $this->input->post('Username');
        $FirstName = $this->input->post('FirstName');
        $LastName  = $this->input->post('LastName');
        $Email     = $this->input->post('Email');
        $Phone     = $this->input->post('Phone');
       // $Password  = $this->input->post('Password');
        $Password  = esic_random_password_generator();
        if(empty($Username)){
            $Username = $Email;
        }
        $userInputData = array(
            'Username' => $Username,
            'FirstName'=> $FirstName,
            'LastName' => $LastName,
            'Email'    => $Email,
            'Phone'    => $Phone,
            'userRole' => '9', // As Guest First
            'Password' => md5($Password.SALT)
        );
        $data['userData'] = $userInputData;
        //$this->form_validation->set_rules('Username', 'Username', 'trim|required|min_length[5]|max_length[50]|strtolower');
        $this->form_validation->set_rules('FirstName', 'First Name', 'trim|required|min_length[3]|max_length[50]');
        //$this->form_validation->set_rules('LastName', 'LastName', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('Email', 'Email', 'trim|required|min_length[5]|max_length[50]|strtolower');
       // $this->form_validation->set_rules('Phone', 'Phone', 'trim|required|min_length[4]|max_length[20]|strtolower');
        //$this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[5]|max_length[50]');
        //$this->form_validation->set_rules('Repassword', 'ReType Password', 'trim|required|min_length[5]|max_length[50]|matches[Password]');
        if($this->form_validation->run($this) == FALSE){
            $this->load->view('admin/register', $data);
        }else{
           $Message = $this->User->CreateNewUser($userInputData);
           $Message = explode('::', $Message);
           $data['messages'][0] = $Message[1];
           if($Message[0] == 'Success'){
               newUserEmail($this,$$FirstName,$Email, $Password ); // Sending Email To New User
               $this->load->view('admin/register/success', $data);
           }else{
               $this->load->view('admin/register', $data);
           }
        }
    }
}