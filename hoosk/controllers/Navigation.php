<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property common_model $common_model It resides all the methods which can be used in most of the controllers.
 */
class Navigation extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	        define("HOOSK_ADMIN",1);
			$this->load->model('Hoosk_model');
			$this->load->model('Common_model');
			$this->load->helper(array('admincontrol', 'url'));
			$this->load->library('session');
			define ('LANG', $this->Hoosk_model->getLang());
			$this->lang->load('admin', LANG);
			//Define what page we are on for nav
			$this->data['current'] = $this->uri->segment(2);
			define ('SITE_NAME', $this->Hoosk_model->getSiteName());
			define('THEME', $this->Hoosk_model->getTheme());
			define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);
		} 

	public function index()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$userRole = $this->session->userdata('userRole');
		if(isCurrentUserAdmin($this)){ 
			$this->load->library('pagination');
			$result_per_page =15;  // the number of result per page
			$config['base_url'] = BASE_URL. '/admin/navigation/';
			$config['total_rows'] = $this->Hoosk_model->countNavigation();
			$config['per_page'] = $result_per_page;
			$config['full_tag_open'] = '<div class="form-actions">';
			$config['full_tag_close'] = '</div>';
			$this->pagination->initialize($config);
	
			//Get pages from database
			$this->data['nav'] = $this->Hoosk_model->getAllNav($result_per_page, $this->uri->segment(3));
			$this->load->helper('form');
			//Load the view
			$this->data['header'] = $this->load->view('admin/header', $this->data, true);
			$this->data['footer'] = $this->load->view('admin/footer', '', true);
			$this->load->view('admin/navigation', $this->data);
		}else{
			  $this->load->view('admin/page_not_found');
			 }
	}

	public function newNav()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$userRole = $this->session->userdata('userRole');
		if(isCurrentUserAdmin($this)){ 
			$this->data['pages'] = $this->Hoosk_model->getPagesAll();
			$this->load->helper('form');
			//Load the view
			$this->data['header'] = $this->load->view('admin/header', $this->data, true);
			$this->data['footer'] = $this->load->view('admin/footer', '', true);
			$this->load->view('admin/nav_new', $this->data);
		}else{
			  $this->load->view('admin/page_not_found');
			 }
	}

	public function editNav()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$userRole = $this->session->userdata('userRole');
		if($userRole == 1){
			//Get pages from database
			$this->data['pages'] = $this->Hoosk_model->getPagesAll();
			//Get navigation from database
			$this->data['nav'] = $this->Hoosk_model->getNav($this->uri->segment(4));
			$this->load->helper('form');
			//Load the view
			$this->data['header'] = $this->load->view('admin/header', $this->data, true);
			$this->data['footer'] = $this->load->view('admin/footer', '', true);
			$this->load->view('admin/nav_edit', $this->data);
		 }else{
			  $this->load->view('admin/page_not_found');
			 }	
	}

	public function updateNavTos(){

        Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
        $userRole = $this->session->userdata('userRole');
        //if not belongs to Admin Role then just don't do any thing.
        if(intval($userRole) !== 1){
            $this->load->view('admin/page_not_found');
            return null;
        }
        //Now if Passed the Authorization, then we can have the value updated.

        //Will be used for enabled and Disabled of Tos for a Particular Menu
        $tosEnable = $this->input->post('enableTos');
        //Menu Href will be used as reference.
        $tosMenu = $this->input->post('menu');
        //This is just a title of the menu storing for later use.
        $menuTitle = $this->input->post('menuTitle');
        //This is the main text containing terms and conditions.
        $tosText = $this->input->post('tos');
        //this is just the slug, showing menus belongs to what group.
        $navSlug = $this->input->post('slug');
        if($tosEnable){
            $tosEnable = 1;
        }else{
            $tosEnable = 0;
        }

        $where = [
            'navSlug' => $navSlug
        ];
        $tosTextArray = [
            'navTos'=> $tosEnable,
            "text" => $tosText,
            "menu" => $tosMenu
        ];
        $tosTextMenusArray = [];
        array_push($tosTextMenusArray,$tosTextArray);
        $dataToUpdate = [
            'tosText'=> json_encode($tosTextMenusArray)
        ];


        $result = $this->Common_model->update('hoosk_navigation',$where, $dataToUpdate);
        if($result){
            echo "OK::Successfully Added Updated the TOS Configurations for Menu ".$menuTitle."::success";
        }else{
            echo "FAIL::Something went wrong, please contact SYSTEM ADMINISTRATOR for further assistance.::error";
        }

    }

    public function getNavTos(){
	    $slug = $this->input->post('slug');
	    $menu = $this->input->post('menu');
	    if(empty($slug)){
	        return null;
        }
        $where = [ 'navSlug' => $slug ];
        $navigation = $this->Common_model->select_fields_where('hoosk_navigation','*',$where,true);
        if(empty($navigation)){
           return null;
        }

        $tosDetails = $navigation->tosText;
        if(!empty($tosDetails)){
            $tosDetailsArray = json_decode($tosDetails);
            foreach($tosDetailsArray as $tosDetails){
                if($tosDetails->menu === $menu){
                    echo json_encode($tosDetails);
                }
            }
        }
//        return json_encode($tosDetails);
//        echo $tosDetails;
    }

	public function navAdd()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$userRole = $this->session->userdata('userRole');
		if(isCurrentUserAdmin($this)){ 
			$this->data['page'] = $this->Hoosk_model->getPageNav($this->uri->segment(3));
			$this->load->view('admin/nav_add', $this->data);
		}else{
			  $this->load->view('admin/page_not_found');
			 }	
	}

	public function insert()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form validation library
		$this->load->library('form_validation');

		$this->form_validation->set_rules('navSlug', 'nav slug', 'trim|alpha_dash|required|max_length[10]|is_unique[hoosk_navigation.navSlug]');
		$this->form_validation->set_rules('navTitle', 'navigation title', 'trim|required');

		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->newNav();
		}  else  {
			//Validation passed
			$this->Hoosk_model->insertNav();
			//Return to navigation list
			redirect('/admin/navigation', 'refresh');
	  	}

	}


	public function update()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		//Load the form validation library
		$this->load->library('form_validation');

		$this->form_validation->set_rules('navTitle', 'navigation title', 'trim|required');

		if($this->form_validation->run() == FALSE) {
			//Validation failed
			$this->editNav();
		}  else  {
			//Validation passed
			$this->Hoosk_model->updateNav($this->uri->segment(4));
			//Return to navigation list
			redirect('/admin/navigation', 'refresh');
	  	}
	}


		function deleteNav()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		if($this->input->post('deleteid')):
			$this->Hoosk_model->removeNav($this->input->post('deleteid'));
			redirect('/admin/navigation');
		else:
			$this->data['form']=$this->Hoosk_model->getNav($this->uri->segment(4));
			$this->load->view('admin/nav_delete.php', $this->data );	
		endif;
	}
}
