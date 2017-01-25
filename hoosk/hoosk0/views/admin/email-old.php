<?php echo $header; ?>

 <link href="https://ctsdemo.com/demos/esic_directory/assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice
    {
	 color:#333 !important;
    }
.select2-container
     {
	 width:100% !important;
	 }
</style>
 <!--<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo "Compose Email"; ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="<?= base_url()?>admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li>
                <i class="fa fa-fw fa-user"></i>
                	<a href="<?= base_url()?>admin/users"><?php echo "Select Users"; ?></a>
                </li>
                <li class="active">
                <i class="fa fa-envelope-o"></i>
                	<?php echo "Compose Email"; ?>
                </li>
            </ol>
        </div>
    </div>
</div>-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-wysiwyg/0.3.3/bootstrap3-wysihtml5.css" integrity="sha256-vZaxbFq+7enj8wcy4kYnymKZuYhDaGHBhuuts0C2x+I=" crossorigin="anonymous" />
<!--<div class="container-fluid">
  <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-envelope-o"></i>
                    <?php echo "Compose New Message"; ?>
                </h3>
            </div>
            
               <div class="panel-body">
         
		 <?php if($this->session->userdata('msg')){?>
            <div class="alert alert-success">
                <?php echo $this->session->userdata('msg');
                      $this->session->unset_userdata('msg');
            ?>
		 </div>
         <?php } if($this->session->userdata('errormsg')){?>
			<div class="alert alert-danger">
			  <?php 	echo  $this->session->userdata('errormsg');
				        $this->session->unset_userdata('errormsg');
				
				?>     </div>
			<?php } echo form_open(BASE_URL.'/admin/users/send_email');  ?>
                
                <div class="form-group">		
                <?php echo form_error('username', '<div class="alert alert-danger">', '</div>'); 
				
				
				             $user_email = $_POST['checked_id'];      // for multiple email 
						     $email      = $_POST['emailss'];         // for single email
								 
					//	if(isset($user_email) || (isset($email))){ // If email send after selecting user from user list then dis
				
				?>									
					<label class="control-label" for="username">To</label>
					<div class="controls">
                  
                    <?php /*?><input type="text" name="to" class="form-control" value="<?php if(isset($user_email))echo  $user_email;  if(isset($email)){echo $email;}?>" placeholder="Recipients"><?php */?>
                    
                    <?php print_r($user_email);
					echo $email;
					 ?>
                    
                    <select id="email" multiple="multiple" class="form-control" name="to[]">
                     <?php  if(isset($user_email)){
                             foreach($user_email as $user_emails){?>
                        
                        <option value="<?php echo  $user_emails;?>" selected="selected" >
						<?php echo  $user_emails;?></option>
                       
                        <?php }}else{?>
					     
                         <?php if(isset($email)){?>
                        <option value="<?php echo $email;?>" selected="selected" >
						<?php echo $email?></option>
                        
                        <?php }} ?>
                       
                        <?php if(isset($users_data)){
						   foreach($users_data as $users_datas){
						   ?>
                       			 <option value="<?= $users_datas->email ?>" ><?= $users_datas->email ?></option>
                         	 <?php } }?>
                           
                          
                    </select>
                    <script>
                            $('#email').select2({
                            data: [],
                            tags: true,
                            tokenSeparators: [','], 
                            placeholder: "Add your Emails here" 
                        });
                            </script>
                    
                    
                    
                      </div> 				
				</div> 
                <?php ?><?php /*?>}else{ ?>
                 <div class="form-group">
                <!-- When user compose email then dispaly-->
                <label class="control-label" for="username">To</label>
                   <select id="tags" multiple="multiple" class="form-control" name="to[]">
					   <?php if($users_data){
                       foreach($users_data as $users_datas){
                       ?>
                        <option value="<?= $users_datas->email ?>" ><?= $users_datas->email ?></option>
                          <?php } }?>
                          
                    </select>
                    <script>
                            $('#tags').select2({
                            data: [],
                            tags: true,
                            tokenSeparators: [','], 
                            placeholder: "Add your Emails here" 
                        });
                            </script>
					
					
					 
                    </div>
                     
			        </div> 	
                    <?php }?>	<?php */?>		
				 
             
              <div class="form-group">		
                <?php echo form_error('username', '<div class="alert alert-danger">', '</div>'); ?>									
					<label class="control-label" for="username">Subject</label>
					<div class="controls">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" value="">   
			        </div>  			
				</div>
              
              <div class="form-group">		
                 									
					<label class="control-label" for="username">Message</label>
					<div class="controls">
                    <textarea name="message" class="form-control" id="mytextarea" ></textarea>   
			        </div>  			
				</div>  
			 </div>
             
                <div class="panel-footer">
             <input type="submit" class="btn btn-primary" value="Send">
				</div>  
               <?php  echo form_close(); ?>
            </div>
		</div>
	</div>
