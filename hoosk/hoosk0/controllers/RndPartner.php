<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RndPartner extends MY_Controller {
    
    public $data                = array('');
    public $CurrentID           = 0;
    public $tableName           = 'esic_rndpartner';
    public $BannerNamePrefix    = 'RndPartnerBanner';
    public $LogoNamePrefix      = 'RndPartnerLogo';
    public $Name                = 'RndPartner';
    public $NameMessage         = 'R&D Partner';
    public $ImagesFolderName    = 'rndpartner';
    public $ViewFolderName      = 'rndpartner';
    public $ControllerName      = 'RndPartner';
    public $ControllerRouteName = 'RndPartner';
    public $ControllerRouteManage = 'manage_rndpartner';

    function __construct()
    {
        parent::__construct();
        define("HOOSK_ADMIN",1);
        $this->load->helper(array('admincontrol', 'url', 'hoosk_admin'));
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
        $this->load->helper('viewrndpartner');
        $this->data['PageType'] = 'Listing';
        $this->data['ListingName']  = $this->Name;
        $this->data['ListingLabel'] = $this->NameMessage;
        $this->data['ControllerName']      = $this->ControllerName;
        $this->data['ControllerRouteName'] = $this->ControllerRouteName;
        $this->data['itemStatuses'] = $this->Common_model->select('esic_status_flags');

    }
    public function ManageRndPartner($param=NULL){
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
}