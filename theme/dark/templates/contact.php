<?php echo $header; ?>  
    <!-- JUMBOTRON
=================================-->
<style>

    .jumbotron.errorpadding
    {
        padding-top: 0;
        padding-bottom: 0px !important;

    }
    .logotext{
        position: absolute;
        top: 100px;
        left: 170px;
        z-index: 100;
        color: white;
        display: -webkit-box;

    }
    .bimage{
        z-index: 10;
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
            <a class="" href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>/images/<?php echo $settings['siteLogo']; ?>"
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
</div>
<!-- /CONTENT ============-->











 <style type="text/css">
	    .navbar-inverse{
			background-color: rgba(0, 0, 0, 0.6);
		 }
		 .navbar-nav>li>a
		 {
		  color:#FFF!important;
		 }
        #mainFormDiv {
          /*background-color: #424242;*/
		  background-color:#ffffff;/*added by Hamid Raza*/
          box-shadow: 0 0 9px rgba(0,0,0,0.3);
               }
        #loading-submit{
            display: none;
            background: rgba(0,0,0,0.50);
            z-index: 9999;
            width: 100%;
            height: 100%;
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            text-align: center;
        }
        #loading-submit img{
            padding-top: 20%;
        }
        #form1 legend{
        	color:#fff;
        }
        .modal select{
        	min-height: 25px;
		    max-width: 300px;
		    display: block;
        }
		 body{
			background-color:#f7f7f7;
			 } 
	 b, strong {
		/*font-weight: 700;
		display: block;
        clear: both;
        margin: 15px 0px 15px 0px;
        font-size: 12px;
        font-weight: bold;
        color: #333;*/
    } 
	input[type=checkbox], input[type=radio] {
     margin:2px;
     }
	 #SaveAccount {
     margin-right: 15px;
     padding: 5px 30px 5px 30px;
 }
 #main-wrap{
	 background-color:#f7f7f7 !important;
	 
	 
	 }
	 #main-content {
    
     background:none !important; 
     
} 
#banner, .container:before{  /* added for logo style*/
 	        content:inherit !important;
	    }
       #banner-inner{
	       width:100% !important; 
 	   }
@media only screen and (min-width: 1026px) and (max-width: 1200px){
#nav-wrap ul li {
     display: inline-block !important;
    float: left !important;
}

}
 @media only screen and (max-width: 1200px){
	 
	  .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9{
		margin-top:10px !important;
		margin-bottom:10px !important;
 		}
	 
	 }
 
    </style>
    <div class="clear"></div>
<div class="row wrap">
    <div class="col-lg-12" id="mainFormDiv">
   
        <form id="SignupForm" action="<?php echo base_url('Reg2/submit')?>" method="post" enctype="multipart/form-data" data-url="<?= base_url();?>" >
              <div id="form1">
                <fieldset>
                    <legend>Early Stage Companies Pre-assessment</legend>
                    <p>
                        This pre-assessment will help you determine if you are likely to qualify as an Eligible Early Stage
                        Innovation Company, i.e. a company that meets both the Early Stage Test and either the 100 point
                        Innovation Test or the Principles-based Innovation Test. Failing these tests, the company may
                        request a taxation ruling from the Australian Tax Office.
                    </p>
                    <label for="Name">Name<span class="required-fields">*</span></label>
                    <div class="form-group">
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <input id="NameFirst" name="firstName" type="text" placeholder="First" class="form-control"
                                      required />
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <input id="NameLast" name="lastName" type="text" placeholder="Last" class="form-control"
                                      required />
                            </div>
                        </div>
                    </div>
                    <label for="Email">Email<span class="required-fields">*</span></label>
                    <div class="form-group">
                        
                        <input id="Email" name="email" type="email" class="form-control" 
                        placeholder="xyz@example.com" required />
                    </div>
                    
                        <label for="Website">Website Address<span class="required-fields">*</span></label>
                       <div class="form-group">
                        <input id="Website" name="website" type="text" class="form-control" placeholder=" www.example.com" required />
                    </div>
                    
                    
                        <label for="Company">Company Name<span class="required-fields">*</span></label>
                       <div class="form-group">
                        <input id="Company" name="company" type="text" class="form-control" placeholder="Company" />
                    </div>
                   
                     <label for="Address">Address</label>
  <div class="form-group">
           <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                 <input id="street_number" name="street_number" type="text" class="form-control" placeholder="Street Number" />
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                 
                 <input id="Address" name="address" type="text" class="form-control" placeholder="Street Name" />
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">                                  
                 <input id="town" name="town" type="text" class="form-control" placeholder="Town" />
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">  
                 <input id="state" name="state" type="text" class="form-control" placeholder="State" />
              </div> 
              </div>  
              <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="margin-top:10px">
                 <input id="post_code" name="post_code" type="text" class="form-control" placeholder="Post Code" /> 
               </div>  
              </div>   
             </div>
                   
                       
                       
                       
                        <label for="Business">Business Name (if different)</label>
                         <div class="form-group">
                        <input id="Business" name="business" type="text" class="form-control" placeholder="Business Name" />
                    </div>
                    
                        <label for="tinyDescription">Short Description of Business</label>
                        <div class="form-group">
                        <textarea id="tinyDescription" class="form-control" name="tinyDescription"></textarea>
                        
                    </div>
                    
                        <label for="shortDescription">Detail Description of Business</label>
                        <div class="form-group">
                        <textarea id="shortDescription" class="form-control" name="shortDescription"></textarea>
                    </div>
                </fieldset>

                 

                 
                 
                <div class="button-container">
                    <button type="button" id="SaveAccount" class="btn btn-primary">Submit</button>
                </div>
              </div>
            <div class="clear"></div>
             
        </form>
    </div></div>
 
 
 
 
 
<div id="loading-submit">
    <img src="<?=base_url();?>assets/images/loading.gif" alt="loading">
</div>










<?php echo $footer; ?>