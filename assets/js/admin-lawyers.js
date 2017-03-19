
$(function(){
    oTable = "";
    var regTableSelector = $("#lawyersList");
    var url_DT = baseUrl + "admin/manage_lawyers/listing";
    var aoColumns_DT = [
        /* ID */ {
            "mData": "ID",
            "bVisible": true,
            "bSortable": true,
            "bSearchable": true
        },
        /* lawyer */ {
            "mData": "Lawyer"
        },
        //Lawyer Phone or Cell
        {
            "mData": "Phone"
        },
        //Lawyer's Email Address
        {
            "mData": "Email"
        },
        //Lawyer's Website Address
        {
            "mData": "Website"
        },
        //Lawyer Logo or Avatar
        {
            "mData": "Logo",
            "render": function ( data, type, row ) {
                if(data!=''){
                    return '<img data-target=".logo-edit-modal" data-toggle="modal" alt="Edit" src="'+baseUrl+data+'" class="uni-logo" style="height:50px;width:50px;cursor:pointer;" />';
                }
                return '<span data-target=".logo-edit-modal" data-toggle="modal" class="uni-logo">Empty </span>';
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





//Now Moving to the CRUD Operations
//Function for Adding New Record to the Database.
$("#addLawyerBtn").on("click", function () {
    var modal = $(this).parents(".addNewModal");
    var modalData = modal.find(".modal-content");
    //Getting the Records First
    var LawyerName = modalData.find("#lawyer_NameTextBox").val();
    var LawyerPhone = modalData.find("#lawyer_NameTextBox").val();
    var LawyerEmail = modalData.find("#lawyer_NameTextBox").val();
    var LawyerWebsite = modalData.find("#lawyer_NameTextBox").val();

    var postData = {
        Lawyer: LawyerName,
        Phone:LawyerPhone,
        Email:LawyerEmail,
        Website:LawyerWebsite
    };
    $.ajax({
        url: baseUrl + "admin/manage_lawyers/new",
        data: postData,
        type: "POST",
        success: function (output) {
            var data = output.trim().split("::");
            console.log(data);
            if (data[0] === "OK") {
                //Hide the Modal as Insertion was as success
                modal.modal('hide');
                //Give the Pretty Notification to the User.
                Haider.notification(data[1],data[2]);
                oTable.draw();
            }
        }
    });
});


//Functions for Approving the Trash through Modal
//When Approval Modal Shows Up
$(".approval-modal").on("shown.bs.modal", function (e) {
    var button = $(e.relatedTarget); // Button that triggered the modal
    var lawyerID = button.parents("tr").attr("data-id");
    var Lawyer = button.parents("tr").find('td').eq(1).text();
    var modal = $(this);
    modal.find("input#hiddenUserID").val(lawyerID);
    var Message = 'Are you sure you want to trash record of: <strong>'+Lawyer+'</strong>';
    modal.find(".modal-body").find('p').html(Message);
    modal.find('.modal-header').find('h4').html('Trash <strong>'+Lawyer+'</strong>');
});
//When Yes has been Selected on Approval Modal, Just Trash the Selected Data.
$("#yesApprove").on("click", function () {
    var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
    var postData = {id: hiddenModalID, value: "trash"};
    $.ajax({
        url: baseUrl + "admin/manage_lawyers/trash",
        data: postData,
        type: "POST",
        success: function (output) {
            var data = output.trim().split("::");
            if (data[0] == 'OK') {
                $(".approval-modal").modal('hide');
                oTable.fnDraw();
            }
            if(data[3]){
                Haider.notification(data[1],data[2],data[3]);
            }else{
                Haider.notification(data[1],data[2]);
            }
        }
    });
}); //End of Yes Approve Function

//When No has been Selected on Approval Modal, Just Un-Trash the Selected Data.
    $("#nodelete").on("click", function () {
        var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
        var postData = {id: hiddenModalUserID, value: "untrash"};
        $.ajax({
            url: baseUrl + "admin/manage_lawyers/trash",
            data: postData,
            type: "POST",
            success: function (output) {
                var data = output.trim().split("::");
                if (data[0] == 'OK') {
                    $('.approval-modal').modal('hide');
                    oTable.fnDraw();
                }

                if(data[3]){
                    Haider.notification(data[1],data[2],data[3]);
                }else{
                    Haider.notification(data[1],data[2]);
                }
            }
        });
    });


});//End of Document Ready Function.
