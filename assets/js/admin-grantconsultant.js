$(function(){
if($("body").find("#GrantConsultantList")){
    oTable = "";
    var regTableSelector = $("#GrantConsultantList");

    var url_DT = baseUrl + "admin/manage_grantconsultant/listing";
    var aoColumns_DT = [
        /* ID */ {
            "mData": "ID",
            "bVisible": true,
            "bSortable": true,
            "bSearchable": true
        },
        /* Name */ {
            "mData": "Name"
        },
        // Phone or Cell
        {
            "mData": "Phone"
        },
        // Email Address
        {
            "mData": "Email"
        },
        // Website Address
        {
            "mData": "Website"
        },
        // Logo or Avatar
        {
            "mData": "Logo",
            "render": function ( data, type, row ) {
                if(data!=''){
                    return '<img data-target=".logo-edit-modal" data-toggle="modal" alt="Edit" src="'+srcImage(data,this)+'" class="GrantConsultant-logo" style="height:50px;width:50px;cursor:pointer;" />';
                }
                return '<span data-target=".logo-edit-modal" data-toggle="modal" class="GrantConsultantList-logo">Empty </span>';
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

    /*new $.fn.dataTable.Responsive(oTable, {
        details: true
    });
    removeWidth(oTable);*/

    sTable = $('#GrantConsultantList').DataTable();  // // Search by Title
    $("#search-input").on("keyup", function (e) {
        sTable.fnFilter($(this).val());
    });
    $('#searchbyName').keyup(function(){
       sTable.column(1).search($(this).val()).draw() ;
    }); 
}
function srcImage(dbData,elem) {
    var defaultImage = baseUrl+"assets/img/lawyer.png";
    if(!dbData){
        return defaultImage
    }
    var imagePath = baseUrl+'/'+dbData;

    var http = new XMLHttpRequest();
    http.open('HEAD', imagePath, false);
    http.send();

    if(http.status!=404){
        return imagePath;
    }else{
        return defaultImage;
    }
}



//Now Moving to the CRUD Operations
//Function for Adding New Record to the Database.
$("#addBtn").on("click", function () {
    var modal = $(this).parents(".addNewModal");
    var modalData = modal.find(".modal-content");
    //Getting the Records First
    var Name        = modalData.find("#NameTextBox").val();
    var Phone       = modalData.find("#PhoneTextBox").val();
    var Email       = modalData.find("#EmailBox").val();
    var Website     = modalData.find("#WebsiteBox").val();
    var Address     = modalData.find("#AddressBox").val();
    var ShortDescription    = modalData.find("#ShortDescriptionBox").val();
    var LongDescription     = modalData.find("#LongDescriptionBox").val();
    var Keywords     = modalData.find("#KeywordsBox").val();

    var postData = {
        Name:Name,
        Phone:Phone,
        Email:Email,
        Website:Website,
        Address:Address,
        ShortDescription:ShortDescription,
        LongDescription:LongDescription,
        Keywords:Keywords
    };
    $.ajax({
        url:  baseUrl + "admin/manage_grantconsultant/new",
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
                oTable.fnDraw();
            }
        }
    });
});


//Functions for Approving the Trash through Modal
//When Approval Modal Shows Up
$(".approval-modal").on("shown.bs.modal", function (e) {
    var button = $(e.relatedTarget); // Button that triggered the modal
    var ID = button.parents("tr").attr("data-id");
    var Name = button.parents("tr").find('td').eq(1).text();
    var modal = $(this);
    var Message = 'Are you sure you want to trash record of: <strong>'+Name+'</strong>';
    modal.find("input#hiddenUserID").val(ID);
    modal.find(".modal-body").find('p').html(Message);
    modal.find('.modal-header').find('h4').html('Trash <strong>'+Name+'</strong>');
});
//When Yes has been Selected on Approval Modal, Just Trash the Selected Data.
$("#yesApprove").on("click", function () {
    var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
    var postData = {id: hiddenModalID, value: "trash"};
    $.ajax({
        url: baseUrl + "admin/manage_grantconsultant/trash",
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
            url: baseUrl + "admin/manage_grantconsultant/trash",
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

    $("#permanentDelete").on("click", function () {
        var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
        var postData = {id: hiddenModalUserID, value: "delete"};
        $.ajax({
            url: baseUrl + "admin/manage_grantconsultant/delete",
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


    /*Now for Edit Modal */
    //On Modal Load
    $("#editModal").on("shown.bs.modal", function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var ID = button.parents("tr").attr("data-id");
        var Name = button.parents("tr").find('td').eq(1).text();
        var Phone = button.parents("tr").find('td').eq(2).text();
        var Email = button.parents("tr").find('td').eq(3).text();
        var Website = button.parents("tr").find('td').eq(4).text();
        var modal = $(this);
        //Populating the Inputs
        modal.find("input#hiddenID").val(ID);
        modal.find("input#editNameTextBox").val(Name);
        modal.find("input#editPhoneTextBox").val(Phone);
        modal.find("input#editEmailBox").val(Email);
        modal.find("input#editWebsiteBox").val(Website);
    });

    //On Edit Modal If Update has been clicked, Update the Record.
    $("#updateBtn").on("click", function () {
        var id          = $(this).parents(".modal-content").find("#hiddenID").val();
        var Name        = $(this).parents(".modal-content").find("#editNameTextBox").val();
        var Phone       = $(this).parents(".modal-content").find("#editPhoneTextBox").val();
        var Email       = $(this).parents(".modal-content").find("#editEmailBox").val();
        var Website     = $(this).parents(".modal-content").find("#editWebsiteBox").val();
        var postData    = {
            id: id,
            Name: Name,
            Phone:Phone,
            Email:Email,
            Website:Website
        };
        $.ajax({
            url: baseUrl + "admin/manage_grantconsultant/update",
            data: postData,
            type: "POST",
            success: function (output) {
                var data = output.trim().split("::");
                if (data[0] === "OK") {
                    $("#editModal").modal('hide');
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
        var button  = $(e.relatedTarget); // Button that triggered the modal
        var ID      = button.parents("tr").attr("data-id");
        var name    = button.parents("tr").find('td').eq(1).text();
        var src     = button.attr('src');
        var modal   = $(this);
        modal.find("input#hiddenUserID").val(ID);
        modal.find("img#logo-show").attr('src', src);
        modal.find(".modal-body").find('p > strong').text(' "' + type + '"');
    });

    $(".image-edit-modal").on("shown.bs.modal", function (e) {
        var button  = $(e.relatedTarget);
        var ID      = $("#hiddenListID").val();
        var type    = button.attr('data-type');
        var src     = button.attr('src');
        var modal   = $(this);
        modal.find("input#hiddenID").val(ID);
        modal.find("img#image-show").attr('src', src);
        modal.find(".modal-header").find('h4 > spane').text(' "' + type + '"');
        modal.find(".modal-footer").find('#updateImage').attr('data-type',type);
    });


//    When New Logo is Selected
    $("#update-logo-file").change(function(){
        readURL(this,'#logo-show');
    });
    $("#update-image-file").change(function(){
        readURL(this,'#image-show');
    });

    $("#banner-file").change(function(){
        readURL(this,'#banner-show');
    });
    $("#Logo-file").change(function(){
        readURL(this,'#Logo-show');
    });

    //Function for Rendering Image
    function readURL(input,selector) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
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
                    url: baseUrl + "admin/manage_grantconsultant/updateLogo",
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


    $("#updateImage").on("click", function () {
        var hiddenModalID   = $(this).parents(".modal-content").find("#hiddenID").val();
        var hiddenTypeImage = $(this).parents(".modal-content").find("#hiddenTypeImage").val();
        var input = $(this).parents(".modal-content").find("#update-image-file")[0];
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var formData = new FormData();
                formData.append('image', input.files[0]);
                formData.append('id', hiddenModalID);
                formData.append('type', hiddenTypeImage);
                $.ajax({
                    crossOrigin: true,
                    type: 'POST',
                    url: baseUrl + "admin/manage_grantconsultant/updateImage",
                    data: formData,
                    processData: false,
                    contentType: false
                }).done(function (response) {
                    var data = response.trim().split("::");
                    if (data[0] == 'OK') {
                        $(".image-edit-modal").modal('hide');
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
    });//End of Document Ready Function.