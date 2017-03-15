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

<div id="tosModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Terms and Conditions</h4>
            </div>
            <div class="modal-body">
                <p id="tosContent"></p>
            </div>
            <div class="modal-footer" style="text-align: left">
                <span id="timerFooter" style="display: inline-block;margin-top: 8px;vertical-align: bottom;">Modal disappears in : <strong></strong></span>
                <button id="agreeAndAccept" type="button" class="btn btn-success pull-right" data-dismiss="modal">Agree and Accept</button>
            </div>
        </div>
    </div>
</div>






<link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>/js/owlcarousel2/css/owl.carousel.css" />
<link rel="stylesheet" href="<?php echo ADMIN_THEME; ?>/js/owlcarousel2/css/owl.theme.default.min.css" />


<script src="<?php echo ADMIN_THEME; ?>/js/owlcarousel2/js/owl.carousel.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/owlcarousel2/js/owl.animate.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/owlcarousel2/js/owl.autoheight.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/owlcarousel2/js/owl.autoplay.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/owlcarousel2/js/owl.autorefresh.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/owlcarousel2/js/owl.hash.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/owlcarousel2/js/owl.navigation.js"></script>
<script src="<?php echo ADMIN_THEME; ?>/js/owlcarousel2/js/owl.support.js"></script>





<script>
jQuery(document).ready(function () {

   /* var owl = $('.owl-carousel');

    owl.owlCarousel({
        loop:true,
        margin:10,
         nav: true,
         navText: ["<i class='fa fa-arrow-right'></i>","<i class='fa fa-arrow-left'></i>"],
       // navContainer: true,
       // autoplay:true,
       // autoplayTimeout:1000,
       // autoplayHoverPause:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:5,
                nav:true,
                loop:false
            }
        }
    });
    $('.play').on('click', function() {
        owl.trigger('play.owl.autoplay', [1000])
    });
    $('.stop').on('click', function() {
        owl.trigger('stop.owl.autoplay')
    });*/

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

                jQuery('img-responsive_logo').addClass('responsive_logo_hide');
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;

            }
        }

        jQuery('[data-toggle="offcanvas"]').click(function () {
            jQuery('#wrapper').toggleClass('toggled');
        });
        jQuery('#navbar-toggle-button').click(function(){
            jQuery('#navbar-collapse-main').slideToggle( "slow");
            //jQuery('#navbar-collapse-main').toggleClass('in');
        });


    });

    $(function(){
        var data_array = JSON.parse(tosJSON);

        //For Header.
        $.each(data_array, function(key, value){
            var menuRef = value.menu;
            var enabledTos = value.navTos;
            var tos = value.text;

            //Hamid Named it right sidebar but it is actually top navigation bar
            var topNavigationBar = $('div.right_sidebar');
//            var menu = topNavigationBar.find('a[href="'+menuRef+'"]');
            var url = "<?=BASE_URL?>/"+menuRef;
            var menu = topNavigationBar.find('a[href="'+url+'"]');
            //if Menu Matched and tos has been enabled then we can let the user show the tos.
            if(menu.length > 0 && parseInt(enabledTos)==1){
                //This means have founded the menu..

                menu.on('click',function(e){
                   e.preventDefault();
                    var modal = $('#tosModal');
                    modal.find('#tosContent').html(tos);
                    $('#tosModal').modal('show');

                    var sec = 15;
                    var timer = setInterval(function() {
                        $('#timerFooter strong').text(sec--);
                        if (sec == -1) {
                            modal.modal('hide');
                            clearInterval(timer);
                        }
                    }, 1000);

                    modal.find('#agreeAndAccept').on('click',function(e){
                        e.stopPropagation();
                        window.location.href = url;
                    });


                });
            }




        });
    });
</script>

</body>
</html>
