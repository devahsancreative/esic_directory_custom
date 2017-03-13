<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
 
<style>
input.input_search {
 
    width: 100%;
    padding: 6px;
    font-size: 12px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.myInputTextField {
    float: right;
    margin-bottom: 20px;
  }
input#myInputTextField {
    width: 200px;
} 
</style>
<div class="container-fluid">

    <div class="row">

        <div class="col-lg-12">

            <h1 class="page-header">

                <?php echo "Manage Blogs"; ?>

            </h1>
   <a href="<?= base_url()?>admin/blog/add_blog"> <button class="btn btn-sm btn-success pull-right">Add New Blog</button></a>
            <ol class="breadcrumb">

                <li>

                <i class="fa fa-dashboard"></i>

                	<a href="<?= BASE_URL?>/admin"><?php echo $this->lang->line('nav_dash'); ?></a>

                </li>

                <li class="active">

                <i class="fa fa-fw fa-file"></i>
                     <a href="<?= base_url()?>admin/blog">Manage Blogs</a> </li> 
                <li><small>list</small></li>     
            
          </ol>

        </div>

    </div> 
         <?php if($this->session->userdata('msg')){?>
                <div class="alert alert-success" id="mydiv">
                      <?php echo $this->session->userdata('msg');
                      $this->session->unset_userdata('msg');
                      ?>
		       </div>
         <?php }?>
</div>
 <div class="">
       
 
 
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
                            <label>Title</label>
                            <input type="text" id="Search_by_Title" class="form-control select2" placeholder="Search By Title">   
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                            <label>Author</label>
                            <input type="text" id="Search_by_Author" class="form-control select2" placeholder="Search By Author">   
                        </div><!-- /.form-group -->
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tags</label>
                            <input type="text" id="Search_by_Tags" class="form-control select2" placeholder="Search By Tags"> 
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                         <div class="form-group">
			                <label>Date range:</label>
			                <div class="input-group">
			                  <div class="input-group-addon">
			                    <i class="fa fa-calendar"></i>
			                  </div>
			                   <input class="date_range_filter form-control pull-right" type="text" id="datePickerRange" />
			             	</div>
                    	</div> <!-- /.form-group -->
                    </div>
                     <!-- /.col -->
                    <div class="col-md-4 ">
                        <!--<div class="form-group">
			                <label>Reset:</label>
			                <div class="input-group">
			                  <button class="btn btn-block btn-primary" id="reset_btn">Reset</button>
			             	</div>
                    	</div>--><!-- /.form-group -->
                    </div><!-- /.col -->
                     
                     
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
            </div>
            <!-- /.box-footer -->
          </div>
     <div class="myInputTextField">
          <input type="text" id="myInputTextField" class="input_search" placeholder="Search"> 
	 </div>      
        <div class="row">
        
            <div class="col-xs-12">
            
                <div class="box">
                     
                    
                    <div class="box-body">
                   
      <table id="blogsList" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Tags</th>
                                <th>Date</th>
                                <th class="">Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Tags</th>
                                <th>Date</th>
                                <th class="">Status</th>
                                <th>Action</th>

                            </tr>
                            </tfoot>
                        </table>
                    </div> <!-- /.box-body -->
                    <div class="box-footer">
                    	 
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
 <div class="modal approval-modal-forstatus">
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
                        <p>Do You Want To Trash This Blog?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="yes-delete-status">Yes</button>
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
                <h4 class="modal-title">Blog Published / UnPublished</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Are You Sure To Change Blog Status ?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="yes-change-status">Yes</button>
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close" id="nodelete">No</button>
            </div>

        </div> 
    </div> 
