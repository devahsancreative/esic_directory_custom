<?php

class Update_sitemap extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Esic_model");
    }

    public function index()
    {


        $data['data'] = $this->Esic_model->get_site_data();

        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemap/sitemap",$data);

   }
public function fuck(){

    echo  "fu";

}

}