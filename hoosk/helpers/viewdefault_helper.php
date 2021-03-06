<?php 

/**
 * @function loadDefautParamActions 
 */
if(!function_exists('loadDefautParamActions')){
    function loadDefautParamActions($ci,$param){
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
                echo "OK::Record Deleted::success";
            }else{
                echo "FAIL::Record Not Deleted::error";
            }
            return NULL;
        }
        if($param === 'updateLogo'){
            $LogoDbField       = $ci->LogoDbField;
            $LogoNamePrefix    = $ci->LogoNamePrefix;
            $ID                = $ci->input->post('id');
            $allowedExt        = array('jpeg','jpg','png','gif');
            $uploadPath        = './pictures/logos/'.$ci->ImagesFolderName.'/'.$ID;
            $uploadDirectory   = './pictures/logos/'.$ci->ImagesFolderName.'/'.$ID;
            $uploadDBPath      = 'pictures/logos/'.$ci->ImagesFolderName.'/'.$ID;
            $insertDataArray   = array();
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
                    $insertDataArray[$LogoDbField] = $uploadDBPath.'/'.$FileName;
                }
            }else{
                echo "FAIL::Logo Image Is Required::error";
                return;
            }

            if(empty($ID)){
                echo "FAIL::Something went wrong with the Post, Please Contact System Administrator For Further Assistance (Error Code: 10115)::error";
                exit;
            }
                $selectData = array(
                    $LogoDbField.' AS logo'
                    ,false);
                $where = array( 'id' => $ID );
                $returnedData = $ci->Common_model->select_fields_where($ci->tableName,$selectData, $where, false, '', '', '','','',false);
                $logo = $returnedData[0]->logo;
            if(!empty($logo) && is_file(FCPATH.'/'.$logo)){
                unlink('./'.$logo);
            }
                $resultUpdate = $ci->Common_model->update($ci->tableName,$where,$insertDataArray);
            if($resultUpdate === true){
                echo "OK::Logo Updated Successfully::success";
            }else{
                echo "FAIL::Something went wrong during Update, Please Contact System Administrator (Error Code: 10115)::error";
            }
            return NULL;
        }
        if($param === 'PublishAction'){
            if(!$ci->input->post()){
                echo "FAIL::Oops Something Went Wrong (Error Code: 10404)::error";
                return false;
            }
            $id     = $ci->input->post('id');
            $actionPerform  = $ci->input->post('actionPerform');
            $currentValue  = $ci->input->post('currentValue');
            $publishValue = '0';
            if($actionPerform == 'publish'){
                $publishValue = 1;
            }
            $whereUpdate = array('id' => $id);
            $updateData  = array('Publish' => $publishValue);
            $returnedData = $ci->Common_model->update($ci->tableName,$whereUpdate,$updateData);
            if($returnedData === true){
                echo "OK:: Publish Status Changed ::success::SUCCESS!!";
            }else{
                if($returnedData['code'] === 0){
                    echo "OK::Its is Already Same ::warning::QUERY FAILED";
                    return false;
                }else{
                    echo "FAIL:: Publish Status Cannot Change Due To".$returnedData['message']."::error::DB Message";
                }

            }
            return NULL;
        }
        return true;
    }
}

