

        <div class="row">
            <div class="col-md-12">
                <form action="<?= base_url().$ControllerRouteName.'/AddSave';?>" method="post" class="form" enctype="multipart/form-data">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add <?= $ListingLabel ; ?></h3>
                            <div class="add-New-container">
                                <a href="<?= base_url().$ControllerRouteName.'/Listing';?>" class="addNewBtn">Listing</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <input type="hidden" id="hiddenListID" value="">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="NameTextBox">Name</label>
                                        <input type="text" name="name" id="NameTextBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="WebsiteBox">Website</label>
                                        <input type="text" name="website" id="WebsiteBox" class="form-control" />
                                    </div>
                                    <!--Address with multiple columns-->
                                    <div class="form-group">
                                        <label for="AddressBox">Address Fields:</label>
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="address" class="form-control">
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label for="post_code">Post Code</label>
                                                <input type="text" name="post_code" id="post_code" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group"> 
                                        <label for="programSummaryBox">Program Summary</label>
                                        <textarea type="text" name="Program_Summary" id="programSummaryBox" class="form-control"> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="programCriteriaBox">Program Criteria</label>
                                        <input type="text" name="Program_Criteria" id="programCriteriaBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="ProgramStartDateBox">Program Start Date</label>
                                        <input type="text" name="Program_Start_Date" id="ProgramStartDateBox" class="form-control date_picker" />
                                    </div>
                                    <div class="form-group">
                                        <label for="ProgramApplicationContactBox">Program Application Contact</label>
                                        <input type="text" name="Program_Application_Contact" id="roleDepartmentBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="roleDepartmentBox">Program Application Method</label>
                                        <input type="text" name="Program_Application_Method" id="roleDepartmentBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="acceleratorStatusBox">Accelerator Status</label>
                                        <select name="AcceleratorStatus" id="acceleratorStatusBox" class="form-control">
                                            <option value="Eligible">Eligible</option>
                                            <option value="Pending">Pending</option>
                                        </select>
                                    </div>
                                    
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
                        </div> <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="button-container">
                                <input type="submit" class="btn btn-primary" value="Save" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->