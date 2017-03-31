<?php 
	function viewHelperManage($param=NULL){
        $ci =& get_instance();
        if(checkAdminRole($ci) == true){
            $ci->load->model('Common_Model');

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
            if(loadDefautParamActions($ci,$param) == true){
                $ci->show_admin_listing('admin/configuration/'.$ci->ViewFolderName.'/listing',$ci->data);
            }
        }
    }

    function ViewHelperNewSave(){

        $ci =& get_instance();
        if(checkAdminRole($ci) == true){
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

            $contactName        = $ci->input->post('contactName');


            if(empty($Name)){
                $error = "FAIL::".$ci->NameMessage." Name is a required field::error::Required!!";
                array_push($return, $error);
                return $return;
            }
            $now = date("Y-m-d H:i:s");
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
                'ProgramStartDate'      => $ProgramStartDate,
                'contactName'           => $contactName,
                'date_created'          => $now,
                'date_updated'          => $now
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

            $note = uploadImagesAction($ci,$insertResult);
            array_push($return, $note);

            return $return;
        }
        return false;
    }
    function ViewHelperEditSave(){
        
        $ci =& get_instance();
        if(checkAdminRole($ci) == true){
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

            $contactName        = $ci->input->post('contactName');

            if(empty($Name)){
                $error = "FAIL::".$ci->NameMessage." Name is a required field::error::Required!!";
                array_push($return, $error);
                return $return;
            }

            $now = date("Y-m-d H:i:s");
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
                'contactName'           => $contactName,
                'date_updated'          => $now
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

            $note = uploadImagesAction($ci,$ID);
            array_push($return, $note);

            return $return;
        }
        return false;
    }
?>