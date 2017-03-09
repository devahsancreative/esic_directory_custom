
<div class="container" style="margin-top: 90px;">
	<h1>Search Results For <?php if(isset($Title)){ echo $Title; } ?></h1>
	<div class="search-filter-container">
	</div>
	<div class="search-results-container">
		<div class="header_search item-container clearfix">
			<form action="results_investors" method="post" accept-charset="utf-8">
	            <input type="text" name="keyword" class="form-control" placeholder="Investors">
	            <input type="hidden" name="resultsFor" value="Investors">
	             <input type="submit" value="" class="form-control submit-icon" >
	        </form>
        </div>

	<?php 
	  if(isset($list) && !empty($list)){
	  	  foreach ($list as $key => $item) { 
	?>
	  		<div class="item-container clearfix">
                <div class="item-container-top clearfix">
	                <div class="status-container">
	                    <?php 
	                      	switch($item->status) {
	                      		case  0:
	                      			echo '<span class="label status label-danger">Pending</span>';
	                      		break;
	                      		default:
	                      			echo '<span class="label status label-success">Published</span>';
	                      		break;
	                      	}
	                    ?>	    
	                </div>
                    <div class="Title">
                        <h2>
                           <a href="#"><?= $item->firstName.' '.$item->lastName; ?></a>
                        </h2>
                    </div>
                </div>
                <div class="item-container-middle">
	                <div class="logo-image">
	                    <?php if(!empty($item->image)){ ?>
	                          	<img src="<?= base_url().'uploads/investor/'.$item->image?>" alt="" title="" border="0" />
	                    <?php }else{ ?>
	                    	  	<img src="<?= base_url().'/pictures/defaultLogo.png'; ?>" alt="" title="" border="0" />
	                    <?php } ?>
	                </div>
                </div>  
                <div class="item-container-bottom">          
	                <div class="item-meta">
	                      <?php if($item->email){ ?> 
		                  <p class="email"><strong>Email: </strong><?= $item->email; ?></p>
		                  <?php } ?>
		                  <?php if($item->company_name){ ?> 
		                  <p class="company-name"><strong>Company Name: </strong><?= $item->company_name; ?></p> 
		                  <?php } ?>
		                  <?php if($item->company_email){ ?> 
		                  <p class="company-email"><strong>Company Email: </strong><?= $item->company_email; ?></p> 
		                  <?php } ?>
		                  <?php if($item->added_date){ ?> 
		                  <p class="added-date"><strong>Added Date: </strong><?= $item->added_date; ?></p> 
		                  <?php } ?>
		                  <?php if($item->address){ ?> 
		                  <p class="address"><strong>Address: </strong><?= $item->address; ?></p> 
		                  <?php } ?>
		            </div>                                
		            <div class="descriptions">
		            	<label for="">Descriptions</label>
		                <p class="desc"> <?= $item->about;?> </p>
		            </div>
		            <div class="social">

		            </div>
		        </div>
            </div>
	<?php 
	  		}
	  	} 
	?>
	 </div>
</div>