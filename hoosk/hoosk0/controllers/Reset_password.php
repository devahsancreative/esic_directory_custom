<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reset_password extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Hoosk_model');
        $this->load->model('Hoosk_page_model');
        $this->data['settings']=$this->Hoosk_page_model->getSettings();// use for header title
    }
    public function forgot()

    {


        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE)
        {
            $this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
            $this->data['footer'] = $this->load->view('admin/footer', '', true);
            $this->load->view('admin/email_check', $this->data);
        }
        else
        {

            $email = $this->input->post('email');
            $this->load->helper('string');
            $rs= random_string('alnum', 12);
            $data = array(
                'rs' => $rs
            );
            $this->db->where('email', $email);
            $this->db->update('hoosk_user', $data);

            //now we will send an email
            $this->load->library('email');
            $config = array();
            $config['useragent']   = "CodeIgniter";
            $config['mailpath'] = '/usr/sbin/sendmail';
            // $config['protocol']    = "smtp";
            $config['protocol']    = "sendmail";
            $config['smtp_host']   = "gator3083";
            $config['smtp_port']   = "25";
            $config['mailtype']    = 'html';
            $config['charset']     = 'utf-8';
            $config['newline']     = "\r\n";
            $config['wordwrap']    = TRUE;

            $this->email->initialize($config);
            $settings   = $this->Hoosk_model->getSettings();
            $siteEmail  = $settings[0]['siteEmail'];
            $this->email->from($siteEmail, 'From: Esic Directory');
            $this->email->to($email);
            $this->email->subject('Reset Password');
            $login_url = base_url();
            $this->email->message('<h4>Your New Password:  </h4><br>'. $rs .
                "<h5>Please Visit For login:</h5><br>".$login_url.'admin/login');
            $this->email->set_mailtype("html");
            if($this->email->send()){
                $this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
                $this->data['footer'] = $this->load->view('admin/footer', '', true);
                $this->load->view('admin/check', $this->data);
            }else{
                $this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
                $this->data['footer'] = $this->load->view('admin/footer', '', true);
                $this->load->view('admin/email_check', $this->data);
            }

        }
    }
}