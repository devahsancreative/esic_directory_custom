<?php
/**
 * Created by PhpStorm.
 * User: COD3R
 * Date: 9/16/2015
 * Time: 4:23 PM
 */

/**
 * Class Common_model
 * @property CI_DB_driver $db
 * @property Datatables $datatables
 */

class common_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('Datatables');
    }

    // Select Queries
    function select($tbl = '', $array=false)
    {
        $query = $this->db->get($tbl);

        if($array===true){
            return $query->result_array();
        }
        return $query->result();
    }

    function select_fields($tbl = '', $data, $single = FALSE,$group_by = '',$order_by = '',$resultArray = false)
    {
        if(is_array($data)){
            $this->db->select($data[0],$data[1]);


        }else{
            $this->db->select($data);
        }

        if($group_by !== ''){
            $this->db->group_by($group_by);
        }
        if($order_by !== ''){
            if(is_array($order_by)){
                $this->db->order_by($order_by[0],$order_by[1]);
            }else{
                $this->db->order_by($order_by);
            }
        }


        $query = $this->db->get($tbl);
        //return $this->db->last_query();
        if ($query) {
            if ($single == TRUE) {
                if($resultArray === false) {
                    return $query->row();
                }elseif($resultArray === true){
                    return $query->row_array();
                }
            } else {
                if($resultArray === false){
                    return $query->result();
                }elseif($resultArray === true){
                    return $query->result_array();
                }
            }
        } else {
            return $this->db->error();
        }
    }

    /**
     * @param string $tbl
     * @param $data
     * @param $where
     * @param bool $single
     * @param string $like
     * @param string $field
     * @param string $value
     * @param string $group_by
     * @param string $order_by
     * @return array
     */
    function select_fields_where($tbl = '', $data, $where, $single = FALSE, $like = '', $field = '', $value = '',$group_by = '',$order_by = '',$array = false)
    {
        if(is_array($data) && isset($data[1])){
            $this->db->select($data[0],$data[1]);
        }else{
            $this->db->select($data);
        }

        $this->db->from($tbl);
        if ($like != '') {
            $this->db->like('LOWER(' . $field . ')', strtolower($value));
            $this->db->like($like);
        }
        $this->db->where($where);
        if($group_by != ''){
            $this->db->group_by($group_by);
        }
        if($order_by !== ''){
            if(is_array($order_by)){
                $this->db->order_by($order_by[0],$order_by[1]);
            }else{
                $this->db->order_by($order_by);
            }
        }
        $query = $this->db->get();
//return $this->db->last_query();
        if ($query->num_rows() > 0) {
// query returned results
            if ($single == TRUE) {
                if($array === true){
                    return $query->row_array();
                }else{
                    return $query->row();
                }
            } else {
                if($array === true){
                    return $query->result_array();
                }else{
                    return $query->result();
                }
            }
        } else {
// query returned no results
            return FALSE;
        }
    }

    function select_fields_where_like($tbl = '', $data, $where = '', $single = FALSE, $field, $value,$group_by = '',$order_by = '')
    {
        $this->db->select($data);
        $this->db->from($tbl);
        $this->db->like('LOWER(' . $field . ')', strtolower($value));
        if ($where != '') {
            $this->db->where($where);
        }
        if($group_by != ''){
            $this->db->group_by($group_by);
        }
        if($order_by !== ''){
            if(is_array($order_by)){
                $this->db->order_by($order_by[0],$order_by[1]);
            }else{
                $this->db->order_by($order_by);
            }
        }
        $query = $this->db->get();
//return $this->db->last_query();
        if ($query->num_rows() > 0) {
// query returned results
            if ($single == TRUE) {
                return $query->row();
            } else {
                return $query->result();
            }
        } else {
// query returned no results
            return FALSE;
        }
    }

    function select_fields_where_like_orLikes($tbl = '', $data, $where = '', $single = FALSE, $field, $value, $orLikes = '',$group_by = '')
    {
        $this->db->select($data);
        $this->db->from($tbl);
        $this->db->like('LOWER(' . $field . ')', strtolower($value));
        if($orLikes != '' and is_array($orLikes)){
            foreach($orLikes as $key=>$array){
                $this->db->or_like('LOWER('.$array['field'].')', strtolower($array['value']));
            }
        }
        if ($where != '') {
            $this->db->where($where);
        }
        if($group_by != ''){
            $this->db->group_by($group_by);
        }
        $query = $this->db->get();
//return $this->db->last_query();
        if ($query->num_rows() > 0) {
// query returned results
            if ($single == TRUE) {
                return $query->row();
            } else {
                return $query->result();
            }
        } else {
// query returned no results
            return FALSE;
        }
    }

    function select_fields_where_like_join($tbl = '', $data, $joins = '', $where = '', $single = FALSE, $field = '', $value = '',$group_by='',$order_by = '',$limit = '',$array = false)
    {
        if (is_array($data) and isset($data[1])){
            $this->db->select($data[0],$data[1]);
        }else{
            $this->db->select($data);
        }

        $this->db->from($tbl);

        //Fourth Param is For Escaping, i-e CI should use backTicks on a join or not.
        if ($joins != '') {
            foreach ($joins as $k => $v) {
                $this->db->join($v['table'], $v['condition'], $v['type'],(isset($v['escape'])?$v['escape']:TRUE));
            }
        }

        if ($value !== '') {
            $this->db->like('LOWER(' . $field . ')', strtolower($value));
        }

        if ($where != '') {
            $this->db->where($where);
        }
        if($group_by != ''){
            $this->db->group_by($group_by);
        }
        if($order_by != ''){
            if(is_array($order_by)){
                $this->db->order_by($order_by[0],$order_by[1]);
            }else{
                $this->db->order_by($order_by);
            }
        }
        if($limit != ''){
            if(is_array($limit)){
                $this->db->limit($limit[0],$limit[1]);
            }else{
                $this->db->limit($limit);
            }
        }

        $query = $this->db->get();

        if($query === FALSE ){
//            echo 'Database Error(' . $this->db->_error_number() . ') - ' . $this->db->_error_message();
            return FALSE;
        }

        if ($query->num_rows() !== NULL && $query->num_rows() > 0) {
            if ($single == TRUE) {
                if($array === true){
                    return $query->row_array();
                }else{
                    return $query->row();
                }
            } else {
                if($array === true) {
                    return $query->result_array();
                }else{
                    return $query->result();
                }
            }
        } else {
            return FALSE;
        }
    }

    function select_fields_where_like__orLikes_join($tbl = '', $data, $joins = '', $where = '', $single = FALSE, $field = '', $value = '', $orLikes = '', $group_by='',$order_by = '',$limit = '')
    {
        if (is_array($data) and isset($data[1])){
            $this->db->select($data[0],$data[1]);
        }else{
            $this->db->select($data);
        }

        $this->db->from($tbl);
        if ($joins != '') {
            foreach ($joins as $k => $v) {
                $this->db->join($v['table'], $v['condition'], $v['type']);
            }
        }
        if ($value !== '') {
            $this->db->like('LOWER(' . $field . ')', strtolower($value));
        }

        if($orLikes != '' and is_array($orLikes)){
            foreach($orLikes as $key=>$array){
                $this->db->or_like('LOWER('.$array['field'].')', strtolower($array['value']));
            }
        }

        if ($where != '') {
            $this->db->where($where);
        }
        if($group_by != ''){
            $this->db->group_by($group_by);
        }
        if($order_by != ''){
            if(is_array($order_by)){
                $this->db->order_by($order_by[0],$order_by[1]);
            }else{
                $this->db->order_by($order_by);
            }
        }
        if($limit != ''){
            if(is_array($limit)){
                $this->db->limit($limit[0],$limit[1]);
            }else{
                $this->db->limit($limit);
            }
        }
        $query = $this->db->get();
//        return $this->db->last_query();
//return $this->db->last_query();
        if ($query->num_rows() > 0) {
// query returned results
            if ($single == TRUE) {
                return $query->row();
            } else {
                return $query->result();
            }
        } else {
// query returned no results
            return FALSE;
        }
    }

