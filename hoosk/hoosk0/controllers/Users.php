<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		Admincontrol_helper::is_logged_in($this->session->userdata('userID'));
		$userRole = $this->session->userdata('userRole');
		if($userRole == 1){
			define("HOOSK_ADMIN",1);
			$this->load->model('Hoosk_model');
			$this->load->model('common_model');
			$this->load->helper(array('admincontrol', 'url'));
			$this->load->library('session');
			define ('LANG', $this->Hoosk_model->getLang());
			$this->lang->load('admin', LANG);
			$this->data['current'] = $this->uri->segment(2);
			define ('SITE_NAME', $this->Hoosk_model->getSiteName());
			define('THEME', $this->Hoosk_model->getTheme());
			define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);
		}else{
			  $this->load->view('admin/page_not_found');
			  }
		
		  
	}

	public function index()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
        $userRole = $this->session->userdata('userRole');
        if($userRole == 1){
        $this->load->library('pagination');
        $search = $this->input->post('username');
		$result_per_page =15;  // the number of result per page
		$config['base_url'] = BASE_URL. '/admin/users/';
		$config['total_rows'] = $this->Hoosk_model->countUsers();
		$config['per_page'] = $result_per_page;
		$config['full_tag_open'] = '<div class="form-actions">';
		$config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

		//Get users from database
		$this->data['users'] = $this->Hoosk_model->getUsers($result_per_page, $this->uri->segment(3),$search);
		$this->data['roles'] = $this->Hoosk_model->getRoles();

		//Load the view
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/users', $this->data);
        }else{
            $this->load->view('admin/page_not_found');
        }
	}

	public function addUser()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form helper
        $userRole = $this->session->userdata('userRole');
        if($userRole == 1){
            $this->load->helper('form');
            //Load the view
            $this->data['roles'] = $this->Hoosk_model->getRoles();
            $this->data['header'] = $this->load->view('admin/header', $this->data, true);
            $this->data['footer'] = $this->load->view('admin/footer', '', true);
            $this->load->view('admin/user_new', $this->data);
      }else{
            $this->load->view('admin/page_not_found');
        }
}


	public function confirm()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form validation library 
		$this->load->library('form_validation');
		//Set validation rules
		$this->form_validation->set_rules('username', 'username', 'trim|alpha_dash|required|is_unique[hoosk_user.userName]');
		$this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email|is_unique[hoosk_user.email]');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('con_password', 'confirm password','trim|required|matches[password]');


		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->addUser();
		}  else  {
			//Validation passed
			//Add the user
			$this->Hoosk_model->createUser();
			//Return to user list
			redirect('/admin/users', 'refresh');
	  	}
	}

	public function editUser()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form helper
        $userRole = $this->session->userdata('userRole');
        if($userRole == 1){
            $this->load->helper('form');
            //Get user details from database
            $this->data['users'] = $this->Hoosk_model->getUser($this->uri->segment(4));
            $this->data['roles'] = $this->Hoosk_model->getRoles();
            //Load the view
            $this->data['header'] = $this->load->view('admin/header', $this->data, true);
            $this->data['footer'] = $this->load->view('admin/footer', '', true);
            $this->load->view('admin/user_edit', $this->data);
        }else{
            $this->load->view('admin/page_not_found');
        }
	}

	public function edited()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form validation library
		$this->load->library('form_validation');
		//Set validation rules
		$this->form_validation->set_rules('email', 'email address', 'trim|required|valid_email|is_unique[hoosk_user.email.userID.'.$this->uri->segment(4).']');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('con_password', 'confirm password','trim|required|matches[password]');


		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->editUser();
		}  else  {
			//Validation passed
			//Update the user
			$this->Hoosk_model->updateUser($this->uri->segment(4));
			//Return to user list
			redirect('/admin/users', 'refresh');
	  	}
	}


		function delete()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		if($this->input->post('deleteid')):
			$this->Hoosk_model->removeUser($this->input->post('deleteid'));
			redirect('/admin/users');
		else:
			$this->data['form']=$this->Hoosk_model->getUser($this->uri->segment(4));
			$this->load->view('admin/user_delete.php', $this->data );	
		endif;
	}

	/************** Forgotten Password Resets **************/

	public function forgot()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
			$this->data['footer'] = $this->load->view('admin/footer', '', true);
			$this->load->view('admin/email_check', $this->data);
		}
		else
		{
			$email= $this->input->post('email');
			$this->load->helper('string');
			$rs= random_string('alnum', 12);
			$data = array(
			'rs' => $rs
			);
			$this->db->where('email', $email);
			$this->db->update('hoosk_user', $data);

			//now we will send an email
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;


			$this->load->library('email', $config);

			$this->email->from('password@'.EMAIL_URL, SITE_NAME);
			$this->email->to($email);

			$this->email->subject($this->lang->line('email_reset_subject'));
			$this->email->message($this->lang->line('email_reset_message')."\r\n".BASE_URL.'/admin/reset/'.$rs );

			$this->email->send();
			$this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
			$this->data['footer'] = $this->load->view('admin/footer', '', true);
			$this->load->view('admin/check', $this->data);
		}
 }

	public function email_check($str)
	{
		$query = $this->db->get_where('hoosk_user', array('email' => $str), 1);
		if ($query->num_rows()== 1)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('email_check', $this->lang->line('email_check'));
			return false;
		}
	}


	public function getPassword()
	{
		$rs = $this->uri->segment(3);
		$query=$this->db->get_where('hoosk_user', array('rs' => $rs), 1);

     	if ($query->num_rows() == 0)
      	{
		    $this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
			$this->data['footer'] = $this->load->view('admin/footer', '', true);
			$this->load->view('admin/error', $this->data);

      	}
      	else
      	{
			$this->load->database();
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[20]|matches[con_password]');
			$this->form_validation->set_rules('con_password', 'Password Confirmation', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				echo form_open();
				$this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
				$this->data['footer'] = $this->load->view('admin/footer', '', true);
				$this->load->view('admin/resetform', $this->data);
			}
			else
			{
				$query=$this->db->get_where('hoosk_user', array('rs' => $rs), 1);
				if ($query->num_rows() == 0)
				{
					show_error('Sorry!!! Invalid Request!');
				}
				else
				{
					$data = array(
					'password' => md5($this->input->post('password').SALT),
					'rs' => ''
					);
					$where=$this->db->where('rs', $rs);
					$where->update('hoosk_user',$data);
					$this->data['header'] = $this->load->view('admin/headerlog', $this->data, true);
					$this->data['footer'] = $this->load->view('admin/footer', '', true);
					$this->load->view('admin/reset', $this->data);
				}
			}
		}
	}
	
