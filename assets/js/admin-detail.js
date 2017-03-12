$(function(){
            //Some Action To Perform When Modal Is Shown.
            $(".approval-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.attr("data-id");
                var modal = $(this);
                console.log('ID = '+ID);
                modal.find("input#hiddenUserID").val(ID);
                modal.find("#saveStatus").attr('data-id',ID);
                
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
                            $('.approval-modal').modal('hide');
                        }
                    }
                });
            });

            $("body").on("click", ".save-desc", function (e) {
                e.preventDefault();
                var userId = $(this).attr('data-user-id');
                var textArea = tinyMCE.get('desc-textarea').getContent();
                var ansDiv = $('.edit-desc');
                var saveBtn = $('#save-desc');
                var descText = $('#desc-text pre');
                var descDataText = $.trim(textArea);
                var postData = {
                    userID: userId,
                    descDataText: descDataText
                };
                saveBtn.parent().remove();
                $.ajax({
                    url: baseUrl + "admin/savedesc",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            descText.html(data[1]);
                            ansDiv.hide();
                            $('#desc-edit').show();
                            descText.show();
                        }
                    }
                });

            });
            $("body").on("click", ".save-short-desc", function (e) {
                e.preventDefault();
                var userId = $(this).attr('data-user-id');
                var textArea = tinyMCE.get('short-desc-textarea').getContent();
                var ansDiv = $('.edit-short-desc');
                var saveBtn = $('#save-short-desc');
                var descText = $('#short-desc-text pre');
                var descDataText = $.trim(textArea);
                var postData = {
                    userID: userId,
                    descDataText: descDataText
                };
                saveBtn.parent().remove();
                $.ajax({
                    url: baseUrl + "admin/saveshortdesc",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            descText.html(data[1]);
                            ansDiv.hide();
                            $('#short-desc-edit').show();
                            descText.show();
                        }
                    }
                });

            });

            $('#showExpDate').on("click",function(){
                var expDateEye = $(this);
                var userId = $(this).parents('#profile-box-container').attr('data-user-id');
                var currentStatus = expDateEye.attr('data-value');
                var update = 'hide';
                if(currentStatus !== 'show'){
                    update = 'show';
                }

                $.ajax({
                    url:baseUrl + "admin/showExpDate",
                    data:{expDate:update,userID:userId},
                    type:'POST',
                    success:function(output){
                        var data = output.split("::");
                        if(data[0] === 'OK'){
                            if(update=='show'){
                                expDateEye.removeClass('fa-eye-slash');
                                expDateEye.addClass('fa-eye');
                                expDateEye.attr('data-value','show');
                                //Changing Colors
                                expDateEye.removeClass('text-warning');
                                expDateEye.addClass('text-success');
                            }else{
                                expDateEye.removeClass('fa-eye');
                                expDateEye.addClass('fa-eye-slash');
                                expDateEye.attr('data-value','hide');
                                //Changing Colors
                                expDateEye.removeClass('text-success');
                                expDateEye.addClass('text-warning');

                            }

                        }
                    }
                })
            });

            $(".publish-modal").on("shown.bs.modal", function (e) {
                 var button = $(e.relatedTarget); // Button that triggered the modal
                 var ID = $('#profile-box-container').attr('data-user-id');
                 if (ID == '') {
                        ID = button.attr('data-id');
                 }
                 var modal = $(this);
                 modal.find("input#hiddenUserID").val(ID);
            });

             $("body").on("click","#yesPublish", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalUserID, value: "publish"};
                $.ajax({
                    url: baseUrl + "admin/assessment_list",
                    data: {
                        id: hiddenModalUserID,
                        value: "publish"
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $('.publish-modal').modal('hide');
                            $('.publish-buttons').html('');
                            $('.publish-buttons').append('<a href="#" data-target=".unpublish-modal" data-toggle="modal" class="btn-primary" data-id="'+id+'">Published</a>');
                        }
                    }
                });
            });

            $(".unpublish-modal").on("shown.bs.modal", function (e) {
                 var button = $(e.relatedTarget); // Button that triggered the modal
                 var ID = $('#profile-box-container').attr('data-user-id');
                 if (ID == '') {
                        ID = button.attr('data-id');
                 }
                 var modal = $(this);
                 modal.find("input#hiddenUserID").val(ID);
            });

            $("body").on("click","#yesUnPublish", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalUserID, value: "unpublish"};
                $.ajax({
                    url: baseUrl + "admin/assessment_list",
                    data: {
                        id: hiddenModalUserID,
                        value: "unpublish"
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $('.unpublish-modal').modal('hide');
                            $('.publish-buttons').html('');
                            $('.publish-buttons').append('<a href="#" data-target=".publish-modal" data-toggle="modal" class="btn btn-warning" data-id="'+id+'">UnPublished</a>');
                        }
                    }
                });
            });
            $(".delete-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = $('#profile-box-container').attr('data-user-id');
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
            });

            $("#yesDelete").on("click", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalUserID, value: "delete"};
                $.ajax({
                    url: baseUrl + "admin/assessment_list",
                    data: {
                        id: hiddenModalUserID,
                        value: "delete"
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $('.delete-modal').modal('hide');
                             window.location = baseUrl + 'admin/assessments_list';
                        }
                    }
                });
            });

            $("body").on("click", ".save-answer", function (e) {

                e.preventDefault();
                var id = $(this).attr('data-id');
                var Answervalue = $('.' + id + ' select.answer-solution').val();
                var SpAnswervalue = $('.' + id + ' .edit-category.sp-question select').val();
                var tableName = $('.' + id + ' .edit-category.sp-question').attr('data-tablename');
                var tableUpdateID = $('.' + id + ' .edit-category.sp-question').attr('data-tableUpdateID');
                var ansDiv = $('.' + id + ' .edit-question');
                var dataQuestionId = $(this).attr('data-question-id');
                var userID = $('#profile-box-container').attr('data-user-id');
                var answerDiv = $('.' + id + ' .answer-solution');
                var scoreDiv = $('.' + id + ' .question-points');
                var barDiv = $('.progress .question-bar span');
                var oldScore = scoreDiv.attr('data-score');

                var postData = {
                    id: id,
                    userID: userID,
                    dataQuestionId: dataQuestionId,
                    Answervalue: Answervalue,
                    SpAnswervalue: SpAnswervalue,
                    tableName: tableName,
                    tableUpdateID:tableUpdateID,
                    oldScore: oldScore
                };
                $.ajax({
                    url: baseUrl + "admin/saveanswer",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            ansDiv.hide();
                            answerDiv.text(Answervalue);
                            scoreDiv.text(data[1]);
                            barDiv.text(data[2]);
                            barDiv.parent().css('width', data[2] + '%');
                        }
                    }
                });
            });

            $(".question-edit").on("click", function (event) {
                event.preventDefault();
                var id = $(this).attr('data-id');
                var select = $('.' + id + ' select.answer-solution');
                var ansDiv = $('.' + id + ' .edit-question');
                var dataQuestionId = $(this).attr('data-question-id');
                var saveBtn = $('.' + id + ' .save-answer');


                var postData = {
                    id: id,
                    dataQuestionId: dataQuestionId
                };
                saveBtn.parent().remove();
                $.ajax({
                    url: baseUrl + "admin/getanswers",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = $.parseJSON(output);
                        select.html('');
                        $.each(data, function (index, value) {
                            select.append('<option value="' + value.solution + '">' + value.solution + '</option>');
                        });
                        select.parent().append('<div class="question-action-buttons"><button class="save-answer" data-question-id="' + dataQuestionId + '" data-id="' + id + '">Save</button></div>');
                        ansDiv.show();
                    }
                });
            });
