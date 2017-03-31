 <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Powered By <a href="http://creativetech-solutions.com/" target="_blank">Creativetech-Solutions</a>.</strong>
</footer>

<?php
    if($this->router->fetch_method() === 'assessments_list' || $this->router->fetch_method() === 'details'|| $this->router->fetch_method() === 'index')
    {
?>

<!--Edit Ward Modal 1-->
<div class="modal approval-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Esic Status</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        	<input type="hidden" id="hiddenUserID">
                            <input type="hidden" id="hiddenID">
                            <label for="editStatusTextBox">Update the Pre-Assessment Esic Status</label>
                            <select id="editStatusTextBox" name="editStatusTextBox" style="width: 80%;">
                                    <option value="0">Select...</option>
                                     <?php
                                        $esic_status_all = $this->Common_model->select('esic_status');
                                        if(isset($esic_status_all) and !empty($esic_status_all)){
                                            foreach($esic_status_all as $esicstatus){
                                                 echo '<option value="'.$esicstatus->id.'">'.$esicstatus->status.'</option>';
                                             }
                                        }
                                    ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger mright" id="saveStatus" data-id="">Save</button>
                <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->

<!--Edit Ward Modal-->
<div class="modal publish-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Publish Esic</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Are You Sure To Publish This Entry?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="yesPublish">Yes</button>
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close">No</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->
<!--Edit Ward Modal-->
<div class="modal unpublish-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">UnPublish Esic</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Are You Sure To UnPublish This Entry?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="yesUnPublish">Yes</button>
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close">No</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->


<!--Edit Ward Modal 2-->
<div class="modal delete-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Deleted Status</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Are You Sure To Delete This Entry?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close" id="nodelete">No</button>
                <button type="button" class="btn btn-success" id="yesDelete">Yes</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->

<?php
    }
    else if($this->router->fetch_method() === 'manage_status') {
?>

<style>
.modal select{
    min-height: 25px;
    max-width: 300px;
    display: block;
  }
</style>
<!--Edit Ward Modal 2-->
<div class="modal approval-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Esic Status</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Do You Want To Delete This Status?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="yesApprove">Yes</button>
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close" id="nodelete">No</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->
<?php
    }
    else if($this->router->fetch_method() === 'manage_appstatus') {
?>

<style>
.modal select{
    min-height: 25px;
    max-width: 300px;
    display: block;
  }
</style>
<!--Edit Ward Modal 3-->
<div class="modal approval-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Esic ABR Status</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Do You Want To Delete This ABR Status?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="yesApprove">Yes</button>
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close" id="nodelete">No</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->
<?php
    }
    else{
?>
<style>
.modal select{
    min-height: 25px;
    max-width: 300px;
    display: block;
  }
</style>
<!--Edit Ward Modal 4-->
<div class="modal approval-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Trashed Model</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Do You Want To Trash This Status?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" aria-label="Close" id="permanentDelete">Delete Permanent</button>
                <button type="button" class="btn btn-success" id="yesApprove">Yes</button>
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close" id="nodelete">No</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->

<!--Edit Acceleration Modal-->
<div class="modal permanent-modal" id="permanent-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Permanent Model</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenID">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" id="hiddenUserID">
                            <label for="editrndTextBox">Are You Sure you want to make it Permanent?</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="yesPermanent">Yes</button>
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close" id="noPermanent">No</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->

<!--Edit ABR Modal-->
<div class="modal abr-modal" id="abr-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Australian Business Registration (Commonwealth of Australia)</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenID">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" id="hiddenUserID">
                            <label for="editAbrTextBox">Please Change ABR Status: </label>
                            <select id="editAbrTextBox" name="editAbrTextBox" style="width: 80%;">
                                    <option value="0">Select...</option>
                                    <?php
                                        $statusApp = $this->Common_model->select('esic_appstatus');
                                        if(isset($statusApp) and !empty($statusApp)){
                                            foreach($statusApp as $statusApp){
                                                 echo '<option value="'.$statusApp->id.'">'.$statusApp->status.'</option>';
                                             }
                                        }
                                    ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="yesSaveAbr">Yes</button>
                <button type="button" class="btn btn-danger mright" data-dismiss="modal" aria-label="Close" id="noSaveAbr">No</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->
<?php } ?>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.jasny/3.13/css/jasny-bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />


<!-- jQuery 2.2.3 -->
<script src="<?= base_url()?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->

<!-- FastClick -->
<script src="<?= base_url()?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url()?>plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url()?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url()?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?= base_url()?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?= base_url()?>plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url()?>dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url()?>dist/js/demo.js"></script>

<!-- jQuery 3.1.1 -->
<!--script src="https://code.jquery.com/jquery-3.1.1.js"></script-->
<!-- jQuery migrate-3.0.0 -->
<!--script src="https://code.jquery.com/jquery-migrate-3.0.0.js"></script-->
<!-- jQuery 1.12.4 -->
<!--script src="https://code.jquery.com/jquery-1.12.4.js"></script-->
<!-- jQuery 2.2.4 -->
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<!-- jQuery 2.2.3 -->
<!--script src="<?= base_url()?>assets/vendors/jQuery/jquery-2.2.3.min.js"></script-->
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url()?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url()?>assets/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url()?>assets/vendors/datatables/dataTables.responsive.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url()?>assets/vendors/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url()?>assets/vendors/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>assets/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url()?>assets/js/demo.js"></script>
<script src="<?= base_url()?>assets/js/customScripting.js"></script>
<script src="<?= base_url()?>assets/js/jquery.iframe-post-form.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/bootstrap.jasny/3.13/js/jasny-bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<!--script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.fileupload/9.9.0/js/jquery.fileupload.js"></script-->

<script> var baseUrl = "<?= base_url() ?>"; </script>

<?php if ($this->router->fetch_method() === 'assessments_list' or $this->router->fetch_method() === 'index') { ?>

    <script src="<?= base_url()?>assets/js/adminfooter.js"></script>

<?php } if( $this->router->fetch_method() === 'details'){ ?>

    <script type="text/javascript" src="<?=base_url()?>assets/vendors/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url()?>assets/js/admin-detail.js"></script>

<?php } if ($this->router->fetch_method() === 'manage_sectors') { ?>

    <script src="<?= base_url()?>assets/js/admin-sectors.js"></script>

<?php } if ($this->router->fetch_method() === 'manage_rd') { ?>

    <script src="<?= base_url()?>assets/js/admin-rnd.js"></script>

<?php } if ($this->router->fetch_method() === 'manage_accelerators') { ?>

    <script src="<?= base_url()?>assets/js/admin-accelerators.js"></script>

<?php } if ($this->router->fetch_method() === 'manage_universities') { ?>

    <script src="<?= base_url()?>assets/js/admin-universities.js"></script>

<?php } if ($this->router->fetch_method() === 'manage_acc_commercials') { ?>

    <script src="<?= base_url()?>assets/js/admin-acc.js"></script>

<?php } if ($this->router->fetch_method() === 'manage_status') { ?>

    <script src="<?= base_url()?>assets/js/admin-status.js"></script>

<?php } if ($this->router->fetch_method() === 'manage_appstatus') { ?>

    <script src="<?= base_url()?>assets/js/admin-appstatus.js"></script>
    

<?php } ?>
 <script>
 $(document).ready(function(){
    $(".sidebar-toggle").click(function(){
        $("body").toggleClass("sidebar-collapse");
    });
});
 </script>
</body>
</html>