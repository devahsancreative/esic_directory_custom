<?php 
if (function_exists('wordlimit')) {
	 function wordlimit($string, $length = 40, $ellipsis = "...")
	{
		$string = strip_tags($string, '<div>');
		$string = strip_tags($string, '<p>');
		$words = explode(' ', $string);
		if (count($words) > $length)
			return implode(' ', array_slice($words, 0, $length)) . $ellipsis;
		else
			return $string.$ellipsis;
	}
	 
}
/**
 * @function getCurrentUserData 
 */
if(!function_exists('isUserLoggedIn')){
    function isUserLoggedIn($ci){
    	$Userdata = $ci->session->userdata();
    	/*echo '<pre>';
    	print_r($Userdata);
    	exit;*/
        $user_id = $ci->session->userdata('userID');
        if (strlen($user_id) <= 0) {
            // No Login Information Found in the session Object
            // So now we will check if we have in cookies
            if (get_cookie('Username')==true&& get_cookie('Password')==true) {
                $ci->authenticate("USE_COOKIES");
            }else
                // nothing found in cookies
                //Store Current Url to Session For Later Use.
                $ci->session->set_userdata('last_page', current_url());
            return false;
        }
        return true;
    }
}

/**
 * @function getCurrentUserData 
 */
if(!function_exists('getCurrentUserData')){
    function getCurrentUserData($ci){
        $Userdata = $ci->session->userdata();
        return $Userdata;
    }
}

?>