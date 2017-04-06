      
    </section>
    <!-- /.content -->
</div>


<!--Edit Ward Modal-->
<div class="modal logo-edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update <?= $ListingLabel; ?> Logo</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" id="hiddenUserID">
                            <input type="hidden" id="hiddenID">
                            <label for="editStatusTextBox">Update <?= $ListingLabel; ?></label>
                            <div class="img-container img-logo img-responsive">
                                <img src="dummy" class="image-show" id="logo-show" />
                            </div>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-file btn-logo-edit"><span class="fileupload-new">Click To</span><span class="fileupload-exists"> Edit</span>
                                    <input id="update-logo-file" type="file" name="logo" />
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger mright" id="updateLogo">Save</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->
<script type="text/javascript" src="<?php echo ADMIN_THEME; ?>/js/noty/packaged/jquery.noty.packaged.js"></script>
   <!-- Custom Notifications From Haider Plugin -->
<script type="text/javascript" src="<?php echo ADMIN_THEME; ?>/js/Haider.js"></script>
<script  type="text/javascript" >
    var ControllerName = '<?= $ControllerRouteName;?>';
    var ControllerRouteManage = '<?= $ControllerRouteManage;?>';
    $(document).ready(function() {
       <?php 
        if(isset($return) && !empty($return)){
           foreach ($return as $key => $value) {
            $data = explode('::', $value);
            echo  'Haider.notification("'.$data[1].'","'.$data[2].'");';
           }
       }
       ?>
    });
</script>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://ctsdemo.com/demos/esic_directory/assets/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="https://ctsdemo.com/demos/esic_directory/assets/tinymce/js/tinymce/plugins/jbimages/plugin.min.js"></script>
<!--script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js'></script-->
<script src='<?= base_url();?>assets/vendors/select2/js/select2.js'></script>
<script src='<?= base_url();?>assets/js/listing.js'></script>