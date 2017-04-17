<style>

#banner, .container:before{
 	content:inherit !important;
	}
#banner-inner{
	width:100% !important; 
 	}	
.no-header-page #banner-wrap{
	   /* background: #edeff2  !important;*/
	 }
</style>

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
        if(isset($user['banner']) and !empty($user['banner']) and is_file(FCPATH.'/'.$user['banner'])){
            $bgimg = base_url($user['banner']);
        }else{
            $bgimg = base_url('pictures/defaultBanner.jpg');
        }
        if(isset($user['productImage']) and !empty($user['productImage']) and is_file(FCPATH.'/'.$user['productImage'])){
            $productImg = base_url($user['productImage']);
        }else{
            $productImg = base_url('pictures/defaultLogo2.jpg');
        }
        if(isset($user['AccLogo']) and !empty($user['AccLogo']) and is_file(FCPATH.'/'.$user['AccLogo'])){
            $AccImg = base_url($user['AccLogo']);
        }
        else{
            $AccImg = base_url('pictures/defaultLogo2.png');
        }
        if(isset($user['AccCoLogo']) and !empty($user['AccCoLogo']) and is_file(FCPATH.'/'.$user['AccCoLogo'])){
            $AccCoImg = base_url($user['AccCoLogo']);
        }
        else{
            $AccCoImg = base_url('pictures/defaultLogo2.png');
        }
        if(isset($user['secLogo']) and !empty($user['secLogo']) and is_file(FCPATH.'/'.$user['secLogo'])){
            $secLogo = base_url($user['secLogo']);
        }
        else{
            $secLogo = base_url('pictures/defaultLogo2.png');
        }
        if(isset($user['institutionLogo']) and !empty($user['institutionLogo']) and is_file(FCPATH.'/'.$user['institutionLogo'])){
            $institutionLogo = base_url($user['institutionLogo']);
        }
        else{
            $institutionLogo = base_url('pictures/defaultLogo2.png');
        }
        if(isset($user['rndLogo']) and !empty($user['rndLogo']) and is_file(FCPATH.'/'.$user['rndLogo'])){
            $rndLogo = base_url($user['rndLogo']);
        }
        else{
            $rndLogo = base_url('pictures/defaultLogo2.png');
        }
       // $date1 = new DateTime($user['corporate_date']);
        $date1 = new DateTime(date('Y-m-d H:i:s'));
        $date2 = new DateTime($user['expiry_date']);
        $diff = $date2->diff($date1)->format("%a");
        if($diff> 60){
                    $diff = '';
                }
        ?>

