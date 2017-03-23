<ul class="sidebar-menu">
   <?php      
           
		  $class     = $this->router->fetch_class();
          $method    = $this->router->fetch_method();
		  $current   = $class."/".$method; 
		  $id  = $this->session->userdata('userID');   // use to edit assessment and investor Profile
		  $userRole  = $this->session->userdata('userRole'); //user role 1 for admin 2 for assment and 3 for investor 
	if($userRole == "1"){ 
	 
	  ?>
    
      
    <li>
      <a href="<?php echo BASE_URL; ?>" target="_blank"><i class="fa fa-home"></i><span>Home</span></a>
    </li>
    <li class="<?php if ($current == "Admin/index") { echo "active"; } ?>">
        <a href="<?php echo BASE_URL ; ?>/admin"><i class="fa fa-dashboard"></i> 
        <span><?php echo $this->lang->line('nav_dash'); ?></span> </a>
    </li>
     
    <li class="treeview <?php if ($current == "Pages/index" || $current =='Pages/addPage') { echo "active"; } ?>">
        <a href="#">
            <i class="fa fa-file"></i> <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul  class="treeview-menu">
        
            <li class="<?php if ($current == "Pages/index") { echo "active"; } ?>"><a href="<?php echo BASE_URL ; ?>/admin/pages"><i class="fa fa-circle-o"></i><?php echo $this->lang->line('nav_pages_all'); ?></a></li>
            <li class="<?php if ($current == "Pages/addPage") {  echo "active"; } ?>"><a href="<?php echo BASE_URL ; ?>/admin/pages/new"><i class="fa fa-circle-o"></i><?php echo $this->lang->line('nav_pages_new'); ?></a></li>
        </ul>
    </li>
     
    <li class="treeview <?php if ($current == "Blog/index" || $current =='blog/add_blog' || $current =='Blog/comments') { echo "active"; } ?>">
        <a href="#">
            <i class="fa fa-file"></i> <span>Blogs</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul  class="treeview-menu">
        
            <li class="<?php if ($current == "Blog/index") { echo "active"; } ?>"><a href="<?php echo BASE_URL ; ?>/admin/blog"><i class="fa fa-circle-o"></i>All Blogs</a> 
            
            <li class="<?php if ($current == "blog/add_blog") {  echo "active"; } ?>"><a href="<?php echo BASE_URL ; ?>/admin/blog/add_blog"><i class="fa fa-circle-o"></i>New Blog</a></li>
            
           <!-- <li class="<?php// if ($current == "Blog/comments") { echo "active"; } ?>">
            <a href="<?php// echo BASE_URL ; ?>/admin/blog/comments"><i class="fa fa-circle-o"></i>Blogs Comments</a></li>-->
        </ul>
    </li>

     
    <li class="<?php if ($current == "Admin/assessments_list") { echo "active"; } ?>"><a href="<?= base_url('admin/assessments_list')?>"><i class="fa fa-list"></i> <span>ESIC Pre-Assessments</span></a></li>
    

    
    <li class="<?php if ($current == "Investor/investor_list") { echo "active"; } ?>"><a href="<?= base_url('admin/investor_list')?>"><i class="fa fa-list"></i> <span>Investor Pre Assessments</span></a></li>
    
    
    <li class="treeview <?php if(
           $current=='Admin/manage_universities'
        || $current=='Admin/manage_rd'
        || $current=='Admin/manage_acc_commercials'
        || $current=='Admin/manage_accelerators'
        || $current=='Admin/manage_sectors'
        || $current=='Admin/manage_status'
        || $current=='Admin/manage_appstatus'
        || $current=='Admin/manage_lawyers'
        || $current=='Admin/GrantRecipients'
        || $current=='Admin/RndConsultant'
        || $current=='Admin/GrantConsultant'
    ){ echo 'active';}?>">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Configuration</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>

        <ul class="treeview-menu">
            <li class="<?php if ($current == "Admin/manage_universities") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_universities')?>"><i class="fa fa-circle-o"></i> Universities</a></li>
            
            <li class="<?php if ($current == "Admin/manage_rd") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_rd')?>"><i class="fa fa-circle-o"></i> R&D</a></li>

            <li class="<?php if ($current == "Admin/RndConsultant") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_rndconsultant')?>"><i class="fa fa-circle-o"></i> R&D Consultant</a></li>

            <li class="<?php if ($current == "Admin/manage_lawyers") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_lawyers')?>"><i class="fa fa-circle-o"></i> Lawyers</a></li>

            <li class="<?php if ($current == "Admin/GrantRecipients") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_grantrecipients')?>"><i class="fa fa-circle-o"></i> Grant Recipients</a></li>

            <li class="<?php if ($current == "Admin/GrantConsultant") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_grantconsultant')?>"><i class="fa fa-circle-o"></i> Grant Consultant</a></li>

            <li class="<?php if ($current == "Admin/manage_acc_commercials") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_acc_commercials')?>"><i class="fa fa-circle-o"></i> Acc Commercials</a></li>
           
            <li class="<?php if ($current == "Admin/manage_accelerators") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_accelerators')?>"><i class="fa fa-circle-o"></i> Accelerators</a></li>
            
            <li class="<?php if ($current == "Admin/manage_sectors") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_sectors')?>"><i class="fa fa-circle-o"></i> Sectors</a></li>
           
            <li class="<?php if ($current == "Admin/manage_status") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_status')?>"><i class="fa fa-circle-o"></i> Status</a></li>
           
            <li class="<?php if ($current == "Admin/manage_appstatus") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_appstatus')?>"><i class="fa fa-circle-o"></i> ABR Status</a></li>
            
        </ul>
    </li>
   
    <li class="treeview <?php if ($current == "Users/index"|| $current == "Users/addUser") { echo "active"; } ?>">
        <a href="#">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul  class="treeview-menu">

            <li  class="<?php if ($current == "Users/index") { echo "active"; } ?>"><a href="<?=base_url('admin/users')?>"><i class="fa fa-circle-o"></i><?php echo $this->lang->line('nav_users_all'); ?></a></li>
           
            <li class="<?php if ($current == "Users/addUser") { echo "active"; } ?>"><a href="<?=base_url('admin/users/new')?>"><i class="fa fa-circle-o"></i><?php echo $this->lang->line('nav_users_new'); ?></a></li>


        </ul>
    </li>



    <li class="treeview <?php if($current == "Navigation/index" || $current == "Navigation/newNav") { echo "active"; } ?>">
        <a href="#">
            <i class="fa fa-list-alt"></i> <span>Navigation</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul  class="treeview-menu">
            <li class="<?php if ($current == "Navigation/index" ) { echo "active"; } ?>"><a href="<?=base_url('admin/navigation')?>"><i class="fa fa-circle-o"></i><?php echo $this->lang->line('nav_navigation_all'); ?></a></li>
            <li class="<?php if ($current == "Navigation/newNav") { echo "active"; } ?>"><a href="<?=base_url('admin/navigation/new')?>"><i class="fa fa-circle-o"></i><?php echo $this->lang->line('nav_navigation_new'); ?></a></li>
        </ul>
    </li>
    <li class="treeview <?php if($current == "Slider/index" || $current == "Slider/new") { echo "active"; } ?>">
        <a href="#">
            <i class="fa fa-list-alt"></i> <span>Sliders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul  class="treeview-menu">
            <li class="<?php if ($current == "Slider/index") { echo "active"; } ?>">
                <a href="<?=base_url('admin/slider')?>">
                    <i class="fa fa-circle-o"></i>
                    <?php echo $this->lang->line('nav_sliders_layout'); ?>
                </a>
            </li>
             <li class="<?php if ($current == "Slider/new") { echo "active"; } ?>">
                <a href="<?=base_url('admin/slider/new')?>">
                    <i class="fa fa-circle-o"></i>
                    <?php echo $this->lang->line('nav_sliders_new'); ?>
                </a>
            </li>
        </ul>
    </li>
     
   
    <?php //Sliders ?>
   <!-- <li class="treeview <?php /*if($current == "Slider/index" || $current == "Slider/newSlider") { echo "active"; } */?>">
        <a href="#">
            <i class="fa fa-list-alt"></i> <span>Sliders</span>
           <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul  class="treeview-menu">
            <li class="<?php /*if ($current == "Slider/index" ) { echo "active"; } */?>"><a href="<?/*=base_url('admin/slider')*/?>"><i class="fa fa-circle-o"></i><?php /*echo $this->lang->line('nav_sliders_all'); */?></a></li>
            <li class="<?php /*if ($current == "Slider/newSlider") { echo "active"; } */?>"><a href="<?/*=base_url('admin/slider/new')*/?>"><i class="fa fa-circle-o"></i><?php /*echo $this->lang->line('nav_sliders_new'); */?></a></li>
        </ul>
    </li>-->

    <li class="treeview  <?php if ($current == "Users/email" || $current == "Users/sent" || $current == "contact/index") { echo "active"; } ?>">
        <a href="#">
            <i class="fa fa-envelope-o"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul  class="treeview-menu">

            <li class="<?php if ($current == "Users/email") { echo "active"; } ?>" ><a href="<?=base_url('admin/users/email')?>"><i class="fa fa-envelope-o"></i>Compose Email</a></li>
            <li class="<?php if ($current == "Users/sent") { echo "active"; } ?>"><a href="<?=base_url('admin/users/sent')?>"><i class="fa fa-envelope-o"></i>Sent</a></li>
            <li class="<?php if ($current == "contact/index") { echo "active"; } ?>"><a href="<?php echo BASE_URL ; ?>/admin/contact/manage_contact"><i class="fa fa-envelope-o"></i>Contact Us</a></li>

        </ul>
    </li>
    
   
   <!--------------->
   
   
    <li class="<?php if ($current == "Admin/social") { echo "active"; } ?>"><a href="<?php echo BASE_URL ; ?>/admin/social"><i class="fa fa-share-alt"></i> <span><?php echo $this->lang->line('nav_social'); ?></span> </a> </li>
    
    <li class="<?php if ($current == "Admin/settings") { echo "active"; } ?>"><a href="<?php echo BASE_URL ; ?>/admin/settings"><i class="fa fa-cogs"></i> <span><?php echo $this->lang->line('nav_settings'); ?></span> </a> </li>


    <li>
        <a href="<?php echo BASE_URL ; ?>/sitemap.xml" target="_blank">
            <i class="fa fa-sitemap"></i> <span>Sitemap</span></a>
   </li>
    <li>
        <a href="<?php echo BASE_URL ; ?>/admin/logout"><i class="fa fa-fw fa-power-off"></i> <span><?php echo $this->lang->line('nav_logout'); ?></span></a>
    </li>

    
 <!------------------------------------- Others User permission  ----------------------------------------------------->
 
