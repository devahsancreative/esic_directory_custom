        $(function () {
            oTable = "";
            var regTableSelector = $("#statusList");
            var url_DT = baseUrl + "admin/manage_status/listing";
            var aoColumns_DT = [
                /* ID */ {
                    "mData": "ID",
                    "bVisible": true,
                    "bSortable": true,
                    "bSearchable": true
                },
                /* Status */ {
                    "mData": "Status"
					
                },
				  /* Status */ {
                    "mData": "Color"
					
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

            $(".approval-modal").on("shown.bs.modal", function (e) {

                var button = $(e.relatedTarget); // Button that triggered the modal
                var ID = button.parents("tr").attr("data-id");
                var Status = $.trim(button.parents("tr").find('td').eq(1).text());
                var modal = $(this);
                modal.find("input#hiddenUserID").val(ID);
                modal.find(".modal-body").find('p > strong').text(' "' + Status + '"');
            });

            $("#editStatusModal").on("shown.bs.modal", function (e) {
				var button = $(e.relatedTarget); // Button that triggered the modal
				var ID = button.parents("tr").attr("data-id");
				var Status = $.trim(button.parents("tr").find('td').eq(1).text());
				var Color  = $.trim(button.parents("tr").find('td').eq(2).text());
				var modal = $(this);
				modal.find("input#hiddenID").val(ID);
				modal.find("#editStatusBox").val(Status);
				modal.find("#updatecolor").val(Color);

            });

            $("#yesApprove").on("click", function () {
                var hiddenModalID = $(this).parents(".modal-content").find("#hiddenUserID").val();
                var postData = {id: hiddenModalID, value: "delete"};
                $.ajax({
                    url: baseUrl + "admin/manage_status/delete",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] == 'OK') {
                            $(".approval-modal").modal('hide');
                            oTable.fnDraw(false);
                        }
                    }
                });
            });

            $("#updateStatusBtn").on("click", function () {
                var id = $(this).parents(".modal-content").find("#hiddenID").val();
                var Status = $.trim($(this).parents(".modal-content").find("#editStatusBox").val());  
				var Color  = $("#dvupdatecolor").find("#updatecolor").val();
				var postData = {
                    id: id,
                    status: Status,
					color: Color
                };
                $.ajax({
                    url: baseUrl + "admin/manage_status/update",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            $("#editStatusModal").modal('hide');
                            oTable.fnDraw(false);
                        }
                    }
                });
            });
          
            $("#addStatusBtn").on("click", function () {
                var Status = $(this).parents(".modal-content").find("#addStatusTextBox").val();
				var Color  = $("#color").find("#add_button_color").val();
                var postData = {status:Status,color:Color};
				 $.ajax({
                    url: baseUrl + "admin/manage_status/new",
                    data: postData,
                    type: "POST",
                    success: function (output) {
                        var data = output.split("::");
                        if (data[0] === "OK") {
                            $(".addNewModal").modal('hide');
                            oTable.fnDraw(false);
                        }
                    }
                });
            });
        });