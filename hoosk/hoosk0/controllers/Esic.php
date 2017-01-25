<?php
/**
 * Created by PhpStorm.
 * User: HI
 * Date: 8/23/2016
 * Time: 11:57 AM
 */
/**
 * @property Common_model $Common_model It resides all the methods which can be used in most of the controllers.
 * @property CI_Pagination $pagination It resides all the methods which can be used in most of the controllers.
 * @property Esic_model $Esic_model It resides all the methods which can be used in most of the controllers.
 * @property CI_URI $uri It resides all the methods which can be used in most of the controllers.
 * @property Ajax_pagination $ajax_pagination It resides all the methods which can be used in most of the controllers.
 */
class Esic extends CI_Controller{
    protected $perPage;
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Common_model");
        $this->load->model("Esic_model");

        ///Loading Pagination
//        $this->load->library("pagination");
        $this->load->library('Ajax_pagination');

        //Pagination Config
        $this->perPage = 5;
    }

    public function index($uriSegment = NULL){

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $config = array();
        $config['target']      = '#regList';
        $config["base_url"] = base_url() . "Esic/ajaxPaginationData";
        $config["total_rows"] = $this->Esic_model->record_count();
        $config["per_page"] = $this->perPage;
        $config['cur_tag_open'] = '<b>';
        $config['cur_tag_close'] = '</b>';
        $config['next_link'] = 'Next &rarr;';
        $config['prev_link'] = '&larr; Previous';
        $config['show_count']    = false;
//        $config["uri_segment"] = 3;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;


        //Lets make a simple query for Listing.
        $selectData = array(
            '
                user.id as userID,
                concat(firstName, " ", lastName) as FullName,
                email as Email,
                company as Company,
                business as Business,
                businessShortDescription as BusinessShortDesc,
                score as Score,
                logo as Logo,
                website as Web,
                CASE WHEN user.status = 1 THEN CONCAT("<span class=\"featured-red\">",ES.status,"</span>") WHEN user.status = 2 THEN CONCAT("<span class=\"featured-yellow\">",ES.status,"</span>") WHEN user.status = 3 THEN CONCAT("<span class=\"featured-green\">",ES.status,"</span>") ELSE "" END as Status
            ',
            false
        );
        $joins = array(
            array(
                'table' => 'esic_status ES',
                'condition' => 'ES.id = user.status',
                'type' => 'LEFT'
            )
        );
        $limit = array($config["per_page"],$page);
        $data['usersResult'] = $this->Common_model->select_fields_where_like_join('user',$selectData,$joins,'',FALSE,'','','','',$limit,true);
        $this->load->vars($data);
        $this->ajax_pagination->initialize($config);
        $data["links"] = $this->ajax_pagination->create_links();
        $data["pageInfo"] = "Showing ".( $this->ajax_pagination->cur_page * $this->ajax_pagination->per_page)." of ". $config["total_rows"]." total results";
        $this->load->view("front_list",$data);
    }

    public function ajaxPaginationData(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $config = array();
        $config['target']      = '#regList';
        $config["base_url"] = base_url() . "Esic/ajaxPaginationData";
        $config["total_rows"] = $this->Esic_model->record_count();
        $config['per_page']    = $this->perPage;

        $config['cur_tag_open'] = '<b>';
        $config['cur_tag_close'] = '</b>';
        $config['next_link'] = 'Next &rarr;';
        $config['prev_link'] = '&larr; Previous';
        $config['show_count']    = false;

        $this->ajax_pagination->initialize($config);
        $limit = array($config["per_page"],$offset);
        //Lets make a simple query for Listing.
        $selectData = array(
            '
                user.id as userID,
                concat(firstName, " ", lastName) as FullName,
                email as Email,
                company as Company,
                business as Business,
                businessShortDescription as BusinessShortDesc,
                score as Score,
                logo as Logo,
                website as Web,
                CASE WHEN user.status = 1 THEN CONCAT("<span class=\"featured-red\">",ES.status,"</span>") WHEN user.status = 2 THEN CONCAT("<span class=\"featured-yellow\">",ES.status,"</span>") WHEN user.status = 3 THEN CONCAT("<span class=\"featured-green\">",ES.status,"</span>") ELSE "" END as Status
            ',
            false
        );
        $joins = array(
            array(
                'table' => 'esic_status ES',
                'condition' => 'ES.id = user.status',
                'type' => 'LEFT'
            )
        );
        $data['usersResult'] = $this->Common_model->select_fields_where_like_join('user',$selectData,$joins,'',FALSE,'','','','',$limit,true);
        $data["links"] = $this->ajax_pagination->create_links();
        //load the view
//        print_r($this->ajax_pagination);
        $data["pageInfo"] = "Showing ".( $this->ajax_pagination->cur_page * $this->ajax_pagination->per_page)." of ". $config["total_rows"]." total results";
        $this->load->view('front_list_ajax', $data, false);
    }

    public function info($userID){
        echo "User Profile WIll Show up Here.";
    }
}