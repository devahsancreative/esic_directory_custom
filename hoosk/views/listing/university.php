<?php ?>
<section class="listing">
		<div class="container">
			<div class="filters">

			</div>
			<div class="list">
			<?php foreach ($return as $key => $item) { 
				  $item->alias =	str_replace(' ', '_',$item->institution);
				  $short_description = truncateString(strip_tags($item->programDescription),200, false);
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
									<img src="<?= $item->institutionLogo; ?>" alt="" class="item-logo"/>
								</span>
							</div>
						</a>
					</div>	
					<div class="item-detail">
						<div class="item-name">
			        		<a href="<?= base_url().$ListingName.'/'.$item->alias; ?>" class="permalink" data-link= "<?= $item->id;?>">
			        			<h4><?= $item->institution; ?></h4>
			        		</a>
						</div>
						<?php if(isset($item->state)){ ?>
						<div class="item-state">
							<span>
								<?= $item->state; ?>
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