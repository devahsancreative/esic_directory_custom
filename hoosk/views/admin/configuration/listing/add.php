
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
                                        <input type="text" name="Name" id="NameTextBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="PhoneTextBox">Phone</label>
                                        <input type="text" name="Phone" id="PhoneTextBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="EmailBox">Email</label>
                                        <input type="text" name="Email" id="EmailBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="WebsiteBox">Website</label>
                                        <input type="text" name="Website" id="WebsiteBox" class="form-control" />
                                    </div>
<!--Address with multiple columns-->
                                    <div class="form-group">
                                        <label for="AddressBox">Address :</label>
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
                                        <label for="ShortDescriptionBox">Short Description</label>
                                        <textarea type="text" name="ShortDescription" id="ShortDescriptionBox" class="form-control"> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="LongDescriptionBox">Detail Description</label>
                                        <textarea type="text" name="LongDescription"  id="LongDescriptionBox" class="form-control"> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="KeywordsBox">Keywords</label>
                                        <input type="text" name="Keywords" id="KeywordsBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="statusFlagBox">Status</label>
                                        <select id="statusFlagBox" name="statusFlag" class="form-control">                                 
                                            <?php    
                                                if(isset($itemStatuses) || !empty($itemStatuses)){
                                                    foreach ($itemStatuses as $key => $itemStatus) { 
                                             ?>
                                                        <option value="<?= $itemStatus->id;?>" > <?= $itemStatus->Label;?></option>
                                            <?php 
                                                    }
                                                }
                                            ?>
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
                                    <div class="form-group">
                                        <label for="update-Banner-file">Banner</label>
                                        <div class="img-reponsive">
                                            <div class="img-container img-logo img-responsive">
                                                <img src="<?= base_url()?>pictures/defaultLogo.png" class="banner-show" id="banner-show" />
                                            </div>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-file btn-logo-edit"><span class="fileupload-new">Click To</span><span class="fileupload-exists"> Add</span>
                                                    <input type="file" name="Bannerimage" id="banner-file"  />
                                                </span>
                                            </div>
                                       </div>
                                    </div>
                                    <!--div class="form-group">
                                        <label for="update-CoDevelopmentAgreement-file">CO-Development Agreement</label>
                                        <div class="file-reponsive">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-file btn-logo-edit"><span class="fileupload-new">Click To</span><span class="fileupload-exists"> Edit</span>
                                                    <input type="file" name="CoDevelopmentAgreement" id="CoDevelopmentAgreement-file"  />
                                                </span>
                                            </div>
                                       </div>
                                    </div-->
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