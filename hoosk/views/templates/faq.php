<?php echo $header; ?>
<!-- JUMBOTRON
=================================-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<?php
$background = '';
if ($page['enableJumbotron'] == 1) {
  $background =$page['jumbotronHTML'];
  $doc = new DOMDocument();
  $doc->loadHTML($background);
  $xml = simplexml_import_dom($doc); // just to make xpath more simple
  $images = $xml->xpath('//img');
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
        <!--<div class="logotext">
            <a class="" href="<?php /*echo BASE_URL; */?>"><img class="img-responsive " src="<?php /*echo BASE_URL; */?>/images/<?php /*echo $settings['siteLogo']; */?>"
                                                            alt="Hoosk"></a>


            <h2>|<span class="wsite-text wsite-headline text-uppercase">
                  <?php /*echo  $page['pageTitle']; */?></span></h2>

        </div>-->
        <div class="header_search logotext">
            <div class="row">
                <h3>Your search for early stage innovation opportunities ends here</h3>
            </div>
            <hr class="custom-line">
           <div class="row custom-row">
              <div class="col-md-6 col-sm-6 col-xs-12">
	              	<form pre-action="results_investors" action="results_innovators" method="post" accept-charset="utf-8">
						<input type="text" name="keyword" class="form-control" placeholder="Investors">
						<input type="hidden" name="resultsFor" value="investors">
						<input type="submit" value="" class="form-control submit-icon" >
	              	</form>
              </div>
               <div class="col-md-6 col-sm-6 col-xs-12">
               		<form action="results_innovators" method="post" accept-charset="utf-8">
                  	 	<input type="text" name="keyword" class="form-control" placeholder="Innovators">
                  	 	<input type="hidden" name="resultsFor" value="innovators">
                  	 	<input type="submit" value="" class="form-control submit-icon" >
                  	 </form>
               </div>
           </div>


            <div class="row">

                <div id="add-listing-dropdown" class="">
                    <a  class="btn dropdown-toggle  btn-primary" data-toggle="dropdown" href="#">
                        Add listing
                        <span class="caret"></span>
                     </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= BASE_URL ?>/esic">ESIC</a></li>
                        <li><a href="<?= BASE_URL ?>/investor">Investor</a></li>
                        <li><a href="<?= BASE_URL ?>/accelerator">Accelerator</a></li>
                        <li><a href="<?= BASE_URL ?>/rndpartner">Research Partner</a></li>
                        <li><a href="<?= BASE_URL ?>/rndconsultant">R&D Tax Consultant</a></li>
                        <li><a href="<?= BASE_URL ?>/lawyer">Lawyer</a></li>
                        <li><a href="<?= BASE_URL ?>/grantconsultant">Grant Consultant</a></li>
                    </ul>
                </div>
            </div>
        </div>
      </div>
    </div> 
</div>
<!-- /JUMBOTRON container-->
<!-- CONTENT =================================-->
<div class="container">
    <?php echo $page['pageContentHTML']; ?>
    <hr>
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
            scrollTop: $(ID).offset().top -80}
          , 2000);
        });
    });
</script>