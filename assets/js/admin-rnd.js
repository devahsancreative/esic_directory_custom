 $(function () {
            oTable = "";
            var regTableSelector = $("#RnDList");
            var url_DT = baseUrl + "admin/manage_rd/listing";
            var aoColumns_DT = [
                /* ID */ {
                    "mData": "ID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                },
                /* name */ {
                    "mData": "rndname"
                },
                /* IDNumber */ {
                    "mData": "IDNumber"
                },
                /* AddressContact */ {
                    "mData": "AddressContact"
                },
                /* ANZSRC */ {
                    "mData": "ANZSRC"
                },
                {
                //"bSortable": false, 
                "mData": "Logo",
                //"sTitle": "Actions", 
                //"bSearchable": false, 
                    "render": function ( data, type, row ) {
                      if(data){
                            return '<img data-target=".logo-edit-modal" data-toggle="modal" alt="Edit" src="'+baseUrl+data+'" class="rnd-logo" style="height:50px;width:50px;cursor:pointer;" />';
                       }
                    return '<span data-target=".logo-edit-modal" data-toggle="modal" class="rnd-logo">Empty </span>';
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
			  oTable = $('#RnDList').DataTable();  // // Search by Title
              $('#Name').keyup(function(){
			  oTable.column(1).search($(this).val()).draw() ;
			 })
			  oTable = $('#RnDList').DataTable();  //// Search by Author
			 $('#IDNumber').keyup(function(){
			  oTable.column(2).search($(this).val()).draw() ;
			 })
			 oTable = $('#RnDList').DataTable();  ////Search by Tags    
             $('#Address').keyup(function(){
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
            
            $("#editRndModal").on("shown.bs.modal", function (e) {
                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var name = button.parents("tr").find('td').eq(1).text();
                var idNumber = button.parents("tr").find('td').eq(2).text();
                var addressContact = button.parents("tr").find('td').eq(3).text();
                var anzsrc = button.parents("tr").find('td').eq(4).text();
                var modal = $(this);
                modal.find("input#hiddenRndID").val(ID);
                modal.find("input#editrndTextBox").val(name);
                modal.find("input#editrndTextBoxIdNumber").val(idNumber);
                modal.find("input#editrndTextBoxAddressContact").val(addressContact);
                modal.find("input#editrndTextBoxAnzsrc").val(anzsrc);
            });


            $("#yesApprove").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "trash"};
                $.ajax({
                    url: baseUrl + "admin/manage_rd/trash",
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
                var postData = {id: hiddenModalID, value: "delete"};
                $.ajax({
                    url: baseUrl + "admin/manage_rd/delete",
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
                    url: baseUrl + "admin/manage_rd/trash",
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

            $('body').on("click",'.rnd-logo', function (event) {
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
                                url: baseUrl + "admin/manage_rd/updateLogo",
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
                    url: baseUrl + "admin/manage_rd/permanent",
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
                    url: baseUrl + "admin/manage_rd/permanent",
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

            $("#updateRnDBtn").on("click", function () {
                var id = $(this).parents(".modal-content").find("#hiddenRndID").val();
                var name = $(this).parents(".modal-content").find("#editrndTextBox").val();
                var idNumber = $(this).parents(".modal-content").find("#editrndTextBoxIdNumber").val();
                var addressContact = $(this).parents(".modal-content").find("#editrndTextBoxAddressContact").val();
                var anzsrc = $(this).parents(".modal-content").find("#editrndTextBoxAnzsrc").val();
                var postData = {
                    id: id,
                    rndname: name,
                    IDNumber: idNumber,
                    AddressContact: addressContact,
                    ANZSRC: anzsrc
                };
                $.ajax({
                    url: baseUrl + "admin/manage_rd/update",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            $("#editRndModal").modal('hide');
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
                    url: baseUrl + "admin/manage_rd/abr",
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
             $("#addRnDBtn").on("click", function () {
                var Rnd = $(this).parents(".modal-content").find("#addRnDTextBox").val();
                var idNumber = $(this).parents(".modal-content").find("#addrndTextBoxIdNumber").val();
                var addressContact = $(this).parents(".modal-content").find("#addrndTextBoxAddressContact").val();
                var anzsrc = $(this).parents(".modal-content").find("#addrndTextBoxAnzsrc").val();
                var postData = {
                    Rnd: Rnd,
                    IDNumber: idNumber,
                    AddressContact: addressContact,
                    ANZSRC: anzsrc
                };
                $.ajax({
                    url: baseUrl + "admin/manage_rd/new",
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