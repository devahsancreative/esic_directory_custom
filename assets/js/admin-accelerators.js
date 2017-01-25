      $(function () {
            oTable = "";
            var regTableSelector = $("#acceleratorsList");
            var url_DT = baseUrl + "admin/manage_accelerators/listing";
            var aoColumns_DT = [
                /* ID */ {
                    "mData": "ID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                },
                /* name */ {
                    "mData": "Name"
                },
				/* address */ {
                    "mData": "Address"
                },
                /* website */ {
                    "mData": "Website"
                },
                /* Logo  {
                    "mData": "Logo"
                },*/
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
                {
                    "mData": "ABR"
                },
                /* Permanent */ {
                    "mData": "Permanent"
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

            //Code for search box
            $("#search-input").on("keyup", function (e) {
                oTable.fnFilter($(this).val());
            });
			 oTable = $('#acceleratorsList').DataTable();  // // Search by Title
			 $('#Search_Name').keyup(function(){
			  oTable.column(1).search($(this).val()).draw() ;
			 })
			  oTable = $('#acceleratorsList').DataTable();  //// Search by Author
			 $('#Search_Address').keyup(function(){
			  oTable.column(2).search($(this).val()).draw() ;
			 })
			  oTable = $('#acceleratorsList').DataTable();  ////Search by Tags    
			 $('#Search_Website').keyup(function(){
			  oTable.column(3).search($(this).val()).draw() ;
			 })

            $(".approval-modal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var name = button.parents("tr").find('td').eq(1).text();
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find(".modal-body").find('p > strong').text(' "' + name + '"');
            });

            $("#editAccelerationModal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var name = button.parents("tr").find('td').eq(1).text();
                var web = button.parents("tr").find('td').eq(2).text();
                var modal = $(this);
                modal.find("input#hiddenAccelerationID").val(ID);
                modal.find("input#editAccelerationTextBox").val(name);
                modal.find("input#editAccelerationTextBoxWeb").val(web);
            });

            $("#yesApprove").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "trash"};
                $.ajax({
                    url: baseUrl + "admin/manage_accelerators/trash",
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

            $("#permanentDelete").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "permanentDelete" };
                $.ajax({
                    url: baseUrl + "admin/manage_accelerators/delete",
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
                    url: baseUrl + "admin/manage_accelerators/trash",
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
                                url: baseUrl + "admin/manage_accelerators/updateLogo",
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
                    url: baseUrl + "admin/manage_accelerators/permanent",
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
                    url: baseUrl + "admin/manage_accelerators/permanent",
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
                var id = $(this).parents(".modal-content").find("#hiddenAccelerationID").val();
                var name = $(this).parents(".modal-content").find("#editAccelerationTextBox").val();
                var web = $(this).parents(".modal-content").find("#editAccelerationTextBoxWeb").val();
                var postData = {
                    id: id,
                    web: web,
                    name: name
                };
                $.ajax({
                    url: baseUrl + "admin/manage_accelerators/update",
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
                    url: baseUrl + "admin/manage_accelerators/abr",
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

            $("#addAccelerationBtn").on("click", function () {
                var Acceleration = $(this).parents(".modal-content").find("#addAccelerationTextBox").val();
                var postData = {
                    Acceleration: Acceleration
                };
                $.ajax({
                    url: baseUrl + "admin/manage_accelerators/new",
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