<?php 
    if(isset($id) && !empty($id)){
        $id = $id;
    }else{
        return 'Sorry No ID Set';
    }
    if(isset($data) && !empty($data)){


        $name                   = $data->name;
        $phone                  = $data->phone;
        $website                = $data->website;
        $email                  = $data->email;

        //Getting Address Fields
        $address_streetNumber   = $data->address_street_number;
        $address_streetName     = $data->address_street_name;
        $address_town           = $data->address_town;
        $address_state          = $data->address_state;
        $address_postCode       = $data->address_post_code;


        $keywords               = $data->keywords;
        $banner                 = $data->banner;
        $logo                   = $data->logo;
        $productImage           = $data->productImage;

        $short_description      = $data->short_description;
        $long_description       = $data->long_description;

        $currentStatusID        = $data->status_flag_id;
        //$CoDevelopmentAgreement = $data->CoDevelopmentAgreement;

    }else{

        $name       = ''; 
        $phone      = ''; 
        $website    = ''; 
        $email      = '';

        //Getting Address Fields
        $address_streetNumber = '';
        $address_streetName = '';
        $address_town = '';
        $address_state = '';
        $address_postCode = '';
        //$address    = '';

        $keywords   = ''; 
        $banner     = ''; 
        $logo       = ''; 
        $productImage    = ''; 

        $short_description  = ''; 
        $long_description   = ''; 

        $currentStatusID = '';
        //$CoDevelopmentAgreement ='';
    }

    if(isset($EsicUserData) && !empty($EsicUserData)){

        $firstName    = $EsicUserData->firstName;
        $lastName     = $EsicUserData->lastName;
        $email        = $EsicUserData->email;

    }else{

        $firstName    = ''; 
        $lastName     = ''; 
        $email        = ''; 
    }

    if(isset($SocialLinks) && !empty($SocialLinks)){

        $FacebookLink   = $SocialLinks->facebook;
        $TwitterLink    = $SocialLinks->twitter;
        $GoogleLink     = $SocialLinks->google;
        $LinkedInLink   = $SocialLinks->linkedIn;
        $YoutubeLink    = $SocialLinks->youTube;
        $VimeoLink      = $SocialLinks->vimeo;

    }else{

        $FacebookLink   = '';
        $TwitterLink    = '';
        $GoogleLink     = '';
        $LinkedInLink   = '';
        $YoutubeLink    = '';
        $VimeoLink      = '';

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
                                        <label for="NameTextBox">Esic Name</label>
                                        <input type="text" name="Name" id="NameTextBox" value="<?= $name;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="FirstNameTextBox">First Name</label>
                                        <input type="text" name="firstName" id="FirstNameTextBox"  value="<?= $firstName;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="LastNameTextBox">Last Name</label>
                                        <input type="text" name="lastName" id="LastNameTextBox"  value="<?= $lastName;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="PhoneTextBox">Phone</label>
                                        <input type="text" name="Phone" id="PhoneTextBox" value="<?= $phone;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="EmailBox">Email</label>
                                        <input type="text" name="Email" id="EmailBox" value="<?= $email;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="WebsiteBox">Website</label>
                                        <input type="text" name="Website" id="WebsiteBox" value="<?= $website;?>" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="AddressBox">Address :</label>
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label for="address_streetNumber">Street Number</label>
                                                <input type="text" name="address_streetNumber" id="address_streetNumber" value="<?=(isset($address_streetNumber) and !empty($address_streetNumber))?$address_streetNumber:''?>" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="address_streetName">Street Name</label>
                                                <input type="text" name="address_streetName" id="address_streetName" value="<?=(isset($address_streetName) and !empty($address_streetName))?$address_streetName:''?>" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="address_town">Town</label>
                                                <input type="text" name="address_town" id="address_town" value="<?=(isset($address_town) and !empty($address_town))?$address_town:''?>" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-2">
                                                <label for="address_state">State</label>
                                                <input type="text" name="address_state" id="address_state" value="<?=(isset($address_state) and !empty($address_state))?$address_state:''?>" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-2">
                                                <label for="address_postCode">Post Code</label>
                                                <input type="text" name="address_postCode" id="address_postCode" value="<?=(isset($address_postCode) and !empty($address_postCode))?$address_postCode:''?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="BusinessBox">Business Name</label>
                                        <input type="text" name="Business" id="BusinessBox" value="<?= $Business;?>" class="form-control" />
                                    </div>
                                    <div class="row dates-container">
                                        <div class="col-md-4 form-group">
                                            <label for="IncorporateDateBox">Incorporate Date</label>
                                            <input type="text" name="IncorporateDate" id="IncorporateDateBox" value="<?= $IncorporateDate;?>" class="form-control date_picker" />
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="AddedDateBox">Added Date</label>
                                            <input type="text" name="AddedDate" id="AddedDateBox" value="<?= $AddedDate;?>" class="form-control date_picker" />
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="ExpiryDateBox">Expiry Date</label>
                                            <input type="text" name="ExpiryDate" id="ExpiryDateBox" value="<?= $ExpiryDate;?>" class="form-control date_picker" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="ACNBox">ACN #</label>
                                        <input type="text" name="ACN" id="ACNBox" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="ShortDescriptionBox">Short Description  of Business</label>
                                        <textarea type="text" name="ShortDescription" id="ShortDescriptionBox" class="form-control"><?= $short_description ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="LongDescriptionBox">Detail Description  of Business</label>
                                        <textarea type="text" name="LongDescription"  id="LongDescriptionBox" class="form-control"><?= $long_description ?> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="KeywordsBox">Keywords</label>
                                        <input type="text" name="Keywords" id="KeywordsBox" value="<?= $keywords;?>" class="form-control" />
                                    </div>
                                     <div class="form-group">
                                        <label for="statusFlagBox">Status</label>
                                        <select id="statusFlagBox" name="statusFlag" class="form-control">                              
                                            <?php    
                                                if(isset($itemStatuses) || !empty($itemStatuses)){
                                                    foreach ($itemStatuses as $key => $itemStatus) { 
                                                         $selected = '';
                                                        if($itemStatus->id == $currentStatusID){
                                                            $selected = 'SELECTED';
                                                        }
                                             ?>
                                                        <option value="<?= $itemStatus->id;?>" <?= $selected; ?> > <?= $itemStatus->Label;?></option>
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
                                    <div class="form-group">
                                        <label for="update-Banner-file">Banner</label>
                                        <div class="img-reponsive">
                                            <div class="img-container img-logo img-responsive">
                                                <?php if(!empty($banner)){ ?>
                                                    
                                                        <img src="<?= base_url().$banner;?>" class="banner-show" id="banner-show" />

                                                <?php }else{ ?>
                                                        <img src="<?= base_url()?>pictures/defaultLogo.png" class="logo-show" id="banner-show" />
                                                <?php } ?>
                                            </div>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-file btn-logo-edit"><span class="fileupload-new">Click To</span><span class="fileupload-exists"> Edit</span>
                                                    <input type="file" name="Bannerimage" id="banner-file"  />
                                                </span>
                                            </div>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="update-product-file">Product/ Service Image</label>
                                        <div class="img-reponsive">
                                            <div class="img-container img-logo img-responsive">
                                                <?php if(!empty($productImage)){ ?>
                                                    
                                                        <img src="<?= base_url().$productImage;?>" class="product-show" id="product-show" />

                                                <?php }else{ ?>
                                                        <img src="<?= base_url()?>pictures/defaultLogo.png" class="logo-show" id="product-show" />
                                                <?php } ?>
                                            </div>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-file btn-logo-edit"><span class="fileupload-new">Click To</span><span class="fileupload-exists"> Edit</span>
                                                    <input type="file" name="productImage" id="product-file"  />
                                                </span>
                                            </div>
                                       </div>
                                    </div>
                                     <!--div class="form-group">
                                        <label for="update-CoDevelopmentAgreement-file">Copy Of CO-Development Agreement</label>
                                        <div class="file-reponsive">
                                            <div class="file-container file-logo file-responsive">
                                                <?php if(!empty($CoDevelopmentAgreement)){ ?>
                                                        <a href="<?= base_url().$CoDevelopmentAgreement;?>" class="CoDevelopmentAgreement-show btn btn-primary" id="CoDevelopmentAgreement-show" target="_blank" download="<?= $ListingLabel ; ?> Copy Of CO-Development Agreement">Click To Download</a>

                                                <?php  }?>
                                            </div>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-file btn-logo-edit"><span class="fileupload-new">Click To</span><span class="fileupload-exists"> Change</span>
                                                    <input type="file" name="CoDevelopmentAgreement" id="CoDevelopmentAgreement-file"  />
                                                </span>
                                            </div>
                                       </div>
                                    </div-->
                                </div>
                                <div class="col-md-12">
                                    <div class="social-container">
                                        <label for="AddressBox">Social Links:</label>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="FacebookLink">Facebook</label>
                                                <input type="text" name="FacebookLink" id="FacebookLink" class="form-control" value="<?= $FacebookLink;?>" >
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="TwitterLink">Twitter</label>
                                                <input type="text" name="TwitterLink" id="TwitterLink" class="form-control" value="<?= $TwitterLink;?>">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="GoogleLink">Google Plus</label>
                                                <input type="text" name="GoogleLink" id="GoogleLink" class="form-control" value="<?= $GoogleLink;?>">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="LinkedInLink">LinkedIn</label>
                                                <input type="text" name="LinkedInLink" id="LinkedInLink" class="form-control" value="<?= $LinkedInLink;?>">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="YoutubeLink">Youtube</label>
                                                <input type="text" name="YoutubeLink" id="YoutubeLink" class="form-control" value="<?= $YoutubeLink;?>">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="VimeoLink">Vimeo</label>
                                                <input type="text" name="VimeoLink" id="VimeoLink" class="form-control"  value="<?= $VimeoLink;?>">
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