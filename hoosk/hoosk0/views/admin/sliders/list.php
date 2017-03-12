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
                    <a href="#"><?php echo $this->lang->line('menu_header'); ?></a>
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
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th class="td-actions"> </th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>
</div>



<?php echo $footer; ?>
