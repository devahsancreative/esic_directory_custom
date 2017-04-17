<?php

class Update_sitemap extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Esic_model");
        $this->load->model("Common_model");
    }

    public function index()
    {


        $data['data'] = $this->Esic_model->get_site_data();
        $data['company'] = $this->Common_model->select('esic');
       // print_r($data);
        //exit;
        header("Content-Type: text/xml;charset=iso-8859-1");

        $this->load->view("sitemap/sitemap",$data);

   }


}