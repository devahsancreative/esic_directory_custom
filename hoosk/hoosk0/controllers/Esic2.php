<?php

class Esic2 extends MY_Controller{
    protected $perPage;
    public function __construct()
    {
        parent::__construct();
        
		//header("Access-Control-Allow-Origin: *");
       // header("Access-Control-Allow-Methods: PUT, GET, POST");
        //header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

       
        $this->load->model("Esic_model");
        $this->perPage = 5;

    }

    public function index($uriSegment = NULL){

        $data['sectors'] = $this->Common_model->select('esic_sectors');
		$data['company'] = $this->Common_model->select('user');
	    $data['Statuss'] = $this->Common_model->select('esic_status');
		 
	   $page = 0;
        $data['usersResult'] = $this->Esic_model->getlist($page);
	    $this->load->view('theme/header', $data);
        $this->load->view("box_listing/db_list",$data);
		$this->load->view('theme/footer');
     } 

    public function getlist(){
        $page =  $_GET['page'];
        $this->load->model('Esic_model');
        $data['list'] = $this->Esic_model->getlist($page);
        $this->load->view("box_listing/getlist",$data);
    }
    public function getfilterlist(){
        $page        =  $_GET['page'];
        $secSelect   =  $_GET['secSelect'];
        $comSelect   =  $_GET['comSelect'];
        $searchInput =  $_GET['searchInput'];
        $orderSelect =  $_GET['orderSelect'];
        $orderSelectValue = $_GET['orderSelectValue'];  
        $this->load->model('Esic_model');
        $data['list'] = $this->Esic_model->getfilterlist($page,$searchInput,$secSelect,$comSelect,$orderSelect,$orderSelectValue);
        $this->load->view("box_listing/getlist",$data);
    }
    public function updatethumbs(){
        $userID = $this->input->post('userID');
        $thumbs = $this->input->post('thumbs');
        $newThumbs = $this->input->post('newThumbs');
        $this->load->model('Esic_model');
        $data = $this->Esic_model->updatethumbs($userID,$thumbs,$newThumbs);
        echo $data;
    }

    public function info($userID){
        echo "User Profile WIll Show up Here.";
    }
}