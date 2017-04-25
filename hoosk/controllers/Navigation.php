<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property common_model $common_model It resides all the methods which can be used in most of the controllers.
 */
class Navigation extends MY_Controller {

	function __construct(){
	parent::__construct();
	   if(!isCurrentUserAdmin($this)){ 
 			$this->load->view('admin/NoPermission');
	    }
	}

	public function index(){
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
		
	}
	public function newNav(){
		
		$this->data['pages'] = $this->Hoosk_model->getPagesAll();
		$this->load->helper('form');
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('admin/nav_new', $this->data);
		
	}
	public function editNav(){
			//Get pages from database
			$this->data['pages'] = $this->Hoosk_model->getPagesAll();
			//Get navigation from database
			$this->data['nav'] = $this->Hoosk_model->getNav($this->uri->segment(4));
			$this->load->helper('form');
			//Load the view
			$this->data['header'] = $this->load->view('admin/header', $this->data, true);
			$this->data['footer'] = $this->load->view('admin/footer', '', true);
			$this->load->view('admin/nav_edit', $this->data);
	}
	public function updateNavTos(){
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
	public function navAdd(){
			$this->data['page'] = $this->Hoosk_model->getPageNav($this->uri->segment(3));
			$this->load->view('admin/nav_add', $this->data);
	}
	public function insert(){
		
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
	public function update(){
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
	function deleteNav(){
		if($this->input->post('deleteid')):
			$this->Hoosk_model->removeNav($this->input->post('deleteid'));
			redirect('/admin/navigation');
		else:
			$this->data['form']=$this->Hoosk_model->getNav($this->uri->segment(4));
			$this->load->view('admin/nav_delete.php', $this->data );	
		endif;
	}
}
