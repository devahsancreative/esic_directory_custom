<?php
class User_model extends MY_Model{
    private $UserTable    = 'hoosk_user';
    private $tableCurrent = 'hoosk_user';
    function __construct(){
        parent::__construct();
    }
    private function UserIDWhere(){
        $where = $this->getUserWhere();
        $this->db->where($where);
    }
    public function count(){
        $this->UserIDWhere();
        return $this->db->count_all($this->tableCurrent);
    }
    public function CreateNewUser($data){
        if($this->FieldAlreadyExist('UserName',$data['username']) == true){
            return 'FAIL::That Username Already Exist::Error';
        }
        if($this->FieldAlreadyExist('email',$data['Email']) == true){
            return 'FAIL::That Email Already Exist::Error';
        }
        if($this->Common_model->insert_record($this->UserTable, $data)){
            return  'Success::Your Account is created. Please Check Your Email.::Success';
        }else{
            return 'FAIL::Sorry There is an Error Please Contact Admin::Error';
        }
    }
    Private function FieldAlreadyExist($DB_Field, $User_Data)
    {
        $Where[$DB_Field] = $User_Data;
        if (!empty($this->db->get_where($this->UserTable, $Where)->result_array())){
            return true;
        }
        return false;
    }
}