<link href="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor-bootstrap.css" rel="stylesheet">
<link href="<?php echo ADMIN_THEME; ?>/js/trevor/sir-trevor-icons.css" rel="stylesheet">
<style>
   .seprator{
	   margin-top:20px;
	   }
    #mydiv2
       {
	     padding: 5px;
         width: 92%;
		 margin-left:20px;
	   }
        .dates a{
          padding: 1px 5px;
        }
        .post.question-post{
          margin-left: 20px;
          padding-bottom: 5px;
        }
        .question-post .user-block .question-statement{
          margin-left: 0px;
        }
        .post .user-block {
          margin-bottom: 5px;
        }
        .edit-question{
          display: none;
        }
        .question-action-buttons{
          text-align: right;
        }
        .save-answer,.save-desc,.save-short-desc{
          margin-top: 10px;
          background: #3c8dbc;
          color: #fff;
          border: none;
          width: 80px;
          height: 25px;
        }
        .action-buttons a{
          display: block;
          color: #fff;
          padding: 10px 0px;
          margin: 8px 0px;
          text-align: center;
        }
        .timeline-item.edit-desc{
          display: none;
          padding-bottom: 20px!important;
        }
        .timeline-item.edit-desc label{
          display: block;
          margin: 10px;
        }
        .timeline-item.edit-desc .form-group{
          padding-right: 10px;
          margin-right: 2%;
        }
        .timeline-item.edit-desc textarea{
          display: block;
          padding: 10px;
          margin: 10px;
          width: 98.5%;
          min-height: 150px;
         }
         #description .timeline-item{
           border-radius: 0px;
        }
       .timeline-item.edit-short-desc{
          display: none;
          padding-bottom: 20px!important;
        }
        .timeline-item.edit-short-desc label{
          display: block;
          margin: 10px;
        }
        .timeline-item.edit-short-desc .form-group{
          padding-right: 10px;
          margin-right: 2%;
        }
        .timeline-item.edit-short-desc textarea{
          display: block;
          padding: 10px;
          margin: 10px;
          width: 98.5%;
          min-height: 150px;
         }
         #shortdescription .timeline-item{
           border-radius: 0px;
        }
       ul.dates li .date-edit{
         display: none;
         position: absolute;
       }
       ul.dates li:hover .date-edit{
          display: inline-block;
       }
       .profile-username .full-edit{
          display: none;
          position: absolute;
          top: -7px;
          right: -3px;
       }
       .profile-username:hover .full-edit{
          display: inline-block;
       }
       .profile-username{
          position:relative;
       }
       .profile-username b{
         font-weight: 500;
       }
       #description pre,#shortdescription pre{
            display: block;
            padding: 9.5px;
            margin: 0 0 10px;
            font-size: 13px;
            line-height: 1.42857143;
            color: #333;
            word-break: break-word;
            word-wrap: normal;
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            border-radius: 4px;
             white-space: pre-wrap;
            white-space: -moz-pre-wrap;
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            word-wrap: break-word;
        }
        .editable{
          width: 90%;
          margin: 0 auto;
          text-align: center;
          display: none;
        }
        .editable input{
          width: 99%;
          margin: 10px 0px;
          padding: 5px 7px;
        }
        .web-container{
          position: relative;
        }
        #web-edit{
          position: absolute;
          top: 0px;
          z-index: 100;
          background: rgba(0,0,0,0.6);
          right: 0;
          display: none;
       }
       #web-edit span{
         color:#fff!important;
       }
       .web-container:hover #web-edit{
          display: inline-block;
          color:#fff!important;
       }
       .company-container{
          position: relative;
        }
        #company-edit{
          position: absolute;
          top: -5px;
          z-index: 100;
          right: 0;
          display: none;
       }
       .company-container:hover #company-edit{
          display: inline-block;
       }
       .email-container{
          position: relative;
       }
       #email-edit{
          position: absolute;
          top: -5px;
          z-index: 100;
          right: 0;
          display: none;
       }
       .email-container:hover #email-edit{
          display: inline-block;
       }
      .bsName-container{
          position: relative;
       }
       #bsName-edit{
          position: absolute;
          top: -5px;
          z-index: 100;
          right: 0;
          display: none;
       }
       .bsName-container:hover #bsName-edit{
          display: inline-block;
       }
       .sector-text{
        position: relative;
       }
       .sector-container:hover #sector-edit{
        display: inline-block;
       }
       #sector-edit{
       display:none;
        position: absolute;
        top: 0;
        right: 0;
      }
       .save-sector{
          margin-top: 10px;
          background: #3c8dbc;
          color: #fff;
          border: none;
          width: 80px;
          height: 25px;
        }
        .edit-sector{
          display:none;
        }
        .user-logo-container{
          position: relative;
          text-align: center;
        }
        .user-logo-container .profile-user-img {
            margin: 0 auto;
            min-width: 100px;
            max-width: 250px;
            min-height: 100px;
            width: 100%;
            padding: 3px;
            border: 3px solid #d2d6de;
        }
        .user-logo-container:hover .btn-file{
          display: block;
        } 
        #edit-logo{
          cursor: pointer;
        }
        .user-logo-container .btn-file{
            display:none;
            position: absolute;
            bottom: 0px;
            width: 100%;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.5);
            color: #fff;
        }

                .user-imgs-container{
    padding: 10px 20px;
    border-bottom: 2px solid #eee;
                }
                .user-imgs-container h3{
margin: 10px 0px;
    font-size: 20px;

                }
                .user-imgs-container .img-container{
    position: relative;
    max-width: 500px;
    margin: 0 auto;
                }
                .user-imgs-container .edit-button{

                }
             .user-imgs-container .btn.btn-file{
               margin-top: 10px;
                   padding-top: 3px;
          background: #3c8dbc;
          color: #fff;
          border: none;
          width: 80px;
          height: 25px;
             } 
