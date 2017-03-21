
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
                    return '<img data-target=".logo-edit-modal" data-toggle="modal" alt="Edit" src="'+lawyerImage(data,this)+'" class="lawyer-logo" style="height:50px;width:50px;cursor:pointer;" />';
                }
                return '<span data-target=".logo-edit-modal" data-toggle="modal" class="lawyer-logo">Empty </span>';
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
function lawyerImage(dbData,elem) {
    var defaultLawyerImage = baseUrl+"assets/img/lawyer.png";
    if(!dbData){
        return defaultLawyerImage
    }
    var imagePath = baseUrl+'/'+dbData;

    var http = new XMLHttpRequest();
    http.open('HEAD', imagePath, false);
    http.send();

    if(http.status!=404){
        return imagePath;
    }else{
        return defaultLawyerImage;
    }
}



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

    $(".logo-edit-modal").on("shown.bs.modal", function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var lawyerID = button.parents("tr").attr("data-id");
        var Lawyer = button.parents("tr").find('td').eq(1).text();
        var modal = $(this);
        modal.find("input#hiddenUserID").val(lawyerID);
        var src = button.attr('src');
        modal.find("img#logo-show").attr('src', src);
        modal.find(".modal-body").find('p > strong').text(' "' + name + '"');
    });


    /*Now for Edit Lawyer Modal */
    //On Modal Load
    $("#editLawyersModal").on("shown.bs.modal", function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var ID = button.parents("tr").attr("data-id");
        var Lawyer = button.parents("tr").find('td').eq(1).text();
        var Phone = button.parents("tr").find('td').eq(2).text();
        var Email = button.parents("tr").find('td').eq(3).text();
        var Website = button.parents("tr").find('td').eq(4).text();
        var modal = $(this);
        //Populating the Inputs
        modal.find("input#hiddenID").val(ID);
        modal.find("input#lawyer_editNameTextBox").val(Lawyer);
        modal.find("input#lawyer_editPhoneTextBox").val(Phone);
        modal.find("input#lawyer_editEmailBox").val(Email);
        modal.find("input#lawyer_editWebsiteBox").val(Website);
    });

    //On Edit Modal If Update has been clicked, Update the Record.
    $("#updateLawyersBtn").on("click", function () {
        var id = $(this).parents(".modal-content").find("#hiddenID").val();
        var Lawyer = $(this).parents(".modal-content").find("#lawyer_editNameTextBox").val();
        var Phone = $(this).parents(".modal-content").find("#lawyer_editPhoneTextBox").val();
        var Email = $(this).parents(".modal-content").find("#lawyer_editEmailBox").val();
        var Website = $(this).parents(".modal-content").find("#lawyer_editWebsiteBox").val();
        var postData = {
            id: id,
            Lawyer: Lawyer,
            Phone:Phone,
            Email:Email,
            Website:Website
        };
        $.ajax({
            url: baseUrl + "admin/manage_lawyers/update",
            data: postData,
            type: "POST",
            success: function (output) {
                var data = output.trim().split("::");
                if (data[0] === "OK") {
                    $("#editLawyersModal").modal('hide');
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


/*--------LOGO JOB---------*/
//    When Modal is Opened
    $(".logo-edit-modal").on("shown.bs.modal", function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var ID = button.parents("tr").attr("data-id");
        var name = button.parents("tr").find('td').eq(1).text();
        var src = button.attr('src');
        var modal = $(this);
        modal.find("input#hiddenUserID").val(ID);
        modal.find("img#logo-show").attr('src', src);
        modal.find(".modal-body").find('p > strong').text(' "' + name + '"');
    });
//    When New Logo is Selected
    $("#update-logo-file").change(function(){
        readURL(this,'#logo-show');
    });

    //Function for Rendering Image
    function readURL(input,selector) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                console.log('im exec');
                $(selector).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }



    //Finally Update the logo when Update btn is pressed
    $("#updateLogo").on("click", function () {
        var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
        var input = $(this).parents(".modal-content").find("#update-logo-file")[0];
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var formData = new FormData();
                formData.append('logo', input.files[0]);
                formData.append('id', hiddenModalID);
                $.ajax({
                    crossOrigin: true,
                    type: 'POST',
                    url: baseUrl + "admin/manage_lawyers/updateLogo",
                    data: formData,
                    processData: false,
                    contentType: false
                }).done(function (response) {
                    var data = response.trim().split("::");
                    if (data[0] == 'OK') {
                        $(".logo-edit-modal").modal('hide');
                        oTable.fnDraw();
                    }
                    if(data[3]){
                        Haider.notification(data[1],data[2],data[3]);
                    }else{
                        Haider.notification(data[1],data[2]);
                    }
                });

            };
            reader.readAsDataURL(input.files[0]);
        }
    });


    $("#updateLogo").on("click", function () {
        var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
        var input = $(this).parents(".modal-content").find("#update-logo-file")[0];
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                var formData = new FormData();
                        formData.append('logo', input.files[0]);
                        formData.append('id', hiddenModalID);
                        $.ajax({
                                crossOrigin: true,
                                type: 'POST',
                                url: baseUrl + "admin/manage_lawyers/updateLogo",
                                data: formData,
                                processData: false,
                                contentType: false
                        }).done(function (response) {
                            var data = response.split("::");
                            $(".logo-edit-modal").modal('hide');
                            /*if (data[0] == 'OK') {
                                $(".logo-edit-modal").modal('hide');
                                console.log('hide :'+response);
                                oTable.draw();
                            }
                            console.log('modal :'+response);*/
                       });

                     };
                reader.readAsDataURL(input.files[0]);
            }

    });
});//End of Document Ready Function.
