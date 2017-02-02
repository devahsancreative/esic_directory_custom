    <!-- FOOTER
    =================================-->

    <div class="container footer footer-wraper">
    <div class="row pull-left text-left">


    </div>
    <div class="row">
    <div class="col-md-4 col-xs-12 col-sm-6 pull-left footermenu text-center">
    <?php //hooskNav('footer'); ?>
       <p><?php // echo $settings['siteFooter']; ?></p>
    </div>
    <div class="col-md-4 col-xs-12   text-center footermenu">
       <?php hooskNav('footer-cen'); ?>
    </div>
    <div class="col-md-4 col-xs-12   text-center social">
        <?php getSocial();


		$settings['siteFooter']; ?>
        <ul>
            <li>Contact number: 02 9280 2766</li>
            <li>​Email: tom@esic.directory</li>
            <li>Follow ESIC Directory with our Blog, Linkediin,</li>
            <li> Facebook and Twitter for information about ESICs</li>
            <li> and business news.</li>
       </ul>
    </div>
    </div>
    <div class="row">

    <div class="col-md-12 text-right pull-right">
    <span class="cc_links" style="display:block;margin:1em 0 0;padding:0 0 1em;font-size:.8em">
Photos used under Creative Commons from <a href="http://www.flickr.com/photos/118103645@N05/27089912874" target="_blank">ING Group</a>, <a href="http://www.flickr.com/photos/34188385@N07/27969723186" target="_blank">Games for Change</a>, <a href="http://www.flickr.com/photos/30937273@N06/26592720666" target="_blank">JULIAN MASON</a>, <a href="http://www.flickr.com/photos/49456588@N03/28996119085" target="_blank">Strelka Institute photo</a>, <a href="http://www.flickr.com/photos/22526649@N03/28898043891" target="_blank">tedeytan</a>, <a href="http://www.flickr.com/photos/49456588@N03/28710180220" target="_blank">Strelka Institute photo</a>, <a href="http://www.flickr.com/photos/43142722@N04/14225288745" target="_blank">Foreshock</a>
</span>

    </div>
    </div>
    </div>

	<!-- /FOOTER ============-->

   	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="<?php echo THEME_FOLDER; ?>/js/bootstrap.min.js"></script>
	</body>
</html>