
<!-- Content Wrapper. Contains page content -->
<div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Questions & Answers
            <small>LIST</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Questions & Answers</a></li>
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

<!--        Listing-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="<?=base_url()?>admin/questions/create" class="btn btn-primary pull-right" style="margin: 10px;">Add Question</a>
                        <table id="questionsList" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="tablet desktop">ID</th>
                                <th class="mobile tablet desktop">Question</th>
                                <th class="tablet desktop">Possible Solutions</th>
                                <th class="desktop">AssignedTo</th>
                                <th class="mobile tablet desktop">Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th class="tablet desktop">ID</th>
                                <th class="mobile tablet desktop">Question</th>
                                <th class="tablet desktop">Possible Solutions</th>
                                <th class="desktop">AssignedTo</th>
                                <th class="mobile tablet desktop">Active</th>
                                <th>Action</th>
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
<script type="text/javascript">
    $(function(){
        oTable = "";

//        $('#questionsList').DataTable();

        var regTableSelector = $("#questionsList");
        var url_DT = baseUrl + "admin/questions/listing";
        var aoColumns_DT = [
            /* User ID */ {
                "mData": "QuestionID",
                "bVisible": true,
                "bSortable": true,
                "bSearchable": true
            },
            /* Question */ {
                "mData": "Question"
            },
            /* Possible Answers */ {
                "mData": "Solution"
            },
            /* Modules e-g lawyer, r&d etc */ {
                "mData": "AssignedTo"
            },
            /* IsActive/ IsPublished */ {
                "mData": "Active",
                "render": function (data, type, row) {
                    if (data != '') {
                        if (data == 0) {
                            return '<span class="label publish label-danger" data-target=".publish-modal" data-toggle="modal" >InActive</span>';
                        } else if (data == 1) {
                            return '<span class="label publish label-success" data-target=".unpublish-modal" data-toggle="modal" >Active</span>';
                        } else {
                            return '<span class="label publish label-warning" data-target=".unpublish-modal" data-toggle="modal" >Unknown</span>';
                        }
                    }
                    return '<span class="label publish label-warning" data-target=".unpublish-modal" data-toggle="modal" >Unknown</span>';
                }
            },
            /* Publish Buttons */ {
                "mData": "ViewEditActionButtons"
            }
        ];
        var HiddenColumnID_DT = "QuestionID";
        var sDom_DT = '<"H"r>t<"F"<"row"<"col-lg-6 col-xs-12" i> <"col-lg-6 col-xs-12" p>>>';
        var newRowNumber =  localStorage.getItem("pageNumber") * 10;
        if(newRowNumber == undefined || newRowNumber == '' ){
            newRowNumber = 0;
        }
        commonDataTablesPage(regTableSelector, url_DT, aoColumns_DT, sDom_DT, HiddenColumnID_DT,newRowNumber);
        //oTable.fnPageChange(40);
        new $.fn.dataTable.Responsive(oTable, {
            details: true,
        });
        removeWidth(oTable);
        //Code for search box
        $("#search-input").on("keyup", function (e) {
            oTable.fnFilter($(this).val());
        });

    });
</script>

