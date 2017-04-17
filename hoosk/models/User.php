<?php
class User extends CI_Model{
    public $UserTable = 'hoosk_user';
    function __construct(){
        parent::__construct();
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