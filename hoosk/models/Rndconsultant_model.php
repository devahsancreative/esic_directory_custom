<?php
class Rndconsultant_model extends MY_Model{
    private $tableCurrent   = 'esic_rndconsultant';
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
}
