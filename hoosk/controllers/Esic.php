<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Esic extends Listing{

    public $data                = array('');
    public $CurrentID           = 0;
    public $LogoDbField         = 'logo';
    public $BannerDbField       = 'banner';
    public $tableName           = 'esic';
    public $tableFID            = 'esicID';
    public $tableNameSocial     = 'esic_social';
    public $BannerNamePrefix    = 'EsicBanner';
    public $LogoNamePrefix      = 'EsicLogo';
    public $Name                = 'Esic';
    public $NameMessage         = 'Esic';
    public $ImagesFolderName    = 'esic';
    public $ViewFolderName      = 'esic';
    public $ControllerName      = 'Esic';
    public $ControllerRouteName = 'Esic';
    public $ControllerRouteManage = 'manage_esic';

    function __construct(){
        parent::__construct();
        $this->load->helper('viewesic');
    }
}