</div>-->
 
 

 
    
    <section class="content-header">
      <h1>
        Mailbox
        <small><?php  echo $Count_contact_message;?> New Messages</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><?php echo $this->lang->line('nav_dash'); ?></a></li>
       
        <li class="active">Mailbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="mailbox.html" class="btn btn-primary btn-block margin-bottom">Back To Messages</a>

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
               
              
               <li><a href="<?= base_url()?>admin/users"><i class="fa fa-user"></i> Select Users  </a></li>
               <li><a href="<?=base_url('admin/users/email')?>"><i class="fa fa-envelope-o"></i> Compose Email</a></li>
               
                <li><a href="mailbox.html"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">12</span></a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
           
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               
               <div class="">
         
		 <?php if($this->session->userdata('msg')){?>
            <div class="alert alert-success">
                <?php echo $this->session->userdata('msg');
                      $this->session->unset_userdata('msg');
            ?>
		 </div>
         <?php } if($this->session->userdata('errormsg')){?>
			<div class="alert alert-danger">
			  <?php 	echo  $this->session->userdata('errormsg');
				        $this->session->unset_userdata('errormsg');
				
				?>     </div>
			<?php } echo form_open(BASE_URL.'/admin/users/send_email');  ?>
                
                <div class="form-group">		
                <?php echo form_error('username', '<div class="alert alert-danger">', '</div>'); 
				
				
				             $user_email = $_POST['checked_id'];      // for multiple email 
						     $email      = $_POST['emailss'];         // for single email
								 
					 
				
				?>									
					 
					<div class="controls">
                  <select id="email" multiple="multiple" class="form-control" name="to[]" required="required">
                     <?php  if(isset($user_email)){
                             foreach($user_email as $user_emails){?>
                        
                        <option value="<?php echo  $user_emails;?>" selected="selected" >
						<?php echo  $user_emails;?></option>
                       
                        <?php }}else{?>
					     
                         <?php if(isset($email)){?>
                        <option value="<?php echo $email;?>" selected="selected" >
						<?php echo $email?></option>
                        
                        <?php }} ?>
                       
                        <?php if(isset($users_data)){
						   foreach($users_data as $users_datas){
						   ?>
                       			 <option value="<?= $users_datas->email ?>" ><?= $users_datas->email ?></option>
                         	 <?php } }?>
                           
                          
                    </select>
                    <script>
                            $('#email').select2({
                            data: [],
                            tags: true,
                            tokenSeparators: [','], 
                            placeholder: "To" 
                        });
                            </script>
                    
                    
                    
                      </div> 				
				</div> 
             <div class="form-group">		
                <?php echo form_error('username', '<div class="alert alert-danger">', '</div>'); ?>									
					 
					<div class="controls">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" value="" required="required">   
			        </div>  			
				</div>
              
              <div class="form-group">		
                 									
					 
					<div class="controls">
                    <textarea name="message" class="form-control" id="mytextarea" required="required"></textarea>   
			        </div>  			
				</div>  
			 </div>
             
                   
                
               
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fa fa-paperclip"></i> Attachment
                  <input type="file" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
              <?php  echo form_close(); ?>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
 <?php echo $footer; ?>
 </div>
 <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
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
  toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: '//www.tinymce.com/css/codepen.min.css'
});

  
  </script>
 



