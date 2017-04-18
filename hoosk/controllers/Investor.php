<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Investor extends Listing{

    public $data                = array('');
    public $CurrentID           = 0;
    public $LogoDbField         = 'logo';
    public $BannerDbField       = 'banner';
    public $tableName           = 'esic_investors';
    public $tableFID            = 'investorID';
    public $tableNameSocial     = 'investor_social';
    public $BannerNamePrefix    = 'InvestorBanner';
    public $LogoNamePrefix      = 'InvestorLogo';
    public $Name                = 'Investor';
    public $NameMessage         = 'Investor';
    public $ImagesFolderName    = 'investor';
    public $ViewFolderName      = 'investor';
    public $ControllerName      = 'Investor';
    public $ControllerRouteName = 'Investor';
    public $ControllerRouteManage = 'manage_investor';

    function __construct(){
        parent::__construct();
        $this->load->helper('viewinvestor');
        $this->data['industires']        = $this->Common_model->select('esic_sectors');
        $this->data['esicStatues']       = $this->Common_model->select('esic_status');
        $this->data['investorTypes']     = $this->Common_model->select('investor_types');
        $this->data['investmentAmounts'] = $this->Common_model->select('investors_preferred_investment_amounts');
        $this->load->model('Investor_model');
    }


    //Overriding this Method.
    public function View($ID){
        $this->data['id'] = $ID;
        $where = array('id' => $ID);
        $this->data['data'] = $this->Common_model->select_fields_where($this->tableName ,'*' ,$where,true);
        $this->data['PageType'] = 'View';
        $this->data['usersQuestionsAnswers'] = $this->_getUserQAnswers($ID,2);
        $this->show_admin_configuration('admin/configuration/'.$this->ViewFolderName.'/view' , $this->data);
        return Null;
    }
}
