
    <!-- Content Wrapper. Contains page content -->
    <div class="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Investor Pre Assessment
                <small>LIST</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?= base_url()?>/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Investor Pre Assessment</a></li>
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
                            <label>Status</label>
                            <input type="text" id="Search_by_Status" class="form-control select2" placeholder="Search By Tags"> 
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
                        
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="regList" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th class="tablet desktop">ID</th>
                                    <th class="mobile tablet desktop">Name</th>
                                    <th class="tablet desktop">Email</th>
                                    <th class="tablet-l desktop">Status</th>
                                    <th class="mobile tablet desktop">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th class="tablet desktop">ID</th>
                                    <th class="mobile tablet desktop">Name</th>
                                    <th class="tablet desktop">Email</th>
                                    <th class="tablet-l desktop">Status</th>
                                    <th class="mobile tablet desktop">Action</th>
                                    
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
    <div class="modal approval-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Trashed Model</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Do You Want To Trash This Investor?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="yesApprove">Yes</button>
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close" id="nodelete">No</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

 
<div class="modal change-status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Investor Published / UnPublished</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Are You Sure To Change Investor Status ?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="yeschange">Yes</button>
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close" id="nodelete">No</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
 <script>
         $(function () {
            //// Need To Work ON New Way Of DataTables..
            oTable = "";
            //Initialize Select2 Elements
            var regTableSelector = $("#regList");
            var url_DT = baseUrl + "admin/investor/investor_list/listing";
            var aoColumns_DT = [
                /* User ID */ {
                    "mData": "UserID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                },
                /* Full Name */ {
                    "mData": "FullName"
                },
                /* Email */ {
                    "mData": "Email"
                },
               /* Last User Login */ {
                    "mData": "Status"
                },
                /* Action Buttons */ {
                    "mData": "ViewEditActionButtons"
                }
                
            ];
            var HiddenColumnID_DT = "UserID";
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
/*            $(document).bind('click',"#regList_paginate .pagination li",function(evt){
                    var pageNumber = oTable.fnPagingInfo().iPage;//becaue it get 0 for page 1
                    localStorage.setItem("pageNumber", pageNumber);
            });*/
			
			 oTable = $('#regList').DataTable();  // // Search by Title
			 $('#Search_by_Name').keyup(function(){
			  oTable.column(1).search($(this).val()).draw() ;
			 })
			  oTable = $('#regList').DataTable();  //// Search by Author
			 $('#Search_by_Email').keyup(function(){
			  oTable.column(2).search($(this).val()).draw() ;
			 })
			  oTable = $('#regList').DataTable();  ////Search by Tags    
			 $('#Search_by_Status').keyup(function(){
			  oTable.column(3).search($(this).val()).draw() ;
			 }) 

           

            $(".approval-modal").on("shown.bs.modal", function (e) {

                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var Status = $.trim(button.parents("tr").find('td').eq(1).text());
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find(".modal-body").find('p > strong').text(' "' + Status + '"');
            });
			 $(".change-status").on("shown.bs.modal", function (e) {

                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var Status = $.trim(button.parents("tr").find('td').eq(1).text());
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find(".modal-body").find('p > strong').text(' "' + Status + '"');
            });
			 $("#editStatusModal").on("shown.bs.modal", function (e) {
				var button = $(e.relatedTarget); // Button that triggered the modal
				var ID = button.parents("tr").attr("data-id");
				var Status = $.trim(button.parents("tr").find('td').eq(1).text());
				var modal = $(this);
				modal.find("input#hiddenID").val(ID);
				modal.find("#editStatusBox").val(Status);

            });

            $("#yesApprove").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "delete"};
                $.ajax({
                    url: baseUrl + "admin/investor/investor_list/delete",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $(".approval-modal").modal('hide');
                            oTable.draw();
                        }
                    }
                });
            }); 
			$("#yeschange").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "status"};
                $.ajax({
                    url: baseUrl + "admin/investor/investor_list/status",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $(".change-status").modal('hide');
                            oTable.draw();
                        }
                    }
                });
            }); 
			      setTimeout(function() {
                 $('#mydiv').fadeOut(5000);
				 }, 2000); 
			
 });
 </script>