<div id="single-container" class="single-item list-item hcard-search member_level_5">
<div class="background-img-container"><img src="<?= $bgimg; ?>" alt="" class="left"></div>
    <div id="main-content" class="container">
       
            <div class="container-box">
                <div class="img-container logo-container">
                    <a href="#" class="permalink">
                        <img src="<?= $img; ?>" alt="" class="left">
                     </a>
                </div>
                <div class="clear"></div>
                <div class="wrapper">
                        <div class="detail-container main-details">
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
                                    <h3><?= $user['Company'];?></h3>
                                </div>
                            <?php  }  if($user['sectorName']!=''){ ?>
                                <div class="product-details">
                                   <label>Sector:</label>
                                   <h3><?= $user['sectorName']; ?></h3>
                                </div>
                            <?php  } ?>
                            <?php if($user['address']!='' || $user['town']!='' || $user['state']!=''){ ?>
                                <div class="product-details">
                                    <label>Region:</label>
                                    <h3>
                                    <?php
                                   // if($user['address']!=''){// echo $user['address'].', '; }
                                    if($user['town']!=''){ echo $user['town'].', '; }
                                    if($user['state']!=''){ echo $user['state']; }
                                      ?>
                                    </h3>
                               </div>
                            <?php  } ?>
                            <?php if($web!=''){ ?>
                                <div class="product-details website-address">
                                    <label>Website:</label>
                                    <h3><?= $web; ?></h3>
                                </div>
                                
                           <?php  } ?>
                           <div class="social-links  text-center social">
                               
                            <label>Social URLs:</label>
                            
					 <?php if(!empty($social)){
						   foreach($social as $socials)
						   
						   { 
								 if (!empty($socials['facebook']))
								   {
										 ?>
										 <a href="<?php echo $socials['facebook'] ?>" target="_blank">
										 <span class="socicon socicon-facebook"></span></a>
										 <?php
								   }
								 if(!empty($socials['twitter'])) 
									 { 
										 ?>
										 <a href="<?php echo $socials['twitter']; ?>" target="_blank">
										 <span class="socicon socicon-twitter"></span></a>
										 <?php
									 }
								 if(!empty($socials['google']))  		 
									 {
										 ?>
										 <a href="<?php echo $socials['google']; ?>" target="_blank">
										 <span class="socicon socicon-google"></span></a>
										 <?php
									}
								  if(!empty($socials['linkedin']))  		 
									 {
									     ?>
                                         <a href="<?php echo $socials['linkedin']; ?>" target="_blank">
                                         <span class="socicon socicon-linkedin"></span></a>
										 <?php
                                     }
								 if(!empty($socials['instagram']))  		 
									 {
										?>
										  <a href="<?php echo $socials['instagram'] ?>" target="_blank">
										  <span class="socicon socicon-instagram"></span></a>
									    <?php
									 }
							   }
								
							 } 
	?>
                            
                           </div>
                           
                        </div>
                        <div class="detail-container main-dates-container">
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
                                    if($user['corporate_date']!='' && date("Y", strtotime($user['corporate_date'])) > 1980){ ?>
                                        <div class="product-details small-details">
                                            <label>Incorporate Date:</label>
                                            <p class="info-type"><?=  date("d-m-Y", strtotime($user['corporate_date']));?></p>
                                       </div>
                                    <?php  } ?>
                                    <?php if($user['expiry_date']!='' and $user['ShowExpDate'] != '0' && date("Y", strtotime($user['expiry_date'])) > 1980){ ?>
                                        <div class="product-details small-details">
                                            <label>Expiry Date:</label>
                                            <p class="info-type"><?= date("d-m-Y", strtotime($user['expiry_date']));?></p>
                                        </div>
                                    <?php  } ?>
                                    <?php if($user['added_date']!=''){ ?>
                                       <div class="product-details small-details">
                                            <label>Added Date:</label>
                                            <p class="info-type"><?= date("d-m-Y", strtotime($user['added_date']));?></p>
                                        </div>
                                    <?php  } ?>
                        </div>
                        
                        
                           
                        
                        <div class="clear"></div>
                        <div class="detail-container summary-details">
                            <label>Summary:</label>
                            <?php if($desc !=''){ ?>
                                    <div class="description">
                                        <p> <?php 

                                        //if($productImg !=''){ <img src="<?= $productImg; " hspace="0" vspace="6" align="left"alt="" class="left"> } 
                                        ?> 
                                        <?= $desc ;?></p>
                                    </div>
                            <?php  } ?>
                            <br />
                        </div>
                        <div class="detail-container category-tab">
                         <?php if($user['institution']!=''){ ?>
                                <div class="category-container">
                                    <label>Institution:</label>
                                    <div class="category-box">
                                        <div class="category-details">
                                            <!--label>Institution:</label-->
                                            <p class="info-type"><?= $user['institution'];?></p>
                                        </div>
                                           <?php if($user['EInAppStatus'] !=''){ ?>
                                         <?php /*?><div class="category-details">
                                              <label>ABR Institution:</label>
                                             <p class="info-type"><?php // echo   $user['EInAppStatus']; ?> </p>
                                        </div><?php */?>
                                        <?php  } ?>
                                    </div>
                               <?php if($institutionLogo !=''){ ?>
                                    <div class="logos-img-container img-container category-img">
                                        <span>
                                            <img src="<?= $institutionLogo;?> " alt="" class="left">
                                        </span>
                                    </div>
                                <?php  } ?>
                                </div>
                            <?php  } ?>
                            <?php if($user['rndname']!=''){ ?>
                               <div class="category-container">
                                    <label>R&D Partner Name:</label>
                                    <div class="category-box">
                                        <div class="category-details">
                                            <!--label>R&D Name:</label-->
                                            <p class="info-type"><?= $user['rndname'];?> </p>
                                        </div>
                                        <?php if($user['RndAppStatus'] !=''){ ?>
                                         <div class="category-details">
                                               <label>ABR R&D Partner:</label>
                                               <p class="info-type"><?= $user['RndAppStatus'];?></p>
                                        </div>
                                        <?php  } ?>
                                    </div>
                                <?php if($rndLogo !=''){ ?>
                                    <div class="logos-img-container img-container category-img">
                                        <span>
                                            <img src="<?= $rndLogo; ?>" alt="" class="left">
                                        </span>
                                    </div>
                                <?php  } ?>
                                </div>
                            <?php  } if($user['Member']!=''){ ?>
                                    <div class="category-container">
                                        <label>Commercialisation Australia:</label>
                                        <div class="category-box">
                                            <div class="category-details">
                                                <!--label>Commercialisation Australia:</label-->
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
                                                    <span>
                                                        <img src="<?= $AccCoImg ?>" alt="" class="left">
                                                    </span>
                                                </div>
                                       <?php  } ?>
                                    </div>
                            <?php  } ?>
                            <?php if($user['Accname']!=''){ ?>
                                    <div class="category-container">
                                         <label>Accelerator:</label>
                                        <div class="category-box">
                                            <div class="category-details">
                                                <!--label>Accelerator:</label-->
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
                                                <span>
                                                    <img src="<?= $AccImg ?>" alt="" class="left">
                                                </span>
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
<style type="text/css" >
body #main-content .detail-container.summary-details .description ul{
    list-style-type: none;
}
body #main-content .container-box .category-container .category-img img {
    width: 100%;
    max-width: initial;
    max-width: none;
    border: none;
    position: absolute;
    top: 0;
    left: 0;
    max-width: 100%;
    max-height: 100%;
    width: 100%;
    right: 0;
    bottom: 0;
    margin: auto;
    padding: 0px 10%;
    background: #eee;
}
body #main-content .single-item .category-container .category-img span{
    position: relative;
    width: 100%;
    height: 0;
    overflow: hidden;
    display: block;
    padding-top: 100%;
    background: #eee;
    border-radius: 15px 15px 0px 0px;
    vertical-align: middle;
}

</style>
     <?php  } 

}else{
    echo 'Fail: No Result';
}