.user-imgs{
    margin: 0 auto;
    width: 100%;
    padding: 3px;
    border: 3px solid #d2d6de;
  }

.loading-image{
    display: none;
    position: absolute;
    top: 0;
    width: 100%;
    left: 0;
    right: 0;
    height: 100%;
    background: rgba(0,0,0,0.5);
    text-align: center;
}
.loading-image img{
	margin-top: 20%;
}
.thumbsUp-container{

}
.thumbsUp-container:hover #resetThumbsUp{
    display: block;
}
#resetThumbsUp{
  float: right;
  display: none;
}
.acn-container{
  position: relative;
}
#acn-edit{
  position: absolute;
  top: -5px;
  z-index: 100;
  right: 0;
  display: none;
}
.acn-container:hover #acn-edit{
  display: inline-block;
}
.ipAddress-container{
  position: relative;
}
#ipAddress-edit{
    position: absolute;
    top: -5px;
    z-index: 100;
    right: 0;
    display: none;
}
.ipAddress-container:hover #ipAddress-edit{
    display: inline-block;
}


.address-container{
  position: relative;
}
#address-edit{
    position: absolute;
    top: -5px;
    z-index: 100;
    right: 0;
    display: none;
}
.address-container:hover #address-edit{
   display: inline-block;
}
.address-container .address-text{}
.address-container .address-text div.text-muted{}
.address-container .address-text div.text-muted span{}
.address-container .address-text div.text-muted span.street{}
.address-container .address-text div.text-muted span.town{}
.address-container .address-text div.text-muted span.state{}
.address-container #address-edit{}
.address-container .address{}
.address-container .address input{}
#address-save{
  margin-top: 10px;
    background: #3c8dbc;
    color: #fff;
    border: none;
    width: 80px;
    height: 25px;
}
.edit-category.sp-question{
    margin: 10px 0px;
}
.edit-category.sp-question select{

}


       /*Edit from Haider*/
   .modal-dialog {
       width: 80%;
       height: auto;
       margin: 0 auto;
       padding: 0;
       position: relative;
       top: 0; left: 0; bottom: 0; right: 0;
   }

   .modal-content {
       height: auto;
       min-height: 100%;
       border-radius: 0;
   }
    .checkbox{

         float: none;
        -ms-transform: scale(1);
        -moz-transform: scale(1);
        -webkit-transform: scale(1);
        -o-transform: scale(1);
         padding: 0px;
         margin: 0 !important;
    }
</style>
<?php
$ci =& get_instance();
      $ci->load->model("Common_model"); 
?>

