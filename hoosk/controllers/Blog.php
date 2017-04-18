<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends MY_Controller {

	function __construct()
	{
		 parent::__construct();
		define("HOOSK_ADMIN",1);
		$this->load->model('Hoosk_model');
		$this->load->model('common_model');
        $this->load->model('Hoosk_page_model');
		$this->load->helper(array('admincontrol', 'url', 'hoosk_admin'));
		$this->load->library('session');
		define ('LANG', $this->Hoosk_model->getLang());
		$this->lang->load('admin', LANG);
		//Define what page we are on for nav
		$this->data['current'] = $this->uri->segment(2);
		define ('SITE_NAME', $this->Hoosk_model->getSiteName());
		define('THEME', $this->Hoosk_model->getTheme());
		define ('THEME_FOLDER', BASE_URL.'/templates/'.THEME);

            // use for Header And Footer
        $totSegments = $this->uri->total_segments();
        if(!is_numeric($this->uri->segment($totSegments))){
            $pageURL = $this->uri->segment($totSegments);
        } else if(is_numeric($this->uri->segment($totSegments))){
            $pageURL = $this->uri->segment($totSegments-1);
        }
        if ($pageURL == ""){ $pageURL = "home"; }
        $this->data['page']=$this->Hoosk_page_model->getPage($pageURL);

        $this->data['settings']=$this->Hoosk_page_model->getSettings();// use for header title
        $this->data['settings_footer'] = $this->Hoosk_model->getSettings(); //use for footer
	}
 public function index(){
	    $userRole = $this->session->userdata('userRole');
	    //Get the min and max dates from the blog
     $data = [];
     $data = array('min(`date`) as minDate, max(`date`) as maxDate',false);
        $data['minMaxDate'] = $this->common_model->select_fields('esic_blog',$data, true);
		if($userRole == 1){
	    $this->show_admin('blog/blog',$data);
	    return NULL;
		}
		else{
			 $this->load->view('admin/page_not_found');
			}
  
  
  }
 public function show($param = NULL){  
      Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
      $userRole = $this->session->userdata('userRole');
	  if($userRole == 1){
     
      if($param === 'listing'){
            $selectData = array('

           id AS ID,
           `title` AS Title,
		   `author` As Author,
		   tags AS Tags,
		    `date` AS Date,
		   CASE WHEN status = 1 THEN CONCAT("<span class=\'label status label-success\'> Published </span>") WHEN status = 0 THEN CONCAT ("<span class=\'label status label-danger\'>Pending</span>") ELSE CONCAT ("<span class=\'label status label-warning\'> ", status, " </span>") END AS Status
		   ',false);
			  
 
 $addColumns = array(

                'ViewEditActionButtons' => array('<a href="'.BASE_URL.'/blog/$1/view_blog_detail" target="_blank"
><i  data-placement="left" data-toggle="tooltip" title="View Blog" class=" ml-fa fa fa-eye fa-6  " text-success></i></a><a href="#" data-target=".change-status" data-toggle="modal"><i data-toggle="tooltip" title="Change Status" data-placement="left" class="fa fa-check ml-fa"></i></a><a href="'.BASE_URL.'/admin/blog/add_blog/$1" id="edit"><i data-toggle="tooltip" title="Edit Blog" data-placement="left"  class="fa fa-pencil ml-fa"></i></a><a href="#" data-target=".approval-modal-forstatus" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="left"  class="fa fa-trash-o text-red ml-fa"></i></a>','ID')

            );
            $where = '';
            $postedDateRange = $this->input->post('dateRange');
            if(!empty($postedDateRange)){
                $datesArray = explode(' - ',$postedDateRange);
                $dateStart = date('Y-m-d', strtotime($datesArray[0]));
                $dateEnd = date('Y-m-d', strtotime($datesArray[1]));

                $where = 'CAST(eb.`date` AS DATE) BETWEEN "'.$dateStart.'" AND "'.$dateEnd.'"';
            }

			$returnedData = $this->Common_model->select_fields_joined_DT($selectData,'esic_blog eb','',$where,'','','',$addColumns);
            print_r($returnedData);
           
            return NULL;

        }

        if($param === 'allvalues'){

            $returnedData = $this->Common_model->select('esic_blog');

            echo json_encode($returnedData);

            return NULL;

        }
		   if($param === 'delete'){
            if(!$this->input->post()){
                echo "FAIL::No Value Posted";
                return false;
            }

            $id = $this->input->post('id');
            $value = $this->input->post('value');

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

                $returnedData = $this->Common_model->delete('esic_blog',$whereUpdate);
                echo "OK::Record Deleted";
            }else{
                echo "FAIL::Record Not Deleted";
            }
            return NULL;
        }
        if($param === 'status'){

            if(!$this->input->post()){

                echo "FAIL::No Value Posted";

                return false;

            }



            $id = $this->input->post('id');

            $value = $this->input->post('value');



            if(empty($id) or !is_numeric($id)){

                echo "FAIL::Posted values are not VALID";

                return NULL;

            }



            if(empty($value)){

                echo "FAIL::Posted values are not VALID";

                return NULL;

            }

            $data='';

            if($value == 'status'){



                $whereUpdate = array(

                    'id' => $id

                );
				 
               $returnedData = $this->Common_model->update_blog_status('esic_blog',$id);

                echo "OK::Status Change";

            }else{

                echo "FAIL::Status Not Change";

            }

            return NULL;

        }
		 
          $this->show_admin('blog/blog');
          return NULL;

    }
     else{
		 $this->load->view('admin/page_not_found');
         }
}
 public function add_blog($id = NULL){   //add and edit blog form  
	   
	    Admincontrol_helper::is_logged_in($this->session->userdata('userName'));
		
		$userRole = $this->session->userdata('userRole');
		if($userRole == 1){
		 $this->load->helper('form');
		 if($id)
    		{
			$this->data['blog_data']          = $this->common_model->get_blog_data($id);
			$this->data['comments_data']      = $this->common_model->get_comments_data_ad('esic_comment',$id); //for comment
	    	$this->data['esic_comment_reply'] = $this->common_model->esic_comment_reply_ad('esic_comment_reply',$id);//for comment replay
			}
		
		$this->data['header'] = $this->load->view('admin/header', $this->data, true);
		$this->data['footer'] = $this->load->view('admin/footer', '', true);
		$this->load->view('blog/add_blog', $this->data);
		}
		else{
			 $this->load->view('admin/page_not_found');
			}
	 }	
	
	public function insert_blog($id=NULL) {
	  
	  $author      = $this->session->userdata('userName'); 
	  $title       = $this->input->post('title');
	  $description = $this->input->post('description');
	  $tags        = $this->input->post('tags');
	  $status      = $this->input->post('status');
	  if(isset($tags)){
	  $tags        = implode(",",$tags);     
      }
	   $insert = array(
						 'title'       => $title,
//						 'date'        => date("F j, Y, g:i a"),
						 'date'        => date('Y-m-d H:i:s'),
						 'author'      => $author,
						 'description' => $description,
						 'tags'        => $tags,
						 'status'      => $status
						 
		                );
		if(isset($id))
		    {
			$whereUpdate = array('id' => $id);
			$update = $this->common_model->update('esic_blog',$whereUpdate,$insert);
			if($update) 
				{ 
				 $this->session->set_userdata('msg','Thank you. Your Blog has been Updated Successfully');
				 header('Location:'.base_url().'admin/blog');
				}
	        else
			    {
				$this->session->set_userdata('errormsg','Error. Some Thing Happend Wrong Please Try Again');
				header('Location:'.base_url().'admin/blog/add_blog/'.$id);
			   } 
			}
	   else{				
	   		$inserted = $this->common_model->insert_blog_data('esic_blog',$insert);
	        if($inserted) 
				{ 
				 $this->session->set_userdata('msg','Thank you. Your Blog has been added Successfully');
				 header('Location:'.base_url().'admin/blog');
			     }
	        else {
				 $this->session->set_userdata('errormsg','Error. Some Thing Happend Wrong Please Try Again');
				 header('Location:'.base_url().'admin/blog/add_blog');
		         } 
	       }
   }
/*public function lists(){ //display list of blogs on front page 
	    $this->data['blog_data']       = $this->common_model->get_blog_lists(); 
	    $this->load->view('structure/header');
        $this->load->view("blog/blog_list",$this->data);
		$this->load->view('structure/footer');
	 }*/
public function lists(){ //display list of blogs on front page 
        
	  $this->load->library('pagination');
	  $config['total_rows']          = $this->common_model->count_blogs();  //total 10
	  $this->data['total_rows']          = $this->common_model->count_blogs();  //total 10
	  $config['base_url'] = base_url()."blog/lists";
	  $config['per_page'] = 3;
	  $config['uri_segment'] = '3';
	
	  $config['full_tag_open'] = '<ul class="pagination">';
	  
	
	  $config['first_link'] = '« First';
	  $config['first_tag_open'] = '<li class="page-item">';
	  $config['first_tag_close'] = '</li>';
	
	  $config['last_link'] = 'Last »';
	  $config['last_tag_open'] = '<li class="page-item">';
	  $config['last_tag_close'] = '</li>';
	
	  $config['next_link'] = 'Next →';
	  $config['next_tag_open'] = '<li class="page-item">';
	  $config['next_tag_close'] = '</li>';
	
	  $config['prev_link'] = '← Previous';
	  $config['prev_tag_open'] = '<li class="page-item">';
	  $config['prev_tag_close'] = '</li>';
	
	  $config['cur_tag_open'] = '<li class="active"><a href="">';
	  $config['cur_tag_close'] = '</a></li>';
	
	  $config['num_tag_open'] = '<li class="page">';
	  $config['num_tag_close'] = '</li>';
	  $config['full_tag_close'] = '</ul>';
	 
	  $this->pagination->initialize($config);
		
	  $this->data['blog_data']       = $this->common_model->get_blog_lists(3,$this->uri->segment(3));
	  $this->data['blog_list']       = $this->common_model->get_blog_lists_sidebar();


	  $this->load->view('structure/header',$this->data);
      $this->load->view("blog/blog_list",$this->data);
	  $this->load->view('structure/footer');
	 }
	 
	 
public function details($p1=NULL,$p2=NULL){//display single blogs 
	   
		 
	    $where = array('id' => $p1);
	    $this->data['blog_data']          = $this->common_model->get_record_where('esic_blog',$where);
		$this->data['blog_all_data']      = $this->common_model->get_blog_lists();  
		$this->data['comments_data']      = $this->common_model->get_comments_data('esic_comment',$p1); 
		$this->data['esic_comment_reply'] = $this->common_model->esic_comment_reply('esic_comment_reply',$p1);

		
		$this->load->view('structure/header',$this->data);
        $this->load->view("blog/single",$this->data);
		$this->load->view('structure/footer');
	}


public function insert_comment(){
	 
      
	  $name          = $this->input->post('name');
	  $email         = $this->input->post('email');
	  $website       = $this->input->post('website');
	  $comment       = $this->input->post('comment');
	  $blog_id       = $this->input->post('blog_id'); 
	  $blog_title    = $this->input->post('blog_title');
	  $blog_link     = $this->input->post('blog_link');
	  $comment_id    = $this->input->post('comment_id');
	   
	  //Email 
	   
      $subject     =  'Thank you. Your Comment on '.'   '.$blog_title.' has been submitted Successfully';
      $message     =  'Hi'."         ".$name."         ".'Thank you. Your Comment has been submitted Successfully';
	  $siteEmail   = $this->data['settings'] = $this->Hoosk_model->getSettings();
      $from_email  = $siteEmail[0]['siteEmail']; 
	  $this->load->library('email'); 
		 
	  $config = array();
      $config['useragent']   = "CodeIgniter";
      $config['protocol']    = "smtp";
      $config['smtp_host']   = "gator3083";
      $config['smtp_port']   = "25";
      $config['mailtype']    = 'html';
      $config['charset']     = 'utf-8';
      $config['newline']     = "\r\n";
      $config['wordwrap']    = TRUE; 
	  $this->email->initialize($config);
      $this->email->from($from_email, 'From: Esic Directory'); 
      $this->email->to($email);
      $this->email->subject($subject); 
      $this->email->message($message); 
      $this->email->send();
	  //Email
	  
	  if($comment_id){   //this is use to inser sub commment in sub comment table 
		  
		  $insert = array(
						 'name'           => $name,
						 'blog_id'        => $blog_id,
						 'comment_date'   => date("F j, Y, g:i a"),
						 'email'          => $email,
						 'website'        => $website,
						 'comment'        => $comment,
						 'blog_title'     => $blog_title,
						 'blog_link'      => $blog_link,
						 'comment_id'     => $comment_id
						 );
		  $inserted = $this->common_model->insert_record('esic_comment_reply',$insert);
	       
		  if($inserted) 
				{ 
				 $this->session->set_userdata('msg','Thank you. Your Comment has been submitted Successfully');
				 header('Location:'.base_url().'blog/'.$blog_id."/".$blog_link);
			     }
	        else {
				 $this->session->set_userdata('errormsg','Error. Some Thing Happend Wrong Please Try Again');
				 header('Location:'.base_url().'blog/'.$blog_id."/".$blog_link);
		         } 			 
		  }
		  // this is usee to insert comment in main  comment table 
	  else{  
	  $insert = array(
						 'name'           => $name,
						 'blog_id'        => $blog_id,
						 'comment_date'   => date("F j, Y, g:i a"),
						 'email'          => $email,
						 'website'        => $website,
						 'comment'        => $comment,
						 'blog_title'     => $blog_title,
						 'blog_link'      => $blog_link
						 
						 
		                );
		 
	   		 	
	   	    $inserted = $this->common_model->insert_record('esic_comment',$insert);
	        if($inserted) 
				{ 
				 $this->session->set_userdata('msg','Thank you. Your Comment has been submitted Successfully');
				 header('Location:'.base_url().'blog/'.$blog_id."/".$blog_link);
			     }
	        else {
				 $this->session->set_userdata('errormsg','Error. Some Thing Happend Wrong Please Try Again');
				 header('Location:'.base_url().'blog/'.$blog_id."/".$blog_link);
		         } 
	       } 
		   }

public function comments($param = NULL){ //display comments list in admin panel currently not in use 
	
	  if($param === 'listing'){
		  $selectData = array('
           id AS ID,
           `name` AS Name,
		   `blog_title` AS Blog_Title,
		   `email` AS Email,
		   `website` As Website,
		   `comment_date` As Date,
		   comment AS Comments,
		   CASE WHEN status = 0 THEN CONCAT("<span class=\'label status label-danger\'>Pending</span>") WHEN status = 1 THEN CONCAT ("<span class=\'label status label-success\'> Publishedd</span>") ELSE CONCAT ("<span class=\'label status label-warning\'> ", status, " </span>") END AS Status',false);
			  
  
 $addColumns = array(

                'ViewEditActionButtons' => array('&nbsp; <a href="#" data-target=".approval-modal2" data-toggle="modal"><i class="fa fa-check"></i></a> &nbsp; <a href="#" data-target=".approval-modal" data-toggle="modal"><i data-toggle="tooltip" title="Trash" data-placement="left"  class="fa fa-trash-o text-red ml-fa"></i></a>','ID')

            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData,'esic_comment','','','','','',$addColumns);

            print_r($returnedData);
           
            return NULL;

        }

        if($param === 'allvalues'){

            $returnedData = $this->Common_model->select('esic_comment');

            echo json_encode($returnedData);

            return NULL;

        }

        if($param === 'delete'){

            if(!$this->input->post()){

                echo "FAIL::No Value Posted";

                return false;

            }



            $id = $this->input->post('id');

            $value = $this->input->post('value');



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
               $returnedData = $this->Common_model->delete('esic_comment',$whereUpdate);

                echo "OK::Record Deleted";

            }else{

                echo "FAIL::Record Not Deleted";

            }

            return NULL;

        }
		 
          $this->show_admin('blog/comments');
          return NULL;

    }
	
public function delete_comments($id=NULL){
	$id = $this->input->post('del_id');
    $returnedData = $this->Common_model->delete_comments('esic_comment',$id);
	  
        echo "YES";
		return true;
	 
	 }
public function delete_comments_reply($id=NULL){
	$id = $this->input->post('del_id');
    $returnedData = $this->Common_model->delete_comments_reply('esic_comment_reply',$id);
	  
        echo "YES";
		return true;
	 
	 }
public function change_comment_status($id=NULL,$status=NULL){
	$id     = $this->input->post('del_id');
	$status = $this->input->post('status');
	$returnedData = $this->Common_model->change_comment_status('esic_comment',$id,$status);
	
	     
	    echo $returnedData; // return 0 or 1 
        return true;
	 
	 }	
	 
public function change_comments_reply_status($id=NULL,$status=NULL){
	$id     = $this->input->post('del_id');
	$status = $this->input->post('status');
    $returnedData = $this->Common_model->change_comments_reply_status('esic_comment_reply',$id,$status);
	  
	  echo $returnedData; // return 0 or 1
	  return true;
	 
	 }		 	 		 	
	}		    
		   
	 		 
  
