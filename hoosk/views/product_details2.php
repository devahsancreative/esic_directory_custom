<?php
if(!empty($list)){
    $count=0;
    foreach($list as $key=>$user){
        $count++;
        $status='';
        $web='';
        $desc='';
        $img ='';
        $bgimg ='';
        $productImg = '';
        $AccImg = '';
        $AccCoImg ='';
        $rndLogo = '';
        $institutionLogo ='';
        $secLogo = '';
        if(!empty($user['Status'])){
            $status = $user['Status'];
        }
        if(!empty($user['Web'])){
            $web = '<a target="_blank" href="http://'.$user['Web'].'" class="website">'.$user['Web'].'</a>';
        }

        $desc =   $user['BusinessShortDesc'];

        if(isset($user['Logo']) and !empty($user['Logo']) and is_file(FCPATH.'/'.$user['Logo'])){
            $img = base_url($user['Logo']);
        }else{
            $img = base_url('pictures/defaultLogo.png');
        }
        if(isset($user['bannerImage']) and !empty($user['bannerImage']) and is_file(FCPATH.'/'.$user['bannerImage'])){
            $bgimg = base_url($user['bannerImage']);
        }else{
            $bgimg = base_url('pictures/defaultBanner.jpg');
        }
        if(isset($user['productImage']) and !empty($user['productImage']) and is_file(FCPATH.'/'.$user['productImage'])){
            $productImg = base_url($user['productImage']);
        }else{
            $productImg = base_url('pictures/defaultLogo.jpg');
        }
        if(isset($user['AccLogo']) and !empty($user['AccLogo']) and is_file(FCPATH.'/'.$user['AccLogo'])){
            $AccImg = base_url($user['AccLogo']);
        }else{
            $AccImg = base_url('pictures/defaultLogo.jpg');
        }
        if(isset($user['AccCoLogo']) and !empty($user['AccCoLogo']) and is_file(FCPATH.'/'.$user['AccCoLogo'])){
            $AccCoImg = base_url($user['AccCoLogo']);
        }
        if(isset($user['secLogo']) and !empty($user['secLogo']) and is_file(FCPATH.'/'.$user['secLogo'])){
            $secLogo = base_url($user['secLogo']);
        }
        if(isset($user['institutionLogo']) and !empty($user['institutionLogo']) and is_file(FCPATH.'/'.$user['institutionLogo'])){
            $institutionLogo = base_url($user['institutionLogo']);
        }
        if(isset($user['rndLogo']) and !empty($user['rndLogo']) and is_file(FCPATH.'/'.$user['rndLogo'])){
            $rndLogo = base_url($user['rndLogo']);
        }
        $date1 = new DateTime($user['corporate_date']);
        $date2 = new DateTime($user['expiry_date']);
        $diff = $date2->diff($date1)->format("%a");
        ?>

<div id="single-container" class="single-item list-item hcard-search member_level_5">
    <div id="main-content" class="container">
       <div class="background-img-container"><img src="<?= $bgimg; ?>" alt="" class="left"></div>
            <div class="container-box">
                <div class="img-container logo-container">
                    <a href="#" class="permalink">
                        <img src="<?= $img; ?>" alt="" class="left">
                     </a>
                </div>
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#home">Overview</a></li>
                  <li><a data-toggle="tab" href="#menu1">Dates and Status</a></li>
                  <li><a data-toggle="tab" href="#menu2">Detail</a></li>
                </ul>
                <div class="tab-content">
                  <div id="home" class="tab-pane fade in active">
                        <div class="detail-container">
                            <?php if($user['FullName']!=''){ ?>
                                <div class="product-details">
                                    <label>Name:</label>
                                    <a href="#" class="permalink" >
                                        <h3><?= $user['FullName'] ?></h3>
                                    </a>
                                </div>
                            <?php  } if($user['Company']!=''){ ?>
                                <div class="product-details">
                                    <label>Company:</label>
                                    <p class="info-type"><?= $user['Company'];?></p>
                                </div>
                            <?php  }  if($user['sectorName']!=''){ ?>
                                <div class="product-details">
                                   <label>Sector:</label>
                                   <p class="info-type"><?= $user['sectorName']; ?></p>
                                       <!--
                                   <?php if($user['ESecAppStatus'] !=''){ ?>
                                        <label>ABR Sector:</label>
                                        <p class="info-type">
                                            <?= $user['ESecAppStatus'];?>
                                        </p>
                                    <?php  } ?>
                                   <?php  if($secLogo !=''){ ?>
                                       <div class="logos-img-container img-container">
                                            <img src="<?= $secLogo; ?>" alt="" class="left">
                                       </div>
                                    <?php  } ?>
                                    -->
                                </div>
                            <?php  } ?>
                            <?php if($user['address']!=''){ ?>
                                <div class="product-details">
                                    <label>Address:</label>
                                    <p class="info-type"><?= $user['address'];?></p>
                               </div>
                            <?php  } ?>
                            <?php if($web!=''){ ?>
                                <div class="product-details website-address">
                                    <label>Website:</label>
                                    <p><?= $web; ?></p>
                                </div>
                           <?php  } ?>
                            <?php if($desc !=''){ ?>
                                    <div class="description">
                                        <label>Summary:</label>
                                        <p><?= $desc ;?></p>
                                    </div>
                            <?php  } ?>
                            <?php if($productImg !=''){ ?>
                                <div class="img-container product-img-container">
                                    <label>Product Image:</label>
                                    <img src="<?= $productImg;?> " alt="" class="left">
                                </div>
                            <?php } ?>
                                <br />
                        </div>
                  </div>
                  <div id="menu1" class="tab-pane fade">
                        <div class="detail-container">
                             <div class="product-di-container">
                                <div class="small-details-container">
                                     <?php if($user['acn_number']!=''){ ?>
                                        <div class="product-details small-details">
                                            <label>ACN Number:</label>
                                            <p class="info-type"><?= $user['acn_number'];?></p>
                                        </div>
                                    <?php  } ?>
                                    <?php if($status!=''){ ?>
                                        <div class="product-details status-container small-details">
                                                <label>Status:</label>
                                                <?= $status;?>
                                        </div>
                                    <?php }
                                    if($diff!=''){ ?>
                                        <div class="product-details small-details">
                                            <label>Days to go:</label>
                                            <p class="info-type"><?= $diff;?></p>
                                       </div>
                                    <?php  } 
                                    if($user['corporate_date']!=''){ ?>
                                        <div class="product-details small-details">
                                            <label>Incorporate Date:</label>
                                            <p class="info-type"><?= $user['corporate_date'];?></p>
                                       </div>
                                    <?php  } ?>
                                    <?php if($user['expiry_date']!=''){ ?>
                                        <div class="product-details small-details">
                                            <label>Expiry Date:</label>
                                            <p class="info-type"><?= $user['expiry_date'];?></p>
                                        </div>
                                    <?php  } ?>
                                    <?php if($user['added_date']!=''){ ?>
                                       <div class="product-details small-details">
                                            <label>Added Date:</label>
                                            <p class="info-type"><?= $user['added_date'];?></p>
                                        </div>
                                    <?php  } ?>
                                </div>
                            </div>
                        </div>
                  </div>
                  <div id="menu2" class="tab-pane fade">
                        <div class="detail-container category-tab">
                         <?php if($user['institution']!=''){ ?>
                                <div class="category-container">
                                    <div class="category-box">
                                        <div class="category-details">
                                            <label>Institution:</label>
                                            <p class="info-type"><?= $user['institution'];?></p>
                                        </div>
                                           <?php if($user['EInAppStatus'] !=''){ ?>
                                         <div class="category-details">
                                                <label>ABR Institution:</label>
                                                <p class="info-type"><?= $user['EInAppStatus']; ?> </p>
                                        </div>
                                        <?php  } ?>
                                    </div>
                               <?php if($institutionLogo !=''){ ?>
                                    <div class="logos-img-container img-container category-img">
                                        <img src="<?= $institutionLogo;?> " alt="" class="left">
                                    </div>
                                <?php  } ?>
                                </div>
                            <?php  } ?>
                            <?php if($user['rndname']!=''){ ?>
                               <div class="category-container">
                                    <div class="category-box">
                                        <div class="category-details">
                                            <label>R&D Name:</label>
                                            <p class="info-type"><?= $user['rndname'];?> </p>
                                        </div>
                                        <?php if($user['RndAppStatus'] !=''){ ?>
                                         <div class="category-details">
                                               <label>ABR R&D:</label>
                                               <p class="info-type"><?= $user['RndAppStatus'];?></p>
                                        </div>
                                        <?php  } ?>
                                    </div>
                                <?php if($rndLogo !=''){ ?>
                                    <div class="logos-img-container img-container category-img">
                                        <img src="<?= $rndLogo; ?>" alt="" class="left">
                                    </div>
                                <?php  } ?>
                                </div>
                            <?php  } if($user['Member']!=''){ ?>
                                    <div class="category-container">
                                        <div class="category-box">
                                            <div class="category-details">
                                                <label>Commercialisation Australia:</label>
                                                <p class="info-type"><?= $user['Member']; ?></p>
                                            </div>
                                             <?php if($user['EAccCoAppStatus'] !=''){ ?>
                                                <div class="category-details">
                                                            <label>ABR Commercialisation Australia:</label>
                                                            <p class="info-type"><?= $user['EAccCoAppStatus']; ?></p>
                                                </div>
                                            <?php  } ?>
                                        </div>
                                        <?php if($AccCoImg !=''){ ?>
                                                <div class="logos-img-container img-container category-img">
                                                    <img src="<?= $AccCoImg ?>" alt="" class="left">
                                                </div>
                                       <?php  } ?>
                                    </div>
                            <?php  } ?>
                            <?php if($user['Accname']!=''){ ?>
                                    <div class="category-container">
                                        <div class="category-box">
                                            <div class="category-details">
                                                <label>Accelerator:</label>
                                                <p class="info-type"><?= $user['Accname']; ?></p>
                                            </div>
                                            <?php if($user['EAccAppStatus'] !=''){ ?>
                                                <div class="category-details">
                                                   <label>ABR Accelerator:</label>
                                                   <p class="info-type"><?= $user['EAccAppStatus']; ?></p>
                                                </div>
                                            <?php  } ?>
                                        </div>
                                        <?php if($AccImg !=''){ ?>
                                            <div class="logos-img-container img-container category-img">
                                                <img src="<?= $AccImg ?>" alt="" class="left">
                                            </div>
                                        <?php  } ?>
                                    </div>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
     <?php  } 

}else{
    echo 'Fail: No Result';
}