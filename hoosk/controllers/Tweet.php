<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* A collection of functions to be run through command line only.
*/
class Tweet extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // set maximum execution time to infinity
        set_time_limit(0);
        $this->load->library('twitterlib');
    }
    public function getTweetByID($ID){
        print_r(json_encode($this->twitterlib->TweetByID($ID)));
    }
}
?>