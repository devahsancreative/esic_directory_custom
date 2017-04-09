$(function(){
    if($("#EsicList").length > 0){
        oTable = "";
        var regTableSelector = $("#EsicList");
        var url_DT = baseUrl + "admin/manage_esic/listing";
        var aoColumns_DT = [
            /* ID */ {
                "mData": "ID",
                "bVisible": true,
                "bSortable": true,
                "bSearchable": true,
                "render":function( data, type, full, meta){
                    if(data!=''){
                        //return '<a href="'+base_url+'admin/Esic/view/'+full.ID+'" >'+full.ID+'</a>';
                        return '<a href="'+base_url+'admin/Esic/details/'+full.ID+'" >'+full.ID+'</a>';
                    }
                    return data;
                    
                }
            },
            /* Name */ {
                "mData": "Name",
                "render":function( data, type, full, meta){
                    if(data!=''){
                        //return '<a class="esicName" href="'+base_url+'admin/Esic/view/'+full.ID+'" >'+full.Name+'</a>';
                        return '<a class="esicName" href="'+base_url+'admin/Esic/details/'+full.ID+'" >'+full.Name+'</a>';
                    }
                    return data;
                    
                }
            },
            //Email Address
            //{
            //    "mData": "Email"
            //},
            //Website Address
            {
                "mData": "Website"
            },
            // Status Label
            {
                "mData": "Status_Label"
            },
            //Logo or Avatar
            {
                "mData": "Logo",
                "render": function ( data, type, row ) {
                    if(data!=''){
                        return '<img data-target=".logo-edit-modal" data-toggle="modal" alt="Edit" src="'+srcImage(data,this)+'" class="esic-logo" style="height:50px;width:50px;cursor:pointer;" />';
                    }
                    return '<span data-target=".logo-edit-modal" data-toggle="modal" class="esic-logo">Empty </span>';
                },
                "className":"centerLogo"
            },
            /* Publish */ {
                "mData": "Publish",
                "render": function ( data, type, full, meta){
                    if(data!=''){
                        return '<div data-PublishStatusID="'+full.PublishStatusID+'" class="Publish-Status">'+full.Publish+'</div>';
                    }
                    return '<span>Empty</span>';
                }
            },
            /* Trashed */ {
                "mData": "Trashed"
            },
            /* Action Buttons */ {
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

        sTable = $('#EsicList').DataTable();  // // Search by Title
        $("#search-input").on("keyup", function (e) {
            sTable.fnFilter($(this).val());
        });
        $('#searchbyName').keyup(function(){
           sTable.column(1).search($(this).val()).draw();
        }); 
    }
            $("#saveStatus").on("click", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var editStatusTextBox = $(this).parents(".modal-content").find("#editStatusTextBox").val();
                if (hiddenModalUserID == '') {
                    hiddenModalUserID = $(this).attr('data-id');
                }
                var postData = {id: hiddenModalUserID, value: "approve", statusValue: editStatusTextBox};
                $.ajax({
                   url: baseUrl + "admin/assessment_list",
                    data: {
                        id: hiddenModalUserID,
                        value: "approve",
                        statusValue :editStatusTextBox
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            oTable.draw();
                            $('.approval-modal').modal('hide');
                        }
                    }
                });
            });         
});//End of Document Ready Function.