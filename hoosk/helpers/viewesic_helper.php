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
                '.$ci->tableName.'.name AS Name,
                '.$ci->tableName.'.website AS Website,
                '.$ci->tableName.'.email AS Email,
                '.$ci->tableName.'.logo AS Logo,
                '.$ci->tableName.'.status AS Status_ID,
                 ES.color AS color,
                CASE WHEN ES.id > 0 THEN CONCAT("<span class=\'label \' style=\' background-color:",color,"\'> ", ES.status," </span>") ELSE CONCAT ("<span class=\'label label-warning\'> ", ES.status, " </span>") END AS Status_Label, 
                CASE WHEN trashed = 1 THEN CONCAT(\'<span class="label label-danger">YES</span>\') WHEN trashed = 0 THEN CONCAT(\'<span class="label label-success">NO</span>\') ELSE "" END AS Trashed,
                Publish as PublishStatusID,
                CASE WHEN Publish = 1 THEN CONCAT(\'<span class="label label-success">YES</span>\') WHEN Publish = 0 THEN CONCAT(\'<span class="label label-danger">NO</span>\') ELSE "" END AS Publish
                ',false);

                $addColumns = array(
                    'ViewEditActionButtons' => array(
                        '<a href="#" data-target=".publish-modal" data-toggle="modal"><i data-toggle="tooltip" title="Publish Status" data-placement="right"  class="fa fa-check text-blue"></i></a> &nbsp; <a href="'.base_url().$ci->Name.'/Edit/$1"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trashed" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','ID')
                );

                $joins = array(
                    array(
                        'table' => 'esic_status ES',
                        'condition' => 'ES.id = '.$ci->tableName.'.status',
                        'type' => 'LEFT'
                    )
                );
                $returnedData = $ci->Common_model->select_fields_joined_DT($selectData,$ci->tableName,$joins,$where,'','','',$addColumns);
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
            /*
            $ID = 0;
            $userName   = $ci->input->post('userName');
            $firstName  = $ci->input->post('firstName');
            $lastName   = $ci->input->post('lastName');
            $phone      = $ci->input->post('Phone');
            $userEmail  = $ci->input->post('userEmail');

            $EsicUserExist = CheckUserEsicUser($ci, $email, 'email');
            if($EsicUserExist == true){
                $error =  "FAIL::".$ci->NameMessage." User Email Already Exist Cannot Create New Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }else{
                $NewUserData = array(
                    'userName'  => $userName,
                    'userRole'  => 2, // Esic Role
                    'firstName' => $firstName,
                    'lastName'  => $lastName,
                    'phone'     => $phone,
                    'email'     => $userEmail,
                    'password'  => md5('demo'.SALT) 
                );
                $NewUserCreated =InsertEsicUser($ci, $NewUserData); 
                if($NewUserCreated){
                    $ID = $NewUserCreated;
                }else{
                    $error =  "FAIL::".$ci->NameMessage." New User Cannot Be Created Please Contact Administrator::error";
                    array_push($return, $error);
                    return $return;
                }
            }*/
            $Name           = $ci->input->post('Name');
            $Website        = $ci->input->post('Website');
            $email          = $ci->input->post('Email');
            $Business       = $ci->input->post('Business');
            $corporate_date = $ci->input->post('IncorporateDate');
            $added_date     = $ci->input->post('AddedDate');
            $expiry_date    = $ci->input->post('ExpiryDate');
            $acn_number     = $ci->input->post('ACN');

            //Need to have Separate Logic for Address.
            //If Address is a single String then store it as a Single String.
            //Else, We Would Need to Combine multiple Address Fields in to One JSON.

            //Multi Field Address
            $StreetNumber   = $ci->input->post('address_streetNumber');
            $StreetName     = $ci->input->post('address_streetName');
            $Town           = $ci->input->post('address_town');
            $State          = $ci->input->post('address_state');
            $PostCode       = $ci->input->post('address_postCode');

            $Publish   = $ci->input->post('Publish');

            $ShortDescription = $ci->input->post('ShortDescription');
            $LongDescription  = $ci->input->post('LongDescription');
            $Keywords         = $ci->input->post('Keywords');

            if(empty($Name)){
                $error = "FAIL::".$ci->NameMessage." Name is a required field::error::Required!!";
                array_push($return, $error);
                return $return;
            }
            $NameExist = checkListingExist($ci, $Name, 'name');
            if($NameExist == true){
                $error =  "FAIL::".$ci->NameMessage." Name Already Exist Cannot Create New Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $EmailExist = checkListingExist($ci, $Email, 'email');
            if($EmailExist == true){
                $error =  "FAIL::".$ci->NameMessage." Email Already Exist Cannot Create New Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $now = date("Y-m-d H:i:s");
            $insertData = array(
                //'userID'                => $ID,
                'name'                  => $Name,
                'email'                 => $email,
                'website'               => $Website,
                'address_street_number' => $StreetNumber,
                'address_street_name'   => $StreetName,
                'address_town'          => $Town,
                'address_state'         => $State,
                'address_post_code'     => $PostCode,
                'short_description'     => $ShortDescription,
                'long_description'      => $LongDescription,
                'keywords'              => $Keywords,
                'Publish'               => $Publish,
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

            $Name    = $ci->input->post('Name');
            $Phone   = $ci->input->post('Phone');
            $Email   = $ci->input->post('Email');
            $Website = $ci->input->post('Website');
           // $Address = $ci->input->post('Address');

            $ShortDescription = $ci->input->post('ShortDescription');
            $LongDescription  = $ci->input->post('LongDescription');
            $Keywords         = $ci->input->post('Keywords');
            $Publish          = $ci->input->post('Publish');

            //Need to have Separate Logic for Address.
            //If Address is a single String then store it as a Single String.
            //Else, We Would Need to Combine multiple Address Fields in to One JSON.

            //Multi Field Address
            $StreetNumber   = $ci->input->post('address_streetNumber');
            $StreetName     = $ci->input->post('address_streetName');
            $Town           = $ci->input->post('address_town');
            $State          = $ci->input->post('address_state');
            $PostCode       = $ci->input->post('address_postCode');


            if(empty($Name)){
                $error = "FAIL::".$ci->NameMessage." Name is a required field::error::Required!!";
                array_push($return, $error);
                return $return;
            }
            $NameExist = checkListingExist($ci, $Name, 'name', $ID);
            if($NameExist == true){
                $error =  "FAIL::".$ci->NameMessage." Name Already Exist Cannot Edit Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $EmailExist = checkListingExist($ci, $Email, 'email', $ID);
            if($EmailExist == true){
                $error =  "FAIL::Email Already Exist Cannot Edit Please Contact Administrator::error";
                array_push($return, $error);
                return $return;
            }
            $now = date("Y-m-d H:i:s");
            $updateData = array(
                'name'                  => $Name,
                'email'                 => $Email,
                'website'               => $Website,
                'address_street_number' => $StreetNumber,
                'address_street_name'   => $StreetName,
                'address_town'          => $Town,
                'address_state'         => $State,
                'address_post_code'     => $PostCode,
                'short_description'     => $ShortDescription,
                'long_description'      => $LongDescription,
                'keywords'              => $Keywords,
                'Publish'               => $Publish,
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
    function ViewHelperListing(){
        $ci =& get_instance();
        $selectData = array('
            '.$ci->tableName.'.*,
            ES.*
            ',false);
        $where = 'trashed != 1';
        $joins = array(
            array(
                'table' => 'esic_social ES',
                'condition' => 'ES.listingID = '.$ci->tableName.'.id',
                'type' => 'LEFT'
            )
        );
        $returnedData = $ci->Common_model->select_fields_where_like_join($ci->tableName,$selectData,$joins,$where);
        return $returnedData;   
    }
?>