<!-- Content Wrapper. Contains page content -->
<div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
             Pre-assessment 
            <small>DETAILS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pre-assessment </a></li>
            <li class="active">Details</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    	<?php 
	 
		 
		if(isset($userProfile)){ ?>
        
        
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile" id="profile-box-container" data-user-id="<?= $userProfile['userID']?>" data-img="<?= FCPATH.'/'.$userProfile['Logo']?>">
            <?php 
                    $logoImage= '';
                    if(!empty($userProfile['Logo']) and is_file(FCPATH.$userProfile['Logo'])){ 
                      $logoImage = base_url().'/'.$userProfile['Logo'];
                    }else{
                       $logoImage = base_url('pictures/defaultLogo.png');
                    }

              ?>
                <div class="user-logo-container">
                  <img id="User-Logo" class="profile-user-img img-responsive" src="<?= $logoImage; ?>" alt="User profile picture">
                  <div id="loading-image-logo" class="loading-image">
				    <img src="<?=base_url();?>assets/images/loading.gif" alt="loading">
				  </div>
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-file"><span class="fileupload-new">Click To</span><span class="fileupload-exists"> Edit</span>
                      <input id="edit-logo" type="file" name="logo" />
                      </span>
                      <!--a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a-->
                  </div>
                </div>
                
             
              <h3 class="profile-username text-center">
              <b>
              <?php if(!empty($userProfile['FullName'])){ 
                     echo $userProfile['FullName'];
                   }
                ?>
              </b>
              <a class="btn addBtn full-edit" id="full-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a></h3>
              <div class="editable fullname">
                <div class="form-group">
                  <label>Full Name:</label>
                  <input type="text" name="fullname" id="fullname" placeholder="<?= $userProfile['FullName'];?>"/> 
                </div>
              </div>
              <div class="company-container">
                  <div class="company-text">
                    <p class="text-muted text-center">
                     <?php if(!empty($userProfile['Company'])){ 
                           echo $userProfile['Company'];
                         }
                     ?>
                    </p>
                    <a class="btn addBtn company-edit" id="company-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                  </div>
                  <div class="editable company">
                    <div class="form-group">
                      <label>Company Name:</label>
                      <input type="text" name="company" id="company-input" placeholder="<?= $userProfile['Company'];?>"/> 
                    </div>
                  </div>
              </div>
              <ul class="list-group list-group-unbordered dates">
                <?php /*if(!empty($userProfile['dateDiff'])){ ?>
                  <li class="list-group-item">
                    <b>Days to go</b> <a class="pull-right bg-black"><?= $userProfile['dateDiff'];?></a>
                  </li>
                <?php } */?> 
              	<?php if(!empty($userProfile['expiry_date'])){ ?>
                    <li class="list-group-item ">
                        <b>Expiry Date</b>
                        <a class="pull-right bg-red"><?= $userProfile['expiry_date']; ?></a>
                        <i id="showExpDate" data-value="<?=($userProfile['ShowExpiryDate'] == 1)?'show':'hide';?>" class="pull-right fa <?php echo (isset($userProfile['ShowExpiryDate']) and $userProfile['ShowExpiryDate'] == 1)? 'fa-eye text-success':'fa-eye-slash text-warning' ?> " style="margin-right: 10px; cursor: pointer;"></i>
                        <a class="btn addBtn date-edit" data-date-title="Edit Expiry Date" data-date-type="expiry_date"
                           data-date-value="<?= $userProfile['expiry_date_value']; ?>" data-toggle="modal"
                           data-target=".DateEditModal" id="addDateEditModal"><span style="font-size: 12px;"
                                                                                    class="glyphicon glyphicon-pencil"></span></a>

                    </li>
                <?php } if(!empty($userProfile['corporate_date'])){ ?>
                <li class="list-group-item">
                  <b>Corporate Date</b> <a class="pull-right bg-aqua"><?= $userProfile['corporate_date'];?></a>
                  <a class="btn addBtn date-edit" data-date-title="Edit Corporate Date" data-date-type="corporate_date" data-date-value="<?= $userProfile['corporate_date_value'];?>" data-toggle="modal" data-target=".DateEditModal" id="addDateEditModal"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                </li>
                <?php } ?>
                <?php if(!empty($userProfile['added_date'])){ ?>
                <li class="list-group-item">
                  <b>Added Date</b> <a class="pull-right bg-green"><?= $userProfile['added_date'];?></a>
                  <a class="btn addBtn date-edit" data-date-title="Edit Added Date" data-date-type="added_date" data-date-value="<?= $userProfile['added_date_value'];?>" data-toggle="modal" data-target=".DateEditModal" id="addDateEditModal"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                </li>
                <?php } ?>
             </ul>
              
            <div class="web-container">
                    <a href="http://<?= $userProfile['Web'];?>" class="btn btn-primary btn-block website-text" target="_blank">
                      <b>
                      <?php if(!empty($userProfile['Web'])){ 
                              echo $userProfile['Web'];
                            }
                       ?> 
                      </b>
                    </a>
                    <a class="btn addBtn web-edit" id="web-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                    <div class="editable website">
                      <div class="form-group">
                        <label>Website Address:</label>
                        <input type="text" name="web-input" id="web-input" placeholder="<?= $userProfile['Web'];?>"/> 
                      </div>
                    </div>
                </div>
                
                 
                 <div class="web-container seprator">
              <?php  $alias = $userProfile['Company'];
			         $alias = str_replace(' ','_',$alias);
					?>
				  <a href="<?= base_url()."esic_database/company/".$alias?>" class="btn btn-primary btn-block" target="_blank">
                      <b>
                       View Profile
                      </b>
                    </a>
                     
                     
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Company</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="email-container">
                  <div class="email-text">
                    <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                    <p class="text-muted">
                      <?php 
                       if(!empty($userProfile['Email'])){ 
                          echo $userProfile['Email'];
                        }
                       ?>
                    </p>
                      <a class="btn addBtn email-edit" id="email-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                  </div>
                  <div class="editable email">
                      <div class="form-group">
                        <label>Email:</label>
                        <input type="email" name="email-input" id="email-input" placeholder="<?= $userProfile['Email'];?>"/> 
                      </div>
                  </div>
                </div>
              <hr>
               <div class="acn-container">
                  <div class="acn-text">
                    <strong><i class="fa fa-user margin-r-5"></i> ACN Number</strong>
                    <p class="text-muted">
                       <?php  if(!empty($userProfile['acn_number'])){ 
                          echo $userProfile['acn_number'];
                        }
                      ?>
                    </p>
                      <a class="btn addBtn acn-edit" id="acn-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                  </div>
                  <div class="editable acn">
                      <div class="form-group">
                        <label>ACN Number:</label>
                        <input type="text" name="acn-input" id="acn-input" placeholder="<?= $userProfile['acn_number'];?>"/> 
                      </div>
                  </div>
                </div>
              <hr>
            
              <div class="sector-container">
                <div class="sector-text">
                  <strong><i class="fa fa-industry margin-r-5"></i> Sector</strong>
                  <p class="text-muted"> 
                  <?php 
                    if(!empty($userProfile['sector'])){ 
                        echo $userProfile['sector'];
                    }
                  ?>
                  </p>
                  <a class="btn addBtn sector-edit" id="sector-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                </div>
                <div class="edit-sector">
                  <div class="form-group">
                    <label>Please Select Sector</label>
                    <select class="form-control"></select>
                  </div>
                </div>
              </div>
              <hr>
               <div class="bsName-container">
                  <div class="bsName-text">
                    <strong><i class="fa fa-briefcase margin-r-5"></i> Business Name</strong>
                    <p class="text-muted"> 
                      <?php 
                        if(!empty($userProfile['business'])){
                           echo $userProfile['business'];
                         }
                      ?>
                    </p>
                    <a class="btn addBtn bsName-edit" id="bsName-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                  </div>
                  <div class="editable bsName">
                    <div class="form-group">
                         <label>Business Name:</label>
                        <input type="text" name="bsName-input" id="bsName-input" placeholder="<?= $userProfile['business'];?>"/> 
                      </div>
                  </div>
                </div>
              <hr>
           
               <div class="ipAddress-container">
                  <div class="ipAddress-text">
                    <strong><i class="fa fa-globe margin-r-5"></i>IP Address</strong>
                    <p class="text-muted">
                     <?php 
                        if(!empty($userProfile['ipAddress'])){ 
                          echo  $userProfile['ipAddress'];
                        }
                      ?>
                     </p>
                     <a class="btn addBtn ipAddress-edit" id="ipAddress-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                  </div>
                  <div class="editable ipAddress">
                    <div class="form-group">
                        <label>IP Address:</label>
                        <input type="text" name="ipAddress-input" id="ipAddress-input" placeholder="<?= $userProfile['ipAddress'];?>"/> 
                      </div>
                  </div>
               </div>
               <hr>
               <div class="address-container">
                  <div class="address-text">
                    <strong><i class="fa fa-globe margin-r-5"></i>Address</strong>
                      <?php
					        echo '<div class="text-muted">Street Number: <span class="street_number">';
							  if($userProfile['address_street_number']!=''){ 
								echo $userProfile['address_street_number']; 
							  }
						   echo '</span></div>';
                           
						    echo '<div class="text-muted">Street Name: <span class="street_name">';
							  if($userProfile['address_street_name']!=''){ 
								echo $userProfile['address_street_name']; 
							  }
						   echo '</span></div>';
						     
						   echo '<div class="text-muted">Town: <span class="town">';
								  if($userProfile['address_town']!=''){ 
									echo $userProfile['address_town']; 
								  }
                           echo '</span></div>';
							
						  echo '<div class="text-muted">State: <span class="state">';
							  if($userProfile['address_state']!=''){ 
								echo $userProfile['address_state']; 
							  }
                            echo '</span></div>';
							
						   echo '<div class="text-muted">Post Code: <span class="post_code">';
							  if($userProfile['address_post_code']!=''){ 
								echo $userProfile['address_post_code']; 
							  }
								echo '</span></div>';
                           
                      ?>
                     <a class="btn addBtn address-edit" id="address-edit"><span style="font-size: 12px;" class="glyphicon glyphicon-pencil"></span></a>
                  </div>
                  <div class="editable address">
                    <div class="form-group">
                        <label>Street Number:</label>
                        <input type="text" name="street-number" id="street-number" 
                         value= "<?= $userProfile['address_street_number'];?>" placeholder="<?= $userProfile['address_street_number'];?>"/>
                                               
                        <label>Street Name:</label>
                        <input type="text" name="street-name" id="street-name" 
                        value= "<?= $userProfile['address_street_name'];?>" placeholder="<?= $userProfile['address_street_name'];?>"/>
                        
                        <label>Town:</label>
                        <input type="text" name="town-input" id="town-input"
                         value= "<?= $userProfile['address_town'];?>" placeholder="<?= $userProfile['address_town'];?>"/>
                         
                         <label>State:</label>
                        <input type="text" name="state-input" id="state-input"
                        value= "<?= $userProfile['address_state'];?>"  placeholder="<?= $userProfile['address_state'];?>"/> 
                         
                        <label>Post Code:</label>
                        <input type="text" name="post-input" id="post-input"
                        value= "<?= $userProfile['address_post_code'];?>" placeholder="<?= $userProfile['address_post_code'];?>"/>
                          
                    </div>
                    <div class="form-group">
                      <button type="button" id="address-save">Save</button>
                    </div>
                  </div>
               </div>
               <hr>
            <?php if(!empty($userProfile['thumbsUp'])){ ?>
               <div class="thumbsUp-container">
                  <div class="thumbsUp-text">
                    <strong><i class="fa fa-thumbs-o-up margin-r-5"></i>Total Thumbs Up</strong>
                     <a class="btn addBtn resetThumbsUp" id="resetThumbsUp"><i class="fa fa-recycle"></i></a>
                    <p class="text-muted"> <?= $userProfile['thumbsUp'];?></p>
                  </div>
               </div>
               <hr>
            <?php }if(!empty($userProfile['dateDiff'])){ 

                  $percentageDays = (($userProfile['dateDiff']/(5*365))*100);

              ?>
              <strong><i class="fa fa-briefcase margin-r-5"></i> Days Remaining Percentage</strong>
               <div class="progress md">
                   <div class=" progress-bar progress-bar-aqua" style="width: <?= round($percentageDays).'%';?>" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                      <span class=""><?= round($percentageDays).'%';?></span>
                    </div>
                </div>
            <?php } 
            if(!empty($userProfile['ScorePercentage'])){ ?>
              <strong><i class="fa fa-briefcase margin-r-5"></i> Score</strong>
               <div class="progress md">
                   <div class="question-bar progress-bar progress-bar-aqua" style="width: <?= round($userProfile['ScorePercentage']).'%';?>" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                      <span class=""><?= round($userProfile['ScorePercentage']).'%';?></span>
                    </div>
                </div>
            <?php }  
			             
             $userrole = $this->session->userdata('userRole');
             if ($userrole == "1") { ?>
            <div class="action-buttons">
             <a href="#" data-target=".approval-modal" data-toggle="modal" class="btn-primary" data-id="<?= $userProfile['userID'];?>">Update Status</a>
             <div class="publish-buttons">
             <?php 
	             if($userProfile['Publish'] == 0){
	             	?>
	             		<a href="#" data-target=".publish-modal" data-toggle="modal" class="btn btn-warning" data-id="<?= $userProfile['userID'];?>">UnPublished</a>
	             	<?php
	             }else if($userProfile['Publish'] == 1){
	             	?>
	             		<a href="#" data-target=".unpublish-modal" data-toggle="modal" class="btn-primary" data-id="<?= $userProfile['userID'];?>">Published</a>
	             	<?php
				}
             ?>
             </div>
             <a href="#" data-target=".delete-modal" data-toggle="modal" class="bg-red" data-id="<?= $userProfile['userID'];?>">Delete</a>
             </div>
             <?php } ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#questions" data-toggle="tab">Questions</a></li>
              <li><a href="#description" data-toggle="tab">Description</a></li>
              <li><a href="#otherDetail" data-toggle="tab">Detail</a></li>
              <li><a href="#social" data-toggle="tab">Social Setting</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="questions">
                <?php if(isset($usersQuestionsAnswers)){   ?>


               <?php foreach ($usersQuestionsAnswers as $key => $value) { ?>
                  <div class="post question-post <?= 'question-'.$value['questionID'];?>" data-id="<?= 'question-'.$value['questionID'];?>">
                      <div class="user-block">
                          <span class="username question-statement">
                          <a href="#"><?= $value['Question']; ?></a>
                              <a href="#" class="pull-right btn-box-tool question-edit"
                                 data-id="<?= 'question-' . $value['questionID']; ?>"
                                 data-question-id="<?= $value['questionID']; ?>"><i class="fa fa-pencil"></i></a>

                              <?php if (!empty($value['points'])) { ?>
                                  <span class="question-points"
                                        data-score="<?= $value['points']; ?>">(<?= $value['points']; ?>)</span>
                              <?php } else { ?>
                                  <span class="question-points"></span>
                              <?php } ?>
                          </span>
                              <?php
                              $possibleSolutions = $value['possibleSolutions'];
                              $providedSolution = $value['providedSolution'];
                                if(!empty($possibleSolutions)){
                                    $possibleSolutions = json_decode($possibleSolutions);
                                    $type = $possibleSolutions->type;
                                    $hasChildren = $possibleSolutions->hasChildren;
                                    $hasChildren = $possibleSolutions->hasChildren;
                                }

                                if(!empty($providedSolution)){
                                    $providedSolution = json_decode($providedSolution,true);
                                }
                              ?>

                      </div>
                    <div class="edit-question">
                      <div class="form-group">
                          <?php
                          switch($type){
                              case 'CheckBoxes':
                                  echo '<label>Please Select Answer</label>';
                                  $data = $possibleSolutions->data;
                                    echo '<div class="form-group">';
                                    if(isset($providedSolution['selectedCheckBoxes']) and !empty($providedSolution['selectedCheckBoxes'])){
                                        $selectedCheckBoxes = $providedSolution['selectedCheckBoxes'];
                                    }
                                  foreach($data as $checkbox){
                                        if(isset($selectedCheckBoxes) and in_array_r($checkbox->id,$selectedCheckBoxes) and in_array_r($checkbox->name,$selectedCheckBoxes)){
                                            $checked = 'checked="checked"';
                                        }else{
                                            $checked = '';
                                        }
                                  ?>
                                      <div class="checkbox">
                                          <label>
                                              <input type="checkbox" name="<?=$checkbox->name?>" id="<?=$checkbox->id?>" <?=$checked?>>
                                              <?=$checkbox->text?>
                                          </label>
                                      </div>
                                <?php
                                    }
                                    echo '</div>';
                                  break;
                              case 'SelectBox':
                                  if(empty($possibleSolutions->textBoxText)){
                                      echo '<label>Please Select Answer</label>';
                                  }else{
                                      echo '<label>'.$possibleSolutions->textBoxText.'</label>';
                                  }
                                  $data = $possibleSolutions->data;
                                  ?>
                                  <select class="form-control <?=((isset($possibleSolutions->isMulti) && $possibleSolutions->isMulti === 'Yes')?'customSelect2':'')?>" <?=((isset($possibleSolutions->isMulti) && $possibleSolutions->isMulti === 'Yes')?'multiple="multiple"':'')?> style="width:100%">
                                      <?php
                                      if(!empty($data)){
                                          foreach($data as $key => $selectOption){
                                              if(in_array($selectOption->value,$providedSolution['selectedSelectValue'])){
                                                  $selected='selected="selected"';
                                              }else{
                                                  $selected = '';
                                              }

                                              echo '<option value="'.$selectOption->value.'" '.(isset($selected)?$selected:'').'>'.$selectOption->text.'</option>';
                                          }
                                      }
                                      ?>
                                  </select>
                          <?php
                                  break;
                              case 'radios':
                                  echo '<label>Please Select Answer</label>';
                                  $data = $possibleSolutions->data;
                                  echo '<div class="form-group">';
                                  if(isset($providedSolution['type']) and $providedSolution['type'] === 'radio'){
                                      $selectedValue=$providedSolution['selectedValue'];
                                      $selectedRadioID=$providedSolution['selectedRadioID'];
                                  }
                                  foreach($data as $radioButton){
                                      if(isset($selectedRadioID) && ($radioButton->id === $selectedRadioID) && ($selectedValue=== $radioButton->value)){
                                          $checked = 'checked="checked"';
                                      }else{
                                          $checked = '';
                                      }
                                      ?>
                                      <div class="radio">
                                          <label>
                                              <input type="radio" name="radio_<?=$value['questionID']?>" id="<?=$radioButton->id?>" value="<?=$radioButton->value?>" <?=$checked?>>
                                              <?=$radioButton->text?>
                                          </label>
                                      </div>
                                      <?php
                                  }
                                  echo '</div>';
                                  break;
                              case 'textBoxes':
                                  $data = $possibleSolutions->data;
                                  if(!empty($data)){
                                      echo '<div class=row>';
                                      foreach($data as $textBox){
                                          ?>
                                          <div class="form-group <?=$textBox->grid->grid_size?>">
                                              <label for="<?=$textBox->labelTextBox->textBoxID?>"><?= $textBox->labelTextBox->label ?></label>
                                              <input type="text" id="<?=$textBox->labelTextBox->textBoxName?>" name="<?=$textBox->labelTextBox->textBoxName?>" class="form-control">
                                          </div>
                          <?php
                                      }//End of Foreach
                                      echo '</div>';
                                  }//End of If not empty data
                                  break;
                          }
                          ?>
                        <?php 
	                        if(!empty($value['TableName'])){ 
	                        		$tableName = trim($value['TableName']);
			                          if($tableName=='esic_rnd'){
			                          	$TableIDCheck = trim($userProfile['RnDID']);
			                          	$tableUpdateID = 'RnDID';
			                          }else if($tableName =='esic_acceleration'){	
			                          	$TableIDCheck = trim($userProfile['AccCoID']);
			                          	$tableUpdateID = 'AccCoID';
			                          }else if($tableName == 'esic_institution'){
			                          	$TableIDCheck = trim($userProfile['inID']);
			                          	$tableUpdateID = 'inID';
			                          }else if($tableName=='esic_accelerators'){
			                          	$TableIDCheck = trim($userProfile['AccID']);
			                          	$tableUpdateID = 'AccID';
			                          }else{
			                          	$TableIDCheck ='';
			                          }
			                          $esic_tableName = $ci->Common_model->select($tableName);
			                          $assocArray = json_decode(json_encode($esic_tableName),true);
			                    if(isset($esic_tableName) and !empty($esic_tableName)){
	                        	?>
		                        <div class="edit-category sp-question" data-tablename="<?= $tableName;?>" data-tableUpdateID="<?= $tableUpdateID; ?>">
			                        <select class="form-control">
			                        	<option value="0">Select...</option>
			                                 <?php 
				                                     foreach($assocArray as $esic_tableName_data){

				                                     		//$dataTable = json_decode($esic_tableName_data,true);
				                                     		$totalItems = count($esic_tableName_data);
				                                     		$count = 0;
				                                     		$innerArray = array();
				                                     		foreach($esic_tableName_data as $data){
				                                     			$innerArray[$count] = $data;
				                                     			$count++;
				                                     		}
				                                     		$selected ='';
				                                     		if(trim($TableIDCheck) == trim($innerArray[0])){
				                                     			$selected= 'selected';
				                                     		}

				                                          echo '<option data-id-check"'.$TableIDCheck.'" value="'.$innerArray[0].'"  '.$selected.'>'.$innerArray[1].'</option>';
				                                     }
			                                    }   
			                                   ?>    
			                        </select>
		                        </div>
                        <?php }?>
                      </div>
                    </div>
                  </div>
                <?php } 
                  }
              ?>
                </div>
              <div class="tab-pane" id="otherDetail">
                <?php 
                      $productImage= '';
                      if(!empty($userProfile['productImage']) and is_file(FCPATH.'/'.$userProfile['productImage'])){ 
                        $productImage = base_url().'/'.$userProfile['productImage'];
                      }else{
                         $productImage = base_url('pictures/defaultLogo.png');
                      }

                ?>
                <div class="user-product-container user-imgs-container">
                  <h3>User Product Image</h3>
                  <div class="img-container">
                    <img id="User-product" class="user-imgs img-responsive" src="<?= $productImage; ?>" alt="Product Picture">
                    <div id="loading-image-product" class="loading-image">
					    <img src="<?=base_url();?>assets/images/loading.gif" alt="loading">
					 </div>
                  </div>
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-file"><span class="fileupload-new">Edit</span><span class="fileupload-exists"></span>
                      <input id="edit-product" class="edit-button" type="file" name="product" />
                      </span>
                      <!--a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a-->
                  </div>
                </div>
                 <?php 
                      $BannerImage= '';
                      if(!empty($userProfile['banner']) and is_file(FCPATH.'/'.$userProfile['banner'])){ 
                        $BannerImage = base_url().'/'.$userProfile['banner'];
                      }else{
                         $BannerImage = base_url('pictures/defaultBanner.jpg');
                      }

                ?>
                <div class="user-banner-container user-imgs-container">
                  <h3>User Banner Image</h3>
                  <div class="img-container">
                    <img id="User-banner" class="user-imgs img-responsive" src="<?= $BannerImage; ?>" alt="Banner Picture">
                    <div id="loading-image-banner" class="loading-image">
					    <img src="<?=base_url();?>assets/images/loading.gif" alt="loading">
					 </div>
                  </div>
                  <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-file"><span class="fileupload-new">Edit</span><span class="fileupload-exists"></span>
                      <input id="edit-banner" class="edit-button" type="file" name="Banner" />
                      </span>
                      <!--a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a-->
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="description">
                <!-- The timeline -->

               <?php if(!empty($userProfile['tinyDescription'])){ ?>
                <ul class="timeline timeline-inverse">
                  <li>
                    <div class="timeline-item">
                      <h3 class="timeline-header">Short Description  <a href="#" id="short-desc-edit" data-user-id="<?= $userProfile['userID'];?>" class="pull-right btn-box-tool short-desc-edit"><i class="fa fa-pencil"></i></a></h3>
                      <div id="short-desc-text" class="timeline-body">
                      <pre><?= trim(urldecode($userProfile['tinyDescription']));?></pre>
                      </div>
                    </div>
                    <div class="timeline-item edit-short-desc">
                      <div class="form-group">
                        <label>Please Edit The Short Description Here</label>
                        <textarea id="short-desc-textarea" name="short-desc"><?=$userProfile['tinyDescription'];?></textarea>
                      </div>
                    </div>
                  </li>      
                </ul>
              <?php }else{ ?>
                <ul class="timeline timeline-inverse">
                  <li>
                    <div class="timeline-item">
                      <h3 class="timeline-header">Short Description  <a href="#" id="short-desc-edit" data-user-id="<?= $userProfile['userID'];?>" class="pull-right btn-box-tool short-desc-edit"><i class="fa fa-plus"></i></a></h3>
                      <div id="short-desc-text" class="timeline-body">
                      <pre>
                      </pre>
                      </div>
                    </div>
                    <div class="timeline-item edit-short-desc">
                      <div class="form-group">
                        <label>Please Add The Short Description Here</label>
                        <textarea id="short-desc-textarea" name="short-desc"></textarea>
                      </div>
                    </div> 
                  </li>      
                </ul>
              <?php } ?>
              <?php if(!empty($userProfile['BusinessShortDesc'])){ ?>
                <ul class="timeline timeline-inverse">
                  <li>
                    <div class="timeline-item">
                      <h3 class="timeline-header">Detail Description  
                        <a href="#" id="desc-edit" data-toggle="modal" data-target="#desc-edit-modal" data-user-id="<?= $userProfile['userID'];?>" class="pull-right btn-box-tool desc-edit">
                          <i class="fa fa-pencil"></i>
                        </a>
                      </h3>
                      <div id="desc-text" class="timeline-body">
                        <pre><?= trim(urldecode($userProfile['BusinessShortDesc']));?></pre>
                      </div>
                    </div>
                    <div class="timeline-item edit-desc">
                      <div class="form-group">
                        <label>Please Edit The Detail Description Here</label>
                        <textarea id="desc-textarea" name="desc"><?=$userProfile['BusinessShortDesc'];?></textarea>
                      </div>
                    </div>
                  </li>      
                </ul>
              <?php }else{ ?>
				        <ul class="timeline timeline-inverse">
                  <li>
                    <div class="timeline-item">
                      <h3 class="timeline-header">Detail Description  
                        <a href="#" id="desc-edit" data-toggle="modal" data-target="#desc-edit-modal" data-user-id="<?= $userProfile['userID'];?>" class="pull-right btn-box-tool desc-edit">
                          <i class="fa fa-plus"></i>
                        </a>
                      </h3>
                      <div id="desc-text" class="timeline-body">
                        <pre></pre>
                      </div>
                    </div>
                    <div class="timeline-item edit-desc">
                      <div class="form-group">
                        <label>Please Add The Detail Description Here</label>
                        <textarea id="desc-textarea" name="desc"></textarea>
                      </div>
                    </div> 
                  </li>      
                </ul>
              <?php } ?>
              </div>
              
              <div class="tab-pane" id="social">
                  
                  
   
   <div class="row">
          <div class="col-md-3 col-sm-12">
           <label for="Name">Social Site<span class="required-fields"></span></label>
            
          </div>
         <div class="col-md-9 col-sm-10">
                <label for="Name">Profile Link<span class="required-fields"></span></label>
          </div>
  </div> 
   <div class="row">
   <div class="" id="mydiv2">
                      <!--here display success message -->
                </div> 
          <div class="col-md-3 col-sm-12">
            <p class="social-tab"> Facebook</p>
          </div>
         <div class="col-md-9 col-sm-10">
                
                <div class="form-group">
                   <input id="facebook" name="firstName" type="text" placeholder="Facebook.." class="form-control"
                   value="<?= $social[0]->facebook ?>">
               </div>
        </div>
  </div>
   <div class="row">
          <div class="col-md-3 col-sm-12">
            <p class="social-tab"> Twitter</p>
          </div>
         <div class="col-md-9 col-sm-10">
                 <div class="form-group">
                   <input id="twitter" name="firstName" type="text" placeholder="Twitter.." class="form-control"
                   value="<?= $social[0]->twitter ?>">
               </div>
        </div>
  </div>
   <div class="row">
          <div class="col-md-3 col-sm-12">
             <p class="social-tab"> Google+</p>
          </div>
         <div class="col-md-9 col-sm-10">
                 <div class="form-group">
                   <input id="google" name="firstName" type="text" placeholder="Google+.." class="form-control"
                   value="<?= $social[0]->google ?>">
               </div>
        </div>
  </div>
   <div class="row">
          <div class="col-md-3 col-sm-12">
             <p class="social-tab"> LinkedIn</p>
          </div>
         <div class="col-md-9 col-sm-10">
                 <div class="form-group">
                   <input id="linkedIn" name="firstName" type="text" placeholder="LinkedIn.." class="form-control"
                   value="<?= $social[0]->linked_in ?>">
               </div>
        </div>
  </div>
   <div class="row">
          <div class="col-md-3 col-sm-12">
             <p class="social-tab"> Instagram</p>
          </div>
         <div class="col-md-9 col-sm-10">
                 <div class="form-group">
                   <input id="instagram" name="firstName" type="text" placeholder="instagram.." class="form-control"
                   value="<?= $social[0]->instagram ?>">
               </div>
        </div>
  </div>
    
  
  
      <div class="row">
          <div class="col-md-3 col-sm-12">
               
                <div class="form-group">
                
               
                 </div>
         </div> 
         <div class="col-md-9 col-sm-12">
               
                <div class="form-group">
                <input type="button" class="btn btn-sm btn-primary" value="Submit" id="save_social"></button>
               
                 </div>
         </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
<?php } ?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<div class="modal DateEditModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit The Date</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="inputDiv" id="dateInsertDiv">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                   <label for="cop_date">Type Date</label>
                                   <input id="dateType" name="dateType" type="hidden" />
                                    <div class="input-group date">
                                       <input id="edit_date" name="edit_date" type="text" class="form-control" placeholder="DD-MM-YYYY" />
                                       <div class="input-group-addon">
                                           <span class="glyphicon glyphicon-th"></span>
                                       </div>
                                     </div>    
                                 </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button id="saveDate" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

   <!-- Modal -->
   <div class="modal fade" id="desc-edit-modal" tabindex="-1" role="dialog" aria-labelledby="editDescriptionPage" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Modal title</h4>
               </div>
               <form  method="POST" action="<?=BASE_URL.'/admin/savedesc'?>" id="descriptionPage">
                   <input type="hidden" name="uID" value="<?=(isset($uID)?$uID:'')?>" >
               <div class="modal-body">
                   <?php
