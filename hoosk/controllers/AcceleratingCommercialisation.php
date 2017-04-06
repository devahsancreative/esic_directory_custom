<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AcceleratingCommercialisation extends MY_Controller {

    public $data                = array('');
    public $CurrentID           = 0;
    public $LogoDbField         = 'accLogo';
    public $BannerDbField       = 'banner';
    public $tableName           = 'esic_acceleration';
    public $BannerNamePrefix    = 'acceleratingCommercialisationBanner';
    public $LogoNamePrefix      = 'acceleratingCommercialisationLogo';
    public $Name                = 'AcceleratingCommercialisation';
    public $NameMessage         = 'Accelerating Commercialisation';
    public $ImagesFolderName    = 'acceleratingcommercialisation';
    public $ViewFolderName      = 'acceleratingcommercialisation';
    public $ControllerName      = 'AcceleratingCommercialisation';
    public $ControllerRouteName = 'AcceleratingCommercialisation';
    public $ControllerRouteManage = 'manage_acceleratingcommercialisation';

    function __construct()
    {
        parent::__construct();
        define("HOOSK_ADMIN",1);
        $this->load->helper(array('admincontrol', 'form', 'url', 'hoosk_admin'));
        $this->load->library('session');
        $this->load->model('Hoosk_model');
        define ('LANG', $this->Hoosk_model->getLang());
        $this->lang->load('admin', LANG);
        define ('SITE_NAME', $this->Hoosk_model->getSiteName());
        define ('THEME', $this->Hoosk_model->getTheme());
        define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);
        $this->load->model("Common_model");
        $this->load->model("Imagecreate_model");
        $this->load->helper('cookie');
        $this->load->library('resize');
        $url = str_replace($_SERVER["HTTP_HOST"], '', BASE_URL);
        $url = $_SERVER["DOCUMENT_ROOT"].''.$url;
        $url = str_replace('http://', '', $url);
        $url = str_replace('https://', '', $url);
        define ('DoucmentUrl', $url);
        $this->load->helper('viewacceleratingcommercialisation');
        $this->data['PageType'] = 'Listing';
        $this->data['LogoDbField']  = $this->LogoDbField;
        $this->data['ListingName']  = $this->Name;
        $this->data['ListingLabel'] = $this->NameMessage;
        $this->data['ControllerName']      = $this->ControllerName;
        $this->data['ControllerRouteName'] = $this->ControllerRouteName;
        $this->data['ControllerRouteManage'] = $this->ControllerRouteManage;
        $this->data['itemStatuses'] = $this->Common_model->select('esic_status_flags');
        $this->load->library('form_validation');
        $this->load->model('Hoosk_page_model');
        $totSegments = $this->uri->total_segments();
        if(!is_numeric($this->uri->segment($totSegments))){
            $pageURL = $this->uri->segment($totSegments);
        } else if(is_numeric($this->uri->segment($totSegments))){
            $pageURL = $this->uri->segment($totSegments-1);
        }
        if ($pageURL == ""){ $pageURL = "home"; }
        $this->data['page']=$this->Hoosk_page_model->getPage($pageURL);
        $this->data['settings']=$this->Hoosk_page_model->getSettings();
        $this->data['settings_footer'] = $this->Hoosk_model->getSettings();
    }
    public function ManageAcceleratingCommercialisation($param=NULL){
        viewHelperManage($param);
        return NULL;
    }
    public function Add(){
        $this->data['PageType'] = 'Add';
        $this->show_admin_configuration('admin/configuration/'.$this->ViewFolderName.'/add', $this->data);
        return NULL;
    }
    public function AddSave(){
        $this->data['return'] = ViewHelperNewSave();
        $this->data['PageType'] = 'Listing'; 
        $this->show_admin_listing('admin/configuration/'.$this->ViewFolderName.'/listing' , $this->data);
        return Null;
    }
    public function Edit($id){
        $this->CurrentID = $id;
        $where = array('id' => $id);
        $this->data['id'] = $id;
        $this->data['data'] = $this->Common_model->select_fields_where($this->tableName ,'*' ,$where,true);
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
        $this->load->view('theme/header',$this->data);
        if(!empty($this->data['page']['pageTemplate'])){
            $this->load->view('theme/'.$this->data['page']['pageTemplate'], $this->data);
        }
        $this->show_configuration('admin/configuration/'.$this->ViewFolderName.'/front' ,$this->data);
        $this->load->view('theme/footer');
    }
    public function Create(){
        $this->data['PageType'] = 'Message';
        $this->data['return'] = ViewHelperNewSave();
        $this->load->view('theme/header',$this->data);
        $this->show_configuration('admin/configuration/structure/message' , $this->data);
        $this->load->view('theme/footer');
        return Null;
    }
}