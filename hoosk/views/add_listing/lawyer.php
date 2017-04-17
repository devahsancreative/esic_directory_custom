<style type="text/css">
    .ShowPrevious2CategoriesDiv {
        background: rgba(66, 66, 66, .1);
        margin-top: 8px;
        padding: 10px;
        display: none
        border-radius: 10px;
        display: none;
    }

    .ShowPrevious2CategoriesDiv .addBtn {
        margin-top: 3px;
    }

    .ShowInnovationDiv {
        background: rgba(66, 66, 66, .1);
        margin-top: 8px;
        padding: 10px;
        display: none
        border-radius: 10px;
        display: none;
    }

    .ShowInnovationDiv .addBtn {
        margin-top: 3px;
    }

    .ShowRightDiv {
        background: rgba(66, 66, 66, .1);
        margin-top: 8px;
        padding: 10px;
        display: none
        border-radius: 10px;
        display: none;
    }

    .ShowInnovationDiv .addBtn {
        margin-top: 3px;
    }

    #mainFormDiv {
        /*background-color: #424242;*/
        background-color: #ffffff; /*added by Hamid Raza*/
        box-shadow: 0 0 9px rgba(0, 0, 0, 0.3);
    }

    #loading-submit {
        display: none;
        background: rgba(0, 0, 0, 0.50);
        z-index: 9999;
        width: 100%;
        height: 100%;
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        text-align: center;
    }

    #loading-submit img {
        padding-top: 20%;
    }

    #form1 legend {
        color: #fff;
    }

    .modal select {
        min-height: 25px;
        max-width: 300px;
        display: block;
    }

    body {
        background-color: #f7f7f7;
    }

    input[type=checkbox], input[type=radio] {
        margin: 2px;
    }

    #SaveAccount {
        margin-right: 15px;
        padding: 5px 30px 5px 30px;
    }

    .wrap {
        margin-bottom: 20px;

    }

    #main-wrap {
        background-color: #f7f7f7 !important;

    }

    #main-content {

        background: none !important;

    }

    #banner, .container:before { /* added for logo style*/
        content: inherit !important;
    }

    #banner-inner {
        width: 100% !important;
    }

    @media only screen and (min-width: 1026px) and (max-width: 1200px) {
        #nav-wrap ul li {
            display: inline-block !important;
            float: left !important;
        }

    }

    @media only screen and (max-width: 1200px) {

        .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
            margin-top: 10px !important;
            margin-bottom: 10px !important;
        }

    }

</style>
<div class="clear"></div>
<div class="row wrap">
    <div class="col-lg-12" id="mainFormDiv">

        <form id="SignupForm" action="<?php echo base_url('Reg2/submit') ?>" method="post" enctype="multipart/form-data"
              data-url="<?= base_url(); ?>">
            <div id="form1">
                <fieldset>
                    <legend>Add Lawyer to Listing</legend>
                    <p style="text-align: center">
                        Any new Lawyer added to the listing will only be visible once moderated and approved from Admin.
                    </p>
                    <div class="col-lg-6 col-md-12">
                        <label for="lawyerName">Name<span class="required-fields">*</span></label>
                        <div class="form-group">
                            <input id="lawyerName" name="lawyerName" type="text"
                                   value="<?php echo set_value('lawyerName'); ?>" placeholder="Full Name"
                                   class="form-control"
                                   required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="lawyerPhone">Phone<span class="required-fields">*</span></label>
                        <div class="form-group">
                            <input id="lawyerPhone" name="lawyerPhone" type="text"
                                   value="<?php echo set_value('lawyerPhone'); ?>" placeholder="Phone"
                                   class="form-control"
                                   required/>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="Email">Email<span class="required-fields">*</span></label>
                        <div class="form-group ">

                            <input id="Email" name="email" type="email" class="form-control"
                                   placeholder="xyz@example.com"
                                   value="<?php echo set_value('email'); ?>" required/>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <label for="Website">Website Address</label>
                        <div class="form-group">
                            <input id="Website" name="website" type="text"
                                   value="<?php echo set_value('website'); ?>" class="form-control"
                                   placeholder=" www.example.com" required/>
                        </div>
                    </div>

                    <label for="Address">Address</label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <input id="street_number" name="street_number"
                                       value="<?php echo set_value('street_number'); ?>" type="text"
                                       class="form-control" placeholder="Street Number"/>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <input id="Address" name="address" type="text"
                                       value="<?php echo set_value('address'); ?>" class="form-control"
                                       placeholder="Street Name"/>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <input id="town" name="town" type="text"
                                       value="<?php echo set_value('town'); ?>" class="form-control"
                                       placeholder="Town"/>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <input id="state" name="state" type="text" class="form-control"
                                       value="<?php echo set_value('state'); ?>" placeholder="State"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12" style="margin-top:10px">
                                <input id="post_code" name="post_code"
                                       value="<?php echo set_value('post_code'); ?>" type="text" class="form-control"
                                       placeholder="Post Code"/>
                            </div>
                        </div>
                    </div>
                    <label for="tinyDescription">Short Description</label>
                    <div class="form-group">
                        <textarea id="tinyDescription" class="form-control" name="tinyDescription"></textarea>

                    </div>

                    <label for="shortDescription">Detail Description</label>
                    <div class="form-group">
                        <textarea id="shortDescription" class="form-control" name="shortDescription"></textarea>
                    </div>
                </fieldset>
            </div>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>
</div>

