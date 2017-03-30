<?php
/**
 * Created by PhpStorm.
 * User: COD3R
 * Date: 9/18/2015
 * Time: 12:04 PM
 */

/**
 * @var Common_Model $Common_Model It resides all the methods which can be used in most of the controllers.
 * @property Common_Model $Common_Model It resides all the methods which can be used in most of the controllers.
 */
if(!function_exists('getUserProfile')) {
    function getUserProfile($userID,$Role)
    {
        if(!is_numeric($userID) || empty($userID)){
            return;
        }

        $ci =& get_instance();
        $ci->load->model('Common_Model');

        //Query To Load Menus For the Current User.
        switch($Role){
            case 'Admin':
                //Query To Get Profile Data From Admin Table
                $table = 'hms_administrator';
                $selectData = '*';
                $where = array('UserID'=>$userID);
                break;
            case 'Accountant':
                //Query To Get Data from Accountant table.
                $table = 'hms_accountant';
                $selectData = '*';
                $where = array('UserID'=>$userID);
                break;
            case 'Laboratorist':
                //Query To Get Data from Accountant table.
                $table = 'hms_laboratory_technician';
                $selectData = '*';
                $where = array('UserID'=>$userID);
                break;
            case 'Pharmacist':
                //Query To Get Data from Pharmacist table.
                $table = 'hms_pharmacist';
                $selectData = '*';
                $where = array('UserID'=>$userID);
                break;
            case 'Consultant':
                //Query To Get Data from Doctor table.
                $table = 'hms_doctor';
                $selectData = 'ID, UserID, Name AS FullName, Speciality, ContactNo, ConsultancyFee, IsActive, IsEnabled';
                $where = array('UserID'=>$userID);
                break;
            default:
                return false;
        }

        //Finally Executing the Query
        $userProfile = $ci->Common_Model->select_fields_where($table,$selectData,$where,TRUE);
        return $userProfile;
    }
}