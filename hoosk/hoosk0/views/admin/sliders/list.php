<?php echo $header; ?>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('menu_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>
                    <a href="<?= BASE_URL ;?>/admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-list-alt"></i>
                    <a href="#">All Sliders</a>
                </li>
            </ol>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table id="slidersList" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Slider</th>
                    <th>Short Code</th>
                    <th>Layout</th>
                    <th>Type</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th class="td-actions"> </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($sliders as $slider):?>
                    <tr data-id="<?=$slider['id']?>">
                        <td><?php echo $slider['name']?></td>
                        <td><?php echo $slider['shortCode']?></td>
                        <td>
                            <select name="layoutSelector" class="layoutSelector">
                                <option value="0">Select Layout</option>
                                <?php
                                    if(isset($layouts) and is_array($layouts)){
                                        foreach ($layouts as $layout){
                                            echo '<option value="'.$layout->id.'"'.(($slider['layout_id'] === $layout->id)?"selected='selected'":'').'>' . $layout->name . '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                         <td>
                            <select name="typeSelector" class="typeSelector">
                                <option value="0">Select Type</option>
                                <?php
                                    if(isset($types) and is_array($types)){
                                        foreach ($types as $type){
                                            echo '<option value="'.$type->id.'"'.(($slider['type_id'] === $type->id)?"selected='selected'":'').'>' . $type->name . '</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                        <td><?php echo $slider['date_created']?></td>
                        <td><?php echo $slider['date_updated']?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo $this->pagination->create_links(); ?>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('.typeSelector').on('change',function(){
            var selectedType = $(this).val();
            var selectedSlider = $(this).closest('tr').attr('data-id');
            if(selectedType > 0){
                //Run the ajax to updated the updated value.
                $.ajax({
                    url: "<?=base_url()?>admin/slider/updateSliderType",
                    data:{type:selectedType,slider:selectedSlider},
                    type:"POST",
                    success:function(output){
                        //console.log(output);
                    }
                });
            }
        });
        $('.layoutSelector').on('change',function(){
            var selectedLayout = $(this).val();
            var selectedSlider = $(this).closest('tr').attr('data-id');
            if(selectedLayout > 0){
                //Run the ajax to updated the updated value.
                $.ajax({
                    url: "<?=base_url()?>admin/slider/updateSliderLayout",
                    data:{layout:selectedLayout,slider:selectedSlider},
                    type:"POST",
                    success:function(output){
                        //console.log(output);
                    }
                });
            }
        });
    });
</script>

<?php echo $footer; ?>
