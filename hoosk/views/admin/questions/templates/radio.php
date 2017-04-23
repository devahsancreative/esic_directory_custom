<style type="text/css">
    .radio{
        margin: 20px;
        border: 1px dashed #ccc;
        padding: 20px;
    }
    .radio:hover{
        border-color:#39cccc;
    }
    .radio:hover > span.actions{
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
        $RadioOptions = json_decode($Solution->Solution);
    }
?>

<div id="radios">
<?php
if(isset($RadioOptions) and !empty($RadioOptions->data)){
    $key=0;
    foreach($RadioOptions->data as $key=>$Radio){
        ?>
        <div class="radio">
            <label for="<?=$Radio->id?>">
                <input type="radio" name="radio_<?=$question_ID?>" id="<?=$Radio->id?>" value="<?=$Radio->value?>" checked="">
                <?=$Radio->text?>
            </label>
            <span class="actions pull-right">
                <a href="javascript:void(0);" class="btn btn-default subQuestionRadio"><i class="fa fa-plus"></i></a>
                <a href="javascript:void(0);" class="btn btn-default trashRadio"><i class="fa fa-trash text-red"></i></a>
            </span>
        </div>
<?php
    }//End of Foreach
}
?>
</div>


<div class="form-group" id="newRadioRow">
    <label>
        New Radio
    </label>

    <div class="col-md-12">
        <input type="hidden" id="hiddenRadioID" value="radio_<?=$question_ID.'_'.(++$key)?>">
        <div class="col-md-3">
            <label for="value">Value</label>
            <input type="text" class="form-control" id="value" name="value">
        </div>
        <div class="col-md-6">
            <label for="text">Radio Text</label>
            <input type="text" class="form-control" id="text" name="text">
        </div>

        <div class="col-md-3">
            <div class="actionButtons" style="margin-top: 25px;">
                <a data-toggle="tooltip" title="Add New Radio Option" href="javascript:void(0);" class="btn btn-primary" id="addNewRadio"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

