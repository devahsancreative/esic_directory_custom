<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accelerator extends Listing{

    public $data                = array('');
    public $CurrentID           = 0;
    public $LogoDbField         = 'logo';
    public $BannerDbField       = 'banner';
    public $tableName           = 'esic_accelerators';
    public $tableFID            = 'acceleratorID';
    public $tableNameSocial     = 'accelerator_social';
    public $BannerNamePrefix    = 'AcceleratorBanner';
    public $LogoNamePrefix      = 'AcceleratorLogo';
    public $Name                = 'Accelerator';
    public $NameMessage         = 'Accelerator';
    public $ImagesFolderName    = 'accelerator';
    public $ViewFolderName      = 'accelerator';
    public $ListFileName        = 'accelerator';
    public $ControllerName      = 'Accelerator';
    public $ControllerRouteName = 'Accelerator';
    public $ControllerRouteManage = 'manage_accelerator';

    function __construct(){
        parent::__construct();
        $this->load->helper('viewaccelerator'); 
    }
}