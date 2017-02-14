<?php echo $header; ?>   
    <!-- JUMBOTRON
=================================-->
<style>

    .jumbotron.errorpadding
    {
        padding-top: 0;
        padding-bottom: 0px !important;

    }

    .img-responsive{

      width: 100% !important;

    }
    .jumbotron .container {

        width: 100% !important;
    }

</style>


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
      <div class="row bimage">
			<?php  if ($page['enableJumbotron'] == 1) { echo $page['jumbotronHTML']; } ?>
         </div>
         <?php } ?>
        
        <div class="logotext">
            <a class="" href="<?php echo BASE_URL; ?>"><img class="img-responsive" src="<?php echo BASE_URL; ?>/images/<?php echo $settings['siteLogo']; ?>"
                                                            alt="Hoosk"></a>


            <h2>|<span class="wsite-text wsite-headline text-uppercase">
                  <?php echo  $page['pageTitle']; ?></span></h2>

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
    <div class="map"> <iframe frameborder="0" id="mapjam-iframe" src="//embeds.mapjam.com/v2/map-embed.html?app_url=https://mapjam.com/&cdn_url=//mapjamjson.global.ssl.fastly.net/&map_id=esicdirectory&access_token=&content_action=side_popup&map_width=800px&map_height=600px&container=mapjam-1&domain=mapjam.com" style="width: 100%;height: 600px;margin-bottom:5px;"></iframe>
</div>
</div>
<!-- /CONTENT ============-->

<?php echo $footer; ?>