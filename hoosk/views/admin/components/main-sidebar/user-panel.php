<div class="user-panel">
    <div class="pull-left image">

        <?php $userRole = $this->session->userdata('userRole');
        $userID = $this->session->userdata('userID');

        //Get Image Path
        $imagePath = get_user_image($userRole, $userID);  ?>

        <img src="<?= $imagePath ?>" id="Profile_image" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p> <?php echo $this->session->userdata('userName'); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>
