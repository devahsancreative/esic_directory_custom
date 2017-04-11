<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lawyer extends Listing{

    public $data                = array('');
    public $CurrentID           = 0;
    public $LogoDbField         = 'logo';
    public $BannerDbField       = 'banner';
    public $tableName           = 'esic_lawyers';
    public $tableFID            = 'lawyerID';
    public $tableNameSocial     = 'lawyer_social';
    public $BannerNamePrefix    = 'LawyerBanner';
    public $LogoNamePrefix      = 'LawyerLogo';
    public $Name                = 'Lawyer';
    public $NameMessage         = 'Lawyer';
    public $ImagesFolderName    = 'lawyers';
    public $ViewFolderName      = 'listing';
    public $ControllerName      = 'Lawyer';
    public $ControllerRouteName = 'Lawyer';
    public $ControllerRouteManage = 'manage_lawyer';

    function __construct(){
        parent::__construct();
        $this->load->helper('view');
    }
}