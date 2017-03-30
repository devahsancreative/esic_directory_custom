   <style>
 .display-block
   {
	 display:block;
	} 
.display-none
    {
	  display:none;
	}	  
 p.social-tab 
    {
    margin-top: 5px;
    }
 #mydiv
    {
	padding: 5px;
    width: 76%;
	}
	 #mydiv2
    {
	padding: 5px;
    width: 76%;
	}
.scrollbar
    {
	 height: 400px;
	 overflow-y: scroll;
	 margin-bottom: 25px;
    }

.force-overflow
    {
	min-height: 450px;
    }
 .style-3::-webkit-scrollbar-track
   {
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
  }

.style-3::-webkit-scrollbar
  {
	width:6px;
	background-color:#F5F5F5;
  }   

.style-3::-webkit-scrollbar-thumb
  {
	background-color: #3c8dbc;
  }
 
   /**/
 .edit-question
  {
    display: none;
  }
.question-action-buttons
   {
   text-align: right;
   }
.save-answer,.save-desc,.save-short-desc
{
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
.remove{
	margin-top:7px;
	margin-right:13px;
	}

</style>
    <!-- Content Wrapper. Contains page content -->
   
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Edit Profile
                <small> </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url()?>/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Edit Profile</a></li>
            </ol>
        </section>

  <?php if($User_data){
		foreach($User_data as $User){
					?>
<section class="content">
 
      
       <div class="box">
        <div class="box-body">
                            
         
         
         <div class="row">
         <div class="col-md-3">
          
           <div class="box box-primary">
            <div class="box-body box-profile" id="profile-box-container" data-user-id="">
            <?php 
			        $logoImage = '';
                    if(!empty($User->image)){ 
                      $logoImage = base_url().'/uploads/investor/'.$User->image; 
                    }else{
                       $logoImage = base_url('pictures/defaultLogo.png');
                    }

              ?>
             <div class="user-logo-container">
               <img id="Profile_image" class="profile-user-img img-responsive" src="<?= $logoImage;?>" alt="User profile picture">
             </div>
             

             
          </div>      
         
         
         
         <div class="post question-post question-1">
              <a   class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q51">
                 <i class="fa fa-pencil"></i></a>
              <div class="edit-question" id="q51">
       <form id="upload_Profile_image" method="post" enctype="multipart/form-data">
       <div class="form-group">
         <label>Please Upload Profile Picture</label>
         <input type="file" name="image"  id="image" class="form-control"   alt="Cinque Terre" style="width:100%" > 
                  <div class="question-action-buttons">
                   <input type="submit" class="save-answer" value="Save">
                   </div>  
                 
         </div>
         </form>
     </div>
         </div>
 
          </div>
         </div>
         <div class="col-md-9 post ">
         <div class="" id="mydiv2">
                      <!--here display success message -->
                </div> 
     <h3><?= $User->firstName ."  ". $User->lastName;?></h3>
		 <p class="change_text"><?= $User->about;?></p>
         
             
             <a class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q300">
             <i class="fa fa-pencil"></i></a>
        <div class="edit-question collapse"  id="q300">
         <div class="form-group">
            <label>About</label>
                 <textarea name="about" class="form-control textarea" id="3"><?=$User->about;?></textarea>
                  <div class="question-action-buttons">
                   <button class="about save-answer">Save</button>
         </div>
     </div>
 </div>
</div>    </div>  
				
		 			
<div class="col-md-6">
   <div class="box box-primary">
     <div class="box-header with-border">
        <h3 class="box-title">About</h3>
     </div>
            <!-- /.box-header -->
            <div class="box-body">
             
 <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <strong><i class="fa fa-user margin-r-5"></i>First Name</strong>
             <a class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q100">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
<p class="text-muted change_text">
                      <?php 
                      if(!empty($User->firstName)){ 
                          echo $User->firstName; 
                        }
                       ?>
                    </p>
      <div class="edit-question collapse"  id="q100">
         <div class="form-group">
            <label>First Name</label>
                 <input type="text" name="f_name" id="1" class="form-control" placeholder="First Name"
                  value="<?=$User->firstName;?>">
                  <div class="question-action-buttons">
                   <button class=" about save-answer"  >Save</button>
         </div>
     </div>
 </div>
</div>
                
              
 <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <strong><i class="fa fa-user margin-r-5"></i>Last Name</strong>
             <a class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q101">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
 <p class="text-muted change_text">
                      <?php 
                       if(!empty($User->lastName)){ 
                          echo $User->lastName; 
                        }
                       ?>
                    </p>
      <div class="edit-question collapse"  id="q101">
         <div class="form-group">
            <label>Last Name</label>
                <input type="text" name="l_name" id="2" class="form-control" placeholder="Last Name"
                value="<?=$User->lastName;?>">
                   <div class="question-action-buttons">
                   <button class=" about save-answer" >Save</button>
         </div>
     </div>
 </div>
</div>
             
                 
               <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
         <strong><i class="fa fa-envelope margin-r-5"></i>Email</strong>
              
                      <span class="question-points"></span>
        </span>
  </div>
 <p class="text-muted">
                      <?php 
                       if(!empty($User->email)){ 
                          echo $User->email; 
                        }
                       ?>
                    </p>
      <div class="edit-question collapse"  id="q102">
         <div class="form-group">
            <label>Please Select Answer</label>
                <input type="text" name="f_name" id="f_name" class="form-control" placeholder="First Name"
                value="<?=$User->email;?>">
                   <div class="question-action-buttons">
                   <button class="save-answer save_quesiton" id="about">Save</button>
         </div>
     </div>
 </div>
</div>
                 
               
            <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
         <strong><i class="fa fa-envelope margin-r-5"></i>Address</strong>
             <a class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q103">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
 <p class="text-muted change_text">
                      <?php 
                       if(!empty($User->address)){ 
                          echo $User->address; 
                        }
                       ?>
                    </p>
      <div class="edit-question collapse"  id="q103">
         <div class="form-group">
            <label>Address</label>
               <textarea name="address" class="form-control"><?=$User->address;?></textarea>
                 <div class="question-action-buttons">
                   <button class="save-answer " id="address">Save</button>  
         </div>
     </div>
 </div>
</div>
             
            </div>
            <!-- /.box-body -->
          </div>
          </div> 
         
        <div class="col-md-6">
       
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#questions" data-toggle="tab">Questions</a></li>
              <li><a href="#description" data-toggle="tab">Social Settings</a></li>
              <li><a href="#otherDetail" data-toggle="tab">Security</a></li>
            </ul>
            <div class="tab-content">
              	 <div class="" id="mydiv">
                      <!--here display success message -->
                </div>  
<div class="active tab-pane scrollbar style-3" id="questions">
  <div class="force-overflow">
  
  
 <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <a href="#">Are you an early stage investor or considering making an investment?</a>
             <a class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q1">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
<p class="answer-solution"><?=  $User->e_st_investor == "1" ? "Yes" : "NO" ?></p>
      <div class="edit-question collapse"  id="q1">
         <div class="form-group">
            <label>Please Select Answer</label>
                <select class="form-control question_options">
                  <option value="1" <?=  $User->e_st_investor == "1" ? "selected" : "" ?>>Yes</option>
                  <option value="0" <?=  $User->e_st_investor == "0" ? "selected" : "" ?>>No</option>
                </select>
                   <div class="question-action-buttons">
                   <button class="save-answer save_quesiton" id="e_st_investor">Save</button>
         </div>
     </div>
 </div>
</div>
    
 <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <a href="#">Do you want a 20% rebate on your early stage investments and CGT exemption for up to 10 years?</a>
             <a   class="pull-right btn-box-tool question-edit question-edit" data-toggle="collapse" data-target="#q2">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
<p class="answer-solution"><?=  $User->rebate == "1" ? "Yes" : "NO" ?></p>
      <div class="edit-question" id="q2">
         <div class="form-group">
            <label>Please Select Answer</label>
                <select class="form-control question_options">
                  <option value="1" <?=  $User->rebate == "1" ? "selected" : "" ?>>Yes</option>
                  <option value="0" <?=  $User->rebate == "0" ? "selected" : "" ?>>No</option>
                </select>
                   <div class="question-action-buttons">
                   <button class="save-answer save_quesiton" id="rebate">Save</button>
         </div>
     </div>
 </div>
</div>
 
 <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <a href="#">Have you already found a company to invest in?</a>
             <a   class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q3">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
<p class="answer-solution"><?=  $User->al_fd_company == "1" ? "Yes" : "NO" ?></p>
      <div class="edit-question" id="q3">
         <div class="form-group">
            <label>Please Select Answer</label>
               <select class="form-control question_options">
                  <option value="1" <?=  $User->al_fd_company == "1" ? "selected" : "" ?>>Yes</option>
                  <option value="0" <?=  $User->al_fd_company == "0" ? "selected" : "" ?>>No</option>
                </select>
                   <div class="question-action-buttons">
                   <button class="save-answer save_quesiton" id="al_fd_company">Save</button>
         </div>
     </div>
 </div>
</div>

 <div class="post question-post question-1 displycompanydetail <?php if($User->al_fd_company == '1'){echo 'display-block';
 }else{echo 'display-none';}
 ?>" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <a href="#">If so, please type the company name/contact email.</a>
             <a class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q4">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>

 <p class="answer-solution show_company_n">Company Name:   <?= $User->company_name?></p>
 <p class="answer-solution show_company_e">Company Email:  <?= $User->company_email?></p>
      <div class="edit-question ser" id="q4">
         <div class="form-group">
                  <label>Comapny Name:</label>
                  <input type="text" name="company_name" id="company_name" 
                  class="form-control" value="<?= $User->company_name?>" placeholder="Company name">
                 
                  <label>Comapny Email:</label>
                  <input type="email" name="company_email" id="company_email"  
                  class="form-control" value="<?= $User->company_email?>" placeholder="Company name">
                   <div class="question-action-buttons">
                   <button class="save-answer save_company_details">Save</button>
         </div>
     </div>
 </div>
</div>
 <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <a href="#">Do you plan to hold your investment for more than 12 months </a>
             <a   class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q5">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
<p class="answer-solution"><?=  $User->hold_investment == "1" ? "Yes" : "NO" ?></p>
      <div class="edit-question" id="q5">
         <div class="form-group">
            <label>Please Select Answer</label>
               <select class="form-control question_options">
                  <option value="1" <?=  $User->hold_investment == "1" ? "selected" : "" ?>>Yes</option>
                  <option value="0" <?=  $User->hold_investment == "0" ? "selected" : "" ?>>No</option>
                </select>
                   <div class="question-action-buttons">
                   <button class="save-answer save_quesiton" id="hold_investment">Save</button>
         </div>
     </div>
 </div>
</div>
 <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <a href="#">Are you an affiliate of the ESIC?</a>
             <a   class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q6">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
<p class="answer-solution"><?=  $User->affiliate_ESIC == "1" ? "Yes" : "NO" ?></p>
      <div class="edit-question" id="q6">
         <div class="form-group">
            <label>Please Select Answer</label>
                 <select class="form-control question_options">
                  <option value="1" <?=  $User->affiliate_ESIC == "1" ? "selected" : "" ?>>Yes</option>
                  <option value="0" <?=  $User->affiliate_ESIC == "0" ? "selected" : "" ?>>No</option>
                </select>
                   <div class="question-action-buttons">
                   <button class="save-answer save_quesiton" id="affiliate_ESIC">Save</button>
         </div>
     </div>
 </div>
</div>
 
 <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <a href="#">Do you own 30% or more of the equity interests of the ESIC or entities connected with the ESIC?</a>
             <a  class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q7">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
<p class="answer-solution"><?=  $User->ent_con_ESIC == "1" ? "Yes" : "NO" ?></p>
      <div class="edit-question" id="q7">
         <div class="form-group">
            <label>Please Select Answer</label>
                <select class="form-control question_options">
                  <option value="1" <?=  $User->ent_con_ESIC == "1" ? "selected" : "" ?>>Yes</option>
                  <option value="0" <?=  $User->ent_con_ESIC == "0" ? "selected" : "" ?>>No</option>
                </select>
                   <div class="question-action-buttons">
                   <button class="save-answer save_quesiton" id="ent_con_ESIC">Save</button>
         </div>
     </div>
 </div>
</div>
 <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <a href="#">Are you a 'widely held company' or a 100% subsidiary of a widely held company?</a>
             <a   class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q8">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
<p class="answer-solution"><?=  $User->widely_held_company == "1" ? "Yes" : "NO" ?></p>
      <div class="edit-question" id="q8">
         <div class="form-group">
            <label>Please Select Answer</label>
                 <select class="form-control question_options">
                  <option value="1" <?=  $User->widely_held_company == "1" ? "selected" : "" ?>>Yes</option>
                  <option value="0" <?=  $User->widely_held_company == "0" ? "selected" : "" ?>>No</option>
                </select>
                   <div class="question-action-buttons">
                   <button class="save-answer save_quesiton" id="widely_held_company">Save</button>
         </div>
     </div>
 </div>
</div>
 <div class="post question-post question-1 situation" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <a href="#">Which of the following best describes your situation?</a>
             <a  class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q9">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
<p class="answer-solution situation1 <?=  $User->situation1 == '1' ? 'display-block': 'display-none' ?>" > I did NOT claim a tax offset for an ESIC investment last year</p>

<p class="answer-solution situation2 <?=  $User->situation2 == '1' ? 'display-block': 'display-none' ?>"> I claimed a tax offset for an ESIC investment last year but DO NOT plan to carry it forward to this year"</p>

<p class="answer-solution situation3 <?=  $User->situation3 == '1' ? 'display-block': 'display-none' ?>">
I claimed a tax offset for an ESIC investment last year and DO plan to carry it forward to this year</p>
      <div class="edit-question" id="q9">
         <div class="form-group">
            <label>Please Select Answer</label>
                   <div class="form-group">
       <label>
            <input type="checkbox" class="minimal" name="situation1" value="1"
            <?=  $User->situation1 == "1" ? "checked" : ""?> id="situation1">
            I did NOT claim a tax offset for an ESIC investment last year</label>
        <label>
           <input type="checkbox" class="minimal"  name="situation2" value="1"
            <?=  $User->situation2 == "1" ? "checked" : ""?> id="situation2">
           I claimed a tax offset for an ESIC investment last year but DO NOT plan to carry it forward to this year</label>
        <label>
           <input type="checkbox" class="minimal"  name="situation3" value="1"
            <?=  $User->situation3 == "1" ? "checked" : ""?> id="situation3">
           I claimed a tax offset for an ESIC investment last year and DO plan to carry it forward to this year</label>   
    </div>
                   <div class="question-action-buttons">
                   <button class="save-answer" id="situation">Save</button>
         </div>
     </div>
 </div>
</div>
 <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <a href="#">Are you a Sophisticated Investor under S708 of the Corporations Act 2001?</a>
             <a   class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q10">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
<p class="answer-solution"><?=  $User->Act_2001 == "1" ? "Yes" : "NO" ?></p>
      <div class="edit-question" id="q10">
         <div class="form-group">
            <label>Please Select Answer</label>
                 <select class="form-control question_options">
                  <option value="1" <?=  $User->Act_2001 == "1" ? "selected" : "" ?>>Yes</option>
                  <option value="0" <?=  $User->Act_2001 == "0" ? "selected" : "" ?>>No</option>
                </select>
                   <div class="question-action-buttons">
                   <button class="save-answer save_quesiton" id="Act_2001">Save</button>
         </div>
     </div>
 </div>
</div>
 <div class="post question-post question-1" data-id="question-1">
 <div class="">
       <span class="username question-statement">
          <a href="#">Sophisticated investor certificate upload here:</a>
        
        <a   class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q11">
             <i class="fa fa-pencil"></i></a>
      </span>       
  </div>
 <p class="answer-solution">
              <?php if($User->certificate){?><input id="updatesrc" type="image" class="img-thumbnail" src="<?= base_url().'/uploads/investor/'.$User->certificate;?>" width="304" height="236">
			  <?php } ?></p>
   <div class="edit-question" id="q11">
         <form id="uploadimage" method="post" enctype="multipart/form-data">
         <div class="form-group">
            <label>Please Upload Certificate</label>
            <!--<input type="file" name="certificate"  id="certificates">-->
            <?php if($User->certificate){?><input class="img-thumbnail"  type="file" src="<?= base_url().'/uploads/investor/'.$User->certificate;?>" name="certificate"
             width="304" height="236"> 
			  <?php }else{ ?>
                    <input type="file" name="certificate"  id="certificates" class="form-control"   alt="Cinque Terre" style="width:100%" > 
              <?php } ?>
             
                   <div class="question-action-buttons">
                   <input type="submit" class="save-answer" value="Save">
                   </div>  
                 
         </div>
         </form>
     </div>
 </div>
 
 <div class="post question-post question-1" data-id="question-1">
  <div class="">
       <span class="username question-statement">
          <a href="#">Would you like to be matched with an advisor to learn more information about ESICs?</a>
             <a   class="pull-right btn-box-tool question-edit" data-toggle="collapse" data-target="#q12">
             <i class="fa fa-pencil"></i></a>
                      <span class="question-points"></span>
        </span>
  </div>
<p class="answer-solution"><?=  $User->info_ESICs == "1" ? "Yes" : "NO" ?></p>
      <div class="edit-question"id="q12">
         <div class="form-group">
            <select class="form-control question_options">
                  <option value="1" <?=  $User->info_ESICs == "1" ? "selected" : "" ?>>Yes</option>
                  <option value="0" <?=  $User->info_ESICs == "0" ? "selected" : "" ?>>No</option>
                </select>
                   <div class="question-action-buttons">
                   <button class="save-answer save_quesiton" id="info_ESICs">Save</button>
         </div>
     </div>
 </div>
</div>
 

              
</div>
</div>
           
         
           
                 

       <!---------------------------------------- SECURITY TAB START HERE ------------------------------------------>   
      
     <div class="tab-pane" id="otherDetail">
       <form  name="registration"> 
      <div class="row">
          <div class="col-md-6 col-sm-12">
              <label for="Name">Email:<span class="required-fields"></span></label>
                <div class="form-group">
              <input id="email" name="email" type="email" placeholder="Email" class="form-control" 
                       value="<?php if(!empty($User->email)){echo $User->email; }?>" required="required">
                       <label id="message" class="text-red"></label>
                       <label id="email-error" class="text-red"></label>
                    <div id="infoMessage"><?php echo form_error('email'); ?></div>
                 </div>
         </div>
         <div class="col-md-6 col-sm-12">
              <label for="Name">Current Password:<span class="required-fields"></span></label>
                <div class="form-group">
              <input id="currentpassword" name="old-password" type="text" placeholder="Current Password" 
              value="" class="form-control" > <label id="pass-error" class="text-red"></label>
               <div id="infoMessage"><?php echo form_error('password'); ?></div>
                 </div>
         </div>
          
   </div>  
   </form> 
      <div class="row">
       <div class="col-md-6 col-sm-12">
              <label for="Name">New:<span class="required-fields"></span></label>
                <div class="form-group">
              <input id="password" name="firstName" type="text" placeholder="New Password" class="form-control">
               <label id="error" class="text-red"></label>
                 </div>
         </div>
         <div class="col-md-6 col-sm-12">
              <label for="Name">Re-type new:<span class="required-fields"></span></label>
                <div class="form-group">
              <input id="cpassword" name="password" type="text" placeholder="Re-type new" class="form-control">
                 </div>
         </div>
   </div>  
    <div class="row">
         <div class="col-md-6 col-sm-12">
               
               
         </div>
        
   </div>  
     
      <div class="row">
         <div class="col-md-12 col-sm-12">
               
                <div class="form-group">
                <input type="button" class="btn btn-sm btn-primary" value="Save Changes" id="save_security"></button>
               
                 </div>
         </div>
          
   </div>     
  
 
</div>
       <!---------------------------------------- SOCIAL TAB START HERE ------------------------------------------> 
 
<div class="tab-pane" id="description">
  
    
         
   <div class="row">
          <div class="col-md-3 col-sm-12">
           <label for="Name">Social Site<span class="required-fields"></span></label>
            
          </div>
         <div class="col-md-9 col-sm-10">
                <label for="Name">Profile Link<span class="required-fields"></span></label>
          </div>
  </div> 
   <div class="row">
          <div class="col-md-3 col-sm-12">
            <p class="social-tab"> Facebook</p>
          </div>
         <div class="col-md-9 col-sm-10">
                
                <div class="form-group">
                   <input id="facebook" name="firstName" type="text" placeholder="Facebook.." class="form-control"
                   value="<?= $User_social[0]->facebook ?>">
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
                   value="<?= $User_social[0]->twitter ?>">
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
                   value="<?= $User_social[0]->google ?>">
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
                   value="<?= $User_social[0]->linkedIn ?>">
               </div>
        </div>
  </div>
   <div class="row">
          <div class="col-md-3 col-sm-12">
             <p class="social-tab"> YouTube</p>
          </div>
         <div class="col-md-9 col-sm-10">
                 <div class="form-group">
                   <input id="youTube" name="firstName" type="text" placeholder="YouTube.." class="form-control"
                   value="<?= $User_social[0]->youTube ?>">
               </div>
        </div>
  </div>
   <div class="row">
          <div class="col-md-3 col-sm-12">
             <p class="social-tab"> Vimeo</p>
          </div>
         <div class="col-md-9 col-sm-10">
                 <div class="form-group">
                   <input id="vimeo" name="firstName" type="text" placeholder="Vimeo.." class="form-control"
                   value="<?= $User_social[0]->vimeo ?>">
               </div>
        </div>
  </div>
  
  <?php  }?>   
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
        <?php /*?> <div class="col-md-5 col-sm-10">
               
                <div class="form-group pull-right">
                <button class="btn btn-sm btn-primary" id="addnew" >
                <i class="fa fa-plus" data-toggle="tooltip" title="Click to Add More Links"></i></button>
               
                 </div>
         </div> <?php */?>
     </div>    
  </div>
</div>
            <!-- /.tab-content -->
    
		 
     </div>
   </div>
</section> 
<?php }  ?>
 
 <script>
