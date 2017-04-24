<?php
class My_Model extends CI_Model{
	public $CurrentUserID   = 0;
    public $CurrentUserRole = 0;
    public $UserWhere = 0;
    function __construct(){
        parent::__construct();
        $this->load->model('Common_model');
        $userRole = $this->session->userdata('userRole');
        $userID   = $this->session->userdata('userID');
        $this->setUser($userID,$userRole);
    }
    public function setUser($userID,$userRole){
    	$this->CurrentUserID 	= $userID;
    	$this->CurrentUserRole 	= $userRole;
    }
    public function getUserWhere($LinkTable = ''){
     	$userID    = $this->CurrentUserID;
     	$userRoles = $this->CurrentUserRole;
        $userRoles = json_decode($userRoles);
     	$where = array();
     	if(in_array(1,$userRoles)){
     		$where = array('1' => '1');
	    }else{
            if(!empty($LinkTable)){
                $where = array($LinkTable.'.userID' => $userID);
            }else{
    	     	$where = array('userID' => $userID);
            }
	    }
        $this->UserWhere = $where;
    	return $where;
    }
    private function getUserRoles(){

    }
}
