<?php

class Listing extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        //Loading Libraries
        $this->load->library('form_validation');
        //Loading Helpers
        $this->load->helper(array('form','url'));

        //Loading the Required Models.
        $this->load->model('Hoosk_page_model');

        //Not sure what is coming from below links. but lets keep it this way for now.
        $this->data['settings']=$this->Hoosk_page_model->getSettings();// use for header title
        $this->data['settings_footer'] = $this->Hoosk_model->getSettings(); //use for footer

        //Protected Variables that can be used in this class
    }

    public function add_lawyer(){

        //Apparently i need to set the Page Title Custom as my page is custom, unless other wise.
        $this->data['page']['pageTitle'] = 'Add Lawyer'; //Page Title

        //Just load a temporary View for Now.
        //Im using the old style pages as i am not sure if bootstrap will work here with so much css customized by Hamid.
        $this->load->view('theme/header', $this->data);
        $this->load->view('add_listing/lawyer', $this->data);
        $this->load->view('theme/footer');
    }
}
