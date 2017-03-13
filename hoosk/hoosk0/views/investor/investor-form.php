<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
<!--<link rel="stylesheet" href="<?/*= base_url() */?>css/perfect-scrollbar.css"  />-->
    <style type="text/css">

        #mainFormDiv {

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
 
 
 
   .hide_contact { display:none; } 
   .show_contact { display:block; }
 
   label#message {
          color: red;
    }
   div#infoMessage p
   {
     color: red;
   }
   
   
    </style>
    <div class="clear"></div>
<div class="row wrap">
    <div class="col-lg-12" id="mainFormDiv">
   
        <form  action="<?php echo base_url('Investor/submit')?>" method="post" enctype="multipart/form-data" data-url="<?= base_url();?>Investor/submit" >

            <div id="form1">
                <fieldset>
              <legend>Early Stage Investor Pre-assessment</legend>
                 <?php if($this->session->userdata('msg')){?>
                <div class="alert alert-success" id="mydiv">
                      <?php echo $this->session->userdata('msg');
                      $this->session->unset_userdata('msg');
                      ?>
		       </div>
         <?php }?>
                    <p>This pre-assessment will assist you in determining if you may qualify for ESIC tax incentives for the current financial year. You may potentially qualify for up to $200,000 in tax offsets and become eligible for an asset class that is CGT free for 10 years.
                    </p>
                    <label for="Name">Name<span class="required-fields">*</span></label>
                    <div class="form-group">
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <input id="NameFirst" name="firstName" type="text" placeholder="First"
                                       value="<?php echo set_value('firstName'); ?>"class="form-control"
                                     />
                                <label id="first_name"></label>
                                <div id="infoMessage"><?php echo form_error('firstName'); ?></div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <input id="NameLast" name="lastName" type="text" placeholder="Last"
                                       value="<?php echo set_value('lastName'); ?>"class="form-control"
                                      />
                                <label id="last_name"></label>
                                <div id="infoMessage"><?php echo form_error('lastName'); ?></div>
                            </div>
                        </div>
                    </div>.
                    
  
                    <label for="Email">Email<span class="required-fields">*</span></label>
                    
                    <div class="form-group">
                        
                        <input id="email" name="email" type="email"
                               value="<?php echo set_value('email'); ?>"class="form-control"
                        placeholder="xyz@example.com"/><label id="message"></label>
                        <div id="infoMessage"><?php echo form_error('email'); ?></div>
                    </div>
             </fieldset>
<fieldset>
 <p>Are you an early stage investor or considering making an investment?</p>
    <div class="form-group">
       <label>
            <input type="radio" class="minimal" name="early_stage_investor" value="1">Yes</label>
        <label>
           <input type="radio" class="minimal"  name="early_stage_investor"value="0" checked="checked">NO</label>
    </div>
</fieldset>

<fieldset>
 <p>Do you want a 20% rebate on your early stage investments and CGT exemption for up to 10 years?</p>
    <div class="form-group">
       <label>
            <input type="radio" class="minimal" name="rebate" value="1">Yes</label>
        <label>
           <input type="radio" class="minimal"  name="rebate"value="0" checked="checked">NO</label>
    </div>
</fieldset>


<fieldset>
 <p>Have you already found a company to invest in?</p>
    <div class="form-group">
       <label>
            <input type="radio" class="minimal" name="al_fd_company" value="1" onclick="show_contact()">Yes</label>
        <label>
           <input type="radio" class="minimal"  name="al_fd_company"value="0" checked="checked" onclick="hide_contact()">NO</label>
    </div>
</fieldset>

<div id="show_contact" class="show_contact  hide_contact">
<fieldset>
 <p>If so, please type the company name/contact email.</p>
  <div class="form-group">
       <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <input id="company_name" name="company_name" type="text" placeholder="Company Name" class="form-control"/>
              </div>
             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
               <input id="company_email" name="company_email" type="text" placeholder="Email" class="form-control" />
             </div>
        </div>
  </div>
</fieldset>

</div>

<fieldset>
 <p>Do you plan to hold your investment for more than 12 months  
 <span data-toggle="tooltip" title="If you purchase newly issued shares in a qualifying ESIC and hold them for 12 months, you will have a CGT exemption for up to 10 years when you sell your investment."><i class="fa fa-question-circle" aria-hidden="true"></i>
 </span></p>
    <div class="form-group">
       <label>
            <input type="radio" class="minimal" name="hold_investment" value="1">Yes</label>
        <label>
           <input type="radio" class="minimal"  name="hold_investment"value="0" checked="checked">NO</label>
    </div>
</fieldset>

<fieldset>
 <p>Are you an affiliate of the ESIC?</p>
    <div class="form-group">
       <label>
            <input type="radio" class="minimal" name="affiliate_ESIC" value="1">Yes</label>
        <label>
           <input type="radio" class="minimal"  name="affiliate_ESIC"value="0" checked="checked">NO</label>
    </div>
