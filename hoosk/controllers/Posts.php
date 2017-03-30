<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Posts Management class created by CodexWorld
 */
class Posts extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('post');
        $this->load->library('Ajax_pagination');
        $this->perPage = 3;
    }
    
    public function index()
    {
        $data = array();
        
        //total rows count
        $totalRec = count($this->post->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'posts/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['posts'] = $this->post->getRows(array('limit'=>$this->perPage));
        
        //load the view
        $this->load->view('posts/index', $data);
    }
    
    function ajaxPaginationData()
    {
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = count($this->post->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'posts/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;

        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['posts'] = $this->post->getRows(array('start'=>$offset,'limit'=>$this->perPage));
        
        //load the view
        $this->load->view('posts/ajax-pagination-data', $data, false);
    }
}