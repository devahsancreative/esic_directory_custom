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
                '.$ci->tableName.'.ANZSRC AS ANZSRC,
                '.$ci->tableName.'.IDNumber AS IDNumber, 
                '.$ci->tableName.'.email AS Email,
                '.$ci->tableName.'.logo AS Logo,
                '.$ci->tableName.'.status_flag_id AS Status_ID,
                ESF.Label AS Status_Label,
                CASE WHEN trashed = 1 THEN CONCAT(\'<span class="label label-danger">YES</span>\') WHEN trashed = 0 THEN CONCAT(\'<span class="label label-success">NO</span>\') ELSE "" END AS Trashed
                ',false);

                $addColumns = array(
                    'ViewEditActionButtons' => array(
                        '<a href="'.base_url().$ci->Name.'/Edit/$1"><span data-toggle="tooltip" title="Edit" data-placement="left" aria-hidden="true" class="fa fa-pencil text-blue"></span></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="right"  class="fa fa-trash-o text-red"></i></a>','ID')
                );
                $joins = array(
                    array(
                        'table' => 'esic_status_flags ESF',
                        'condition' => 'ESF.id = '.$ci->tableName.'.status_flag_id',
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

            $Name    = $ci->input->post('Name');
            $Phone   = $ci->input->post('Phone');
            $Email   = $ci->input->post('Email');
            $Website = $ci->input->post('Website');
            //Need to have Separate Logic for Address.
            //If Address is a single String then store it as a Single String.
            //Else, We Would Need to Combine multiple Address Fields in to One JSON.

            //Multi Field Address
            $StreetNumber   = $ci->input->post('address_streetNumber');
            $StreetName     = $ci->input->post('address_streetName');
            $Town           = $ci->input->post('address_town');
            $State          = $ci->input->post('address_state');
            $PostCode       = $ci->input->post('address_postCode');

            $status_flag_id = $ci->input->post('statusFlag');

            $RndCredentialsSummary    = $ci->input->post('RndCredentialsSummary');

            $ProgramName        = $ci->input->post('ProgramName');
            $ProgramStartDate   = $ci->input->post('ProgramStartDate');
            $roleDepartment     = $ci->input->post('roleDepartment');
            $contactName        = $ci->input->post('contactName');
            

            //$ShortDescription = $ci->input->post('ShortDescription');
            //$LongDescription  = $ci->input->post('LongDescription');
            //$Keywords = $ci->input->post('Keywords');

            //For Rnd Partners Specially
            $IDNumber = $ci->input->post('IDNumber');
            $ANZSRC   = $ci->input->post('ANZSRC');

            if(empty($Name)){
                $error = "FAIL::".$ci->NameMessage." Name is a required field::error::Required!!";
                array_push($return, $error);
                return $return;
            }

            $now = date("Y-m-d H:i:s");
            $insertData = array(
                'name'                  => $Name,
                'phone'                 => $Phone,
                'email'                 => $Email,
                'website'               => $Website,
                'address_street_number' => $StreetNumber,
                'address_street_name'   => $StreetName,
                'address_town'          => $Town,
                'address_state'         => $State,
                'address_post_code'     => $PostCode,
                ///'short_description'  => $ShortDescription,
                //'long_description'    => $LongDescription,
                //'keywords'            => $Keywords,
                'RndCredentialsSummary' => $RndCredentialsSummary,
                'ProgramName'           => $ProgramName,
                'ProgramStartDate'      => $ProgramStartDate,
                'roleDepartment'        => $roleDepartment,
                'contactName'           => $contactName,
                'IDNumber'              => $IDNumber,
                'ANZSRC'                => $ANZSRC,
                'status_flag_id'        => $status_flag_id,
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
            //Need to have Separate Logic for Address.
            //If Address is a single String then store it as a Single String.
            //Else, We Would Need to Combine multiple Address Fields in to One JSON.

            //Multi Field Address
            $StreetNumber   = $ci->input->post('address_streetNumber');
            $StreetName     = $ci->input->post('address_streetName');
            $Town           = $ci->input->post('address_town');
            $State          = $ci->input->post('address_state');
            $PostCode       = $ci->input->post('address_postCode');



            $RndCredentialsSummary    = $ci->input->post('RndCredentialsSummary');

            $ProgramName        = $ci->input->post('ProgramName');
            $ProgramStartDate   = $ci->input->post('ProgramStartDate');
            $roleDepartment     = $ci->input->post('roleDepartment');
            $contactName        = $ci->input->post('roleDepartment');

            $status_flag_id = $ci->input->post('statusFlag');
            
            //$ShortDescription = $ci->input->post('ShortDescription');
            //$LongDescription  = $ci->input->post('LongDescription');
            //$Keywords = $ci->input->post('Keywords');

            //For Rnd Partners Specially
            $IDNumber = $ci->input->post('IDNumber');
            $ANZSRC   = $ci->input->post('ANZSRC');

            if(empty($Name)){
                $error = "FAIL::".$ci->NameMessage." Name is a required field::error::Required!!";
                array_push($return, $error);
                return $return;
            }

            $now = date("Y-m-d H:i:s");
            $updateData = array(
                'name'                  => $Name,
                'phone'                 => $Phone,
                'email'                 => $Email,
                'website'               => $Website,
                'address_street_number' => $StreetNumber,
                'address_street_name'   => $StreetName,
                'address_town'          => $Town,
                'address_state'         => $State,
                'address_post_code'     => $PostCode,
                ///'short_description'  => $ShortDescription,
                //'long_description'    => $LongDescription,
                //'keywords'            => $Keywords,
                'RndCredentialsSummary' => $RndCredentialsSummary,
                'ProgramName'           => $ProgramName,
                'ProgramStartDate'      => $ProgramStartDate,
                'roleDepartment'        => $roleDepartment,
                'contactName'           => $contactName,
                'IDNumber'              => $IDNumber,
                'ANZSRC'                => $ANZSRC,
                'status_flag_id'        => $status_flag_id,
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
