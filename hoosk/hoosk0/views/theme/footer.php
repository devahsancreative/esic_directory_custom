<!-- FOOTER=================================

    <div class="container footer footer-wraper">
    <div class="row pull-left text-left">


    </div>
    <div class="row">
    <div class="col-md-4 col-xs-12 pull-left footermenu  text-center">
    <?php // hooskNav('footer'); ?>
       <p><?php //  echo $settings['siteFooter']; ?></p>
    </div>
    <div class="col-md-4 col-xs-12   text-center footermenu">
       <?php // hooskNav('footer-cen'); ?>
    </div>
    <div class="col-md-4 col-xs-12   text-center social">
        <?php // getSocial(); ?>



		<?php // $settings = $this->Hoosk_model->getSettings();

?>
        <ul>
            <li>Contact number: <?php // $settings[0]['contact']?></li>
            <li>​Email:<?php // $settings[0]['siteEmail']?></li>
            <li>​<div class="paragraph_footer"><p><?= $settings[0]['footer_text']?></p></p></div></li>
        </ul>
   </div>

   <?php //= $settings[0]['footer_bottom_text']?>

    </div>

    </div>
	</body>
</html> -->
<!-- FOOTER
    =================================-->
 
  <div class="container footer footer-wraper">

    <div class="row">
         <div class="col-md-4 col-xs-12 col-sm-6 text-center footermenu">
              <?php hooskNav('footer'); ?>
              <p> <?php  echo $settings['siteFooter']; ?> </p>
         </div>
         <div class="col-md-4 col-xs-12 col-sm-6   text-center footermenu">
               <?php hooskNav('footer-cen'); ?>
         </div>
    <div class="col-md-4 col-xs-12 col-sm-6   text-center social">
         <?php getSocial(); ?>
		 <?php  $settings = $this->Hoosk_model->getSettings();?>
        <ul>
            <li>Contact number: <?= $settings[0]['contact']?></li>
            <li>​Email:<?= $settings[0]['siteEmail']?></li>
            <li>​<div class="paragraph_footer"><p><?= $settings[0]['footer_text']?></p></p></div></li>
        </ul>
   </div>
    </div>

   <?= $settings[0]['footer_bottom_text']?>
	  

   
    </div>
	</body>
</html>