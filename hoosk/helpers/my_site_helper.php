<?php


/**
 * @function checkAdminRole 
 */
if(!function_exists('checkAdminRole')){
    function checkAdminRole($ci){
        Admincontrol_helper::is_logged_in($ci->session->userdata('userID'));
        $userRole = $ci->session->userdata('userRole');
        //We Don't want un authorized access
        if($userRole != 1){
            $ci->load->view('admin/page_not_found');
            return false;
        }
        return true;
    }
}

/**
 * @function checkRoleHasPermission 
 */
if(!function_exists('checkRoleHasPermission')){
    function checkRoleHasPermission($ci, $PermissionName){
        //We Don't want unauthorized access
        $userID   = $ci->session->userdata('userID');
        $userRole = $ci->session->userdata('userRole');
        $ci->load->model('Common_Model');
        $where = array(
            'userID'   => $userID
            //,
          //  'userRole' => $userRole
        );
        $UserRoleDB = $ci->Common_Model->select_fields_where($ci->tableNameUser,'userRole',$where,true);
        
       
        if($UserRoleDB->userRole == $userRole){
            $permissons = getCurrentUserPermissions($ci);
            foreach ($permissons as $key => $permisson) {
                if($permisson == "All Permissions"){
                    return true; // Super User Permissions
                }
                if($permisson == $PermissionName){
                    return true;
                }    
            } 
        }
        $ci->data['PermissionName'] = $PermissionName;
        $ci->load->view('admin/header' , $data);
        $ci->load->view('admin/NoPermission' , $data);
        $ci->load->view('admin/footer' , $data);
        return false;
    }
}


/**
 * @function checkUserHasRole 
 */
if(!function_exists('checkUserHasRole')){
    function checkUserHasRole($ci, $RoleName = Null){
        //We Don't want unauthorized access
        $userID   = $ci->session->userdata('userID');
        $userRole = $ci->session->userdata('userRole');
        $allUserRoles =  getAllUserRoles($ci);
        foreach ($allUserRoles as $key => $UserRole){
            if($RoleName == $UserRole || $UserRole == 'Admin'){
                return true;
            }
        }
        return false;
    }
}


/**
 * @function isCurrentUserAdmin 
 */
if(!function_exists('isCurrentUserAdmin')){
    function isCurrentUserAdmin($ci) {
        //We Don't want unauthorized access
        $userID   = $ci->session->userdata('userID');
        $userRole = $ci->session->userdata('userRole');
        $allUserRoles =  getAllUserRoles($ci);
        foreach ($allUserRoles as $key => $UserRole){
            if($UserRole == 'Admin'){
                return true;
            }
        }
        return false;
    }
}

/**
 * @function getCurrentUserID 
 */
if(!function_exists('getCurrentUserID')){
    function getCurrentUserID($ci) {
        $userID   = $ci->session->userdata('userID');
        return $userID;
    }
}

/**
 * @function checkPostExist 
 */
if(!function_exists('checkPostExist')){
    function checkPostExist($ci){
        Admincontrol_helper::is_logged_in($ci->session->userdata('userID'));
        $userRole = $ci->session->userdata('userRole');
        //We Don't want un authorized access
        if($userRole != 1){
            $ci->load->view('admin/page_not_found');
            return false;
        }
        return true;
    }
}
/**
 * @function previousURL return URL
 */
if(!function_exists('previousURL')){
    function previousURL(){
        if (isset($_SERVER['HTTP_REFERER']))
        {
            return $_SERVER['HTTP_REFERER'];
        }
        else
        {
            return base_url();
        }
    }
}
//Found This Function on
//http://php.net/manual/en/function.date-diff.php
if(!function_exists('dateDifference')){
    function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat);

    }
}

if(!function_exists('getExpiryDate')){
   function getExpiryDate($added_date){
        return date("Y-06-30", strtotime(date("Y-m-d", strtotime($added_date)) . " + 5 year"));
    }
}
//Found This Function on
//http://php.net/manual/en/function.date-diff.php
if(!function_exists('validateDate')){
    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
}

//Found This Function on
//http://stackoverflow.com/questions/1727077/generating-a-drop-down-list-of-timezones-with-php
if(!function_exists("generate_timezone_list")){
    function generate_timezone_list()
    {
        static $regions = array(
            DateTimeZone::AFRICA,
            DateTimeZone::AMERICA,
            DateTimeZone::ANTARCTICA,
            DateTimeZone::ASIA,
            DateTimeZone::ATLANTIC,
            DateTimeZone::AUSTRALIA,
            DateTimeZone::EUROPE,
            DateTimeZone::INDIAN,
            DateTimeZone::PACIFIC,
        );

        $timezones = array();
        foreach( $regions as $region )
        {
            $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
        }

        $timezone_offsets = array();
        foreach( $timezones as $timezone )
        {
            $tz = new DateTimeZone($timezone);
            $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
        }

        // sort timezone by offset
        asort($timezone_offsets);

        $timezone_list = array();
        foreach( $timezone_offsets as $timezone => $offset )
        {
            $offset_prefix = $offset < 0 ? '-' : '+';
            $offset_formatted = gmdate( 'H:i', abs($offset) );

            $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

            $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
        }

        return $timezone_list;
    }
}

