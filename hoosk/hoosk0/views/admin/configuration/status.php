
<!-- Content Wrapper. Contains page content -->
<div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Esic Status
            <small>LIST</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Esic Status</a></li>
            <li class="active">list</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Manage Esic Status</h3>
                        <div class="add-New-container">
                    		<a href="#" data-target=".addNewModal" data-toggle="modal" class="addNewBtn">Add New</a>
                    	</div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="statusList" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Color</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Color</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div> <!-- /.box-body -->
                    <div class="box-footer">
                    	<div class="add-New-container">
                    		<a href="#" data-target=".addNewModal" data-toggle="modal" class="addNewBtn">Add New</a>
                    	</div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<!--Edit Status Modal-->
<div class="modal" id="editStatusModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Esic Status</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenID">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="editStatusBox">Esic Status</label>
                            <input type="text" id="editStatusBox" class="form-control" />
                        </div>
                        <div class="form-group" id="dvupdatecolor">
                            <label for="updatecolor">Select Button Color</label>
                            <input type="color" id="updatecolor" class="form-control" />
                    </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="updateStatusBtn">Update</button>
                <button type="button" class="btn btn-danger mright"  data-dismiss="modal">Cancel</button>
             </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->


<!--Edit Status Modal-->
<div class="modal addNewModal" id="addStatus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Status</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenID">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="addStatusTextBox">Status</label>
                            <input type="text" id="addStatusTextBox" class="form-control" />
                        </div>
                    <div class="form-group"  id="color">
                            <label for="add_button_color">Select Button Color</label>
                            <input type="color" id="add_button_color" class="form-control" />
                    </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                 <button type="button" class="btn btn-success" id="addStatusBtn">Add</button>
                <button type="button" class="btn btn-danger mright"  data-dismiss="modal">Cancel</button>
               
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->