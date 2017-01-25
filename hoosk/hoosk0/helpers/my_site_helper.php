<?php
/**
 * Created by PhpStorm.
 * User: COD3R
 * Date: 9/18/2015
 * Time: 1:55 PM
 */


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

if(!function_exists("master_menuRecordCounter")){
    function master_menuRecordCounter(){
        $ci =& get_instance();
        $ci->load->model('Common_Model');

        $counter = array(
            'wards' => 0,
            'beds' => 0
        );

        //1. Wards Count
        $table = "ml_ward";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $wardsRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['wards'] = $wardsRecord->TotalFound;

        //2. Beds Count
        $table = "ml_beds";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $bedsRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['beds'] = $bedsRecord->TotalFound;

        //3. Room Classes Count
        $table = "ml_room_class";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $roomClassesRecords = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['roomClass'] = $roomClassesRecords->TotalFound;

        //4. Rooms Count
        $table = "ml_rooms";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $roomsRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['rooms'] = $roomsRecord->TotalFound;

        //5. Procedures Count
        $table = "ml_procedure_types";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $proceduresRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['procedures'] = $proceduresRecord->TotalFound;
        //ml procedure category
        $table = "ml_procedure_category";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $proceduresRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['procedurescat'] = $proceduresRecord->TotalFound;

        //6. OT Count
        $table = "ml_ot";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $otRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['OT'] = $otRecord->TotalFound;

        //7. Currency Count
        $table = "ml_currency";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $currenciesRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['currencies'] = $currenciesRecord->TotalFound;

        //8. Reason Count
        $table = "ml_admission_purpose_type";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $purposesRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['reasons'] = $purposesRecord->TotalFound;

        //8. Gender Count
        $table = "ml_gender";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $gendersRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['genders'] = $gendersRecord->TotalFound;

        //9. Consultant Count
        $table = "hms_doctor";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $doctorsRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['consultants'] = $doctorsRecord->TotalFound;

        //10. Consultant Count
        $table = "hms_supplier";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $doctorsRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['supplier'] = $doctorsRecord->TotalFound;

        //11. Consultant Count
        $table = "ml_category";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $doctorsRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['category'] = $doctorsRecord->TotalFound;
        // ml_blood group
        $table = "ml_bloodgroup";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $bloodgroup = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['bloodgroup'] = $bloodgroup->TotalFound;

        //12. Consultant Count
        $table = "ml_units";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $doctorsRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['units'] = $doctorsRecord->TotalFound;


        //13. test
        $table = "ml_tests";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $test = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['Test'] = $test->TotalFound;


        //14. test category
        $table = "ml_test_category";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $testcategory = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['TestCategory'] = $testcategory->TotalFound;


        //15. test duplicate
        $table = "ml_tests";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $doctorsRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['Test'] = $doctorsRecord->TotalFound;

        //speciality
        $table = "ml_medical_speciality";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $doctorsRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['Speciality11'] = $doctorsRecord->TotalFound;
        //ConsultantRoom count
        $table = "hms_doctor_room";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $doctorsRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['ConsultantRoom'] = $doctorsRecord->TotalFound;

        //Expense Head count
        $table = "ml_expense_heads";
        $selectData = 'COUNT(1) AS TotalFound';
        $where = array(
            'IsActive' => 1
        );
        $doctorsRecord = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);
        $counter['ExpenseHead'] = $doctorsRecord->TotalFound;

        return $counter;
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

if(!function_exists("getCompanyDetails")){
    function getCompanyDetails(){

        $ci =& get_instance();
        $ci->load->model('Common_Model');

        //Company Details
        $table = 'sys_settings SC';
        $selectData = array(
            'CASE SC.Type
                     WHEN "SiteName" THEN SC.Value
                     ELSE "" END AS SiteName,

                     CASE SC.Type
                     WHEN "HospitalFullName" THEN SC.Value
                     ELSE "" END AS HospitalFullName,

                     CASE SC.Type
                     WHEN "HospitalAddress" THEN SC.Value
                     ELSE "" END AS HospitalAddress,

                     CASE SC.Type
                     WHEN "HospitalPhone1" THEN SC.Value
                     ELSE "" END AS HospitalPhone1,

                     CASE SC.Type
                     WHEN "HospitalSupportEmail" THEN SC.Value
                     ELSE "" END AS HospitalSupportEmail',
            false
        );
        $companyInfo = $ci->Common_model->select_fields($table,$selectData);
        $companyInfo = json_decode(json_encode($companyInfo),true);

        $systemConfiguration = array();
        if(isset($companyInfo) && is_array($companyInfo) && !empty($companyInfo)){
            foreach($companyInfo as $key=>$innerArray){
                foreach($innerArray as $key=>$val){
                    if(!empty($val) && $key === "SiteName"){
                        $systemConfiguration['SiteName'] = $val;
                    }
                    if(!empty($val) && $key === "HospitalFullName"){
                        $systemConfiguration['HospitalFullName'] = $val;
                    }
                    if(!empty($val) && $key === "HospitalAddress"){
                        $systemConfiguration['HospitalAddress'] = $val;
                    }
                    if(!empty($val) && $key === "HospitalPhone1"){
                        $systemConfiguration['HospitalPhone1'] = $val;
                    }
                    if(!empty($val) && $key === "HospitalSupportEmail"){
                        $systemConfiguration['HospitalSupportEmail'] = $val;
                    }
                }
            }
        }
        return $systemConfiguration;
    }
}

//Check if Username Already Exist.
if(!function_exists("is_username_available")){
    function is_username_available($username){

        $ci =& get_instance();
        $ci->load->model('Common_Model');

        $usersTable = 'um_users';
        $selectData = array('COUNT(1) AS TotalFound',false);
        $where = array(
            'Username' => $username
        );

        $results = $ci->Common_model->select_fields_where($usersTable,$selectData,$where,TRUE);

        if($results->TotalFound > 0){
            return true;
        }else{
            return false;
        }
    }
}

//Check if Email Already Exist
if(!function_exists("is_email_available")){
    function is_email_available($email){

        $ci =& get_instance();
        $ci->load->model('Common_Model');

        $usersTable = 'um_users';
        $selectData = array('COUNT(1) AS TotalFound',false);
        $where = array(
            'Email' => $email
        );

        $results = $ci->Common_model->select_fields_where($usersTable,$selectData,$where,TRUE);

        if($results->TotalFound > 0){
            return true;
        }else{
            return false;
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

if(!function_exists("getUserProfileImage")) {
    function getUserProfileImage($UserID){
        $ci =& get_instance();
        $ci->load->model('Common_model');

        $table = 'um_users';
        $selectData = ('profileImageCropped AS Avatar, Username');
        $where = array(
            'UserID' => $UserID
        );

        $User = $ci->Common_model->select_fields_where($table,$selectData,$where,TRUE);

        $defaultAvatar = base_url()."uploads/profile_pictures/default.jpg";

        if(empty($User->Avatar)){
            return $defaultAvatar;
        }else{
            $FilePath = base_url()."uploads/profile_pictures/".$UserID.'-'.$User->Username.'/thumbs/'.$User->Avatar;
            if(file_exists($FilePath)){

                return $FilePath;

            }else{

                return $defaultAvatar;
            }
        }
    }


    if(!function_exists("default_currency")){
        function default_currency(){
            $ci =& get_instance();
            $ci->load->model('Common_model');


            $table = 'sys_settings SC';
            $selectData = array(
                'CASE SC.Type
                     WHEN "DefaultCurrencyID" THEN MLC.symbol
                     ELSE "" END AS Currency',
                false
            );
            $joins = array(
                array(
                    'table' => 'ml_currency MLC',
                    'condition' => "CASE SC.Type WHEN 'DefaultCurrencyID' THEN SC.Value = MLC.ID END",
                    'type' => 'INNER',
                    'escape' => FALSE
                )
            );
            $where = array(
                'MLC.IsActive' => 1
            );

            $currency = $ci->Common_model->select_fields_where_like_join($table,$selectData,$joins,$where,TRUE);


            if(!empty($currency)){
                return $currency->Currency;
            }else{
                return 'Rs';
            }
        }
    }

    if(!function_exists('reorder_default_filter')){
        function reorder_default_filter($array,$index=""){
            if(empty($index)){
                $index = "ID";
            }
            usort($array, function ($a, $b) use($index) { return $a[$index] - $b[$index]; });
            return $array;
        }
    }
}