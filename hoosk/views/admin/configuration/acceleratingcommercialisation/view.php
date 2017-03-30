<?php 
        if(isset($id) && !empty($id)){
        $id = $id;
    }else{
        return 'Sorry No ID Set';
    }
       if(isset($data) && !empty($data)){
        $Member             = $data->Member;
        $Web_Address        = $data->Web_Address;

        //Getting Address Fields
        $Project_Location   = $data->Project_Location;
        $State_Territory    = $data->State_Territory;
        $postal_code        = $data->postal_code;

        //$banner = $data->banner;
        $logo               = $data->accLogo;

        $Project_Title      = $data->Project_Title;
        $Project_Summary    = $data->Project_Summary;
        $Market             = $data->Market;
        $Technology         = $data->Technology;
        $short_description  = $data->short_description;
        $long_description   = $data->long_description;



    }else{

        $Member                 = '';
        $Web_Address            = '';

        //Getting Address Fields
        $Project_Location       = '';
        $State_Territory        = '';
        $postal_code            = '';

        //$banner               = '';
        $logo                   = '';

        $Project_Title          = '';
        $Project_Summary        = '';
        $Market                 = '';
        $Technology             = '';
        $short_description      = '';
        $long_description       = '';
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
                    <b><?= $Member;?></b>
                </h3>
                <?php if(!empty($Web_Address)){ ?>
                <div class="web-container">
                    <label for="">Website:</label>
                    <a href="<?= $Web_Address; ?>" class="btn btn-primary btn-block" target="_blank">
                        <?= $Web_Address; ?>
                    </a>
                </div>
                 <?php } ?>
                    <div class="address-container">
                        <div class="address-text">
                            <strong><i class="fa fa-globe margin-r-5"></i>Address</strong>
                           
                            <?php if(!empty($Project_Location)){?>
                                <div class="text-muted">Project Location: <span class="suburb"><?=$Project_Location;?></span></div>
                            <?php } ?>

                            <?php if(!empty($postal_code)){?>
                                <div class="text-muted">Post Code: <span class="state"> <?=$postal_code?> </span></div>
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
                          <h3 class="timeline-header">Project:</h3>
                          <div class="project-container">
                              <div class="project-text">
                                  <?php if(!empty($Project_Title)){?>
                                      <div class="form-group">
                                        <label>Project Title: </label>
                                        <span class="Project_Title"><?=$Project_Title;?></span>
                                      </div>
                                  <?php } ?>

                                  <?php if(!empty($Market)){?>
                                      <div class="form-group">
                                      <label>Market: </label>
                                      <span class="market"> <?= $Market?> </span></div>
                                  <?php } ?>

                                  <?php if(!empty($Technology)){?>
                                      <div class="form-group">
                                      <label>Technology: </label>
                                      <span class="Technology"> <?=$Technology?></span></div>
                                  <?php } ?>
                              </div>
                           </div>
                        </div>
                    </li>      
                    <li>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Project Summary:</h3>
                          <div id="short-desc-text" class="timeline-body">
                                <pre><?= trim(urldecode($Project_Summary));?></pre>
                          </div>
                        </div>
                    </li>      
                    <li>
                        <div class="timeline-item">
                          <h3 class="timeline-header">Short Description:</h3>
                          <div id="short-desc-text" class="timeline-body">
                                <pre><?= trim(urldecode($short_description));?></pre>
                          </div>
                        </div>
                    </li>      
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