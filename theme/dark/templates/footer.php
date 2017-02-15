<!--views theme footer for static pages forms etc Hamid Raza -->

<div class="footer footer-wraper">

    <div class=" container row">
        <div class="col-md-4 col-xs-12 col-sm-12 footermenu">


                <?php hooskNav('footer'); ?>
                <p> <?php      $settings['siteFooter']; ?> </p>

        </div>
        <div class="col-md-4    footermenu">

            <?php hooskNav('footer-cen'); ?>

        </div>
      <div class="col-md-4 col-xs-12 col-sm-12  social">

            <?php  getSocial(); ?>
             <ul>
                <li>Contact number: <?= $settings_footer[0]['contact']?></li>
                <li>​Email:<?= $settings_footer[0]['siteEmail']?></li>
                <li>​<div class="paragraph_footer"><p><?= $settings_footer[0]['footer_text']?></p></p></div></li>
            </ul>

        </div>
    </div>

    <?= $settings_footer[0]['footer_bottom_text']?>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script>
        jQuery(document).ready(function () {

            var trigger = jQuery('.hamburger'),
                overlay = jQuery('.overlay'),
                isClosed = false;

            trigger.click(function () {
                hamburger_cross();
            });

            function hamburger_cross() {

                if (isClosed == true) {
                    overlay.hide();
                    trigger.removeClass('is-open');
                    trigger.addClass('is-closed');
                    isClosed = false;
                } else {
                    overlay.show();
                    trigger.removeClass('is-closed');
                    trigger.addClass('is-open');
                    isClosed = true;
                }
            }

            jQuery('[data-toggle="offcanvas"]').click(function () {
                jQuery('#wrapper').toggleClass('toggled');
            });
            $(window).scroll(function (event) {
                if($(window).scrollTop()>300){
                    $('.nav_bar_two').css('top',0);
                    $('.zone_wrapper').css('top','72px');
                } else {
                    $('.nav_bar_two').css('top','72px');
                    $('.zone_wrapper').css('top','122px');
                }

            });
        });
    </script>

</div>
</body>
</html>