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

        $company_name           = $data->company_name;
        $company_email          = $data->company_email;

        $address_street_number  = $data->address_street_number;
        $address_street_name    = $data->address_street_name;
        $address_town           = $data->address_town;
        $address_state          = $data->address_state;
        $address_post_code      = $data->address_post_code;

        $logo                   = $data->logo;
        $about                  = $data->about;
        $investor_type_id       = $data->investor_type_id;

        $preferred_investment_amount     = $data->preferred_investment_amount;
        $preferred_investment_industires = $data->preferred_investment_industires;
        $preferred_esic_status_ids       = $data->preferred_esic_status_ids;


    }else{

        $name                   = '';
        $phone                  = '';
        $website                = '';
        $email                  = '';
        
        $address_street_number  = '';
        $address_street_name    = '';
        $address_town           = '';
        $address_state          = '';
        $address_post_code      = '';

        $logo                   = '';
        $about                  = '';
        $investor_type_id       = '';

        $preferred_investment_amount     = '';
        $preferred_investment_industires = '';
        $preferred_esic_status_ids       = '';
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
                                        <label for="NameTextBox">Name</label>
                                        <input type="text" name="name" id="NameTextBox" value="<?= $name;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="PhoneTextBox">Phone</label>
                                        <input type="text" name="phone" id="PhoneTextBox" value="<?= $phone;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="EmailBox">Email</label>
                                        <input type="text" name="email" id="EmailBox" value="<?= $email;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="WebsiteBox">Website</label>
                                        <input type="text" name="website" id="WebsiteBox" value="<?= $website;?>" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="CompanyNameBox">Company Name:</label>
                                        <input type="text" name="company_name" id="CompanyNameBox" class="form-control" value="<?= $company_name;?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="CompanyEmailBox">Company Email:</label>
                                        <input type="text" name="company_email" id="CompanyEmailBox" class="form-control" value="<?= $company_email;?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="AddressBox">Address :</label>
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label for="address_streetNumber">Street Number</label>
                                                <input type="text" name="address_street_number" id="address_street_number" value="<?= $address_street_number;?>" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="address_streetName">Street Name</label>
                                                <input type="text" name="address_street_name" id="address_streetName" value="<?= $address_street_name;?>" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="address_town">Town</label>
                                                <input type="text" name="address_town" id="address_town" value="<?= $address_town;?>" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-2">
                                                <label for="address_state">State</label>
                                                <input type="text" name="address_state" id="address_state" value="<?= $address_state;?>" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-2">
                                                <label for="address_postCode">Post Code</label>
                                                <input type="text" name="address_post_code" id="address_postCode" value="<?= $address_post_code;?>" class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="investorTypeFlagBox">Investor Type:</label>
                                        <select id="investorTypeFlagBox" name="investor_type_id" class="form-control">    
                                            <option value="">Select Investor Type</option>                  
                                            <?php    
                                                if(isset($investorTypes) || !empty($investorTypes)){
                                                    foreach ($investorTypes as $key => $investorType) { 
                                                        $selected = '';
                                                    if($investor_type_id == $investorType->id){
                                                        $selected = 'SELECTED';
                                                    }           
                                             ?>
                                                        <option value="<?= $investorType->id;?>" <?=$selected;?> > <?= $investorType->label;?></option>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amountBox">Preferred Investment Amount:</label>
                                        <select id="amountBox" name="preferred_investment_amount" class="form-control ">                                 
                                           <option value="">Select Amount</option>
                                            <?php    
                                                if(isset($investmentAmounts) || !empty($investmentAmounts)){
                                                    foreach ($investmentAmounts as $key => $investmentAmount){
                                                            $selected = '';
                                                        if($preferred_investment_amount == $investmentAmount->id){
                                                            $selected = 'SELECTED';
                                                        }           
                                            ?>
                                                        <option value="<?= $investmentAmount->id;?>" <?=$selected;?>> <?= $investmentAmount->label;?></option>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="industiresBox">Preferred Investment Industires:</label>
                                         <select id="industiresBox" name="preferred_investment_industires[]" class="form-control js-example-basic-multiple" multiple>
                                            <?php    
                                            $PII = json_decode($preferred_investment_industires, TRUE);
                                                if(isset($industires) || !empty($industires)){
                                                    foreach ($industires as $key => $industry) { 
                                                            $selected = '';
                                                        if(in_array($industry->id, $PII)){
                                                            $selected = 'SELECTED';
                                                        }
                                            ?>
                                                        <option value="<?= $industry->id;?>" <?=$selected;?> > <?= $industry->sector;?></option>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="esicStatuesBox">Preferred ESIC Status:</label>
                                         <select id="esicStatuesBox" name="preferred_esic_status_ids[]" class="form-control js-example-basic-multiple" multiple>
                                            <option value="All">All</option>
                                            <?php  
                                            $PESI = json_decode($preferred_esic_status_ids, TRUE);  
                                                if(isset($esicStatues) || !empty($esicStatues)){
                                                    foreach ($esicStatues as $key => $esicStatus) { 
                                                          $selected = '';
                                                        if(in_array($esicStatus->id, $PESI)){
                                                            $selected = 'SELECTED';
                                                        }
                                            ?>
                                                        <option value="<?= $esicStatus->id;?>" <?=$selected;?>> <?= $esicStatus->status;?></option>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="AboutBox">About:</label>
                                        <textarea type="text" name="about" id="AboutBox" class="form-control"> <?= $about; ?></textarea>
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