//                   $set = ;
                   echo '<textarea class="js-st-instance" id="desc-content" name="desc-content">'.
                       (isset($userProfile['BusinessShortDescJSON'])?$userProfile['BusinessShortDescJSON']:"")
                    .'</textarea>';
                   ?>

               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-primary">Save changes</button>
               </div>
               </form>
           </div>
       </div>
   </div>

<!--Other js is in Admin-details.js -->
<link rel="stylesheet" href="<?=base_url('assets/css/questions.css')?>">
<script>
$(document).ready(function(){ 
$("#save_social").on("click", function () {
	         var current_e    = $(this);
	         var user_id     = <?=$userProfile['userID']?>;
             var facebook    = $("#facebook").val();
			 var twitter     = $("#twitter").val();
		     var google      = $("#google").val();
			 var linkedIn    = $("#linkedIn").val();
			 var instagram     = $("#instagram").val();
			 var postData  = {
				              id: user_id,
							  facebook: facebook,
							  twitter:twitter,
							  google:google,
							  linkedIn:linkedIn,
							  instagram:instagram 
							  };
			 $.ajax({
					
					url: baseUrl + "admin/UpDateSocials",
					data: postData,
					type: "POST",
					success: function (output) {
					if (output == 'ok') 
					{
					 $('#mydiv2').addClass('.alert alert-success');
					 $('#mydiv2').html('Your Information updated Successfully!').show().delay(5000).fadeOut(3000);
					 $(current_e).closest('.edit-question').removeClass('in');
				    }
					}
				});
		  });


    function centerModal() {
        $(this).css('display', 'block');
        var $dialog  = $(this).find(".modal-dialog"),
            offset       = ($(window).height() - $dialog.height()) / 2,
            bottomMargin = parseInt($dialog.css('marginBottom'), 10);

        // Make sure you don't hide the top part of the modal w/ a negative margin if it's longer than the screen height, and keep the margin equal to the bottom margin of the modal
        if(offset < bottomMargin) offset = bottomMargin;
        $dialog.css("margin-top", offset);
    }

    $(document).on('show.bs.modal', '#desc-edit-modal', centerModal);
    $(window).on("resize", function () {
        $('.modal:visible').each(centerModal);
    });
  }); 
