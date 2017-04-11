<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AcceleratingCommercialisation extends Listing{

    public $data                = array('');
    public $CurrentID           = 0;
    public $LogoDbField         = 'accLogo';
    public $BannerDbField       = 'banner';
    public $tableName           = 'esic_acceleration';
    public $tableFID            = 'accelerationID';
    public $tableNameSocial     = 'acceleration_social';
    public $BannerNamePrefix    = 'acceleratingCommercialisationBanner';
    public $LogoNamePrefix      = 'acceleratingCommercialisationLogo';
    public $Name                = 'AcceleratingCommercialisation';
    public $NameMessage         = 'Accelerating Commercialisation';
    public $ImagesFolderName    = 'acceleratingcommercialisation';
    public $ViewFolderName      = 'acceleratingcommercialisation';
    public $ControllerName      = 'AcceleratingCommercialisation';
    public $ControllerRouteName = 'AcceleratingCommercialisation';
    public $ControllerRouteManage = 'manage_acceleratingcommercialisation';

    function __construct(){
        parent::__construct();
        $this->load->helper('viewacceleratingcommercialisation');
    }
}