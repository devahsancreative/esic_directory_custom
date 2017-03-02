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
        } else if(is_numeric($this->uri->segment($totSegments))){
            $pageURL = $this->uri->segment($totSegments-1);
        }
        if ($pageURL == ""){ $pageURL = "home"; }
        $data['page']=$this->Hoosk_page_model->getPage($pageURL);

        $data['settings']=$this->Hoosk_page_model->getSettings();// use for header title
        $data['settings_footer'] = $this->Hoosk_model->getSettings(); //use for footer




    }
    public function index($uriSegment = NULL){
       
    }
    public function getdetails($alias){
		
		 
      	$alias = str_replace('_',' ',$alias);
        $alias = str_replace('+','_',$alias);

		$data['social'] = $this->Esic_model->get_user_details($alias);
		 
		$data['list'] = $this->Esic_model->getdetails($alias);
        
		$this->load->view('theme/header', $data);
        $this->load->view('product_details',$data);
		$this->load->view('theme/footer');
    }
}