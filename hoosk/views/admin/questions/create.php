<section class="content">
    <div class="row">
    <div class="col-md-12">
        <form action="<?= base_url().'admin/question/store';?>" method="post" class="form" enctype="multipart/form-data">
            <input type="hidden" id="hiddenQuestionID" value="">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Add Question</h3>
                    <div class="add-New-container">
                        <a href="<?= base_url().'admin/questions/index';?>" class="addNewBtn"><i class="fa fa-angle-double-left"></i> Listing</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <input type="hidden" id="hiddenListID" value="">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="questionTextBox">Question:</label>
                                <input type="text" name="question" id="questionTextBox" class="form-control" />
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
                            <div class="from-group" id="answerBox">

                            </div>
                        </div>
                    </div>
                </div> <!-- /.box-body -->
                <div class="box-footer">
<!--                    <div class="button-container">
                        <input type="submit" class="btn btn-primary" value="Save" />
                    </div>-->
                </div>
            </div>
        </form>
    </div>
    <!-- /.col -->
</div>
</section>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/questions.css">
<script type="text/javascript">
    $(function () {

        $('#roleAssignedSelector').select2({
            multiple:true
        });


        $('#roleAssignedSelector').on('change',function(){
            var assignedRoles = $(this).val();
            var qID = $('#hiddenQuestionID').val();
            if(!qID){
                return false;
            }

            //Assign the Roles.
            updateRoles(qID,assignedRoles);
        });

        //Create a Question First.
        $('#questionTextBox').on('change',function(){
            //Well Lets create or update the question.
            var question = $(this).val();
            var qID = $('#hiddenQuestionID').val();
            if(question.length < 3){
                Haider.notification('Please add a valid question first.', 'warning');
                return false;
            }

            var postData = {
                question: question
            }

            if(qID){
                postData.qID = qID;
            }

            var url = "<?=base_url()?>admin/question/store";

            $.ajax({
                url:url,
                data:postData,
                type:"POST",
                success:function (output) {
                    var data = output.trim().split('::');
                    if(data[0] === 'OK'){
                        if(data[3]){
                            var questionID = data[3];
                            $('#hiddenQuestionID').val(questionID);

                            //Assign the Roles if Exist.
                            var assignedRoles = $('#roleAssignedSelector').val();
                            if(assignedRoles && assignedRoles.length > 0){
                                updateRoles(questionID,assignedRoles);
                            }
                        }
                        //Check if Layout is previous selected before adding the question.
                        var answerType = $('#answerType').val();
                        if(answerType && data[3] && parseInt(answerType) > 0 ){
                            updateAnswerType(data[3],answerType);
                            fetchLayoutAnswers(answerType,$('#hiddenQuestionID').val());
                        }
                    }//end of If Statement
                    Haider.notification(data[1],data[2]);
                }
            })
        });
        //Call the Layout Function on Change of Type.
        $('#answerType').on('change',function(){
            //Select Template Based on Changed AnswerType.
            //Currently The Following Answer Types are given.
            // 1. Checkbox, 2. SelectBox, 3.Radio Buttons
            var selectedLayoutID = $(this).val();
            var qID = $('#hiddenQuestionID').val();

            //Lets update on the server as well.
            //Only if Question ID Exists.
            if(qID){
                updateAnswerType(qID,selectedLayoutID);
                //Call the Function
                fetchLayoutAnswers(selectedLayoutID,qID);
            }
        });


    });


    //For the Radio
    $(function(){
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
    })

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
    function updateRoles(qID,assignedRoles){

        var postData =
            {
                'qID'   : qID,
                'roles' : assignedRoles
            }

        $.ajax({
            url:"<?=base_url()?>admin/question/updateRoles",
            type:"POST",
            data:postData,
            success:function (output) {
                var data = output.trim().split('::');
                //Update the Notification.
                Haider.notification(data[1],data[2]);
            }
        });
    }
    function updateAnswerType(questionID,answerType) {
        var postData = {
            qID  : questionID,
            type :answerType
        }
        $.ajax({
            url:"<?=base_url()?>admin/question/updateAnswerType",
            type:"POST",
            data:postData,
            success:function (output) {
                var data = output.trim().split("::");
                Haider.notification(data[1],data[2]);
            }
        })
    }
</script>
