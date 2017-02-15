 <!--views theme footer for static pages forms etc Hamid Raza -->
  <div class=" footer footer-wraper">

    <div class="container row">
         <div class="col-md-4 col-xs-12 col-sm-6 footermenu">
              <?php hooskNav('footer'); ?>
              <p> <?php  echo $settings['siteFooter']; ?> </p>
         </div>
         <div class="col-md-4col-xs-12 col-sm-6  footermenu">
               <?php hooskNav('footer-cen'); ?>
         </div>
    <div class="col-md-4 col-xs-12 col-sm-6  social">
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