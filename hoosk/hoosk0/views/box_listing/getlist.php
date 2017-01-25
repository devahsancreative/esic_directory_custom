<?php
///$this->load->library('resize');
if(!empty($list) && is_array($list)){
			    foreach($list as $key=>$user){
			    	$status='';
			    	$web='';
			    	$desc='';
			    	$img ='';
					$user['alias'] = str_replace(' ','_',$user['Company']);
			    	if(!empty($user['Status'])){
			    		$status = $user['Status'];
			    	}
			    	if(!empty($user['tinyDescription'])){
			    		if(strlen($user['tinyDescription']) > 170){
			    			$desc =  substr($user['tinyDescription'],0,160).'...';
			    		}else{
			    			$desc =   $user['tinyDescription'];
			    		}
			    	}
			    	/*if(!empty($user['BusinessShortDesc'])){
			    		if(strlen($user['BusinessShortDesc']) > 170){
			    			$desc =  substr($user['BusinessShortDesc'],0,160).'...';
			    		}else{
			    			$desc =   $user['BusinessShortDesc'];
			    		}
			    	}*/
			    	if(isset($user['Logo']) and !empty($user['Logo']) and is_file(FCPATH.'/'.$user['Logo'])){
			    		//$img = base_url($user['Logo']);
			    		$filename = base_url($user['Logo']);
				        $ext = Get_file_extension($filename);
				        $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
			    		$img = $withoutExt.'_thumbnail_258.'.$ext;

			    	}else{
			    		$img = base_url('pictures/defaultLogo.png');
			    	}
?>
<li class="list-item hcard-search member_level_5" data-page="<= $page ?>">
	<a href="<?= base_url().'esic_database/company/'.$user['alias']; ?>" class="permalink" data-link= "<?= $user['userID'];?>">
		<div class="img-container wraptocenter">
			<span>
				<img src="<?= $img; ?>" alt="" class="left"/>
			</span>
		</div>
	</a>	
		<div class="product-container">
			<div class="name-container person-name">
			        <a href="<?= base_url().'esic_database/company/'.$user['alias']; ?>" class="permalink" data-link= "<?= $user['userID'];?>"><h3><?= $user['FullName']; ?></h3></a>
			</div>
			<div class="clear"></div>
			<div class="product-details company-name">
				<a href="<?= base_url().'esic_database/company/'.$user['alias']; ?>" class="permalink" data-link= "<?= $user['userID'];?>">
				      <p class="info-type">
				      		<?= $user['Company']; ?>	
				      </p>
				</a>
			</div>
			<div class="status-container">
				<?php echo $status;?>	
			</div>
			<div class="clear"></div>
			<div class="product-details">
			     <div class="description overlay-desc">
                    <p><?= strip_tags($desc); ?> </p>
                 </div>
                 <div class="dates-box">
                 	<button type="button" class="show-dates">
	                		<i class="fa fa-calendar" aria-hidden="true"></i>
                    </button>
                    <a href="#" data-link= "<?= $user['userID'];?>" class="thumbs-up"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <span><?= $user['thumbsUp'];?></span></a>
                 	<?php if(!empty($user['added_date'])){ ?>
				     <div class="product-details date-container add">
				     	<label>Added Date:</label>
	                  	<p class="info-type"><?= date("d-m-Y", strtotime($user['added_date']));?></p>
	                 </div>
	                 <?php } ?>
	                 <?php if(!empty($user['corporate_date']) && date("Y", strtotime($user['corporate_date'])) > 1980 ){ ?>
	                 <div class="product-details date-container cop">
		                 <label>Incoporate Date:</label>
		                 <p class="info-type"><?= date("d-m-Y", strtotime($user['corporate_date'])); ?></p>
	                 </div>
	                 <?php } ?>
	                 <?php if(!empty($user['expiry_date']) && date("Y", strtotime($user['expiry_date'])) > 1980 ){ ?>
	                <div class="product-details date-container exp">
	                	<label>Expiry Date:</label>
	                	<p class="info-type"><?= date("d-m-Y", strtotime($user['expiry_date']));?></p>
	                </div>
	                <?php } ?>
                </div>
			</div>
		 </div>
</li>
<?php 
			       
			    }
			}
function Get_file_extension($filename){
       $filename = strtolower($filename) ;
       $exts = explode(".", $filename) ;
       $n = count($exts)-1;
       $exts = $exts[$n];
       return $exts;
    }
?>