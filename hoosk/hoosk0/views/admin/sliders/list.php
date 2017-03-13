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
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th class="td-actions"> </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($sliders as $slider):?>
                    <tr>
                        <td><?php echo $slider['name']?></td>
                        <td><?php echo $slider['shortCode']?></td>
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

</script>

<?php echo $footer; ?>
