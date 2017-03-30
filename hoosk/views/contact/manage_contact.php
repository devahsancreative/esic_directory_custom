<section class="content-header">
    <h1>
        Mailbox
        <small><?php  echo $Count_contact_message;?> New Messages</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url()?>admin"><?php echo $this->lang->line('nav_dash'); ?></a></li>

        <li class="active">Manage Contact Us </li><small> LIST</small>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <a href="<?php echo BASE_URL ; ?>/admin/contact/manage_contact" class="btn btn-primary btn-block margin-bottom">Back To Messages</a>

            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Folders</h3>

                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">



                        <li><a href="<?=base_url('admin/users/email')?>"><i class="fa fa-envelope-o"></i> Compose Email</a></li>

                        <li><a href="<?php echo BASE_URL ; ?>/admin/contact/manage_contact"><i class="fa fa-envelope-o"></i> Inbox
                                <span class="label label-primary pull-right"><?= $Count_contact_message; ?></span></a></li>
                        <li><a href="<?=base_url('admin/users/sent')?>"><i class="fa fa-envelope-o"></i> Sent
                                <span class="label label-primary pull-right"><?= $Count_email_message; ?> </span>
                            </a></li>
                        <li><a href="<?= base_url()?>admin/users"><i class="fa fa-user"></i> Select Users  </a></li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /. box -->

            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Manage Contact Us</h3>
                </div>

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
                                        <input type="text" id="Search_by_To" class="form-control select2" placeholder="Search By Name">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" id="Search_by_Subject" class="form-control select2" placeholder="Search By Email">
                                        </div><!-- /.form-group -->
                                    </div><!-- /.form-group -->
                                </div><!-- /.col -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="text" id="Search_by_Date" class="form-control select2" placeholder="Search By Date">
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

                                <div class="box-body">
                                    <table id="statusList" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Date</th>
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


            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</section>





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
                        <p>Do You Want To Trash This Email?</p>
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

<script>
    $(function () {
        oTable = "";
        var regTableSelector = $("#statusList");
        var url_DT = baseUrl + "admin/contact/manage_contact/listing";
        var aoColumns_DT = [
            /* ID */ {
                "mData": "ID",
                "bVisible": true,
                "bSortable": true,
                "bSearchable": true
            },
            /* Status */ {
                "mData": "FirstName"
            },
            {
                "mData": "Email"
            },
            {
                "mData": "send_date"
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
        oTable = $('#statusList').DataTable();  // // Search by Title
        $('#Search_by_To').keyup(function(){
            oTable.column(1).search($(this).val()).draw() ;
        })
        oTable = $('#statusList').DataTable();  //// Search by Author
        $('#Search_by_Subject').keyup(function(){
            oTable.column(2).search($(this).val()).draw() ;
        })
        oTable = $('#statusList').DataTable();  ////Search by Tags
        $('#Search_by_Date').keyup(function(){
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
                url: baseUrl + "admin/contact/manage_contact/delete",
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
    });
</script>