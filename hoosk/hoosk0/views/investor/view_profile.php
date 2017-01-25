   <style>


/*=========================
  Icons
 ================= */

/* footer social icons */
ul.social-network {
	list-style: none;
	display: inline;
	padding: 0;
    float: right;
    margin: 15px 0px 15px;
}
ul.social-network li {
	display: inline;
	margin: 0 5px;
}


/* footer social icons */
.social-network a.icoRss:hover {
	background-color: #F56505;
}
.social-network a.icoFacebook:hover {
	background-color:#3B5998;
}
.social-network a.icoTwitter:hover {
	background-color:#33ccff;
}
.social-network a.icoGoogle:hover {
	background-color:#BD3518;
}
.social-network a.icoVimeo:hover {
	background-color:#0590B8;
}
.social-network a.icoLinkedin:hover {
	background-color:#007BB6;
}

.social-network a.icoInstagram:hover {
	background-color:#3F729B;
}

.social-network a.icoYelp:hover {
	background-color:#CB2027;
}

.social-network a.icoRss:hover i, .social-network a.icoFacebook:hover i, .social-network a.icoTwitter:hover i,
.social-network a.icoGoogle:hover i, .social-network a.icoVimeo:hover i, .social-network a.icoLinkedin:hover i,
.social-network a.icoInstagram:hover i, .social-network a.icoYelp:hover i {
	color:#fff;
}
a.socialIcon:hover, .socialHoverClass {
	color:#44BCDD;
}

.social-circle li a {
	display:inline-block;
	position:relative;
	margin:0 auto 0 auto;
	-moz-border-radius:50%;
	-webkit-border-radius:50%;
	border-radius:50%;
	text-align:center;
	width: 35px;
	height: 35px;
	font-size:18px;
}
.social-circle li i {
	margin:0;
	line-height:50px;
	text-align: center;
}

.social-circle li a:hover i, .triggeredHover {
	-moz-transform: rotate(360deg);
	-webkit-transform: rotate(360deg);
	-ms--transform: rotate(360deg);
	transform: rotate(360deg);
	-webkit-transition: all 0.2s;
	-moz-transition: all 0.2s;
	-o-transition: all 0.2s;
	-ms-transition: all 0.2s;
	transition: all 0.2s;
}
.social-circle i {
	color: #fff;
	-webkit-transition: all 0.8s;
	-moz-transition: all 0.8s;
	-o-transition: all 0.8s;
	-ms-transition: all 0.8s;
	transition: all 0.8s;
}

.social-network a {
 background-color: #D3D3D3;   
}
 /*////////////////////////////////////////////////////////*/
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
      <section class="content-header">
            <h1>
                View Profile
                <small> </small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url()?>/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">View Profile</a></li>
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
          </div>
         </div>
  <div class="col-md-9 post social">
          <h3><?= $User->firstName ."  ". $User->lastName;?></h3>
		     <p class="change_text"><?= $User->about;?></p>
 <ul>
  <?php  
	foreach($User_social as $User_link){?>
     <div class="col-md-12">
      <ul class="social-network social-circle">
         <?php if($User_link->facebook){?>
         <li><a href="<?=$User_link->facebook;?>" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
         <?php }?>
         <?php if($User_link->twitter){?>
         <li><a href="<?=$User_link->twitter;?>" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
         <?php }?>
         <?php if($User_link->google){?>
         <li><a href="<?=$User_link->google;?>" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a></li>
         <?php }?>
         <?php if($User_link->vimeo){?>
         <li><a href="<?=$User_link->vimeo;?>" class="icoInstagram" title="vimeo"><i class="fa fa-vimeo"></i></a></li>
         <?php }?>
         <?php if($User_link->youTube){?>
         <li><a href="<?=$User_link->youTube;?>" class="icoYelp" title="youTube"><i class="fa fa-youtube"></i></a></li>
         <?php }?>
         <?php if($User_link->linkedIn){?>
         <li><a href="<?=$User_link->linkedIn;?>" class="icoTwitter" title="linkedIn"><i class="fa fa-linkedin"></i></a></li>
         <?php }?>
    </ul>				
 </div> 
<?php } ?>  

  </div> 
</div>  
					
		 			
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
       </span>
  </div>
<p class="text-muted change_text">
       <?php  if(!empty($User->firstName)){echo $User->firstName; } ?>
</p>
 </div>
<div class="post question-post question-1" data-id="question-1">
        <span class="username question-statement">
              <strong><i class="fa fa-user margin-r-5"></i>Last Name</strong>
        </span>
        <p class="text-muted change_text">
           <?php   if(!empty($User->lastName)){ echo $User->lastName; }  ?>
        </p>
 
</div>
<div class="post question-post question-1" data-id="question-1">
       <span class="username question-statement">
              <strong><i class="fa fa-envelope margin-r-5"></i>Email</strong>
        </span>
         <p class="text-muted">
              <?php  if(!empty($User->email)){ echo $User->email; }?>
         </p>
 </div>
 <div class="post question-post question-1" data-id="question-1">
      <span class="username question-statement">
             <strong><i class="fa fa-envelope margin-r-5"></i>Address</strong>
       </span>
       <p class="text-muted change_text">
            <?php  if(!empty($User->address)){ echo $User->address;  }  ?>
       </p>
 </div>
             
            </div>
            <!-- /.box-body -->
          </div>
          </div> 
         
<div class="col-md-6">
      <div class="box box-primary">
         <div class="box-header with-border">
            <h3 class="box-title">Questions</h3>
         </div>    
    <div class="tab-content">
                
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

 <div class="post question-post question-1 <?php if($User->al_fd_company == '1'){echo ' display-block';
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
 <p class="answer-solution">Company Name:  <?= $User->company_name?></p>
 <p class="answer-solution">Company Email: <?= $User->company_email?></p>
      <div class="edit-question" id="q4">
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
           
         
           
                 

     
</div>
            <!-- /.tab-content -->
    
		 
     </div>
   </div>
</section> 
<?php }} ?> 
   
 
 