<?php

class Esic2 extends MY_Controller{
    protected $perPage;
    public function __construct(){
        parent::__construct();
        $this->perPage = 5;
    }

    public function index($uriSegment = NULL){
        $page = 0;
        $this->data['sectors']      = $this->Common_model->select('esic_sectors');
        $this->data['company']      = $this->Common_model->select('esic');
        $this->data['Statuss']      = $this->Common_model->select('esic_status');
        $this->data['usersResult']  = $this->Esic_model->getlist($page);
	    $this->load->view('structure/header', $this->data);
        $this->load->view("box_listing/db_list",$this->data);
		$this->load->view('structure/footer');
     }

    public function getlist(){
        $page =  $_GET['page'];
        $this->load->model('Esic_model');
        $data['list'] = $this->Esic_model->getlist($page);
        $this->load->view("box_listing/getlist",$data);
    }
    public function getfilterlist(){
         $this->load->model('Esic_model');

        if($this->input->post('keyword')){

            $this->load->view('structure/header',$this->data);
            $searchInput   = $this->input->post('keyword');
            $data['sectors'] = $this->Common_model->select('esic_sectors');
            $data['company'] = $this->Common_model->select('esic');
            $data['Statuss'] = $this->Common_model->select('esic_status');
            $page = 0;
            $data['list'] = $this->Esic_model->getfilterlist($page,$searchInput,'','','','');
            $this->load->view("box_listing/db_search_list",$data);
            $this->load->view('structure/footer');

        }else if(!empty($_GET)){


            $page        =  $_GET['page'];
            $secSelect   =  $_GET['secSelect'];
            $comSelect   =  $_GET['comSelect'];
            $searchInput =  $_GET['searchInput'];
            $orderSelect =  $_GET['orderSelect'];
            $orderSelectValue = $_GET['orderSelectValue'];
            
            $data['list'] = $this->Esic_model->getfilterlist($page,$searchInput,$secSelect,$comSelect,$orderSelect,$orderSelectValue);

            $this->load->view("box_listing/getlist",$data);

        }else{
            if($this->input->post('resultsFor')){

                $this->load->view('structure/header',$this->data);
                $this->load->view("box_listing/db_search_list",$data);
                $this->load->view('structure/footer');

            }else{
               /* //$this->load->view('structure/header',$this->data);
                $this->load->view("box_listing/db_search_list",$data);
                //$this->load->view('structure/footer');*/
            }
        }
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