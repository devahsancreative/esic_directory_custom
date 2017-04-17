
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
                                <?= $userFieldsView; ?>
                                <div class="col-md-12">
                                    <label for="UserDetailBox">Accelerator Details :</label>
                                    <div class="form-group col-md-4">
                                        <label for="NameTextBox">Accelerators Name</label>
                                        <input type="text" name="name" id="NameTextBox" class="form-control" />
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <label for="WebsiteBox">Website</label>
                                        <input type="text" name="website" id="WebsiteBox" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-4">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" id="address" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                            <label for="post_code">Post Code</label>
                                            <input type="text" name="post_code" id="post_code" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
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