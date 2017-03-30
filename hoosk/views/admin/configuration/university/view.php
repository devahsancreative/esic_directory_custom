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
        $contactName        = $data->contactName;

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
        $contactName        = '';
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
                <?php if(!empty($ProgramStartDate)){ ?>
                    <div class="text-container">
                        <label for="">Program Start Date:</label>
                        <p class=""><?= $ProgramStartDate; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($contactName)){ ?>
                    <div class="contactName-container">
                        <label for="">Contact Name:</label>
                        <p class=""><?= $contactName; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($email)){ ?>
                    <div class="email-container">
                        <label for="">Contact Email:</label>
                        <p class=""><?= $email; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($roleDepartment)){ ?>
                    <div class="text-container">
                        <label for="">Contact role Department:</label>
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
                    <li>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Program Description:</h3>
                          <div id="short-desc-text" class="timeline-body">
                                <pre><?= trim(urldecode($programDescription));?></pre>
                          </div>
                        </div>
                    </li>    
                    <li>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Program Eligibility Criteria:</h3>
                          <div id="short-desc-text" class="timeline-body">
                                <pre><?= trim(urldecode($programEligibilityCriteria));?></pre>
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