$(document).ready(function(){   
	/*var count =1;
    $("#addnew").click(function(){
		
        $(".maindiv").append('<div class="row delete-row" id="'+count+'">'+
		'<div class="col-md-5 col-sm-10"><label for="Name">Label<span class="required-fields"></span></label><div class="form-group"><input id="NameFirst" name="link'+count+'" type="text" placeholder="Facebook..." class="form-control"></div></div><div class="col-md-5 col-sm-10"><label for="Name">URL<span class="required-fields"></span></label><div class="form-group"><input id="NameFirst" name="firstName" type="text" placeholder="Facebook.." class="form-control"></div></div><div class="col-md-2 col-sm-2"><label for="Name"></label><div class="remove form-group"><i class="fa fa-remove text-red remove pull-right"  data-toggle="tooltip" title="Remove Link" ></i></div></div></div>');
count++;
}); 

$(document).on("click",".remove",function(){
	  $(this).parents(".delete-row").remove();
	   
	  
	});*/
	
	var validate = 'true';
$('#email').blur(function(){
        var email_val = $("#email").val();
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
        if(filter.test(email_val)){
            // show loader
			
			if(email_val!='<?=$User->email?>'){
            $.post("<?php echo base_url()?>Investor/email_check", {
                email: email_val
            }, function(response){
				validate = 'false';
                $('#message').html('').html(response.message).show().delay(5000).fadeOut();
				
            });
			
			}
			validate = 'true';
            return false;
			
        }
    
    
    });
	
$('#currentpassword').blur(function(){            // password check 
            var password = $("#currentpassword").val();
		    var id       = <?=$User->userID?>;
		    var postData = {id: id, password: password};
            $.ajax({
						url: baseUrl + "Investor/password_check",
						data: postData,
						type: "POST",
						success: function (data) {
						   if (data == '0') 
						   {
							   $('#pass-error').html('Please Enter a valid Password').show().delay(5000).fadeOut();
				                return false;
						   }
						}
					});
         
    
    
    });	
$("#save_security").on("click", function () {
	         var current_e= $(this);
	         var email    = $("#email").val();
			 var newp     = $("#password").val();  // add new password
		     var cnp      = $("#cpassword").val(); // retype new  password
			 var password = $("#currentpassword").val();
			 var oldpass  = '<?= $User->password?>';     //old password
			  if(newp !=cnp)
					{ 
					  $('#error').html('Password did not match').show().delay(5000).fadeOut();
					}
			 else if(email == '') 
				  {
			        $('#email-error').html('Please Enter a valid Email Address').show().delay(5000).fadeOut();
				    return false;
				  }
			else if(validate == 'false') 
				  {
			        $('#email-error').html('The email is already taken, choose another one').show().delay(5000).fadeOut();
				    return false;
				  }	  
			/*else if(password !=oldpass)
			      {
					 $('#pass-error').html('Please Enter a valid Password').show().delay(5000).fadeOut();
				      return false;
				  } */
			else{ 
				 var user_id   = <?=$User->userID?>;
				 var email     = $("#email").val();
				 var cpassword = $("#currentpassword").val();
				 var password  = $("#password").val();
				 
				 var postData  = {id: user_id, email: email,password:password,cpassword:cpassword};
					$.ajax({
						url: baseUrl + "admin/investor/edit_investor_profile/security",
						data: postData,
						type: "POST",
						success: function (output) {
						   if (output == 'ok') 
						   {
						      $('#mydiv').addClass('.alert alert-success');
							  $('#mydiv').html('Your Information updated Successfully!').show().delay(5000).fadeOut(3000);
							  $(current_e).closest('.edit-question').removeClass('in');
						   }
						}
					});
			}
         });
           
$('#cpassword').blur(function(){
         var newp = $("#password").val();
		 var cnp  = $("#cpassword").val();
		    if(newp !=cnp)
				{ 
				$('#error').html('Password did not match').show().delay(5000).fadeOut();
				}
	 });

$("#save_social").on("click", function () {
	         var current_e    = $(this);
	         var user_id     = <?=$User->userID?>;
             var facebook    = $("#facebook").val();
			 var twitter     = $("#twitter").val();
		     var google      = $("#google").val();
			 var linkedIn    = $("#linkedIn").val();
			 var youTube     = $("#youTube").val();
			 var vimeo       = $("#vimeo").val();
			 var postData  = {
				              id: user_id,
							  facebook: facebook,
							  twitter:twitter,
							  google:google,
							  linkedIn:linkedIn,
							  youTube:youTube,
							  vimeo:vimeo
							 };
			 $.ajax({
					url: baseUrl + "admin/investor/edit_investor_profile/social",
					data: postData,
					type: "POST",
					success: function (output) {
					if (output == 'ok') 
					{
					 $('#mydiv').addClass('.alert alert-success');
					 $('#mydiv').html('Your Information updated Successfully!').show().delay(5000).fadeOut(3000);
					 $(current_e).closest('.edit-question').removeClass('in');
				    }
					}
				});
		  });
$(".save_quesiton").on("click", function () {
	         var currentl_element = $(this);
	         var qno         = $(this).attr('id');
			 var user_id     = <?=$User->userID?>;
			 var value       =  $(this).closest('.form-group').find('.question_options').val(); //$(".e_st_investor").val();
			 var postData  = {
				              id: user_id,
							  qno: qno,
							  value:value 
							  };
			 $.ajax({
					url: baseUrl + "admin/investor/edit_investor_profile/question",
					data: postData,
					type: "POST",
					success: function (output) {
					if (output == 'ok') 
					{
					  if(value == "1"){
					      $(currentl_element).closest('.question-post').find(".answer-solution").text("Yes");
                             if(qno=="al_fd_company"){
                                 $('.displycompanydetail').addClass('display-block');
                                 $('.displycompanydetail').removeClass('display-none');
                                }
					  }else if(value == "0"){ 
					  	$(currentl_element).closest('.question-post').find(".answer-solution").text("No");
					  }	 
						
					 $('#mydiv').addClass('.alert alert-success');
					 $('#mydiv').html('Your Information updated Successfully!').show().delay(5000).fadeOut(3000);
					  $(currentl_element).closest('.edit-question').removeClass('in');
				    }
					}
				});
		  });
		  
$(".save_company_details").on("click", function () {  
	          var user_id     =  <?=$User->userID?>;
			  var current_es    = $(this);
			  var c_name      =  $(this).closest('.form-group').find('#company_name').val(); //$(".e_st_investor").val();
			  var c_email     =  $(this).closest('.form-group').find('#company_email').val(); //$(".e_st_investor").val();
			  var postData  = {
				              id: user_id,
							  c_name: c_name,
							  c_email:c_email 
							  };
			 $.ajax({
					url: baseUrl + "admin/investor/edit_investor_profile/company_detail",
					data: postData,
					type: "POST",
					success: function (output) {
					if (output == 'ok') 
					{
                     $(current_es).closest(".ser").removeClass('in');
					 $('#mydiv').addClass('alert alert-success');
					 $('#mydiv').html('Your Information  updated Successfully!').show().delay(5000).fadeOut(3000);
                     $('.show_company_n').html("Company Name:   "+c_name);
                     $('.show_company_e').html("Company Email:  "+c_email);

				    }
					}
				});
		  });
$("#situation").on("click", function () { 
              var current     = $(this);            
	          var user_id     = <?=$User->userID?>;
			  if($(this).closest('.form-group').find('#situation1').is(":checked")) 
			      {
					  var situation1  =  '1';
				  }
				  else
				  {
					  var situation1  =  '0';  
				   }
		      if($(this).closest('.form-group').find('#situation2').is(":checked")) 
			      {
					  var situation2  =  '1';
				  }
				  else
				  {
					  var situation2  =  '0';  
				   }
			  if($(this).closest('.form-group').find('#situation3').is(":checked")) 
			      {
					  var situation3  =  '1';
				  }
				  else
				  {
					  var situation3  =  '0';  
				  }      
			  var postData  = {
				              id: user_id,
							  situation1: situation1,
							  situation2: situation2,
							  situation3: situation3
							  };
			 $.ajax({
					url: baseUrl + "admin/investor/edit_investor_profile/situation",
					data: postData,
					type: "POST",
					success: function (output) {
					if (output == 'ok') 
					{
				       
					 if(situation1 == '1') 
			            {
					      $(current).closest('.situation').find('.situation1').addClass('display-block');
						  $(current).closest('.situation').find('.situation1').removeClass("display-none");
				        }
				     else
				        {
					       $(current).closest('.situation').find('.situation1').addClass('display-none');
						   $(current).closest('.situation').find('.situation1').removeClass('display-block');
				        }
						
				      if(situation2 == '1') 
			            {
					      $(current).closest('.situation').find('.situation2').addClass('display-block');
						  $(current).closest('.situation').find('.situation2').removeClass('display-none');
				        }
				     else
				        {
					       $(current).closest('.situation').find('.situation2').addClass('display-none');
						   $(current).closest('.situation').find('.situation2').removeClass('display-block');
				        }
					if(situation3 == '1') 
			            {
					      $(current).closest('.situation').find('.situation3').addClass('display-block');
						  $(current).closest('.situation').find('.situation3').removeClass('display-none');
				        }
				     else
				        {
					       $(current).closest('.situation').find('.situation3').addClass('display-none');
						   $(current).closest('.situation').find('.situation3').removeClass('display-block');
				        }	 
					  
					 $('#mydiv').addClass('.alert alert-success');
					 $('#mydiv').html('Your Information  updated Successfully!').show().delay(5000).fadeOut(3000);
					 $(current).closest('.edit-question').removeClass('in');
				    }
					}
				});
		  });
		  
$("#certificate").on("click", function () {
	         var user_id      = <?=$User->userID?>;
			 var current_e    = $(this);
             var certificate  =  $(this).closest('.form-group').find('#certificates').val();
			 var postData    = {
				              id: user_id,
							  certificate: certificate,
							  };
			 $.ajax({
					url: baseUrl + "admin/investor/edit_investor_profile/certificate",
					data: postData,
					type: "POST",
					enctype: 'multipart/form-data',
					success: function (output) {
					if (output == 'ok') 
					{
					 $('#mydiv').addClass('.alert alert-success');
					 $('#mydiv').html('Your Information updated Successfully!').show().delay(5000).fadeOut(3000);
					 $(current_e).closest('.edit-question').removeClass('in');
				    }
					}
				});
		  });	
		  
 $(".about").on("click", function () {                    //update first name and last name and about
              var current_e    = $(this);
	          var user_id      = <?=$User->userID?>; 
			  var value        =  $(this).closest('.form-group').find('.form-control').val();
			  var input_id     =  $(this).closest('.form-group').find('.form-control').attr('id');
			  var postData     = {
				               id: user_id,
							   value: value,
							   input_id:input_id,  
							   };
			 $.ajax({
					url: baseUrl + "admin/investor/edit_investor_profile/about",
					data: postData,
					type: "POST",
				    success: function (output) {
					if (output == 'ok') 
					{
					 $(current_e).closest('.post').find(".change_text").text(value);
					 $('#mydiv2').addClass('.alert alert-success');
					 $('#mydiv2').html('Your Information updated Successfully!').show().delay(5000).fadeOut(3000);
					 $(current_e).closest('.edit-question').removeClass('in');
					 
				    }
					}
				});
		  });
 
 $("#address").on("click", function () {                    //update first name and last name 
              var current_e    = $(this);
	          var user_id      = <?=$User->userID?>;
              var value        =  $(this).closest('.form-group').find('.form-control').val();
			  var postData     = {
				               id: user_id,
							   address: value,
							   };
			  $.ajax({
				   	url: baseUrl + "admin/investor/edit_investor_profile/address",
					data: postData,
					type: "POST",
				    success: function (output) {
					if (output == 'ok') 
					{
					 $(current_e).closest('.post').find(".change_text").text(value);
					 $('#mydiv2').addClass('.alert alert-success');
					 $('#mydiv2').html('Your Information updated Successfully!').show().delay(5000).fadeOut(3000);
					 $(current_e).closest('.edit-question').removeClass('in');
				    }
					}
				});
		  }); 
		  
$("#upload_Profile_image").on('submit',(function(e){ //upload profile Image   
	  var current = $(this);
	  e.preventDefault();
      $.ajax({
	  url :  baseUrl + "admin/investor/edit_profile_picture/<?=$User->userID?>",
      type: "POST",
      data:  new FormData(this),
      contentType: false,
      cache: false, 
      processData:false,
      success: function(data){
	   $("#Profile_image").attr("src","<?= base_url()?>uploads/investor/" + data);
	   $('#mydiv2').addClass('.alert alert-success');
	   $('#mydiv2').html('Your Information  updated Successfully!').show().delay(5000).fadeOut(3000);
	   $(current).closest('.edit-question').removeClass('in');
		  
      } 
      });
   }));
		  
		  
 
 }); //close funct		 
 
 setTimeout(function() {
      $('#mydiv').fadeOut(4000);
	  },4000); 
				 
 
</script> 
<script type="text/javascript">
$(document).ready(function (e){         // use to upload Sophisticated investor certificate upload here:
   $("#uploadimage").on('submit',(function(e){
	  var current = $(this);
	  e.preventDefault();
      $.ajax({
	  url :  baseUrl + "admin/investor/edit_certificate_picture/<?=$User->userID?>",
      type: "POST",
      data:  new FormData(this),
      contentType: false,
      cache: false, 
      processData:false,
      success: function(data){
	   $("#updatesrc").attr("src","<?= base_url()?>uploads/investor/" + data);
	   $('#mydiv').addClass('.alert alert-success');
	   $('#mydiv').html('Your Information  updated Successfully!').show().delay(5000).fadeOut(3000);
	   $(current).closest('.edit-question').removeClass('in');
		  
      } 
      });
   }));
});
</script>
 