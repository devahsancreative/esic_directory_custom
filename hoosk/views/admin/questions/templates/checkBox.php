<style type="text/css">
    .checkbox{
        margin: 20px;
        border: 1px dashed #ccc;
        padding: 20px;
        -webkit-transform: scale(1);
        display: block;
        float: none;
    }
    .checkbox:hover{
        border-color:#39cccc;
    }
    .checkbox:hover > span.actions{
        display: block;
    }
    .actions > a{
        padding:5px 10px;

    }
    span.actions{
        display: none;
    }
</style>


<?php
if(isset($Solution) and !empty($Solution)){
    $CheckBoxesOptions = json_decode($Solution->Solution);
}
?>



<!--div containing all checkboxes-->
<div id="CheckBoxes" class="form-group clearfix">
    <?php
    if(isset($CheckBoxesOptions) and !empty($CheckBoxesOptions->data) and is_array($CheckBoxesOptions->data)){
        $key=0;
        foreach($CheckBoxesOptions->data as $key=>$CheckBox){
            ?>
            <div class="checkbox">
                <label for="<?=$CheckBox->id?>">
                    <input type="checkbox" name="<?=$CheckBox->name?>" id="<?=$CheckBox->id?>">
                    <?=$CheckBox->text?>
                </label>
                <span class="actions pull-right">
<!--                <a href="javascript:void(0);" class="btn btn-default subQuestionCheckbox"><i class="fa fa-plus"></i></a>-->
                <a href="javascript:void(0);" class="btn btn-default trashCheckbox"><i class="fa fa-trash text-red"></i></a>
            </span>
            </div>
            <?php
        }//End of Foreach
    }
    ?>

</div>



<div class="form-group" id="newCheckboxRow">
    <label>
        New CheckBox
    </label>

    <div class="col-md-12">
        <input type="hidden" id="hiddenCheckboxID" value="checkbox_<?=$question_ID.'_'.(++$key)?>">
        <div class="col-md-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="value" name="value">
        </div>
        <div class="col-md-6">
            <label for="text">Checkbox Text</label>
            <input type="text" class="form-control" id="text" name="text">
        </div>

        <div class="col-md-3">
            <div class="actionButtons" style="margin-top: 25px;">
                <a data-toggle="tooltip" title="Add New Checkbox Option" href="javascript:void(0);" class="btn btn-primary" id="addNewCheckbox"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>


