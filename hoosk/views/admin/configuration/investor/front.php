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
                                <!--Blade Version Of Codeigniter -->
                                <?= $userFieldsView; ?>
                                <div class="col-md-12">
                                    <label for="InvestorDetailBox">Investor Details :</label>
                                    <div class="form-group col-sm-4 col-md-3">
                                        <label for="NameTextBox">Name:</label>
                                        <input type="text" name="name" id="NameTextBox" class="form-control" />
                                    </div>
                                    <div class="form-group col-sm-4 col-md-3">
                                        <label for="PhoneTextBox">Phone:</label>
                                        <input type="text" name="phone" id="PhoneTextBox" class="form-control" />
                                    </div>
                                    <div class="form-group col-sm-4 col-md-3">
                                        <label for="EmailBox">Email:</label>
                                        <input type="text" name="email" id="EmailBox" class="form-control" />
                                    </div>
                                    <div class="form-group col-sm-4 col-md-3">
                                        <label for="WebsiteBox">Website:</label>
                                        <input type="text" name="website" id="WebsiteBox" class="form-control" />
                                    </div>
                                    <div class="form-group col-sm-4 col-md-3">
                                        <label for="CompanyNameBox">Company Name:</label>
                                        <input type="text" name="company_name" id="CompanyNameBox" class="form-control" />
                                    </div>
                                    <div class="form-group col-sm-4 col-md-3">
                                        <label for="CompanyEmailBox">Company Email:</label>
                                        <input type="text" name="company_email" id="CompanyEmailBox" class="form-control" />
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12">
                                        <label for="AddressBox">Address :</label>
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label for="address_streetNumber">Street Number</label>
                                                <input type="text" name="address_street_number" id="address_streetNumber" class="form-control">
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="address_streetName">Street Name</label>
                                                <input type="text" name="address_street_name" id="address_streetName" class="form-control">
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
                                                <input type="text" name="address_post_code" id=" address_postCode" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6">
                                        <label for="investorTypeFlagBox">Investor Type:</label>
                                        <select id="investorTypeFlagBox" name="investor_type_id" class="form-control">    
                                            <option value="">Select Investor Type</option>                  
                                            <?php    
                                                if(isset($investorTypes) || !empty($investorTypes)){
                                                    foreach ($investorTypes as $key => $investorType) {            
                                             ?>
                                                        <option value="<?= $investorType->id;?>" > <?= $investorType->label;?></option>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6">
                                        <label for="amountBox">Preferred Investment Amount:</label>
                                        <select id="amountBox" name="preferred_investment_amount" class="form-control ">                                 
                                           <option value="">Select Amount</option>
                                            <?php    
                                                if(isset($investmentAmounts) || !empty($investmentAmounts)){
                                                    foreach ($investmentAmounts as $key => $investmentAmount) { 
                                            ?>
                                                        <option value="<?= $investmentAmount->id;?>" > <?= $investmentAmount->label;?></option>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6">
                                        <label for="industiresBox">Preferred Investment Industires:</label>
                                         <select id="industiresBox" name="preferred_investment_industires[]" class="form-control js-example-basic-multiple" multiple>
                                            <?php    
                                                if(isset($industires) || !empty($industires)){
                                                    foreach ($industires as $key => $industry) { 
                                            ?>
                                                        <option value="<?= $industry->id;?>" > <?= $industry->sector;?></option>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6">
                                        <label for="esicStatuesBox">Preferred ESIC Status:</label>
                                         <select id="esicStatuesBox" name="preferred_esic_status_ids[]" class="form-control js-example-basic-multiple" multiple>
                                            <option value="All">All</option>
                                            <?php    
                                                if(isset($esicStatues) || !empty($esicStatues)){
                                                    foreach ($esicStatues as $key => $esicStatus) { 
                                            ?>
                                                        <option value="<?= $esicStatus->id;?>" > <?= $esicStatus->status;?></option>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-12">
                                        <label for="AboutBox">About:</label>
                                        <textarea type="text" name="about" id="AboutBox" class="form-control"> </textarea>
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