<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RndPartner extends Listing{
    
    public $data                = array('');
    public $CurrentID           = 0;
    public $LogoDbField         = 'logo';
    public $BannerDbField       = 'banner';
    public $tableName           = 'esic_rndpartner';
    public $tableFID            = 'rndpartnerID';
    public $tableNameSocial     = 'rndpartner_social';
    public $BannerNamePrefix    = 'RndPartnerBanner';
    public $LogoNamePrefix      = 'RndPartnerLogo';
    public $Name                = 'RndPartner';
    public $NameMessage         = 'R&D Partner';
    public $ImagesFolderName    = 'rndpartner';
    public $ViewFolderName      = 'rndpartner';
    public $ControllerName      = 'RndPartner';
    public $ControllerRouteName = 'RndPartner';
    public $ControllerRouteManage = 'manage_rndpartner';

    function __construct(){
        parent::__construct();
        $this->load->helper('viewrndpartner');
    }
}