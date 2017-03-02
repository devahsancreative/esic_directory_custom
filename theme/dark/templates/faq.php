<?php echo $header; ?>   
    <!-- JUMBOTRON
=================================-->



<div class="jumbotron text-center <?php if (($page['enableJumbotron'] == 1) && ($page['enableSlider'] == 1)) { echo "carouselpadding"; } elseif (($page['enableJumbotron'] == 1) && ($page['enableSlider'] == 0)) { echo "errorpadding"; } elseif (($page['enableJumbotron'] == 0) && ($page['enableSlider'] == 1)) { echo "slider-padding"; } ?>">
	<?php if ($page['enableSlider'] == 1) { ?>
    <div id="carousel" class="carousel slide " data-ride="carousel">
        <?php getCarousel($page['pageID']); ?>
      <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <?php } ?>

    <div class="container">
    <?php if ($page['enableJumbotron'] == 0) { ?><div class="row bimage headerstyle jumbotron"></div><?php } else{?>
      <div class="row bimage banner_image">
			<?php  if ($page['enableJumbotron'] == 1) { echo $page['jumbotronHTML']; } ?>
         </div>
         <?php } ?>
        <!---logo image and page title hide by Hamid Raza -->
        <!--<div class="logotext">
            <a class="" href="<?php /*echo BASE_URL; */?>"><img class="img-responsive " src="<?php /*echo BASE_URL; */?>/images/<?php /*echo $settings['siteLogo']; */?>"
                                                            alt="Hoosk"></a>


            <h2>|<span class="wsite-text wsite-headline text-uppercase">
                  <?php /*echo  $page['pageTitle']; */?></span></h2>

        </div>-->
        <div class="header_search logotext">

           <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">

                  <label class="label_find"><h4>Find ESIC</h4></label>

                  <script>
                      (function() {
                          var cx = '001114046497267301926:xk7qgywhyng';
                          var gcse = document.createElement('script');
                          gcse.type = 'text/javascript';
                          gcse.async = true;
                          gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
                          var s = document.getElementsByTagName('script')[0];
                          s.parentNode.insertBefore(gcse, s);
                      })();
                  </script>
                  <gcse:search></gcse:search>


              </div>
              <!--<div class="col-md-3 col-sm-4 col-xs-12">
                  <label><h4></h4></label>
                  <button   class="btn btn-lg btn-blue search-button">Find ESIC</button>
               </div>-->

          </div>

        </div>


      </div>
    </div> 
</div>
<!-- /JUMBOTRON container-->
<!-- CONTENT
=================================-->
<div class="container">
    <?php echo $page['pageContentHTML']; ?>


    <hr>
    <!--<div class="map"> <iframe frameborder="0" id="mapjam-iframe" src="//embeds.mapjam.com/v2/map-embed.html?app_url=https://mapjam.com/&cdn_url=//mapjamjson.global.ssl.fastly.net/&map_id=esicdirectory&access_token=&content_action=side_popup&map_width=800px&map_height=600px&container=mapjam-1&domain=mapjam.com" style="width: 100%;height: 600px;margin-bottom:5px;"></iframe>
</div>-->
</div>
<!-- /CONTENT ============-->

<?php echo $footer; ?>
<script>
    $(function(){
        $('div.leftsidebar a').click(function(){

            var alink = $(this).attr('href');
            var result = alink.substring(alink.lastIndexOf("#") + 1);
            var ID = "#"+result;
            $('html, body').animate({
                scrollTop: $(ID).offset().top -80}, 2000);

        });

    });


    $(document).ready(function() {
        $(window).load(function() {
          var pageNum = $('.gsc-input').attr('placeholder','Search any thing Withen the website');
         });
    });

    </script>
