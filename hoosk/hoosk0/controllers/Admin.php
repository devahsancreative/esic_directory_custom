<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {


	function __construct()
	{
		parent::__construct();
	
		define("HOOSK_ADMIN",1);
		$this->load->helper(array('admincontrol', 'url', 'hoosk_admin'));
		$this->load->library('session');
        $this->load->library('facebook');
        $this->load->model('Hoosk_model');
		define ('LANG', $this->Hoosk_model->getLang());
		$this->lang->load('admin', LANG);
		define ('SITE_NAME', $this->Hoosk_model->getSiteName());
		define('THEME', $this->Hoosk_model->getTheme());
		define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);
        //$this->load->library('facebook');

        $this->load->model("Common_model");
        $this->load->model("Imagecreate_model");
//        $this->load->model('Users_auth');
        $this->load->helper('cookie');
//        $this->Users_auth->is_logged_in();
        $this->load->library('resize');

        $url = str_replace($_SERVER["HTTP_HOST"], '', BASE_URL);
        $url = $_SERVER["DOCUMENT_ROOT"].''.$url;
        $url = str_replace('http://', '', $url);
        $url = str_replace('https://', '', $url);
        define ('DoucmentUrl', $url);


	}
	
	public function index($status=NULL)
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$userRole = $this->session->userdata('userRole');
		$userID   = $this->session->userdata('userID');
		
		if($userRole == "1"){
		$this->data['current']            = $this->uri->segment(2);
		$this->data['tUsers']             = $this->Hoosk_model->counttUsers();
		$this->data['total_institution']  = $this->Hoosk_model->institution(); 
		$this->data['esic_rnd']           = $this->Hoosk_model->esic_rnd();
		$this->data['c_acceleration_c']   = $this->Hoosk_model->c_acceleration_c();
        $this->data['Users_By_status']    = $this->Hoosk_model->get_All_Users($status);
		$this->data['users']              = $this->Hoosk_model->get_tUsers();
		$this->data['status']             = $this->Common_model->select('esic_status');
	    $this->data['header']             = $this->load->view('admin/header', $this->data, true);
	    $this->data['footer']             = $this->load->view('admin/footer', '', true);
		
		 //data table code 
		 $this->load->view('admin/home', $this->data);
		}
		elseif($userRole == "2")
		{
		  redirect(base_url().'admin/details/'.$userID); 
	    }
		else{
			 redirect(base_url().'admin/investor/edit_profile/'.$userID);
			}
			 
	}
 
 
public function assessment_dashboard(){
	  
	 $status = $this->input->post('status');
	 $selectData = array('
            h_user.userID as UserID,
			CONCAT(`h_user`.`firstName`," ",`h_user`.`lastName`) AS FullName,
            h_user.email AS Email,
			user.score AS Score,
            ES.id as StatusID,
			company as Company,  
            ES.color AS color,
             CASE WHEN ES.id > 0 THEN CONCAT("<span class=\'label \' style=\' background-color:",color,"\'> ", ES.status," </span>") ELSE CONCAT ("<span class=\'label label-warning\'> ", ES.status, " </span>") END AS Status 
            ',false);
			 
            $joins = array(
                array(
                    'table' 	=> 'esic_status ES',
                    'condition' => 'ES.id = user.status',
                    'type' 		=> 'LEFT'
                ),
				 array(
                    'table' 	=> 'hoosk_user h_user',
                    'condition' => 'h_user.userID = user.userID',
                    'type' 		=> 'LEFT'
                ),
				
			 );
        if(!empty($status)){ 
		    $where =  array('user.status'=>$status);
		    }
		else{
			$where = array('user.id>'=>"0");
			}
        $addColumns = array(
                'ViewEditActionButtons' => array('<a href="'.base_url("admin/details/$1").'"><span aria-hidden="true" class="glyphicon glyphicon-edit text-green "></span></a>','UserID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'user',$joins,$where,'','','',$addColumns);
          //  echo  $this->db->last_query();
		   
			if(!empty($status)){ 
			return print_r($returnedData);
			}
			else{
				
				 print_r($returnedData);
				}
            return NULL;
            
			 
	    
	} 
 
public function upload()
	{


		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$attachment   = $this->input->post('attachment');
		$uploadedFile = $_FILES['attachment']['tmp_name']['file'];

        //explode to get only folder name
		 $path = DoucmentUrl.'/images';//change it


      //  $path = BASE_URL.'/images';

		$url = BASE_URL.'/images';

		// create an image name
		$fileName = $attachment['name'];
		
		// upload the image
		move_uploaded_file($uploadedFile, $path.'/'.$fileName);
		
		$this->output->set_output(json_encode(array('file' => array(
		'url' => $url . '/' . $fileName,
		'filename' => $fileName
		))),
		200,
		array('Content-Type' => 'application/json')
		);
	}

	public function login()
	{$this->load->helper('form');

        $data['settings'] = $this->Hoosk_model->getSettings();
        $data['header'] = $this->load->view('admin/headerlog', '', true);

        $data['footer'] = $this->load->view('admin/footer', '', true);

        $this->load->view('admin/login',$data);
         }

	public function loginCheck()
 	{
		$username=$this->input->post('username');
		$password=md5($this->input->post('password').SALT);
		$result=$this->Hoosk_model->login($username,$password);
		if($result) {
			redirect('/admin', 'refresh');
		}
		else
		{
			$this->data['error'] = "1";
			$this->login();
		}
	}

	public function logout()
	{
		$data = array(
				'userID'    => 	'',
				'userName'  => 	'',
	            'logged_in'	=> 	FALSE,
		);
		$this->session->unset_userdata($data);
		$this->session->sess_destroy();
        $this->facebook->destroy_session();
		$this->login();
	}


	public function settings()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$userRole = $this->session->userdata('userRole');
		if($userRole == 1){

			//Load the form helper
			$this->load->helper('form');
			$this->load->helper('directory');

			$this->data['themesdir'] = directory_map(DoucmentUrl.'/theme/', 1);
			$this->data['langdir'] = directory_map(APPPATH.'/language/', 1);

			$this->data['settings'] = $this->Hoosk_model->getSettings();
			$this->data['current'] = $this->uri->segment(2);
			$this->data['header'] = $this->load->view('admin/header', $this->data, true);
			$this->data['footer'] = $this->load->view('admin/footer', '', true);
			$this->load->view('admin/settings', $this->data);
		}else{
			  $this->load->view('admin/page_not_found');
			 }
	}

	public function updateSettings()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));

		if ($this->input->post('siteLogo') != ""){
		//path to save the image
		$path_upload = DoucmentUrl.'/uploads/';
		$path_images = DoucmentUrl.'/images/';
		//moving temporary file to images folder
		if(rename($path_upload . $this->input->post('siteLogo'), $path_images . $this->input->post('siteLogo')))
		{
			//if the file was uploaded then update settings
			$this->Hoosk_model->updateSettings();
			redirect('/admin/settings', 'refresh');
		}
		else
		{
			//return to settings
			$this->settings();
		}
		}
		else
		{

			$this->Hoosk_model->updateSettings();
			redirect('/admin/settings', 'refresh');
		}

	}

	public function uploadLogo()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';

		$this->load->library('upload', $config);
		foreach ($_FILES as $key => $value) {
			if ( ! $this->upload->do_upload($key))
			{
					$error = array('error' => $this->upload->display_errors());
					echo 0;
			}
			else
			{
					echo '"'.$this->upload->data('file_name').'"';
			}
		}
	}

public function social()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$userRole = $this->session->userdata('userRole');
		if($userRole == 1){
	    	//Load the form helper
			$this->load->helper('form');

			$this->data['social'] = $this->Hoosk_model->getSocial();
            $this->data['fb_data'] = $this->Hoosk_model->getSocial_creaditional();
            $this->data['current'] = $this->uri->segment(2);
			$this->data['header'] = $this->load->view('admin/header', $this->data, true);
			$this->data['footer'] = $this->load->view('admin/footer', '', true);
			$this->load->view('admin/social', $this->data);
	    }else{
			  $this->load->view('admin/page_not_found');
			 }
	}

	public function updateSocial()
	{
		Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		$this->Hoosk_model->updateSocial();
		redirect('/admin', 'refresh');
	}
