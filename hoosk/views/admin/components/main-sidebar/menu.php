<style type="text/css">
    body .sidebar-menu .treeview-menu>li>a {
        font-size: 13px;
    }
</style>
<ul class="sidebar-menu">
   <?php      
        $class     = $this->router->fetch_class();
        $method    = $this->router->fetch_method();
		$current   = $class."/".$method; 
		$id        = $this->session->userdata('userID');  
		$userRole  = $this->session->userdata('userRole');
	?>
    <li>
      <a href="<?php echo BASE_URL; ?>" target="_blank"><i class="fa fa-home"></i><span>Home</span></a>
    </li>
    <li class="<?php if ($current == "Admin/index") { echo "active"; } ?>">
        <a href="<?php echo BASE_URL ; ?>/admin"><i class="fa fa-dashboard"></i> 
        <span><?php echo $this->lang->line('nav_dash'); ?></span> </a>
    </li>
    <?php
        $this->load->view("admin/components/main-sidebar/user-menu"); 
        if(isCurrentUserAdmin($this)){
            $this->load->view("admin/components/main-sidebar/admin-menu");
        }
        
    ?>
    <li>
        <a href="<?= BASE_URL ; ?>/admin/logout">
            <i class="fa fa-fw fa-power-off"></i> 
            <span>
                <?= $this->lang->line('nav_logout'); ?>
            </span>
        </a>
    </li>