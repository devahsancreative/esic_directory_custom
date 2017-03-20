<?php

class Esic2 extends MY_Controller{
    protected $perPage;
    public function __construct()
    {
        parent::__construct();



        $this->load->model("Esic_model");
        $this->perPage = 5;

        // use for Header And Footer
        $this->load->model('Hoosk_page_model');
        $this->load->model('Hoosk_model');
        $totSegments = $this->uri->total_segments();
        if(!is_numeric($this->uri->segment($totSegments))){
            $pageURL = $this->uri->segment($totSegments);
        } else if(is_numeric($this->uri->segment($totSegments))){
            $pageURL = $this->uri->segment($totSegments-1);
        }
        if ($pageURL == ""){ $pageURL = "home"; }
        $this->data['page']=$this->Hoosk_page_model->getPage($pageURL);

        $this->data['settings']=$this->Hoosk_page_model->getSettings();// use for header title
        $this->data['settings_footer'] = $this->Hoosk_model->getSettings(); //use for footer



    }

    public function index($uriSegment = NULL){

        $this->data['sectors'] = $this->Common_model->select('esic_sectors');
        $this->data['company'] = $this->Common_model->select('user');
        $this->data['Statuss'] = $this->Common_model->select('esic_status');

	    $page = 0;
        $this->data['usersResult'] = $this->Esic_model->getlist($page);
	    $this->load->view('theme/header', $this->data);
        $this->load->view("box_listing/db_list",$this->data);
		$this->load->view('theme/footer');
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

            $this->load->view('theme/header',$this->data);
            $searchInput   = $this->input->post('keyword');
            $data['sectors'] = $this->Common_model->select('esic_sectors');
            $data['company'] = $this->Common_model->select('user');
            $data['Statuss'] = $this->Common_model->select('esic_status');
            $page = 0;
            $data['list'] = $this->Esic_model->getfilterlist($page,$searchInput,'','','','');
            $this->load->view("box_listing/db_search_list",$data);
            $this->load->view('theme/footer');

        }else if($_GET['page']){

            $page        =  $_GET['page'];
            $secSelect   =  $_GET['secSelect'];
            $comSelect   =  $_GET['comSelect'];
            $searchInput =  $_GET['searchInput'];
            $orderSelect =  $_GET['orderSelect'];
            $orderSelectValue = $_GET['orderSelectValue'];
            
            $data['list'] = $this->Esic_model->getfilterlist($page,$searchInput,$secSelect,$comSelect,$orderSelect,$orderSelectValue);
            $this->load->view("box_listing/getlist",$data);
        }else{
            $this->load->view('theme/header',$this->data);
            $this->load->view("box_listing/db_search_list",$data);
            $this->load->view('theme/footer');
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