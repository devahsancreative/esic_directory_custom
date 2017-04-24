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
    if(!empty($esic['Status'])){
        $status = $esic['Status'];
    }
    if(!empty($esic['Web'])){
        $web = '<a target="_blank" href="http://'.$esic['Web'].'" class="website">'.$esic['Web'].'</a>';
    }
    $desc =   $esic['BusinessShortDesc'];

    if(isset($esic['Logo']) and !empty($esic['Logo']) and is_file(FCPATH.'/'.$esic['Logo'])){
        $img = base_url($esic['Logo']);
    }else{
        $img = base_url('pictures/defaultLogo.png');
    }
    if(isset($esic['banner']) and !empty($esic['banner']) and is_file(FCPATH.'/'.$esic['banner'])){
        $bgimg = base_url($esic['banner']);
    }else{
        $bgimg = base_url('pictures/defaultBanner.jpg');
    }
    if(isset($esic['productImage']) and !empty($esic['productImage']) and is_file(FCPATH.'/'.$esic['productImage'])){
        $productImg = base_url($esic['productImage']);
    }else{
        $productImg = base_url('pictures/defaultLogo2.jpg');
    }
    if(isset($esic['AccLogo']) and !empty($esic['AccLogo']) and is_file(FCPATH.'/'.$esic['AccLogo'])){
        $AccImg = base_url($esic['AccLogo']);
    }else{
        $AccImg = base_url('pictures/defaultLogo2.png');
    }
    if(isset($esic['AccCoLogo']) and !empty($esic['AccCoLogo']) and is_file(FCPATH.'/'.$esic['AccCoLogo'])){
        $AccCoImg = base_url($esic['AccCoLogo']);
    }else{
        $AccCoImg = base_url('pictures/defaultLogo2.png');
    }
    if(isset($esic['secLogo']) and !empty($esic['secLogo']) and is_file(FCPATH.'/'.$esic['secLogo'])){
        $secLogo = base_url($esic['secLogo']);
    }else{
        $secLogo = base_url('pictures/defaultLogo2.png');
    }
    if(isset($esic['institutionLogo']) and !empty($esic['institutionLogo']) and is_file(FCPATH.'/'.$esic['institutionLogo'])){
        $institutionLogo = base_url($esic['institutionLogo']);
    }else{
        $institutionLogo = base_url('pictures/defaultLogo2.png');
    }
    if(isset($esic['rndLogo']) and !empty($esic['rndLogo']) and is_file(FCPATH.'/'.$esic['rndLogo'])){
        $rndLogo = base_url($esic['rndLogo']);
    }else{
        $rndLogo = base_url('pictures/defaultLogo2.png');
    }
    // $date1 = new DateTime($esic['corporate_date']);
    $date1 = new DateTime(date('Y-m-d H:i:s'));
    $date2 = new DateTime($esic['expiry_date']);
    $diff = $date2->diff($date1)->format("%a");
    if($diff> 60){ $diff = ''; }
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
                            <?php if($esic['FullName']!=''){ ?>
                                <div class="product-details">
                                    <label>Name:</label>
                                    <a href="#" class="permalink" >
                                        <h3><?= $esic['FullName'] ?></h3>
                                    </a>
                                </div>
                            <?php  } if($esic['Company']!=''){ ?>
                                <div class="product-details">
                                    <label>Company:</label>
                                    <h3><?= $esic['Company'];?></h3>
                                </div>
                            <?php  }  if($esic['sectorName']!=''){ ?>
                                <div class="product-details">
                                   <label>Sector:</label>
                                   <h3><?= $esic['sectorName']; ?></h3>
                                </div>
                            <?php  } ?>
                            <?php if($esic['address']!='' || $esic['town']!='' || $esic['state']!=''){ ?>
                                <div class="product-details">
                                    <label>Region:</label>
                                    <h3>
                                    <?php
                                   // if($esic['address']!=''){// echo $esic['address'].', '; }
                                    if($esic['town']!=''){ echo $esic['town'].', '; }
                                    if($esic['state']!=''){ echo $esic['state']; }
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
						   foreach($social as $socials){ 
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
                                     <?php if($esic['acn_number']!=''){ ?>
                                        <div class="product-details small-details">
                                            <label>ACN Number:</label>
                                            <p class="info-type"><?= $esic['acn_number'];?></p>
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
                                    if($esic['corporate_date']!='' && date("Y", strtotime($esic['corporate_date'])) > 1980){ ?>
                                        <div class="product-details small-details">
                                            <label>Incorporate Date:</label>
                                            <p class="info-type"><?=  date("d-m-Y", strtotime($esic['corporate_date']));?></p>
                                       </div>
                                    <?php  } ?>
                                    <?php if($esic['expiry_date']!='' and $esic['ShowExpDate'] != '0' && date("Y", strtotime($esic['expiry_date'])) > 1980){ ?>
                                        <div class="product-details small-details">
                                            <label>Expiry Date:</label>
                                            <p class="info-type"><?= date("d-m-Y", strtotime($esic['expiry_date']));?></p>
                                        </div>
                                    <?php  } ?>
                                    <?php if($esic['added_date']!=''){ ?>
                                       <div class="product-details small-details">
                                            <label>Added Date:</label>
                                            <p class="info-type"><?= date("d-m-Y", strtotime($esic['added_date']));?></p>
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
                         <?php if($esic['institution']!=''){ ?>
                                <div class="category-container">
                                    <label>Institution:</label>
                                    <div class="category-box">
                                        <div class="category-details">
                                            <!--label>Institution:</label-->
                                            <p class="info-type"><?= $esic['institution'];?></p>
                                        </div>
                                           <?php if($esic['EInAppStatus'] !=''){ ?>
                                         <?php /*?><div class="category-details">
                                              <label>ABR Institution:</label>
                                             <p class="info-type"><?php // echo   $esic['EInAppStatus']; ?> </p>
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
                            <?php if($esic['rndname']!=''){ ?>
                               <div class="category-container">
                                    <label>R&D Partner Name:</label>
                                    <div class="category-box">
                                        <div class="category-details">
                                            <!--label>R&D Name:</label-->
                                            <p class="info-type"><?= $esic['rndname'];?> </p>
                                        </div>
                                        <?php if($esic['RndAppStatus'] !=''){ ?>
                                         <div class="category-details">
                                               <label>ABR R&D Partner:</label>
                                               <p class="info-type"><?= $esic['RndAppStatus'];?></p>
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
                            <?php  } if($esic['Member']!=''){ ?>
                                    <div class="category-container">
                                        <label>Commercialisation Australia:</label>
                                        <div class="category-box">
                                            <div class="category-details">
                                                <!--label>Commercialisation Australia:</label-->
                                                <p class="info-type"><?= $esic['Member']; ?></p>
                                            </div>
                                             <?php if($esic['EAccCoAppStatus'] !=''){ ?>
                                                <div class="category-details">
                                                    <label>ABR Commercialisation Australia:</label>
                                                    <p class="info-type"><?= $esic['EAccCoAppStatus']; ?></p>
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
                            <?php if($esic['Accname']!=''){ ?>
                                    <div class="category-container">
                                         <label>Accelerator:</label>
                                        <div class="category-box">
                                            <div class="category-details">
                                                <!--label>Accelerator:</label-->
                                                <p class="info-type"><?= $esic['Accname']; ?></p>
                                            </div>
                                            <?php if($esic['EAccAppStatus'] !=''){ ?>
                                                <div class="category-details">
                                                   <label>ABR Accelerator:</label>
                                                   <p class="info-type"><?= $esic['EAccAppStatus']; ?></p>
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
