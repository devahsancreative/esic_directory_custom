<div class="user-panel">
    <div class="pull-left image">
    
     <?php   $userRole = $this->session->userdata('userRole');
		     $userID   = $this->session->userdata('userID');
			 $image    = $this->Common_model->user_logo($userID,$userRole); 
			 
			  if(!empty($image[0]->p_image) && $userRole == 1){?>
				  <img src="<?=base_url()."uploads/admin/". $image[0]->p_image;?>" class="img-circle" alt="User Image">
				 <?php } 
                 
			  elseif(!empty($image[0]->logo) && $userRole == 2){// super admin logo  ?>
                 <img src="<?=base_url(). $image[0]->logo;?>" class="img-circle" alt="img-circle">
			   <?php } 
			  elseif(!empty($image[0]->image) && $userRole == 3){?>
              
				 <img src="<?=base_url()."uploads/investor/". $image[0]->image;?>" class="img-circle" alt="User Image">
               <?php }
			  else{?>
				 
				 <img src="<?=base_url()?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
				 <?php } ?>
			
  </div>
    <div class="pull-left info">
        <p> <?php echo $this->session->userdata('userName'); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>