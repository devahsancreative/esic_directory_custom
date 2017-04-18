
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
                                    <label for="ProgrammeDetailBox">Programme Details :</label>
                                    <div class="form-group">
                                        <label for="NameTextBox">Programme Member Name</label>
                                        <input type="text" name="Member" id="NameTextBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="WebsiteBox">Website</label>
                                        <input type="text" name="Web_Address" id="WebsiteBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="projectTitleBox">Project Title</label>
                                        <input type="text" name="Project_Title" id="projectTitleBox" class="form-control" />
                                    </div>
                                    
                                    <!--Address with multiple columns-->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label for="address">Project Location</label>
                                                <input type="text" name="Project_Location" id="address" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="state">State Territory</label>
                                                <input type="text" name="State_Territory" id="state" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-2">
                                                <label for="post_code">Post Code</label>
                                                <input type="text" name="postal_code" id="post_code" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="programSummaryBox">Project Summary</label>
                                        <textarea type="text" name="Project_Summary" id="programSummaryBox" class="form-control"> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="marketBox">Market</label>
                                        <input type="text" name="Market" id="marketBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="technologyBox">Technology</label>
                                        <input type="text" name="Technology" id="technologyBox" class="form-control" />
                                    </div>
                                    <div class="form-group"> 
                                        <label for="shortDescriptionBox">Short Description</label>
                                        <textarea type="text" name="short_description" id="shortDescriptionBox" class="form-control"> </textarea>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="longDescriptionBox">Long Description</label>
                                        <textarea type="text" name="long_description" id="longDescriptionBox" class="form-control"> </textarea>
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