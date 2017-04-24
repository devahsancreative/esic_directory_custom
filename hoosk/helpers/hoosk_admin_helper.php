<?php 
if (function_exists('wordlimit')) {
	 function wordlimit($string, $length = 40, $ellipsis = "...")
	{
		$string = strip_tags($string, '<div>');
		$string = strip_tags($string, '<p>');
		$words = explode(' ', $string);
		if (count($words) > $length)
			return implode(' ', array_slice($words, 0, $length)) . $ellipsis;
		else
			return $string.$ellipsis;
	}
	 
}
/**
 * @function getCurrentUserData 
 */
if(!function_exists('isUserLoggedIn')){
    function isUserLoggedIn($ci){
    	$Userdata = $ci->session->userdata();
    	/*echo '<pre>';
    	print_r($Userdata);
    	exit;*/
        $user_id = $ci->session->userdata('userID');
        if (strlen($user_id) <= 0) {
            // No Login Information Found in the session Object
            // So now we will check if we have in cookies
            if (get_cookie('Username')==true&& get_cookie('Password')==true) {
                $ci->authenticate("USE_COOKIES");
            }else
                // nothing found in cookies
                //Store Current Url to Session For Later Use.
                $ci->session->set_userdata('last_page', current_url());
            return false;
        }
        return true;
    }
}

/**
 * @function getCurrentUserData 
 */
if(!function_exists('getCurrentUserData')){
    function getCurrentUserData($ci){
        $Userdata = $ci->session->userdata();
        return $Userdata;
    }
}

/**
 * @function getCurrentUserPermissions 
 */
if(!function_exists('getCurrentUserPermissions')){
    function getCurrentUserPermissions($ci) {
        $permissionsArray = array();
        if(isUserLoggedIn($ci)){
            $roles = $ci->session->userdata('userRole');
            $allPermissionIDs = getAllPermissionsIDs($ci,$roles);
            if(is_array($allPermissionIDs) && !empty($allPermissionIDs)){
                $permissionsArray = getAllPermissions($ci,$allPermissionIDs);
            }

        }
        return $permissionsArray;
    }
}

/**
 * @function getAllPermissionsIDs 
 */
if(!function_exists('getAllPermissionsIDs')){
    function getAllPermissionsIDs($ci,$rolesJson) {
        $permissionIdsArray = array();
        $roles = json_decode($rolesJson);

        if(is_array($roles) && !empty($roles)){
            foreach($roles as $key => $role){
                $where = array('id' => $role);
                $permissionIds = $ci->Common_model->select_fields_where($ci->tableNameRoles,'permission_id',$where,true);
                $permissionIdsJson = json_decode($permissionIds->permission_id);
                if(is_array($permissionIdsJson) && !empty($permissionIdsJson)){
                    foreach ($permissionIdsJson as $key => $permissionId) {
                        if(!in_array($permissionId,$permissionIdsArray) && !empty($permissionId)){
                            array_push($permissionIdsArray, $permissionId);
                        }
                    }
                }
            }
        }
        return $permissionIdsArray;
    }
}


/**
 * @function getAllPermissions 
 */
if(!function_exists('getAllPermissions')){
    function getAllPermissions($ci,$PermissionIds) {
        $permissionsArray = array();
        if(is_array($PermissionIds) && !empty($PermissionIds)){
            foreach($PermissionIds as $key => $PermissionId){
                $where = array('id' => $PermissionId);
                $permissions = $ci->Common_model->select_fields_where($ci->tableNamePermission,'label,rights',$where,true);
                $permissionLabel = $permissions->label;
                $permissionRight = $permissions->right;
                if(!in_array($permissionLabel, $permissionsArray) && !empty($permissionLabel) ){
                    array_push($permissionsArray, $permissionLabel);
                }
            }
        }
        return $permissionsArray;
    }
}

/**
 * @function getAllUserRoles 
 */
if(!function_exists('getAllUserRoles')){
    function getAllUserRoles($ci) {
        $rolesArray = array();
        $rolesJson = $ci->session->userdata('userRole');
        $roles = json_decode($rolesJson);
        if(is_array($roles) && !empty($roles)){
            foreach($roles as $key => $role){
                $where = array('id' => $role);
                $RolesDB = $ci->Common_model->select_fields_where($ci->tableNameRoles,'Slug',$where,true);
                $RolesSlug = $RolesDB->Slug;
                if(!empty($RolesSlug)){
                    if(!in_array($RolesSlug,$rolesArray)){
                        array_push($rolesArray, $RolesSlug);
                    }
                }
            }
        }
        return $rolesArray;
    }
}

?>