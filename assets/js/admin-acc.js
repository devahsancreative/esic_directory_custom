  $(function () {
            oTable = "";
            var regTableSelector = $("#acceleratorsList");
            var url_DT = baseUrl + "admin/manage_acc_commercials/listing";
            var aoColumns_DT = [
                /* ID */ {
                    "mData": "ID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                },
                /* Member */ {
                    "mData": "Member"
                },
				{
                    "mData": "Project_Location"
                },
                /* Web_Address */ {
                    "mData": "Web_Address"
                },
                {
                    "mData": "Project_Title"
                },
                {
                //"bSortable": false, 
                "mData": "Logo",
                //"sTitle": "Actions", 
                //"bSearchable": false, 
                    "render": function ( data, type, row ) {
                        if(data!=''){
                             return '<img data-target=".logo-edit-modal" data-toggle="modal" alt="Edit" src="'+baseUrl+data+'" class="acc-logo" style="height:50px;width:50px;cursor:pointer;" />';
                        }
                        return '<span data-target=".logo-edit-modal" data-toggle="modal" class="acc-logo">Empty </span>';
                    }
               // "mRender": function () { return '<img alt="Edit" src="Logo" title="Edit" style="height:18px;width:19px;cursor:pointer;" />'; }
                },
                /*
                 {
                 "mData" : "State_Territory"
                 },
                 {
                 "mData" : "Project_Location"
                 },
                 {
                 "mData" : "Project_Title"
                 },
                 {
                 "mData" : "Project_Summary"
                 },
                 {
                 "mData" : "Project_Success"
                 },
                 {
                 "mData" : "Market"
                 },
                 {
                 "mData" : "Technology"
                 },
                 {
                 "mData" : "Type"
                 },
                 */
                 {
                    "mData": "ABR"
                 },
                 /* Permanent */ {
                    "mData": "Permanent"
                },
                {
                    "mData": "Trashed"
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
			  oTable = $('#acceleratorsList').DataTable();  // // Search by Title
			 $('#member').keyup(function(){
			  oTable.column(1).search($(this).val()).draw() ;
			 })
			  oTable = $('#acceleratorsList').DataTable();  //// Search by Author
			 $('#Search_by_Address').keyup(function(){
			  oTable.column(2).search($(this).val()).draw() ;
			 })
			  oTable = $('#acceleratorsList').DataTable();  ////Search by Tags    
			 $('#Search_by_Pro').keyup(function(){
			  oTable.column(4).search($(this).val()).draw() ;
			 })

            $(".approval-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var Member = button.parents("tr").find('td').eq(1).text();
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find(".modal-body").find('p > strong').text(' "' + Member + '"');
            });

            $("#editAccelerationModal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var Member = button.parents("tr").find('td').eq(1).text();
                var IDNumber = button.parents("tr").find('td').eq(2).text();
                var ProjectTitle = button.parents("tr").find('td').eq(3).text();
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find("input#editAccelerationTextBox").val(Member);
                modal.find("input#editAccelerationWebTextBox").val(IDNumber);
                modal.find("input#editAccelerationPTTextBox").val(ProjectTitle);
            });


            $("#yesApprove").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "trash"};
                $.ajax({
                    url: baseUrl + "admin/manage_acc_commercials/trash",
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

             $("#nodelete").on("click", function () {
                var hiddenModalUserID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalUserID, value: "untrash"};
                $.ajax({
                    url: baseUrl + "admin/manage_acc_commercials/trash",
                    data: {
                        id: hiddenModalUserID,
                        value: "untrash"
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

            $("#permanent-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var name = button.parents("tr").find('td').eq(1).text();
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find(".modal-body").find('p > strong').text(' "' + name + '"');
            });

            $("#yesPermanent").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "Permanent"};
                $.ajax({
                    url: baseUrl + "admin/manage_acc_commercials/permanent",
                   data: {
                        id: hiddenModalID,
                        value: "Permanent"
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $('#permanent-modal').modal('hide');
                            oTable.draw();
                        }
                    }
                });
            });    

            $("#noPermanent").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "noPermanent"};
                $.ajax({
                    url: baseUrl + "admin/manage_acc_commercials/permanent",
                    data: {
                        id: hiddenModalID,
                        value: "noPermanent"
                    },
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            oTable.draw();
                            $('#permanent-modal').modal('hide');
                        }
                    }
                });
            });

            $("#updateAccelerationBtn").on("click", function () {
                var id = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var Member = $(this).parents(".modal-content").find("#editAccelerationTextBox").val();
                var webaddress = $(this).parents(".modal-content").find("#editAccelerationWebTextBox").val();
                var projecttitle = $(this).parents(".modal-content").find("#editAccelerationPTTextBox").val();
                var postData = {
                    id: id,
                    Member: Member,
                    webaddress:webaddress,
                    projecttitle:projecttitle
                };
                $.ajax({
                    url: baseUrl + "admin/manage_acc_commercials/update",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            $("#editAccelerationModal").modal('hide');
                            oTable.draw();
                        }
                    }
                });
            });
            $("#abr-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var selectValue = button.parents("tr").find('td').eq(1).text();
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find("#abr-modal select option").filter(function() {
                    return this.text == selectValue; 
                }).attr('selected', true);
            });
            $("#yesSaveAbr").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var value = $(this).parents(".modal-content").find("select").val();
                var postData = {id: hiddenModalID, value: value};
                $.ajax({
                    url: baseUrl + "admin/manage_acc_commercials/abr",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $("#abr-modal").modal('hide');
                            oTable.draw();
                        }
                    }
                });
            });
             $("#permanentDelete").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "permanentDelete" };
                $.ajax({
                    url: baseUrl + "admin/manage_acc_commercials/delete",
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

            $('body').on("click",'.acc-logo', function (event) {
                var currentImage = $(this);
                var imageSrc =  currentImage.attr('src');
                console.log(imageSrc);

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
                                url: baseUrl + "admin/manage_acc_commercials/updateLogo",
                                data: formData,
                                processData: false,
                                contentType: false
                        }).done(function (response) {
                            var data = response.split("::");
                            if (data[0] == 'OK') {
                                $(".logo-edit-modal").modal('hide');
                                oTable.draw();
                            }
                       });
                    
                     };
                    reader.readAsDataURL(input.files[0]);
                }
            });
             $("#addAccelerationBtn").on("click", function () {
                var Acceleration = $(this).parents(".modal-content").find("#addAccelerationTextBox").val();
                var webaddress = $(this).parents(".modal-content").find("#addAccelerationWebTextBox").val();
                var projecttitle = $(this).parents(".modal-content").find("#addAccelerationPTTextBox").val();
                var postData = {
                    Acceleration: Acceleration,
                    webaddress:webaddress,
                    projecttitle:projecttitle
                };
                $.ajax({
                    url: baseUrl + "admin/manage_acc_commercials/new",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            $(".addNewModal").modal('hide');
                            oTable.draw();
                        }
                    }
                });
            });
        });