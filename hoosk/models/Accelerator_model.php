<?php
class Accelerator_model extends MY_Model{
    private $tableCurrent   = 'esic_accelerators';
    function __construct(){
        parent::__construct();
    }
    private function UserIDWhere(){
        $where = $this->getUserWhere();
        $this->db->where($where);
    }
    public function count(){
        $where = $this->getUserWhere();
        return $this->Common_model->count_rows($this->tableCurrent,$where);
    }
}
