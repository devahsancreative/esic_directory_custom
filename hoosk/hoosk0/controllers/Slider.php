<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @property Common_model $Common_model It resides all the methods which can be used in most of the controllers.
 */
class Slider extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        define("HOOSK_ADMIN",1);
        $this->load->model('Hoosk_model');
        $this->load->model('Common_model');
        $this->load->helper(array('admincontrol', 'url'));
        $this->load->library('session');
        define ('LANG', $this->Hoosk_model->getLang());
        $this->lang->load('admin', LANG);

        define ('SITE_NAME', $this->Hoosk_model->getSiteName());
        define('THEME', $this->Hoosk_model->getTheme());
        define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);
    }

    public function index(){

        //Lets Fetch all the records from the database.
        $this->data['sliders'] = $this->Common_model->select_fields('esic_slider','*');


        //Loading the View and passing data to the view.
        $this->data['header'] = $this->load->view('admin/header', $this->data, true);
        $this->data['footer'] = $this->load->view('admin/footer', '', true);
        $this->load->view('admin/sliders/list', $this->data);
    }

    public function newSlider(){
        //This view will be responsible for creating new sliders.
    }
}
