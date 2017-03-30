<?php echo $header; ?>
<style>
    #mydiv
    {
        padding: 5px;
        width: 47%;
        border-radius: 3px;
        text-align: center;
    }
    </style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('social_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="<?= base_url()?>admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-share-alt"></i>
                	<a href="#"><?php echo $this->lang->line('social_header'); ?></a>
                </li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
  	<div class="row">
      	<div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-share-alt fa-fw"></i>
                    <?php   echo $this->lang->line('social_header'); ?>

                </h3>
            </div>
         	<div class="panel-body">
            	<?php echo $this->lang->line('social_message'); ?>
            </div> 
          </div>
            <div class="" id="mydiv">
                <!--here display success message -->
            </div>
            <div class="panel panel-default">
			<div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-share-alt fa-fw"></i>
                    <?php //echo $this->lang->line('social_header'); ?>
                    Social Site Login Settings
                </h3>
               </div>
   <div class="panel-body">
                <?php if($this->session->userdata('msg')){?>
                    <div class="alert alert-success"><?php echo $this->session->userdata('msg');
                        $this->session->unset_userdata('msg');
                        ?>
                    </div>
               <?php } ?>
       <div class="form-group social_data">
           <div class="row">
               <?php foreach($fb_data as $fb_data){ ?>
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                   <label for="Name">Facebook Api Key (for Facebook login)</label>
                   <input id="fb_id" name="" type="text"  value ="<?= $fb_data['api_id']; ?>" placeholder="Facebook Api Key" class="form-control"
                            />
               </div>
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                   <label for="Name">Facebook secret code (for Facebook login)</label>
                   <input id="fb_sec" name="" type="text"  value ="<?= $fb_data['api_key'];?>" placeholder="Facebook secret code" class="form-control"
                          />
               </div>
               <?php } ?>
           </div>
       </div>






  </div>
            <div class="panel-footer">

                <input type="Button" id="update_socail" class="btn btn-primary" value="Update" >
             </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-share-alt fa-fw"></i>
                        <?php //echo $this->lang->line('social_header'); ?>
                        Social Site Links
                    </h3>
                </div>
                <div class="panel-body">
                    <?php echo form_open(BASE_URL.'/admin/social/update'); ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th> <?php echo $this->lang->line('social_table_title'); ?> </th>
                            <th> <?php echo $this->lang->line('social_table_link'); ?> </th>
                            <th> <?php echo $this->lang->line('social_table_enabled'); ?> </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($social as $s){ ?>
                            <tr>
                                <td><?php echo $this->lang->line('social_'.$s['socialName']); ?></td>
                                <td><?php 	$data = array(
                                        'name'        => $s['socialName'],
                                        'id'          => $s['socialName'],
                                        'class'       => 'form-control ',
                                        'value'		=> set_value($s['socialName'], $s['socialLink'], FALSE)
                                    );

                                    echo form_input($data); ?></td>
                                <td><input type="checkbox" value="1" name="checkbox<?php echo $s['socialName']; ?>" <?php if ($s['socialEnabled']==1){ echo " checked ";} ?>></td>
                            </tr>


                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <?php 	$data = array(
                        'name'        => 'submit',
                        'id'          => 'submit',
                        'class'       => 'btn btn-primary',
                        'value'		=> $this->lang->line('btn_save'),
                    );
                    echo form_submit($data); ?>
                    <?php echo form_close();
                    ?>
                </div>
            </div>
        </div>
     </div>
 </div>
<?php echo $footer; ?>
<script>
    $(function () {
    $("#update_socail").on("click", function () {
        var fb_id = $("#fb_id").val();
        var fb_sec = $("#fb_sec").val();
        var postData = {id: fb_id, fb_sec: fb_sec};
        $.ajax({
            url: baseUrl + "admin/social_creaditional",
            data: postData,
            type: "POST",
            success: function (output) {
                $('#mydiv').addClass('.alert alert-success');
                $('#mydiv').html('Your Information  updated Successfully!').show().delay(5000).fadeOut(3000);



            }
        });
    });
    });
    </script>
