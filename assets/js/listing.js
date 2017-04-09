jQuery(document).ready(function($) {
    if($("select").length > 0){
        $("select").select2();
    }
    if($(".date_picker").length > 0){
        $('.date_picker').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    }
});
$(function(){
    
	if($("textarea").length > 0){
	  	tinymce.init({
			  selector: 'textarea',
			  height: 200,
			  menubar: false,
			  browser_spellcheck : true,
			  contextmenu: false,
			  spellchecker_rpc_url: base_url+'assets/tinymce/js/tinymce/plugins/spellchecker/spellchecker.php',
			  plugins: [
			    ' spellchecker advlist autolink lists link image charmap print preview anchor code',
			    'searchreplace visualblocks code fullscreen',
			    'insertdatetime media jbimages table contextmenu paste code'
			  ],
			  toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | jbimages | media | code',
			  content_css: '//www.tinymce.com/css/codepen.min.css',
			  relative_urls: false
		});
	}

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
            url: baseUrl + "admin/"+ControllerRouteManage+"/trash",
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
            url: baseUrl + "admin/"+ControllerRouteManage+"/trash",
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
            url: baseUrl + "admin/"+ControllerRouteManage+"/delete",
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
        modal.find(".modal-body").find('p > strong').text(' "' + name + '"');
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

    $(".publish-modal").on("shown.bs.modal", function (e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var ID = button.parents("tr").attr("data-id");
        var esicName = button.parents("tr").find(".esicName").text();
        var currentPublishStatusID = button.parents("tr").find(".Publish-Status").attr("data-PublishStatusID");
        var modal = $(this);
        modal.find("input#hiddenUserID").val(ID);
        var publishText = 'Publish';
        if(currentPublishStatusID == 1){
            publishText = 'UnPublish';
        }
        $("#publishStatusID").val(currentPublishStatusID);
        $("#EsicNameTextBox").text(esicName);
        $("#publishStatusTextBox").text(publishText);
    });

//    When New Logo is Selected
    $("#update-logo-file").change(function(){
        readURL(this,'#logo-show');
    });
    $("#update-image-file").change(function(){
        readURL(this,'#image-show');
    });
    $("#product-file").change(function(){
        readURL(this,'#product-show');
    });
    $("#banner-file").change(function(){
        readURL(this,'#banner-show');
    });
    $("#Logo-file").change(function(){
        readURL(this,'#Logo-show');
    });

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
                    url: baseUrl + "admin/"+ControllerRouteManage+"/updateLogo",
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
                    url: baseUrl + "admin/"+ControllerRouteManage+"/updateImage",
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


    $("#yesPublish").on("click", function () {
        var hiddenModalUserID   = $(this).parents(".modal-content").find("#hiddenUserID").val();
        var publishStatusID  = $(this).parents(".modal-content").find("#publishStatusID").val();
        if (hiddenModalUserID == '') {
            hiddenModalUserID = $(this).attr('data-id');
        }
         var actionToPerform = "publish";
        if(publishStatusID == 1){
            actionToPerform = "unpublish";
        }
        var postData = {
            id: hiddenModalUserID, 
            actionPerform: actionToPerform, 
            currentValue: publishStatusID
        };
        $.ajax({
            url: baseUrl + "admin/"+ControllerRouteManage+"/PublishAction",
            data: postData,
            type: "POST",
            success: function (output) {
                var data = output.split("::");
                if (data[0] == 'OK') {
                    oTable.fnDraw();
                    $('.publish-modal').modal('hide');
                }
                if(data[3]){
                    Haider.notification(data[1],data[2],data[3]);
                }else{
                    Haider.notification(data[1],data[2]);
                }
            }
        });
    });

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