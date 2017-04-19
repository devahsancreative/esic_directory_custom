<?php
class My_Model extends CI_Model{
	public $CurrentUserID   = 0;
    public $CurrentUserRole = 0;
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
     public function getUserWhere(){
     	$userID   = $this->CurrentUserID;
     	$userRole = $this->CurrentUserRole;
     	$where = array();
     	if($userRole == 1){
     		$where = array('1' => '1');
	     }else{
	     	$where = array('userID' => $userID);
	     }
    	return $where;
    }
}
