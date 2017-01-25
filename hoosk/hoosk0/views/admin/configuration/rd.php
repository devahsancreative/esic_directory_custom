<!-- Content Wrapper. Contains page content -->
<div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            R&D
            <small>LIST</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">R&D</a></li>
            <li class="active">list</li>
        </ol>
    </section>
    <style type="text/css">
        .img-logo{
            max-width: 350px;
            width: 100%;
            margin: 0 auto;
        }
        .img-logo img{
            width: 100%;
        }
        .btn-logo-edit{
            bottom: 0px;
            width: 100%;
            max-width: 200px;
            margin: 10px auto;
            background: rgba(0,0,0,0.5);
            color: #fff;
            cursor: pointer;
        }
    </style>

    <!-- Main content -->
    <section class="content">
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Filter By</h3>
              <div class="box-tools pull-right">
                   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
			<div class="box-body">
            
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="Name" class="form-control select2" placeholder="Search By Name">   
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                            <label>IDNumber</label>
                            <input type="text" id="IDNumber" class="form-control select2" placeholder="Search By IDNumber">   
                        </div><!-- /.form-group -->
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" id="Address" class="form-control select2" placeholder="Search By Address"> 
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->
              </div>
            </div>
            
            <div class="box-footer clearfix">
            </div>
            <!-- /.box-footer -->
          </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Manage R&D </h3>
                        <div class="add-New-container">
                            <a href="#" data-target=".addNewModal" data-toggle="modal" class="addNewBtn">Add New</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="RnDList" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>IDNUMBER</th>
                                <th>Address</th>
                                <th>ANZSRC</th>
                                <th>Logo</th>
                                <th>ABR</th>
                                <th>Permanent</th>
                                <th>Trashed</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody> 
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>IDNUMBER</th>
                                <th>Address</th>
                                <th>ANZSRC</th>
                                <th>Logo</th>
                                <th>ABR</th>
                                <th>Permanent</th>
                                <th>Trashed</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
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

<!--Edit Acceleration Modal-->
<div class="modal" id="editRndModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit R&D</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenRndID">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="editrndTextBox">R&D Name</label>
                            <input type="text" id="editrndTextBox" class="form-control" />
                            <label for="editrndTextBoxIdNumber">R&D ID Number</label>
                            <input type="text" id="editrndTextBoxIdNumber" class="form-control" />
                            <label for="editrndTextBoxAddressContact">R&D Address</label>
                            <input type="text" id="editrndTextBoxAddressContact" class="form-control" />
                            <label for="editrndTextBoxAnzsrc">R&D ANZSRC</label>
                            <input type="text" id="editrndTextBoxAnzsrc" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger mright"  data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="updateRnDBtn">Update</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->


<!--Edit Acc Modal-->
<div class="modal addNewModal" id="addRnD">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add R&D</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenID">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="addRnDTextBox">R&D Name</label>
                            <input type="text" id="addRnDTextBox" class="form-control" />
                            <label for="addrndTextBoxIdNumber">R&D ID Number</label>
                            <input type="text" id="addrndTextBoxIdNumber" class="form-control" />
                            <label for="addrndTextBoxAddressContact">R&D Address Contact</label>
                            <input type="text" id="addrndTextBoxAddressContact" class="form-control" />
                            <label for="addrndTextBoxAnzsrc">R&D ANZSRC</label>
                            <input type="text" id="addrndTextBoxAnzsrc" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger mright"  data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="addRnDBtn">Add</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->


<!--Edit Ward Modal-->
<div class="modal logo-edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Logo</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" id="hiddenUserID">
                            <input type="hidden" id="hiddenID">
                            <label for="editStatusTextBox">Update Logo</label>
                            <div class="img-container img-logo img-responsive">
                                <img src="dummy" class="image-show" id="logo-show" />
                            </div>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-file btn-logo-edit"><span class="fileupload-new">Click To</span><span class="fileupload-exists"> Edit</span>
                                    <input id="update-logo-file" type="file" name="logo" />
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger mright" id="updateLogo">Save</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->

<!-- js is in file Admin-rnd.js -->