//Will Return Number in Human Readable Format.
if(!function_exists("number_readable")){
    function number_readable($number,$desiNumber=FALSE){
        if(!is_numeric($number)){
            return false;
        }
        if($desiNumber === TRUE){
            $num = $number;
            $nums = explode(".",$num);
            if(count($nums)>2){
                return "0";
            }else{
                if(count($nums)==1){
                    $nums[1]="00";
                }
                $num = $nums[0];
                $explrestunits = "" ;
                if(strlen($num)>3){
                    $lastthree = substr($num, strlen($num)-3, strlen($num));
                    $restunits = substr($num, 0, strlen($num)-3);
                    $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits;
                    $expunit = str_split($restunits, 2);
                    for($i=0; $i<sizeof($expunit); $i++){

                        if($i==0)
                        {
                            $explrestunits .= (int)$expunit[$i].",";
                        }else{
                            $explrestunits .= $expunit[$i].",";
                        }
                    }
                    $thecash = $explrestunits.$lastthree;
                } else {
                    $thecash = $num;
                }
                return $thecash.".".$nums[1];
            }
        }
        return number_format($number, 2, '.', ',');
    }
}

if(!function_exists("convert_number_to_words")){
    function convert_number_to_words($inputNumber,$desiNumber = FALSE){
        if(!is_numeric($inputNumber)){
            return false;
        }
        if($desiNumber === TRUE){
            $no = round($inputNumber);
            $point = round($inputNumber - $no, 2) * 100;
            $hundred = null;
            $digits_1 = strlen($no);
            $i = 0;
            $str = array();
            $words = array(
                0 => '',
                1 => 'one',
                2 => 'two',
                3 => 'three',
                4 => 'four',
                5 => 'five',
                6 => 'six',
                7 => 'seven',
                8 => 'eight',
                9 => 'nine',
                10 => 'ten',
                11 => 'eleven',
                12 => 'twelve',
                13 => 'thirteen',
                14 => 'fourteen',
                15 => 'fifteen',
                16 => 'sixteen',
                17 => 'seventeen',
                18 => 'eighteen',
                19 =>'nineteen',
                20 => 'twenty',
                30 => 'thirty',
                40 => 'forty',
                50 => 'fifty',
                60 => 'sixty',
                70 => 'seventy',
                80 => 'eighty',
                90 => 'ninety');
            $digits = array('', 'hundred', 'thousand', 'lakh', 'crore', 'arab', 'kharab');
            $strKey = 0;
            while ($i < $digits_1) {
                $divider = ($i == 2) ? 10 : 100;
                $number = floor($no % $divider);
                $no = floor($no / $divider);
                $i += ($divider == 10) ? 1 : 2;
                if ($number) {
                    $plural = (($counter = count($str)) && $number > 9) ? 's' : null;

                    $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                    $str [$strKey] = ($number < 21) ? $words[fix_number($number)] .
                        " " . $digits[$counter] . $plural . " " . $hundred
                        :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
                    $strKey++;
                } else $str[] = null;
            }
            $str = array_reverse($str);

            $result = implode('', $str);

            $points = ($point) ?
                "." . $words[$point / 10] . " " .
                $words[$point = $point % 10] : '';
            return $result . "Rupees  " .(!empty($points)?$points. " Paise":"");
        }

        $formatNumber = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        return $formatNumber->format($inputNumber);
    }
}


//it will return a base number e-g if 56 then return 50 if 67 ten return 60
if(!function_exists("fix_number")){
    function fix_number($number){
        if($number > 20){
            $strNumber = strval($number);
            $removedLastDigit = substr($strNumber, 0, -1); // remove last character
            $newNumber = $removedLastDigit . '0';
            return intval($newNumber);
        }else{
            return intval($number);
        }
    }
}


