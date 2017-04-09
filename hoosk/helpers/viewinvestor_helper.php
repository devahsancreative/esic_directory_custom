<?php 
	function viewHelperManage($param=NULL){
		$ci =& get_instance();
        if(checkAdminRole($ci) == true){
            $ci->load->model('Common_Model');
    	    
            //Now see if the param is of listing
            if($param === 'listing'){
                $selectData = array('
                '.$ci->tableName.'.id AS ID,
                '.$ci->tableName.'.name AS Name,
                '.$ci->tableName.'.phone AS Phone,
                '.$ci->tableName.'.website AS Website,
                '.$ci->tableName.'.email AS Email,
                '.$ci->tableName.'.logo AS Logo,
                '.$ci->tableName.'.investor_type_id AS Type_ID,
                IT.label AS Type_Label,
                IT.name AS Type_Name,
                CASE WHEN trashed = 1 THEN CONCAT(\'<span class="label label-danger">YES</span>\') WHEN trashed = 0 THEN CONCAT(\'<span class="label label-success">NO</span>\') ELSE "" END AS Trashed
                ',false);

                $addColumns = array(
                    'ViewEditActionButtons' => array(
                        '<a href="'.base_url().$ci->Name.'/Edit/$1"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','ID')
                );
                $joins = array(
                    array(
                        'table' => 'investor_types IT',
                        'condition' => 'IT.id = '.$ci->tableName.'.investor_type_id',
                        'type' => 'LEFT'
                    )
                );
                $returnedData = $ci->Common_model->select_fields_joined_DT($selectData,$ci->tableName,$joins,'','','','',$addColumns);
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

            $name    = $ci->input->post('name');
            $phone   = $ci->input->post('phone');
            $email   = $ci->input->post('email');
            $website = $ci->input->post('website');

            $company_name   = $ci->input->post('company_name');
            $company_email  = $ci->input->post('company_email');

            $address_street_number   = $ci->input->post('address_street_number');
            $address_street_name     = $ci->input->post('address_street_name');
            $address_town            = $ci->input->post('address_town');
            $address_state           = $ci->input->post('address_state');
            $address_post_code       = $ci->input->post('address_post_code');

            $about            = $ci->input->post('about');
            $investor_type_id = $ci->input->post('investor_type_id');
            $preferred_investment_amount      = $ci->input->post('preferred_investment_amount');
            $preferred_investment_industires  = json_encode($ci->input->post('preferred_investment_industires'));
            $preferred_esic_status_ids        = json_encode($ci->input->post('preferred_esic_status_ids'));

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
            $EmailExist = checkListingExist($ci, $email, 'email');
            if($EmailExist == true){
                $error =  "FAIL::".$ci->NameMessage." Email Already Exist Cannot Create New Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $now = date("Y-m-d H:i:s");
            $insertData = array(
                'name'                  => $name,
                'phone'                 => $phone,
                'email'                 => $email,
                'website'               => $website,
                'company_name'          => $company_name,
                'company_email'         => $company_email,
                'address_street_number' => $address_street_number,
                'address_street_name'   => $address_street_name,
                'address_town'          => $address_town,
                'address_state'         => $address_state,
                'address_post_code'     => $address_post_code,
                'about'                 => $about,
                'investor_type_id'      => $investor_type_id,
                'preferred_investment_amount'      => $preferred_investment_amount,
                'preferred_investment_industires'  => $preferred_investment_industires,
                'preferred_esic_status_ids'        => $preferred_esic_status_ids,
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
            $notes = saveSocialLinks($ci,$insertResult,'New');
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

            $name    = $ci->input->post('name');
            $phone   = $ci->input->post('phone');
            $email   = $ci->input->post('email');
            $website = $ci->input->post('website');

            $company_name   = $ci->input->post('company_name');
            $company_email  = $ci->input->post('company_email');

            $address_street_number   = $ci->input->post('address_street_number');
            $address_street_name     = $ci->input->post('address_street_name');
            $address_town            = $ci->input->post('address_town');
            $address_state           = $ci->input->post('address_state');
            $address_post_code       = $ci->input->post('address_post_code');

            $about            = $ci->input->post('about');
            $investor_type_id = $ci->input->post('investor_type_id');


            $preferred_investment_amount      = $ci->input->post('preferred_investment_amount');
            $preferred_investment_industires  = json_encode($ci->input->post('preferred_investment_industires'));
            $preferred_esic_status_ids        = json_encode($ci->input->post('preferred_esic_status_ids'));

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
            $EmailExist = checkListingExist($ci, $email, 'email', $ID);
            if($EmailExist == true){
                $error =  "FAIL::".$ci->NameMessage." Email Already Exist Cannot Edit Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }

            $now = date("Y-m-d H:i:s");
            $updateData = array(
                'name'                  => $name,
                'phone'                 => $phone,
                'email'                 => $email,
                'website'               => $website,
                'company_name'          => $company_name,
                'company_email'         => $company_email,
                'address_street_number' => $address_street_number,
                'address_street_name'   => $address_street_name,
                'address_town'          => $address_town,
                'address_state'         => $address_state,
                'address_post_code'     => $address_post_code,
                'about'                 => $about,
                'investor_type_id'      => $investor_type_id,
                'preferred_investment_amount'      => $preferred_investment_amount,
                'preferred_investment_industires'  => $preferred_investment_industires,
                'preferred_esic_status_ids'        => $preferred_esic_status_ids,
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

            $notes = uploadImagesAction($ci,$ID);
            if(is_array($notes) && !empty($notes)){
                foreach ($notes as $key => $note){
                    array_push($return, $note);
                }
            }
            $notes = saveSocialLinks($ci,$ID,'Edit');
            if(is_array($notes) && !empty($notes)){
                foreach ($notes as $key => $note){
                    array_push($return, $note);
                }
            }

            return $return;
        }
        return false;
    }
    function SaveSocialLinks($ci,$ID,$action){

        $return = array();
        if(!$ci->input->post()){
            $error = "FAIL::No Value Posted::error";
            array_push($return, $error);
            return $return;
        }
        if(empty($ID)){
            $error = "FAIL::No ID Set::error";
            array_push($return, $error);
            return $return;
        }

        $FacebookLink   = $ci->input->post('FacebookLink');
        $TwitterLink    = $ci->input->post('TwitterLink');
        $GoogleLink     = $ci->input->post('GoogleLink');
        $LinkedInLink   = $ci->input->post('LinkedInLink');
        $YoutubeLink    = $ci->input->post('YoutubeLink');
        $VimeoLink      = $ci->input->post('VimeoLink');


        
        $inputData = array(
                'facebook'    => $FacebookLink,
                'twitter'     => $TwitterLink,
                'google'      => $GoogleLink,
                'linkedIn'    => $LinkedInLink,
                'youTube'     => $YoutubeLink,
                'vimeo'       => $VimeoLink
        );
        $notes = array();
        if($action == 'New'){
            $notes =  AddNewSocialLink($ci,$ID,$inputData);
        }
        if($action == 'Edit'){
             $notes = EditSocialLink($ci,$ID,$inputData);
        }
        if(is_array($notes) && !empty($notes)){
            foreach ($notes as $key => $note){
                array_push($return, $note);
            }
        }
        
         return $return;

    }
    function AddNewSocialLink($ci,$ID,$inputData){
        $return = array();
        $inputData['investorID'] = $ID;
        //$inputData['userID'] = $UserID;
        $now = date("Y-m-d H:i:s");
        $inputData['date_created'] = $now;
        $inputData['date_updated'] = $now;
        $Result = $ci->Common_model->insert_record($ci->tableNameSocial,$inputData);
        if($Result){
            $success =  "OK::Socail Links Created ::success";
            array_push($return, $success);
        }else{
            $error =  "FAIL::Socail Links Failed To Create ::error";
            array_push($return, $error);
           
        }
        return $return;
    }
    function EditSocialLink($ci,$ID,$inputData){
        $return = array();
        $where['investorID'] = $ID;
        //$where['userID'] = $UserID;
        $now = date("Y-m-d H:i:s");
        $inputData['date_updated'] = $now;
        $updateResult = $ci->Common_model->update($ci->tableNameSocial,$where ,$inputData);
        if($updateResult){
            $success =  "OK::Socail Links Updated ::success";
            array_push($return, $success);
        }else{
            $error =  "FAIL::Socail Links Update Failed ::error";
            array_push($return, $error);
           
        }
        return $return;
    }
?>
