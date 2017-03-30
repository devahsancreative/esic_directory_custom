
<div class="container-fluid">

    <div class="row">

        <div class="col-lg-12">

            <h1 class="page-header">

                <?php echo "Manage Comments"; ?>

            </h1>
     <ol class="breadcrumb">

                <li>

                <i class="fa fa-dashboard"></i>

                	<a href="<?= BASE_URL?>/admin"><?php echo $this->lang->line('nav_dash'); ?></a>

                </li>

                <li class="active">

                <i class="fa fa-fw fa-file"></i>
                     <a href="#">Manage Comments</a> </li> 
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
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                     
                    
                    <div class="box-body">
                        <table id="statusList" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Blog Title </th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Date</th>
                                <th>Comments</th>
                                <th class="">Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Blog Title </th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Date</th>
                                <th>Comments</th>
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
                        <p>Do You Want To Trash This Comment?</p>
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
<div class="modal approval-modal2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Comment Status</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        	<input type="hidden" id="hiddenUserID">
                            <input type="hidden" id="hiddenID">
                            <label for="editStatusTextBox">Update Comment Status</label>
                            <select id="editStatusTextBox" name="editStatusTextBox" style="width: 80%;">
                                    <option value="0">Select...</option>
                                     <?php 
                                        $esic_status  = $this->Common_model->select('esic_comment');
										print_r($esic_status);
										 
                                        if(isset($esic_status->status) and !empty($esic_status->status)){
                                            foreach($esic_status as $esic_status){
                                                 echo '<option value="'.$esic_status->id.'">'.$esicstatus->status.'</option>';
                                             }
                                        }   
                                    ?>    
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger mright" id="saveStatus" data-id="">Save</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- ye modal add krne ki waja se delete ka button kaam nhi kr raha -->


 
 <script>
         $(function () {
            oTable = "";
            var regTableSelector = $("#statusList");
            var url_DT = baseUrl + "admin/blog/comments/listing";
            var aoColumns_DT = [
                /* ID */ {
                    "mData": "ID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                }, 
                /* Status */ {
                    "mData": "Name"
                },
				{
                    "mData": "Blog_Title"
                },
				{
                    "mData": "Email"
                },
				{
                    "mData": "Website"
                },
				{
                    "mData": "Date"
                },
				{
                    "mData": "Comments"
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

            //Code for search box
            $("#search-input").on("keyup", function (e) {
                oTable.fnFilter($(this).val());
            });

            $(".approval-modal").on("shown.bs.modal", function (e) {

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
			$("#saveStatus").on("click", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var editStatusTextBox = $(this).parents(".modal-content").find("#editStatusTextBox").val();
                if (hiddenModalUserID == '') {
                    hiddenModalUserID = $(this).attr('data-id');
                }
                 console.log('ID = '+hiddenModalUserID);
                var postData = {id: hiddenModalUserID, value: "approve", statusValue: editStatusTextBox};
                $.ajax({
                    url: baseUrl + "admin/blog/comments",
                    data: {
                        id: hiddenModalUserID,
                        value: "approve",
                        statusValue :editStatusTextBox
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $('.approval-modal').modal('hide');
                        }
                    }
                });
            });

            $("#yesApprove").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "delete"};
                $.ajax({
                    url: baseUrl + "admin/blog/comments/delete",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $(".approval-modal").modal('hide');
                            oTable.fnDraw(false);
                        }
                    }
                });
            });  
			      setTimeout(function() {
                 $('#mydiv').fadeOut(5000);
				 }, 2000); 
			
 });
 </script>