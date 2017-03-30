<?php 
    if(isset($id) && !empty($id)){
        $id = $id;
    }else{
        return 'Sorry No ID Set';
    }
    if(isset($data) && !empty($data)){
        $name    = $data->name;
        $website = $data->website;

        //Getting Address Fields
        $address    = $data->address;
        $post_code  = $data->post_code;

        $logo = $data->logo;

        $Program_Summary    = $data->Program_Summary;
        $Program_Criteria   = $data->Program_Criteria;
        $Program_Start_Date = $data->Program_Start_Date;
        $Program_Application_Contact = $data->Program_Application_Contact;
        $Program_Application_Method  = $data->Program_Application_Method;

        $AcceleratorStatus = $data->AcceleratorStatus;


    }else{
        $name    = '';
        $website = '';

        //Getting Address Fields
        $address    = '';
        $post_code  = '';

        $logo = '';

        $Program_Summary    = '';
        $Program_Criteria   = '';
        $Program_Start_Date = '';
        $Program_Application_Contact = '';
        $Program_Application_Method  = '';
        $AcceleratorStatus = '';
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
                                        <label for="NameTextBox">Name</label>
                                        <input type="text" name="name" id="NameTextBox" value="<?= $name;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="WebsiteBox">Website</label>
                                        <input type="text" name="website" id="WebsiteBox" value="<?= $website;?>" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="AddressBox">Address Fields:</label>
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="address" class="form-control" value="<?= $address;?>">
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label for="post_code">Post Code</label>
                                                <input type="text" name="post_code" id="post_code" class="form-control" value="<?= $post_code;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="programSummaryBox">Program Summary</label>
                                        <textarea type="text" name="Program_Summary" id="programSummaryBox" class="form-control"> <?= $Program_Summary;?> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="programCriteriaBox">Program Criteria</label>
                                        <input type="text" name="Program_Criteria" id="programCriteriaBox" class="form-control" value="<?= $Program_Criteria;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="ProgramStartDateBox">Program Start Date</label>
                                        <input type="text" name="Program_Start_Date" id="ProgramStartDateBox" class="form-control date_picker" value="<?= $Program_Start_Date;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="programApplicationContactBox">Program Application Contact</label>
                                        <input type="text" name="Program_Application_Contact" id="programApplicationContactBox" class="form-control" value="<?= $Program_Application_Contact;?>">
                                    </div>
                                     <div class="form-group">
                                        <label for="programApplicationMethodBox">Program Application Method</label>
                                        <input type="text" name="Program_Application_Method" id="programApplicationMethodBox" class="form-control" value="<?= $Program_Application_Method;?>">
                                    </div>
                                   <div class="form-group">
                                        <label for="acceleratorStatusBox">Accelerator Status</label>
                                        <select name="AcceleratorStatus" id="acceleratorStatusBox" class="form-control">
                                            <?php 
                                                $selected = '';
                                                if($AcceleratorStatus == 'Eligible'){ 
                                                        $selected = 'SELECTED';
                                                } 
                                            ?>
                                            <option value="Eligible" <?= $selected;?>>Eligible</option>

                                             <?php 
                                                $selected = '';
                                                if($AcceleratorStatus == 'Pending'){ 
                                                        $selected = 'SELECTED';
                                                } 
                                            ?>

                                            <option value="Pending" <?= $selected;?>>Pending</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="update-logo-file">Logo</label>
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
        <!-- /.row -->