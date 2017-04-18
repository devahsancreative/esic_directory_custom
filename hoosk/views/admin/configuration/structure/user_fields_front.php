<?php
    if(isset($CurrentUserData) && !empty($CurrentUserData)){
        $ReadyOnlyFlag = 'readonly';
        $userRole   = $CurrentUserData['userRole'];
        $Username   = $CurrentUserData['userName'];
        $UserEmail  = $CurrentUserData['Email'];
        $FirstName  = $CurrentUserData['firstName'];
        $LastName   = $CurrentUserData['lastName'];
        $UserPhone  = $CurrentUserData['phone'];
    }else{
        $ReadyOnlyFlag = '';
        $Username   = '';
        $UserEmail  = '';
        $FirstName  = '';
        $LastName   = '';
        $UserPhone  = '';   
    }
?>

<div class="col-md-12">
    <label for="UserDetailBox">User Details :</label>
    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="form-group">
            <label for="UsernameTextBox">Username</label>
            <input type="text" name="Username" id="UsernameTextBox" class="form-control" <?=$ReadyOnlyFlag; ?> value="<?= $Username;?>" />
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="form-group">
            <label for="UserEmailBox">Email</label>
            <input type="text" name="UserEmail" id="UserEmailBox" class="form-control" <?=$ReadyOnlyFlag; ?> value="<?= $UserEmail;?>" />
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="form-group">
            <label for="FirstNameTextBox">First Name</label>
            <input type="text" name="FirstName" id="FirstNameTextBox" class="form-control" <?=$ReadyOnlyFlag; ?> value="<?= $FirstName;?>"/>
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="form-group">
            <label for="LastNameTextBox">Last Name</label>
            <input type="text" name="LastName" id="LastNameTextBox" class="form-control" <?=$ReadyOnlyFlag; ?> value="<?= $LastName;?>" />
        </div>
    </div>
    <div class="col-xs-12 col-sm-4 col-md-3">
        <div class="form-group">
            <label for="UserPhoneTextBox">Phone</label>
            <input type="text" name="UserPhone" id="UserPhoneTextBox" class="form-control" <?=$ReadyOnlyFlag; ?> value="<?= $UserPhone;?>" />
        </div>
    </div>
</div>
