<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RndConsultant extends MY_Controller {
    
    public $CurrentID           = 0;
    public $tableName           = 'esic_rndconsultant';
    public $BannerNamePrefix    = 'RndConsultantBanner';
    public $LogoNamePrefix      = 'RndConsultantLogo';
    public $Name                = 'RndConsultant';
    public $NameMessage         = 'Rnd Consultant';
    public $ImagesFolderName    = 'rndconsultant';
    public $ViewFolderName      = 'listing';
    public $ControllerRouteName = 'RndConsultant';
    public $ControllerName      = 'RndConsultant';
    public $data                = array('');

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
        $this->load->helper('view');
        $this->data['ControllerRouteName'] = $this->ControllerRouteName;
        $this->data['ListingName'] = $this->Name;

    }
    public function ManageRndConsultant($param=NULL){
        viewHelperManage($param);
        return NULL;
    }
    public function Add(){
        $this->show_admin('admin/configuration/'.$this->ViewFolderName.'/add', $this->data);
        return NULL;
    }
    public function AddSave(){
        $this->data['return'] = ViewHelperNewSave();
        $this->data['ControllerName'] = $this->ControllerRouteName;
        $this->show_admin('admin/configuration/'.$this->ViewFolderName.'/listing' , $this->data);
        return Null;
    }
    public function Edit($id){
        $this->CurrentID = $id;
        $where = array('id' => $id);
        $this->data['id'] = $id;
        $this->data['data'] = $this->Common_model->select_fields_where($this->tableName ,'*' ,$where,true);
        $this->show_admin('admin/configuration/'.$this->ViewFolderName.'/edit',$this->data);
        return NULL;
    }
    public function EditSave(){
        $this->data['return'] = ViewHelperEditSave();
        $this->show_admin('admin/configuration/'.$this->ViewFolderName.'/listing' , $this->data);
        return Null;
    }
    
}