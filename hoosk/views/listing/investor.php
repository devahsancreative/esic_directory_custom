<?php ?>
<section class="listing">
		<div class="container">
			<div class="filters">

			</div>
			<div class="list">
			<?php foreach ($return as $key => $item) { 
				  $item->alias =	str_replace(' ', '_',$item->name);
				  $short_description = truncateString(strip_tags($item->short_description),200, false);
				    if(isset($item->Status_Label)){
					  switch ($item->Status_Label) {
					  	case 'Published':
					  		$label = 'green';
					  		$bgcolor = 'grey';
					  		break;
					  	case 'Feature':
					  		$label = 'aqua';
					  		$bgcolor = 'black';
					  		break;
					  	case 'Private':
					  		$label = 'orange';
					  		$bgcolor = 'Orange';
					  		break;
					  	default:
					  		break;
					  }
				    }
				?>
				<div class="list-item" data-item="<?= $key ;?>">
					<div class="item-image">
						<a href="<?= base_url().$ListingName.'/'.$item->alias; ?>" class="permalink" data-link= "<?= $item->id;?>">
							<div class="img-container">
								<span>
									<img src="<?= $item->logo; ?>" alt="" class="item-logo"/>
								</span>
							</div>
						</a>
					</div>	
					<div class="item-detail">
						<div class="item-name">
			        		<a href="<?= base_url().$ListingName.'/'.$item->alias; ?>" class="permalink" data-link= "<?= $item->id;?>">
			        			<h3><?= $item->name; ?></h3>
			        		</a>
						</div>
						<?php if(isset($item->preferred_investment_amount) && !empty($item->preferred_investment_amount)){ ?>
						<div class="item-type">
							<label>Investor Type</label>
							<span>
								<?= $item->label; ?>
							</span>
						</div>
						<?php } ?>
						<?php if(isset($item->preferred_investment_amount) && !empty($item->preferred_investment_amount)){ ?>
						<div class="item-investment">
							<span>
								<?= $item->preferred_investment_amount; ?>
							</span>
						</div>
						<?php } ?>
						<?php if(isset($item->Status_Label)){ ?>
						<div class="item-status">
							<span class="label label-<?= $label?>" style=" background-color:<?=$bgcolor?> ">
								<?= $item->Status_Label; ?>
							</span>
						</div>
						<?php } ?>
						<div class="clear"></div>
						<div class="item-brief-detail">
						     <div class="description">
			                    <p><?=  $short_description; ?></p>
			                 </div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
</section>