<?php }else{ ?>
	
     
    <li>
      <a href="<?php echo BASE_URL; ?>" target="_blank"><i class="fa fa-home"></i><span>Home</span></a>
    </li>
   <?php /*?> <li class="<?php if ($current == "Admin/index") { echo "active"; } ?>">
        <a href="<?php echo BASE_URL ; ?>/admin"><i class="fa fa-dashboard"></i> 
        <span><?php echo $this->lang->line('nav_dash'); ?></span> </a>
    </li>
<?php */?>
<!------------------------------------  Investor edit profile  ----------------------------------------->

<?php if($userRole == "3"){?>
    <li class="<?php if ($current == "Investor/edit_profile") { echo "active"; } ?>"><a href="<?= base_url('admin/investor/edit_profile')."/".$id;?>"><i class="fa fa-list"></i> <span>Edit Profile</span></a></li>
<?php }elseif($userRole == "2"){
?>

<!------------------------------------  Assessment  edit profile  ----------------------------------------->

   <li class="<?php if ($current == "Admin/details") { echo "active"; } ?>"><a href="<?= base_url('admin/details')."/".$id;?>"><i class="fa fa-list"></i> <span>Edit Profile</span></a></li>
            <li class="<?php if ($current == "Admin/manage_profile") { echo "active"; } ?>"><a href="<?= base_url('admin/manage_profile')."/".$id;?>"><i class="fa fa-list"></i> <span>Manage Profile</span></a></li>
   <?php } ?>


	   <li>
        <a href="<?php echo BASE_URL ; ?>/admin/logout"><i class="fa fa-fw fa-power-off"></i> <span><?php echo $this->lang->line('nav_logout'); ?></span></a>
    </li>
	  
	<?php   } ?>
</ul>

