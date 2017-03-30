<?php 
if(!isset($ListingName) || empty($ListingName)){
    $ListingName = '';
}
if(!isset($ListingLabel) || empty($ListingLabel)){
    $ListingLabel = '';
}
if(!isset($ControllerRouteName) || empty($ControllerRouteName)){
    $ControllerRouteName = '';
}
?>
<style type="text/css">
    .centerLogo{
        text-align: center;
    }
     .img-logo{
            max-width: 350px;
            width: 100%;
            margin: 0 auto;
        }
        .img-logo img{
            width: 100%;
        }
        .btn-logo-edit{
            bottom: 0px;
            width: 100%;
            max-width: 200px;
            margin: 10px auto;
            background: rgba(0,0,0,0.5);
            color: #fff;
            cursor: pointer;
        }
</style>
    <!-- Content Header (Page header) -->
<section class="content-header">
        <h1>
            <?= $ListingLabel ; ?>
            <small>Add</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><?= $ListingLabel ; ?></a></li>
            <li class="active">Add</li>
        </ol>
</section>
    <?php 
        if(isset($id) && !empty($id)){
        $id = $id;
    }else{
        return 'Sorry No ID Set';
    }
    if(isset($data) && !empty($data)){
        $name    = $data->institution;
        $phone   = $data->phone;
        $website = $data->website;
        $email   = $data->email;

        //Getting Address Fields
        $address    = $data->address;
        $suburb     = $data->suburb;
        $state      = $data->state;
        $post_code  = $data->post_code;

        //$banner = $data->banner;
        $logo = $data->institutionLogo;


        $programDescription = $data->programDescription;
        $programEligibilityCriteria = $data->programEligibilityCriteria;
        $ProgramStartDate   = $data->ProgramStartDate;
        $roleDepartment     = $data->roleDepartment;



    }else{

        $name    = '';
        $phone   = '';
        $website = '';
        $email   = '';

        //Getting Address Fields
        $address    = '';
        $suburb     = '';
        $state      = '';
        $post_code  = '';

        //$banner = '';
        $logo = '';


        $programDescription = '';
        $programEligibilityCriteria = '';
        $ProgramStartDate   = '';
        $roleDepartment     = '';
    }
    $ci =& get_instance();
    $ci->load->model("Common_model"); 
?>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile" id="profile-box-container" data-user-id="<?= $id;?>" data-img="<?= FCPATH.$logo?>">
            <?php 
                    if(!empty($logo) and is_file(FCPATH.$logo)){ 
                      $logoImage = base_url().'/'.$logo;
                    }else{
                       $logoImage = base_url('pictures/defaultLogo.png');
                    }

            ?>
                <div class="user-logo-container">
                  <img id="User-Logo" class="profile-user-img img-responsive" src="<?= $logoImage; ?>" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">
                    <b><?= $name;?></b>
                </h3>
                <?php if(!empty($website)){ ?>
                <div class="web-container">
                    <label for="">Website:</label>
                    <a href="<?= $website; ?>" class="btn btn-primary btn-block" target="_blank">
                        <?= $website; ?>
                    </a>
                </div>
                 <?php } ?>
                <?php if(!empty($email)){ ?>
                    <div class="email-container">
                        <label for="">Email:</label>
                        <p class=""><?= $email; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($ProgramStartDate)){ ?>
                    <div class="text-container">
                        <label for="">Program Start Date:</label>
                        <p class=""><?= $ProgramStartDate; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($roleDepartment)){ ?>
                    <div class="text-container">
                        <label for="">role Department:</label>
                        <p class=""><?= $roleDepartment; ?></p>
                    </div>
                <?php } ?>
                    <div class="address-container">
                        <div class="address-text">
                            <strong><i class="fa fa-globe margin-r-5"></i>Address</strong>
                            <?php if(!empty($address)){?>
                                <div class="text-muted">address: <span class="address"><?=$address;?></span></div>
                            <?php } ?>
                            <?php if(!empty($suburb)){?>
                                <div class="text-muted">suburb: <span class="suburb"><?=$suburb;?></span></div>
                            <?php } ?>
                            <?php if(!empty($state)){?>
                                <div class="text-muted">State: <span class="state"> <?=$state?> </span></div>
                            <?php } ?>
                            <?php if(!empty($post_code)){?>
                                <div class="text-muted">Post Code: <span class="post_code"><?=$post_code?></span></div>
                            <?php } ?>
                        </div>
                    </div>

                <div class="text-center">
                    <a href="<?= base_url().$ControllerRouteName.'/Listing'?>" class="btn addNewBtn btn-primary">Go To Listing</a>
                    <a href="<?= base_url().$ControllerRouteName.'/Edit/'.$id;?>" class="btn addNewBtn btn-primary">Edit</a>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="description">
                <ul class="timeline timeline-inverse">
                    <?php/* if(!empty($banner)){ ?>
                     <li>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Banner:</h3>
                            <div class="form-group">
                                <div class="img-reponsive">
                                    <div class="img-container img-logo img-responsive">
                                        <img src="<?= base_url().$banner;?>" class="banner-show" id="banner-show" />
                                    </div>
                                </div>
                            </div>
                       </div>
                    </li>      
                    <?php } */?>

                    <li>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Program Description:</h3>
                          <div id="short-desc-text" class="timeline-body">
                                <pre><?= trim(urldecode($programDescription));?></pre>
                          </div>
                        </div>
                    </li>      
                </ul>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
</style>
