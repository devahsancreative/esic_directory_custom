<?php 
class Investor_model extends MY_Model{
    private $tableCurrent   = 'esic_investors';
    function __construct(){
        parent::__construct();
        $this->load->library('Datatables');
    }
    private function UserIDWhere(){
        $where = $this->getUserWhere();
        $this->db->where($where);
    }
    public function count(){
        $where = $this->getUserWhere();
        return $this->Common_model->count_rows($this->tableCurrent,$where);
    }
	public function mail_exists($key)                   // investor registoration form check email     
    {
      $this->db->where('email',$key);
      $query = $this->db->get('esic_investor');
      if ($query->num_rows() > 0){
         return true;
         }
      else{
         return false;
      }
     }	  
	public function update_Investor_status($tbl, $id){   // change investor status 
		$this->db->where('fk_investor_ID',$id);
		$query  = $this->db->get($tbl);
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
		$this->db->where('fk_investor_ID',$id);	
		$this->db->update($tbl, $data);
		return true;
	
	
	} 	
public  function delete_Investor($id=NULL)           //admin panel delete investor
    {
        if(!empty($id))
        {
            $this->db->where('fk_investor_ID',$id);
			$this->db->delete('esic_investor');
			$this->db->where('userID',$id);
			 
        }
        if($this->db->delete('hoosk_user'))
        {
            return $this->db->affected_rows();
        }
    }	
  
public function get_investor_data($tbl,$id=NULL)  // get sigle investor data  for edit investor file admin 
	{
	    $this->db->select('*');
		$this->db->from('hoosk_user');
		$this->db->join('esic_investor', 'hoosk_user.userID = esic_investor.fk_investor_ID','left');
		$this->db->where('hoosk_user.userID',$id);
		$query = $this->db->get();
        return $query->result();
	 }
public function get_investor_social($id=NULL)   // get sigle investor socail link  data  for edit investor file admin 
	{
	    $this->db->where('fk_user_id',$id);
		$query = $this->db->get('investor_social');
		return $query->result();
	 }	 
	 
public function password_check($id=NULL,$pass=NULL)
    {
	 $this->db->where('userID',$id);
	 $this->db->where('password',$pass);
	 $query  = $this->db->get('hoosk_user');
	  if ($query->num_rows() > 0)
	    {
        return "1";
        }
    else{
        return "0";
       }
	}
public function update_security($id=NULL,$email=NULL,$pass=NULL,$cpass=NULL)
    {
		$this->db->where('userID',$id);
		$this->db->where('password',$cpass);
		if(isset($pass) && !empty($pass))
		   { 
			$data=array(
			'password'=>$pass,
			'email'=>$email 
			);
		   }
		else{
			$data=array(
		      'email'=>$email
		    );
			}
		$this->db->update('hoosk_user', $data);
		return "ok";
	 
	} 
	
	
public function update_social($id=NULL,$data=NULL)
       {
		$this->db->where('fk_user_id',$id);
		$this->db->update('investor_social',$data);
		return "ok";
	   } 	
	 
public function update_question($id=NULL,$data=NULL)
       {
		$this->db->where('fk_investor_ID',$id);
		$this->db->update('esic_investor',$data);
		return "ok";
	   }
public function update_company_detail($id=NULL,$data=NULL)  //use for user name email and address  
       {
		$this->db->where('fk_investor_ID',$id);
		$this->db->update('esic_investor',$data);
		return "ok";
		   
	   }	 
	    
public function update_company_situation($id=NULL,$data=NULL)
       {
		$this->db->where('fk_investor_ID',$id);
		$this->db->update('esic_investor',$data);
		return "ok";
		   
	   }
public function  update_certificate	($id=NULL,$data=NULL) // use to udate both user profile and certificate
       {
		$this->db->where('fk_investor_ID',$id);
		$this->db->update('esic_investor',$data);
		return "ok";
		   
	   }
public function update_user_about($id=NULL,$data=NULL,$input_id=NULL) //update first name and last name and about
       {
		if($input_id == '3'){
			 $this->db->where('fk_investor_ID',$id);
		     $this->db->update('esic_investor',$data);
		     return "ok";
			 }
		 else{
			 $this->db->where('userID',$id);
		     $this->db->update('hoosk_user',$data);
		     return "ok";
			 }	 
	   
		   	   
       }
}
?>