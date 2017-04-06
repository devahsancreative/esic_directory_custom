<?php
echo '<pre>';
var_dump($question);
echo '</pre>';
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form action="<?= base_url().'Question/update';?>" method="post" class="form" enctype="multipart/form-data">
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
                            <input type="hidden" id="hiddenQuestionID" value="<?=(isset($question) and is_numeric($question->QuestionID))?$question->QuestionID:""?>">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="NameTextBox">Question:</label>
                                    <input type="text" name="Name" id="NameTextBox" value="<?=(isset($question->Question))?$question->Question:""?>" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="answerType">Answer Type:</label>
                                    <select class="form-control" name="answerType" id="answerType">
                                        <option value="0">Select Type</option>
                                        <?php
                                            if(isset($answer_types) and is_array($answer_types)){
                                                foreach ($answer_types as $key=>$answer_type){
                                                    echo '<option value="'.$answer_type->id.'">'.$answer_type->name.'</option>';
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
                        <div class="button-container">
                            <input type="submit" class="btn btn-primary" value="Save" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.col -->
    </div>
</section>

<link href="https://ctsdemo.com/demos/esic_directory/assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
