<!--views theme footer for static pages forms etc Hamid Raza -->
<div class="container footer footer-wraper">

    <div class="row">
        <div class="col-md-4 col-xs-12 col-sm-12 text-center footermenu">
            <?php hooskNav('footer'); ?>
            <p> <?php      $settings['siteFooter']; ?> </p>
        </div>
        <div class="col-md-4   text-center footermenu">
            <?php hooskNav('footer-cen'); ?>
        </div>
      <div class="col-md-4 col-xs-12 col-sm-12   text-center social">
            <?php  getSocial(); ?>
             <ul>
                <li>Contact number: <?= $settings_footer[0]['contact']?></li>
                <li>​Email:<?= $settings_footer[0]['siteEmail']?></li>
                <li>​<div class="paragraph_footer"><p><?= $settings_footer[0]['footer_text']?></p></p></div></li>
            </ul>
        </div>
    </div>

    <?= $settings_footer[0]['footer_bottom_text']?>



</div>
</body>
</html>