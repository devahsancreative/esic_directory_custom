<?php echo $header; ?>   
    <!-- JUMBOTRON
=================================-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

    <div class="container">
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
        <div class="header_search logotext">
            <div class="row">
                <h3> Find Investors OR Innovators</h3>
            </div>
            <hr class="custom-line">

           <div class="row custom-row">

              <div class="col-md-6 col-sm-6 col-xs-12">


                  <input type="text" name="" class="form-control" placeholder="Investors  ">

              </div>
               <div class="col-md-6 col-sm-6 col-xs-12">


                   <input type="text" name="" class="form-control" placeholder="Innovators  ">

               </div>

              <!--<div class="col-md-3 col-sm-4 col-xs-12">
                  <label><h4></h4></label>
                  <button   class="btn btn-lg btn-blue search-button">Find ESIC</button>
               </div>-->

          </div>


            <div class="row">

                <div class=" ">
                    <a  class="btn dropdown-toggle  btn-primary" data-toggle="dropdown" href="#">
                        Add listing
                        <span class="caret"></span>
                     </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">ESIC</a></li>
                        <li><a href="#">Investor</a></li>
                        <li><a href="#">Accelerator</a></li>
                        <li><a href="#">Research Partner</a></li>
                        <li><a href="#">R&D Tax Consultant</a></li>
                        <li><a href="#">Lawyer</a></li>
                        <li><a href="#">Grant Consultant</a></li>

                    </ul>
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
