<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property Common_model $Common_model It resides all the methods which can be used in most of the controllers.
 * @property CI_Input $input It resides all the methods which can be used in most of the controllers.
 */
class Reg extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     *
     */


    function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model("Imagecreate_model");

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: PUT, GET, POST");
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    }
    public function index()
    {
        //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: PUT, GET, POST");
        //header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        //Need to Get Data for Selectors
        //University
                $selectData = array('score AS score',false);
        $where = array(
                'trashed !=' => 1,
                'insertionType !=' => 2
            );

        $selectData ='*';
        $data['userID'] = $this->input->get('id');
        $data['statusApp'] = $this->Common_model->select('esic_appstatus');
        $data['RnDs'] = $this->Common_model->select_fields_where('esic_RnD',$selectData, $where);
        $data['institutions'] = $this->Common_model->select_fields_where('esic_institution',$selectData, $where, false, '', '', '','','',false);
        $data['accelerationCommercials'] = $this->Common_model->select_fields_where('esic_acceleration',$selectData, $where, false, '', '', '','','',false);
        $data['acceleratorProgramme'] = $this->Common_model->select_fields_where('esic_accelerators',$selectData, $where, false, '', '', '','','',false);
        $data['sectors'] = $this->Common_model->select_fields_where('esic_sectors',$selectData, $where, false, '', '', '','','',false);

        $this->load->view('regForm/reg_form_bootstrap',$data);
    }

    public function submit(){
        //header("Access-Control-Allow-Origin: *");
        //header("Access-Control-Allow-Methods: PUT, GET, POST");
        //header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        //Getting all the posted Values.
        $cop_date = '';
        $expiry_date = '';

        $firstName              = $this->input->post('firstName');
        $lastName               = $this->input->post('lastName');
        $email                  = $this->input->post('email');
        $website                = $this->input->post('website');
        $company                = $this->input->post('company');
        $address                = $this->input->post('address');
		$address_post_code              = $this->input->post('address_post_code');
        $address_state                  = $this->input->post('address_state');
        $address_town                   = $this->input->post('address_town');
        $business               = $this->input->post('business');
        $shortDescription       = $this->input->post('shortDescription');
        $short_description        = $this->input->post('short_description');
        $date_pickter_format    = $this->input->post('cop_date');
        if(!empty($date_pickter_format)){
            $cop_date               = date("Y-m-d",strtotime($date_pickter_format));
            $expiry_date            =  getExpiryDate($cop_date);// expiry date calculated on baise on coprated date after 5 years
        }else{
            $cop_date = '';
            $expiry_date = '';
        }
        $added_date             =  date('Y-m-d');
        $acn                    = $this->input->post('acn');

        $mExpense               = $this->input->post('1mExpense');
        $assessableIncomeYear   = $this->input->post('assessableIncomeYear');
        $listedInSExchange      = $this->input->post('listedInSExchange');
        $incorporatedAus        = $this->input->post('incorporatedAus');
        $ownedSubsidiaries      = $this->input->post('ownedSubsidiaries');
        $improvedInnovation     = $this->input->post('improvedInnovation');
        $companyScalable        = $this->input->post('companyScalable');
        $globalMarket           = $this->input->post('globalMarket');
        $competitiveAdvantage   = $this->input->post('competitiveAdvantage');
        $rdExpenses             = $this->input->post('rdExpenses');
        $EntrepreneurProgramme  = $this->input->post('EntrepreneurProgramme');
        $cohortOfEntrepreneurs  = $this->input->post('cohortOfEntrepreneurs');
        $taxIncentives          = $this->input->post('taxIncentives');
        $standardPatent         = $this->input->post('standardPatent');
        $previous2Categories    = $this->input->post('previous2Categories');
        $researchOrganization   = $this->input->post('researchOrganization');


        $RnDID                  = $this->input->post('selectRnD');
        $AccCoID                = $this->input->post('selectAcceleration');
        $AccID                  = $this->input->post('selectAcceleratorProgramme');
        $inID                   = $this->input->post('selectorUniversity');


        

        if(empty($firstName) || empty($lastName)){
            echo "FAIL::Please Enter Complete Name";
            exit;
        }

        if(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
            echo "FAIL::Please Enter a valid Email Address";
            exit;
        }

        $userInsertArray = array(
            'firstName'         => $firstName,
            'lastName'          => $lastName,
            'email'             => $email,
            'website'           => $website,
            'company'           => $company,
            'address'           => $address,
			'address_post_code'         => $address_post_code,
            'address_state'             => $address_state,
            'address_town'              => $address_town,
            'business'          => $business,
            'acn_number'        => $acn,
            'added_date'        => $added_date,
            'expiry_date'       => $expiry_date,
            'corporate_date'    => $cop_date,
            'RnDID'             => $RnDID,
            'AccID'             => $AccID,
            'AccCoID'           => $AccCoID,
            'inID'              => $inID,
            'long_description'  => $shortDescription,
            'short_description'   => $short_description,
            'score'             => 0,
            'Publish'           => 0
        ); 


        $this->db->trans_begin();

        $insertID = $this->Common_model->insert_record('esic',$userInsertArray);
        if(empty($insertID) || !is_numeric($insertID)){
            echo $this->db->last_query();
            $this->db->trans_rollback();
            die("FAIL::Something Went wrong, Could Not Insert");
        }

        //Now Need to Work On Questions.
        //Getting All the Question IDs
        $questions = $this->Common_model->select('esic_questions');

        if(empty($questions) || !is_array($questions)){
            echo $this->db->last_query();
            $this->db->trans_rollback();
            die("FAIL::Something Went wrong, Questions Not Found");
        }

        foreach($questions as $key=>$obj){
            $obj->solutionValue = $this->input->post($obj->QuestionPostedName);
        }

        //Now just insert the questions Solutions
        foreach($questions as $question){
            if(!empty($question->solutionValue)){
                $dataArrayToInsert = array(
                    'questionID' => $question->id,
                    'userID' => $insertID,
                    'Solution' => $question->solutionValue,
                    'type' => ''
                );
                $solutionInsertID = $this->Common_model->insert_record('esic_questions_answers',$dataArrayToInsert);
            }
        }
        //Now calculate total score 
        $total_Score='';
        foreach($questions as $question){
            if(!empty($question->solutionValue)){
                $questions_score = $this->Common_model->select('esic_questions_score'); 
                foreach ($questions_score as $question_score) {
                    if($question->id==$question_score->id && $question->solutionValue==$question_score->SolVal){
                        $total_Score+=$question_score->Points;
                    }
                }
            }
        }
            $scoreInsertArray = array('score' => $total_Score);
            $whereUpdate = array( 'id' => $insertID);
            $resultUpdate = $this->Common_model->update('esic',$whereUpdate,$scoreInsertArray);
            if($resultUpdate === true){
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    echo 'FAIL::Something Went Wrong';
                }else{
                    $this->db->trans_commit();
                    echo 'OK::Thank you. Your information has been submitted.::'.$insertID;
                }
            }else{
                echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
            }
}

    public function step2(){
            //header("Access-Control-Allow-Origin: *");
            //header("Access-Control-Allow-Methods: PUT, GET, POST");
            //header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        //step2
            $userID = $this->input->post('userID');
            $sector = $this->input->post('sector');
            $ipAddress = $this->input->post('ipAddress');
            
            $allowedExt = array('jpeg','jpg','png','gif');

            $uploadPath = './uploads/users/'.$userID.'/';
            $uploadDirectory = './uploads/users/'.$userID;
            $uploadDBPath = 'uploads/users/'.$userID.'/';

            $insertDataArray = array(
                'sectorID'  => $sector,
                'ipAddress' => $ipAddress
            );

            //For Logo Upload
            if(isset($_FILES['logo']['name']))
            {
                $FileName = $_FILES['logo']['name'];
                $explodedFileName = explode('.',$FileName);
                $ext = end($explodedFileName);
                if(!in_array(strtolower($ext),$allowedExt))
                {
                    echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    return;
                }else
                {

                    $FileName = "Logo_".$userID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['logo']['tmp_name'],$uploadPath.$FileName);
                    $insertDataArray['logo'] = $uploadDBPath.$FileName;
                    $fileToCreateThumbnail   = $uploadDBPath.$FileName;
                    $this->Imagecreate_model->createimage($fileToCreateThumbnail);
                }
            }else{
                echo "FAIL::Logo Image Is Required";
                return;
            }
            //For Banner Upload
            if(isset($_FILES['banner']['name']))
            {
                $FileName = $_FILES['banner']['name'];
                $explodedFileName = explode('.',$FileName);
                $ext = end($explodedFileName);
                if(!in_array(strtolower($ext),$allowedExt))
                {
                    echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    return;
                }else
                {
                    $FileName = "Banner_".$userID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['banner']['tmp_name'],$uploadPath.$FileName);
                    $insertDataArray['banner'] = $uploadDBPath.$FileName;
                }
            }
            //For product service Image Upload
            if(isset($_FILES['product']['name']))
            {
                $FileName = $_FILES['product']['name'];
                $explodedFileName = explode('.',$FileName);
                $ext = end($explodedFileName);
                if(!in_array(strtolower($ext),$allowedExt))
                {
                    echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    return;
                }else
                {
                    $FileName = "Product_".$userID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['product']['tmp_name'],$uploadPath.$FileName);
                    $insertDataArray['productImage'] = $uploadDBPath.$FileName;
                }
            }

            if(empty($userID)){
                echo "FAIL::Something went wrong with the Post, Please Contact System Administrator For Further Assistance.";
                exit;
            }

            $whereUpdate = array(
                'id' => $userID
            );
            $resultUpdate = $this->Common_model->update('esic',$whereUpdate,$insertDataArray);
            if($resultUpdate === true){
                echo "OK::Record Updated Successfully";
            }else{
                echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
            }
    }
    public function addInstitution(){
        $institution     =       $this->input->post("institution");
		$address         =       $this->input->post("address");
	    $address_post_code_uni   =       $this->input->post("address_post_code_uni");
 		$institutionAppStatus = $this->input->post("institutionAppStatus");
		 
        if(empty($institution) or !is_string($institution)){
            echo "FAIL::Please Add Institution, Field Can Not be Blank During Submission.";
            return;
        }

        $institutionCheckQuery = $this->db->get_where('esic_institution',array('institution'=>$institution));

        if($institutionCheckQuery->num_rows() > 0){
      
            echo "Existed::".$institution;

        }else{
           
            $insertData = array(
                'institution'   => $institution,
				'address'       => $address,
				'address_post_code' => $address_post_code_uni,
                'AppStatus'     => $institutionAppStatus,
                'insertionType' => 2
            );

            $insertResult = $this->Common_model->insert_record('esic_institution',$insertData);
            if($insertResult > 0){
                echo "OK::".$insertResult."::".$institution;
                    $allowedExt = array('jpeg','jpg','png','gif');
                    $uploadPath = './uploads/logos/'.$insertResult.'/';
                    $uploadDirectory = './uploads/logos/'.$insertResult;
                    $uploadDBPath = 'uploads/logos/'.$insertResult.'/';
                    $insertDataArray = array();
                 //For Logo Upload
                if(isset($_FILES['institutionLogoImage']['name'])){
                        $FileName = $_FILES['institutionLogoImage']['name'];
                        $explodedFileName = explode('.',$FileName);
                        $ext = end($explodedFileName);
                        if(!in_array(strtolower($ext),$allowedExt))
                        {
                            echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                            return;
                        }else
                        {

                            $FileName = "institutionLogoImage".$insertResult."_".time().".".$ext;
                            if(!is_dir($uploadDirectory)){
                                mkdir($uploadDirectory, 0755, true);
                            }

                            move_uploaded_file($_FILES['institutionLogoImage']['tmp_name'],$uploadPath.$FileName);
                            $insertDataArray['institutionLogo'] = $uploadDBPath.$FileName;
                        }
                   
					$whereUpdate = array('id' => $insertResult);
					$resultUpdate = $this->Common_model->update('esic_institution',$whereUpdate,$insertDataArray);
					if($resultUpdate === true){
						echo "OK::Record Updated Successfully";
					}else{
						echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
					}
				}
            }
       }

    }
    public function addRnD(){
        $rndname = $this->input->post("rndname");
        $IDNumber = $this->input->post("IDNumber");
        $Address = $this->input->post("Address");
        $ANZSRC = $this->input->post("ANZSRC");
        $AppStatus = $this->input->post("rndAppStatus");

        if($rndname =='' ){
            echo "FAIL::Please Add RndName, Field Can Not be Blank During Submission.".$rndname.'/'.$IDNumber.'/'.$Address.'/'.$ANZSRC;
            return;
        }

        $RnDCheckQuery = $this->db->get_where('esic_RnD',array('rndname'=>  $rndname));

        if($RnDCheckQuery->num_rows() > 0){
      
            echo "Existed::".$rndname;

        }else{
           
            $insertData = array(
                'rndname'   => $rndname,
                'IDNumber'  => $IDNumber,
                'AddressContact'  => $Address,
                'ANZSRC'    => $ANZSRC,
                'AppStatus' => $AppStatus,
                'insertionType' => 2

            );

            $insertResult = $this->Common_model->insert_record('esic_RnD',$insertData);
            if($insertResult > 0){
                    $allowedExt = array('jpeg','jpg','png','gif');
                    $uploadPath = './uploads/logos/'.$insertResult.'/';
                    $uploadDirectory = './uploads/logos/'.$insertResult;
                    $uploadDBPath = 'uploads/logos/'.$insertResult.'/';
                    $insertDataArray = array();
                 //For Logo Upload
                if(isset($_FILES['rndLogoImage']['name'])){
                        $FileName = $_FILES['rndLogoImage']['name'];
                        $explodedFileName = explode('.',$FileName);
                        $ext = end($explodedFileName);
                        if(!in_array(strtolower($ext),$allowedExt))
                        {
                            echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                            return;
                        }else
                        {

                            $FileName = "rndLogoImage".$insertResult."_".time().".".$ext;
                            if(!is_dir($uploadDirectory)){
                                mkdir($uploadDirectory, 0755, true);
                            }

                            move_uploaded_file($_FILES['rndLogoImage']['tmp_name'],$uploadPath.$FileName);
                            $insertDataArray['rndLogo'] = $uploadDBPath.$FileName;
                        }
                }    
                $whereUpdate = array('id' => $insertResult);
                $resultUpdate = $this->Common_model->update('esic_RnD',$whereUpdate,$insertDataArray);
                if($resultUpdate === true){
                    echo "OK::".$insertResult."::".$rndname;
                    echo "OK::Record Updated Successfully";
                }else{
                    echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
                }
            }
       }

    }
    public function addIndustryClassification(){
        $Industry = $this->input->post("Industry");
        $industryAppStatus = $this->input->post("industryAppStatus");
        if(empty($Industry) or !is_string($Industry)){
            echo "FAIL::Please Add Institution, Field Can Not be Blank During Submission.";
            return;
        }

        $institutionCheckQuery = $this->db->get_where('esic_sectors',array('sector'=>$Industry));

        if($institutionCheckQuery->num_rows() > 0){
            //print_r($institutionCheckQuery);
            echo "Existed::".$Industry;

        }else{
           
            $insertData = array(
                'sector' => $Industry,
                'AppStatus' => $industryAppStatus,
                'insertionType' => 2
            );

            $insertResult = $this->Common_model->insert_record('esic_sectors',$insertData);
            if($insertResult > 0){
                    $allowedExt = array('jpeg','jpg','png','gif');
                    $uploadPath = './uploads/logos/'.$insertResult.'/';
                    $uploadDirectory = './uploads/logos/'.$insertResult;
                    $uploadDBPath = 'uploads/logos/'.$insertResult.'/';
                    $insertDataArray = array();
                 //For Logo Upload
                if(isset($_FILES['secLogoImage']['name'])){
                        $FileName = $_FILES['secLogoImage']['name'];
                        $explodedFileName = explode('.',$FileName);
                        $ext = end($explodedFileName);
                        if(!in_array(strtolower($ext),$allowedExt))
                        {
                            echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                            return;
                        }else
                        {

                            $FileName = "secLogoImage".$insertResult."_".time().".".$ext;
                            if(!is_dir($uploadDirectory)){
                                mkdir($uploadDirectory, 0755, true);
                            }

                            move_uploaded_file($_FILES['secLogoImage']['tmp_name'],$uploadPath.$FileName);
                            $insertDataArray['secLogo'] = $uploadDBPath.$FileName;
                        }
                }    
                $whereUpdate = array('id' => $insertResult);
                $resultUpdate = $this->Common_model->update('esic_sectors',$whereUpdate,$insertDataArray);
                if($resultUpdate === true){
                    echo "OK::".$insertResult."::".$Industry;
                    echo "OK::Record Updated Successfully";
                }else{
                    echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
                }
            }
        }

    }

     public function addEntrepreneurProgramme(){
        $Member             = $this->input->post("Member");
        $Market             = $this->input->post("Market");
        $Technology         = $this->input->post("Technology");
        $Web_Address        = $this->input->post("Web_Address");
        $Project_Title      = $this->input->post("Project_Title");
        $address_state_Territory    = $this->input->post("address_state_Territory");
        $Project_Summary    = $this->input->post("Project_Summary");
        $acceleration_p_c   = $this->input->post("acceleration_p_c");
		 
		$Project_Location   = $this->input->post("Project_Location");
        $AppStatus = $this->input->post("EntrepreneurProgrammeAppStatus");
        if(empty($Member) or !is_string($Member)){
            echo "FAIL::Please Fill All Required Fields, Those Can Not be Blank During Submission.";
            return;
        }

        $iMemberCheckQuery = $this->db->get_where('esic_acceleration',array('Member'=>$Member));
       
        if($iMemberCheckQuery->num_rows() > 0){
            //print_r($iMemberCheckQuery);
            echo "OK::Already Exist!";
        }else{
           
            $insertData = array(
                'Member'            => $Member,
                'Market'            => $Market,
                'Technology'        => $Technology,
                'Web_Address'       => $Web_Address,
                'Project_Title'     => $Project_Title,
                'address_state_Territory'   => $address_state_Territory,
                'Project_Summary'   => $Project_Summary,
                'Project_Location'  => $Project_Location,
				'postal_code'       => $acceleration_p_c,
                'AppStatus'         => $AppStatus,
                'insertionType' => 2
            );

            $insertResult = $this->Common_model->insert_record('esic_acceleration',$insertData);
			 echo "OK::".$insertResult."::".$Member;
            if($insertResult > 0){
                    $allowedExt = array('jpeg','jpg','png','gif');
                    $uploadPath = './uploads/logos/'.$insertResult.'/';
                    $uploadDirectory = './uploads/logos/'.$insertResult;
                    $uploadDBPath = 'uploads/logos/'.$insertResult.'/';
                    $insertDataArray = array();
                 //For Logo Upload
                if(isset($_FILES['accLogoImage']['name'])){
                        $FileName = $_FILES['accLogoImage']['name'];
                        $explodedFileName = explode('.',$FileName);
                        $ext = end($explodedFileName);
                        if(!in_array(strtolower($ext),$allowedExt))
                        {
                            echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                            return;
                        }else
                        {

                            $FileName = "accLogoImage".$insertResult."_".time().".".$ext;
                            if(!is_dir($uploadDirectory)){
                                mkdir($uploadDirectory, 0755, true);
                            }

                            move_uploaded_file($_FILES['accLogoImage']['tmp_name'],$uploadPath.$FileName);
                            $insertDataArray['accLogo'] = $uploadDBPath.$FileName;
                        }
                  
                $whereUpdate = array('id' => $insertResult);
                $resultUpdate = $this->Common_model->update('esic_acceleration',$whereUpdate,$insertDataArray);
                if($resultUpdate === true){
                    echo "OK::".$insertResult."::".$Member;
                    echo "OK::Record Updated Successfully";
                }else{
                    echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
                }
				 echo "OK::Successffully inserted!";
			 } 
            }
        }

    }

     public function addAcceleratorProgramme(){
        $name                         = $this->input->post("AcceleratorProgrammeName");
		$acceleratoraddress           = $this->input->post("acceleratoraddress"); 
	    $accelerator_p_c              = $this->input->post("accelerator_p_c");
 		$Programme_Web_Address        = $this->input->post("Programme_Web_Address");
        $acceleratorProgrammeAppStatus= $this->input->post("acceleratorProgrammeAppStatus");
       

        if(empty($name) or !is_string($name)){
            echo "FAIL::Please Fill All Required Fields, Those Can Not be Blank During Submission.";
            return;
        }

        $nameCheckQuery = $this->db->get_where('esic_accelerators',array('name'=>$name));

        if($nameCheckQuery->num_rows() > 0){
            //print_r($nameCheckQuery);
            echo "Existed::Already Exist!";
        }else{
           
            $insertData = array(
                'name'          => $name,
				'address'       => $acceleratoraddress,
				'address_post_code'   => $accelerator_p_c,
                'website'       => $Programme_Web_Address,
                'AppStatus'     => $acceleratorProgrammeAppStatus,
                'insertionType' => 2
            );

            $insertResult = $this->Common_model->insert_record('esic_accelerators',$insertData);
               echo "OK::".$insertResult."::".$name;
             if($insertResult > 0){
                    $allowedExt = array('jpeg','jpg','png','gif');
                    $uploadPath = './uploads/logos/'.$insertResult.'/';
                    $uploadDirectory = './uploads/logos/'.$insertResult;
                    $uploadDBPath = 'uploads/logos/'.$insertResult.'/';
                    $insertDataArray = array();
                 //For Logo Upload
                if(isset($_FILES['ProgrammeLogoImage']['name'])){
                        $FileName = $_FILES['ProgrammeLogoImage']['name'];
                        $explodedFileName = explode('.',$FileName);
                        $ext = end($explodedFileName);
                        if(!in_array(strtolower($ext),$allowedExt))
                        {
                            echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                            return;
                        }else
                        {

                            $FileName = "ProgrammeLogoImage".$insertResult."_".time().".".$ext;
                            if(!is_dir($uploadDirectory)){
                                mkdir($uploadDirectory, 0755, true);
                            }

                            move_uploaded_file($_FILES['ProgrammeLogoImage']['tmp_name'],$uploadPath.$FileName);
                            $insertDataArray['logo'] = $uploadDBPath.$FileName;
                        }
                    
                $whereUpdate = array('id' => $insertResult);
                $resultUpdate = $this->Common_model->update('esic_accelerators',$whereUpdate,$insertDataArray);
                if($resultUpdate === true){
                    echo "OK::".$insertResult."::".$name;
                    echo "OK::Record Updated Successfully";
                }else{
                    echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
                }
				}
            }
        }

    }
}
