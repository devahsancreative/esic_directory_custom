<?php
class Esicfilter extends CI_Controller{
    public function __construct(){
        parent::__construct();
		header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->load->model("Common_model");
    }
    public function index($uriSegment = NULL){
        $selectData = array('id,logo',false);
        $where = array('Publish != 0');
        $data['company'] = $this->Common_model->select_fields_where('esic',$selectData, $where, false, '', '', '','','',false);
        $this->load->view("box_listing/filter_list",$data);
    }
}