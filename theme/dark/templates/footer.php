<!--views theme footer for static pages forms etc Hamid Raza -->

<div class="container-fluid footer footer-wraper">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12 footermenu">
                <h4>Popular Links</h4>
                <?php hooskNav('footer'); ?>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 footermenu">
                <h4>Support</h4>
                <?php hooskNav('footer-cen'); ?>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 social">
                <h4>Contact Us</h4>

                <ul socials>
                    <li><strong>Contact number: </strong><?= $settings_footer[0]['contact']?></li>
                    <li>​<strong>Email:</strong><?= $settings_footer[0]['siteEmail']?></li>
                    ​<div class="paragraph_footer"><p><?= $settings_footer[0]['footer_text']?></p></div>
                </ul>
                <div class="social_links">
                    <?php  getSocial(); ?>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <?= $settings_footer[0]['footer_bottom_text']?>
    </div>
</div>


<!--<div class="footer footer-wraper">

    <div class=" container row">
        <div class="col-md-4 col-xs-12 col-sm-12 footermenu">


                <?php /*hooskNav('footer'); */?>
                <p> <?php /*     $settings['siteFooter']; */?> </p>

        </div>
        <div class="col-md-4    footermenu">

            <?php /*hooskNav('footer-cen'); */?>

        </div>
      <div class="col-md-4 col-xs-12 col-sm-12  social">

            <?php /* getSocial(); */?>
             <ul>
                <li>Contact number: <?/*= $settings_footer[0]['contact']*/?></li>
                <li>​Email:<?/*= $settings_footer[0]['siteEmail']*/?></li>
                <li>​<div class="paragraph_footer"><p><?/*= $settings_footer[0]['footer_text']*/?></p></p></div></li>
            </ul>

        </div>
    </div>

    <?/*= $settings_footer[0]['footer_bottom_text']*/?>



</div>-->
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
    });
    /*  jQuery(window).scroll(function (event) {
     if($(window).scrollTop()>300){
     $(".navbar-inverse").removeClass("navbar-inverse2");
     $('.navbar-inverse').css('background-color','rgba(204, 204, 204, 0.96)');

     } else {
     $('.navbar-inverse').css('background-color','rgba(204, 204, 204, 0.67)');
     $('.navbar-inverse').css('opacity',1);



     }

     });
     });*/
</script>
</body>
</html>