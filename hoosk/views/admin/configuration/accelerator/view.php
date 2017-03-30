<?php
    if(isset($id) && !empty($id)){
        $id = $id;
    }else{
        return 'Sorry No ID Set';
    }
    if(isset($data) && !empty($data)){
        $name    = $data->name;
        $website = $data->website;

        //Getting Address Fields
        $address    = $data->address;
        $post_code  = $data->post_code;

        $logo = $data->logo;

        $Program_Summary    = $data->Program_Summary;
        $Program_Criteria   = $data->Program_Criteria;
        $Program_Start_Date = $data->Program_Start_Date;
        $Program_Application_Contact = $data->Program_Application_Contact;
        $Program_Application_Method  = $data->Program_Application_Method;
        $AcceleratorStatus  = $data->AcceleratorStatus;



    }else{
        $name    = '';
        $website = '';

        //Getting Address Fields
        $address    = '';
        $post_code  = '';

        $logo = '';

        $Program_Summary    = '';
        $Program_Criteria   = '';
        $Program_Start_Date = '';
        $Program_Application_Contact = '';
        $Program_Application_Method  = '';
        $AcceleratorStatus  = '';
    }
?>
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
                <?php if(!empty($Program_Start_Date)){ ?>
                    <div class="text-container">
                        <label for="">Program Start Date:</label>
                        <p class=""><?= $Program_Start_Date; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($AcceleratorStatus)){ ?>
                <div class="web-container">
                    <label for="">Accelerator Status:</label>
                    <p class="">
                    <?php 
                      if($AcceleratorStatus == 'Eligible'){
                          echo '<span class="label label-success success">Eligible</span>';
                      }else if($AcceleratorStatus == 'Pending'){
                          echo '<span class="label label-danger danger">Pending</span>';
                      }else{
                          echo '<span class="label label-warning warning">Not Selected</span>';
                      }
                    ?>
                    </p>
                </div>
                 <?php } ?>
                    <div class="address-container">
                        <div class="address-text">
                            <strong><i class="fa fa-globe margin-r-5"></i>Address</strong>
                            <?php if(!empty($address)){?>
                                <div class="text-muted">address: <span class="address"><?=$address;?></span></div>
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
                    <li>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Program Summary:</h3>
                          <div id="short-desc-text" class="timeline-body">
                                <pre><?= trim(urldecode($Program_Summary));?></pre>
                          </div>
                        </div>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Program Criteria:</h3>
                          <div id="short-desc-text" class="timeline-body">
                                <pre><?= trim(urldecode($Program_Criteria));?></pre>
                          </div>
                        </div>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Program Application Method:</h3>
                          <div id="short-desc-text" class="timeline-body">
                                <pre><?= trim(urldecode($Program_Application_Method));?></pre>
                          </div>
                        </div>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Program Application Contact:</h3>
                          <div id="short-desc-text" class="timeline-body">
                                <pre><?= trim(urldecode($Program_Application_Contact));?></pre>
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