</fieldset>


<fieldset>
 <p>Do you own 30% or more of the equity interests of the ESIC or entities connected with the ESIC?</p>
    <div class="form-group">
       <label>
            <input type="radio" class="minimal" name="ent_con_ESIC" value="1">Yes</label>
        <label>
           <input type="radio" class="minimal"  name="ent_con_ESIC"value="0" checked="checked">NO</label>
    </div>
</fieldset>


<fieldset>
 <p>Are you a 'widely held company' or a 100% subsidiary of a widely held company?</p>
    <div class="form-group">
       <label>
            <input type="radio" class="minimal" name="widely_held_company" value="1">Yes</label>
        <label>
           <input type="radio" class="minimal"  name="widely_held_company"value="0" checked="checked">NO</label>
    </div>
</fieldset>


<fieldset>
 <p>Which of the following best describes your situation?</p>
    <div class="form-group">
       <label>
            <input type="checkbox" class="minimal" name="situation1" value="1">
            I did NOT claim a tax offset for an ESIC investment last year</label>
        <label>
           <input type="checkbox" class="minimal"  name="situation2" value="1">
           I claimed a tax offset for an ESIC investment last year but DO NOT plan to carry it forward to this year</label>
        <label>
           <input type="checkbox" class="minimal"  name="situation3" value="1">
           I claimed a tax offset for an ESIC investment last year and DO plan to carry it forward to this year</label>   
    </div>
</fieldset>

<fieldset>
 <p>Are you a Sophisticated Investor under S708 of the Corporations Act 2001?</p>
    <div class="form-group">
       <label>
            <input type="radio" class="minimal" name="Act_2001" value="1">Yes</label>
        <label>
           <input type="radio" class="minimal"  name="Act_2001"value="0" checked="checked">NO</label>
    </div>
</fieldset>
<fieldset>
<p>Sophisticated investor certificate upload here:<span data-toggle="tooltip" title="Sophisticated Investors are entitled to exclusive content"><i class="fa fa-question-circle" aria-hidden="true"></i>
 </span></p>
<div class="form-group">
                   
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                                <input type="file" id="rndLogoImage" name="certificate"/>
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
</fieldset>                
<fieldset>
 <p>Would you like to be matched with an advisor to learn more information about ESICs?</p>
    <div class="form-group">
       <label>
            <input type="radio" class="minimal" name="info_ESICs" value="1">Yes</label>
        <label>
           <input type="radio" class="minimal"  name="info_ESICs"value="0" checked="checked">NO</label>
    </div>
</fieldset>

   <div class="button-container">
                    <button type="submit" id="sumit_form" class="btn btn-primary">Submit</button>
                </div>
              </div>
            <div class="clear"></div>
             
        </form>
    </div></div>
 
 
 <style>
 .hide_contact { display:none; }, 
   .show_contact { display:block; } 
    </style>
 <script>
 function show_contact()
{
$("#show_contact").removeClass("hide_contact");
$("#show_contact").addClass("show_contact");
}
 function hide_contact()
{
$("#show_contact").removeClass("show_contact");
$("#show_contact").addClass("hide_contact");
}



$(document).ready(function(){
    //$('[data-toggle="tooltip"]').tooltip();

	 /// email exist code 
   
     $('#email').blur(function(){
        var email_val = $("#email").val();
         if(email_val == ''){
             $('#message').html('').html('Please enter a Valid Email Address').show().delay(5000).fadeOut();

         }
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
        if(filter.test(email_val)){
            // show loader
            $.post("<?php echo base_url()?>Investor/email_check", {
                email: email_val
            }, function(response){
                $('#message').html('').html(response.message).show().delay(5000).fadeOut();
            });
            return false;
        }
    
    
    });
    $("#sumit_form").on("click", function () {
        var current_e= $(this);
        var Fname    = $("#NameFirst").val();
        var Lname     = $("#NameLast").val();
        if(Fname =='')
        {
            alert(Fname);

            $('#first_name').html('Please Enter Your First Name').show().delay(5000).fadeOut();
         //   var scrollPos = $('#NameFirst').offset();
//alert(scrollPosition); // This alert always says 'null', why ?
          //  $(window).scroll(scrollPos);
            var errorDiv = $('#NameFirst:visible').first();
            var scrollPos = errorDiv.offset().top;
            $(window).scrollTop(scrollPos).offset();

            return false;
        }else if(Lname==''){
            $('#last_name').html('Please Enter Your Last Name').show().delay(5000).fadeOut();
            return false;

        }
    });
	});
setTimeout(function() {
                 $('#mydiv').fadeOut(5000);
				 }, 2000);  
 		 
 </script>
 
 
 
 
  
  