/*
     $("#desc-edit").on("click", function (event) {
     event.preventDefault();
     var userId = $(this).attr('data-user-id');
     var textArea = $('#desc-textarea');
     var ansDiv = $('.edit-desc');
     var saveBtn = $('#save-desc');
     var descText = $('#desc-text pre');
     ansDiv.show();
     descText.hide();
     var descDataText = descText.text();
     descText.text('');
     textArea.val($.trim(descDataText));
     ansDiv.children('.form-group').append('<div class="question-action-buttons"><button id="save-desc" data-user-id="'+userId+'" class="save-desc">Save</button></div>');
     $(this).hide();
     }); */


    //Haider COde
            $("#desc-edit").on("click", function (event) {

                event.preventDefault();
                tinymce.init({
                    selector: "body div.st-text-block",
                    theme: "modern",
                    menubar: false,
                    plugins: [
                        ["advlist autolink link image lists charmap preview hr anchor pagebreak spellchecker"],
                        ["searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking"],
                        ["save table contextmenu directionality emoticons template paste"]
                    ],

                    add_unload_trigger: false,
                    schema: "html5",
                    inline: true,
                    spellchecker_rpc_url: base_url+'spellchecker.php',
                    toolbar: "spellchecker | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media| table",
                    statusbar: false
                });
                //console.log(base_url+'spellchecker.php');
            });


    //End Haider Code


       $(document).on("click","#short-desc-edit", function (event) {


        event.preventDefault();
        var userId = $(this).attr('data-user-id');
        var textArea = $('#short-desc-textarea');
        var ansDiv = $('.edit-short-desc');
        var saveBtn = $('#save-short-desc');
        var descText = $('#short-desc-text pre');
        ansDiv.show();
        descText.hide();
        var descDataText = descText.text();
        descText.text('');
        textArea.val($.trim(descDataText));
        ansDiv.children('.form-group').append('<div class="question-action-buttons"><button id="save-short-desc" data-user-id="'+userId+'" class="save-short-desc">Save</button></div>');
        $(this).hide();


      });
            $("body").on("click", ".date-edit", function (e) {
                e.preventDefault();
                var userId = $('#profile-box-container').attr('data-user-id');
                var dateType = $(this).attr('data-date-type');
                var dateValue = $(this).attr('data-date-value');
                // DateEditModal
                
              
            });

            $('.DateEditModal').on('shown.bs.modal',function(e){
                var relatedPencil = e.relatedTarget;
                var userId = $('#profile-box-container').attr('data-user-id');
                var dateType = $(relatedPencil).attr('data-date-type');
                var dateTitle = $(relatedPencil).attr('data-date-title');
                var dateValue = $(relatedPencil).attr('data-date-value');
                $(this).find('#myModalLabel').text(dateTitle);
                $(this).find('#dateType').val(dateType);
                $(this).find('#edit_date').val(dateValue);
                //$('#edit_date').datepicker("setDate", new Date(dateValue));

            });
            $("body").on("click", "#saveDate", function (e) {
                e.preventDefault();
                var EditedDate = $(this).parents('.modal-content').find('#edit_date').val();
                var dateType = $(this).parents('.modal-content').find('#dateType').val();
                var userId = $('#profile-box-container').attr('data-user-id');
                var postData = {
                    userID: userId,
                    dateType: dateType,
                    EditedDate: EditedDate
                };
                $.ajax({
                    url: baseUrl + "admin/savedate",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
                             location.reload();
                        }
                    }
                });
              
            }); 
            $("body").on("click", "#full-edit", function (e) {
                e.preventDefault();
               $('.profile-username').hide();
               $('.editable.fullname').show();
               $('.editable.fullname input').focus();
              
            });
            $( ".fullname" ).focusout(function() {
               var userId = $('#profile-box-container').attr('data-user-id');
               $('.profile-username').show();
               $('.editable.fullname').hide();
               var NewFullName = $('.editable.fullname input').val();
                var postData = {
                    userID: userId,
                    fullName: NewFullName
                };
                $.ajax({
                    url: baseUrl + "admin/updatename",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
                           $('.profile-username b').text(NewFullName);
                        }
                    }
                });
            });
            $("body").on("click", "#web-edit", function (e) {
                e.preventDefault();
               $('.website-text').hide();
               $('.editable.website').show()
               $('#web-edit').hide();
               $('.editable.website input').focus();
              
            });
            $( "#web-input" ).focusout(function() {
               var userId = $('#profile-box-container').attr('data-user-id');
               $('.website-text').show();
               $('#web-edit').show();
               $('.editable.website').hide();
               var website = $('.editable.website input').val();
                var postData = {
                    userID: userId,
                    website: website
                };
                $.ajax({
                    url: baseUrl + "admin/updatewebsite",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
                           $('.website-text').text(website);
                           $('.website-text').attr('href','http://'+website);
                        }
                    }
                });
            });          
            $("body").on("click", "#company-edit", function (e) {
                e.preventDefault();
               $('.company-text').hide();
               $('.editable.company').show()
               $('.editable.company input').focus();
              
            });
            $("#company-input").focusout(function() {
               var userId = $('#profile-box-container').attr('data-user-id');
               $('.company-text').show();
               $('.editable.company').hide();
               var company = $('.editable.company input').val();
                var postData = {
                    userID: userId,
                    company: company
                };
                $.ajax({
                    url: baseUrl + "admin/updatecompany",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
                           $('.company-text p').text(company);
                        }
                    }
                });
            });
            $("body").on("click", "#email-edit", function (e) {
                e.preventDefault();
               $('.email-text').hide();
               $('.editable.email').show()
               $('.editable.email input').focus();
              
            });
            $("#email-input").focusout(function() {
               var userId = $('#profile-box-container').attr('data-user-id');
               $('.email-text').show();
               $('.editable.email').hide();
               var email = $('.editable.email input').val();
                var postData = {
                    userID: userId,
                    email: email
                };
                $.ajax({
                    url: baseUrl + "admin/updateemail",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
                           $('.email-text p').text(email);
                        }
                    }
                });
            });
            $("body").on("click", "#acn-edit", function (e) {
                e.preventDefault();
               $('.acn-text').hide();
               $('.editable.acn').show()
               $('.editable.acn input').focus();
              
            });
            $("#acn-input").focusout(function() {
               var userId = $('#profile-box-container').attr('data-user-id');
               $('.acn-text').show();
               $('.editable.acn').hide();
               var acn = $('.editable.acn input').val();
                var postData = {
                    userID: userId,
                    acn: acn
                };
                $.ajax({
                    url: baseUrl + "admin/updateacn",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
                           $('.acn-text p').text(acn);
                        }
                    }
                });
            });               
            $("body").on("click", "#ipAddress-edit", function (e) {
                e.preventDefault();
               $('.ipAddress-text').hide();
               $('.editable.ipAddress').show()
               $('.editable.ipAddress input').focus();
               var oldIpAddress = $(this).parents('.ipAddress-text').find('.text-muted').text();
                $('.editable.ipAddress input').val(oldIpAddress);
              
            });
            $("#ipAddress-input").focusout(function() {
               var userId = $('#profile-box-container').attr('data-user-id');
               $('.ipAddress-text').show();
               $('.editable.ipAddress').hide();
               var ipAddress = $('.editable.ipAddress input').val();
                var postData = {
                    userID: userId,
                    ipAddress: ipAddress
                };
                $.ajax({
                    url: baseUrl + "admin/updateip",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
                           $('.ipAddress-text p').text(ipAddress);
                        }
                    }
                });
            });
            $("body").on("click", "#address-edit", function (e) {
                e.preventDefault();
               $('.address-text').hide();
               $('.editable.address').show()
                var street = $('.address-text span.street').text();
                var town = $('.address-text span.town').text();
                var state =$('.address-text span.state').text();
                $('.editable.address #street-input').val(street);
                $('.editable.address #town-input').val(town);
                $('.editable.address #state-input').val(state);
              
            });
            $("body").on("click", "#address-save", function (e) {
               var userId = $('#profile-box-container').attr('data-user-id');
               $('.address-text').show();
               $('.editable.address').hide();
                var street_number =  $('.editable.address #street-number').val();
				var street_name   =  $('.editable.address #street-name').val();
                var town          =  $('.editable.address #town-input').val();
                var state         =  $('.editable.address #state-input').val();
				var post_input    =  $('.editable.address #post-input').val();
                var postData = {
                    userID       : userId,
                    street_number: street_number,
					street_name  : street_name,
                    town         : town,
                    state        : state,
					post_input   : post_input
                };
                $.ajax({
                    url: baseUrl + "admin/updateAddress",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
                           $('.address-text .street_number').text(street_number); 
						   $('.address-text .street_name').text(street_name);
                           $('.address-text .town').text(town);
                           $('.address-text .state').text(state);
						   $('.address-text .post_code').text(post_input);
                        }
                    }
                });
            });                        
            $("body").on("click", "#bsName-edit", function (e) {
                e.preventDefault();
               $('.bsName-text').hide();
               $('.editable.bsName').show()
               $('.editable.bsName input').focus();
              
            });
            $("#bsName-input").focusout(function() {
               var userId = $('#profile-box-container').attr('data-user-id');
               $('.bsName-text').show();
               $('.editable.bsName').hide();
               var bsName = $('.editable.bsName input').val();
                var postData = {
                    userID: userId,
                    bsName: bsName
                };
                $.ajax({
                    url: baseUrl + "admin/updatebsName",
                    data: postData,
                    type: "POST",
                    success: function(output) {
                       var data = output.split("::");
                       if(data[0] === "OK") {
                           $('.bsName-text p').text(bsName);
                        }
                    }
                });
            });

            $("body").on("click", ".save-sector", function (e) {
                e.preventDefault();
                var userId  = $('#profile-box-container').attr('data-user-id');
                var select  = $('.edit-sector select');
                var ansDiv  = $('.edit-sector');
                var answer  = $('.edit-sector select').val();
                var editText= $('.sector-text p');
                
                var postData = {
                    userID: userId,
                    answer: answer
                };
                $.ajax({
                    url: baseUrl + "admin/savesector",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            ansDiv.slideUp('slow');
                            var newanswer  = $(".edit-sector select option:selected").text();
                            editText.text(newanswer);

                        }
                    }
                });
            });
            $("#resetThumbsUp").on("click", function () {
                var userId  = $('#profile-box-container').attr('data-user-id');
                var postData = {
                    userID: userId
                };
                $.ajax({
                    url: baseUrl + "admin/resetThumbsUp",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                       var data = output.split("::");
                        if(data[0] === 'OK'){
                          $('.thumbsUp-container').find('p').text(0);                              
                        }
                    }
                });
            });
            $("#sector-edit").on("click", function (event) {
                event.preventDefault();
                var saveBtn = $('.save-sector');
                var userId  = $('#profile-box-container').attr('data-user-id');
                var select  = $('.edit-sector select');
                var ansDiv  = $('.edit-sector');
                var postData = {
                    userID: userId
                };
                saveBtn.parent().remove();
                $.ajax({
                    url: baseUrl + "admin/getsectors",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = $.parseJSON(output);
                        select.html('');
                        $.each(data, function (index, value) {
                            select.append('<option value="' + value.id + '">' + value.sector + '</option>');
                        });
                        select.parent().append('<div class="sector-action-buttons"><button class="save-sector">Save</button></div>');
                        ansDiv.slideDown('slow');
                    }
                });
            });                                        
                
            $('#edit-logo').change(function(event) {
                var input = $(this)[0];
                var userId  = $('#profile-box-container').attr('data-user-id');
                $('#loading-image-logo').show();
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var formData = new FormData();
                        formData.append('logo', input.files[0]);
                        formData.append('userID', userId);
                        $.ajax({       
                                crossOrigin: true,
                                type: 'POST',
                                url: baseUrl + "admin/savelogo",
                                data: formData,
                                processData: false,
                                contentType: false
                        }).done(function (response) {
                            var data = response.split("::");
                            if(data[0] === 'OK'){
                                $('#loading-image-logo').hide();
                                $('#User-Logo').attr('src', e.target.result);
                            }else if(data[0] === 'FAIL'){
                                $('#loading-image-logo').hide();
                            }
                       });
                    
                     };
                    reader.readAsDataURL(input.files[0]);
                }else{
                    $('#loading-image').hide();
                }
            });
            $('#edit-banner').change(function(event) {
                var input = $(this)[0];
                var userId  = $('#profile-box-container').attr('data-user-id');
                $('#loading-image-banner').show();
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var formData = new FormData();
                        formData.append('bannerImage', input.files[0]);
                        formData.append('userID', userId);
                        $.ajax({       
                                crossOrigin: true,
                                type: 'POST',
                                url: baseUrl + "admin/saveBannerImage",
                                data: formData,
                                processData: false,
                                contentType: false
                        }).done(function (response) {
                            var data = response.split("::");
                            if(data[0] === 'OK'){
                                $('#loading-image-banner').hide();
                                $('#User-banner').attr('src', e.target.result);
                            }else if(data[0] === 'FAIL'){
                                $('#loading-image-banner').hide();
                            }
                       });
                    
                     }
                    reader.readAsDataURL(input.files[0]);
                }else{
                    $('#loading-image').hide();
                }
            });
            $('#edit-product').change(function(event) {
                var input = $(this)[0];
                var userId  = $('#profile-box-container').attr('data-user-id');
                $('#loading-image-product').show();
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var formData = new FormData();
                        formData.append('productImage', input.files[0]);
                        formData.append('userID', userId);
                        $.ajax({       
                                crossOrigin: true,
                                type: 'POST',
                                url: baseUrl + "admin/saveProductImage",
                                data: formData,
                                processData: false,
                                contentType: false
                        }).done(function (response) {
                            var data = response.split("::");
                            if(data[0] === 'OK'){
                                $('#loading-image-product').hide();
                                $('#User-product').attr('src', e.target.result);
                            }else if(data[0] === 'FAIL'){
                                $('#loading-image-product').hide();
                            }
                       });
                    
                     }
                    reader.readAsDataURL(input.files[0]);
                }else{
                    $('#loading-image').hide();
                }
            });

            $("#edit_date").daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'DD-MM-YYYY',
                }
            });
        });

