
    <!-- Content Wrapper. Contains page content -->
    <div class="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Pre-assessment
                <small>LIST</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Pre-Assessments</a></li>
                <li class="active">list</li>
            </ol>
        </section>
        
        
       
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
                            <input type="text" id="Search_by_Name" class="form-control select2" placeholder="Search By Title">   
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                            <label>Email</label>
                            <input type="text" id="Search_by_Email" class="form-control select2" placeholder="Search By Author">   
                        </div><!-- /.form-group -->
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Company</label>
                            <input type="text" id="Search_by_Company" class="form-control select2" placeholder="Search By Tags"> 
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->
               </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            </div>
            <!-- /.box-footer -->
          </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="regList" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="tablet desktop">ID</th>
                                    <th class="mobile tablet desktop">Name</th>
                                    <th class="tablet desktop">Email</th>
                                    <th class="desktop">Company</th>
                                    <th>Business</th>
                                    <th class="tablet-l desktop">Status</th>
                                    <th class="mobile tablet desktop">Action</th>
                                    <th class="mobile tablet desktop">Publish</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="tablet desktop">ID</th>
                                    <th class="mobile tablet desktop">Name</th>
                                    <th class="tablet desktop">Email</th>
                                    <th class="desktop">Company</th>
                                    <th>Business</th>
                                    <th class="tablet-l desktop">Status</th>
                                    <th class="mobile tablet desktop">Action</th>
                                    <th class="mobile tablet desktop">Publish</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    
<!-- Js file name : Adminfooter.js in assets js -->
<script type="text/javascript" src="<?= base_url()?>assets/vendors/tinymce/tinymce.min.js"></script>
 