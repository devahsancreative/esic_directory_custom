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
<script src="<?php echo ADMIN_THEME; ?>/js/jquery-1.10.2.min.js"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<link href="<?=base_url();?>assets/css/filter.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/js/filter.js"></script>




<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    jQuery(document).ready(function($){
          /*  $('.multi-item-carousel .item').each(function(){
                var next = $(this).next().next().next().next().next().next().next();
                if (!next.length) { next = $(this).siblings(':first');}
                next.children(':first-child').clone().appendTo($(this));
                if (next.next().length>0) { next.next().children(':first-child').clone().appendTo($(this));
                } else { $(this).siblings(':first').children(':first-child').clone().appendTo($(this));
                }
            });*/
        });
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

    $(function(){
        console.log('im running..');
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
            console.log('URL:'+url);
            var menu = topNavigationBar.find('a[href="'+url+'"]');
            console.log(menu);
            console.log(menuRef);
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
