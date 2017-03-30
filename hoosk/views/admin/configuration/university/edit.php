
    <?php 
    if(isset($id) && !empty($id)){
        $id = $id;
    }else{
        return 'Sorry No ID Set';
    }
    if(isset($data) && !empty($data)){
        $name    = $data->institution;
        $phone   = $data->phone;
        $website = $data->website;
        $email   = $data->email;

        //Getting Address Fields
        $address    = $data->address;
        $suburb     = $data->suburb;
        $state      = $data->state;
        $post_code  = $data->post_code;

        //$banner = $data->banner;
        $logo = $data->institutionLogo;


        $programDescription = $data->programDescription;
        $programEligibilityCriteria = $data->programEligibilityCriteria;
        $ProgramStartDate   = $data->ProgramStartDate;
        $roleDepartment     = $data->roleDepartment;
        $contactName        = $data->contactName;

    }else{

        $name    = '';
        $phone   = '';
        $website = '';
        $email   = '';

        //Getting Address Fields
        $address    = '';
        $suburb     = '';
        $state      = '';
        $post_code  = '';

        //$banner = '';
        $logo = '';


        $programDescription = '';
        $programEligibilityCriteria = '';
        $ProgramStartDate   = '';
        $roleDepartment     = '';
        $contactName      = '';
    }


    ?>
        <div class="row">
            <div class="col-md-12">
                <form action="<?= base_url().$ControllerRouteName.'/EditSave'?>" method="post" class="form" enctype="multipart/form-data">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Edit <?= $ListingLabel ; ?></h3>
                            <div class="add-New-container">
                                 <a href="<?= base_url().$ControllerRouteName.'/Listing'?>" class="addNewBtn">Listing</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <input type="hidden" id="hiddenListID" value="">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="NameTextBox">Name:</label>
                                        <input type="text" name="Name" id="NameTextBox" value="<?= $name;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="WebsiteBox">Website:</label>
                                        <input type="text" name="Website" id="WebsiteBox" value="<?= $website;?>" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="AddressBox">Address Fields:</label>
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="address" class="form-control" value="<?= $address;?>">
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="suburb">Suburb</label>
                                                <input type="text" name="suburb" id="suburb" class="form-control" value="<?= $suburb;?>">
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="state">State</label>
                                                <input type="text" name="state" id="state" class="form-control" value="<?= $state;?>">
                                            </div>

                                            <div class="form-group col-lg-2">
                                                <label for="post_code">Post Code</label>
                                                <input type="text" name="post_code" id="post_code" class="form-control" value="<?= $post_code;?>">
                                            </div>
                                        </div>
                                    </div>

                                  <div class="form-group"> 
                                        <label for="programDescriptionBox">Program Description:</label>
                                        <textarea type="text" name="programDescription" id="programDescriptionBox" class="form-control"> <?= $programDescription;?> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="programEligibilityCriteriaBox">Program Eligibility Criteria:</label>
                                        <input type="text" name="programEligibilityCriteria" id="programEligibilityCriteriaBox" class="form-control" value="<?= $programEligibilityCriteria;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="ProgramStartDateBox">Program Start Date:</label>
                                        <input type="text" name="ProgramStartDate" id="ProgramStartDateBox" class="form-control date_picker" value="<?= $ProgramStartDate;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="contactNameBox">Contact Name:</label>
                                        <input type="text" name="contactName" id="contactNameBox" value="<?= $contactName;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="PhoneTextBox">Contact Phone:</label>
                                        <input type="text" name="Phone" id="PhoneTextBox" value="<?= $phone;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="EmailBox">Contact Email:</label>
                                        <input type="text" name="Email" id="EmailBox" value="<?= $email;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="roleDepartmentBox">Contact Role/Department:</label>
                                        <input type="text" name="roleDepartment" id="roleDepartmentBox" class="form-control" value="<?= $roleDepartment;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="update-logo-file">Logo:</label>
                                        <div class="img-reponsive">
                                            <div class="img-container img-logo img-responsive">
                                                 <?php if(!empty($logo)){ ?>
                                                    <img src="<?= base_url().$logo;?>" class="logo-show" id="Logo-show" />
                                                <?php }else{ ?>
                                                    <img src="<?= base_url()?>pictures/defaultLogo.png" class="logo-show" id="Logo-show" />
                                                 <?php } ?>
                                            </div>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-file btn-logo-edit"><span class="fileupload-new">Click To</span><span class="fileupload-exists"> Edit</span>
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
                                <input type="hidden" name="id" value="<?= $id;?>" />
                                <input type="submit" class="btn btn-primary" value="Save" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.col -->
        </div>
