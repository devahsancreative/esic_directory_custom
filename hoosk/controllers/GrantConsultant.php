<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GrantConsultant extends Listing{
    
    public $data                = array('');
    public $CurrentID           = 0;
    public $LogoDbField         = 'logo';
    public $BannerDbField       = 'banner';
    public $tableName           = 'esic_grantconsultant';
    public $tableFID            = 'grantconsultantID';
    public $tableNameSocial     = 'grantconsultant_social';
    public $BannerNamePrefix    = 'grantConsultantBanner';
    public $LogoNamePrefix      = 'grantConsultantLogo';
    public $Name                = 'GrantConsultant';
    public $NameMessage         = 'Grant Consultant';
    public $ImagesFolderName    = 'grantconsultant';
    public $ViewFolderName      = 'listing';
    public $ControllerName      = 'GrantConsultant';
    public $ControllerRouteName = 'GrantConsultant';
    public $ControllerRouteManage = 'manage_grantconsultant';

    function __construct(){
        parent::__construct();
        $this->load->helper('view');
    }
}