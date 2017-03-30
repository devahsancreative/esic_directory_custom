<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/filter.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/filter.js" type="text/javascript"></script>
<div class="content-shell">
    <div class="content-wrap" id="wrap">
        <div class="content">
             <div class="module">
                 <div class="search-para module-para">
                     <div id="wsite-content" class="wsite-elements wsite-not-footer">
                            <h2 class="wsite-content-title" style="text-align:center;">Search for Early Stage Innovation Companies</h2>
                            <div class="paragraph" style="text-align:center;color: #666666;">
                                To help early stage companies progress through the qualification process we track and update them via our directory, allowing their investors authoritative status updates, with easy and an appropriate level of assurance. ESIC status is designed to be temporary, end date and assessed date search allow quick reference to the facts, and provide another gauge of the currency and accuracy of those ESIC's, that said, our ranking is not a substitute for date-specfic professional sign-off (unless that is indicated). Happy Searching!
                            </div>
                        </div>
                    </div>
                    <div class="module-section">
                    <div class="filter form">
                    <div class="filter3" id="filter">
                        <div class="searchbox search">
                             <span class="icon" id="filter_search" > <i class="fa fa-search"></i></span>
                                <input type="text" value="" name="location_value" id="location_search"
                                       class="locationSuggest ac_input" placeholder="Search Now"
                                       autocomplete="off">
                                </div>
          <div class="row">
                <div class="col-md-12">
                     <div class="carousel slide multi-item-carousel" 
                     data-ride="carousel" data-type="multi" data-interval="3000" id="theCarousel">
                           <div class="carousel-inner">
                               <?php
                                   $i  = 1;
                                      if(isset($company) and !empty($company)){
                                        function Get_file_extension($filename){
                                               $filename = strtolower($filename) ;
                                               $exts = explode(".", $filename) ;
                                               $n = count($exts)-1;
                                               $exts = $exts[$n];
                                               return $exts;
                                            }
                                        foreach ($company as $companyi) {
                                        	if(!empty($companyi->logo)){
	                                        	if($i == 1){
	                                        		$item_class = 'item active';
	                                        	}else{
	                                        		 $item_class = 'item';
	                                        	}
                                            if(isset($companyi->logo) and !empty($companyi->logo) and is_file(FCPATH.'/'.$companyi->logo)){
                                                //$img = base_url($user['Logo']);
                                                $filename = $companyi->logo;
                                                $ext = Get_file_extension($filename);
                                                $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
                                                $img2 = $withoutExt.'_icon_258.'.$ext;
                                                if(is_file(FCPATH.'/'.$img2)){
                                                    $img = base_url($img2);
                                                }else{
                                                    $filename = base_url($companyi->logo);
                                                    $ext = Get_file_extension($filename);
                                                    $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
                                                    $img = $withoutExt.'_thumbnail_258.'.$ext;
                                                }

                                            }
	                                        	
	                                            ?>
	                                              <div class="<?= $item_class;?>">
	                                               <div class="col-md-4 col-sm-4 col-xs-4 esic-list-logo">
	                                                 <a href="https://www.esic.directory/esic-database.html#<?=$companyi->id; ?>">
                                                        <span>
	                                                       <img datasrc="<?= $img2 ;?>" src="<?php echo  $img; ?>" class="img-responsive" />
                                                       </span>
	                                                 </a>
	                                               </div>
	                                               </div>
	                                             <?php
	                                      $i++;
	                                        }
	                                     }
	                                 }
                                ?>
                          </div>
<a class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
<a class="right carousel-control" href="#theCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
 </div>
 </div>
 </div>
 </div>
 </div>
<div class="clear"></div>
</div>
 </div>
 </div>
</div>