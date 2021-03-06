<?php 
    if(isset($id) && !empty($id)){
        $id = $id;
    }else{
        return 'Sorry No ID Set';
    }
    if(isset($data) && !empty($data)){
        $Member             = $data->Member;
        $Web_Address        = $data->Web_Address;

        //Getting Address Fields
        $Project_Location   = $data->Project_Location;
        $State_Territory    = $data->State_Territory;
        $postal_code        = $data->postal_code;

        //$banner = $data->banner;
        $logo               = $data->accLogo;

        $Project_Title      = $data->Project_Title;
        $Project_Summary    = $data->Project_Summary;
        $Market             = $data->Market;
        $Technology         = $data->Technology;
        $short_description  = $data->short_description;
        $long_description   = $data->long_description;



    }else{

        $Member                 = '';
        $Web_Address            = '';

        //Getting Address Fields
        $Project_Location       = '';
        $State_Territory        = '';
        $postal_code            = '';

        //$banner               = '';
        $logo                   = '';

        $Project_Title          = '';
        $Project_Summary        = '';
        $Market                 = '';
        $Technology             = '';
        $short_description      = '';
        $long_description       = '';
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
                                        <label for="NameTextBox">Programme Member Name</label>
                                        <input type="text" name="Member" id="NameTextBox" value="<?= $Member;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="WebsiteBox">Website</label>
                                        <input type="text" name="Web_Address" id="WebsiteBox" value="<?= $Web_Address;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="projectTitleBox">Project Title</label>
                                        <input type="text" name="Project_Title" id="projectTitleBox" class="form-control" value="<?= $Project_Title;?>">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label for="address">Project Location</label>
                                                <input type="text" name="Project_Location" id="address" class="form-control" value="<?= $Project_Location;?>">
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label for="state">State Territory</label>
                                                <input type="text" name="State_Territory" id="state" class="form-control" value="<?= $State_Territory;?>">
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label for="post_code">Post Code</label>
                                                <input type="text" name="postal_code" id="post_code" class="form-control" value="<?= $postal_code;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="projectSummaryBox">Project Summary</label>
                                        <textarea type="text" name="Project_Summary" id="projectSummaryBox" class="form-control"> <?= $Project_Summary;?> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="marketBox">Market</label>
                                        <input type="text" name="Market" id="marketBox" class="form-control" value="<?= $Market;?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="technologyBox">Technology</label>
                                        <input type="text" name="Technology" id="technologyBox" class="form-control" value="<?= $Technology;?>">
                                    </div>
                                     <div class="form-group"> 
                                        <label for="shortDescriptionBox">Short Description</label>
                                        <textarea type="text" name="short_description" id="shortDescriptionBox" class="form-control"> <?= $short_description;?></textarea>
                                    </div>
                                    <div class="form-group"> 
                                        <label for="longDescriptionBox">Long Description</label>
                                        <textarea type="text" name="long_description" id="longDescriptionBox" class="form-control"> <?= $long_description;?></textarea>
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