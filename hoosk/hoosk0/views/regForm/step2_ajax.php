<!doctype html>

<html lang="en">

<head>
    <title>Form to Wizard with jQuery Validation plugin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
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

    <style type="text/css">
        fieldset{
            background: rgba(232, 234, 246, 0.87) none repeat scroll 0 0;
            padding: 10px;
        }
        fieldset > div {
            background: rgba(66, 66, 66, 0.1) none repeat scroll 0 0;
            border-radius: 5px;
            margin: 5px;
            padding: 5px;
        }
        legend{
            background-color: #424242;
            color: #fff;
            text-align: center;
            height:60px;
            padding: 15px 0;
        }
        form{
            /*background-color: #424242;*/
        }
        #mainFormDiv{
            /*background-color: #424242;*/
            box-shadow: 0 0 9px rgba(0, 0, 0, 0.3);
            background-image: url("uploads/8/4/3/6/84367404/background-images/561993498.jpg") !important;
        }
        #SaveAccount{
            margin-top:5px;
            margin-bottom:5px;
        }
        #selectorDiv{
            background: rgba(66, 66, 66, 0.1) none repeat scroll 0 0;
            margin-top: 8px;
            padding: 10px;
        }
    </style>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>
    <link href="<?=base_url()?>assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
<div class="row wrap">
    <div class="col-lg-12" id="mainFormDiv">

        <form id="SignupFormStep2" action="<?php echo base_url('Reg/submitStep2')?>" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend>Early Stage Companies Pre-assessment</legend>
                <p>
                    This pre-assessment will help you determine if you are likely to qualify as an Eligible Early Stage
                    Innovation Company, i.e. a company that meets both the Early Stage Test and either the 100 point
                    Innovation Test or the Principles-based Innovation Test. Failing these tests, the company may
                    request a taxation ruling from the Australian Tax Office.
                </p>

                <div class="form-group">
                    <label for="Logo">Logo</label>
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
                            <select id="industryClassification" style="width: 80%;">
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
            <button id="SaveAccount" type="button" class="btn btn-primary submit">Submit</button>
        </form>

    </div></div>
<!--Working on Modals-->

<div class="modal IndustryClassificationModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Industry">Industry Classification Name</label>
                    <input id="Industry" name="Industry" type="text" class="form-control" placeholder="Industry Classification" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="addClassification" type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script type="text/javascript" src="<?=base_url()?>assets/vendors/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
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
<script type="text/javascript" src="<?=base_url()?>assets/vendors/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#industryClassification").select2();

        var $form = $('#SignupFormStep2');


        $("#SaveAccount").on("click",function(e){
            e.preventDefault();
            var formData = new FormData();
            formData.append('logo', $('#Logo')[0].files[0]);
            formData.append('banner', $('#BannerImage')[0].files[0]);
            formData.append('product', $('#productImage')[0].files[0]);
            formData.append('sector', $('#industryClassification').val());
            <?php

                if(isset($userID) and is_numeric($userID)){
                    echo "formData.append('userID', ".$userID.");";
                }

            ?>

            $.ajax({
                crossOrigin: true,
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: formData,
                processData: false,
                contentType: false
            }).done(function (response) {
                var data = response.split("::");
                if(data[0] === 'OK'){
                    $("#mainFormDiv").remove();
                    $("#wsite-content").html('<span style="padding: 5px; color: green; font-weight: bold; border: 2px dotted green;">Thank you, Your Record have been successfully Updated</span>');
                }else if(data[0] === 'FAIL'){

                }
            });
        });

        $("#addClassification").on("click",function(){
            var Industry = $("#Industry");
            var IndustryValue = Industry.val();
            
            if(IndustryValue.length === 0){
                Industry.parents(".form-group").addClass('has-error');
                return false ;
            }else{
                Industry.parents(".form-group").removeClass('has-error');
            }
            var IndustryNameCheck = '0';
            var Industryfilter    = $('#industryClassification option').filter(
                function(){ 
                    if($(this).html() == IndustryValue){
                        var valuecheck      = $(this).val();
                        var selectIndustry  = $("#industryClassification").select2();
                        selectIndustry.val(valuecheck).trigger("change"); 
                        IndustryNameCheck='1';
                        $('.IndustryClassificationModal').modal().hide();
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    }
                });
            if(IndustryNameCheck=='0'){
                $.ajax({
                    url: "<?=base_url()?>Reg/addIndustryClassification",
                    type:"POST",
                    data:{Industry:IndustryValue},
                    success:function(output){
                        var  data =  output.split('::');    
                        if(data[0]=='OK'){
                            var IndustryId   = data[1];
                            var IndustryName = data[2]; 
                            var newOption    = new Option(IndustryName,IndustryId, true, true);
                                $("#industryClassification").append(newOption).trigger('change');
                                $('.IndustryClassificationModal').modal().hide();
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                        }else if(data[0]=='Existed'){
                            var IndustryNameValue   = $('#industryClassification option').filter(function () { return $(this).html() == IndustryValue}).val();
                            var valuecheck          = $(this).val();
                            var selectIndustry      = $("#industryClassification").select2();
                            selectIndustry.val(IndustryNameValue).trigger("change"); 
                            $('.IndustryClassificationModal').modal().hide();
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                        }
                    }
                });
            }
             
        });
    });
</script>
</body>
</html>
