<?php 
    if(isset($id) && !empty($id)){
        $id = $id;
    }else{
        return 'Sorry No ID Set';
    }
    if(isset($data) && !empty($data)){
    $name       = $data->name; 
    $phone      = $data->phone; 
    $website    = $data->website; 
    $email      = $data->email;

    $status_flag_id = $data->status_flag_id;

    //Address Fields
    $address_streetNumber = $data->address_street_number;
    $address_streetName = $data->address_street_name;
    $address_town = $data->address_town;
    $address_state = $data->address_state;
    $address_postCode = $data->address_post_code;

    //Default Address Block set to false, Not To Show.
    $address = false;

    $address_arguments = [
        $address_streetNumber,
        $address_streetName,
        $address_town,
        $address_state,
        $address_postCode,
    ];

    //This Function will only work in PHP 5.6 and above :)
    if(!( $result = m_empty(...$address_arguments))){
        //If any of the value in array is not empty should be considered not empty address and address box should show up.
        //Not Empty
        $address = true;
    }else{
        //If All the address fields are empty, then box does not need to be shown.
        //If Empty
        $address = false;
    }
    
    $keywords   = $data->keywords; 
    $banner     = $data->banner; 
    $logo       = $data->logo; 

    $short_description  = $data->short_description; 
    $long_description   = $data->long_description; 

    }else{

        $name       = ''; 
        $phone      = ''; 
        $website    = ''; 
        $email      = ''; 
        $address    = ''; 
        $keywords   = ''; 
        $banner     = ''; 
        $logo       = ''; 

        $status_flag_id = '';

        $short_description  = ''; 
        $long_description   = ''; 
    }
    $StatusName = '';
    if(isset($itemStatuses) && !empty($itemStatuses)){
        foreach ($itemStatuses as $key => $itemStatus){
            $StatusDbID   = $itemStatus->id; 
            $StatusDbName = $itemStatus->name;
            if($status_flag_id == $StatusDbID){
                $StatusName = $StatusDbName;
            } 
        }

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
                <?php if(!empty($email)){ ?>
                    <div class="email-container">
                        <label for="">Email:</label>
                        <p class=""><?= $email; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($phone)){ ?>
                    <div class="phone-container">
                        <label for="">phone:</label>
                        <p class=""><?= $phone; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($StatusName)){ ?>
                    <div class="statusFlag-container">
                        <label for="">Status:</label>
                        <p class=""><?= $StatusName; ?></p>
                    </div>
                <?php } ?>
                <?php if($address){ ?>
                    <div class="address-container">
                        <div class="address-text">
                            <strong><i class="fa fa-globe margin-r-5"></i>Address</strong>
                            <?php if(!empty($address_streetNumber)){?>
                                <div class="text-muted">Street Number: <span class="street_number"><?=$address_streetNumber;?></span></div>
                            <?php } ?>
                            <?php if(!empty($address_streetName)){?>
                                <div class="text-muted">Street Name: <span class="street_name"><?=$address_streetName;?></span></div>
                            <?php } ?>
                            <?php if(!empty($address_town)){?>
                                <div class="text-muted">Town: <span class="town"><?=$address_town?></span></div>
                            <?php } ?>
                            <?php if(!empty($address_state)){?>
                                <div class="text-muted">State: <span class="state"> <?=$address_state?> </span></div>
                            <?php } ?>
                            <?php if(!empty($address_postCode)){?>
                                <div class="text-muted">Post Code: <span class="post_code"><?=$address_postCode?></span></div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

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
                    <?php if(!empty($banner)){ ?>
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
                    <?php } ?>

                    <li>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Short Description:</h3>
                          <div id="short-desc-text" class="timeline-body">
                                <pre><?= trim(urldecode($short_description));?></pre>
                          </div>
                        </div>
                    </li>      
                </ul>
                <ul class="timeline timeline-inverse">
                    <li>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Detail Description:</h3>
                          <div id="short-desc-text" class="timeline-body">
                                <pre><?= trim(urldecode($long_description));?></pre>
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