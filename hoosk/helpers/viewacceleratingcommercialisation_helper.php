<?php 
	function viewHelperManage($param=NULL){
        $ci =& get_instance();
        if(checkRoleHasPermission($ci,$ci->Name.' Admin Listing') == true){
            $ci->load->model('Common_Model');

            //Now see if the param is of listing
            if($param === 'listing'){
                $where = array('');
                if(!isCurrentUserAdmin($ci)){
                    $userID = getCurrentUserID($ci);
                    $where = array('userID' => $userID);    
                }
                $selectData = array('
                id AS ID,
                Member AS Member,
                Web_Address AS Web_Address,
                Project_Title AS Project_Title,
                Project_Location AS Project_Title,
                State_Territory AS State_Territory,
                accLogo AS Logo,
                CASE WHEN trashed = 1 THEN CONCAT(\'<span class="label label-danger">YES</span>\') WHEN trashed = 0 THEN CONCAT(\'<span class="label label-success">NO</span>\') ELSE "" END AS Trashed
                ',false);

                $addColumns = array(
                    'ViewEditActionButtons' => array(
                        '<a href="'.base_url().$ci->Name.'/Edit/$1"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','ID')
                );
                $returnedData = $ci->Common_model->select_fields_joined_DT($selectData,$ci->tableName,'',$where,'','','',$addColumns);
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
        if(checkRoleHasPermission($ci,$ci->Name.' New') == true){
            $ci->load->model('Common_Model');
        
            $return = array();
            if(!$ci->input->post()){
                $error = "FAIL::No Value Posted::error";
                array_push($return, $error);
                return $return;
            }
            $Member            = $ci->input->post('Member');
            $Web_Address       = $ci->input->post('Web_Address');
            $State_Territory   = $ci->input->post('State_Territory');
            $postal_code       = $ci->input->post('postal_code');
            $Project_Title     = $ci->input->post('Project_Title');
            $Project_Location  = $ci->input->post('Project_Location');
            $Project_Summary   = $ci->input->post('Project_Summary');
            $Market            = $ci->input->post('Market');
            $Technology        = $ci->input->post('Technology');
            $short_description = $ci->input->post('short_description');
            $long_description  = $ci->input->post('long_description');

            if(empty($Member)){
                $error = "FAIL::".$ci->NameMessage." Name is a required field::error::Required!!";
                array_push($return, $error);
                return $return;
            }
            $NameExist = checkListingExist($ci, $Member, 'Member');
            if($NameExist == true){
                $error =  "FAIL::".$ci->NameMessage." Member Already Exist Cannot Create New Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $Web_AddressExist = checkListingExist($ci, $Web_Address ,'Web_Address');
            if($Web_AddressExist == true){
                $error =  "FAIL::".$ci->NameMessage." Website Already Exist Cannot Create New Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $now = date("Y-m-d H:i:s");
            $insertData = array(
                'Member'            => $Member,
                'Web_Address'       => $Web_Address,
                'Project_Location'  => $Project_Location,
                'State_Territory'   => $State_Territory,
                'postal_code'       => $postal_code,
                'Project_Title'     => $Project_Title,
                'Project_Summary'   => $Project_Summary,
                'Market'            => $Market,
                'Technology'        => $Technology,
                'short_description' => $short_description,
                'long_description'  => $long_description,
                'date_created'      => $now,
                'date_updated'      => $now
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

            $notes = uploadImagesAction($ci,$insertResult);
            if(is_array($notes) && !empty($notes)){
                 foreach ($notes as $key => $note){
                    array_push($return, $note);
                 }
             }

            return $return;
        }
        return false;
    }
    function ViewHelperEditSave(){

        $ci =& get_instance();
        if(checkRoleHasPermission($ci,$ci->Name.' Edit') == true){
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
            $Member            = $ci->input->post('Member');
            $Web_Address       = $ci->input->post('Web_Address');
            $State_Territory   = $ci->input->post('State_Territory');
            $postal_code       = $ci->input->post('postal_code');
            $Project_Title     = $ci->input->post('Project_Title');
            $Project_Location  = $ci->input->post('Project_Location');
            $Project_Summary   = $ci->input->post('Project_Summary');
            $Market            = $ci->input->post('Market');
            $Technology        = $ci->input->post('Technology');
            $short_description = $ci->input->post('short_description');
            $long_description  = $ci->input->post('long_description');

            if(empty($Member)){
                $error = "FAIL::".$ci->NameMessage." Name is a required field::error::Required!!";
                array_push($return, $error);
                return $return;
            }
            $NameExist = checkListingExist($ci, $Member, 'Member', $ID);
            if($NameExist == true){
                $error =  "FAIL::".$ci->NameMessage." Member Already Exist Cannot Edit Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $Web_AddressExist = checkListingExist($ci, $Web_Address ,'Web_Address', $ID);
            if($Web_AddressExist == true){
                $error =  "FAIL::".$ci->NameMessage." Website Already Exist Cannot Edit Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $now = date("Y-m-d H:i:s");
            $updateData = array(
                'Member'            => $Member,
                'Web_Address'       => $Web_Address,
                'Project_Location'  => $Project_Location,
                'State_Territory'   => $State_Territory,
                'postal_code'       => $postal_code,
                'Project_Title'     => $Project_Title,
                'Project_Summary'   => $Project_Summary,
                'Market'            => $Market,
                'Technology'        => $Technology,
                'short_description' => $short_description,
                'long_description'  => $long_description,
                'date_updated'      => $now
            );

            $where = array('id' => $ID);
            if(!isCurrentUserAdmin($ci)){
                $userID = getCurrentUserID($ci);
                $where['userID'] = $userID;    
            }
            $updateResult = $ci->Common_model->update($ci->tableName,$where , $updateData);
            
            if($updateResult){
                $success =  "OK::Record Successfully Updated ID is ".$ID." ::success";
                array_push($return, $success);
            }else{
                $error =  "FAIL::Record Not Updated::error";
                array_push($return, $error);
                return $return;
            }

            $notes = uploadImagesAction($ci,$ID);
            if(is_array($notes) && !empty($notes)){
                 foreach ($notes as $key => $note){
                    array_push($return, $note);
                 }
             }

            return $return;
        }
        return false;
    }

?>