public function social_creaditional(){

           $fb_id  = $this->input->post('id');
           $fb_sec = $this->input->post('fb_sec');
           $this->Hoosk_model->social_creaditional($fb_id,$fb_sec);
    echo "ok";

}
 public function assessments_list($list=NULL){
	 $userRole = $this->session->userdata('userRole');
	 if($userRole == 1){
        if($list === 'listing'){
            $selectData = array('
            h_user.userID as UserID,
			CONCAT(`h_user`.`firstName`," ",`h_user`.`lastName`) AS FullName,
            h_user.email AS Email,
			 company AS Company,
            user.business AS Business,
            user.score AS Score,
            user.thumbsUp as thumbsUp,
            ES.id as StatusID, 
            user.Publish as Publish,
			ES.color AS color,
             CASE WHEN ES.id > 0 THEN CONCAT("<span class=\'label \' style=\' background-color:",color,"\'> ", ES.status," </span>") ELSE CONCAT ("<span class=\'label label-warning\'> ", ES.status, " </span>") END AS Status 
            ',false);
			  /*?>CASE WHEN user.status = 1 THEN CONCAT("<span class=\'label status label-danger\'> ", ES.status," </span>") WHEN user.status = 7 THEN CONCAT ("<span class=\'label status label-success\'> ", ES.status, " </span>") ELSE CONCAT ("<span class=\'label status label-warning\'> ", ES.status, " </span>") END AS Status<?php
			   CONCAT(`h_user.firstName`," ",`h_user.lastName`) AS FullName, */
            $joins = array(
                array(
                    'table' 	=> 'esic_status ES',
                    'condition' => 'ES.id = user.status',
                    'type' 		=> 'LEFT'
                ),
				 array(
                    'table' 	=> 'hoosk_user h_user',
                    'condition' => 'h_user.userID = user.userID',
                    'type' 		=> 'LEFT'
                )
            );


            $addColumns = array(
                'ViewEditActionButtons' => array('<a href="'.base_url("admin/details/$1").'"><span aria-hidden="true" class="glyphicon glyphicon-edit text-green "></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i class="fa fa-check"></i></a> &nbsp; <a href="#" data-target=".delete-modal" data-toggle="modal"><i class="fa fa-trash-o"></i></a>','UserID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'user',$joins,'','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }

        $data['title'] = 'Pre-assessment List';
        $this->show_admin("admin/reg_list",$data);
    }
	else{
		$this->load->view('admin/page_not_found');
		}
 }

    public function assessment_list(){

	   $userID = $this->input->post('id');
	   $status = $this->input->post('value');
       $statusValue = $this->input->post('statusValue');

	  if(!isset($userID) || empty($userID)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        if($status === 'delete'){
            $whereUpdate = array( 'userID' 	=> $userID);
            $where2 = array( 'userID'  => $userID);
            //$this->Common_model->delete('hoosk_user',$whereUpdate);
            $this->Common_model->delete('user',$whereUpdate);
            $this->Common_model->delete('esic_questions_answers',$where2);
            echo 'OK::';
            return NULL;
        }
        //UpdateData
        $updateArray = array();
        if($status === 'approve' && !empty($statusValue)){
            $updateArray['status'] = $statusValue;
        }

        if($status === 'publish'){
               $updateArray['Publish'] = 1;
           // $this->Common_model->update_user_data($userID);
        }
        if($status === 'unpublish'){
            $updateArray['Publish'] = 0;
        }
        $whereUpdate = array(
            'userID' => $userID,
         );

        $this->Common_model->update('user',$whereUpdate,$updateArray);
        echo 'OK::';
    }
    public function details($userID){   // edit pre asssessment page
		Admincontrol_helper::is_logged_in($this->session->userdata('userID'));
		$userRole = $this->session->userdata('userRole');
		$id = $this->session->userdata('userID');
		if($userRole != 1 && $userID == $id){  //for assessment user can only update its own profile

           $status = $this->input->post('value');
           $selectData = array('
                    CONCAT(`h_user`.`firstName`," ",`h_user`.`lastName`) AS FullName,
                    h_user.email as Email,
                    user_draft.company as Company,
                    user_draft.business as Business,
                    user_draft.businessShortDescription as BusinessShortDesc,
                    user_draft.businessShortDescriptionJSON as BusinessShortDescJSON,
                    user_draft.tinyDescription as tinyDescription,
                    user_draft.score as Score,
                    user_draft.logo as Logo,
                    user_draft.productImage as productImage,
                    user_draft.bannerImage as bannerImage,
                    user_draft.website as Web,
                    user_draft.thumbsUp as thumbsUp,
                    user_draft.business as business,
                    user_draft.address as address,
					user_draft.street_number as street_number,
					user_draft.post_code as post_code,
                    user_draft.town as town,
                    user_draft.state as state,
                    user_draft.acn_number as acn_number,
                    user_draft.expiry_date as expiry_date,
                    user_draft.showExpDate as ShowExpiryDate,
                    user_draft.corporate_date as corporate_date,
                    user_draft.added_date as added_date,
                    user_draft.ipAddress as ipAddress,
                    user_draft.sectorID as sectorID,
                    user_draft.RnDID as RnDID,
                    user_draft.AccCoID as AccCoID,
                    user_draft.AccID as AccID,
                    user_draft.inID as inID,
                    ESEC.sector as sector,
                    user_draft.Publish as Publish
				   ',false);
        //EQS.SolVal as solval,
        //      EQS.Points as points,
        $where = "h_user.userID =".$userID;
        $joins = array(
            array(
                'table' 	=> 'esic_status ES',
                'condition' => 'ES.id = user_draft.status',
                'type' 		=> 'LEFT'
            ),
            array(
                'table' 	=> 'esic_sectors ESEC',
                'condition' => 'ESEC.id = user_draft.sectorID',
                'type' 		=> 'LEFT'
            ),
			 array(
                'table' 	=> 'hoosk_user h_user',
                'condition' => 'h_user.userID = user_draft.userID',
                'type' 		=> 'LEFT'
            )
        );
        $data = array();
        $returnedData = $this->Common_model->select_fields_where_like_join('user_draft',$selectData,$joins,$where,FALSE,'','');
        $selectData2 = array('
                    esic_questions_answers.questionID as questionID,
                    esic_questions_answers.Solution as solution,
                    EQ.Question as Question,
                    EQ.tablename as tablenames,
                    ES.score as score
            ',false);//ES.Score as points
        $where2 = "h_user.userID =".$userID;
        $joins2 = array(
            array(
                'table' 	=> 'esic_questions EQ',
                'condition' => 'EQ.id = esic_questions_answers.questionID',
                'type' 		=> 'LEFT'
            ),
            array(
                'table' 	=> 'esic_solutions ES',
                'condition' => 'ES.questionID = esic_questions_answers.questionID AND ES.solution = esic_questions_answers.solution',
                'type' 		=> 'LEFT'
            ),
			array(
                'table' 	=> 'hoosk_user h_user',
                'condition' => 'h_user.userID = esic_questions_answers.userID',
                'type' 		=> 'LEFT'
            )

        );
        $data2 = array();
        $returnedData2 = $this->Common_model->select_fields_where_like_join('esic_questions_answers',$selectData2,$joins2,$where2,FALSE,'','');
		//echo $this->db->last_query();
	//	exit;

        if(!empty($returnedData) and is_array($returnedData)){
            if($returnedData[0]->Score>0){
                $TotalPoints = $this->db->query('SELECT SUM(MaxPoints) AS TotalPoints FROM (SELECT id, questionID, MAX(Points) AS MaxPoints FROM esic_questions_score GROUP BY questionID) Points')->row()->TotalPoints;
                $ScorePercentage = $returnedData[0]->Score/$TotalPoints*100;
            }else{
                $TotalPoints = '';
                $ScorePercentage='';
            }
            // $date1 = new DateTime($returnedData[0]->corporate_date);
            $date1 = new DateTime(date('Y-m-d H:i:s'));
            $date2 = new DateTime($returnedData[0]->expiry_date);
            $diff = $date2->diff($date1)->format("%a");
            // if($diff> 60){
            //     $diff = '';
            //}
            $data['userProfile'] = array(
                'userID' 			=> $userID,
                'ScorePercentage' 	=> $ScorePercentage,
                'Web' 				=> $returnedData[0]->Web,
                'Logo' 				=> $returnedData[0]->Logo,
                'thumbsUp'          => $returnedData[0]->thumbsUp,
                'bannerImage'       => $returnedData[0]->bannerImage,
                'productImage'      => $returnedData[0]->productImage,
                'Email' 			=> $returnedData[0]->Email,
                'Score' 			=> $returnedData[0]->Score,
                'sector' 			=> $returnedData[0]->sector,
                //'Status' 			=> $returnedData[0]->Status,
                'Company'			=> $returnedData[0]->Company,
                'business' 			=> $returnedData[0]->business,
                'FullName' 			=> $returnedData[0]->FullName,
                'ipAddress'         => $returnedData[0]->ipAddress,
                'address'           => $returnedData[0]->address,
                'street_number'     => $returnedData[0]->street_number,
                'post_code'         => $returnedData[0]->post_code,
                'town'              => $returnedData[0]->town,
                'state'             => $returnedData[0]->state,
                'acn_number'        => $returnedData[0]->acn_number,
                'sectorID'          => $returnedData[0]->sectorID,
                'RnDID'             => $returnedData[0]->RnDID,
                'AccCoID'           => $returnedData[0]->AccCoID,
                'AccID'             => $returnedData[0]->AccID,
                'inID'              => $returnedData[0]->inID,
                'Publish'           => $returnedData[0]->Publish,
			    'dateDiff'          => $diff,
                'added_date' 		=> date("d-M-Y", strtotime($returnedData[0]->added_date)),
                'expiry_date' 		=> date("d-M-Y", strtotime($returnedData[0]->expiry_date)),
                'corporate_date' 	=> date("d-M-Y", strtotime($returnedData[0]->corporate_date)),
                'added_date_value'        => date("d-m-Y", strtotime($returnedData[0]->added_date)),
                'expiry_date_value'       => date("d-m-Y", strtotime($returnedData[0]->expiry_date)),
                'corporate_date_value'    => date("d-m-Y", strtotime($returnedData[0]->corporate_date)),
                'BusinessShortDesc' => $returnedData[0]->BusinessShortDesc,
                'BusinessShortDescJSON' => $returnedData[0]->BusinessShortDescJSON,
                'tinyDescription' => $returnedData[0]->tinyDescription,
                'ShowExpiryDate' => $returnedData[0]->ShowExpiryDate
            );
            $QuestionNotAnswered = array();
            $QuestionAnswered = array();
            $QuestionAll = array();
            $QuestionsFirstArray = $this->Common_model->select('esic_questions');
            if(!empty($QuestionsFirstArray) and is_array($QuestionsFirstArray)){
                foreach($QuestionsFirstArray as $key=>$questionsObj){
                    $QuestionAll = array(
                        'questionID'    => $questionsObj->id,
                        'Question'      => $questionsObj->Question
                    );
                }
            }
            if(!empty($returnedData2) and is_array($returnedData2)){
                $data['usersQuestionsAnswers'] = array();
                foreach($returnedData2 as $key=>$obj){
                    $arrayToInsert = array(
                        'points' 		=> $obj->score,
                        'Question' 		=> $obj->Question,
                        'TableName'     => $obj->tablenames,
                        'solution' 		=> $obj->solution,
                        'questionID' 	=> $obj->questionID
                    );
                    array_push($data['usersQuestionsAnswers'],$arrayToInsert);
                    if(!in_array($obj->questionID, $QuestionAnswered)){
                        array_push($QuestionAnswered,$obj->questionID);
                    }
                }
            }
            if(is_array($QuestionAnswered)){
                $QuestionsArray = $this->Common_model->select('esic_questions');
                $data['usersQuestionsNotAnswers'] = array();
                if(!empty($QuestionsArray) and is_array($QuestionsArray)){
                    foreach($QuestionsArray as $key=>$questionsObj){
                        if(!in_array($questionsObj->id, $QuestionAnswered)){
                            $QuestionNotAnswered = array(
                                'questionID'    => $questionsObj->id,
                                'Question'      => $questionsObj->Question,
                                'TableName'     => $questionsObj->tablename
                            );
                            array_push($data['usersQuestionsNotAnswers'],$QuestionNotAnswered);
                        }

                    }
                }
            }

        }
		$data['social'] = $this->Esic_model->get_user_Social($userID);
        $data['uID'] = base64_encode($userID);
        $this->show_admin("admin/reg_details",$data);
    }
	elseif($userRole == 1){
		     $status = $this->input->post('value');
           $selectData = array('
                    CONCAT(`h_user`.`firstName`," ",`h_user`.`lastName`) AS FullName,
                    h_user.email as Email,
                    user.company as Company,
                    user.business as Business,
                    user.businessShortDescription as BusinessShortDesc,
                    user.businessShortDescriptionJSON as BusinessShortDescJSON,
                    user.tinyDescription as tinyDescription,
                    user.score as Score,
                    user.logo as Logo,
                    user.productImage as productImage,
                    user.bannerImage as bannerImage,
                    user.website as Web,
                    user.thumbsUp as thumbsUp,
                    user.business as business,
                    user.address as address,
					user.street_number as street_number,
					user.post_code as post_code,
                    user.town as town,
                    user.state as state,
                    user.acn_number as acn_number,
                    user.expiry_date as expiry_date,
                    user.showExpDate as ShowExpiryDate,
                    user.corporate_date as corporate_date,
                    user.added_date as added_date,
                    user.ipAddress as ipAddress,
                    user.sectorID as sectorID,
                    user.RnDID as RnDID,
                    user.AccCoID as AccCoID,
                    user.AccID as AccID,
                    user.inID as inID,
                    ESEC.sector as sector,
                    user.Publish as Publish
				   ',false);
        //EQS.SolVal as solval,
        //      EQS.Points as points,
        $where = "h_user.userID =".$userID;
        $joins = array(
            array(
                'table' 	=> 'esic_status ES',
                'condition' => 'ES.id = user.status',
                'type' 		=> 'LEFT'
            ),
            array(
                'table' 	=> 'esic_sectors ESEC',
                'condition' => 'ESEC.id = user.sectorID',
                'type' 		=> 'LEFT'
            ),
			 array(
                'table' 	=> 'hoosk_user h_user',
                'condition' => 'h_user.userID = user.userID',
                'type' 		=> 'LEFT'
            )
        );
        $data = array();
        $returnedData = $this->Common_model->select_fields_where_like_join('user',$selectData,$joins,$where,FALSE,'','');
        $selectData2 = array('
                    esic_questions_answers.questionID as questionID,
                    esic_questions_answers.Solution as solution,
                    EQ.Question as Question,
                    EQ.tablename as tablenames,
                    ES.score as score
            ',false);//ES.Score as points
        $where2 = "h_user.userID =".$userID;
        $joins2 = array(
            array(
                'table' 	=> 'esic_questions EQ',
                'condition' => 'EQ.id = esic_questions_answers.questionID',
                'type' 		=> 'LEFT'
            ),
            array(
                'table' 	=> 'esic_solutions ES',
                'condition' => 'ES.questionID = esic_questions_answers.questionID AND ES.solution = esic_questions_answers.solution',
                'type' 		=> 'LEFT'
            ),
			array(
                'table' 	=> 'hoosk_user h_user',
                'condition' => 'h_user.userID = esic_questions_answers.userID',
                'type' 		=> 'LEFT'
            )

        );
        $data2 = array();
        $returnedData2 = $this->Common_model->select_fields_where_like_join('esic_questions_answers',$selectData2,$joins2,$where2,FALSE,'','');
		//echo $this->db->last_query();
	//	exit;

        if(!empty($returnedData) and is_array($returnedData)){
            if($returnedData[0]->Score>0){
                $TotalPoints = $this->db->query('SELECT SUM(MaxPoints) AS TotalPoints FROM (SELECT id, questionID, MAX(Points) AS MaxPoints FROM esic_questions_score GROUP BY questionID) Points')->row()->TotalPoints;
                $ScorePercentage = $returnedData[0]->Score/$TotalPoints*100;
            }else{
                $TotalPoints = '';
                $ScorePercentage='';
            }
            // $date1 = new DateTime($returnedData[0]->corporate_date);
            $date1 = new DateTime(date('Y-m-d H:i:s'));
            $date2 = new DateTime($returnedData[0]->expiry_date);
            $diff = $date2->diff($date1)->format("%a");
            // if($diff> 60){
            //     $diff = '';
            //}
            $data['userProfile'] = array(
                'userID' 			=> $userID,
                'ScorePercentage' 	=> $ScorePercentage,
                'Web' 				=> $returnedData[0]->Web,
                'Logo' 				=> $returnedData[0]->Logo,
                'thumbsUp'          => $returnedData[0]->thumbsUp,
                'bannerImage'       => $returnedData[0]->bannerImage,
                'productImage'      => $returnedData[0]->productImage,
                'Email' 			=> $returnedData[0]->Email,
                'Score' 			=> $returnedData[0]->Score,
                'sector' 			=> $returnedData[0]->sector,
                //'Status' 			=> $returnedData[0]->Status,
                'Company'			=> $returnedData[0]->Company,
                'business' 			=> $returnedData[0]->business,
                'FullName' 			=> $returnedData[0]->FullName,
                'ipAddress'         => $returnedData[0]->ipAddress,
                'address'           => $returnedData[0]->address,
                'street_number'     => $returnedData[0]->street_number,
                'post_code'         => $returnedData[0]->post_code,
                'town'              => $returnedData[0]->town,
                'state'             => $returnedData[0]->state,
                'acn_number'        => $returnedData[0]->acn_number,
                'sectorID'          => $returnedData[0]->sectorID,
                'RnDID'             => $returnedData[0]->RnDID,
                'AccCoID'           => $returnedData[0]->AccCoID,
                'AccID'             => $returnedData[0]->AccID,
                'inID'              => $returnedData[0]->inID,
                'Publish'           => $returnedData[0]->Publish,
			    'dateDiff'          => $diff,
                'added_date' 		=> date("d-M-Y", strtotime($returnedData[0]->added_date)),
                'expiry_date' 		=> date("d-M-Y", strtotime($returnedData[0]->expiry_date)),
                'corporate_date' 	=> date("d-M-Y", strtotime($returnedData[0]->corporate_date)),
                'added_date_value'        => date("d-m-Y", strtotime($returnedData[0]->added_date)),
                'expiry_date_value'       => date("d-m-Y", strtotime($returnedData[0]->expiry_date)),
                'corporate_date_value'    => date("d-m-Y", strtotime($returnedData[0]->corporate_date)),
                'BusinessShortDesc' => $returnedData[0]->BusinessShortDesc,
                'BusinessShortDescJSON' => $returnedData[0]->BusinessShortDescJSON,
                'tinyDescription' => $returnedData[0]->tinyDescription,
                'ShowExpiryDate' => $returnedData[0]->ShowExpiryDate
            );
            $QuestionNotAnswered = array();
            $QuestionAnswered = array();
            $QuestionAll = array();
            $QuestionsFirstArray = $this->Common_model->select('esic_questions');
            if(!empty($QuestionsFirstArray) and is_array($QuestionsFirstArray)){
                foreach($QuestionsFirstArray as $key=>$questionsObj){
                    $QuestionAll = array(
                        'questionID'    => $questionsObj->id,
                        'Question'      => $questionsObj->Question
                    );
                }
            }
            if(!empty($returnedData2) and is_array($returnedData2)){
                $data['usersQuestionsAnswers'] = array();
                foreach($returnedData2 as $key=>$obj){
                    $arrayToInsert = array(
                        'points' 		=> $obj->score,
                        'Question' 		=> $obj->Question,
                        'TableName'     => $obj->tablenames,
                        'solution' 		=> $obj->solution,
                        'questionID' 	=> $obj->questionID
                    );
                    array_push($data['usersQuestionsAnswers'],$arrayToInsert);
                    if(!in_array($obj->questionID, $QuestionAnswered)){
                        array_push($QuestionAnswered,$obj->questionID);
                    }
                }
            }
            if(is_array($QuestionAnswered)){
                $QuestionsArray = $this->Common_model->select('esic_questions');
                $data['usersQuestionsNotAnswers'] = array();
                if(!empty($QuestionsArray) and is_array($QuestionsArray)){
                    foreach($QuestionsArray as $key=>$questionsObj){
                        if(!in_array($questionsObj->id, $QuestionAnswered)){
                            $QuestionNotAnswered = array(
                                'questionID'    => $questionsObj->id,
                                'Question'      => $questionsObj->Question,
                                'TableName'     => $questionsObj->tablename
                            );
                            array_push($data['usersQuestionsNotAnswers'],$QuestionNotAnswered);
                        }

                    }
                }
            }

        }
		$data['social'] = $this->Esic_model->get_user_Social($userID);
		$data['uID'] = base64_encode($userID);
        $this->show_admin("admin/reg_details",$data);
		}
	   else{
		     $this->load->view('admin/page_not_found');
		   }
    }
    public function getanswers(){
        $questionID 	= $this->input->post('dataQuestionId');
        $where 			= "questionID =".$questionID;
        $data  			= array();
        $selectData 	= array('Solution as solution',false);
        $returnedData 	= $this->Common_model->select_fields_where_like_join('esic_solutions',$selectData,'',$where,FALSE,'','');
        echo json_encode($returnedData );
        exit();
    }
    public function saveanswer(){
        $id 			= $this->input->post('id');
        $userID 		= $this->input->post('userID');
        $oldScore 		= $this->input->post('oldScore');
        $Answervalue 	= $this->input->post('Answervalue');
        $tableName      = $this->input->post('tableName');
        $tableUpdateID  = $this->input->post('tableUpdateID');
        $SpAnswervalue  = $this->input->post('SpAnswervalue');
        $dataQuestionId = $this->input->post('dataQuestionId');
        if(!isset($userID) || empty($userID) || !isset($Answervalue) || empty($Answervalue) || !isset($dataQuestionId) || empty($dataQuestionId)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }
        $where= array("userID"=>$userID);
        $updateData = array("status"=>1);
        $this->Common_model->update('user',$where,$updateData);
        $selectData = array('score AS score',false);
        $where = array(
            'questionID' => $dataQuestionId,
            'solution' 	 => $Answervalue
        );
        $returnedData = $this->Common_model->select_fields_where('esic_solutions',$selectData, $where, false, '', '', '','','',false);
        $score = $returnedData[0]->score;
        $updateArray = array();
        $updateArray['Solution'] = $Answervalue;
        $whereUpdate = array(
            'userID' => $userID,
            'questionID' => $dataQuestionId
        );
        $this->Common_model->update('esic_questions_answers',$whereUpdate,$updateArray);
        if($this->db->affected_rows() < 1){
            $insertArray = array(
                'userID' => $userID,
                'questionID' => $dataQuestionId,
                'Solution' =>  $Answervalue
            );
            $insertResult = $this->Common_model->insert_record('esic_questions_answers',$insertArray);
            //if($insertResult){
            //    echo "OK::Record Successfully Entered";
            //}else{
            //    echo "FAIL::Record Failed Entered";
            //}
        }
        $selectData2 = array('score AS score',false);
        $where2 = array('id' => $userID);
        $returnedData2 = $this->Common_model->select_fields_where('user',$selectData2, $where2, false, '', '', '','','',false);
        $TotalOldscore =  $returnedData[0]->score;
        $Totalscore    = ($returnedData[0]->score-$oldScore)+$score;
        if($Totalscore > 0){
            $TotalPoints   = $this->db->query('SELECT SUM(MaxPoints) AS TotalPoints FROM (SELECT id, questionID, MAX(Points) AS MaxPoints FROM esic_questions_score GROUP BY questionID) Points')->row()->TotalPoints;
            $ScorePercentage = $Totalscore/$TotalPoints*100;
        }else{
            $Totalscore = 0;
            $ScorePercentage = 0;
        }
        if($score<=0){
            $score ='';
        }else{
            $score ='('.$score.')';
        }
        $updateArray2 = array();
        $updateArray2['score'] = $Totalscore;
        $whereUpdate2 = array('id' => $userID);
        $this->Common_model->update('user',$whereUpdate2,$updateArray2);
        echo 'OK::'.$score.'::'.$ScorePercentage.'::'.$TotalOldscore.'::'.$Totalscore;
        if(isset($tableName) && !empty($tableName) && isset($SpAnswervalue) && !empty($SpAnswervalue) && isset($tableUpdateID) && !empty($tableUpdateID)){
            $updateArray3 = array();
            $updateArray3[$tableUpdateID] = $SpAnswervalue;
            $whereUpdate3 = array('id' => $userID);
            $this->Common_model->update('user',$whereUpdate3,$updateArray3);
        }
        $this->Common_model->save_darft($userID);
        exit();
    }
    public function savedate(){
        $userID    = $this->input->post('userID');
        $dateType  = $this->input->post('dateType');
        $EditedDate= $this->input->post('EditedDate');
        if(!isset($userID) || empty($userID) || !isset($EditedDate) || empty($EditedDate)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }
        $EditedDate = date("Y-m-d",strtotime($EditedDate));
        $updateArray = array();
        $updateArray[$dateType] = $EditedDate;
        $whereUpdate = array('userID' => $userID);
        $this->Common_model->save_darft($userID);
        $this->Common_model->update('user_draft',$whereUpdate,$updateArray);
        echo 'OK::'.$EditedDate.'';
        exit();
    }
    public function savedesc(){
		$uID_encoded = $this->input->post('uID');
        if(!empty($uID_encoded))
		$uID = base64_decode($uID_encoded);





/*        $userID        = $this->input->post('userID');
        $descDataText  = $this->input->post('descDataText');
        if(!isset($userID) || empty($userID) || !isset($descDataText) || empty($descDataText)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        $updateArray = array();
        $updateArray['businessShortDescription'] = $descDataText;
        $whereUpdate = array('userID' => $userID);
        $this->Common_model->update('user',$whereUpdate,$updateArray);
        echo 'OK::'.urldecode($descDataText).'';
        exit();*/


		//Haider COde. Changed for Editor.
		$this->load->library('Sioen');
		$this->Hoosk_model->UpdateEsicPageDescription($uID);
		//Return to page list
		redirect('/admin/details/'.$uID, 'refresh');
    }
	public function save_desc_editor(){
		echo 'Hello WOrld';
	}
    public function saveshortdesc(){
        $userID        = $this->input->post('userID');
        $descDataText  = $this->input->post('descDataText');
        if(!isset($userID) || empty($userID) || !isset($descDataText) || empty($descDataText)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        $updateArray = array();
        $updateArray['tinyDescription'] = $descDataText;
        $updateArray['status'] = 1;
        $whereUpdate = array('userID' => $userID);
        $this->Common_model->save_darft($userID);
        $this->Common_model->update('user_draft',$whereUpdate,$updateArray);
        echo 'OK::'.urldecode($descDataText).'';
        exit();
    }
    public function savelogo(){
    	$userRole = $this->session->userdata('userRole');
    	$user_table = 'user_draft';
 		if($userRole == 1){
 			//admin
 			$user_table = 'user';
 		}
        $userID = $this->input->post('userID');
        $allowedExt = array('jpeg','jpg','png','gif');
        $uploadPath = './uploads/users/'.$userID.'/';
        $uploadDirectory = './uploads/users/'.$userID;
        $uploadDBPath = 'uploads/users/'.$userID.'/';
        $insertDataArray = array();

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

        if(empty($userID)){
            echo "FAIL::Something went wrong with the Post, Please Contact System Administrator For Further Assistance.";
            exit;
        }
        $selectData = array('logo AS logo',false);
        $where = array(
            'userID' => $userID
        );
        $returnedData = $this->Common_model->select_fields_where($user_table,$selectData, $where, false, '', '', '','','',false);
        $logo = $returnedData[0]->logo;
        if(!empty($logo) && is_file(FCPATH.$logo)){
            unlink('./'.$logo);
        }
        $this->Common_model->save_darft($userID);
        $resultUpdate = $this->Common_model->update($user_table,$where,$insertDataArray);
        if($resultUpdate === true){

            echo "OK::Record Updated Successfully";
            echo $this->db->last_query();
        }else{
            echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
        }
    }
    public function saveBannerImage(){
        $userID = $this->input->post('userID');
        $allowedExt = array('jpeg','jpg','png','gif');
        $uploadPath = './uploads/users/'.$userID.'/';
        $uploadDirectory = './uploads/users/'.$userID;
        $uploadDBPath = 'uploads/users/'.$userID.'/';
        $insertDataArray = array();

        //For Logo Upload
        if(isset($_FILES['bannerImage']['name']))
        {
            $FileName = $_FILES['bannerImage']['name'];
            $explodedFileName = explode('.',$FileName);
            $ext = end($explodedFileName);
            if(!in_array(strtolower($ext),$allowedExt))
            {
                echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                return;
            }else
            {

                $FileName = "bannerImage".$userID."_".time().".".$ext;
                if(!is_dir($uploadDirectory)){
                    mkdir($uploadDirectory, 0755, true);
                }

                move_uploaded_file($_FILES['bannerImage']['tmp_name'],$uploadPath.$FileName);
                $insertDataArray['bannerImage'] = $uploadDBPath.$FileName;
            }
        }else{
            echo "FAIL::Banner Image Is Required";
            return;
        }

        if(empty($userID)){
            echo "FAIL::Something went wrong with the Post, Please Contact System Administrator For Further Assistance.";
            exit;
        }
        $selectData = array('bannerImage AS bannerImage',false);
        $where = array(
            'userID' => $userID
        );
        $returnedData = $this->Common_model->select_fields_where('user_draft',$selectData, $where, false, '', '', '','','',false);
        $bannerImage = $returnedData[0]->bannerImage;
        if(!empty($bannerImage) && is_file(FCPATH.'/'.$bannerImage)){
            unlink('./'.$bannerImage);
        }
        $this->Common_model->save_darft($userID);
        $resultUpdate = $this->Common_model->update('user_draft',$where,$insertDataArray);
        if($resultUpdate === true){
            echo "OK::Record Updated Successfully";
        }else{
            echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
        }
    }
    public function saveProductImage(){
        $userID = $this->input->post('userID');
        $allowedExt = array('jpeg','jpg','png','gif');
        $uploadPath = './uploads/users/'.$userID.'/';
        $uploadDirectory = './uploads/users/'.$userID;
        $uploadDBPath = 'uploads/users/'.$userID.'/';
        $insertDataArray = array();

        //For Logo Upload
        if(isset($_FILES['productImage']['name']))
        {
            $FileName = $_FILES['productImage']['name'];
            $explodedFileName = explode('.',$FileName);
            $ext = end($explodedFileName);
            if(!in_array(strtolower($ext),$allowedExt))
            {
                echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                return;
            }else
            {

                $FileName = "productImage".$userID."_".time().".".$ext;
                if(!is_dir($uploadDirectory)){
                    mkdir($uploadDirectory, 0755, true);
                }

                move_uploaded_file($_FILES['productImage']['tmp_name'],$uploadPath.$FileName);
                $insertDataArray['productImage'] = $uploadDBPath.$FileName;
            }
        }else{
            echo "FAIL::Product Image Is Required";
            return;
        }

        if(empty($userID)){
            echo "FAIL::Something went wrong with the Post, Please Contact System Administrator For Further Assistance.";
            exit;
        }
        $selectData = array('productImage AS productImage',false);
        $where = array(
            'userID' => $userID
        );
        $returnedData = $this->Common_model->select_fields_where('user_draft',$selectData, $where, false, '', '', '','','',false);
        $productImage = $returnedData[0]->productImage;
        if(!empty($productImage) && is_file(FCPATH.'/'.$productImage)){
            unlink('./'.$productImage);
        }
        $this->Common_model->save_darft($userID);
        $resultUpdate = $this->Common_model->update('user_draft',$where,$insertDataArray);
        if($resultUpdate === true){
            echo "OK::Record Updated Successfully";
        }else{
            echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
        }
    }
    public function updatename(){
        $userID    = $this->input->post('userID');
        $fullName  = $this->input->post('fullName');
        if(!isset($userID) || empty($userID) || !isset($fullName) || empty($fullName)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        $updateArray = array();
        $updateArray['firstName'] = $fullName;
        $updateArray['lastName']  = '';
        $whereUpdate = array('id' => $userID);
        $this->Common_model->update('hoosk_user',$whereUpdate,$updateArray);
        echo 'OK::'.$fullName.'';
        exit();
    }
    public function resetThumbsUp(){
        $userID    = $this->input->post('userID');
        if(!isset($userID) || empty($userID)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        $updateArray = array();
        $updateArray['thumbsUp'] = 0;
        $whereUpdate = array('id' => $userID);
        $this->Common_model->save_darft($userID);
        $this->Common_model->update('user_draft',$whereUpdate,$updateArray);
        echo 'OK::';
        exit();
    }
    public function updatewebsite(){
        $userID    = $this->input->post('userID');
        $website  = $this->input->post('website');
        if(!isset($userID) || empty($userID) || !isset($website) || empty($website)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        $updateArray = array();
        $updateArray['website'] = $website;
        $whereUpdate = array('userID' => $userID);
        $this->Common_model->save_darft($userID);
        $this->Common_model->update('user_draft',$whereUpdate,$updateArray);
        echo 'OK::'.$website.'';
        exit();
    }
    public function updatecompany(){
        $userID    = $this->input->post('userID');
        $company  = $this->input->post('company');
        if(!isset($userID) || empty($userID) || !isset($company) || empty($company)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        $updateArray = array();
        $updateArray['Company'] = $company;
        $updateArray['status'] = 1;
        $whereUpdate = array('id' => $userID);
        $this->Common_model->save_darft($userID);
        $this->Common_model->update('user_draft',$whereUpdate,$updateArray);
        echo 'OK::'.$company.'';
        exit();
    }
    public function updateemail(){
        $userID    = $this->input->post('userID');
        $email  = $this->input->post('email');
        if(!isset($userID) || empty($userID) || !isset($email) || empty($email)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        $updateArray = array();
        $updateArray['Email'] = $email;
        $whereUpdate = array('userID' => $userID);
        $this->Common_model->update('hoosk_user',$whereUpdate,$updateArray);
        echo 'OK::'.$email.'';
        exit();
    }
    public function updateip(){
        $userID    = $this->input->post('userID');
        $ip = $this->input->post('ipAddress');
        if(!isset($userID) || empty($userID) || !isset($ip) || empty($ip)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        $updateArray = array();
        $updateArray['ipAddress'] = $ip;
        $whereUpdate = array('userID' => $userID);
        $this->Common_model->save_darft($userID);
        $this->Common_model->update('user_draft',$whereUpdate,$updateArray);
        echo 'OK::'.$ip.'';
        exit();
    }
    public function updateacn(){
        $userID    = $this->input->post('userID');
        $acn  = $this->input->post('acn');
        if(!isset($userID) || empty($userID) || !isset($acn) || empty($acn)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        $updateArray = array();
        $updateArray['acn_number'] = $acn;
        $whereUpdate = array('userID' => $userID);
        $this->Common_model->save_darft($userID);
        $this->Common_model->update('user_draft',$whereUpdate,$updateArray);
        echo 'OK::'.$acn.'';
        exit();
    }
    public function updateAddress(){
        $userID         = $this->input->post('userID');
        $street_number  = $this->input->post('street_number'); 
	    $street_name    = $this->input->post('street_name');
        $town           = $this->input->post('town');
        $state          = $this->input->post('state');
		$post_input     = $this->input->post('post_input');
        if(!isset($userID) || empty($userID)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        $updateArray = array();
		$updateArray['address']       = $street_name;
        $updateArray['street_number'] = $street_number;
		$updateArray['town']          = $town;
        $updateArray['state']         = $state;
		$updateArray['post_code']     = $post_input;

        $whereUpdate = array('userID' => $userID);
        $this->Common_model->save_darft($userID);
        $this->Common_model->update('user_draft',$whereUpdate,$updateArray);
        echo 'OK::'.$street_number.'::'.$street_name.''.'::'.$town.''.'::'.$state.''.'::'.$post_input.'';
        exit();
    }
    public function updatebsName(){
        $userID    = $this->input->post('userID');
        $bsName  = $this->input->post('bsName');
        if(!isset($userID) || empty($userID) || !isset($bsName) || empty($bsName)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        $updateArray = array();
        $updateArray['business'] = $bsName;
        $whereUpdate = array('userID' => $userID);
        $this->Common_model->save_darft($userID);
        $this->Common_model->update('user_draft',$whereUpdate,$updateArray);


        echo 'OK::'.$bsName.'';
        exit();
    }
    public function getsectors(){
        $userID     = $this->input->post('userID');
        $where = 'id != 0';
        $data           = array();
        $selectData     = array('id as id, sector as sector',false);
        $returnedData   = $this->Common_model->select_fields_where_like_join('esic_sectors',$selectData,'',$where,FALSE,'','');
        echo json_encode($returnedData );
        exit();
    }
    public function savesector(){
        $userID    = $this->input->post('userID');
        $sectorID  = $this->input->post('answer');
        if(!isset($userID) || empty($userID) || !isset($sectorID) || empty($sectorID)){
            echo "FAIL::Something went wrong with the post, Please Contact System Administrator for Further Assistance";
            return;
        }

        $updateArray = array();
        $updateArray['sectorID'] = $sectorID;
        $whereUpdate = array('userID' => $userID);
        $this->Common_model->save_darft($userID);
        $this->Common_model->update('user_draft',$whereUpdate,$updateArray);
        echo 'OK::'.$sectorID.'';
    }
public function manage_status($param = NULL){
Admincontrol_helper::is_logged_in($this->session->userdata('userID'));  
$userRole = $this->session->userdata('userRole');
 if($userRole == 1){


        if($param === 'listing'){
		 
            $selectData = array('
            id AS ID,
			color AS Color,
            CASE WHEN id>0 THEN CONCAT("<span class=\'label \' style=\' background-color:",color,"\'> ", status," </span>")  ELSE CONCAT ("<span class=\'label label-warning\'> ", status, " </span>") END AS Status
            ',false); 
            $addColumns = array(
                'ViewEditActionButtons' => array('<a href="#" data-target="#editStatusModal" data-toggle="modal"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','ID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'esic_status','','','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }
        if($param === 'allvalues'){
            $returnedData = $this->Common_model->select('esic_status');
            echo json_encode($returnedData);
            return NULL;
        }
        if($param === 'delete'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }
            $data='';
            if($value == 'delete'){

                $whereUpdate = array(
                    'id' => $id
                );

                $returnedData = $this->Common_model->delete('esic_status',$whereUpdate);
                echo "OK::Record Deleted";
            }else{
                echo "FAIL::Record Not Deleted";
            }
            return NULL;
        }
        if($param === 'update'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('status');
			$color = $this->input->post('color');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }
			if(empty($color)){
                echo "FAIL::Color Value Must Be Entered";
                return NULL;
            }

            $updateData = array(
                'status' => $value,
				'color' => $color
            );

            $whereUpdate = array(
                'id' => $id
            );

            $updateResult = $this->Common_model->update('esic_status',$whereUpdate,$updateData);
            if($updateResult === true){
                echo "OK::Record Successfully Updated";
            }else{
                if($updateResult['code'] == 0){
                    echo "OK::Record Already Exist";
                }else{
                    echo $updateResult['message'];
                }
            }
            return NULL;
        }
        if($param === 'new'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }
            $value = $this->input->post('status');

            if(empty($value)){
                echo "FAIL::Status Value Must Be Entered";
                return NULL;
            }
			$color = $this->input->post('color');

            if(empty($color)){
                echo "FAIL::Color Value Must Be Entered";
                return NULL;
            }

            $insertData = array(
                'status' => $value,
				'color' => $color
            );

            $insertResult = $this->Common_model->insert_record('esic_status',$insertData);
            if($insertResult){
                echo "OK::Record Successfully Entered";
            }else{
                echo "FAIL::Record Failed Entered";
            }
            return NULL;
        }
        $this->show_admin('admin/configuration/status');
        return NULL;
 }else{
		 $this->load->view('admin/page_not_found'); 
	  }
    }
public function manage_appstatus($param = NULL){
  Admincontrol_helper::is_logged_in($this->session->userdata('userID'));  
  $userRole = $this->session->userdata('userRole');
  if($userRole == 1){	
		
        if($param === 'listing'){
            $selectData = array('
            id AS ID,
            CASE WHEN id = 2 THEN CONCAT("<span class=\'label label-danger\'> ", status," </span>") WHEN id = 1 THEN CONCAT ("<span class=\'label label-success\'> ", status, " </span>") ELSE CONCAT ("<span class=\'label label-warning\'> ", status, " </span>") END AS Status
            ',false);
            $addColumns = array(
                'ViewEditActionButtons' => array('<a href="#" data-target="#editStatusModal" data-toggle="modal"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','ID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'esic_appstatus','','','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }
        if($param === 'allvalues'){
            $returnedData = $this->Common_model->select('esic_appstatus');
            echo json_encode($returnedData);
            return NULL;
        }
        if($param === 'delete'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }
            $data='';
            if($value == 'delete'){

                $whereUpdate = array(
                    'id' => $id
                );

                $returnedData = $this->Common_model->delete('esic_appstatus',$whereUpdate);
                echo "OK::Record Deleted";
            }else{
                echo "FAIL::Record Not Deleted";
            }
            return NULL;
        }
        if($param === 'update'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('status');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $updateData = array(
                'status' => $value
            );

            $whereUpdate = array(
                'id' => $id
            );

            $updateResult = $this->Common_model->update('esic_appstatus',$whereUpdate,$updateData);
            if($updateResult === true){
                echo "OK::Record Successfully Updated";
            }else{
                if($updateResult['code'] == 0){
                    echo "OK::Record Already Exist";
                }else{
                    echo $updateResult['message'];
                }
            }
            return NULL;
        }
        if($param === 'new'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }
            $value = $this->input->post('status');

            if(empty($value)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $insertData = array(
                'status' => $value
            );

            $insertResult = $this->Common_model->insert_record('esic_appstatus',$insertData);
            if($insertResult){
                echo "OK::Record Successfully Entered";
            }else{
                echo "FAIL::Record Failed Entered";
            }
            return NULL;
        }
        $this->show_admin('admin/configuration/appstatus');
        return NULL;
     }else{
		   $this->load->view('admin/page_not_found');
		 }
  
  
    }
public function manage_universities($param = NULL){
      
	 Admincontrol_helper::is_logged_in($this->session->userdata('userID'));  
	 $userRole = $this->session->userdata('userRole');
	 if($userRole == 1){
			
        if($param === 'listing'){


            $selectData = array('
            id AS ID,
            institution AS University,
            institutionLogo AS Logo,
			address AS Address,
                CASE WHEN AppStatus = 2 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-danger">No</span>\') WHEN AppStatus = 3 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">Lodged</span>\') WHEN AppStatus = 1 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">Yes</span>\') ELSE 
                CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">No</span>\') END AS ABR,
            CASE WHEN insertionType = 1 THEN CONCAT(\'<span data-target="#permanent-modal" data-toggle="modal" class="label label-danger">YES</span>\') WHEN insertionType = 2 THEN CONCAT(\'<span data-target="#permanent-modal" data-toggle="modal" class="label label-success">NO</span>\') ELSE "" END AS Permanent,
            CASE WHEN trashed = 1 THEN CONCAT(\'<span class="label label-danger">YES</span>\') WHEN trashed = 0 THEN CONCAT(\'<span class="label label-success">NO</span>\') ELSE "" END AS Trashed
            ',false);
            $addColumns = array(
                'ViewEditActionButtons' => array('<a href="#" data-target="#editUniversitiesModal" data-toggle="modal"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','ID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'esic_institution','','','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }
        if($param === 'trash'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }
            $data='';
            if($value == 'trash'){
                $data = 1;
            }else if($value == 'untrash'){
                $data = 0;
            }else{
                $data = 2;
            }

            $updateData = array(
                'trashed' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_institution',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'delete'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }
            $data='';
            if($value == 'delete'){

                $whereUpdate = array(
                    'id' => $id
                );

                $returnedData = $this->Common_model->delete('esic_institution',$whereUpdate);
                echo "OK::Record Deleted";
            }else{
                echo "FAIL::Record Not Deleted";
            }
            return NULL;
        }
        if($param === 'update'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('University');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $updateData = array(
                'institution' => $value,
                'insertionType' => 1
            );

            $whereUpdate = array(
                'id' => $id
            );

            $updateResult = $this->Common_model->update('esic_institution',$whereUpdate,$updateData);
            if($updateResult === true){
                echo "OK::Record Successfully Updated";
            }else{
                if($updateResult['code'] == 0){
                    echo "OK::Record Already Exist";
                }else{
                    echo $updateResult['message'];
                }
            }
            return NULL;
        }
        if($param === 'permanent'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id)){
                echo "FAIL::Posted values are not VALID 1";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID 2";
                return NULL;
            }
            $data='';
            if($value == 'Permanent'){
                $data = 1;
            }else if($value == 'noPermanent'){
                $data = 2;
            }else{
                $data = 0;
            }

            $updateData = array(
                'insertionType' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_institution',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "OK::FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'abr'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id)){
                echo "FAIL::Posted values are not VALID 1";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID 2";
                return NULL;
            }
            $data=$value;
            $updateData = array(
                'AppStatus' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_institution',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "OK::FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'new'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }
            $value = $this->input->post('University');

            if(empty($value)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $insertData = array(
                'institution' => $value,
                'insertionType' => 1
            );

            $insertResult = $this->Common_model->insert_record('esic_institution',$insertData);
            if($insertResult){
                echo "OK::Record Successfully Entered";
            }else{
                echo "FAIL::Record Failed Entered";
            }
            return NULL;
        }
        if($param === 'updateLogo'){
            $uniID = $this->input->post('id');
            $allowedExt = array('jpeg','jpg','png','gif');
            $uploadPath = './pictures/logos/';
            $uploadDirectory = './pictures/logos/';
            $uploadDBPath = 'pictures/logos/';
            $insertDataArray = array();
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

                    $FileName = "uniLogo".$uniID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['logo']['tmp_name'],$uploadPath.$FileName);
                    $insertDataArray['institutionLogo'] = $uploadDBPath.$FileName;
                }
            }else{
                echo "FAIL::Logo Image Is Required";
                return;
            }

            if(empty($uniID)){
                echo "FAIL::Something went wrong with the Post, Please Contact System Administrator For Further Assistance.";
                exit;
            }
            $selectData = array('institutionLogo AS logo',false);
            $where = array(
                'id' => $uniID
            );
            $returnedData = $this->Common_model->select_fields_where('esic_institution',$selectData, $where, false, '', '', '','','',false);
            $logo = $returnedData[0]->logo;
            if(!empty($logo) && is_file(FCPATH.'/'.$logo)){
                unlink('./'.$logo);
            }
            $resultUpdate = $this->Common_model->update('esic_institution',$where,$insertDataArray);
            if($resultUpdate === true){
                echo "OK::Record Updated Successfully";
            }else{
                echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
            }
            return NULL;
        }
        $this->show_admin('admin/configuration/universities');
        return NULL;
	 }
	 else{
		 $this->load->view('admin/page_not_found');
		 }
    }
public function manage_sectors($param = NULL){
	Admincontrol_helper::is_logged_in($this->session->userdata('userID'));  
	$userRole = $this->session->userdata('userRole');
	if($userRole == 1){
        if($param === 'listing'){
            $selectData = array('
            id AS ID,
            sector AS Sector,
            CASE WHEN AppStatus = 2 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-danger">No</span>\') WHEN AppStatus = 3 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">Lodged</span>\') WHEN AppStatus = 1 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">Yes</span>\') ELSE 
                CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">No</span>\') END AS ABR,
            CASE WHEN insertionType = 1 THEN CONCAT(\'<span data-target="#permanent-modal" data-toggle="modal" class="label label-danger">YES</span>\') WHEN insertionType = 2 THEN CONCAT(\'<span data-target="#permanent-modal" data-toggle="modal" class="label label-success">NO</span>\') ELSE "" END AS Permanent,
            CASE WHEN trashed = 1 THEN CONCAT(\'<span class="label label-danger">YES</span>\') WHEN trashed = 0 THEN CONCAT(\'<span class="label label-success">NO</span>\') ELSE "" END AS Trashed
            ',false);

            $addColumns = array(
                'ViewEditActionButtons' => array('<a href="#" data-target="#editSectorModal" data-toggle="modal"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','UserID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'esic_sectors','','','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }
        if($param === 'trash'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }
            $data='';
            if($value == 'trash'){
                $data = 1;
            }else if($value == 'untrash'){
                $data = 0;
            }else{
                $data = 2;
            }

            $updateData = array(
                'trashed' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_sectors',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "OK::FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'update'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('sector');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $updateData = array(
                'sector' => $value,
                'insertionType' => 1
            );

            $whereUpdate = array(
                'id' => $id
            );

            $updateResult = $this->Common_model->update('esic_sectors',$whereUpdate,$updateData);
            if($updateResult === true){
                echo "OK::Record Successfully Updated";
            }else{
                if($updateResult['code'] == 0){
                    echo "OK::Record Already Exist";
                }else{
                    echo $updateResult['message'];
                }
            }
            return NULL;
        }
        if($param === 'delete'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }
            $data='';
            if($value == 'delete'){

                $whereUpdate = array(
                    'id' => $id
                );

                $returnedData = $this->Common_model->delete('esic_sectors',$whereUpdate);
                echo "OK::Record Deleted";
            }else{
                echo "FAIL::Record Not Deleted";
            }
            return NULL;
        }
        if($param === 'permanent'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id)){
                echo "FAIL::Posted values are not VALID 1";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID 2";
                return NULL;
            }
            $data='';
            if($value == 'Permanent'){
                $data = 1;
            }else if($value == 'noPermanent'){
                $data = 2;
            }else{
                $data = 0;
            }

            $updateData = array(
                'insertionType' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_sectors',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "OK::FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'abr'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id)){
                echo "FAIL::Posted values are not VALID 1";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID 2";
                return NULL;
            }
            $data=$value;
            $updateData = array(
                'AppStatus' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_sectors',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "OK::FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'new'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }
            $value = $this->input->post('sector');

            if(empty($value)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $insertData = array(
                'sector' => $value,
                'insertionType' => 1
            );

            $insertResult = $this->Common_model->insert_record('esic_sectors',$insertData);
            if($insertResult){
                echo "OK::Record Successfully Entered";
            }else{
                echo "FAIL::Record Failed Entered";
            }
            return NULL;
        }
        $this->show_admin('admin/configuration/sectors');
        return NULL;
	}else{
		 $this->load->view('admin/page_not_found');
		 }

    }
    //R&D
public function manage_rd($param = NULL){
  Admincontrol_helper::is_logged_in($this->session->userdata('userID')); 
  $userRole = $this->session->userdata('userRole');
  if($userRole == 1){ 
        if($param === 'listing'){
            $selectData = array('
            id AS ID,
            rndname AS rndname,
            IDNumber AS IDNumber,
            AddressContact AS AddressContact,
            ANZSRC AS ANZSRC,
            rndLogo AS Logo,
            CASE WHEN AppStatus = 2 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-danger">No</span>\') WHEN AppStatus = 3 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">Lodged</span>\') WHEN AppStatus = 1 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">Yes</span>\') ELSE 
                CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">No</span>\') END AS ABR,
            CASE WHEN insertionType = 1 THEN CONCAT(\'<span data-target="#permanent-modal" data-toggle="modal" class="label label-danger">YES</span>\') WHEN insertionType = 2 THEN CONCAT(\'<span data-target="#permanent-modal" data-toggle="modal" class="label label-success">NO</span>\') ELSE "" END AS Permanent,
            CASE WHEN trashed = 1 THEN CONCAT(\'<span class="label label-danger">YES</span>\') WHEN trashed = 0 THEN CONCAT(\'<span class="label label-success">NO</span>\') ELSE "" END AS Trashed
            ',false);

            $addColumns = array(
                'ViewEditActionButtons' => array('<a href="#" data-target="#editRndModal" data-toggle="modal"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','UserID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'esic_rnd','','','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }
        if($param === 'update'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id             = $this->input->post('id');
            $rndname        = $this->input->post('rndname');
            $IDNumber       = $this->input->post('IDNumber');
            $AddressContact = $this->input->post('AddressContact');
            $ANZSRC         = $this->input->post('ANZSRC');

            if(empty($rndname) && empty($id)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $updateData = array(
                'rndname'        => $rndname,
                'IDNumber'      => $IDNumber,
                'AddressContact'=> $AddressContact,
                'ANZSRC'        => $ANZSRC,
                'insertionType' => 1
            );

            $whereUpdate = array(
                'id' => $id
            );

            $updateResult = $this->Common_model->update('esic_rnd',$whereUpdate,$updateData);
            if($updateResult === true){
                echo "OK::Record Successfully Updated";
            }else{
                if($updateResult['code'] == 0){
                    echo "OK::Record Already Exist";
                }else{
                    echo $updateResult['message'];
                }
            }
            return NULL;
        }
        if($param === 'trash'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }
            $data='';
            if($value == 'trash'){
                $data = 1;
            }else if($value == 'untrash'){
                $data = 0;
            }else{
                $data = 2;
            }

            $updateData = array(
                'trashed' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_rnd',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'permanent'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id)){
                echo "FAIL::Posted values are not VALID 1";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID 2";
                return NULL;
            }
            $data='';
            if($value == 'Permanent'){
                $data = 1;
            }else if($value == 'noPermanent'){
                $data = 2;
            }else{
                $data = 0;
            }

            $updateData = array(
                'insertionType' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_rnd',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "OK::FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'abr'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id)){
                echo "FAIL::Posted values are not VALID 1";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID 2";
                return NULL;
            }
            $data=$value;
            $updateData = array(
                'AppStatus' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_rnd',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "OK::FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'delete'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }
            $data='';
            if($value == 'delete'){

                $whereUpdate = array(
                    'id' => $id
                );

                $returnedData = $this->Common_model->delete('esic_rnd',$whereUpdate);
                echo "OK::Record Deleted";
            }else{
                echo "FAIL::Record Not Deleted";
            }
            return NULL;
        }
        if($param === 'new'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }
            $rndname        = $this->input->post('Rnd');
            $IDNumber       = $this->input->post('IDNumber');
            $AddressContact = $this->input->post('AddressContact');
            $ANZSRC         = $this->input->post('ANZSRC');

            if(empty($rndname)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $insertData = array(
                'rndname'       => $rndname,
                'IDNumber'      => $IDNumber,
                'AddressContact'=> $AddressContact,
                'ANZSRC'        => $ANZSRC,
                'insertionType' => 1
            );

            $insertResult = $this->Common_model->insert_record('esic_rnd',$insertData);
            echo "OK::Record Successfully Entered";
            return NULL;
        }
        if($param === 'updateLogo'){
            $accID = $this->input->post('id');
            $allowedExt = array('jpeg','jpg','png','gif');
            $uploadPath = './pictures/logos/';
            $uploadDirectory = './pictures/logos/';
            $uploadDBPath = 'pictures/logos/';
            $insertDataArray = array();
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

                    $FileName = "rndLogo".$accID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['logo']['tmp_name'],$uploadPath.$FileName);
                    $insertDataArray['rndLogo'] = $uploadDBPath.$FileName;
                }
            }else{
                echo "FAIL::Logo Image Is Required";
                return;
            }

            if(empty($accID)){
                echo "FAIL::Something went wrong with the Post, Please Contact System Administrator For Further Assistance.";
                exit;
            }
            $selectData = array('rndLogo AS logo',false);
            $where = array(
                'id' => $accID
            );
            $returnedData = $this->Common_model->select_fields_where('esic_rnd',$selectData, $where, false, '', '', '','','',false);
            $logo = $returnedData[0]->logo;
            if(!empty($logo) && is_file(FCPATH.'/'.$logo)){
                unlink('./'.$logo);
            }
            $resultUpdate = $this->Common_model->update('esic_rnd',$where,$insertDataArray);
            // if($resultUpdate === true){
            echo "OK::Record Updated Successfully";
            //}else{
            //    echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
            //}
            return NULL;
        }
        $this->show_admin('admin/configuration/rd');
        return NULL;
  }
  else{
	   $this->load->view('admin/page_not_found');
	  }
}

public function manage_acc_commercials($param= Null){
   Admincontrol_helper::is_logged_in($this->session->userdata('userID'));
   $userRole = $this->session->userdata('userRole');
   if($userRole == 1){
			  
        if($param === 'listing'){
            $selectData = array('
            id AS ID,
            Member AS Member,
			Project_Location AS Project_Location,
            Web_Address AS Web_Address,
            State_Territory AS State_Territory,
            Project_Location AS Project_Location,
            Project_Title AS Project_Title,
            Project_Summary AS Project_Summary,
            Project_Success AS Project_Success,
            Market AS Market,
            Technology AS Technology,
            accLogo AS Logo,
            Type AS Type,
            CASE WHEN AppStatus = 2 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-danger">No</span>\') WHEN AppStatus = 3 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">Lodged</span>\') WHEN AppStatus = 1 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">Yes</span>\') ELSE 
                CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">No</span>\') END AS ABR,
            CASE WHEN insertionType = 1 THEN CONCAT(\'<span data-target="#permanent-modal" data-toggle="modal" class="label label-danger">YES</span>\') WHEN insertionType = 2 THEN CONCAT(\'<span data-target="#permanent-modal" data-toggle="modal" class="label label-success">NO</span>\') ELSE "" END AS Permanent,
            CASE WHEN trashed = 1 THEN CONCAT(\'<span class="label label-danger">YES</span>\') WHEN trashed = 0 THEN CONCAT(\'<span class="label label-success">NO</span>\') ELSE "" END AS Trashed
            ',false);

            $addColumns = array(
                'ViewEditActionButtons' => array('<a href="#" data-target="#editAccelerationModal" data-toggle="modal"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','UserID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'esic_acceleration','','','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }
        if($param === 'delete'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }
            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }
            if($value=='permanentDelete'){
                $whereUpdate = array(
                    'id' => $id
                );
                $this->Common_model->delete('esic_acceleration',$whereUpdate);
                echo "OK::Record Deleted Successfully";
            }else{

                $updateData = array(
                    'trashed' => 1
                );

                $whereUpdate = array(
                    'id' => $id
                );

                $returnedData = $this->Common_model->update('esic_acceleration',$whereUpdate,$updateData);
                // if($returnedData === true){
                echo "OK::Record Successfully Trashed";
                // }else{
                echo "FAIL::".$returnedData['message'];
                // }
            }
            return NULL;
        }
        if($param === 'trash'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }
            $data='';
            if($value == 'trash'){
                $data = 1;
            }else if($value == 'untrash'){
                $data = 0;
            }else{
                $data = 2;
            }

            $updateData = array(
                'trashed' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_acceleration',$whereUpdate,$updateData);
            //if($returnedData === true){
            echo "OK::Record Successfully";
            //}else{
            // echo "FAIL::".$returnedData['message'];
            // }
            return NULL;
        }
        if($param === 'permanent'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id)){
                echo "FAIL::Posted values are not VALID 1";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID 2";
                return NULL;
            }
            $data='';
            if($value == 'Permanent'){
                $data = 1;
            }else if($value == 'noPermanent'){
                $data = 2;
            }else{
                $data = 0;
            }

            $updateData = array(
                'insertionType' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_acceleration',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "OK::FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'abr'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id)){
                echo "FAIL::Posted values are not VALID 1";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID 2";
                return NULL;
            }
            $data=$value;
            $updateData = array(
                'AppStatus' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_acceleration',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "OK::FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'update'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id                 = $this->input->post('id');
            $Member             = $this->input->post('Member');
            $Web_Address        = $this->input->post('webaddress');
            //$State_Territory    = $this->input->post('State_Territory');
            //$Project_Location   = $this->input->post('Project_Location');
            $Project_Title      = $this->input->post('projecttitle');
            //$Project_Summary    = $this->input->post('Project_Summary');
            //$Project_Success    = $this->input->post('Project_Success');
            //$Market             = $this->input->post('Market');
            //$Technology         = $this->input->post('Technology');
            //$Type               = $this->input->post('Type');*/

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($Member)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $updateData = array(
                'Member'            => $Member,
                'Web_Address'       => $Web_Address,
                //'State_Territory'   => $State_Territory,
                //'Project_Location'  => $Project_Location,
                'Project_Title'     => $Project_Title,
                //'Project_Summary'   => $Project_Summary,
                //'Project_Success'   => $Project_Success,
                //'Market'            => $Market,
                //'Technology'        => $Technology,
                //'Type'              => $Type,
                'insertionType' => 1
            );

            $whereUpdate = array(
                'id' => $id
            );

            $updateResult = $this->Common_model->update('esic_acceleration',$whereUpdate,$updateData);
            // if($updateResult === true){
            echo "OK::Record Successfully Updated";
            /* }else{
                 if($updateResult['code'] == 0){
                     echo "OK::Record Already Exist";
                 }else{
                     echo $updateResult['message'];
                 }
             }*/
            return NULL;
        }
        if($param === 'updateLogo'){
            $accID = $this->input->post('id');
            $allowedExt = array('jpeg','jpg','png','gif');
            $uploadPath = './pictures/logos/';
            $uploadDirectory = './pictures/logos/';
            $uploadDBPath = 'pictures/logos/';
            $insertDataArray = array();
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

                    $FileName = "accLogo".$accID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['logo']['tmp_name'],$uploadPath.$FileName);
                    $insertDataArray['accLogo'] = $uploadDBPath.$FileName;
                }
            }else{
                echo "FAIL::Logo Image Is Required";
                return;
            }

            if(empty($accID)){
                echo "FAIL::Something went wrong with the Post, Please Contact System Administrator For Further Assistance.";
                exit;
            }
            $selectData = array('accLogo AS logo',false);
            $where = array(
                'id' => $accID
            );
            $returnedData = $this->Common_model->select_fields_where('esic_acceleration',$selectData, $where, false, '', '', '','','',false);
            $logo = $returnedData[0]->logo;
            if(!empty($logo) && is_file(FCPATH.'/'.$logo)){
                unlink('./'.$logo);
            }
            $resultUpdate = $this->Common_model->update('esic_acceleration',$where,$insertDataArray);
            if($resultUpdate === true){
                echo "OK::Record Updated Successfully";
            }else{
                echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
            }
            return NULL;
        }
        if($param === 'new'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }
            $value  = $this->input->post('Acceleration');
            $WA     = $this->input->post('webaddress');
            $PT     = $this->input->post('projecttitle');

            if(empty($value)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $insertData = array(
                'Member' => $value,
                'Web_Address' => $WA,
                'Project_Title' => $PT,
                'insertionType' => 1
            );

            $insertResult = $this->Common_model->insert_record('esic_acceleration',$insertData);
            //if($insertResult){
            echo "OK::Record Successfully Entered";
            //}else{
            //echo "FAIL::Record Failed Entered";
            //}
            return NULL;
        }
        $this->show_admin('admin/configuration/acc_commercials');
        return NULL;
    }
	else{
		$this->load->view('admin/page_not_found');
		}
}
public function manage_accelerators($param= Null){
  Admincontrol_helper::is_logged_in($this->session->userdata('userID'));  
  $userRole = $this->session->userdata('userRole');
  if($userRole == 1){		
		
        if($param === 'listing'){
            $selectData = array('
            id AS ID,
            name AS Name,
			address AS Address,
            website AS Website,
            logo AS Logo,
            CASE WHEN AppStatus = 2 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-danger">No</span>\') WHEN AppStatus = 3 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">Lodged</span>\') WHEN AppStatus = 1 THEN CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">Yes</span>\') ELSE 
                CONCAT(\'<span data-target="#abr-modal" data-toggle="modal" class="label label-success">No</span>\') END AS ABR,
            CASE WHEN insertionType = 1 THEN CONCAT(\'<span data-target="#permanent-modal" data-toggle="modal" class="label label-danger">YES</span>\') WHEN insertionType = 2 THEN CONCAT(\'<span data-target="#permanent-modal" data-toggle="modal" class="label label-success">NO</span>\') ELSE "" END AS Permanent,
            CASE WHEN trashed = 1 THEN CONCAT(\'<span class="label label-danger">YES</span>\') WHEN trashed = 0 THEN CONCAT(\'<span class="label label-success">NO</span>\') ELSE "" END AS Trashed
            ',false);

            $addColumns = array(
                'ViewEditActionButtons' => array('<a href="#" data-target="#editAccelerationModal" data-toggle="modal"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','UserID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'esic_acceleration_logo','','','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }
        if($param === 'delete'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            //if(empty($value) or $value !== 'approve'){
            //echo "FAIL::Posted values are not VALID";
            //return NULL;
            //  }
            if($value=='permanentDelete'){
                $whereUpdate = array(
                    'id' => $id
                );

                $this->Common_model->delete('esic_acceleration_logo',$whereUpdate);
                echo "OK::Record Deleted Successfully";
            }else{

                $updateData = array(
                    'trashed' => 1
                );

                $whereUpdate = array(
                    'id' => $id
                );

                $returnedData = $this->Common_model->update('esic_acceleration_logo',$whereUpdate,$updateData);
                if($returnedData === true){
                    echo "OK::Record Successfully Trashed";
                }else{
                    echo "FAIL::".$returnedData['message'];
                }
            }
            return NULL;
        }
        if($param === 'trash'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }
            $data='';
            if($value == 'trash'){
                $data = 1;
            }else if($value == 'untrash'){
                $data = 0;
            }else{
                $data = 2;
            }

            $updateData = array(
                'trashed' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_acceleration_logo',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'permanent'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id)){
                echo "FAIL::Posted values are not VALID 1";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID 2";
                return NULL;
            }
            $data='';
            if($value == 'Permanent'){
                $data = 1;
            }else if($value == 'noPermanent'){
                $data = 2;
            }else{
                $data = 0;
            }

            $updateData = array(
                'insertionType' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_acceleration_logo',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "OK::FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'update'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id   = $this->input->post('id');
            $name = $this->input->post('name');
            $Web  = $this->input->post('web');
            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($name)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $updateData = array(
                'name'    => $name,
                'website' => $Web,
                'insertionType' => 1
            );

            $whereUpdate = array(
                'id' => $id
            );

            $updateResult = $this->Common_model->update('esic_acceleration_logo',$whereUpdate,$updateData);
            if($updateResult === true){
                echo "OK::Record Successfully Updated";
            }else{
                if($updateResult['code'] == 0){
                    echo "OK::Record Already Exist::".$updateResult['message'];
                }else{
                    echo $updateResult['message'];
                }
            }
            return NULL;
        }
        if($param === 'abr'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

            if(empty($id)){
                echo "FAIL::Posted values are not VALID 1";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID 2";
                return NULL;
            }
            $data=$value;
            $updateData = array(
                'AppStatus' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_acceleration_logo',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::Record Successfully";
            }else{
                echo "OK::FAIL::".$returnedData['message'];
            }
            return NULL;
        }
        if($param === 'new'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }
            $value = $this->input->post('Acceleration');

            if(empty($value)){
                echo "FAIL::Value Must Be Entered";
                return NULL;
            }

            $insertData = array(
                'name' => $value,
                'insertionType' => 1
            );

            $insertResult = $this->Common_model->insert_record('esic_acceleration_logo',$insertData);
            if($insertResult){
                echo "OK::Record Successfully Entered";
            }else{
                echo "FAIL::Record Failed Entered";
            }
            return NULL;
        }
        if($param === 'updateLogo'){
            $accID = $this->input->post('id');
            $allowedExt = array('jpeg','jpg','png','gif');
            $uploadPath = './pictures/logos/';
            $uploadDirectory = './pictures/logos/';
            $uploadDBPath = 'pictures/logos/';
            $insertDataArray = array();
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

                    $FileName = "accLogo".$accID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['logo']['tmp_name'],$uploadPath.$FileName);
                    $insertDataArray['logo'] = $uploadDBPath.$FileName;
                }
            }else{
                echo "FAIL::Logo Image Is Required";
                return;
            }

            if(empty($accID)){
                echo "FAIL::Something went wrong with the Post, Please Contact System Administrator For Further Assistance.";
                exit;
            }
            $selectData = array('logo AS logo',false);
            $where = array(
                'id' => $accID
            );
            $returnedData = $this->Common_model->select_fields_where('esic_acceleration_logo',$selectData, $where, false, '', '', '','','',false);
            $logo = $returnedData[0]->logo;
            if(!empty($logo) && is_file(FCPATH.'/'.$logo)){
                unlink('./'.$logo);
            }
            $resultUpdate = $this->Common_model->update('esic_acceleration_logo',$where,$insertDataArray);
            if($resultUpdate === true){
                echo "OK::Record Updated Successfully";
            }else{
                echo "FAIL::Something went wrong during Update, Please Contact System Administrator";
            }
            return NULL;
        }
        $this->show_admin('admin/configuration/accelerators');
        return NULL;
    } else{
		   $this->load->view('admin/page_not_found');
		  } 
}
    //Show or HIde Exp Date for the Front.
    public function showExpDate(){
        $update = $this->input->post('expDate');
        $userID = $this->input->post('userID');

        if($update === 'show'){
            $showExpDate = 1;
        }else{
            $showExpDate = 0;
        }
        $whereUpdate = array(
            'id' =>  $userID
        );
        $updateData = array(
            'showExpDate' => $showExpDate
        );

        $updateResult = $this->Common_model->update('user',$whereUpdate,$updateData);

        if($updateResult === true){
            echo "OK::Successfully Updated";
        }else{
            echo "FAIL::".$updateResult['message'];
        }

        var_dump($updateResult);

        echo $this->db->last_query();

    }
public function  UpDateSocials(){ 
              $id        = $this->input->post('id');
			  $facebook  = $this->input->post('facebook');
			  $twitter   = $this->input->post('twitter');
		      $google    = $this->input->post('google');
			  $linkedIn  = $this->input->post('linkedIn');
			  $instagram  = $this->input->post('instagram');
			  
			  $data     = array(
						  'facebook' => $facebook,
						  'twitter'  => $twitter,
						  'google'   => $google,
						  'linked_in' => $linkedIn,
						  'instagram'=> $instagram 
						 );
			 $data2     = array(
			              'Fk_userID'=> $id,
						  'facebook' => $facebook,
						  'twitter'  => $twitter,
						  'google'   => $google,
						  'linked_in' => $linkedIn,
						  'instagram'=> $instagram 
						 );			 
			 			 
		    $ok       = $this->Esic_model->update_social($id,$data,$data2);
		    echo $ok;  
		}		
	//for manage assessment user profile
    public function manage_profile($list=NULL){
        Admincontrol_helper::is_logged_in($this->session->userdata('userID'));
        $userID = $this->session->userdata('userID');
          if($list === 'listing'){
          $selectData = array('
            h_user.userID as UserID,
			CONCAT(`h_user`.`firstName`," ",`h_user`.`lastName`) AS FullName,
            h_user.email AS Email,
			company AS Company,
            ES.id as StatusID, 
            CASE WHEN user_draft.Publish = 1 THEN CONCAT("<span class=\'label status label-success pub\'> Published </span>") WHEN user_draft.Publish = 0 THEN CONCAT ("<span class=\'label status label-danger\'>Draft</span>") ELSE CONCAT ("<span class=\'label status label-warning\'> ", Publish, " </span>") END AS  Publish,
            ES.color AS color,
             CASE WHEN ES.id > 0 THEN CONCAT("<span class=\'label \' style=\' background-color:",color,"\'> ", ES.status," </span>") ELSE CONCAT ("<span class=\'label label-warning\'> ", ES.status, " </span>") END AS Status 
            ',false);

                $joins = array(
                  array(
                      'table' 	=> 'esic_status ES',
                      'condition' => 'ES.id = user_draft.status',
                      'type' 		=> 'LEFT'
                  ),
                  array(
                      'table' 	=> 'hoosk_user h_user',
                      'condition' => 'h_user.userID = user_draft.userID',
                      'type' 		=> 'LEFT'
                  )
                );

                $where = array(

                    "h_user.userID" => $userID
                );
                $addColumns = array(
                    'ViewEditActionButtons' => array('<a href="'.base_url("admin/details/$1").'"><span aria-hidden="true" class="glyphicon glyphicon-edit text-green "></span></a> &nbsp; <a href="#" data-target=".change-status" data-toggle="modal"><i data-toggle="tooltip" title="Publish" data-placement="left" class="fa fa-check ml-fa"></i></a> &nbsp; <a href="#" data-target=".delete-modal" data-toggle="modal"><i class="fa fa-trash-o"></i></a>','UserID')
                );
                $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'user_draft',$joins,$where,'','','',$addColumns);
                print_r($returnedData);
                return NULL;
            }

            $data['title'] = 'Pre-assessment List';
            $this->show_admin("admin/manage_profile",$data);

    }
public function publish_assessment_list(){

    $id = $this->input->post('id');
    $this->Common_model->publish_assessment_list($id);

    echo "OK::Your Profile is successfully published";

}



    public function fb(){
        $data['user'] = array();

        // Check if user is logged in
        if ($this->facebook->is_authenticated())
        {

            $user = $this->facebook->request('get', '/me?fields=id,name,email,gender,first_name,last_name,locale,timezone,location');

           $id          = $user['id'];
           $first_name  = $user['first_name'];
           $lastname    = $user['last_name'];
           $email       = $user['email'];

             

            $result=$this->Hoosk_model->facebook_login($email);
            if($result) {
                redirect('/admin', 'refresh');
            }
            else
            {
                $this->data['error'] = "1";
                $this->login();
            }
        }
    }
}