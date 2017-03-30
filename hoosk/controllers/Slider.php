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


        $this->load->library('pagination');
        $result_per_page =15;  // the number of result per page
        $config['base_url'] = BASE_URL. '/admin/slider/';
        $config['total_rows'] = $this->Hoosk_model->countSliders();
        $config['per_page'] = $result_per_page;
        $config['full_tag_open'] = '<div class="form-actions">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

        //Get pages from database
        $this->data['sliders'] = $this->Hoosk_model->getAllSliders($result_per_page, $this->uri->segment(3));

        $this->data['layouts'] = $this->Common_model->select('esic_slider_layouts');

        //Loading the View and passing data to the view.
        $this->data['header'] = $this->load->view('admin/header', $this->data, true);
        $this->data['footer'] = $this->load->view('admin/footer', '', true);
        $this->load->view('admin/sliders/list', $this->data);
    }

    public function addSlider(){

        $this->load->library('pagination');
        $result_per_page = 15;  // the number of result per page
        $config['base_url'] = BASE_URL. '/admin/slider/';
        $config['total_rows'] = $this->Hoosk_model->countSliders();
        $config['per_page'] = $result_per_page;
        $config['full_tag_open'] = '<div class="form-actions">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

        //Get pages from database
        $this->data['sliders'] = $this->Hoosk_model->getAllSliders($result_per_page, $this->uri->segment(3));

        $this->data['layouts'] = $this->Common_model->select('esic_slider_layouts');

        //Loading the View and passing data to the view.
        $this->data['header'] = $this->load->view('admin/header', $this->data, true);
        $this->data['footer'] = $this->load->view('admin/footer', '', true);
        $this->load->view('admin/sliders/new', $this->data);

    }

    public function newSlider(){
       
        $name           = $this->input->post('name');
        $table          = $this->input->post('table');
        $shortcode      = $this->input->post('shortcode');
        $renderCode     = $this->input->post('renderCode');
        $layoutID       = $this->input->post('layout');
        $desktop        = $this->input->post('desktop');
        $tablet         = $this->input->post('tablet');
        $mobile         = $this->input->post('mobile');

        if(empty($layoutID) || empty($renderCode) || empty($name) || empty($table) ){
            echo "FAIL::Incomplete Post Values::error";
            return null;
        }
        if(empty($desktop)){
            $desktop = 0;
        }
        if(empty($tablet)){
            $tablet = 0;
        }
        if(empty($mobile)){
            $mobile = 0;
        }

        $now = date("Y-m-d H:i:s");
        $insertData = [
            'name'          => $name,
            'table'         => $table,
            'shortCode'     => $shortcode,
            'renderCode'    => $renderCode,
            'layout_id'     => $layoutID,
            'desktop'       => $desktop,
            'tablet'        => $tablet,
            'mobile'        => $mobile,
            'date_created'  => $now,
            'date_updated'  => $now

        ];

        $result = $this->Common_model->insert_record('esic_slider',$insertData);
        if($result===true){
            echo 'OK::Record successfully inserted::success';
            return true;
        }else{
            
        }

       
    }

    public function updateSliderLayout(){
        $sliderID = $this->input->post('slider');
        $layoutID = $this->input->post('layout');

        if(empty($sliderID) || empty($layoutID)){
            echo "FAIL::Incomplete Post Values::error";
            return null;
        }

        if(!is_numeric($sliderID) || !is_numeric($layoutID)){
            echo "FAIL::Wrong Values Posted::error";
            return null;
        }
        $now = date("Y-m-d H:i:s");
        $updateData = [
            'layout_id' => $layoutID,
            'date_updated' => $now
        ];

        $where = ['id' => $sliderID];
        $result = $this->Common_model->update('esic_slider',$where,$updateData);
        if($result===true){
            echo 'OK::Record successfully updated::success';
            return true;
        }
        return false;
    }

    public function updateSliderType(){
        $sliderID   = $this->input->post('slider');
        $name       = $this->input->post('name');
        $itemNumber = $this->input->post('itemNumber');

        if(empty($sliderID) || empty($itemNumber)){
            echo "FAIL::Incomplete Post Values::error";
            return null;
        }

        if(!is_numeric($sliderID) || !is_numeric($itemNumber)){
            echo "FAIL::Wrong Values Posted::error";
            return null;
        }
        $now = date("Y-m-d H:i:s");
        $updateData = [
            $name => $itemNumber,
            'date_updated' => $now
        ];

        $where = ['id' => $sliderID];
        $result = $this->Common_model->update('esic_slider',$where,$updateData);
        //echo 'type_id '.$typeID;
        //echo $this->db->last_query();
        if($result===true){
            echo 'OK::Record successfully updated::success';
            return true;
        }
        return false;
    }
}