if(!function_exists("getWidth")) {
    function getWidth($image)
    {
        $sizes = getimagesize($image);
        $width = $sizes[0];
        return $width;
    }
}
if(!function_exists("getHeight")) {
    function getHeight($image) {
        $sizes = getimagesize($image);
        $height = $sizes[1];
        return $height;
    }
}
if(!function_exists("resizeImage")) {
    function resizeImage($image,$width,$height,$scale) {
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        $source = imagecreatefromjpeg($image);
        imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
        imagejpeg($newImage,$image,90);
        chmod($image, 0777);
        return $image;
    }
}

if(!function_exists("render_slider")){
    function render_slider($pageData){

        $ci =& get_instance();
        $ci->load->model('Common_model');
        $ci->load->helper('layouts');
        $selectData = ['
                renderCode as shortCode,
                table_name as joinTable
                ',
            false
        ];
        $sliderTables = $ci->Common_model->select_fields('esic_slider_table', $selectData, false, '' ,'',true);
        //we would get array of elements in $text array representing the short codes
  
       
        $text = [];
        if(!empty($sliderTables)){
            foreach($sliderTables as $key => $layout){
                $text[$layout['shortCode']] = $layout;
            }
        }

        //replacing values and assigning to pageContent variable.

        $pageContent = preg_replace_callback('/{{([^}]+)}}/', function ($m) use ($text,$ci) {
            //Now what we need to do is get the layout first.
            $_SESSION['pageHasSlider'] = true;
            $stripped = array_map(function($v){
            
                return trim(strip_tags($v));
            }, $m);
            $stripped[1] = str_replace('&nbsp;',' ', $stripped[1]);
            $stripped = explode(' ', $stripped[1]);
            $OptionArray = array();
            foreach ($stripped as $key => $value) {
                 
                if(!empty($value)){
                    if(strpos($value, '=')){
                        $OptionSettingArray = explode('=', $value);
                        $OptionArray[$OptionSettingArray[0]] = $OptionSettingArray[1];
                    }else{
                        $OptionArray['shortCode'] = $value;
                    }
                }

            }

            if(empty($OptionArray['layout'])){
                $OptionArray['layout'] = 1;
            }

            $neededSlider = $text[$OptionArray['shortCode']];

            $ImagePath = '';

            //exit;
            //now need to get the slider join.
            switch($neededSlider['joinTable']){
                case 'esic':
                    $selectJoinData = [
                        '
                            logo as Image,
                            "" as link,
                            company as name
                        ',
                        false
                    ];
                    $action = 'results_innovators';
                    $base_link = base_url().'esic_database/company/';
                    $ImagePath = false;
                    break;
                case 'esic_investor':
                    $selectJoinData = [
                        '
                            image as Image,
                            "" as link,
                            "" as name
                        ',
                        false
                    ];
                    $action = 'results_investors';
                    $ImagePath = 'uploads/investor/';
                    $base_link = '';
                    break;
                case 'esic_accelerators':
                    $selectJoinData = [
                        '
                            logo as Image,
                            website as link,
                            name as name
                        ',
                        false
                    ];
                    $action = 'results_accelerators';
                    $ImagePath = '';
                    $base_link = '';
                    break;
                case 'esic_institution':
                    $selectJoinData = [
                        '
                            institutionLogo as Image,
                            "" as link,
                            institution as name
                        ',
                        false
                    ];
                    $action = 'results_institutions';
                    $ImagePath = '';
                    $base_link = '';
                    break;
                case 'esic_rnd':
                    $selectJoinData = [
                        '
                            rndLogo as Image,
                            "" as link,
                            rndName as name
                        ',
                        false
                    ];
                    $action = 'results_rnd';
                    $ImagePath = '';
                    $base_link = '';
                    break;
                case 'esic_lawyers':
                    $selectJoinData = [
                        '
                            logo as Image,
                            website as link,
                            name as name
                        ',
                        false
                    ];
                    $action = 'results_lawyers';
                    $ImagePath = '';
                    $base_link = '';
                    break;
                case 'esic_acceleration':
                // /ACCELERATING COMMERCIALISATION
                    $selectJoinData = [
                        '
                            accLogo as Image,
                            Web_Address as link,
                            Member as name
                        ',
                        false
                    ];
                    $action = 'results_acceleratingcommercialisation';
                    $ImagePath = '';
                    $base_link = '';
                    break;
                default:
                    // $selectJoinData = [
                    //    '
                     //       logo as Image,
                     //       website as link,
                     //       name as name
                    //    ',
                    //    false
                    //];
                    //$action    = 'results';
                    //$ImagePath = '';
                    //$base_link = '';
                    break;
            }
            if(!empty($selectJoinData) && !empty($neededSlider['joinTable'])){
                $sliderData = $ci->Common_model->select_fields($neededSlider['joinTable'],$selectJoinData,false,'','',true);
                //echo '<pre>';
                //print_r($sliderData);
                //exit;
                $items = array(
                        'desktop'   => intval($OptionArray['Desktop']),
                        'tablet'    => intval($OptionArray['Tablet']),
                        'mobile'    => intval($OptionArray['Mobile'])
                    )

                ;
                //echo $OptionArray['layout'];
                 $selectData = ['
                    name as name,
                    htmlCode as functionName
                    ',
                    false
                ];

                $where = array('id' => intval($OptionArray['layout']));
                $sliderFunction = $ci->Common_model->select_fields_where('esic_slider_layouts', $selectData, $where, true,'','','','','',true);

                if(!empty($sliderFunction['functionName'])){

                    $renderedHTML = $sliderFunction['functionName']($sliderData, $ImagePath, $items, $action, $base_link);
                }else{
                    $renderedHTML = '';
                }
            }
            return $renderedHTML;
//            return $text[$m[1]];
        }, $pageData['pageContentHTML']);
        //replacing the original content with the updated one.
        $pageData['pageContentHTML'] = $pageContent;
        //finally returning the replaced content.
        return $pageData;
    }
}