public function email(){   //Email form  
	
    Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
    $userRole = $this->session->userdata('userRole');
    if($userRole == 1){
        $this->load->helper('form');
		$this->data['users_data'] = $this->common_model->select('user');
		$this->data['Count_email_message'] = $this->common_model->Count_Tottle_Rows('esic_email');
		$this->data['Count_contact_message'] = $this->common_model->Count_Tottle_Rows('esic_contact');
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/email', $this->data);
}  else{
       $this->load->view('admin/page_not_found');
}
	 }
	
public function send_email()    //compose email
{
	     if(!empty($_FILES['attachment']['name'])){
			 
                $config['upload_path'] = 'uploads/sendemail/';
                $config['file_name'] = $_FILES['attachment']['name'];
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                $this->upload->do_upload('attachment'); 
				$name = $_FILES['attachment']['name'];
                $filepath        = base_url().'uploads/sendemail/'.$name; 
		 }
		  $to          = implode(",",$this->input->post('to')); //array to string conversion
		  $subject     = $this->input->post('subject');
		
		  $attachment     = $this->input->post('attachment');
      
	      $message     = $this->input->post('message');
	      $siteEmail   = $this->data['settings'] = $this->Hoosk_model->getSettings();
	      $from_email  = $siteEmail[0]['siteEmail']; 
	      $this->load->library('email'); 
		
		 
		$config = array();
        $config['useragent']   = "CodeIgniter";
        $config['protocol']    = "smtp";
        $config['smtp_host']   = "gator3083";
        $config['smtp_port']   = "25";
        $config['mailtype']    = 'html';
        $config['charset']     = 'utf-8';
        $config['newline']     = "\r\n";
        $config['wordwrap']    = TRUE; 
		$this->email->initialize($config);
   
        $this->email->from($from_email, 'From: Esic Directory'); 
        $this->email->to($to);
        $this->email->subject($subject); 
        $this->email->message($message); 
        $this->email->attach($filepath);
          
         if($this->email->send()) {
        	 //inser data into table for record sent message
		      $insert = array(
						 'sendto'      => $to,
						 'subject'     => $subject,
						 'message'     => $message,
						 'date'        => date("F j, Y, g:i a")
		                );
						
		    $this->common_model->insert_email_data('esic_email',$insert); 
			$this->session->set_userdata('msg','Thank you. Your information has been submitted');
	        header('Location:'.base_url().'admin/users/email');
		 }
		 else {
		 	$this->session->set_userdata('errormsg','Error. Some Thing Happend Wrong Please Try Again');
	        header('Location:'.base_url().'admin/users/email');
		      }
			 
          
   }