</script>

   <!--		  bower work-->
   <script src="<?php echo ADMIN_THEME; ?>/js/sirTrevor/bower_components/es5-shim/es5-shim.js" type="text/javascript" charset="utf-8"></script>
   <!-- es6-shim should be bundled in with SirTrevor for now -->
   <!-- <script src="../node_modules/es6-shim/es6-shim.js" type="text/javascript" charset="utf-8"></script> -->
   <script src="<?php echo ADMIN_THEME; ?>/js/sirTrevor/bower_components/jquery/dist/jquery.js" type="text/javascript" charset="utf-8"></script>
   <script src="<?php echo ADMIN_THEME; ?>/js/sirTrevor/bower_components/mr-trevor-js/sir-trevor.js" type="text/javascript" charset="utf-8"></script>

   <script src="<?php echo ADMIN_THEME; ?>/js/sirTrevor/bower_components/sir-trevor-columns-block/dist/sir-trevor-columns-block.js" type="text/javascript" charset="utf-8"></script>
   <script src="<?php echo ADMIN_THEME; ?>/js/sirTrevor/bower_components/underscore/underscore.js" type="text/javascript" charset="utf-8"></script>
   <script src="<?php echo ADMIN_THEME; ?>/js/sirTrevor/bower_components/sir-trevor-js-generator/block.js" type="text/javascript" charset="utf-8"></script>
   <script src="<?php echo ADMIN_THEME; ?>/js/sirTrevor/iFrame.js" type="text/javascript" charset="utf-8"></script>
   <script src="<?php echo ADMIN_THEME; ?>/js/sirTrevor/image-extended.js" type="text/javascript" charset="utf-8"></script>

   <!--		  TinyMCE-->
   <script src="<?php echo ADMIN_THEME; ?>/js/sirTrevor/mce/sir-trevor-tinymce.js" type="text/javascript" charset="utf-8"></script>



   <script type="text/javascript">
       $(function(){
           SirTrevor.config.debug = true;
           SirTrevor.config.scribeDebug = true;
           SirTrevor.config.language = "en";
           SirTrevor.setBlockOptions("Text", {
               onBlockRender: function() {
                   console.log("Text block rendered");
               }
           });
           window.editor = new SirTrevor.Editor({
               el: $('.js-st-instance'),
               blockTypes: [
                   "Columns",
                   "Heading",
                   "Text",
                   "List",
                   "Quote",
                   "ImageExtended",
                   "Video",
                   "Tweet",
                   "Accordion",
                   "Button",
                   "Iframe"
               ]
           });

           SirTrevor.onBeforeSubmit();
       });
   </script>
   <script type="text/javascript">
       function formSubmit(){

           SirTrevor.onBeforeSubmit();
           document.getElementById("descriptionPage").submit();
       }
   </script>