function get_user_image($userRole,$userID){
    $ci =& get_instance();
    $ci->load->model('Common_model');
    if(empty($userRole) || empty($userID)){
        echo 'Invalid Parameters';
        return false;
    }
    $defaultUserImage = base_url()."assets/img/user2-160x160.jpg";
        $selectData = [
          'p_image as avatar',
            false
        ];
        $where = array('userID' => $userID);
        $basePath = base_url(). 'uploads/users/';
    $userProfileImage = $ci->Common_model->select_fields_where($ci->tableNameUser,$selectData,$where,true);
    if(!empty($userProfileImage)){
        $path = $basePath->$userProfileImage->avatar;
        if(file_exists($path) and is_file($path)){
            return $path;
        }else{
            return $defaultUserImage;
        }
    }else{
        return $defaultUserImage;
    }
}


//Gives the complete Path for Lawyer Image if only Exists, If Not then default Image will be rendered.
function lawyerImage($dbData=false){
    $defaultUserImage = base_url()."assets/img/lawyer.jpg";
    //If No Parameter has been Passed or if is empty then just return the default.
    if(empty($dbData)){
        return $defaultUserImage;
    }

    $imagePath = base_url().$dbData;

    if(file_exists($imagePath) and is_file($imagePath)){
        return $imagePath;
    }else{
        return $dbData;
    }
}


//Validate if its a Valid JSON String.
if(!function_exists('isJson')){
    function isJson($string) {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
}

//Check if Provided Items in Arguments are actually empty or not,
//If anyone of them are empty return true. else return false if none is empty
if(!function_exists('m_empty')){
    function m_empty()
    {
        foreach(func_get_args() as $arg)
            if(empty($arg))
                continue;
            else
                return false;
        return true;
    }
}
if(!function_exists('esic_random_password_generator')) {
    function esic_random_password_generator($length = 8)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }
}

function findWhere($array, $matching) {
    foreach ($array as $item) {
        $is_match = true;
        foreach ($matching as $key => $value) {

            if (is_object($item)) {
                if (! isset($item->$key)) {
                    $is_match = false;
                    break;
                }
            } else {
                if (! isset($item[$key])) {
                    $is_match = false;
                    break;
                }
            }

            if (is_object($item)) {
                if ($item->$key != $value) {
                    $is_match = false;
                    break;
                }
            } else {
                if ($item[$key] != $value) {
                    $is_match = false;
                    break;
                }
            }
        }

        if ($is_match) {
            return $item;
        }
    }

    return false;
}
/**
 * @function in_array_r 
 */
if(!function_exists('in_array_r')){
    function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }
}

/**
 * @function trimString 
 */
 if(!function_exists('trimString')){
    function trimString($str) {
      truncateString(strip_tags($str),200, false);
       return $str;
    }
}

/**
 * @function truncateString 
 */
if(!function_exists('truncateString')){
    function truncateString($str, $chars, $to_space, $replacement="...") {
       if($chars > strlen($str)) return $str;

       $str = substr($str, 0, $chars);
       $space_pos = strrpos($str, " ");
       if($to_space && $space_pos >= 0) 
           $str = substr($str, 0, strrpos($str, " "));

       return($str . $replacement);
    }
}

/**
 * @function getAlias 
 */
if(!function_exists('getAlias')){
    function getAlias($name,$spaceReplacement = '_'){
        $alias = str_replace(' ',$spaceReplacement ,$name);
        $alias = strtolower($alias);
        $alias = preg_replace('/[^A-Za-z0-9\_]/', '', $alias); // Removes special chars.
        return $alias;
    }
}


