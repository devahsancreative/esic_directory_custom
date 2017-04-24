    <li class="<?php if ($class == "Esic") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_esic')?>"><i class="fa fa-list"></i> Esic</a></li>
            
    <li class="<?php if ($class == "Investor") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_investor')?>"><i class="fa fa-list"></i> Investor</a></li>
    <li class="treeview <?php if(
           $class=='University'
        || $current=='Admin/manage_rd'
        || $current=='Admin/manage_acc_commercials'
        || $current=='Admin/manage_accelerators'
        || $current=='Admin/manage_sectors'
        || $current=='Admin/manage_status'
        || $current=='Admin/manage_appstatus'
        || $class=='Lawyer'
        || $class=='GrantRecipients'
        || $class=='GrantConsultant'
        || $class=='RndConsultant'
        || $class=='RndPartner'
        || $class=='AcceleratingCommercialisation'
    ){ echo 'active';}?>">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Listings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>

        <ul class="treeview-menu">
            <li class="<?php if ($class == "Lawyer") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_lawyer')?>"><i class="fa fa-circle-o"></i> Lawyers</a></li>

            <li class="<?php if ($class == "RndPartner") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_rndpartner')?>"><i class="fa fa-circle-o"></i> R&D Partners</a></li>

            <li class="<?php if ($class == "RndConsultant") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_rndconsultant')?>"><i class="fa fa-circle-o"></i> R&D Tax Consultants</a></li>

            <li class="<?php if ($class == "GrantConsultant") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_grantconsultant')?>"><i class="fa fa-circle-o"></i> Grant Consultants</a></li>

            <li class="<?php if ($class == "Accelerator") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_accelerator')?>"><i class="fa fa-circle-o"></i> Accelerators</a></li>

            <li class="<?php if ($class == "AcceleratingCommercialisation") { echo "active"; } ?>"><a href="<?=base_url('admin/manage_acceleratingcommercialisation')?>"><i class="fa fa-circle-o"></i> Accelerating Commercialisation</a>
            </li>

        </ul>
    </li>