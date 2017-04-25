<?php ?>
<section class="listing">
		<div class="container">
			<div class="filters">

			</div>
			<div class="list">
			<?php foreach ($return as $key => $item) { 
				  $item->alias 		 = getAlias($item->name); 
				  $short_description = trimString($item->short_description);
				  $statusText = '';
				    if(isset($item->AcceleratorStatus)){
					  switch ($item->AcceleratorStatus) {
					  	case 'Pending':
					  		$label = 'green';
					  		$bgcolor = 'black';
					  		$statusText = 'Pending';
					  		break;
					  	case 'Eligible':
					  		$label = 'aqua';
					  		$bgcolor = 'green';
					  		$statusText = 'Eligible';
					  		break;
					  	default:
					  		$label = 'green';
					  		$bgcolor = 'black';
					  		$statusText = 'Pending';
					  		break;
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
			        			<h4><?= $item->name; ?></h4>
			        		</a>
						</div>
						<?php if(isset($item->AcceleratorStatus)){ ?>
						<div class="item-status">
							<span class="label label-<?= $label?>" style=" background-color:<?=$bgcolor?> ">
								<?= $statusText; ?>
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