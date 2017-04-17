<?php

if(isset($Solution) and !empty($Solution) and !empty($Solution->Solution)){
    $SelectOptions = json_decode($Solution->Solution);

    //Get all the items from the Radio Options.
    if(!empty($SelectOptions)){
        $SelectItems = $SelectOptions->data;
    }
}

?>

<div class="form-group col-lg-6 col-md-12">
    <label>Select Box Items</label>
    <select multiple="multiple" name="selectBoxItems[]" class="form-control" id="selectBoxItems" data-placeholder="Add Items Here">
        <?php
        if (isset($SelectItems) and !empty($SelectItems)) {
            foreach ($SelectItems as $selectItem) {
                ?>
                <option value="<?= $selectItem->value ?>" selected="selected"><?= $selectItem->text ?></option>
                <?php

            }//End of Foreach Loop
        }//End of the If Statement
        ?>
    </select>
</div>
<div class="form-group col-lg-6 col-md-12">
        <label>SelectBox Text</label>
        <input type="text" class="form-control" name="selectBoxText" id="selectBoxText" placeholder="Label For Selector" value="<?=((isset($SelectOptions->textBoxText) and !empty($SelectOptions->textBoxText))?$SelectOptions->textBoxText:'')?>">
</div>
<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="checkbox" name="is_multi" id="is_multi" <?=((isset($SelectOptions->isMulti) and $SelectOptions->isMulti === 'Yes')?"checked='checked'":"")?>>
            Is Multi Select ?
        </label>
    </div>
</div>
<link rel="stylesheet" href="<?=base_url()?>assets/css/questions.css" type="text/css">
<script type="text/javascript">
    $(function () {
        $('#selectBoxItems').select2({
            tags:true
        });
    });
</script>
