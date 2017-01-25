 
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
 .wrap{
	 margin-bottom:20px;
	 
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
.btn-primary {
    font-size: 1em !important;
    height: auto !important;
    line-height: 1.25 !important;
    font-family: 'Lato', sans-serif;
    background-color: #6d6d6d;
    border-radius: 3px !important;
    display: block;
    max-width: 200px;
    margin-left: 17px;
    margin-bottom: 20px;
}
    text-align: center !important;	   
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
 
 
                                       <!----------------End-------------------->


 <div class="clear"></div>
<div class="row wrap">
   <h2 class="wsite-content-title" style="text-align:left;">Contact Us<br></h2>
   <?php  
	 
   if($this->session->userdata('msg')){?> 
             <div class="alert alert-success"><?php echo $this->session->userdata('msg');
			 $this->session->unset_userdata('msg');
			 ?>
             </div>
    
   <?php } ?>

    <div class="col-lg-12" id="mainFormDiv">
   
   <form id="contact" action="<?php  echo ('contact/submit')?>" method="post" enctype="multipart/form-data" data-url="" >
         <div id="form1">
           <fieldset>
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
                    <label for="Email">Email <span class="required-fields">*</span></label>
                    <div class="form-group">
                         <input id="Email" name="email" type="email" class="form-control" 
                        placeholder="xyz@example.com" required />
                    </div>
                    
                    <label for="shortDescription">Comment <span class="required-fields">*</span></label>
                        <div class="form-group">
                        <textarea id="shortDescription" class="form-control" name="comment"></textarea>
                         </div>
                 </fieldset>
                 
                 <div class="button-container">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
             
        </form>
    </div>
  </div>
  </div>
 
 
 
 
 
 
 
 
