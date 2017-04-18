<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property Common_model $Common_model It resides all the methods which can be used in most of the controllers.
 * @property Hoosk_model $Hoosk_model It resides all the methods which can be used in most of the controllers.
 */
class MY_Controller extends CI_Controller{
	public $base_url;
    public $tableNameUser   = 'hoosk_user';
	/**
	 * Class constructor
	 */
	public function __construct(){
	parent::__construct();
		$this->base_url = BASE_URL;
		define("HOOSK_ADMIN",1);
		$this->load->helper(array('admincontrol','hoosk_admin','hoosk_page','email_helper'));
        $this->load->library('facebook');
        $this->load->model('Hoosk_model');
        
		define ('LANG', $this->Hoosk_model->getLang());
		$this->lang->load('admin', LANG);
		define ('SITE_NAME', $this->Hoosk_model->getSiteName());
		define('THEME', $this->Hoosk_model->getTheme());
		define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);
        $this->load->model('Common_model');
		$this->load->model('Esic_model');
		$this->load->model("Imagecreate_model");

        //We Need Some Settings from Database.
        //Load Values from DB
        $config = $this->db->get('hoosk_social_setting')->result();
        //Assign Values to Config File.
        $this->config->set_item('facebook_app_id', $config[0]->api_id);
        $this->config->set_item('facebook_app_secret', $config[0]->api_key);
        if(isUserLoggedIn($this)){
            $this->data['CurrentUserData'] =  getCurrentUserData($this);
            $this->data['UserLoggedIn']    = true;
        }else{
            $this->data['UserLoggedIn']    = false;
        }

        $url = str_replace($_SERVER["HTTP_HOST"], '', BASE_URL);
        $url = $_SERVER["DOCUMENT_ROOT"].''.$url;
        $url = str_replace('http://', '', $url);
        $url = str_replace('https://', '', $url);
        define ('DoucmentUrl', $url);

        $totSegments = $this->uri->total_segments();
        if(!is_numeric($this->uri->segment($totSegments))){
            $pageURL = $this->uri->segment($totSegments);
        }else if(is_numeric($this->uri->segment($totSegments))){
            $pageURL = $this->uri->segment($totSegments-1);
        }
        if ($pageURL == ""){ $pageURL = "home"; }
        $this->load->model('Hoosk_page_model');
        $this->data['page']             = $this->Hoosk_page_model->getPage($pageURL);
        $this->data['settings']         = $this->Hoosk_page_model->getSettings();
        $this->data['settings_footer']  = $this->Hoosk_model->getSettings();
	}
	public function show_admin($viewPath, $data = NULL, $bool = false){
	    $this->load->view('admin/header',$data, $bool);
	    $this->load->view($viewPath, $data, $bool);
	    $this->load->view('admin/footer',$data, $bool);
	}
	public function show_admin_configuration($viewPath, $data = NULL, $bool = false){
	    $this->load->view('admin/header',$data, $bool);
	    $this->load->view('admin/configuration/structure/head',$data, $bool);
	    $this->load->view($viewPath, $data, $bool);
	    $this->load->view('admin/configuration/structure/foot',$data, $bool);
	    $this->load->view('admin/footer',$data, $bool);
	}
	public function show_admin_listing($viewPath, $data = NULL, $bool = false){
	    $this->load->view('admin/header',$data, $bool);
	    $this->load->view('admin/configuration/structure/head',$data, $bool);
	    $this->load->view('admin/configuration/structure/listing-top',$data, $bool);
	    $this->load->view($viewPath, $data, $bool);
	   	$this->load->view('admin/configuration/structure/foot',$data, $bool);
	    $this->load->view('admin/configuration/structure/listing-bottom',$data, $bool);
	    $this->load->view('admin/footer',$data, $bool);
	}
	public function show_configuration($viewPath, $data = NULL, $bool = false){
	    $this->load->view('admin/configuration/structure/head_front',$data, $bool);
	    $this->load->view($viewPath, $data, $bool);
	    $this->load->view('admin/configuration/structure/foot_front',$data, $bool);
	}
}

class Listing extends MY_Controller{
    protected $CurrentID;
    public function __construct(){
    parent::__construct();

        $this->load->helper(array('form','viewdefault'));
        $this->load->library('form_validation');

        $this->data['PageType']               = 'Listing';
        $this->data['LogoDbField']            = $this->LogoDbField;
        $this->data['BannerDbField']          = $this->BannerDbField;
        $this->data['ListingName']            = $this->Name;
        $this->data['ListingLabel']           = $this->NameMessage;
        $this->data['ControllerName']         = $this->ControllerName;
        $this->data['ControllerRouteName']    = $this->ControllerRouteName;
        $this->data['ControllerRouteManage']  = $this->ControllerRouteManage;
        $this->data['itemStatuses']           = $this->Common_model->select('esic_status_flags');

        $this->data['userFieldsView'] =  $this->load->view('admin/configuration/structure/user_fields_front', $this->data , true);

    }
    public function Manage($param=NULL){
        viewHelperManage($param);
        return NULL;
    }
	public function Add(){
        $this->data['PageType'] = 'Add';
        $this->show_admin_configuration('admin/configuration/'.$this->ViewFolderName.'/add', $this->data);
        return NULL;
    }
    public function AddSave(){
        $this->data['PageType'] = 'Listing';
        $this->data['return'] = ViewHelperNewSave();
        $this->show_admin_listing('admin/configuration/'.$this->ViewFolderName.'/listing' , $this->data);
        return Null;
    }
    public function Edit($id){
        $this->CurrentID = $id;
        $where = array('id' => $id);
        $this->data['id'] = $id;
        $this->data['data'] = $this->Common_model->select_fields_where($this->tableName ,'*' ,$where,true);
        $userID = $this->data['data']->userID;
        $whereUser = array('userID' => $userID);
        $this->data['UserData'] = $this->Common_model->select_fields_where($this->tableNameUser ,'*' ,$whereUser,true);
        $whereSocial = array('listingID'=> $id);
        $this->data['SocialLinks'] = $this->Common_model->select_fields_where($this->tableNameSocial ,'*' ,$whereSocial,true);
        $this->data['PageType'] = 'Edit';
        $this->show_admin_configuration('admin/configuration/'.$this->ViewFolderName.'/edit',$this->data);
        return NULL;
    }
    public function EditSave(){
        $this->data['return'] = ViewHelperEditSave();
        $this->data['PageType'] = 'Listing';
        $this->show_admin_listing('admin/configuration/'.$this->ViewFolderName.'/listing' , $this->data);
        return Null;
    }
    public function View($ID){
        $this->data['id'] = $ID;
        $where = array('id' => $ID);
        $this->data['data'] = $this->Common_model->select_fields_where($this->tableName ,'*' ,$where,true);
        $this->data['PageType'] = 'View';
        $this->show_admin_configuration('admin/configuration/'.$this->ViewFolderName.'/view' , $this->data);
        return Null;
    }
    public function FrontForm(){
        $this->load->view('structure/header',$this->data);
        if(!empty($this->data['page']['pageTemplate'])){
            $this->load->view('templates/'.$this->data['page']['pageTemplate'], $this->data);
        }
        $this->show_configuration('admin/configuration/'.$this->ViewFolderName.'/front' ,$this->data);
        $this->load->view('structure/footer');
    }
    public function Create(){
        $this->data['PageType'] = 'Message';
        $this->data['return'] = ViewHelperNewSave();
        $this->load->view('structure/header',$this->data);
        $this->show_configuration('admin/configuration/structure/message' , $this->data);
        $this->load->view('structure/footer');
        return Null;
    }
}
