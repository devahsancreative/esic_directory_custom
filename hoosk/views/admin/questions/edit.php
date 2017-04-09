<style type="text/css">
    .multiple-item-container{
        background: #ddd;
        padding: 5px;
        margin: 10px 5px;
    }
    .multiple-item-container span{
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
        padding: 5px 10px;
        display: inline-block;
        margin: 5px;
        font-size: 12px;
    }
    body .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #3c8dbc;
        border-color: #367fa9;
        padding: 1px 10px;
        color: #fff;
    }
    body .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #000;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form action="<?= base_url().'admin/question/update';?>" method="post" class="form" enctype="multipart/form-data">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit/Update Question</h3>
                        <div class="add-New-container">
                            <a href="<?= base_url().'admin/questions/index';?>" class="addNewBtn"><i class="fa fa-angle-double-left"></i> Listing</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <input type="hidden" id="hiddenQuestionID" name="hiddenQuestionID" value="<?=(isset($question) and is_numeric($question->QuestionID))?$question->QuestionID:""?>">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="questionTextBox">Question:</label>
                                    <input type="text" name="question" id="questionTextBox" value="<?=(isset($question->Question))?$question->Question:""?>" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="roleAssignedSelector">Assign To:</label>
                                    <select class="form-control" name="roleAssigned[]" id="roleAssignedSelector" multiple="multiple">
                                        <?php
                                            if(!empty($listings) and is_array($listings)){
                                                if(isset($questionListings) and !empty($questionListings)){
                                                    $listingIDsArray = array_column($questionListings,'listing_id');
                                                }
                                                foreach ($listings as $listing){
                                                    if(in_array($listing->id,$listingIDsArray)){
                                                        $selected=true;
                                                    }else{
                                                        $selected=false;
                                                    }
                                                    echo '<option value="'.$listing->id.'" '. (($selected===true)?"selected='selected'":"") .' >'.$listing->listName.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="answerType">Answer Type:</label>
                                    <select class="form-control" name="answerType" id="answerType">
                                        <option value="0">Select Type</option>
                                        <?php
                                            if(isset($answer_types) and is_array($answer_types)){
                                                foreach ($answer_types as $key=>$answer_type){
                                                    echo '<option value="'.$answer_type->id.'" '.((intval($answer_type->id)=== intval($question->AnswerType))?"selected='selected'":"").'>'.$answer_type->name.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div id="answerBox">

                                </div>
                            </div>
                        </div>
                    </div> <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="button-container pull-right">
                            <input type="submit" class="btn btn-primary" value="Save" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.col -->
    </div>
</section>



<script type="text/javascript">
    $(function () {

        //Call the Layout Function on Page Load.
        fetchLayoutAnswers($('#answerType').val(),$('#hiddenQuestionID').val());
        $('#roleAssignedSelector').select2({
            multiple:true
        });

        //Call the Layout Function on Change of Type.
        $('#answerType').on('change',function(){
            //Select Template Based on Changed AnswerType.
            //Currently The Following Answer Types are given.
            // 1. Checkbox, 2. SelectBox, 3.Radio Buttons

            var selectedLayoutID = $(this).val();
            var qID = $('#hiddenQuestionID').val();

            //Call the Function
            fetchLayoutAnswers(selectedLayoutID,qID);
        });

        $('body').on('click','#addNewRadio',function(event){
            var obj = $(this);

            if(!event.detail || event.detail == 1){ //Preventing the Double Click Problem
                obj.attr('disabled','disabled');

                //Send the New Record to the Database through Ajax if valid record.
                var hiddenRadio = $(this).parents('form').find('#hiddenRadioID');
                var valueTextBox = $(this).parents('#newRadioRow').find('#value');
                var textTextBox = $(this).parents('#newRadioRow').find('#text');
                var value = valueTextBox.val();
                var text =textTextBox.val();
                var qID = $(this).parents('form').find('#hiddenQuestionID').val();
                var radioID = hiddenRadio.val();

                if(!value || !text){
                    Haider.notification('Text Boxes can not be left empty while creating a new radio option.','error','Required');
                    return false;
                }

                var postData = {
                    v:value,
                    t:text,
                    q:qID,
                    rID:radioID
                };

                $.ajax({
                    url:"<?=base_url()?>admin/questions/update_answer_radio",
                    data:postData,
                    type:'POST',
                    success:function (output) {
                        var data = output.trim().split('::');
                        if(data[0] === 'OK'){
                            //Add that Radio to the List As Well on front end.
                            var html = "<div class='radio'>" +
                                "<label for='"+radioID+"'>" +
                                "<input type='radio' name='radio_"+qID+"' id='"+radioID+"' value='"+value+"'>" +
                                text +
                                "</label>" +
                                "<span class='actions pull-right'>" +
                                "<a href='javascript:void(0);' class='btn btn-default subQuestionRadio'><i class='fa fa-plus'></i></a>" +
                                "<a href='javascript:void(0);' class='btn btn-default trashRadio'><i class='fa fa-trash text-red'></i></a>" +
                                "</span></div>";
                            //Add the New Added Record to the Page.
                            $('#radios').append(html);

                            //Update the Radio ID.
                            var radioIDArray = radioID.split('_');
                            radioIDArray[2] = parseInt(radioIDArray[2]) + 1;
                            //Join and assign it back to hidden field.
                            radioID = radioIDArray.join('_');
                            hiddenRadio.val(radioID);

                            //Finally Just Empty the Fields.
                            valueTextBox.val('');
                            textTextBox.val('');
                        }//End of If OK
                        Haider.notification(data[1],data[2]);
                        obj.removeAttr('disabled');
                    }
                });
            }//Need to Prevent the Damn Double Click paradox

        }); //When Clicked on Add New Radio..



        $('body').on('click','.trashRadio',function(){
            var obj = $(this);
            var questionID = $('#hiddenQuestionID').val();
            var radioID = $(this).parents('div.radio').find('input[type="radio"]').attr('id');
            var postData = {
                qID:questionID,
                rID:radioID
            };
            $.ajax({
                url: "<?=base_url()?>admin/questions/removeRadio",
                data: postData,
                type: "POST",
                success: function (output) {
                    var data = output.trim().split('::');
                    Haider.notification(data[1],data[2],data[3]);

                    if(data[0] === 'OK'){
                        obj.parents('.radio').remove();
                    }
                }
            });


        }); //End of Clicked Trash Icon on Radio.
    });


    //Work For Checkboxes
    $(function () {
        $('body').on('click','#addNewCheckbox',function(){
            var obj = $(this);

            if(!event.detail || event.detail == 1){ //Preventing the Double Click Problem
                obj.attr('disabled','disabled');

                //Send the New Record to the Database through Ajax if valid record.
                var hiddenCheckbox = obj.parents('form').find('#hiddenCheckboxID');
                var valueTextBox = obj.parents('#newCheckboxRow').find('#value');
                var textTextBox = obj.parents('#newCheckboxRow').find('#text');
                var value = valueTextBox.val();
                var text =textTextBox.val();
                var qID = obj.parents('form').find('#hiddenQuestionID').val();
                var checkBoxID = hiddenCheckbox.val();

                if(!value || !text){
                    Haider.notification('Text Boxes can not be left empty while creating a new radio option.','error','Required');
                    return false;
                }

                var postData = {
                    n:value,
                    t:text,
                    q:qID,
                    cID:checkBoxID
                };
                $.ajax({
                    url:"<?=base_url()?>admin/questions/update_answer_checkbox",
                    data:postData,
                    type:'POST',
                    success:function (output) {
                        var data = output.trim().split('::');
                        if(data[0] === 'OK'){
                            //Add that Radio to the List As Well on front end.
                            var html = "<div class='checkbox'>" +
                                "<label for='"+checkBoxID+"'>" +
                                "<input type='checkbox' name='checkbox_"+qID+"' id='"+checkBoxID+"' value='"+value+"'>" +
                                text +
                                "</label>" +
                                "<span class='actions pull-right'>" +
                                "<a href='javascript:void(0);' class='btn btn-default subQuestionCheckbox'><i class='fa fa-plus'></i></a>" +
                                "<a href='javascript:void(0);' class='btn btn-default trashCheckbox'><i class='fa fa-trash text-red'></i></a>" +
                                "</span></div>";
                            //Add the New Added Record to the Page.
                            $('#CheckBoxes').append(html);

                            //Update the Radio ID.
                            var radioIDArray = checkBoxID.split('_');
                            radioIDArray[2] = parseInt(radioIDArray[2]) + 1;
                            //Join and assign it back to hidden field.
                            checkBoxID = radioIDArray.join('_');
                            hiddenCheckbox.val(checkBoxID);

                            //Finally Just Empty the Fields.
                            valueTextBox.val('');
                            textTextBox.val('');
                        }//End of If OK
                        Haider.notification(data[1],data[2]);
                        obj.removeAttr('disabled');
                    }
                });
            }//Need to Prevent the Damn Double Click paradox
        }); //End of Add New Checkbox
        $('body').on('click','.trashCheckbox',function(){
            console.log('trash icon clicked');
            var obj = $(this);
            var questionID = $('#hiddenQuestionID').val();
            var checkboxID = $(this).parents('div.checkbox').find('input[type="checkbox"]').attr('id');
            var postData = {
                qID:questionID,
                cID:checkboxID
            };
            $.ajax({
                url: "<?=base_url()?>admin/questions/removeCheckbox",
                data: postData,
                type: "POST",
                success: function (output) {
                    var data = output.trim().split('::');
                    Haider.notification(data[1],data[2],data[3]);

                    if(data[0] === 'OK'){
                        obj.parents('.checkbox').remove();
                    }
                }
            });
        });
    });

    function fetchLayoutAnswers(selectedLayoutID,qID) {
        var url = '<?=base_url()?>admin/questions/layout/'+selectedLayoutID;
        var data = {
            'layout' : selectedLayoutID,
            'qID': qID
        };


        //Send an ajax request.
        $.ajax({
            url:url,
            data:data,
            type:'POST',
            success:function(output){
                $('#answerBox').html(output);
            }
        });
    }
</script>
