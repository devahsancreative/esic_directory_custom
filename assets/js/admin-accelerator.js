$(function(){
    if($("#AcceleratorList").length > 0){
        oTable = "";
        var regTableSelector = $("#AcceleratorList");
        var url_DT = baseUrl + "admin/manage_accelerator/listing";
        var aoColumns_DT = [
            /* ID */ {
                "mData": "ID",
                "bVisible": true,
                "bSortable": true,
                "bSearchable": true,
                "render":function( data, type, full, meta){
                    if(data!=''){
                        return '<a href="'+base_url+'admin/Accelerator/view/'+full.ID+'" >'+full.ID+'</a>';
                    }
                    return data;
                    
                }
            },
            /* name */ {
                "mData": "name",
                "render":function( data, type, full, meta){
                    if(data!=''){
                        return '<a href="'+base_url+'admin/Accelerator/view/'+full.ID+'" >'+full.name+'</a>';
                    }
                    return data;
                    
                }
            },
            //website Address
            {
                "mData": "website"
            },
            //Logo or Avatar
            {
                "mData": "Logo",
                "render": function ( data, type, row ) {
                    if(data!=''){
                        return '<img data-target=".logo-edit-modal" data-toggle="modal" alt="Edit" src="'+srcImage(data,this)+'" class="Accelerator-logo" style="height:50px;width:50px;cursor:pointer;" />';
                    }
                    return '<span data-target=".logo-edit-modal" data-toggle="modal" class="Accelerator-logo">Empty </span>';
                },
                "className":"centerLogo"
            },
            /* Accelerator Status */ {
                "mData": "AcceleratorStatus",
                "render": function ( data, type, row ) {
                    if(data!=''){
                        if(data =='Eligible'){
                            return '<span class="label label-success success">Eligible</span>';
                        }
                        if(data =='Pending'){
                            return '<span class="label label-danger danger">Pending</span>';
                        }
                    }
                    return '<span class="label label-danger danger">Pending</span>';
                },
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

        sTable = $('#AcceleratorList').DataTable();  // // Search by Title
        $("#search-input").on("keyup", function (e) {
            sTable.fnFilter($(this).val());
        });
        $('#searchbyName').keyup(function(){
           sTable.column(1).search($(this).val()).draw();
        }); 
    }
});