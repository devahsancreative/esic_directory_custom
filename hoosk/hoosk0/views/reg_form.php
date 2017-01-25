<!doctype html>

<html lang="en">

<head>
    <title>Form to Wizard with jQuery Validation plugin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <style>
        .wrap { max-width: 980px; margin: 10px auto 0; }
        #steps { margin: 80px 0 0 0 }
        .commands { overflow: hidden; margin-top: 30px; }
        .prev {float:left}
        .next, .submit {float:right}
        .error { color: #b33; }
        #progress { position: relative; height: 5px; background-color: #eee; margin-bottom: 20px; }
        #progress-complete { border: 0; position: absolute; height: 5px; min-width: 10px; background-color: #337ab7; transition: width .2s ease-in-out; }

    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
    <script src="http://esic.ctsdemo.com/assets/js/jquery.formtowizard.js"></script>

    <script type="text/javascript">
        $(function() {
            var $signupForm = $( '#SignupForm' );
            $signupForm.validate({
                errorElement: 'em',
                submitHandler: function (form) {
                    $.ajax({
                            crossOrigin: true,
                            type: $(form).attr('method'),
                            url: $(form).attr('action'),
                            data: $(form).serialize()
                        })
                        .done(function (response) {
                            var data = response.split("::");
                            if(data[0] === "OK"){
                                $signupForm.remove();
                                $("#progress-complete").css("width","100%");
                                $("#progress-complete").css("background-color","#5fba7d");
                                $('#progress').append("<div><p>"+data[1]+"</p></div>");
                            }else{

                            }

                        });
                    return false; // required to block normal submit since you used ajax
                }
            });

            $signupForm.formToWizard({
                submitButton: 'SaveAccount',
                nextBtnClass: 'btn btn-primary next',
                prevBtnClass: 'btn btn-default prev',
                buttonTag:    'button',
                validateBeforeNext: function(form, step) {
                    var stepIsValid = true;
                    var validator = form.validate();
                    $(':input', step).each( function(index) {
                        var xy = validator.element(this);
                        stepIsValid = stepIsValid && (typeof xy == 'undefined' || xy);
                    });
                    return stepIsValid;
                },
                progress: function (i, count) {
                    $('#progress-complete').width(''+(i/count*100)+'%');
                }
            });
        });
    </script>

</head>

<body>
<div class="row wrap">
    <div class="col-lg-12">

        <div id='progress'><div id='progress-complete'></div></div>

        <form id="SignupForm" action="<?php echo base_url('Reg/submit')?>" method="post">
            <fieldset>
                <legend>Early Stage Companies Pre-assessment</legend>
                <p>
                    This pre-assessment will help you determine if you are likely to qualify as an Eligible Early Stage
                    Innovation Company, i.e. a company that meets both the Early Stage Test and either the 100 point
                    Innovation Test or the Principles-based Innovation Test. Failing these tests, the company may
                    request a taxation ruling from the Australian Tax Office.
                </p>

                <div class="form-group">
                    <label for="Name">Name</label>
                    <div class="row">
                        <div class="col-lg-6">
                            <input id="NameFirst" name="firstName" type="text" placeholder="First" class="form-control"
                                  required />
                        </div>
                        <div class="col-lg-6">
                            <input id="NameLast" name="lastName" type="text" placeholder="Last" class="form-control"
                                  required />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Email">Email</label>
                    <input id="Email" name="email" type="email" class="form-control" required />
                </div>
                <div class="form-group">
                    <label for="Company">Company Name</label>
                    <input id="Company" name="company" type="text" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="Business">Business Name (if different)</label>
                    <input id="Business" name="business" type="text" class="form-control" />
                </div>
            </fieldset>

            <fieldset>
                <legend>Early Stage Limb</legend>
                <div>
                    <strong>Did your business have less than or equal to $1 million in expenses in the previous income year?</strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="1mExpense">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="1mExpense">No</label>
                    </div>
                </div>

                <div>
                    <strong>Did your business have less than or equal to $200,000 in assessable income in the previous income year? (Excluding Accelerating Commercialisation Grant)</strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="assessableIncomeYear">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="assessableIncomeYear">No</label>
                    </div>
                </div>

                <div>
                    <strong>Is your business listed on any stock exchanges?</strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="listedInSExchange">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="listedInSExchange">No</label>
                    </div>
                </div>

                <div>
                    <strong>When was your company incorporated in Australia?</strong>
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
                </div>

                <div id="whollyOwned">
                    <strong>Have you and your wholly owned subsidiaries incurred less than $1 million in expenses total across the last 3 income years?</strong>
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

                <div>
                    <strong>Is your company developing a new or significantly improved type of innovation? (See http://www.oecd.org/sti/oslomanual for examples of innovation)
                    </strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="improvedInnovation">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="improvedInnovation">No</label>
                    </div>
                </div>

                <div>
                    <strong>Does your company have the potential for high growth?</strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="potentialHighGrowth">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="potentialHighGrowth">No</label>
                    </div>
                </div>

                <div>
                    <strong>Is your company scalable? (Can you reduce or minimize cost increase as your revenues grow)
                    </strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="companyScalable">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="companyScalable">No</label>
                    </div>
                </div>

                <div>
                    <strong>Will you be able to address a national, international or global market?</strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="globalMarket">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="globalMarket">No</label>
                    </div>
                </div>

                <div>
                    <strong>Is there potential for a clear competitive advantage over other companies? </strong>
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
                <p><span style="text-decoration: underline">Objective Test (100 Points Required)</span><br />
                    See the <span style="text-decoration: underline">FAQ</span> for an explanation of how points are awarded.
                </p>

                <div>
                    <strong>Which of the following describes your R&D expenses as a proportion of total expenses?
                    </strong>
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

                <div>
                    <strong>Have you received an Accelerating Commercialisation Grant under the Accelerating Commercialisation element of the Commonwealth's Entrepreneur's programme?</strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="EntrepreneurProgramme">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="EntrepreneurProgramme">No</label>
                    </div>
                </div>

                <div>
                    <strong>Has your business undertaken or completed an accelerator programme? Provided that the entity has been operating the programme for 6 months and has provided a complete programme to at least one cohort of entrepreneurs.
                    </strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="cohortOfEntrepreneurs">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="cohortOfEntrepreneurs">No</label>
                    </div>
                </div>

                <div>
                    <strong>Has your business issued $50,000 or more in shares to a third party who was not an associate and did not acquire those shares to help another entity become entitled to the tax incentives? </strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="taxIncentives">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="taxIncentives">No</label>
                    </div>
                </div>

                <div>
                    <strong>Does your business have a standard patent or plant breeder's right, or the equivalent in another country within the past 5 years?  </strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="standardPatent">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="standardPatent">No</label>
                    </div>
                </div>

                <div>
                    <strong>Does your business have an innovation patent or design right or the equivalent in another country within the the past 5 years?</strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="innovationPatent">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="innovationPatent">No</label>
                    </div>
                </div>

                <div>
                    <strong>Does your business hold a license to IP that falls into either of the previous 2 categories? </strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="previous2Categories">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="previous2Categories">No</label>
                    </div>
                </div>

                <div>
                    <strong>Does your business have a written agreement to co-develop and commercialise an innovation with a university or a research organization? </strong>
                    <div class="radio">
                        <label><input type="radio" value="Yes" name="researchOrganization">Yes</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" value="No" name="researchOrganization">No</label>
                    </div>
                </div>
            </fieldset>

            <button id="SaveAccount" type="submit" class="btn btn-primary submit">Submit form</button>

        </form>

    </div></div>
<script type="text/javascript">
    $(function(){
        $("input[name='incorporatedAus']").on("change",function(){
            if($(this).val() === 'Between six and three years ago'){
                $("#whollyOwned").show();
                console.log("show");
            }else{
                $("#whollyOwned").hide();
            }
        });
    });
</script>
</body>
</html>
