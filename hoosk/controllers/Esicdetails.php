<?php
class Esicdetails extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('Esic_model');
        $this->load->model('Hoosk_page_model');
        $this->load->model('Hoosk_model');
        // use for Header And Footer
        $totSegments = $this->uri->total_segments();
        if(!is_numeric($this->uri->segment($totSegments))){
            $pageURL = $this->uri->segment($totSegments);
        }else if(is_numeric($this->uri->segment($totSegments))){
            $pageURL = $this->uri->segment($totSegments-1);
        }
        if ($pageURL == ""){ $pageURL = "home"; }
        $this->data['page']=$this->Hoosk_page_model->getPage($pageURL);

        $this->data['settings']=$this->Hoosk_page_model->getSettings();// use for header title
        $this->data['settings_footer'] = $this->Hoosk_model->getSettings(); //use for footer

    }
    public function index($uriSegment = NULL){
       
    }
    public function getdetails($alias){
		
      	$alias = str_replace('_',' ',$alias);
        $alias = str_replace('+','_',$alias);

        $esicData = $this->Esic_model->getDetails($alias);
       // $userID = $esicData['userID'];
        $listingID = $esicData['listingID'];
        $this->data['esic'] = $this->Esic_model->getDetails($alias);
        //echo '<pre>';
        //print_r($this->data['list']);
       // exit;
		$this->data['social'] = $this->Esic_model->getSocialDetail($listingID);
		$this->load->view('structure/header', $this->data);
        $this->load->view('product_details',$this->data);
		$this->load->view('structure/footer');
    }
}