//Common AutoComplete Queries
    function get_autoComplete($tbl, $data, $field, $value, $where = '', $group_by = false, $limit = '')
    {
        $this->db->select($data);
        $this->db->from($tbl);
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->like('LOWER(' . $field . ')', strtolower($value));
        if ($group_by == true) {
            $this->db->group_by($field);
        }
        if ($limit != '') {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function get_autoCompleteJoin($PTable, $joins = '', $where = '', $data, $field, $value, $group_by = false)
    {
        $this->db->select($data);
        $this->db->from($PTable);
        if ($joins != "") {
            foreach ($joins as $k => $v) {
                $this->db->join($v['table'], $v['condition'], $v['type']);
            }
        }
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->like('LOWER(' . $field . ')', strtolower($value));
        if ($group_by == true) {
            $this->db->group_by($field);
        }
        $query = $this->db->get();
//echo $this->db->last_query();
        return $query->result();
    }


    //------------------------ insert record queries -----------------------------------
    function insert_record($tbl, $data)
    {
        $this->db->insert($tbl, $data);
        return $this->db->insert_id();
    }


    //Insert Record If Don't Exist Else Update the Record
    function insert_slash_update($tbl, $data, $field, $id,$where){
        $this->db->where($where);
        $q = $this->db->get($tbl);
        if ( $q->num_rows() > 0 )
        {
            $this->db->where($field,$id);
            $this->db->update($tbl,$data);
            $affectedRows = $this->db->affected_rows();
            if($affectedRows){
                return TRUE;
            }else{
                return FALSE;
            }
        } else {
            $this->db->set($field, $id);
            $this->db->insert($tbl,$data);
            $insertedID = $this->db->insert_id();
            if($insertedID > 0){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }

    function insert_multiple($tbl, $data)
    {
        $query = $this->db->insert_batch($tbl, $data);
        return $query;
    }

    /**
     * @param $tbl
     * @param $data
     * @return bool
     */
    function insert_multiple_ignore_duplicate($tbl, $data){
        $this->db->trans_start();
        foreach ($data as $item) {
            $insert_query = $this->db->insert_string($tbl, $item);
            $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
            $this->db->query($insert_query);
        }
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    //------------------------End of insert record queries -----------------------------------
// Common Update Queries
    function update($tbl, $where, $data)
    {
		if(!empty($where)){
			
			$this->db->where($where);
			$this->db->update($tbl, $data);
			$affectedRows = $this->db->affected_rows();
			if ($affectedRows) {
				return true;
			} else {
				return $this->db->error();
			}
		}else{
			return 'OK:: Where IS Empty';
		}
    }

    function update_query($tbl, $field, $id, $data)
    {
        $this->db->where($field, $id);
        $this->db->update($tbl, $data);
        $affectedRows = $this->db->affected_rows();
        if ($affectedRows) {
            return TRUE;
        } else {
            return $this->db->error();
        }
    }

    function delete($table , $where=NULL)
    {
        if(!empty($where))
        {
            $this->db->where($where);
        }
        if($this->db->delete($table))
        {
            return $this->db->affected_rows();
        }
    }

    function update_query_array($tbl, $fields, $data)
    {
        $this->db->where($fields);
        $this->db->update($tbl, $data);
        $afftectedRows = $this->db->affected_rows();
        if ($afftectedRows) {
            return $afftectedRows;
        } else {
            return $this->db->_error_message();
        }
    }
//Common Update Queries End

    //Common DataTables Queries
    function  select_fields_joined_DT($data, $PTable, $joins = '', $where = '',$where_in_column ='', $where_in_data = '', $group_by = '', $addColumn = '', $editColumn = '',$unsetColumn = '')
    {

        if(is_array($data)){
            $this->datatables->select($data[0],$data[1]);
        }else{
            $this->datatables->select($data);
        }

        if ($unsetColumn != '') {
            $this->datatables->unset_column($unsetColumn);
        }
        $this->datatables->from($PTable);
        if ($joins != '') {
            foreach ($joins as $k => $v) {
                $this->datatables->join($v['table'], $v['condition'], $v['type']);
            }
        }
        if ($where != '') {
            if(is_array($where) && array_key_exists("QueryCondition",$where)){
                $this->datatables->where($where["QueryCondition"],$where[0],$where[1]);
            }else{
                $this->datatables->where($where);
            }
        }
        if($where_in_data !== ''){
            $this->datatables->where_in($where_in_column,$where_in_data);
        }
        if($group_by != ''){
            $this->datatables->group_by($group_by);
        }
        if ($addColumn != '') {
            foreach($addColumn as $columnKey=>$columnValue ) {
                if(!is_array($columnValue) && is_string($columnValue)){
                    $this->datatables->add_column($columnKey, $columnValue);
                }else{
                    $this->datatables->add_column($columnKey, $columnValue[0],$columnValue[1]);
                }
            }
        }
        if ($editColumn != ''){
            foreach($editColumn as $arrayKey=>$arrayValue){
                $this->datatables->edit_column($arrayValue[0],$arrayValue[1],$arrayValue[2]);
            }
        }
        $result = $this->datatables->generate();
        return $result;
    }

    //Importing of File Using Import Library Added To The Application..
    function Import_FileImportLibrary_CSV($table,$data){
        $this->db->insert($table, $data);
    }

    // Function for run query
    function get_query_record($query)
    {
        $result=$this->db->query($query);
        if($result->num_rows() > 0)
        {
            return $result;
        }
    }
    // End



    //Function For DropDowns. Updating The Classic Style From Parexons Company.
    function classic_dropdown($table, $option, $key, $value, $where){
        //Lets Put Little Checks On Required Parameters
        if(!isset($table) || empty($table)){
            return false;
        }
        if(!isset($option) || empty($option)){
            return false;
        }
        if(!isset($key) || empty($key)){
            return false;
        }
        if(!isset($value) || empty($value)){
            return false;
        }

        $this->db->select('*');
        $this->db->from($table);
        if($where !== ''){
            $this->db->where($where);
        }
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            $data[''] = $option;
            foreach($query->result() as $row)
            {
                $data[$row->$key] = $row->$value;
            }
            return $data;
        }
    }

    /// Dynamic Function For Drop Down With Select Option
    public  function dropdown_wd_option($table, $option, $key, $value, $where)
    {
        $this->db->select('*');
        $this->db->where($where);
        $query = $this->db->get($table);

        if($query->num_rows() > 0)
        {
            $data[''] = $option;
            foreach($query->result() as $row)
            {
                $data[$row->$key] = $row->$value;
            }
            return $data;
        }
    }

    public function insert_else_ignore($table,$data)
    {
        $query = $this->db->get_where($table,$data);
        $count = $query->num_rows(); //counting result from query

        if ($count === 0) {

            $this->db->insert($table, $data);
            return true;
        }
    }

    public function get_row_where($table,$data)
    {
        $this->db->where($data);
        $query = $this->db->get($table);
        //echo "<pre> query = "; print_r( $query  ); echo "</pre>";

        if($query->num_rows() > 0) //counting result from query
        {
            return true;
        }
    }
    function get_row_order_desc($tbl = '', $data, $single = FALSE,$order_by = '')
    {
        $this->db->select($data);
        $this->db->from($tbl);

        if($order_by !== ''){
            if(is_array($order_by)){
                $this->db->order_by($order_by[0],$order_by[1]);
            }else{
                $this->db->order_by($order_by);
            }
        }
        $query = $this->db->get();
//return $this->db->last_query();
        if ($query->num_rows() > 0) {
// query returned results
            if ($single == TRUE) {
                return $query->row();
            } else {
                return $query->result();
            }
        } else {
// query returned no results
            return FALSE;
        }
    }
    public function get_record_where($table,$where)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0) //counting result from query
        {
            return $query->row();
        }else{
            return false;
        }
    }
    //End of Common DataTables Queries
	
	
 public function Count_Tottle_Rows($tble=NULL){               //count total number of Contact Messaeges 
	      
   return $this->db->count_all_results($tble);
 }
 
 	

 public function insert_contact_data($tbl, $data)       
   {
	    $this->db->insert($tbl, $data);
        return $this->db->insert_id();
   }
public function get_contact_messages ($id=NULL){    //view single contact message
	  
	  $query = $this->db->get_where('esic_contact', array('id' => $id), "", "");
		 
	   if($query->num_rows() > 0) //counting result from query
         {
            return $query->row();
         }else{
            return false;
         }
	  }  
 
public function get_contact_single_messages_div ($id=NULL,$value=NULL){ // use for single contact email view next previous and delete
	 
	 if($value =="next")
		{
		  $query = $this->db->get_where('esic_contact', array('id >' => $id), "", "");
		}
	 elseif($value =="previous")
	    {
		  $query = $this->db->order_by('id', 'DESC')->get_where('esic_contact', array('id <' => $id), "", "");
		}
	else{   // when vlue is delete than show next row and delete previous one
	      $last_row = $this->db->select('id')->order_by('id',"desc")->limit(1)->get('esic_contact')->row();
		  $last_id  = $last_row->id;
		  
			  if($last_id == $id)  // if delete last row then get first record else show next record
				   {
					  $query    = $this->db->get_where('esic_contact', array('id <' => $id), "", "");
				   }
			   else
				   {
					  $query    = $this->db->get_where('esic_contact', array('id >' => $id), "", "");
				   }
		  
		   
		  // Delete data
		  $this->db->where('id', $id);
          $this->db->delete('esic_contact');
		}	
	      if($query->num_rows() > 0) //counting result from query
            {
            return $query->row();
            }else
			{
            return false;
            }
	  }	  
   
 public function insert_email_data($tbl, $data)
  {
	   
	    $this->db->insert($tbl, $data);
        return $this->db->insert_id();
 
  }
  
 public function get_sent_single_messages ($id=NULL){
	  
	    $query = $this->db->get_where('esic_email', array('id' => $id), "", "");
		 
	    if($query->num_rows() > 0) //counting result from query
         {
            return $query->row();
         }else{
            return false;
         }
	  }
 public function get_sent_single_messages_div ($id=NULL,$value=NULL){ // use for single sent email view next previous and delete
	 
	 if($value =="next")
		{
		  $query = $this->db->get_where('esic_email', array('id >' => $id), "", "");
		}
	 elseif($value =="previous")
	    {
		  $query = $this->db->order_by('id', 'DESC')->get_where('esic_email', array('id <' => $id), "", "");
		}
	else{   // when vlue is delete than show next row and delete previous one
	      $last_row = $this->db->select('id')->order_by('id',"desc")->limit(1)->get('esic_email')->row();
		  $last_id  = $last_row->id;
		  
			  if($last_id == $id)  // if delete last row then get first record else show next record
				   {
					  $query    = $this->db->get_where('esic_email', array('id <' => $id), "", "");
				   }
			   else
				   {
					  $query    = $this->db->get_where('esic_email', array('id >' => $id), "", "");
				   }
		  
		   
		  // Delete data
		  $this->db->where('id', $id);
          $this->db->delete('esic_email');
		}	
	      if($query->num_rows() > 0) //counting result from query
            {
            return $query->row();
            }else
			{
            return false;
            }
	  }	  
	  
 public function insert_blog_data($tbl, $data)
  {
	   
	    $this->db->insert($tbl, $data);
        return $this->db->insert_id();
 
  }
  
public function get_blog_data($id=NULL){
	   
	    $query = $this->db->get_where('esic_blog', array('id' => $id), "", "");
	    if($query->num_rows() > 0) //counting result from query
         {
            return $query->row();
         }else{
            return false;
         }
	 
	 }
	 
public function get_comments_data($tbl, $id){   // for front end 
	 
    $this->db->where('blog_id', $id);
	$this->db->where('status', 1);
	$query = $this->db->get('esic_comment');
	
	if($query->result_array() > 0) //counting result from query
         {
            return $query->result();
         }else{
            return false;
         }
	 }	 
 public function esic_comment_reply($tbl, $id){  //for front end 
	 
    $this->db->where('blog_id', $id);
	$this->db->where('status', 1);
	$query = $this->db->get('esic_comment_reply');
	
	if($query->result_array() > 0) //counting result from query
         {
            return $query->result();
         }else{
            return false;
         }
	 }
public function get_comments_data_ad($tbl, $id){   // admin panel edit blog section
	 
    $this->db->where('blog_id', $id);
	$query = $this->db->get('esic_comment');
	
	if($query->result_array() > 0) //counting result from query
         {
            return $query->result();
         }else{
            return false;
         }
	 }	 
 public function esic_comment_reply_ad($tbl, $id){ // admin panel edit blog section
	 
    $this->db->where('blog_id', $id);
	$query = $this->db->get('esic_comment_reply');
	
	if($query->result_array() > 0) //counting result from query
         {
            return $query->result();
         }else{
            return false;
         }
	 }	 
	 
public function get_blog_lists($limit=null,$offset=NULL){   // use for both pages blog lists and single blog page  
	
	$this->db->where('status', 1);
	$this->db->limit($limit, $offset);
	$query = $this->db->get('esic_blog');
	
	if($query->result_array() > 0) //counting result from query
         {
            return $query->result();
         }else{
            return false;
         }
	
	}
public function get_blog_lists_sidebar(){   // use to display sidebare blog title   
	
	$this->db->where('status', 1);
	$query = $this->db->get('esic_blog');
	
	if($query->result_array() > 0) //counting result from query
         {
            return $query->result();
         }else{
            return false;
         }
	
	}	
public function count_blogs(){               //count total number of blogs
	      $this->db->where('status', 1);
   return $this->db->count_all_results('esic_blog');
 }
 
 	
public function update_blog_status($tbl, $id){
		$this->db->where('id',$id);
		$query  = $this->db->get('esic_blog');
		$query  = $query->row();
		$status = $query->status;
		 
		if($status == 1)
		 { 
			$data=array(
			'status'=>0,
			);
		  }
		else{
			$data=array(
		       'status'=>1,
		    );
			}
		$this->db->where('id',$id);	
		$this->db->update($tbl, $data);
		return true;
	
	
	} 	

public function delete_comments($table , $id=NULL){
	  
	  
            $this->db->where('id',$id);
            $this->db->delete($table); 
            return $this->db->affected_rows();
   }
public function delete_comments_reply($table , $id=NULL){  //delete comments section 
	  
	  
            $this->db->where('id',$id);
            $this->db->delete($table); 
            return $this->db->affected_rows();
   }  
   
 public function change_comment_status($tbl, $id, $status){
		
	     if($status == 1)
		   { 
			 $data=array(
			 'status'=>0
			);
		   }
		else{
			 $data=array(
		       'status'=>1
		    );
			}
		$this->db->where('id',$id);	
		$this->db->update($tbl, $data);
		return $data['status'];
	
	
	} 	
public function change_comments_reply_status($tbl, $id, $status){
		
		 if($status == 1)
		   { 
			 $data=array(
			 'status'=>0
			);
		   }
		else{
			 $data=array(
		       'status'=>1
		    );
			}
		$this->db->where('id',$id);	
		$this->db->update($tbl, $data);
		return $data['status'];
		 
	}


	//Deprecated Useless Method :(
public function user_logo($userID=NULL,$userRole=NULL){
	
    if($userRole == "1"){
		$this->db->where("userID",$userID);
		$query  = $this->db->get('hoosk_user');
		}
	elseif($userRole == 2){
		$this->db->where("userID",$userID);
		$query  = $this->db->get('esic');}
	else{ 
	$this->db->where("fk_investor_ID",$userID);
	$query  = $this->db->get('esic_investor');} 
    if($query->result_array() > 0) //counting result from query
         {
            return $query->result();
         }else{
            return false;
         }
	}
public function save_darft($userID = NULL){

    $this->db->where("userID",$userID);
    $query  = $this->db->get('user_draft');
    $rec    = $query->num_rows();
    if($rec == 0) {

        $this->db->where("userID",$userID);
        $query  = $this->db->get('esic');
        if($query->result_array() > 0) {
        //  $rows = $query->result_array();
        foreach ($query->result_array() as $row) {
        $data = array(
            'userID'        => $row['userID'],
            'thumbsUp'      => $row['thumbsUp'],
            'company'       => $row['company'],
            'address'       => $row['address'],
            'street_number' => $row['street_number'],
            'post_code'     => $row['post_code'],
            'town'          => $row['town'],
            'state'         => $row['state'],
            'logo'          => $row['logo'],
            'bannerImage'   => $row['bannerImage'],
            'productImage'  => $row['productImage'],
            'business'      => $row['business'],
            'short_description' => $row['short_description'],
            'tinyDescription'          => $row['tinyDescription'],
            'score'                    => $row['score'],
            'status'         =>'1',
            'corporate_date' => $row['corporate_date'],
            'expiry_date'    => $row['expiry_date'],
            'added_date'     => $row['added_date'],
            'acn_number'     => $row['acn_number'],
            'website'        => $row['website'],
            'ipAddress'      => $row['ipAddress'],
            'sectorID'       => $row['sectorID'],
            'RnDID'          => $row['RnDID'],
            'AccCoID'        => $row['AccCoID'],
            'AccID'          => $row['AccID'],
            'inID'           => $row['inID'],
            'showExpDate'    => $row['showExpDate'],
            'Publish'        => '0',
            'P_C_no'         => $row['P_C_no'],
            'rights'         => $row['rights'],
            'innovation_right'             => $row['innovation_right'],
            'short_descriptionJSON' => $row['short_descriptionJSON'],
           );
            $this->db->insert('user_draft',$data);
            return true;
        }}
        return true;
   }else{

    return false;
}
 }
public function update_user_data($userID=NULL){ // not in use
        $this->db->where("userID",$userID);  // get record from draft to user table
        $query  = $this->db->get('user_draft');
        if($query->result_array() > 0) {
            foreach ($query->result_array() as $row) {
                $data = array(
                    'userID'        => $row['userID'],
                    'thumbsUp'      => $row['thumbsUp'],
                    'company'       => $row['company'],
                    'address'       => $row['address'],
                    'street_number' => $row['street_number'],
                    'post_code'     => $row['post_code'],
                    'town'          => $row['town'],
                    'state'         => $row['state'],
                    'logo'          => $row['logo'],
                    'bannerImage'   => $row['bannerImage'],
                    'productImage'  => $row['productImage'],
                    'business'      => $row['business'],
                    'short_description' => $row['short_description'],
                    'tinyDescription'          => $row['tinyDescription'],
                    'score'                    => $row['score'],
                    'status'         =>'1',
                    'corporate_date' => $row['corporate_date'],
                    'expiry_date'    => $row['expiry_date'],
                    'added_date'     => $row['added_date'],
                    'acn_number'     => $row['acn_number'],
                    'website'        => $row['website'],
                    'ipAddress'      => $row['ipAddress'],
                    'sectorID'       => $row['sectorID'],
                    'RnDID'          => $row['RnDID'],
                    'AccCoID'        => $row['AccCoID'],
                    'AccID'          => $row['AccID'],
                    'inID'           => $row['inID'],
                    'showExpDate'    => $row['showExpDate'],
                    'Publish'        => '1',
                    'P_C_no'         => $row['P_C_no'],
                    'rights'         => $row['rights'],
                    'innovation_right'             => $row['innovation_right'],
                    'short_descriptionJSON' => $row['short_descriptionJSON'],
                );
                $this->db->where("userID",$userID);
                $this->db->update('esic',$data);
                return true;
            }
        return true;
    }else{

        return false;
    }


}




public function publish_assessment_list($userID=NULL){
    $this->db->where("userID",$userID);  // get record from draft to user table
    $query  = $this->db->get('user_draft');
    if($query->result_array() > 0) {
        foreach ($query->result_array() as $row) {
            $data = array(
                'userID'        => $row['userID'],
                'thumbsUp'      => $row['thumbsUp'],
                'company'       => $row['company'],
                'address'       => $row['address'],
                'street_number' => $row['street_number'],
                'post_code'     => $row['post_code'],
                'town'          => $row['town'],
                'state'         => $row['state'],
                'logo'          => $row['logo'],
                'bannerImage'   => $row['bannerImage'],
                'productImage'  => $row['productImage'],
                'business'      => $row['business'],
                'short_description' => $row['short_description'],
                'tinyDescription'          => $row['tinyDescription'],
                'score'                    => $row['score'],
                'status'         =>'1',
                'corporate_date' => $row['corporate_date'],
                'expiry_date'    => $row['expiry_date'],
                'added_date'     => $row['added_date'],
                'acn_number'     => $row['acn_number'],
                'website'        => $row['website'],
                'ipAddress'      => $row['ipAddress'],
                'sectorID'       => $row['sectorID'],
                'RnDID'          => $row['RnDID'],
                'AccCoID'        => $row['AccCoID'],
                'AccID'          => $row['AccID'],
                'inID'           => $row['inID'],
                'showExpDate'    => $row['showExpDate'],
                'Publish'        => '1',
                'P_C_no'         => $row['P_C_no'],
                'rights'         => $row['rights'],
                'innovation_right'             => $row['innovation_right'],
                'short_descriptionJSON' => $row['short_descriptionJSON'],
            );
            $this->db->where("userID",$userID);
            $this->db->update('esic',$data);
            return true;
        }
        return true;
    }else{

        return false;
    }


}
}
