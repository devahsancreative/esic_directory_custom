<?php 
	function viewHelperManage($param=NULL){
		$ci =& get_instance();
        $ci->load->model('Common_Model');
	
	    Admincontrol_helper::is_logged_in($ci->session->userdata('userID'));
        $userRole = $ci->session->userdata('userRole');
        //We Don't want un authorized access
        if($userRole != 1){
            $ci->load->view('admin/page_not_found');
            return false;
        }

        //Now see if the param is of listing
        if($param === 'listing'){
            $selectData = array('
            id AS ID,
            institution AS Name,
            phone AS Phone,
            website AS Website,
            email AS email, 
            institutionLogo AS Logo,
            CASE WHEN trashed = 1 THEN CONCAT(\'<span class="label label-danger">YES</span>\') WHEN trashed = 0 THEN CONCAT(\'<span class="label label-success">NO</span>\') ELSE "" END AS Trashed
            ',false);

            $addColumns = array(
                'ViewEditActionButtons' => array(
                    '<a href="'.base_url().$ci->Name.'/Edit/$1"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','ID')
            );
            $returnedData = $ci->Common_model->select_fields_joined_DT($selectData,$ci->tableName,'','','','','',$addColumns);
            print_r($returnedData);
            return NULL;
        }
        if($param === 'trash'){
            if(!$ci->input->post()){
                echo "FAIL::No Value Posted::error";
                return false;
            }

            $id     = $ci->input->post('id');
            $value  = $ci->input->post('value');

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

            $returnedData = $ci->Common_model->update($ci->tableName,$whereUpdate,$updateData);
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
        if($param === 'delete'){
            if(!$ci->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $ci->input->post('id');
            $value = $ci->input->post('value');

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

                $returnedData = $ci->Common_model->delete($ci->tableName,$whereUpdate);
                echo "OK::Record Deleted::success::";
            }else{
                echo "FAIL::Record Not Deleted::error::";
            }
            return NULL;
        }
        if($param === 'updateLogo'){
            $ID                 = $ci->input->post('id');
            $allowedExt         = array('jpeg','jpg','png','gif');
            $uploadPath         = './pictures/logos/'.$ci->ImagesFolderName;
            $uploadDirectory    = './pictures/logos/'.$ci->ImagesFolderName;
            $uploadDBPath       = 'pictures/logos/'.$ci->ImagesFolderName;
            $insertDataArray    = array();
            //For Logo Upload
            if(isset($_FILES['logo']['name'])){
                $FileName           = $_FILES['logo']['name'];
                $explodedFileName   = explode('.',$FileName);
                $ext                = end($explodedFileName);

                if(!in_array(strtolower($ext),$allowedExt)){
                    echo "FAIL:: Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    return;
                }else{

                    $FileName = $LogoNamePrefix.'_'.$ID.'_'.time().'.'.$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['logo']['tmp_name'],$uploadPath.'/'.$FileName);
                    $insertDataArray['institutionLogo'] = $uploadDBPath.'/'.$FileName;
                }
            }else{
                echo "FAIL::Logo Image Is Required::error";
                return;
            }

            if(empty($ID)){
                echo "FAIL::Something went wrong with the Post, Please Contact System Administrator For Further Assistance::error";
                exit;
            }
                $selectData = array('institutionLogo AS logo',false);
                $where = array( 'id' => $ID );
                $returnedData = $ci->Common_model->select_fields_where($ci->tableName,$selectData, $where, false, '', '', '','','',false);
                $logo = $returnedData[0]->logo;
            if(!empty($logo) && is_file(FCPATH.'/'.$logo)){
                unlink('./'.$logo);
            }
                $resultUpdate = $ci->Common_model->update($ci->tableName,$where,$insertDataArray);
            if($resultUpdate === true){
                echo "OK::Record Updated Successfully::success";
            }else{
                echo "FAIL::Something went wrong during Update, Please Contact System Administrator::error";
            }
            return NULL;
        }

        //Default : Show the View if
        $ci->show_admin_listing('admin/configuration/'.$ci->ViewFolderName.'/listing',$ci->data);
	}

    function ViewHelperNewSave(){

        $ci =& get_instance();
        $ci->load->model('Common_Model');
    
        $return = array();
        if(!$ci->input->post()){
            $error = "FAIL::No Value Posted::error";
            array_push($return, $error);
            return $return;
        }

        $Name    = $ci->input->post('Name');
        $Phone   = $ci->input->post('Phone');
        $Email   = $ci->input->post('Email');
        $Website = $ci->input->post('Website');

        $Address            = $ci->input->post('address');
        $Suburb             = $ci->input->post('suburb');
        $State              = $ci->input->post('state');
        $Post_code          = $ci->input->post('post_code');

        $roleDepartment                 = $ci->input->post('roleDepartment');
        $programDescription             = $ci->input->post('programDescription');
        $programEligibilityCriteria     = $ci->input->post('programEligibilityCriteria');
        $ProgramStartDate               = $ci->input->post('ProgramStartDate');


        if(empty($Name)){
            $error = "FAIL::".$ci->NameMessage." Name is a required field::error::Required!!";
            array_push($return, $error);
            return $return;
        }

        $insertData = array(
            'institution'           => $Name,
            'phone'                 => $Phone,
            'email'                 => $Email,
            'website'               => $Website,
            'address'               => $Address,
            'suburb'                => $Suburb,
            'state'                 => $State,
            'post_code'             => $Post_code,
            'roleDepartment'        => $roleDepartment,
            'programDescription'    => $programDescription,
            'programEligibilityCriteria'  => $programEligibilityCriteria,
            'ProgramStartDate'      => $ProgramStartDate

        );
        $insertResult = $ci->Common_model->insert_record($ci->tableName,$insertData);

        if($insertResult){
            $success =  "OK::Record Successfully Added ID is ".$insertResult." ::success";
            array_push($return, $success);
        }else{
            $error =  "FAIL::Record Not Added::error";
            array_push($return, $error);
            return $return;
        }

       $allowedExt = array('jpeg','jpg','png','gif');

        if(is_numeric($insertResult)){

            $uploadPath        = './pictures/logos/'.$ci->ImagesFolderName.'/'.$insertResult;
            $uploadDirectory   = './pictures/logos/'.$ci->ImagesFolderName.'/'.$insertResult;
            $uploadDBPath      = 'pictures/logos/'.$ci->ImagesFolderName.'/'.$insertResult;
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

                    $FileName = $ci->LogoNamePrefix.'_'.$ID.'_'.time().'.'.$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['Logoimage']['tmp_name'],$uploadPath.'/'.$FileName);
                    $insertDataArray['institutionLogo'] = $uploadDBPath.'/'.$FileName;
                    $selectData = array('institutionLogo AS logo',false);
                    $where = array( 'id' => $insertResult );
                    $returnedData = $ci->Common_model->select_fields_where($ci->tableName,$selectData, $where, false, '', '', '','','',false);
                    $logo = $returnedData[0]->logo;


                    if(!empty($logo) && is_file(FCPATH.'/'.$logo)){
                        unlink('./'.$logo);
                    }

                    $resultUpdate = $ci->Common_model->update($ci->tableName,$where,$insertDataArray);
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
           /* $insertDataArray    = array();

            if(isset($_FILES['Bannerimage']['name']) && !empty($_FILES['Bannerimage']['name'])){
                $FileName           = $_FILES['Bannerimage']['name'];
                $explodedFileName   = explode('.',$FileName);
                $ext                = end($explodedFileName);

                if(!in_array(strtolower($ext),$allowedExt)){
                    $error =  "FAIL:: Banner -- Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    array_push($return, $error);
                }else{

                    $FileName = $ci->BannerNamePrefix.'_'.$ID.'_'.time().'.'.$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['Bannerimage']['tmp_name'],$uploadPath.'/'.$FileName);
                    $insertDataArray['banner'] = $uploadDBPath.'/'.$FileName;

                    $selectData = array('banner AS banner',false);
                    $where = array( 'id' => $insertResult );
                    $returnedData = $ci->Common_model->select_fields_where($ci->tableName,$selectData, $where, false, '', '', '','','',false);
                    $banner = $returnedData[0]->banner;

                    if(!empty($banner) && is_file(FCPATH.'/'.$banner)){
                        unlink('./'.$banner);
                    }
                        $resultUpdate = $ci->Common_model->update($ci->tableName,$where,$insertDataArray);
                    if($resultUpdate === true){
                        $success = "OK::Banner Uploaded::success";
                        array_push($return, $success);
                    }else{
                        $error = "FAIL::Banner -- Something went wrong during Update, Please Contact System Administrator::error";
                        array_push($return, $error);
                    }
                }
            }else{
                //$error = "FAIL::Banner Image Not Provided::warning";
                //array_push($return, $error);
            }
*/
        }
        return $return;

    }
    function ViewHelperEditSave(){

        $ci =& get_instance();
        $ci->load->model('Common_Model');
    

        $return = array();
        if(!$ci->input->post()){
            $error = "FAIL::No Value Posted::error";
            array_push($return, $error);
            return $return;
        }
        $ID = $ci->input->post('id');
        if(empty($ID)){
            $error = "FAIL::No ID Set::error";
            array_push($return, $error);
            return $return;
        }
        $Name    = $ci->input->post('Name');
        $Phone   = $ci->input->post('Phone');
        $Email   = $ci->input->post('Email');
        $Website = $ci->input->post('Website');

        $Address            = $ci->input->post('address');
        $Suburb             = $ci->input->post('suburb');
        $State              = $ci->input->post('state');
        $Post_code          = $ci->input->post('post_code');

        $roleDepartment                 = $ci->input->post('roleDepartment');
        $programDescription             = $ci->input->post('programDescription');
        $programEligibilityCriteria     = $ci->input->post('programEligibilityCriteria');
        $ProgramStartDate               = $ci->input->post('ProgramStartDate');


        if(empty($Name)){
            $error = "FAIL::".$ci->NameMessage." Name is a required field::error::Required!!";
            array_push($return, $error);
            return $return;
        }

        $updateData = array(
            'institution'           => $Name,
            'phone'                 => $Phone,
            'email'                 => $Email,
            'website'               => $Website,
            'address'               => $Address,
            'suburb'                => $Suburb,
            'state'                 => $State,
            'post_code'             => $Post_code,
            'roleDepartment'        => $roleDepartment,
            'programDescription'    => $programDescription,
            'programEligibilityCriteria'  => $programEligibilityCriteria,
            'ProgramStartDate'      => $ProgramStartDate,

        );
       
        $where = array('id' => $ID);
        $updateResult = $ci->Common_model->update($ci->tableName,$where , $updateData);
        
        if($updateResult){
            $success =  "OK::Record Successfully Updated ID is ".$ID." ::success";
            array_push($return, $success);
        }else{
            $error =  "FAIL::Record Not Updated::error";
            array_push($return, $error);
            return $return;
        }

        $allowedExt = array('jpeg','jpg','png','gif', 'pdf', 'doc', 'docx');

        if(is_numeric($ID)){

            $uploadPath        = './pictures/logos/'.$ci->ImagesFolderName.'/'.$ID;
            $uploadDirectory   = './pictures/logos/'.$ci->ImagesFolderName.'/'.$ID;
            $uploadDBPath      = 'pictures/logos/'.$ci->ImagesFolderName.'/'.$ID;
            $insertDataArray   = array();
            //For Logo Upload
            if(isset($_FILES['Logoimage']['name']) && !empty($_FILES['Logoimage']['name'])){
                $FileName           = $_FILES['Logoimage']['name'];
                $explodedFileName   = explode('.',$FileName);
                $ext                = end($explodedFileName);

                if(!in_array(strtolower($ext),$allowedExt)){
                    $error =  "FAIL:: Logo -- Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    array_push($return, $error);
                }else{

                    $FileName = $ci->LogoNamePrefix.'_'.$ID.'_'.time().'.'.$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['Logoimage']['tmp_name'],$uploadPath.'/'.$FileName);
                    $insertDataArray['institutionLogo'] = $uploadDBPath.'/'.$FileName;
                    $selectData = array('institutionLogo AS logo',false);
                    $where = array( 'id' => $ID );
                    $returnedData = $ci->Common_model->select_fields_where($ci->tableName,$selectData, $where, false, '', '', '','','',false);
                    $logo = $returnedData[0]->logo;


                    if(!empty($logo) && is_file(FCPATH.'/'.$logo)){
                        unlink('./'.$logo);
                    }

                    $resultUpdate = $ci->Common_model->update($ci->tableName,$where,$insertDataArray);
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
           /* $insertDataArray    = array();

            if(isset($_FILES['Bannerimage']['name']) && !empty($_FILES['Bannerimage']['name'])){
                $FileName           = $_FILES['Bannerimage']['name'];
                $explodedFileName   = explode('.',$FileName);
                $ext                = end($explodedFileName);

                if(!in_array(strtolower($ext),$allowedExt)){
                    $error =  "FAIL:: Banner -- Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    array_push($return, $error);
                }else{

                    $FileName = $ci->BannerNamePrefix.'_'.$ID.'_'.time().'.'.$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['Bannerimage']['tmp_name'],$uploadPath.'/'.$FileName);
                    $insertDataArray['banner'] = $uploadDBPath.'/'.$FileName;

                    $selectData = array('banner AS banner',false);
                    $where = array( 'id' => $ID );
                    $returnedData = $ci->Common_model->select_fields_where($ci->tableName,$selectData, $where, false, '', '', '','','',false);
                    $banner = $returnedData[0]->banner;

                    if(!empty($banner) && is_file(FCPATH.'/'.$banner)){
                        unlink('./'.$banner);
                    }
                        $resultUpdate = $ci->Common_model->update($ci->tableName,$where,$insertDataArray);
                    if($resultUpdate === true){
                        $success = "OK::Banner Uploaded::success";
                        array_push($return, $success);
                    }else{
                        $error = "FAIL::Banner -- Something went wrong during Update, Please Contact System Administrator::error";
                        array_push($return, $error);
                    }
                }
            }else{
                //$error = "FAIL::Banner Image Not Provided::warning";
                //array_push($return, $error);
            }
*/
        }
        return $return;
    }

?>