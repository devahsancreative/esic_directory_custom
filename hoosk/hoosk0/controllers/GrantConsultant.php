<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class GrantConsultant extends MY_Controller {
    
    private $CurrentID = 0;

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
        define ('THEME', $this->Hoosk_model->getTheme());
        define ('THEME_FOLDER', BASE_URL.'/theme/'.THEME);

        $this->load->model("Common_model");
        $this->load->model("Imagecreate_model");
        $this->load->helper('cookie');
        $this->load->library('resize');

        $url = str_replace($_SERVER["HTTP_HOST"], '', BASE_URL);
        $url = $_SERVER["DOCUMENT_ROOT"].''.$url;
        $url = str_replace('http://', '', $url);
        $url = str_replace('https://', '', $url);
        define ('DoucmentUrl', $url);


    }
    public function ManageGrantConsultant($param=NULL){
        Admincontrol_helper::is_logged_in($this->session->userdata('userID'));
        $userRole = $this->session->userdata('userRole');
        //We Don't want un authorized access
        if($userRole != 1){
            $this->load->view('admin/page_not_found');
            return false;
        }

        //Now see if the param is of listing
        if($param === 'listing'){
            $selectData = array('
            id AS ID,
            name AS Name,
            phone AS Phone,
            website AS Website,
            email AS Email,
            address AS Address,
            logo AS Logo,
            CASE WHEN trashed = 1 THEN CONCAT(\'<span class="label label-danger">YES</span>\') WHEN trashed = 0 THEN CONCAT(\'<span class="label label-success">NO</span>\') ELSE "" END AS Trashed
            ',false);

            $addColumns = array(
                'ViewEditActionButtons' => array(
                    '<a href="'.base_url().'GrantConsultant/Edit/$1"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','ID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'esic_grantconsultant','','','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }
        if($param === 'new'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            //Getting Values Now
            //Required Ones
            $Name 	= $this->input->post('Name');
            //Currently Keeping them Optional
            $Phone 	= $this->input->post('Phone');
            $Email 	= $this->input->post('Email');
            $Website 	= $this->input->post('Website');

            if(empty($Name)){
                echo "FAIL::Grant Consultant Name is Required.";
                return NULL;
            }elseif(!is_string($Name)){
                echo "FAIL::Grant Consultant Name must be a valid string.";
                return NULL;
            }

            $insertData = array(
                'name' 		=> $Name,
                'phone' 	=> $Phone,
                'email'     => $Email,
                'website' 	=> $Website,
                'trashed' 	=> 0
            );

            $insertResult = $this->Common_model->insert_record('esic_grantconsultant',$insertData);
            if($insertResult){
                echo "OK::New Record Successfully Added::success";
            }else{
                echo "FAIL::New Record Could Not Be Added::error";
            }
            return NULL;
        }
        if($param === 'trash'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted::error";
                return false;
            }

            $id 	= $this->input->post('id');
            $value 	= $this->input->post('value');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID::error::Invalid POST Values";
                return NULL;
            }

            if(empty($value)){
                echo "FAIL::Posted values are not VALID::error::Invalid POST Values";
                return NULL;
            }
            $data='';
            if($value == 'trash'){
                $data = 1;
                $trashedMessageSuccess = "Record has been successfully Trashed";
                $trashedMessageDuplicate = "Record Has Already Been Trashed";
            }else if($value == 'untrash'){
                $data = 0;
                $trashedMessageSuccess = "Record has been successfully Un-Trashed";
                $trashedMessageDuplicate = "Record Has Already Been Un-Trashed";
            }else{
                $data = 2;
                $trashedMessageSuccess = "Record has been successfully Processed";
            }

            $updateData = array(
                'trashed' => $data
            );

            $whereUpdate = array(
                'id' => $id
            );

            $returnedData = $this->Common_model->update('esic_grantconsultant',$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK::".$trashedMessageSuccess."::success::SUCCESS!!";
            }else{
                if($returnedData['code'] === 0){
                    echo "OK::".$trashedMessageDuplicate."::warning::QUERY FAILED";
                    return false;
                }else{
                    echo "FAIL::".$returnedData['message']."::error::DB Message";
                }

            }
            return NULL;
        }
        if($param === 'update'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $NameUpdated 	= $this->input->post('Name');
            $PhoneUpdated 	= $this->input->post('Phone');
            $EmailUpdated 	= $this->input->post('Email');
            $WebsiteUpdated = $this->input->post('Website');

            if(empty($id) or !is_numeric($id)){
                echo "FAIL::Posted values are not VALID";
                return NULL;
            }

            if(empty($NameUpdated)){
                echo "FAIL::Grant Consultant name is a required field::error::Required!!";
                return NULL;
            }

            $updateData = array(
                'name' 		=> $NameUpdated,
                'phone' 	=> $PhoneUpdated,
                'email'     =>$EmailUpdated,
                'website'	=> $WebsiteUpdated
            );

            $whereUpdate = array(
                'id' => $id
            );

            $updateResult = $this->Common_model->update('esic_grantconsultant',$whereUpdate,$updateData);

            if($updateResult === true){
                echo "OK::Record Successfully Updated::success";
            }else{
                if($updateResult['code'] == 0){
                    echo "OK::Record Already Exist::warning";
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

                $returnedData = $this->Common_model->delete('esic_grantconsultant',$whereUpdate);
                echo "OK::Record Deleted";
            }else{
                echo "FAIL::Record Not Deleted";
            }
            return NULL;
        }
        if($param === 'updateLogo'){
            $ID = $this->input->post('id');
            $allowedExt 		= array('jpeg','jpg','png','gif');
			$uploadPath 		= './pictures/logos/grantconsultant';
            $uploadDirectory 	= './pictures/logos/grantconsultant';
            $uploadDBPath 		= 'pictures/logos/grantconsultant';
            $insertDataArray 	= array();
            //For Logo Upload
            if(isset($_FILES['logo']['name'])){
                $FileName 			= $_FILES['logo']['name'];
                $explodedFileName 	= explode('.',$FileName);
                $ext 				= end($explodedFileName);

                if(!in_array(strtolower($ext),$allowedExt)){
                    echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    return;
                }else{

                    $FileName = "grantConsultantLogo".$ID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['logo']['tmp_name'],$uploadPath.'/'.$FileName);
                    $insertDataArray['logo'] = $uploadDBPath.'/'.$FileName;
                }
            }else{
                echo "FAIL::Logo Image Is Required::error";
                return;
            }

            if(empty($ID)){
                echo "FAIL::Something went wrong with the Post, Please Contact System Administrator For Further Assistance.::error";
                exit;
            }
            	$selectData = array('logo AS logo',false);
            	$where = array( 'id' => $ID );
            	$returnedData = $this->Common_model->select_fields_where('esic_grantconsultant',$selectData, $where, false, '', '', '','','',false);
            	$logo = $returnedData[0]->logo;
            if(!empty($logo) && is_file(FCPATH.'/'.$logo)){
                unlink('./'.$logo);
            }
            	$resultUpdate = $this->Common_model->update('esic_grantconsultant',$where,$insertDataArray);
            if($resultUpdate === true){
                echo "OK::Record Updated Successfully::success";
            }else{
                echo "FAIL::Something went wrong during Update, Please Contact System Administrator::error";
            }
            return NULL;
        }

        //Default : Show the View if
        $this->show_admin('admin/configuration/grantconsultant/listing');
        return NULL;
    }
    public function Add(){      
        $this->show_admin('admin/configuration/grantconsultant/add');
        return NULL;
    }
    public function AddSave(){
        $data['return'] = $this->Save();
        $this->show_admin('admin/configuration/grantconsultant/listing' , $data);
        return Null;
    }
    public function Save(){
        $return = array();
        if(!$this->input->post()){
            $error = "FAIL::No Value Posted::error";
            array_push($return, $error);
            return $return;
        }

        $Name    = $this->input->post('Name');
        $Phone   = $this->input->post('Phone');
        $Email   = $this->input->post('Email');
        $Website = $this->input->post('Website');
        $Address = $this->input->post('Address');
        $ShortDescription = $this->input->post('ShortDescription');
        $LongDescription  = $this->input->post('LongDescription');
        $Keywords = $this->input->post('Keywords');

        if(empty($Name)){
            $error = "FAIL::Grant Consultant Name is a required field::error::Required!!";
            array_push($return, $error);
            return $return;
        }

        $insertData = array(
            'name'      => $Name,
            'phone'     => $Phone,
            'email'     => $Email,
            'website'   => $Website,
            'address'   => $Address,
            'short_description' => $ShortDescription,
            'long_description'  => $LongDescription,
            'keywords'  => $Keywords
        );
        $insertResult = $this->Common_model->insert_record('esic_grantconsultant',$insertData);

        if($insertResult){
            $success =  "OK::Record Successfully Added ID is ".$insertResult." ::success";
            array_push($return, $success);
        }else{
            $error =  "FAIL::Record Not Added::error";
            array_push($return, $error);
            return $return;
        }

        $allowedExt         = array('jpeg','jpg','png','gif');

        if(is_numeric($insertResult)){

            $uploadPath        = './pictures/logos/grantconsultant/'.$insertResult;
            $uploadDirectory   = './pictures/logos/grantconsultant/'.$insertResult;
            $uploadDBPath      = 'pictures/logos/grantconsultant/'.$insertResult;
            $insertDataArray   = array();
            //For Logo Upload
            $ID = $insertResult;
            if(isset($_FILES['Logoimage']['name']) && !empty($_FILES['Logoimage']['name'])){
                $FileName           = $_FILES['Logoimage']['name'];
                $explodedFileName   = explode('.',$FileName);
                $ext                = end($explodedFileName);

                if(!in_array(strtolower($ext),$allowedExt)){
                    $error =  "FAIL:: Logo -- Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    array_push($return, $error);
                }else{

                    $FileName = "grantConsultantLogo".$ID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['Logoimage']['tmp_name'],$uploadPath.'/'.$FileName);
                    $insertDataArray['logo'] = $uploadDBPath.'/'.$FileName;
                    $selectData = array('logo AS logo',false);
                    $where = array( 'id' => $insertResult );
                    $returnedData = $this->Common_model->select_fields_where('esic_grantconsultant',$selectData, $where, false, '', '', '','','',false);
                    $logo = $returnedData[0]->logo;


                    if(!empty($logo) && is_file(FCPATH.'/'.$logo)){
                        unlink('./'.$logo);
                    }

                    $resultUpdate = $this->Common_model->update('esic_grantconsultant',$where,$insertDataArray);
                    if($resultUpdate === true){
                        $success = "OK::Logo Uploaded::success";
                        array_push($return, $success);
                    }else{
                        $error = "FAIL::Logo -- Something went wrong during Update, Please Contact System Administrator::error";
                        array_push($return, $error);
                    }
                }

            }else{
                $error = "FAIL::Logo Image Not Provided::warning";
                array_push($return, $error);
            }
            $insertDataArray    = array();

            if(isset($_FILES['Bannerimage']['name']) && !empty($_FILES['Bannerimage']['name'])){
                $FileName           = $_FILES['Bannerimage']['name'];
                $explodedFileName   = explode('.',$FileName);
                $ext                = end($explodedFileName);

                if(!in_array(strtolower($ext),$allowedExt)){
                    $error =  "FAIL:: Banner -- Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    array_push($return, $error);
                }else{

                    $FileName = "grantConsultantBanner".$ID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['Bannerimage']['tmp_name'],$uploadPath.'/'.$FileName);
                    $insertDataArray['banner'] = $uploadDBPath.'/'.$FileName;

                    $selectData = array('banner AS banner',false);
                    $where = array( 'id' => $insertResult );
                    $returnedData = $this->Common_model->select_fields_where('esic_grantconsultant',$selectData, $where, false, '', '', '','','',false);
                    $banner = $returnedData[0]->banner;

                    if(!empty($banner) && is_file(FCPATH.'/'.$banner)){
                        unlink('./'.$banner);
                    }
                        $resultUpdate = $this->Common_model->update('esic_grantconsultant',$where,$insertDataArray);
                    if($resultUpdate === true){
                        $success = "OK::Banner Uploaded::success";
                        array_push($return, $success);
                    }else{
                        $error = "FAIL::Banner -- Something went wrong during Update, Please Contact System Administrator::error";
                        array_push($return, $error);
                    }
                }
            }else{
                $error = "FAIL::Banner Image Not Provided::warning";
                array_push($return, $error);
            }
        }
        return $return;

    }

    public function Edit($id){
        $data['id'] = $id;
        $this->CurrentID = $id;
        $where = array('id' => $id);
        $data['data'] = $this->Common_model->select_fields_where('esic_grantconsultant' ,'*' ,$where,true);
        $this->show_admin('admin/configuration/grantconsultant/edit',$data);
        return NULL;
    }
    public function EditSave(){
        $data['return'] = $this->EditSaved();
        $this->show_admin('admin/configuration/grantconsultant/listing' , $data);
        return Null;
    }
    public function EditSaved(){

        $return = array();
        if(!$this->input->post()){
            $error = "FAIL::No Value Posted::error";
            array_push($return, $error);
            return $return;
        }
        $ID = $this->input->post('id');
        if(empty($ID)){
            $error = "FAIL::No ID Set::error";
            array_push($return, $error);
            return $return;
        }
        $Name    = $this->input->post('Name');
        $Phone   = $this->input->post('Phone');
        $Email   = $this->input->post('Email');
        $Website = $this->input->post('Website');
        $Address = $this->input->post('Address');
        $ShortDescription = $this->input->post('ShortDescription');
        $LongDescription  = $this->input->post('LongDescription');
        $Keywords = $this->input->post('Keywords');

        if(empty($Name)){
            $error = "FAIL::Grant Consultant Name is a required field::error::Required!!";
            array_push($return, $error);
            return $return;
        }


        $updateData = array(
            'name'      => $Name,
            'phone'     => $Phone,
            'email'     => $Email,
            'website'   => $Website,
            'address'   => $Address,
            'short_description' => $ShortDescription,
            'long_description'  => $LongDescription,
            'keywords'  => $Keywords
        );
        $where = array('id' => $ID);
        $updateResult = $this->Common_model->update('esic_grantconsultant',$where , $updateData);
        
        if($updateResult){
            $success =  "OK::Record Successfully Updated ID is ".$ID." ::success";
            array_push($return, $success);
        }else{
            $error =  "FAIL::Record Not Updated::error";
            array_push($return, $error);
            return $return;
        }

        $allowedExt = array('jpeg','jpg','png','gif');

        if(is_numeric($ID)){

            $uploadPath        = './pictures/logos/grantconsultant/'.$ID;
            $uploadDirectory   = './pictures/logos/grantconsultant/'.$ID;
            $uploadDBPath      = 'pictures/logos/grantconsultant/'.$ID;
            $insertDataArray   = array();
            //For Logo Upload
            if(isset($_FILES['Logoimage']['name']) && !empty($_FILES['Logoimage']['name'])){
                $FileName           = $_FILES['Logoimage']['name'];
                $explodedFileName   = explode('.',$FileName);
                $ext                = end($explodedFileName);

                if(!in_array(strtolower($ext),$allowedExt)){
                    $error =  "FAIL:: Logo -- Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed Given ".$ext."::error";
                    array_push($return, $error);
                }else{

                    $FileName = "grantConsultantLogo".$ID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['Logoimage']['tmp_name'],$uploadPath.'/'.$FileName);
                    $insertDataArray['logo'] = $uploadDBPath.'/'.$FileName;
                    $selectData = array('logo AS logo',false);
                    $where = array( 'id' => $ID );
                    $returnedData = $this->Common_model->select_fields_where('esic_grantconsultant',$selectData, $where, false, '', '', '','','',false);
                    $logo = $returnedData[0]->logo;


                    if(!empty($logo) && is_file(FCPATH.'/'.$logo)){
                        unlink('./'.$logo);
                    }

                    $resultUpdate = $this->Common_model->update('esic_grantconsultant',$where,$insertDataArray);
                    if($resultUpdate === true){
                        $success = "OK::Logo Uploaded::success";
                        array_push($return, $success);
                    }else{
                        $error = "FAIL::Logo -- Something went wrong during Update, Please Contact System Administrator::error";
                        array_push($return, $error);
                    }
                }

            }
            /*else{
                $error = "FAIL::Logo Image Not Provided::warning";
                array_push($return, $error);
            }*/
            $insertDataArray    = array();

            if(isset($_FILES['Bannerimage']['name']) && !empty($_FILES['Bannerimage']['name'])){
                $FileName           = $_FILES['Bannerimage']['name'];
                $explodedFileName   = explode('.',$FileName);
                $ext                = end($explodedFileName);

                if(!in_array(strtolower($ext),$allowedExt)){
                    $error =  "FAIL:: Banner -- Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed Given ".$ext." ::error";
                    array_push($return, $error);
                }else{

                    $FileName = "grantConsultantBanner".$ID."_".time().".".$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['Bannerimage']['tmp_name'],$uploadPath.'/'.$FileName);
                    $insertDataArray['banner'] = $uploadDBPath.'/'.$FileName;

                    $selectData = array('banner AS banner',false);
                    $where = array( 'id' => $ID );
                    $returnedData = $this->Common_model->select_fields_where('esic_grantconsultant',$selectData, $where, false, '', '', '','','',false);
                    $banner = $returnedData[0]->banner;

                    if(!empty($banner) && is_file(FCPATH.'/'.$banner)){
                        unlink('./'.$banner);
                    }
                        $resultUpdate = $this->Common_model->update('esic_grantconsultant',$where,$insertDataArray);
                    if($resultUpdate === true){
                        $success = "OK::Banner Uploaded::success";
                        array_push($return, $success);
                    }else{
                        $error = "FAIL::Banner -- Something went wrong during Update, Please Contact System Administrator::error";
                        array_push($return, $error);
                    }
                }
            }
            /*else{
                $error = "FAIL::Banner Image Not Provided::warning";
                array_push($return, $error);
            }*/
        }
        return $return;
    }

}