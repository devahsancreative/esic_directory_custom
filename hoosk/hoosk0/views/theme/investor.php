<?php echo $header; ?>
<!-- JUMBOTRON
=================================-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

<?php
$background = '';
if ($page['enableJumbotron'] == 1) {
     $background =$page['jumbotronHTML'];
   $doc=new DOMDocument();
     $doc->loadHTML($background);
   $xml=simplexml_import_dom($doc); // just to make xpath more simple
    $images=$xml->xpath('//img');
    foreach ($images as $img) {
      $background = $img['src'];
   }



 }

?>
<div class="jumbotron full-screen text-center <?php if (($page['enableJumbotron'] == 1) && ($page['enableSlider'] == 1)) { echo "carouselpadding"; } elseif (($page['enableJumbotron'] == 1) && ($page['enableSlider'] == 0)) { echo "errorpadding"; } elseif (($page['enableJumbotron'] == 0) && ($page['enableSlider'] == 1)) { echo "slider-padding"; } ?>"
     style="background: url(<?=$background; ?>) no-repeat"

>
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

    <div class="container top_investor">
        <?php if ($page['enableJumbotron'] == 0) { ?><div class="row bimage headerstyle jumbotron"></div><?php } else{?>
            <div class="row bimage banner_image">
                <?php // if ($page['enableJumbotron'] == 1) { echo $page['jumbotronHTML']; } ?>
            </div>
         <?php } ?>
        <!---logo image and page title hide by Hamid Raza -->
        <!--<div class="logotext">
            <a class="" href="<?php /*echo BASE_URL; */?>"><img class="img-responsive " src="<?php /*echo BASE_URL; */?>/images/<?php /*echo $settings['siteLogo']; */?>"
                                                            alt="Hoosk"></a>


            <h2>|<span class="wsite-text wsite-headline text-uppercase">
                  <?php /*echo  $page['pageTitle']; */?></span></h2>

        </div>-->
        <div class="header_search logotext investor">
            <div class="row">
                <h3> Find Investors </h3>
            </div>
            <hr class="investor_custom-line">
           <div class="row investor_custom-row">
             
	              	<form action="results_investors" method="post" accept-charset="utf-8">
						<input type="text" name="keyword" class="form-control" placeholder="Investors">
						<input type="hidden" name="resultsFor" value="investors">
						<input type="submit" value="" class="form-control submit-icon" >
	              	</form>
           </div>
           <div class=" row investor_row">
             <div class="col-md-6 col-sm-6 col-xs-12">
	              	 <input type="button" value="Learn More" class="btn btn-sm btn-primary"> 
              </div>
               <div class="col-md-6 col-sm-6 col-xs-12">
                 <input type="button" value="Investor Eligibility" class="btn btn-sm btn-primary">
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




    </script>
