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
                '.$ci->tableName.'.id AS ID,
                '.$ci->tableName.'.name,
                '.$ci->tableName.'.website,
                '.$ci->tableName.'.address,
                '.$ci->tableName.'.post_code,
                '.$ci->tableName.'.Program_Criteria,
                '.$ci->tableName.'.logo as Logo,
                '.$ci->tableName.'.AcceleratorStatus,
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
            $name              = $ci->input->post('name');
            $website           = $ci->input->post('website');
            $address           = $ci->input->post('address');
            $post_code         = $ci->input->post('post_code');
            $Program_Summary   = $ci->input->post('Program_Summary');
            $Program_Criteria  = $ci->input->post('Program_Criteria');
            $Program_Start_Date             = $ci->input->post('Program_Start_Date');
            $Program_Application_Contact    = $ci->input->post('Program_Application_Contact');
            $Program_Application_Method     = $ci->input->post('Program_Application_Method');
            $AcceleratorStatus              = $ci->input->post('AcceleratorStatus');

            if(empty($name)){
                $error = "FAIL::".$ci->NameMessage." Name is a required field::error::Required!!";
                array_push($return, $error);
                return $return;
            }
            $NameExist = checkListingExist($ci, $name, 'name');
            if($NameExist == true){
                $error =  "FAIL::".$ci->NameMessage." Name Already Exist Cannot Create New Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $websiteExist = checkListingExist($ci, $website ,'website');
            if($websiteExist == true){
                $error =  "FAIL::".$ci->NameMessage." Website Already Exist Cannot Create New Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $now = date("Y-m-d H:i:s");
            $insertData = array(
                'name'              => $name,
                'website'           => $website,
                'address'           => $address,
                'post_code'         => $post_code,
                'Program_Summary'   => $Program_Summary,
                'Program_Criteria'  => $Program_Criteria,
                'Program_Start_Date'          => $Program_Start_Date,
                'Program_Application_Contact' => $Program_Application_Contact,
                'Program_Application_Method'  => $Program_Application_Method,
                'AcceleratorStatus'           => $AcceleratorStatus,
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
            $name              = $ci->input->post('name');
            $website           = $ci->input->post('website');
            $address           = $ci->input->post('address');
            $post_code         = $ci->input->post('post_code');
            $Program_Summary   = $ci->input->post('Program_Summary');
            $Program_Criteria  = $ci->input->post('Program_Criteria');
            $Program_Start_Date             = $ci->input->post('Program_Start_Date');
            $Program_Application_Contact    = $ci->input->post('Program_Application_Contact');
            $Program_Application_Method     = $ci->input->post('Program_Application_Method');
            $AcceleratorStatus              = $ci->input->post('AcceleratorStatus');

            if(empty($name)){
                $error = "FAIL::".$ci->NameMessage." Name is a required field::error::Required!!";
                array_push($return, $error);
                return $return;
            }
            $NameExist = checkListingExist($ci, $name, 'name', $ID);
            if($NameExist == true){
                $error =  "FAIL::".$ci->NameMessage." Name Already Exist Cannot Edit Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $websiteExist = checkListingExist($ci, $website ,'website', $ID);
            if($websiteExist == true){
                $error =  "FAIL::".$ci->NameMessage." Website Already Exist Cannot Edit Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $updateData = array(
                'name'              => $name,
                'website'           => $website,
                'address'           => $address,
                'post_code'         => $post_code,
                'Program_Summary'   => $Program_Summary,
                'Program_Criteria'  => $Program_Criteria,
                'Program_Start_Date'          => $Program_Start_Date,
                'Program_Application_Contact' => $Program_Application_Contact,
                'Program_Application_Method'  => $Program_Application_Method,
                'AcceleratorStatus'           => $AcceleratorStatus,
                'date_updated'          => $now
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
    function ViewHelperListing(){
        $ci =& get_instance();
        $selectData = array('
            '.$ci->tableName.'.*,
            ACCS.*
            ',false);
        $where = 'trashed != 1';
        $joins = array(
            array(
                'table' => 'accelerator_social ACCS',
                'condition' => 'ACCS.listingID = '.$ci->tableName.'.id',
                'type' => 'LEFT'
            )
        );
        $returnedData = $ci->Common_model->select_fields_where_like_join($ci->tableName,$selectData,$joins,$where);
        return $returnedData;   
    }
?>
