<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RndConsultant extends Listing {
    
    public $data                = array('');
    public $CurrentID           = 0;
    public $LogoDbField         = 'logo';
    public $BannerDbField       = 'banner';
    public $tableName           = 'esic_rndconsultant';
    public $tableFID            = 'rndconsultantID';
    public $tableNameSocial     = 'rndconsultant_social';
    public $BannerNamePrefix    = 'RndConsultantBanner';
    public $LogoNamePrefix      = 'RndConsultantLogo';
    public $Name                = 'RndConsultant';
    public $NameMessage         = 'R&D Tax Consultant';
    public $ImagesFolderName    = 'rndconsultant';
    public $ViewFolderName      = 'listing';
    public $ControllerName      = 'RndConsultant';
    public $ControllerRouteName = 'RndConsultant';
    public $ControllerRouteManage = 'manage_rndconsultant';

    function __construct(){
        parent::__construct();
        $this->load->helper('view');
    }
}