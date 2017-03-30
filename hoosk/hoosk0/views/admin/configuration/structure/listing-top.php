        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Filter By</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>

            <div class="box-body">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="searchbyName" class="form-control select2" placeholder="Search By Name">
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer clearfix">
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Manage <?= $ListingLabel; ?></h3>
                        <div class="add-New-container">
                            <a href="<?= base_url().$ControllerRouteName.'/Add'; ?>" class="addNewBtn">Add New</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">