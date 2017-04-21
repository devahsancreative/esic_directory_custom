<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Twitterlib {
	public function __construct(){
		ini_set('precision', 20); // http://stackoverflow.com/a/8106127/908257
		$this->CI = & get_instance();
	}
	public function TweetByID($id){
		// do oauth
		$this->CI->load->library('twitteroauth');
		$this->CI->config->load('twitter');
		$consumer_token  = $this->CI->config->item('consumer_token');
		$consumer_secret = $this->CI->config->item('consumer_secret');
		$access_token    = $this->CI->config->item('access_token');
		$access_secret   = $this->CI->config->item('access_secret');
		/*echo '<pre>';
		echo $consumer_token;
		echo '<br>';
		echo $consumer_secret;
		echo '<br>';
		echo $access_token;
		echo '<br>';
		echo $access_secret;
		echo '</pre>';*/

		$connection      = $this->CI->twitteroauth->create($consumer_token, $consumer_secret, $access_token, $access_secret);
		$content         = $connection->get('account/verify_credentials');
		if(isset($content->errors)){
			foreach ($content->errors as $error){
				echo 'Show a Error Main!'.PHP_EOL;
				echo $error->code.' '.$error->message.PHP_EOL;
			}
			die;
		}else{

			$query_data = array(
				'id' 		=> $id,
				'trim_user' => true,
				'include_entities' => false,
			);
			//$query_data = array('screen_name' => $id);
			$url 	 = 'https://api.twitter.com/1.1/statuses/show.json';
			//$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
			$content = $connection->get($url,$query_data);
			// if we have new results

			if(isset($content)){
				return $content;
			}
		}
		return null;
	}
}

/* End of file twitterlib.php */