<script type="text/javascript">
    $(function(){
        $('div.question-post').find('input[type="radio"],input[type="checkbox"],input[type="text"], select').on('change',function(){
            var changedElement = $(this);
            var selectedQuestionID = $(this).parents('div.question-post').find('.question-edit').attr('data-question-id');

            var userID = "<?=$this->uri->segment(4);?>";

            var type = '';


            var postData = {
                qID:selectedQuestionID,
                userID:userID,
                listingID: 1
            };

            if($(this).parents('div.question-post').find('.radio').length > 0){
                var selectedRadio = changedElement.val();
                postData.selectedRadioValue = selectedRadio;
                postData.type='radio';
                postData.radioID = $(this).attr('id');
//                console.log('type is radio.');
            }
            else if ($(this).parents('div.question-post').find('.checkbox').length > 0){
                if($(this).is(':checked')){
                    postData.hasCheck = 'Yes';
                }else{
                    postData.hasCheck = 'No';
                };
                postData.type = 'checkbox';
                postData.checkBoxID = $(this).attr('id');
                postData.checkBoxValue = $(this).attr('name');
            }
            else if($(this).prop('tagName') === 'SELECT'){
                var selectedSelectValue = $(this).val();
                postData.type='select';
                postData.selectedValue = selectedSelectValue;
            }
            else if($(this).prop('type') === 'text'){
                //Lets Update All the fields at once.
                var textBoxes = [];
                 var inputTextBoxes = $(this).parents('.edit-question').find('input[type="text"]');
                 $.each(inputTextBoxes,function ($key, $textBox) {
                     var textBox = {};
                     textBox.changedValue = $($textBox).val();
                     textBox.textBoxID = $($textBox).attr('id');
                     textBoxes.push(textBox);
                 });
                postData.type='text';
                postData.textBoxes = JSON.stringify(textBoxes);
            }

            $.ajax({
                url:"<?=base_url();?>admin/question/updateUserAnswer",
                data:postData,
                type:"POST",
                success:function(output){
                    var data=output.trim().split('::');
                    if(data[0] === 'OK'){
                        Haider.notification(data[1],data[2]);
                    }else if(data[0] === 'FAIL'){
                        Haider.notification(data[1],data[2]);
                    }
                }
            });

        });
    });
</script>
