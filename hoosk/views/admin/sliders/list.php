<?php echo $header; ?>
<style type="text/css">

    .sliderTypes{}
    .sliderTypes .form-group{
        margin-bottom: 5px;
    }
    .sliderTypes .form-group label{
        width: 25%;
        min-width: 63px;
        margin-bottom: 0px;
    }
    .sliderTypes .form-group input{
        display: inline-block;
        width: 50px;
        /* float: right; */
        margin: 0px;
        padding: 2px 5px;
        height: 25px;
    }
</style>

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
        <div class="col-md-2">
            <div class="form-group">
                <a href="<?=base_url()?>admin/slider/new" class="form-control btn btn-primary">Add New Slider</a>
            </div>
        </div>
        <div class="col-md-12">
            <table id="slidersList" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Slider Layouts ID</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                 <tr data-id="1">
                    <td>1</td>
                    <td>Slider With Search</td> 
                    <td></td> 
                 </tr>
                  <tr data-id="1">
                    <td>2</td>
                    <td>Slider Without Search</td> 
                    <td></td> 
                 </tr>
                </tbody>
            </table>
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>

<!--script type="text/javascript">
   /* $(function () {
        $('.sliderTypes input').on('focusout',function(){
            var itemNumber  = $(this).val();
            var name        = $(this).attr('name');
            var selectedSlider = $(this).closest('tr').attr('data-id');
            if(itemNumber > 0){
                //Run the ajax to updated the updated value.
                $.ajax({
                    url: "<?=base_url()?>admin/slider/updateSliderType",
                    data:{
                        itemNumber:itemNumber,
                        name: name,
                        slider:selectedSlider
                    },
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
    });*/
</script-->

<?php echo $footer; ?>
