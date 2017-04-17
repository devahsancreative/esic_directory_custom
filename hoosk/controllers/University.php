<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class University extends Listing{

    public $data                = array('');
    public $CurrentID           = 0;
    public $LogoDbField         = 'institutionLogo';
    public $BannerDbField       = 'banner';
    public $tableName           = 'esic_institution';
    public $tableFID            = 'institutionID';
    public $tableNameSocial     = 'institution_social';
    public $BannerNamePrefix    = 'UniversityBanner';
    public $LogoNamePrefix      = 'UniversityLogo';
    public $Name                = 'University';
    public $NameMessage         = 'University';
    public $ImagesFolderName    = 'university';
    public $ViewFolderName      = 'university';
    public $ControllerName      = 'University';
    public $ControllerRouteName = 'University';
    public $ControllerRouteManage = 'manage_university';

    function __construct(){
        parent::__construct();
        $this->load->helper('viewuni');
    }
}