<?php echo $header; ?>
<link href="https://ctsdemo.com/demos/esic_directory/assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<div class="container-fluid">
<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice{ color:#333 !important}
.userlink {
	font-weight: bold;
	 }
.panel-footerer.comment_section {
    margin: 20px auto;
    padding: 12px 30px;
}	 
.pubdate{
	 color: #777; 
	 }
.reply_message {
    margin-left: 100px;
}
.blog{
	 margin-top:70px;
	 margin-bottom:70px;
	
	}
.blog-content{
	text-align: justify;
    clear: both;
    margin-bottom: 15px;
}
.paragraph p{
	color: #999;
	line-height: 2;
    padding: .5em 0;
	margin: 0;
	font-size: 16px;
	}
.paragraph_footer p{
	color: #999;
	 font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
	 }
.blog-date{
	font-size: 13px;
    float: left;
    margin: 0 !important;
    padding: 0 !important;
    line-height: 1;
	display: block;
	}
.date-text{
    cursor: pointer;
    float: left;
    margin: 0 8px 0 0;
    padding: 0 0 4px 0;
}
.blog-comments{
	float: right;
    margin: 0 !important;
    padding: 0 0 4px 0 !important;
    line-height: 1;
	font-size:13px;
	}
.blog-list li{
	cursor: pointer;
	text-decoration:none;
	line-height: 1;
	display: block;
	margin-top:10px;
	}	
.blog-list li a{
	cursor: pointer;
	text-decoration:none;
	line-height: 1;
	display: block;
	margin-top:16px;
	
	}	
.Latest-Blogs{
	margin-left: 39px;
	}
.blog-post-separator {
    margin-top:   17px;
	margin-bottom:17px;
    border-bottom: 3px solid #efefef;
}
.blog-separator {
    margin: 10px;
}
.btn-reply{
	margin-left: 20px;
   margin-bottom: 20px !important;
    background-color: #626262 !important;;
	}	 
.blog_side_bar{
	position:fixed !important;
	right:0;
 }	  		
</style>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                
                <?php if($blog_data){echo $blog_data->title;}else{ echo "Add New Blog"; }?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="<?= base_url()?>admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li>
                <i class=""></i>
                	<a href="<?= base_url()?>admin/blog"><?php echo "Manage Blogs"; ?></a>
                </li>
                <li class="active">
                <i class=""></i>
                	<?php if($blog_data){echo "Edit"." ".$blog_data->title;}else{ echo "Add New Blog"; }?>
                </li>
            </ol>
        </div>
    </div>
</div>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-wysiwyg/0.3.3/bootstrap3-wysihtml5.css" integrity="sha256-vZaxbFq+7enj8wcy4kYnymKZuYhDaGHBhuuts0C2x+I=" crossorigin="anonymous" />-->
<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class=""></i>
                   <?php if($blog_data){echo $blog_data->title;}else{ echo "Add New Blog"; }?>
                </h3>
            </div>
            
         <div class="panel-body">
         
		<?php if($this->session->userdata('errormsg')){?>
			<div class="alert alert-danger">
			  <?php 	echo  $this->session->userdata('errormsg');
				        $this->session->unset_userdata('errormsg');
				
				?>     </div>
			<?php }
			     if(isset($blog_data->id))
			            {
				   
				         echo form_open(BASE_URL.'/admin/blog/insert_blog'."/".$blog_data->id);
				        }
				   else{
					    echo form_open(BASE_URL.'/admin/blog/insert_blog');
					   }
			     ?>
                
                <div class="form-group">
                  		
                <?php echo form_error('username', '<div class="alert alert-danger">', '</div>'); ?>									
					<label class="control-label" for="username">Title</label>
					<div class="controls">
               
                    <input type="text" name="title" class="form-control" 
                    value="<?php if(isset($blog_data->title)){echo $blog_data->title;}?>" placeholder="Title">   
			        </div> 
                  				
				</div> 
             
               
              
              <div class="form-group">		
                 									
					<label class="control-label" for="username">Description</label>
					<div class="controls">
                    <textarea name="description" class="form-control" id="mytextarea" >
					<?php if(isset($blog_data->description)){echo $blog_data->description;}?></textarea>   
			        </div>  			
				</div>  
			
             
               <div class="form-group">		
                 	<div class="col-md-6 col-sm-12">								
					<label class="control-label" for="Tags">Tags</label>
					<div class="controls">
                       <select id="tags" multiple="multiple" class="form-control" name="tags[]">
                       
                       <?php if($blog_data->tags){ 
					   
					        $tags = explode(",", $blog_data->tags);
							  foreach($tags as $tags_list){
									  
									  ?><option value="<?= $tags_list?>" selected="selected"> <?= $tags_list ?></option><?php 
									  }
								  }
					   ?>
                       
                        </select>
							<script>
                            $('#tags').select2({
                            data: [],
                            tags: true,
                            tokenSeparators: [','], 
                            placeholder: "Add your tags here" 
                        });
                            </script>

                           
                       </div>
     				 </div> 
                  </div> 
               <div class="form-group">		
                 	<div class="col-md-6 col-sm-12">								
					<label class="control-label" for="Status">Status</label>
					<div class="controls">
             <select name="status" class="form-control">
                <option value="1" 
				<?php  
				     if(($blog_data->status == "Published") || (empty($blog_data->status)))
				       {
						   echo "selected";} ?>
                           >Published
                </option>
                <option value="0" 
                 <?php  if((isset($blog_data->status))&&($blog_data->status == "Pending")){echo "selected";} ?>>Pending</option>
                    </select>
					<?php if(isset($blog_data->description)){  $blog_data->description;}?></textarea>   
			        </div>  			
				</div> 
               </div>
			 </div>
             </div>
             
                <div class=" ">
             <input type="submit" class="btn btn-primary" 
             value="<?php if(isset($blog_data)){echo "Update";}else{echo "Send";}?>">
				</div>  
               <?php  echo form_close(); ?>
              
 <!---------------------------------------------------  Mange Comments  ----------------------------------------------------->
   <?php   if($comments_data){ ?>
 <div class="panel-footerer comment_section panel panel-default panel-body">
    <div class="row">
        <div class="col-lg-12">
             
            
           <div class="blog-content">
				<div class="paragraph">
                  <h1 class="page-header"> Comments </h1>  
                  
                   <?php 
				    foreach($comments_data as $comments ){?>
                      <div class="comments_block">
                         <header><a   class="userlink"><?= $comments->name;?></a> - <span class="pubdate">Posted
                           <?= $comments->comment_date;?></span>
                            <a  id="<?=$comments->id ?>" class="trash"><i data-toggle="tooltip" title="Remove Comment" 
                            data-placement="left"class="fa fa-trash-o text-red pull-right"></i></a>
                            
                           
                           
           <a  id="<?=$comments->id ?>" class="change_status" status="<?= $comments->status;?>">
                     <?php  
						 if($comments->status==0)
						 {    ?>
                                <small   class="status-div pending label pull-right bg-red" data-toggle="tooltip" title="Change Status" 
                                data-placement="left"> Pending </small><?php
						 }else{
							  ?>
                               <small   class="status-div published label pull-right bg-green" data-toggle="tooltip" title="Change Status" 
                               data-placement="left" > Published </small><?php
							 
							  }
							
							
							?>
      </a>
                            
                            
                            
                          </header>
                               <p class="comment">
                                      <?php echo   $comments->comment; ?>
                                      <h6 class="wsite-content-title" style="text-align:left; CURSOR: pointer;" 
                                      id="<?= $comments->id ?>"></h6>
                                     <div class="blog-post-separator"></div>
                               </p>
                     </div>
                            
     <?php if($esic_comment_reply){  
          foreach($esic_comment_reply as $replys){  
		   if($replys->comment_id == $comments->id){ ?>
                <div class="reply_message">
                  
                   <header><a class="userlink">
					 
					 <?= $replys->name;?></a> - <span class="pubdate">Posted  <?= $replys->comment_date;?></span>
                   
                     <a id="<?=$replys->id ?>"  class="trash_reply"><i data-toggle="tooltip" title="Remove Comment" 
                      data-placement="left"class="fa fa-trash-o text-red pull-right"></i>
                     </a>
                  
         <a id="<?=$replys->id ?>" class="change_status_reply" status="<?= $replys->status ?>">
                    
					 
                     <?php  
						 
						 if($replys->status==0)
						 {    ?>
                                <small class="status-div label pull-right bg-red" data-toggle="tooltip" title="Change Status" 
                                data-placement="left" id="pending"> Pending </small><?php
						 }else{
							  ?>
                               <small class="status-div label pull-right bg-green" data-toggle="tooltip" title="Change Status" 
                               data-placement="left" id="published"> Published </small><?php
							 
							  }
							
							
							?>
   </a>
                     
                     
                  </header>
                  
                  <p class="comment">
                       <?php echo   $replys->comment; ?>
                       <h6 class="wsite-content-title" style="text-align:left; CURSOR: pointer;" id="<?= $replys->id ?>"></h6>
                       <div class="blog-post-separator">
                 </p> 
            </div></div>
                 
        <?php }}?>
        <?php   }?> 
        <?php   }?> 
     </div>   
 </div>
 <div  id="comments_f"></div>

            </div>
			</div>
       </div>     
     <?php  }?>        
   <!--------------- ----------------  End  Mange Comments section   -----------------------------------------------------> 
               
               
            </div>
		</div>
	</div>



<div class="modal change-status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Blog Published / UnPublished</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Are You Sure To Change Blog Status ?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="yeschange">Yes</button>
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close" id="nodelete">No</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

 <?php echo $footer; ?></div>
 <script src='<?php  echo base_url()?>assets/tinymce/js/tinymce/tinymce.min.js'></script>
 <script src='https://tinymce.cachefly.net/4.0/plugins/jbimages/plugin.min.js'></script>
  <script>
 tinymce.init({
  selector: 'textarea',
  height: 300,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | media',
  content_css: '//www.tinymce.com/css/codepen.min.css'
});


 $(document).ready(function(){
 $(".trash").on("click", function () { 
      var del_id= $(this).attr('id');
		 $.ajax({
            type:'POST',
            url:'<?= base_url();?>admin/blog/delete_comments',
            data:{del_id:del_id},
		   success: function(data){
                  if(data=="YES"){
                   $('#'+del_id).parents(".comments_block").remove();
					
                 }else{
                        alert("can't delete the row")
                 } 
             }

            });
        });
$(".trash_reply").on("click", function () { 
      var del_id= $(this).attr('id');
		 $.ajax({
            type:'POST',
            url:'<?= base_url();?>admin/blog/delete_comments_reply',
            data:{del_id:del_id},
		   success: function(data){
                  if(data=="YES"){
                   $('#'+del_id).parents(".reply_message").remove();
					
                 }else{
                        alert("can't delete the row")
                 } 
             }

            });
        });	
		
$(".change_status").on("click", function () { 
      var del_id= $(this).attr('id');
	  var this1 = $(this);
	  var status= $(this).attr('status');
	    $.ajax({
            type:'POST',
            url:'<?= base_url();?>admin/blog/change_comment_status',
            data:{del_id:del_id,status:status},
		    success: function(data){
                  if(data=='0'){
					           this1.find('.status-div').text('Pending');
							   this1.find('.status-div').removeClass('bg-green')
                               this1.find('.status-div').addClass('bg-red');
							   this1.attr("status",0);
                             }else{   //show published
						            this1.find('.status-div').text('Published');
									this1.find('.status-div').removeClass('bg-red')
                                    this1.find('.status-div').addClass('bg-green');
									this1.attr("status",1);
						           }
			 }

            });
        });
$(".change_status_reply").on("click", function () { 
      var del_id= $(this).attr('id');
	  var status= $(this).attr('status');
	  var this1 = $(this);
	    $.ajax({
            type:'POST',
            url:'<?= base_url();?>admin/blog/change_comments_reply_status',
            data:{del_id:del_id,status:status},
		   success: function(data){
                  if(data=='0'){
					           this1.find('.status-div').text('Pending');
							   this1.find('.status-div').removeClass('bg-green')
                               this1.find('.status-div').addClass('bg-red');
							   this1.attr("status",0);
                             }else{   //show published
						            this1.find('.status-div').text('Published');
									this1.find('.status-div').removeClass('bg-red')
                                    this1.find('.status-div').addClass('bg-green');
									this1.attr("status",1);
						           }
			  }

            });
        });			
		
});		
  </script>
 



