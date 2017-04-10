
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
                            <label for="datatables_general_search">Search</label>
                            <input type="text" id="datatables_general_search" class="form-control select2" data-placeholder="Search...">
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Assigned To</label>
                            <select class="form-control" name="assignedToSelectBox" id="search_by_assigned_to" multiple="multiple" data-placeholder="Search By List Type">
                                <?php
                                    if(!empty($listings) and is_array($listings)){
                                        foreach($listings as $listing){
                                            echo '<option value="'.$listing->id.'">'.$listing->listName.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="search_by_publish_type">Active</label>
                                <select name="search_by_publish_type" id="search_by_publish_type" class="form-control select2" data-placeholder="Search By Active Type" multiple="multiple"></select>
                            </div><!-- /.form-group -->
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
                                <th class="tablet desktop">Solution Type</th>
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
                                <th class="tablet desktop">Solution Type</th>
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
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/questions.css">
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
                "bSearchable": false
            },
            /* Question */ {
                "mData": "Question",
                "bSearchable": true
            },
            {
                "mData":"answerType"
            },
            /* Possible Answers */
            {
                "mData": "Solution",
                "render": function (data, type, row) {
                    if(data){
                        var JSONArray = JSON.parse(data);
                        if(JSONArray.data){
                            var html = "";
                            if(JSONArray.type === 'radios'){
                                $.each(JSONArray.data,function(key,value){
                                    html += ' <span class="label label-info">'+ value.text+'</span> ';
                                });
                                return html;
                            }else if(JSONArray.type === 'CheckBoxes'){
                                $.each(JSONArray.data,function(key,value){
                                    html += ' <span class="label label-info">'+ value.text+'</span> ';
                                });
                                return html;
                            }//End of else
                        }
                    }
                    return '';
                }
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
        $("#datatables_general_search").on("keyup", function (e) {
            oTable.fnFilter($(this).val());
        });

        $(document).bind('click',"#questionsList_paginate .pagination li",function(evt){
            var pageNumber = oTable.fnPagingInfo().iPage;//becaue it get 0 for page 1
            localStorage.setItem("pageNumber", pageNumber);
        });


        ////For Filters Section
        $('#search_by_assigned_to,#search_by_publish_type').select2({
            multiple:true
        });

        $('#search_by_assigned_to').on('change',function(){
            var selectedListingValue = $(this).val();
            var filters = "";
            filters = 'aoData.push({"name":"listing_id","value":"'+ selectedListingValue +'"});';
            oTable.fnDestroy();
            commonDataTablesPage(regTableSelector, url_DT, aoColumns_DT, sDom_DT, HiddenColumnID_DT,newRowNumber,'','',filters);
        });

        $('body').on('click','.fa-trash-o',function(){
            var questionID = $(this).parents('tr').attr('data-id');

            if(!questionID){
                return false;
            }

            var postData = {
                qID: questionID,
                type: 'trash'
            }

            $.ajax({
                url:"<?= base_url()?>admin/question/trash",
                data:postData,
                type:"POST",
                success:function(output){
                    var data = output.trim().split('::');
                    if(data[0] === 'OK'){
                        oTable.fnDraw(false);
                    }
                    Haider.notification(data[1],data[2]);
                }
            });
        });

    });
</script>

