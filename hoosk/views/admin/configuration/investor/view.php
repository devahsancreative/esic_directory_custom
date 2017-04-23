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

        $preferred_investment_amount_id     = $data->preferred_investment_amount;
        $preferred_investment_industires = $data->preferred_investment_industires;
        $preferred_esic_status_ids       = $data->preferred_esic_status_ids;

    }else{

        $name                   = '';
        $phone                  = '';
        $website                = '';
        $email                  = '';

        $company_name           = '';
        $company_email          = '';
        
        $address_street_number  = '';
        $address_street_name    = '';
        $address_town           = '';
        $address_state          = '';
        $address_post_code      = '';

        $logo                   = '';
        $about                  = '';
        $investor_type_id       = '';

        $preferred_investment_amount_id     = '';
        $preferred_investment_industires = '';
        $preferred_esic_status_ids       = '';
    }
    $investor_type = '';
    if(isset($investorTypes) || !empty($investorTypes)){
        foreach ($investorTypes as $key => $investorType) { 
            if($investor_type_id == $investorType->id){
                $investor_type = $investorType->label;
            }  
        }
    } 
    $preferred_investment_amount = '';
    if(isset($investmentAmounts) || !empty($investmentAmounts)){
        foreach ($investmentAmounts as $key => $investmentAmount) { 
            if($preferred_investment_amount_id == $investmentAmount->id){
                $preferred_investment_amount = $investmentAmount->label;
            }  
        }
    }
    $CurrentIndustires = array();
    if(isset($industires) || !empty($industires)){
        if(!empty($preferred_investment_industires)){
            $industiresIDsArray = json_decode($preferred_investment_industires);
            foreach($industires as $key => $industry) { 
                if(in_array($industry->id, $industiresIDsArray)){
                    $CurrentIndustires[] = $industry->sector;
                }  
            }
        }
    } 
    $CurrentEsicStatuses = array();
    if(isset($esicStatues) || !empty($esicStatues)){
        if(!empty($preferred_esic_status_ids)){
            $EsicStatusIDsArray = json_decode($preferred_esic_status_ids);
            foreach($esicStatues as $key => $esicStatus) { 
                if(in_array($esicStatus->id, $EsicStatusIDsArray)){
                    $CurrentEsicStatuses[] = $esicStatus->status;
                }  
            }
        }
    }            


    ?>
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile" id="profile-box-container" data-user-id="<?= $id;?>" data-img="<?= FCPATH.$logo?>">
            <?php 
                    if(!empty($logo) and is_file(FCPATH.$logo)){ 
                      $logoImage = base_url().'/'.$logo;
                    }else{
                       $logoImage = base_url('pictures/defaultLogo.png');
                    }

            ?>
                <div class="user-logo-container">
                  <img id="User-Logo" class="profile-user-img img-responsive" src="<?= $logoImage; ?>" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">
                    <b><?= $name;?></b>
                </h3>
                <?php if(!empty($website)){ ?>
                <div class="web-container">
                    <label for="">Website:</label>
                    <a href="<?= $website; ?>" class="btn btn-primary btn-block" target="_blank">
                        <?= $website; ?>
                    </a>
                </div>
                 <?php } ?>
                <?php if(!empty($email)){ ?>
                    <div class="email-container">
                        <label for="">Email:</label>
                        <p class=""><?= $email; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($phone)){ ?>
                    <div class="phone-container">
                        <label for="">Phone:</label>
                        <p class=""><?= $phone; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($company_name)){ ?>
                    <div class="company-name-container">
                        <label for="">Company Name:</label>
                        <p class=""><?= $company_name; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($company_email)){ ?>
                    <div class="company-email-container">
                        <label for="">Company Email:</label>
                        <p class=""><?= $company_email; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($investor_type)){ ?>
                    <div class="investor-type-container">
                        <label for="">Investor Type:</label>
                        <p class=""><?= $investor_type; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($preferred_investment_amount)){ ?>
                    <div class="company-email-container">
                        <label for="">Preferred Investment Amount:</label>
                        <p class=""><?= $preferred_investment_amount; ?></p>
                    </div>
                <?php } ?>
                <?php if(!empty($CurrentIndustires)){ ?>
                    <div class="esic-industry-container">
                        <label for="">Preferred Industires:</label>
                        <div class="multiple-item-container">
                        <?php foreach ($CurrentIndustires as $key => $CurrentIndustry) { ?>
                            <span class=""><?= $CurrentIndustry; ?></span>
                        <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($CurrentEsicStatuses)){ ?>
                    <div class="esic-status-container">
                        <label for="">Preferred Esic Statuses:</label>
                        <div class="multiple-item-container">
                        <?php foreach ($CurrentEsicStatuses as $key => $CurrentEsicStatus) { ?>
                            <span class=""><?= $CurrentEsicStatus; ?></span>
                        <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                
                <?php if($address){ ?>
                    <div class="address-container">
                        <div class="address-text">
                            <strong><i class="fa fa-globe margin-r-5"></i>Address</strong>
                            <?php if(!empty($address_street_number)){?>
                                <div class="text-muted">Street Number: <span class="street_number"><?=$address_street_number;?></span></div>
                            <?php } ?>
                            <?php if(!empty($address_street_name)){?>
                                <div class="text-muted">Street Name: <span class="street_name"><?=$address_street_name;?></span></div>
                            <?php } ?>
                            <?php if(!empty($address_town)){?>
                                <div class="text-muted">Town: <span class="town"><?=$address_town?></span></div>
                            <?php } ?>
                            <?php if(!empty($address_state)){?>
                                <div class="text-muted">State: <span class="state"> <?=$address_state?> </span></div>
                            <?php } ?>
                            <?php if(!empty($address_post_code)){?>
                                <div class="text-muted">Post Code: <span class="post_code"><?=$address_post_code?></span></div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="text-center">
                    <a href="<?= base_url().$ControllerRouteName.'/Listing'?>" class="btn addNewBtn btn-primary">Go To Listing</a>
                    <a href="<?= base_url().$ControllerRouteName.'/Edit/'.$id;?>" class="btn addNewBtn btn-primary">Edit</a>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#questions" data-toggle="tab">Questions</a></li>
              <li><a href="#description" data-toggle="tab">Description</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="questions">
                    <?php if(isset($usersQuestionsAnswers)){
                        $usersQuestionsAnswers = json_decode(json_encode($usersQuestionsAnswers),true);
                        ?>

                        <?php foreach ($usersQuestionsAnswers as $key => $value) { ?>
                            <div class="post question-post <?= 'question-'.$value['questionID'];?>" data-id="<?= 'question-'.$value['questionID'];?>">
                                <div class="user-block">
                          <span class="username question-statement">
                          <a href="javascript:void(0)"><?= $value['Question']; ?></a>
                              <a href="javascript:void(0)" class="pull-right btn-box-tool question-edit"
                                 data-id="<?= 'question-' . $value['questionID']; ?>"
                                 data-question-id="<?= $value['questionID']; ?>"><i class="fa fa-pencil"></i></a>

                              <?php if (!empty($value['points'])) { ?>
                                  <span class="question-points"
                                        data-score="<?= $value['points']; ?>">(<?= $value['points']; ?>)</span>
                              <?php } else { ?>
                                  <span class="question-points"></span>
                              <?php } ?>
                          </span>
                                    <?php
                                    $possibleSolutions = $value['PossibleSolution'];
                                    $providedSolution = $value['ProvidedSolution'];
                                    if(!empty($possibleSolutions)){
                                        $possibleSolutions = json_decode($possibleSolutions);
                                        $type = $possibleSolutions->type;
                                        $hasChildren = $possibleSolutions->hasChildren;
                                        $hasChildren = $possibleSolutions->hasChildren;
                                    }
                                    if(!empty($providedSolution)){
                                        $providedSolution = json_decode($providedSolution,true);
                                    }
                                    ?>
                                </div>
                                <?php
                                    //Lets fetch just the provided solution
                                $solutionString = '';
                                switch ($type){
                                    case 'CheckBoxes':
                                        if(!empty($providedSolution['selectedCheckBoxes'])){
                                            foreach($providedSolution['selectedCheckBoxes'] as $selectedCheckBox){
                                                $solutionString.=' <span class="label label-info"><i class="fa fa-check"></i> '.$selectedCheckBox["checkBoxValue"].'</span>';
                                            }
                                        }
                                        break;
                                    case 'radios':
                                        if(!empty($providedSolution["selectedValue"])){
                                            $solutionString.=' <span class="label label-info"><i class="fa fa-dot-circle-o"></i> '.$providedSolution["selectedValue"].'</span>';
                                        }
                                        break;
                                    case 'SelectBox':
                                        if(isset($providedSolution['selectedSelectValue']) and !empty($providedSolution['selectedSelectValue'])){
                                            if(is_array($providedSolution['selectedSelectValue'])){
                                                foreach($providedSolution['selectedSelectValue'] as $selectedValue){
                                                    $solutionString.=' <span class="label label-info"> <i class="fa fa-list"></i> '.$selectedCheckBox["checkBoxValue"].'</span>';
                                                }
                                            }elseif(is_string($providedSolution['selectedSelectValue'])){
                                                $solutionString.=' <span class="label label-info"> <i class="fa fa-indent"></i> '.$providedSolution["selectedSelectValue"].'</span>';
                                            }

                                        }
                                        break;
                                }
                                ?>
                                <p class="answer-solution"><?= (isset($solutionString)?$solutionString:'') ?></p>
                                <div class="edit-question">
                                    <div class="form-group">
                                        <?php
                                        switch($type){
                                            case 'CheckBoxes':
                                                echo '<label>Please Select Answer</label>';
                                                $data = $possibleSolutions->data;
                                                echo '<div class="form-group">';
                                                if(isset($providedSolution['selectedCheckBoxes']) and !empty($providedSolution['selectedCheckBoxes'])){
                                                    $selectedCheckBoxes = $providedSolution['selectedCheckBoxes'];
                                                }
                                                foreach($data as $checkbox){
                                                    if(isset($selectedCheckBoxes) and in_array_r($checkbox->id,$selectedCheckBoxes) and in_array_r($checkbox->name,$selectedCheckBoxes)){
                                                        $checked = 'checked="checked"';
                                                    }else{
                                                        $checked = '';
                                                    }
                                                    ?>
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="<?=$checkbox->name?>" id="<?=$checkbox->id?>" <?=$checked?>>
                                                            <?=$checkbox->text?>
                                                        </label>
                                                    </div>
                                                    <?php
                                                }
                                                echo '</div>';
                                                break;
                                            case 'SelectBox':
                                                if(empty($possibleSolutions->textBoxText)){
                                                    echo '<label>Please Select Answer</label>';
                                                }else{
                                                    echo '<label>'.$possibleSolutions->textBoxText.'</label>';
                                                }
                                                $data = $possibleSolutions->data;
                                                ?>

                                                <select class="form-control <?=((isset($possibleSolutions->isMulti) && $possibleSolutions->isMulti === 'Yes')?'customSelect2':'')?>" <?=((isset($possibleSolutions->isMulti) && $possibleSolutions->isMulti === 'Yes')?'multiple="multiple"':'')?> style="width:100%">
                                                    <?php
                                                    if(!empty($data)){
                                                        foreach($data as $key => $selectOption){
                                                            if(in_array($selectOption->value,$providedSolution['selectedSelectValue'])){
                                                                $selected='selected="selected"';
                                                            }else{
                                                                $selected = '';
                                                            }

                                                            echo '<option value="'.$selectOption->value.'" '.(isset($selected)?$selected:'').'>'.$selectOption->text.'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <?php
                                                break;
                                            case 'radios':
                                                echo '<label>Please Select Answer</label>';
                                                $data = $possibleSolutions->data;
                                                echo '<div class="form-group">';
                                                if(isset($providedSolution['type']) and $providedSolution['type'] === 'radio'){
                                                    $selectedValue=$providedSolution['selectedValue'];
                                                    $selectedRadioID=$providedSolution['selectedRadioID'];
                                                }
                                                foreach($data as $radioButton){
                                                    if(isset($selectedRadioID) && ($radioButton->id === $selectedRadioID) && ($selectedValue=== $radioButton->value)){
                                                        $checked = 'checked="checked"';
                                                    }else{
                                                        $checked = '';
                                                    }
                                                    ?>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="radio_<?=$value['questionID']?>" id="<?=$radioButton->id?>" value="<?=$radioButton->value?>" <?=$checked?>>
                                                            <?=$radioButton->text?>
                                                        </label>
                                                    </div>
                                                    <?php
                                                }
                                                echo '</div>';
                                                break;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                    ?>
                </div>
                <div class="tab-pane" id="description">
                <ul class="timeline timeline-inverse">
                    <li>
                        <div class="timeline-item">
                          <h3 class="timeline-header">About:</h3>
                          <div id="short-desc-text" class="timeline-body">
                                <pre><?= trim(urldecode($about));?></pre>
                          </div>
                        </div>
                    </li>      
                </ul>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
<link rel="stylesheet" href="<?=base_url('assets/css/questions.css')?>">
<style type="text/css">
    div.checkbox{
        margin:0;
        padding:0;
        float: none;
    }
</style>
<script type="text/javascript">
    $(function () {
        $('.question-edit').on('click',function(){
           $(this).parents('.question-post').find('.edit-question').show();
        });

        /////////
        $('div.question-post').find('input[type="radio"],input[type="checkbox"], select').on('change',function(){
            var changedElement = $(this);
            var selectedQuestionID = $(this).parents('div.question-post').find('.question-edit').attr('data-question-id');

            var userID = "<?=$this->uri->segment(4);?>";

            var type = '';

            var postData = {
                qID:selectedQuestionID,
                userID:userID,
                listingID: 2
            };

            if($(this).parents('div.question-post').find('.radio').length > 0){
                var selectedRadio = changedElement.val();
                postData.selectedRadioValue = selectedRadio;
                postData.type='radio';
                postData.radioID = $(this).attr('id');
//                console.log('type is radio.');
            }else if ($(this).parents('div.question-post').find('.checkbox').length > 0){
                if($(this).is(':checked')){
                    postData.hasCheck = 'Yes';
                }else{
                    console.log('checkbox check has been Removed');
                    postData.hasCheck = 'No';
                };
                postData.type = 'checkbox';
                postData.checkBoxID = $(this).attr('id');
                postData.checkBoxValue = $(this).attr('name');
            }else if($(this).prop('tagName') === 'SELECT'){
                var selectedSelectValue = $(this).val();
                postData.type='select';
                postData.selectedValue = selectedSelectValue;
            }

            $.ajax({
                url:"<?=base_url();?>admin/question/updateUserAnswer",
                data:postData,
                type:"POST",
                success:function(output){
                    var data=output.trim().split('::');
                    if(data[0] === 'OK'){
                        Haider.notification(data[1],data[2]);
                    }else if(data[0] === 'FAIL'){
                        Haider.notification(data[1],data[2]);
                    }
                }
            });

        });
/*
        $('body').on('change','select',function(){
            console.log('Testing Again');
        });*/
    });
</script>