public function sent($param = NULL){ //Mange Sent Emails
    Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
    $userRole = $this->session->userdata('userRole');
    if($userRole == 1) {
        if ($param === 'listing') {

            $selectData = array('

           id AS ID,
		   sendto AS sendto,
           subject AS Subject,
		   date AS Date,
		    ', false);


            $addColumns = array(

                'ViewEditActionButtons' => array('<a href="' . base_url() . 'admin/users/single_email/$1"><i data-toggle="tooltip" title="View Email" class=" ml-fa fa fa-eye fa-6 " text-success></i></a><a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="left"  class="fa fa-trash-o text-red ml-fa"></i></a>', 'ID')

            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData, 'esic_email', '', '', '', '', '', $addColumns);

            print_r($returnedData);

            return NULL;

        }

        if ($param === 'allvalues') {

            $returnedData = $this->Common_model->select('esic_email');

            echo json_encode($returnedData);

            return NULL;

        }

        if ($param === 'delete') {

            if (!$this->input->post()) {

                echo "FAIL::No Value Posted";

                return false;

            }


            $id = $this->input->post('id');

            $value = $this->input->post('value');


            if (empty($id) or !is_numeric($id)) {

                echo "FAIL::Posted values are not VALID";

                return NULL;

            }


            if (empty($value)) {

                echo "FAIL::Posted values are not VALID";

                return NULL;

            }

            $data = '';

            if ($value == 'delete') {


                $whereUpdate = array(

                    'id' => $id

                );
                $returnedData = $this->Common_model->delete('esic_email', $whereUpdate);

                echo "OK::Record Deleted";

            } else {

                echo "FAIL::Record Not Deleted";

            }

            return NULL;

        }
        $data['Count_contact_message'] = $this->common_model->Count_Tottle_Rows('esic_contact');
        $data['Count_email_message'] = $this->common_model->Count_Tottle_Rows('esic_email');
        $this->show_admin('admin/sent_email', $data);
        return NULL;
    }else {
        $this->load->view('admin/page_not_found');
          }
    }

public function single_email($id=NULL){   // View Sent Email 
	
	    Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$this->load->helper('form');
		$this->data['users_data'] = $this->common_model->select('user');
		$this->data['Count_email_message'] = $this->common_model->Count_Tottle_Rows('esic_email');
		$this->data['Count_contact_message'] = $this->common_model->Count_Tottle_Rows('esic_contact');
	    $this->data['sent_message'] = $this->common_model->get_sent_single_messages($id);
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/single_email', $this->data);
	 }

public function single_email_content ($id=NULL){ // sent email view update div using AJAX 
	     
		    $ajaxid = $this->input->post('ids');
			$value  = $this->input->post('value');
		    $this->data['sent_message'] = $this->common_model->get_sent_single_messages_div($ajaxid,$value);
			echo json_encode($this->data['sent_message']);
			 
	
	}
	 
	 
	 
	} 