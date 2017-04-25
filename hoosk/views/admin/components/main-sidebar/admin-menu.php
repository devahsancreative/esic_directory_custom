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
    <li class="treeview <?php if ($class == "Questions") { echo "active"; } ?>">
        <a href="#">
            <i class="fa fa-user"></i> 
            <span>Questions</span>
            <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul  class="treeview-menu">
            <li  class="<?php if($current == "Questions/index"){ echo "active";}?>">
                <a href="<?=base_url('admin/questions/index')?>">
                    <i class="fa fa-circle-o"></i>
                    <?= $this->lang->line('nav_questions_answers'); ?>
                </a>
            </li>
            <li class="<?php if($current == "Questions/order"){ echo "active";}?>">
                <a href="<?=base_url('admin/questions/ordering')?>">
                    <i class="fa fa-circle-o"></i>
                    <?= $this->lang->line('nav_questions_sorting'); ?>
                </a>
            </li>
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
            <li  class="<?php if ($current == "Users/index") { echo "active"; } ?>">
                <a href="<?= base_url('admin/users')?>">
                    <i class="fa fa-circle-o"></i>
                    <?= $this->lang->line('nav_users_all'); ?>
                </a>
            </li>
            <li class="<?php if ($current == "Users/addUser") { echo "active"; } ?>">
                <a href="<?= base_url('admin/users/new')?>">
                    <i class="fa fa-circle-o"></i>
                    <?= $this->lang->line('nav_users_new'); ?>
                </a>
            </li>
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
            <li class="<?php if ($current == "Navigation/index" ){ echo "active";}?>">
                <a href="<?= base_url('admin/navigation')?>">
                    <i class="fa fa-circle-o"></i>
                    <?= $this->lang->line('nav_navigation_all'); ?>
                </a>
            </li>
            <li class="<?php if ($current == "Navigation/newNav"){ echo "active";}?>">
                <a href="<?= base_url('admin/navigation/new')?>">
                    <i class="fa fa-circle-o"></i>
                    <?= $this->lang->line('nav_navigation_new'); ?>
                </a>
            </li>
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
                <a href="<?= base_url('admin/slider')?>">
                    <i class="fa fa-circle-o"></i>
                    <?= $this->lang->line('nav_sliders_layout'); ?>
                </a>
            </li>
             <li class="<?php if ($current == "Slider/new") { echo "active"; } ?>">
                <a href="<?= base_url('admin/slider/new')?>">
                    <i class="fa fa-circle-o"></i>
                    <?= $this->lang->line('nav_sliders_new'); ?>
                </a>
            </li>
        </ul>
    </li>
    <li class="treeview <?php if ($current == "Users/email" || $current == "Users/sent" || $current == "contact/index") { echo "active"; } ?>">
        <a href="#">
            <i class="fa fa-envelope-o"></i> 
            <span>Mailbox</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul  class="treeview-menu">
            <li class="<?php if ($current == "Users/email") { echo "active"; } ?>" >
                <a href="<?= base_url('admin/users/email')?>">
                    <i class="fa fa-envelope-o"></i>
                    Compose Email
                </a>
            </li>
            <li class="<?php if ($current == "Users/sent") { echo "active"; } ?>">
                <a href="<?= base_url('admin/users/sent')?>">
                    <i class="fa fa-envelope-o"></i>
                    Sent
                </a>
            </li>
            <li class="<?php if ($current == "contact/index") { echo "active"; } ?>">
                <a href="<?= BASE_URL ; ?>/admin/contact/manage_contact">
                    <i class="fa fa-envelope-o"></i>
                    Contact Us
                </a>
            </li>

        </ul>
    </li>
    <li class="<?php if ($current == "Admin/social") { echo "active"; } ?>">
        <a href="<?= BASE_URL ; ?>/admin/social">
            <i class="fa fa-share-alt"></i> 
            <span>
                <?= $this->lang->line('nav_social'); ?> 
            </span> 
        </a>
    </li>
    <li class="treeview  <?php if ($current == "Admin/settings") { echo "active"; } ?>">
        <a href="<?= BASE_URL ; ?>/admin/settings">
            <i class="fa fa-cogs"></i> 
            <span>
                <?= $this->lang->line('nav_settings'); ?>
            </span> 
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a> 
        <ul  class="treeview-menu">
            <li class="<?php if($class == "University"){echo "active";} ?>">
                <a href="<?=base_url('admin/manage_university')?>">
                    <i class="fa fa-circle-o"></i> 
                    Universities
                </a>
            </li>
            <li class="<?php if($current == "Admin/manage_sectors"){echo "active";}?>">
                <a href="<?=base_url('admin/manage_sectors')?>">
                    <i class="fa fa-circle-o"></i> 
                    Sectors
                </a>
            </li>
            <li class="<?php if($current == "Admin/manage_status"){echo "active";}?>">
                <a href="<?=base_url('admin/manage_status')?>">
                    <i class="fa fa-circle-o"></i> 
                    Status
                </a>
            </li>
            <li class="<?php if($current == "Admin/manage_appstatus"){echo "active";}?>">
                <a href="<?=base_url('admin/manage_appstatus')?>">
                <i class="fa fa-circle-o"></i> 
                ABR Status</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="<?= BASE_URL ; ?>/sitemap.xml" target="_blank">
            <i class="fa fa-sitemap"></i> 
            <span>
                Sitemap
            </span>
        </a>
   </li>
