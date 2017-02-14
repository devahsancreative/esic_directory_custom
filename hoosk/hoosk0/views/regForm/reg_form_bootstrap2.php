
    <style type="text/css">
	.ShowPrevious2CategoriesDiv{
          background: rgba(66, 66, 66, .1);
          margin-top: 8px;
          padding: 10px;
          display: none border-radius: 10px;
         display: none;  
}
   .ShowPrevious2CategoriesDiv .addBtn{
	   margin-top:3px;
	   }
	.ShowInnovationDiv{
          background: rgba(66, 66, 66, .1);
          margin-top: 8px;
          padding: 10px;
          display: none border-radius: 10px;
         display: none;  
}
.ShowInnovationDiv .addBtn{
	   margin-top:3px;
	   }
	   .ShowRightDiv {
          background: rgba(66, 66, 66, .1);
          margin-top: 8px;
          padding: 10px;
          display: none border-radius: 10px;
         display: none;  
}
.ShowInnovationDiv .addBtn{
	   margin-top:3px;
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
                                <input id="NameFirst" name="firstName" type="text"
                                       value="<?php echo set_value('firstName'); ?>"placeholder="First" class="form-control"
                                      required />
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <input id="NameLast" name="lastName"
                                       value="<?php echo set_value('lastName'); ?>"       type="text" placeholder="Last" class="form-control"
                                      required />
                            </div>
                        </div>
                    </div>
                    <label for="Email">Email<span class="required-fields">*</span></label>
                    <div class="form-group">
                        
                        <input id="Email" name="email" type="email" class="form-control" 
                        placeholder="xyz@example.com"
                               value="<?php echo set_value('email'); ?>"required />

                    </div>
                    
                        <label for="Website">Website Address<span class="required-fields">*</span></label>
                       <div class="form-group">
                        <input id="Website" name="website" type="text"
                               value="<?php echo set_value('website'); ?>"       class="form-control" placeholder=" www.example.com" required />
                    </div>
                    
                    
                        <label for="Company">Company Name<span class="required-fields">*</span></label>
                       <div class="form-group">
                        
					    
                       
                       <script>
                         var pausecontent = new Array();
                            <?php foreach($company as $val){ ?>
                              pausecontent.push('<?php echo $val->company; ?>');
							  
                            <?php } ?> 
							/*function sendvalue(){
								 return pausecontent;
								}*/
                         </script>
                       
                        <input id="Company" name="company" type="text"
                               value="<?php echo set_value('company'); ?>" class="form-control" placeholder="Company" />
                    </div>
                   
                     <label for="Address">Address</label>
  <div class="form-group">
       <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <input id="street_number" name="street_number"
                   value="<?php echo set_value('street_number'); ?>"type="text" class="form-control" placeholder="Street Number" />
        </div>
       <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
             <input id="Address" name="address" type="text"
                    value="<?php echo set_value('address'); ?>"class="form-control" placeholder="Street Name" />
       </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
           <input id="town" name="town" type="text"
                  value="<?php echo set_value('town'); ?>"class="form-control" placeholder="Town" />
      </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <input id="state" name="state" type="text" class="form-control"
                 value="<?php echo set_value('state'); ?>"  placeholder="State" />
    </div>
     </div>
      <div class="row">
       <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="margin-top:10px">
           <input id="post_code" name="post_code"
                  value="<?php echo set_value('post_code'); ?>" type="text" class="form-control" placeholder="Post Code" />
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
                       <label for="Social_URL">Social URLs</label>
  <div class="form-group">
           <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                 <input id="facebook" name="facebook" type="text" class="form-control" placeholder="Facebook" />
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">

                 <input id="twitter" name="twitter" type="text" class="form-control" placeholder="Twitter" />
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                 <input id="google" name="google" type="text" class="form-control" placeholder="Google+" />
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">  
                 <input id="linked_in" name="linked_in" type="text" class="form-control" placeholder="Linked In" />
              </div> 
              </div>  
              <div class="row">
              <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="margin-top:10px">
                 <input id="instagram" name="instagram" type="text" class="form-control" placeholder="Instagram" />
               </div>  
              </div>   
             </div>
               
                </fieldset>

                <fieldset>
                    <legend>Early Stage Limb</legend>
                    
                        <label for="shortDescription">Did your business have less than or equal to $1 million in expenses in the previous income year?<span class="required-fields">*</span></label>
                        <div>
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="1mExpense">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="1mExpense">No</label>
                        </div>
                    </div>
<label for="shortDescription">Did your business have less than or equal to $200,000 in assessable income in the previous income year? (Excluding Accelerating Commercialisation Grant)<span class="required-fields">*</span></label>
                    <div>
                        
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="assessableIncomeYear">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="assessableIncomeYear">No</label>
                        </div>
                    </div>
<label for="shortDescription">Is your business, or an owner or the business listed on any stock exchanges?<span class="required-fields">*</span></label>
                    <div>
                        
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="listedInSExchange">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="listedInSExchange">No</label>
                        </div>
                    </div>
<label for="shortDescription">When was your company incorporated in Australia?<span class="required-fields">*</span></label>
                    <div>
                        
                        <div class="radio">
                            <label><input type="radio" value="Within the past three years" name="incorporatedAus">Within the past three years</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" id="3and6" value="Between six and three years ago" name="incorporatedAus">Between six and three years ago</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="Greater than six years ago" name="incorporatedAus">Greater than six years ago</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="Not incorporated in Australia" name="incorporatedAus">Not incorporated in Australia</label>
                        </div>
                         <!--Div For Input-->
                        <div class="inputDiv" id="dateInsertDiv">
                            <label for="selectorUniversity">Enter The Dates</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="cop_date">Incorporate Date</label>
                                        <div class="input-group date">
                                            <input id="cop_date" name="cop_date" type="text" class="form-control" placeholder="DD-MM-YYYY" />
                                            <div class="input-group-addon">
                                                <span class="glyphicon glyphicon-th"></span>
                                            </div>
                                        </div>    
                                    </div>
                                    <div class="form-group">
                                        <label for="acn">ACN #</label>
                                        <input id="acn" name="acn" type="text" class="form-control" placeholder="ACN #" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label for="shortDescription">Have you and your wholly owned subsidiaries incurred less than $1 million in expenses total across the last 3 income years?</label>
                    <div id="whollyOwned">
                        
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="ownedSubsidiaries">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="ownedSubsidiaries">No</label>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="form-horizontal" role="form">
                    <legend>Innovation Limb</legend>
                    <span style="text-decoration: underline">Principles-Based Test</span>
<strong>Is your company developing a new or significantly improved type of innovation? (See http://www.oecd.org/sti/oslomanual for examples of innovation)
                        </strong>
                    <div>
                        
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="improvedInnovation">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="improvedInnovation">No</label>
                        </div>
                    </div>
                    <label for="shortDescription">Does your company have the potential for high growth?</label>
                    <div>
                        
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="potentialHighGrowth">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="potentialHighGrowth">No</label>
                        </div>
                    </div>
 <label for="shortDescription">Is your company scalable? (Can you reduce or minimize cost increase as your revenues grow)
                        </label>
                    <div>
                       
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="companyScalable">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="companyScalable">No</label>
                        </div>
                    </div>

                    
                        <label for="shortDescription">Will you be able to address a national, international or global market?</label>
                    <div>
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="globalMarket">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="globalMarket">No</label>
                        </div>
                    </div>

                    
                       <label for="shortDescription">Is there potential for a clear competitive advantage over other companies? </label>                <div>
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="competitiveAdvantage">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="competitiveAdvantage">No</label>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="form-horizontal" role="form">
                    <legend>Innovation Limb</legend>
                     <span style="text-decoration: underline">Objective Test (100 Points Required)</span>
                        See the<span style="text-decoration: underline">FAQ</span> for an explanation of how points are awarded.
                     

                    
                       <label for="shortDescription">Which of the following describes your R&D expenses as a proportion of total expenses?</label>
                        <div>
                        <div class="radio">
                            <label><input type="radio" value="Greater than or equal to 50%" name="rdExpenses">Greater than or equal to 50%</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="Between 15% and 50%" name="rdExpenses">Between 15% and 50%</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="Less than 15%" name="rdExpenses">Less than 15%</label>
                        </div>
                         
                    </div>
                    
                        <label for="shortDescription">Have you received an Accelerating Commercialisation Grant under the Accelerating Commercialisation element of the Commonwealth's Entrepreneur's programme?</label>
                        <div>
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="EntrepreneurProgramme">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="EntrepreneurProgramme">No</label>
                        </div>
                        <div class="selectorDiv" id="EntrepreneurProgramme">
                            <label for="selectAcceleration">Select Acceleration Commercial</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <select class="select2Style" id="selectAcceleration" name="selectAcceleration" style="width:90%">
                                        <option value="0">Select...</option>
                                        <?php
                                        if(isset($accelerationCommercials) and !empty($accelerationCommercials)){
                                            foreach($accelerationCommercials as $accelerationCommercial){
                                                echo '<option value="'.$accelerationCommercial->id.'">'.$accelerationCommercial->Member.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <a></a>
                                    <a class="btn addBtn" data-toggle="modal" data-target=".EntrepreneurProgrammeModal" id="addProgramme"><span style="font-size: 12px;" class="glyphicon glyphicon-plus"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                        <label for="shortDescription">Is your company currently undertaken an accelerator program, or have you completed an eligible accelerator program? </label>
                         <div>
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="cohortOfEntrepreneurs">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="cohortOfEntrepreneurs">No</label>
                        </div>
                        <div class="selectorDiv" id="acceleratorProgramme">
                            <label for="acceleratorAcceleration">Select Acceleration</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <select class="select2Style" id="selectAcceleratorProgramme"  name="selectAcceleratorProgramme" style="width:90%">
                                        <option value="0">Select...</option>
                                        <?php
                                        if(isset($acceleratorProgramme) and !empty($acceleratorProgramme)){
                                            foreach($acceleratorProgramme as $acceleratorProgramme){
                                                echo '<option value="'.$acceleratorProgramme->id.'">'.$acceleratorProgramme->name.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <a></a>
                                    <a class="btn addBtn" data-toggle="modal" data-target=".acceleratorProgrammeModal" id="addAcceleratorProgrammeBtn"><span style="font-size: 12px;" class="glyphicon glyphicon-plus"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                        <label for="shortDescription">Has your business issued $50,000 or more in shares to a third party who was not an associate and did not acquire those shares to help another entity become entitled to the tax incentives?</label>                 <div>
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="taxIncentives">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="taxIncentives">No</label>
                        </div>
                    </div>
                    
                 <label for="shortDescription">Does your business have a standard patent or plant breeder's right, or the equivalent in another country within the past 5 years?</label>
                        <div>
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="standardPatent">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="standardPatent">No</label>
                        </div>
                       
                       <div id="show_right_div" class="ShowRightDiv">
                            <label for="right">Patent, Right or Application Number</label>
                            <div class="row">
                                <div class=" col-lg-10 col-md-10 col-sm-10 ">
                                <input type="text" name="rights_no_[]" class="form-control" placeholder="Patent, Right or Application Number..">  
                               </div>
                                
                                <div class=" col-lg-2 col-md-2 col-sm-2 ">
                                <a class="btn addBtn addnew1" id="">
                                 <span style="font-size: 12px;" class="glyphicon glyphicon-plus"></span></a>
                                 </div> 
                             </div>    
                             <div class="main_div">
                             </div>
                        </div>
                       
                        
                    </div>
                    
                   <label for="shortDescription">Does your business have an innovation patent or design right or the equivalent in another country within the past 5 years?</label>
                  <div>
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="innovationPatent">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="innovationPatent">No</label>
                        </div>
                        
                        <div id="show_innovation_div" class="ShowInnovationDiv">
                            <label for="right"> Innovation Patent, Right or Application Number</label>
                            <div class="row">
                                <div class=" col-lg-10 col-md-10 col-sm-10 ">
                                <input type="text" name="innovation_no_[]" class="form-control" placeholder="Innovation Patent, Right or Application Number..">  
                               </div>
                                
                                <div class=" col-lg-2 col-md-2 col-sm-2 ">
                                <a class="btn addBtn addnew2" id="">
                                 <span style="font-size: 12px;" class="glyphicon glyphicon-plus"></span></a>
                                 </div> 
                             </div>    
                             <div class="innovation_div">
                             </div>
                        </div>
                    </div>
                    
                 <label for="shortDescription">Does your business hold a license to IP that falls into either of the previous 2 categories? </label>   <div>
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="previous2Categories">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="previous2Categories">No</label>
                        </div>
                        <div id="show_previous2Categories_div" class="ShowPrevious2CategoriesDiv">
                            <label for="right">Innovation Patent, Rights or Application Number</label>
                            <div class="row">
                                <div class=" col-lg-10 col-md-10 col-sm-10 ">
                                <input type="text" name="P_C_no_[]" class="form-control" placeholder="Innovation Patent, Right or Application Number..">  
                               </div>
                                
                                <div class=" col-lg-2 col-md-2 col-sm-2 ">
                                <a class="btn addBtn addnew3" id="addnew">
                                 <span style="font-size: 12px;" class="glyphicon glyphicon-plus"></span></a>
                                 </div> 
                             </div>    
                             <div class="previous2Categories_div">
                             </div>
                        </div>
                    </div>
                    
                      <label for="shortDescription">Does your business have a written agreement to co-develop and commercialise an innovation with a university or a research organization? </label>
                        <div>
                        <div class="radio">
                            <label><input type="radio" value="Yes" name="researchOrganization" class="bottomse">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" value="No" name="researchOrganization">No</label>
                        </div>  
                        <div class="selectorDiv" id="selectorUniversityDiv">
                            <label for="selectorUniversity">Select University</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <select class="select2Style Universitybottom" id="selectorUniversity" name="selectorUniversity"  style="width: 90%">
                                        <option value="0">Select...</option>
                                        <?php
                                        if(isset($institutions) and !empty($institutions)){
                                            foreach($institutions as $institution){
                                                echo '<option value="'.$institution->id.'">'.$institution->institution.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <a></a>
                                    <a class="btn addBtn" data-toggle="modal" data-target=".InstitutionModal" id="addSelectorUniversity"><span style="font-size: 12px;" class="glyphicon glyphicon-plus"></span></a>
                                </div>
                            </div>
                            <label for="selectRnD">Select R&D Partner</label>
                            <div class="row">
                                <div class="col-lg-6">
                                    <select class="select2Style samechange2" id="selectRnD2" name="selectRnD" style="width:90%">
                                        <option value="0">Select...</option>
                                        <?php
                                        if(isset($RnDs) and !empty($RnDs)){
                                            ///print_r($RnDs);
                                            foreach($RnDs as $RnD){
                                                echo '<option value="'.$RnD->id.'">'.$RnD->rndname.'</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <a></a>
                                    <a class="btn addBtn" data-toggle="modal" data-target=".RndModal" id="addRnDModel"><span style="font-size: 12px;" class="glyphicon glyphicon-plus"></span></a>
                                </div>
                            </div>
                        </div>    
                    </div>
                   </fieldset>
               <!-- <div class="button-container">
                    <button type="button" id="SaveAccount" class="btn btn-primary">NEXT</button>
                </div>-->
              </div>
            <div class="clear"></div>
            <div id="SignupFormStep2">
                <fieldset>
                  <!--    <legend>Early Stage Companies Pre-assessment</legend>
                  <p>
                        This pre-assessment will help you determine if you are likely to qualify as an Eligible Early Stage
                        Innovation Company, i.e. a company that meets both the Early Stage Test and either the 100 point
                        Innovation Test or the Principles-based Innovation Test. Failing these tests, the company may
                        request a taxation ruling from the Australian Tax Office.
                    </p>-->

                    <div class="form-group">
                        <label for="Logo">Logo<span class="required-fields">*</span></label>
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                            <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                                <input type="file" id="Logo" name="Logo"></span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="BannerImage">Banner Image</label>
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                            <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                                <input type="file" id="BannerImage" name="Banner"></span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="productImage">Product / Service Image</label>
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                            <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                                <input type="file" id="productImage" name="product"></span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="industryClassification">Industry classification (from our provided listing))</label>
                        <div class="row">
                            <div class="col-lg-6">
                                <select id="industryClassification" class="select2Style" style="width: 80%;">
                                    <option value="0">Select...</option>
                                    <?php
                                    if(isset($sectors) and !empty($sectors)){
                                        foreach($sectors as $sector){
                                            echo '<option value="'.$sector->id.'">'.$sector->sector.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                 <a class="btn addBtn" data-toggle="modal" data-target=".IndustryClassificationModal" id="addIndustryClassification">
                                 <span style="font-size: 12px;" class="glyphicon glyphicon-plus"></span></a>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="button-container">
     <!-- <script src='https://www.google.com/recaptcha/api.js'></script>
      <div class="g-recaptcha" data-sitekey="6LdnMw0UAAAAACUs5JmUj6d0GEApig3pvo8_q4f3" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;float: right;"></div>
        <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">-->

        <button id="SubmitForm" type="button" class="btn btn-primary submit">Submit</button>
       <div  style="clear:both;"></div>
    </div>
            </div>
        </form>
    </div></div>
<div class="modal RndModal" tabindex="-1" role="dialog" aria-labelledby="R&D" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">R&D Partner</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="rndname">R&D Partner Name</label>
                    <input id="rndname" name="rndname" type="text" class="form-control" placeholder="R&D Partner Name" />
                </div>
                 <div class="form-group">
                    <label for="rndIdNumber">R&D Partner ID Number </label>
                    <input id="rndIdNumber" name="rndIdNumber" type="text" class="form-control" placeholder="R&D Partner ID Number" />
                </div>
                 <div class="form-group">
                    <label for="rndAddress">R&D Partner Address</label>
                    <input id="rndAddress" name="rndAddress" type="text" class="form-control" placeholder="R&D  Partner Address" />
                </div>
                 <div class="form-group">
                    <label for="ANZSRC">R&D Partner ANZSRC</label>
                    <input id="ANZSRC" name="ANZSRC" type="text" class="form-control" placeholder="R&D Partner ANZSRC" />
                </div>
                <div class="form-group">
                   <label for="rndLogoImage">Logo Image</label>
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                                <input type="file" id="rndLogoImage" name="rndLogoImage"/>
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="rndAppStatus">Australian Business Registration (Commonwealth of Australia)</label>
                    <select id="rndAppStatus" name="rndAppStatus" style="width: 80%;">
                            <option value="0">Select...</option>
                            <?php 
                                if(isset($statusApp) and !empty($statusApp)){
                                    foreach($statusApp as $statusAppRnd){
                                         echo '<option value="'.$statusAppRnd->id.'">'.$statusAppRnd->status.'</option>';
                                     }
                                }   
                            ?>    
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="addRnD" type="button" class="btn btn-primary" data-dismiss="modal">Add</button>
            </div>
        </div>
    </div>
</div>
<div class="modal InstitutionModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Institution</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Institution">Institution Name</label>
                    <input id="Institution" name="institution" type="text" class="form-control" placeholder="Institution" />
                </div>
                 <div class="form-group">
                    <label for="address">Address</label>
                    <input id="address" name="address" type="text" class="form-control" placeholder="Address" />
                </div>
                <div class="form-group">
                    <label for="post_code_uni">Postal Code</label>
                    <input id="post_code_uni" name="post_code_uni" type="text" class="form-control" placeholder="Postal Code" />
                </div>
                <div class="form-group">
                   <label for="institutionLogoImage">Logo Image</label>
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                                <input type="file" id="institutionLogoImage" name="institutionLogoImage"/>
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="institutionAppStatus">Australian Business Registration (Commonwealth of Australia)</label>
                    <select id="institutionAppStatus" name="institutionAppStatus" style="width: 80%;">
                            <option value="0">Select...</option>
                            <?php 
                                if(isset($statusApp) and !empty($statusApp)){
                                    foreach($statusApp as $statusAppInt){
                                         echo '<option value="'.$statusAppInt->id.'">'.$statusAppInt->status.'</option>';
                                     }
                                }   
                            ?>     
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="addInstitution" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
<div class="modal EntrepreneurProgrammeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Entrepreneur Programme</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Member">Programme Member Name</label>
                    <input id="Member" name="Member" type="text" class="form-control" placeholder="Member" />
                </div>
                <div class="form-group">
                    <label for="Web_Address">Web Address</label>
                    <input id="Web_Address" name="Web_Address" type="text" class="form-control" placeholder="Web Address" />
                </div>
                <div class="form-group">
                    <label for="State_Territory">State Territory</label>
                    <input id="State_Territory" name="State_Territory" type="text" class="form-control" placeholder="State_Territory" />
                </div>
                <div class="form-group">
                    <label for="Project_Location">Project Location</label>
                    <input id="Project_Location" name="Project_Location" type="text" class="form-control" placeholder="Project Location" />
                </div>
                <div class="form-group">
                    <label for="acceleration_p_c">Postal Code</label>
                    <input id="acceleration_p_c" name="acceleration_p_c" type="text" class="form-control" placeholder="Postal Code" />
                </div>
                <div class="form-group">
                    <label for="Project_Title">Project Title</label>
                    <input id="Project_Title" name="Project_Title" type="text" class="form-control" placeholder="Project_Title" />
                </div>
                <div class="form-group">
                    <label for="Project_Summary">Project Summary</label>
                    <input id="Project_Summary" name="Project_Summary" type="text" class="form-control" placeholder="Project_Summary" />
                </div>
                <div class="form-group">
                    <label for="Market">Market</label>
                    <input id="Market" name="Market" type="text" class="form-control" placeholder="Market" />
                </div>
                 <div class="form-group">
                    <label for="Technology">Technology</label>
                    <input id="Technology" name="Technology" type="text" class="form-control" placeholder="Technology" />
                </div>
                <div class="form-group">
                   <label for="accLogoImage">Logo Image</label>
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                                <input type="file" id="accLogoImage" name="accLogoImage"/>
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="EntrepreneurProgrammeAppStatus">Australian Business Registration (Commonwealth of Australia)</label>
                    <select id="EntrepreneurProgrammeAppStatus" name="EntrepreneurProgrammeAppStatus" style="width: 80%;">
                            <option value="0">Select...</option>
                            <?php 
                                if(isset($statusApp) and !empty($statusApp)){
                                    foreach($statusApp as $statusAppsEp){
                                         echo '<option value="'.$statusAppsEp->id.'">'.$statusAppsEp->status.'</option>';
                                     }
                                }   
                            ?>   
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="addEntrepreneurProgramme" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
<div class="modal acceleratorProgrammeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Accelerator Programme</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="AcceleratorProgrammeName">Accelerator Programme Name</label>
                    <input id="AcceleratorProgrammeName" name="AcceleratorProgrammeName" type="text" class="form-control" placeholder="Programme Name" />
                </div>
                 <div class="form-group">
                    <label for="acceleratoraddress">Address</label>
                    <input id="acceleratoraddress" name="acceleratoraddress" type="text" class="form-control" placeholder="Address" />
                </div>
                 <div class="form-group">
                    <label for="accelerator_p_c">Postal Code</label>
                    <input id="accelerator_p_c" name="accelerator_p_c" type="text" class="form-control" placeholder="Postal Code" />
                </div>
                <div class="form-group">
                    <label for="Programme_Web_Address">Programme Web Address</label>
                    <input id="Programme_Web_Address" name="Programme_Web_Address" type="text" class="form-control" placeholder="Programme Web Address" />
                </div>
                <div class="form-group">
                   <label for="logoImage">Logo Image</label>
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                                <input type="file" id="ProgrammeLogoImage" name="ProgrammeLogoImage"/>
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="acceleratorProgrammeAppStatus">Australian Business Registration (Commonwealth of Australia)</label>
                    <select id="acceleratorProgrammeAppStatus" name="acceleratorProgrammeAppStatus" style="width: 80%;">
                            <option value="0">Select...</option>
                             <?php 
                                if(isset($statusApp) and !empty($statusApp)){
                                    foreach($statusApp as $statusAppsAp){
                                         echo '<option value="'.$statusAppsAp->id.'">'.$statusAppsAp->status.'</option>';
                                     }
                                }   
                            ?>   
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="addAcceleratorProgramme" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
<div class="modal IndustryClassificationModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Industry Classification</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Industry">Industry Classification Name</label>
                    <input id="Industry" name="Industry" type="text" class="form-control" placeholder="Industry Classification" />
                </div>
                <div class="form-group">
                   <label for="secLogoImage">Logo Image</label>
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                            <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                                <input type="file" id="secLogoImage" name="secLogoImage"/>
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                    </div>
                </div>
                <div class="form-group">
                    <label for="industryAppStatus">Australian Business Registration (Commonwealth of Australia)</label>
                    <select id="industryAppStatus" name="industryAppStatus" style="width: 80%;">
                            <option value="0">Select...</option> 
                            <?php 
                                if(isset($statusApp) and !empty($statusApp)){
                                    foreach($statusApp as $statusAppsIn){
                                         echo '<option value="'.$statusAppsIn->id.'">'.$statusAppsIn->status.'</option>';
                                     }
                                }   
                            ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="addClassification" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="dialog" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Company Name is already exist Please enter other name!</h4>
                </div>
             
                  <div class="modal-footer">
                    <button type="button"  id="cancel_edit"   class="btn btn-secondary" data-dismiss="modal">Close</button>
                 </div>
        </div>
    </div>
</div>
<div id="loading-submit">
    <img src="<?=base_url();?>assets/images/loading.gif" alt="loading">
</div>
  
  <?php /*  other  js is in  file form.js  and adminfooter.ja in assets SaveAccount*/?>
  
<script>
$(document).ready(function(){   
 var count =1;
 $(document).on("click",".addnew1",function(){    // use for standard patent
		 $(".main_div").append('<div class="row maindiv" id="'+count+'">'+
		'<div class="col-lg-10 col-md-10 col-sm-10"><input id="right" name="rights_no_[]" type="text" placeholder="Patent, Right or Application Number..." class="form-control"></div>'
		+'<div class=" col-lg-1 col-md-1 col-sm-1 "><a class="btn addBtn remove" id=""><span style="font-size: 12px;" class="glyphicon glyphicon-remove text-danger"></span></a></div>'
		+'<div class=" col-lg-1 col-md-1 col-sm-1 "><a class="btn addBtn addnew1" id=""><span style="font-size: 12px;" class="glyphicon glyphicon-plus"></span></a></div></div>');
count++;
}); 

$(document).on("click",".remove",function(){
	  $(this).parents(".maindiv").remove();
 });
$("input[name=standardPatent]").on("change",function(){
  var value = $(this).val();
    if(value === 'Yes'){
       $(".ShowRightDiv").css('display','block');
    }
	else{
		 $(".ShowRightDiv").css('display','none');
		} 
}); 

$(document).on("click",".addnew2",function(){ //use to innovations patent
		 $(".innovation_div").append('<div class="row innovationdiv" id="'+count+'">'+
		'<div class="col-lg-10 col-md-10 col-sm-10"><input id="right" name="innovation_no_[]" type="text" placeholder="Innovation Patent, Right or Application Number..." class="form-control"></div>'
		+'<div class=" col-lg-1 col-md-1 col-sm-1 "><a class="btn addBtn remove" id=""><span style="font-size: 12px;" class="glyphicon glyphicon-remove text-danger"></span></a></div>'
		+'<div class=" col-lg-1 col-md-1 col-sm-1 "><a class="btn addBtn addnew2" id=""><span style="font-size: 12px;" class="glyphicon glyphicon-plus"></span></a></div></div>');
count++;
}); 

$(document).on("click",".remove",function(){
	  $(this).parents(".innovationdiv").remove();
});
$("input[name=innovationPatent]").on("change",function(){
  var value = $(this).val();
    if(value === 'Yes'){
       $(".ShowInnovationDiv").css('display','block');
    }
	else{
		 $(".ShowInnovationDiv").css('display','none');
		} 
});
$(document).on("click",".addnew3",function(){ //use to previous 2 categories
		 $(".previous2Categories_div").append('<div class="row previous2Categoriesdiv" id="'+count+'">'+
		'<div class="col-lg-10 col-md-10 col-sm-10"><input id="right" name="P_C_no_[]" type="text" placeholder="Innovation Patent, Right or Application Number..." class="form-control"></div>'
		+'<div class=" col-lg-1 col-md-1 col-sm-1 "><a class="btn addBtn remove" id=""><span style="font-size: 12px;" class="glyphicon glyphicon-remove text-danger"></span></a></div>'
		+'<div class=" col-lg-1 col-md-1 col-sm-1 "><a class="btn addBtn addnew3" id=""><span style="font-size: 12px;" class="glyphicon glyphicon-plus"></span></a></div></div>');
count++;
}); 

$(document).on("click",".remove",function(){
	  $(this).parents(".previous2Categoriesdiv").remove();
});
$("input[name=previous2Categories]").on("change",function(){
  var value = $(this).val();
    if(value === 'Yes'){
       $(".ShowPrevious2CategoriesDiv").css('display','block');
    }
	else{
		 $(".ShowPrevious2CategoriesDiv").css('display','none');
		} 
});
}); //main function close
</script>