if(!function_exists('uploadImagesAction')){
    function uploadImagesAction($ci,$ID){
        $return = array();
        $allowedExt = array('jpeg','jpg','png','gif');
        if(is_numeric($ID)){
            $LogoDbField       = $ci->LogoDbField;
            $BannerDbField     = $ci->BannerDbField;
            $uploadPath        = './pictures/logos/'.$ci->ImagesFolderName.'/'.$ID;
            $uploadDirectory   = './pictures/logos/'.$ci->ImagesFolderName.'/'.$ID;
            $uploadDBPath      = 'pictures/logos/'.$ci->ImagesFolderName.'/'.$ID;
            $insertDataArray   = array();

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
                    $insertDataArray[$LogoDbField] = $uploadDBPath.'/'.$FileName;
                    $selectData = array(
                        $LogoDbField.' AS logo',
                        false);
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
            $insertDataArray    = array();

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
                    $insertDataArray[$BannerDbField] = $uploadDBPath.'/'.$FileName;

                    $selectData = array(
                        $BannerDbField.' AS banner'
                        ,false);
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
                $error = "FAIL::Banner Image Not Provided::warning";
                array_push($return, $error);
            }

            if(isset($_FILES['productImage']['name']) && !empty($_FILES['productImage']['name'])){
                $FileName           = $_FILES['productImage']['name'];
                $explodedFileName   = explode('.',$FileName);
                $ext                = end($explodedFileName);

                if(!in_array(strtolower($ext),$allowedExt)){
                    $error =  "FAIL:: Product -- Only Image JPEG, PNG and GIF Images Allowed, No Other Extensions Are Allowed::error";
                    array_push($return, $error);
                }else{

                    $FileName = $ci->LogoNamePrefix.'_'.$ID.'_'.time().'.'.$ext;
                    if(!is_dir($uploadDirectory)){
                        mkdir($uploadDirectory, 0755, true);
                    }

                    move_uploaded_file($_FILES['productImage']['tmp_name'],$uploadPath.'/'.$FileName);
                    $insertDataArray[$LogoDbField] = $uploadDBPath.'/'.$FileName;
                    $selectData = array(
                        $LogoDbField.' AS product',
                        false);
                    $where = array( 'id' => $ID );
                    $returnedData = $ci->Common_model->select_fields_where($ci->tableName,$selectData, $where, false, '', '', '','','',false);
                    $product = $returnedData[0]->product;


                    if(!empty($product) && is_file(FCPATH.'/'.$product)){
                        unlink('./'.$product);
                    }

                    $resultUpdate = $ci->Common_model->update($ci->tableName,$where,$insertDataArray);
                    if($resultUpdate === true){
                        $success = "OK::Product Uploaded::success";
                        array_push($return, $success);
                    }else{
                        $error = "FAIL::Product Image -- Something went wrong during Update, Please Contact System Administrator::error";
                        array_push($return, $error);
                    }
                }

            }

        }else{
            $error = "FAIL::ID is Not Valid or Not Numeric ::error";
            array_push($return, $error);
        }
        return $return;
    }
}

if(!function_exists('checkListingExist')){
    function checkListingExist($ci, $value, $FieldName, $ID = NULL){
        $where = array($FieldName => $value);
        if($ID != NULL){
            $where['id'] = ' != '.$ID;
        }
        $data = $ci->Common_model->select_fields_where($ci->tableName,$FieldName,$where);
        if($data > 1){
            return true;
        }
        return false;
    }
}

if(!function_exists('CheckUserEsic')){
    function CheckUserEsicUser($ci, $value, $FieldName, $ID = NULL){
        $where = array($FieldName => $value);
        if($ID != NULL){
            $where['userID'] = ' != '.$ID;
        }
        $data = $ci->Common_model->select_fields_where($ci->tableNameUser,$FieldName,$where);
        if($data > 1){
            return true;
        }
        return false;
    }
}
if(!function_exists('UserList')){
    function UserList($ci){
        return $ci->Common_model->select($ci->tableNameUser);
    }
}
if(!function_exists('CountListing')){
    function CountListing($ci){
        return $ci->Common_model->select($ci->tableName);
    }
}                                                                                       
if(!function_exists('InsertEsicUser')){
    function InsertEsicUser($ci, $UserData){
        // Create the user account
        $ci->db->insert($ci->tableNameUser, $UserData);
        $userID =  $ci->db->insert_id();
        if($userID > 1){
            return $userID;
        }
        return false;
    }
}
if(!function_exists('SaveSocialLinks')){
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
        $InstagramLink  = $ci->input->post('InstagramLink');

        
        $inputData = array(
                'facebook'    => $FacebookLink,
                'twitter'     => $TwitterLink,
                'google'      => $GoogleLink,
                'linkedIn'    => $LinkedInLink,
                'youTube'     => $YoutubeLink,
                'vimeo'       => $VimeoLink,
                'instagram'   => $InstagramLink
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
}
if(!function_exists('AddNewSocialLink')){
    function AddNewSocialLink($ci,$ID,$inputData){
        $return = array();
        $inputData['listingID'] = $ID;
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
}
if(!function_exists('EditSocialLink')){
    function EditSocialLink($ci,$ID,$inputData){
        $return = array();
        $where['listingID'] = $ID;
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
}

?>