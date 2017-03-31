<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Community Auth - MY Controller
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2016, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

/**
 * @property common_model $common_model It resides all the methods which can be used in most of the controllers.
 */

class MY_Controller extends CI_Controller
{
	public $base_url;
	/**
	 * Class constructor
	 */
	public function __construct(){
	parent::__construct();
	$this->base_url = BASE_URL;
		define("HOOSK_ADMIN",1);
		$this->load->helper(array('admincontrol', 'url', 'hoosk_admin','my_site_helper','hoosk_page','viewdefault'));
		$this->load->library('session');
        $this->load->model('Hoosk_model');
		define ('LANG', $this->Hoosk_model->getLang());
		$this->lang->load('admin', LANG);
		define ('SITE_NAME', $this->Hoosk_model->getSiteName());
		define('THEME', $this->Hoosk_model->getTheme());
		define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);
        $this->load->model('Common_model');
		$this->load->model('Esic_model');
		$this->load->model("Imagecreate_model");

        //We Need Some Settings from Database.
        //Load Values from DB
        $config = $this->db->get('hoosk_social_setting')->result();
        //Assign Values to Config File.
        $this->config->set_item('facebook_app_id', $config[0]->api_id);
        $this->config->set_item('facebook_app_secret', $config[0]->api_key);
	}
	public function show_admin($viewPath, $data = NULL, $bool = false){
	    $this->load->view('admin/header',$data, $bool);
	    $this->load->view($viewPath, $data, $bool);
	    $this->load->view('admin/footer',$data, $bool);
	}
	public function show_admin_configuration($viewPath, $data = NULL, $bool = false){
	    $this->load->view('admin/header',$data, $bool);
	    $this->load->view('admin/configuration/structure/head',$data, $bool);
	    $this->load->view($viewPath, $data, $bool);
	    $this->load->view('admin/configuration/structure/foot',$data, $bool);
	    $this->load->view('admin/footer',$data, $bool);
	}
	public function show_admin_listing($viewPath, $data = NULL, $bool = false){
	    $this->load->view('admin/header',$data, $bool);
	    $this->load->view('admin/configuration/structure/head',$data, $bool);
	    $this->load->view('admin/configuration/structure/listing-top',$data, $bool);
	    $this->load->view($viewPath, $data, $bool);
	   	$this->load->view('admin/configuration/structure/foot',$data, $bool);
	    $this->load->view('admin/configuration/structure/listing-bottom',$data, $bool);
	    $this->load->view('admin/footer',$data, $bool);
	}
}
