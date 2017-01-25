<?php
class Esicdetails extends MY_Controller{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('Esic_model');
        


    }
    public function index($uriSegment = NULL){
       
    }
    public function getdetails($alias){
		
		 
      	$alias = str_replace('_',' ',$alias);

		$data['social'] = $this->Esic_model->get_user_details($alias);
		 
		$data['list'] = $this->Esic_model->getdetails($alias);
        
		$this->load->view('theme/header', $data);
        $this->load->view('product_details',$data);
		$this->load->view('theme/footer');
    }
}