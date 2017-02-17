<?php echo $header; ?>   
    <!-- JUMBOTRON
=================================-->
<style>
    label.label_find {
        float: left;
    }
     .search-button {
        margin: 47px 0px !important;
        float: left;
    }
.banner_image img {
    height: 650px;
}
.header_search {
    margin-top: 60px;
    left: 0;
    right: 0;
    background: rgba(51, 51, 51, 0.5);
    border-radius: 8px;
    padding: 6px 54px;
    height: 167px;
    width: 700px;
    position: absolute;
    z-index: 100;
    color: white;


}
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

              <div class="col-md-9">
                  <label class="label_find"><h4>Find ESIC</h4></label>
                  <input type="text" name="search" class="form-control" placeholder="Find ESIC">
              </div>
              <div class="col-md-3">
                  <label><h4></h4></label>
                  <button   class="btn btn-lg btn-blue search-button">Find ESIC</button>
               </div>

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