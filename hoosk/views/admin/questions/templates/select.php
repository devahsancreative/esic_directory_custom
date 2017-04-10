<div class="form-group col-lg-6 col-md-12">
    <label>Select Box Items</label>
    <select multiple="multiple" class="form-control" id="selectBoxItems" data-placeholder="Add Items Here">
    </select>
</div>
<div class="form-group col-lg-6 col-md-12">

        <label>SelectBox Text</label>
        <input type="text" class="form-control" name="selectBoxText" id="selectBoxText" placeholder="Label For Selector">
</div>
<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="checkbox" name="is_multi" id="is_multi">
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
