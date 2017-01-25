<?php echo $header; ?>

<style>
.custom_li_style li {
    
	list-style: none;
    display: inline-flex;
}
.delete{
	    float: left;
        top: 1px;
        position: relative;
        }
</style>
    <!-- Content Header (Page header) -->
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
          <a href="<?php echo BASE_URL ; ?>/admin/contact/manage_contact" class="btn btn-primary btn-block margin-bottom">Back To Messages</a>

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
               
              
               
               <li><a href="<?=base_url('admin/users/email')?>"><i class="fa fa-envelope-o"></i> Compose Email</a></li>
               <li><a href="<?php echo BASE_URL ; ?>/admin/contact/manage_contact"><i class="fa fa-inbox"></i> Inbox
               <span class="label label-primary pull-right"><?= $Count_contact_message; ?></span></a></li>
                <li><a href="<?=base_url('admin/users/sent')?>"><i class="fa fa-envelope-o"></i> Sent
                <span class="label label-primary pull-right"><?= $Count_email_message; ?> </span>
                </a></li>
                <li><a href="<?= base_url()?>admin/users"><i class="fa fa-user"></i> Select Users  </a></li>
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
              <h3 class="box-title">Read Contact Us Message</h3>

              <div class="box-tools pull-right">
         <a href="#" class="previous" class="btn btn-box-tool" id="<?= $sent_message->id ?>"  data-toggle="tooltip" title="Previous" c><i class="fa fa-chevron-left"></i></a>
          <a href="#" class="next" id="<?= $sent_message->id ?>" class="btn btn-box-tool" data-toggle="tooltip" title="Next">
          <i class="fa fa-chevron-right"></i></a>
              </div>
            </div><?php if($sent_message){?>
            
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
              
              
							
							
							 
				  
				<ul class="custom_li_style">  
                   <li>
                       <h3 id="subject"><?=  $sent_message->firstName; ?></h3>
                   </li>
                   <li>    
                       <h3 id="subject1"> <?= $sent_message->lastName; ?></h3>
                   </li>    
                <h5>  <span class="mailbox-read-time pull-right" id="sent_date"><?= $sent_message->date; ?></span></h5>
                <h5 id="to"><?=   $sent_message->email; ?></h5>
                 
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-center">
                
  <ul class="custom_li_style">
  
   <li>
      <?php   echo form_open(BASE_URL.'/admin/users/email');  ?>
          <input type="hidden" name="reply" value="<?= $sent_message->email; ?>">
          <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                    <i class="fa fa-reply"></i></button>
        <?php  echo form_close(); ?>   
   </li>
   <li>
       <?php   echo form_open(BASE_URL.'/admin/users/email');  ?>
          <!-- <input type="hidden" name="subject" value="<?php // echo $sent_message->comment; ?>">-->
           <input type="hidden" name="message" value="<?= $sent_message->comment; ?>">
           <button type="submit" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">              <i class="fa fa-share"></i></button>
       <?php  echo form_close(); ?>
   </li>  
     <li>
         <button type="button" class="delete_email btn btn-default btn-sm"  id="<?= $sent_message->id; ?>" data-toggle="tooltip" data-container="body" title="Delete"><i class="fa fa-trash-o"></i></button>
                    
   </li>  
   <!--<li>
       <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                  <i class="fa fa-print"></i></button>
   </li>-->
 </ul>   
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message" >
                <p>Hello</p>
                
                <p id="messagebody"><?= $sent_message->comment; ?></p>
               
               </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
          <!--<div class="box-footer">
              <ul class="mailbox-attachments clearfix">
                <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Sep2014-report.pdf</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
                <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> App Description.docx</a>
                        <span class="mailbox-attachment-size">
                          1,245 KB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
                <li>
                  <span class="mailbox-attachment-icon has-img"><img src="" alt="Attachment"></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo1.png</a>
                        <span class="mailbox-attachment-size">
                          2.67 MB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
                <li>
                  <span class="mailbox-attachment-icon has-img"><img src="" alt="Attachment"></span>

                  <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo2.png</a>
                        <span class="mailbox-attachment-size">
                          1.9 MB
                          <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                        </span>
                  </div>
                </li>
              </ul>
            </div>--> 
            
            
            <!-- /.box-footer -->
            <div class="box-footer">
          <ul class="custom_li_style">
            <li>     
              <?php   echo form_open(BASE_URL.'/admin/users/email');  ?>
                <input type="hidden" name="reply" value="<?= $sent_message->email; ?>">
                <button type="submit" class="btn btn-default btn-sm" id=""><i class="fa fa-reply"></i>Reply</button>
               <?php  echo form_close(); ?>
            </li>
            <li>   
             <?php   echo form_open(BASE_URL.'/admin/users/email');  ?>
                 
                <input type="hidden" name="message" value="<?= $sent_message->comment; ?>">
                <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-share"></i> Forward</button>
             <?php  echo form_close(); ?>   
             </li>
             <li>    
              <button type="button" class="delete_email btn btn-default btn-sm delete" id="<?= $sent_message->id; ?>" >
              <i class="fa fa-trash-o"></i> Delete</button>
              </li>
              <!--<li>
              <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
              </li>-->
           </ul>   
            </div>
            <!-- /.box-footer -->
            <?php }?>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

   <?php echo $footer; ?>
 </div>  </div>
 
 <script>
$(function () {
 $(".next").on("click", function () {
	             var ids = this.id;
				 var postData = {ids:ids, value: "next"};
                $.ajax({
                    url: baseUrl + "admin/contact/single_email_content",
                    data: postData,
                    type: "POST",
					success:function (data){
						var data=JSON.parse(data);
						$("#subject").html(data.firstName);
						$("#subject1").html(data.lastName);
					    $("#to").html(data.email);
						$("#sent_date").html(data.date);
						$("#messagebody").html(data.comment);
					    $('.next').attr("id", data.id);
						$('.previous').attr("id", data.id);
						$('.delete_email').attr("id", data.id);
					
					}
                });
            });
	
	$(".previous").on("click", function () {
	            var ids = this.id;
				var postData = {ids:ids, value: "previous"};
                $.ajax({
                    url: baseUrl + "admin/contact/single_email_content",
                    data: postData,
                    type: "POST",
					success:function (data){
						var data=JSON.parse(data);
						$("#subject").html(data.firstName);
						$("#subject1").html(data.lastName);
					    $("#to").html(data.email);
						$("#sent_date").html(data.date);
						$("#messagebody").html(data.comment);
					    $('.next').attr("id", data.id);
						$('.previous').attr("id", data.id);
						$('.delete_email').attr("id", data.id);
					
					}
                });
            });
	$(".delete_email").on("click", function () {
	            var ids = this.id;
		        var postData = {ids:ids, value: "delete"};
                $.ajax({
                    url: baseUrl + "admin/contact/single_email_content",
                    data: postData,
                    type: "POST",
					success:function (data){
						var data=JSON.parse(data);
						$("#subject").html(data.firstName);
						$("#subject1").html(data.lastName);
					    $("#to").html(data.email);
						$("#sent_date").html(data.date);
						$("#messagebody").html(data.comment);
					    $('.next').attr("id", data.id);
						$('.previous').attr("id", data.id);
						$('.delete_email').attr("id", data.id);
					
					}
                });
            });		
	 		
			
	});		
 
 </script>
 