</div>
 
 


 
 <script>
         $(function () {
            oTable = "";
            var regTableSelector = $("#blogsList");
			   
            var url_DT = baseUrl + "admin/blog/show/listing";
            var aoColumns_DT = [
                /* ID */ {
                    "mData": "ID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                },
                /* Status */
				{
                    "mData": "Title"
                },
				{
                    "mData": "Author"
                },
				{
                    "mData": "Tags"
                },
				 {
                    "mData": "Date"
                },
			    {
                    "mData": "Status"
                },
				 {
                    "mData": "ViewEditActionButtons"
                  }
            ];
            var HiddenColumnID_DT = "ID";
            var sDom_DT = '<"H"r>t<"F"<"row"<"col-lg-6 col-xs-12" i> <"col-lg-6 col-xs-12" p>>>';
            commonDataTables(regTableSelector, url_DT, aoColumns_DT, sDom_DT, HiddenColumnID_DT);


            new $.fn.dataTable.Responsive(oTable, {
                details: true
            });
            removeWidth(oTable);


             $('#datePickerRange').on('change',function(){
                 var currentDateRange = $(this).val();
/*                 console.log(currentDateRange);
                 //Now we need to send the filtered value to the ajax request
//                 oTable.fnDestroy();
                 regTableSelector.dataTable().fnDestroy();
                 var filter = regTableSelector.dataTable().aoData.push({"name":"dateRangeBox", "value":currentDateRange});
                 commonDataTables(regTableSelector,url_DT,aoColumns_DT,sDom_DT,HiddenColumnID_DT,"","",filter)*/

                 var oSettings = regTableSelector.dataTable().fnSettings();
                 var oSettingsTemp = oSettings;
                 if(oSettings != null) {
                     oSettings.aoServerParams.splice("fn",1);
                     oSettings.aoServerParams.push({"fn": function (aoData) {
                         aoData.push({
                             "name": "dateRange",
                             "value": currentDateRange
                         });
                     }});

                     regTableSelector.dataTable().fnDraw();
                     oSettings = oSettingsTemp
                 }
             });//End of on Change Function.

            //Code for search box
            $("#search-input").on("keyup", function (e) {
                oTable.fnFilter($(this).val());
            });
			 oTable = $('#blogsList').DataTable();  // Search by anything     
			 $('#myInputTextField').keyup(function(){
			  oTable.search($(this).val()).draw() ;
			 })
			  oTable = $('#blogsList').DataTable();  // // Search by Title
			 $('#Search_by_Title').keyup(function(){
			  oTable.column(1).search($(this).val()).draw() ;
			 })
			  oTable = $('#blogsList').DataTable();  //// Search by Author
			 $('#Search_by_Author').keyup(function(){
			  oTable.column(2).search($(this).val()).draw() ;
			 })
			  oTable = $('#blogsList').DataTable();  ////Search by Tags    
			 $('#Search_by_Tags').keyup(function(){
			  oTable.column(3).search($(this).val()).draw() ;
			 })
          $(".approval-modal-forstatus").on("shown.bs.modal", function (e) {

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

            $("#yes-delete-status").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "delete"};
                $.ajax({
                    url: baseUrl + "admin/blog/show/delete",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $(".approval-modal-forstatus").modal('hide');
                            oTable.draw();
                        }
                    }
                });
            });

     		 $(".change-status").on("shown.bs.modal", function (e) {

                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var Status = $.trim(button.parents("tr").find('td').eq(1).text());
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find(".modal-body").find('p > strong').text(' "' + Status + '"');
            });
			  $("#yes-change-status").on("click", function () {
			    var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "status"};
				$.ajax({
                    url: baseUrl + "admin/blog/show/status",
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
 
  $('#datePickerRange').daterangepicker(
      {
          locale: {
              format: 'DD-MM-YYYY'
          },

          <?php
          if(isset($minMaxDate)){
            ?>
          startDate:"<?=date('d-m-y',strtotime($minMaxDate->minDate))?>",
          endDate:"<?=date('d-m-y',strtotime($minMaxDate->maxDate))?>"
          <?php
          }
          ?>
      });
 });
 
   setTimeout(function() {
                 $('#mydiv').fadeOut(3000);
				 }, 2000); 

 </script>
