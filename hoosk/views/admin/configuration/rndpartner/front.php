
        <div class="row">
            <div class="col-md-12">
                <form action="<?= base_url().$ControllerRouteName.'/New';?>" method="post" class="form" enctype="multipart/form-data">
                    <div class="box">
                        <div class="box-header">
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <input type="hidden" id="hiddenListID" value="">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="IDNumberTextBox">ID Number:</label>
                                        <input type="text" name="IDNumber" id="IDNumberTextBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="NameTextBox">Name:</label>
                                        <input type="text" name="Name" id="NameTextBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="ANZSRCBox">ANZSRC</label>
                                        <input type="text" name="ANZSRC" id="ANZSRCBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="WebsiteBox">Website:</label>
                                        <input type="text" name="Website" id="WebsiteBox" class="form-control" />
                                    </div>
                                    <!--Address with multiple columns-->
                                    <div class="form-group">
                                        <label for="AddressBox">Address:</label>
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label for="address_streetNumber">Street Number</label>
                                                <input type="text" name="address_streetNumber" id="address_streetNumber" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="address_streetName">Street Name</label>
                                                <input type="text" name="address_streetName" id="address_streetName" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="address_town">Town</label>
                                                <input type="text" name="address_town" id="address_town" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-2">
                                                <label for="address_state">State</label>
                                                <input type="text" name="address_state" id="address_state" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-2">
                                                <label for="address_postCode">Post Code</label>
                                                <input type="text" name="address_postCode" id="address_postCode" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group"> 
                                        <label for="RndCredentialsSummaryBox">R&D Credentials Summary</label>
                                        <textarea type="text" name="RndCredentialsSummary" id="RndCredentialsSummaryBox" class="form-control"> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="ProgramNameBox">Program Name</label>
                                        <input type="text" name="ProgramName" id="ProgramNameBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="ProgramStartDateBox">Program Start Date</label>
                                        <input type="text" name="ProgramStartDate" id="ProgramStartDateBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="contactNameBox">Contact Name:</label>
                                        <input type="text" name="contactName" id="contactNameBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="PhoneTextBox">Contact Phone:</label>
                                        <input type="text" name="Phone" id="PhoneTextBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="EmailBox">Contact Email:</label>
                                        <input type="text" name="Email" id="EmailBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="roleDepartmentBox">Contact Role/Department:</label>
                                        <input type="text" name="roleDepartment" id="roleDepartmentBox" class="form-control" />
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label for="update-logo-file">Logo</label>
                                                <div class="img-reponsive">
                                                    <div class="img-container img-logo img-responsive">
                                                        <img src="<?= base_url()?>pictures/defaultLogo.png" class="Logo-show" id="Logo-show" />
                                                    </div>
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        <span class="btn btn-file btn-logo-edit"><span class="fileupload-new">Click To</span><span class="fileupload-exists"> Add</span>
                                                            <input type="file" name="Logoimage" id="Logo-file"  />
                                                        </span>
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="button-container">
                                <input type="submit" class="btn btn-primary" value="Submit" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.col -->
        </div>