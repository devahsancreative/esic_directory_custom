<?php 
if(!isset($ListingName) || empty($ListingName)){
    $ListingName = '';
}
if(!isset($ListingLabel) || empty($ListingLabel)){
    $ListingLabel = '';
}
if(!isset($ControllerRouteName) || empty($ControllerRouteName)){
    $ControllerRouteName = '';
}
?>
<style type="text/css">
    .centerLogo{
        text-align: center;
    }
     .img-logo{
            max-width: 350px;
            width: 100%;
            margin: 0 auto;
        }
        .img-logo img{
            width: 100%;
        }
        .btn-logo-edit{
            bottom: 0px;
            width: 100%;
            max-width: 200px;
            margin: 10px auto;
            background: rgba(0,0,0,0.5);
            color: #fff;
            cursor: pointer;
        }
</style>
    <!-- Content Header (Page header) -->
<section class="content-header">
        <h1>
            <?= $ListingLabel ; ?>
            <small>Add</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url()?>admin"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#"><?= $ListingLabel ; ?></a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <?php 
    if(isset($id) && !empty($id)){
        $id = $id;
    }else{
        return 'Sorry No ID Set';
    }
    if(isset($data) && !empty($data)){
    $name       = $data->name; 
    $phone      = $data->phone; 
    $website    = $data->website; 
    $email      = $data->email; 
    $address    = $data->address; 
    
    $keywords   = $data->keywords; 
    $banner     = $data->banner; 
    $logo       = $data->logo; 

    $short_description  = $data->short_description; 
    $long_description   = $data->long_description; 

    }else{

        $name       = ''; 
        $phone      = ''; 
        $website    = ''; 
        $email      = ''; 
        $address    = ''; 
        $keywords   = ''; 
        $banner     = ''; 
        $logo       = ''; 

        $short_description  = ''; 
        $long_description   = ''; 
    }


    ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add <?= $ListingLabel ; ?></h3>
                            <div class="add-New-container">
                                <a href="<?= base_url().$ControllerRouteName.'/Listing'?>" class="btn addNewBtn btn-primary">Go To Listing</a>
                                <a href="<?= base_url().$ControllerRouteName.'/Edit/'.$id;?>" class="btn addNewBtn btn-primary">Edit</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <input type="hidden" id="hiddenListID" value="">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="NameTextBox">Name:</label>
                                        <input type="text" name="Name" id="NameTextBox" value="<?= $name;?>" class="form-control" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="PhoneTextBox">Cell/Phone:</label>
                                        <input type="text" name="Phone" id="PhoneTextBox" value="<?= $phone;?>" class="form-control" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="EmailBox">Email:</label>
                                        <input type="text" name="Email" id="EmailBox" value="<?= $email;?>" class="form-control" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="WebsiteBox">Website:</label>
                                        <input type="text" name="Website" id="WebsiteBox" value="<?= $website;?>" class="form-control" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="AddressBox">Address:</label>
                                        <input type="text" name="Address" id="AddressBox" value="<?= $address;?>" class="form-control" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="ShortDescriptionBox">Short Description:</label>
                                        <textarea type="text" name="ShortDescription" id="ShortDescriptionBox" class="form-control" readonly><?= $short_description ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="LongDescriptionBox">Detail Description:</label>
                                        <textarea type="text" name="LongDescription"  id="LongDescriptionBox" class="form-control" readonly><?= $long_description ?> </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="KeywordsBox">Keywords:</label>
                                        <input type="text" name="Keywords" id="KeywordsBox" value="<?= $keywords;?>" class="form-control" readonly />
                                    </div>
                                    <?php if(!empty($logo)){ ?>
                                        <div class="form-group">
                                            <label for="update-logo-file">Logo:</label>
                                            <div class="img-reponsive">
                                                <div class="img-container img-logo img-responsive">
                                                    <img src="<?= base_url().$logo;?>" class="logo-show" id="Logo-show" />
                                                </div>
                                           </div>
                                        </div>
                                    <?php }?>
                                    <?php if(!empty($banner)){ ?>
                                    <div class="form-group">
                                        <label for="update-Banner-file">Banner</label>
                                        <div class="img-reponsive">
                                            <div class="img-container img-logo img-responsive">
                                                <img src="<?= base_url().$banner;?>" class="banner-show" id="banner-show" />
                                            </div>
                                       </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div> <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="button-container">
                                <input type="hidden" name="id" value="<?= $id;?>" />
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</section>
    <!-- /.content -->
    <script src='<?php  echo base_url()?>assets/tinymce/js/tinymce/tinymce.min.js'></script>
<script src='<?php  echo base_url()?>assets/tinymce/js/tinymce/plugins/jbimages/plugin.min.js'></script>
<!--//<script src='<?php /* echo base_url()*/?>assets/tinymce/js/tinymce/plugins/imageUpload.js'></script>-->
<script>
 tinymce.init({
  selector: 'textarea',
  readonly : 1,
  height: 400,
  menubar: false,
  browser_spellcheck : true,
  contextmenu: false,
  toolbar: false
});
</script>