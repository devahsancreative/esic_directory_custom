$(function(){
    if($("#AcceleratingCommercialisationList").length > 0){
        oTable = "";
        var regTableSelector = $("#AcceleratingCommercialisationList");
        var url_DT = baseUrl + "admin/manage_acceleratingcommercialisation/listing";
        var aoColumns_DT = [
            /* ID */ {
                "mData": "ID",
                "bVisible": true,
                "bSortable": true,
                "bSearchable": true,
                "render":function( data, type, full, meta){
                    if(data!=''){
                        return '<a href="'+base_url+'admin/AcceleratingCommercialisation/view/'+full.ID+'" >'+full.ID+'</a>';
                    }
                    return data;
                    
                }
            },
            /* Name */ {
                "mData": "Member",
                "render":function( data, type, full, meta){
                    if(data!=''){
                        return '<a href="'+base_url+'admin/AcceleratingCommercialisation/view/'+full.ID+'" >'+full.Member+'</a>';
                    }
                    return data;
                    
                }
            },
             //Website Address
            {
               "mData": "Web_Address"
            },
             //Project Title
            {
               "mData": "Project_Title"
            },
            // Logo or Avatar
            {
                "mData": "Logo",
                "render": function ( data, type, row ) {
                    if(data!=''){
                        return '<img data-target=".logo-edit-modal" data-toggle="modal" alt="Edit" src="'+srcImage(data,this)+'" class="AcceleratingCommercialisation-logo" style="height:50px;width:50px;cursor:pointer;" />';
                    }
                    return '<span data-target=".logo-edit-modal" data-toggle="modal" class="AcceleratingCommercialisationList-logo">Empty </span>';
                },
                "className":"centerLogo"
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
        sTable = $('#AcceleratingCommercialisationList').DataTable();  // // Search by Title
        $("#search-input").on("keyup", function (e) {
            sTable.fnFilter($(this).val());
        });
        $('#searchbyName').keyup(function(){
           sTable.column(1).search($(this).val()).draw() ;
        }); 
    }
}); 