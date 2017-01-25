<?php echo $header; ?>

<style>
.btn{
    float: left !important;
    margin-right: 2px !important;
}
</style>
<div class="container-fluid">

    <div class="row">

        <div class="col-lg-12">

            <h1 class="page-header">

                <?php echo $this->lang->line('user_header'); ?>

            </h1>

            <ol class="breadcrumb">

                <li>

                <i class="fa fa-dashboard"></i>

                	<a href="/admin"><?php echo $this->lang->line('nav_dash'); ?></a>

                </li>

                <li class="active">

                <i class="fa fa-fw fa-user"></i>

                	<a href="/admin/users"><?php echo $this->lang->line('user_header'); ?></a>

                </li>

            </ol>

        </div>

    </div>

</div>
  
<div class="container-fluid">

  	<div class="row">

      	<div class="col-md-12">
<form method="post" action="<?= BASE_URL.'/admin/users/email';?>">
			<table class="table table-striped table-bordered">

                <thead>
<tr>
      <th>
       
                      
      	 <select name="example1_length" aria-controls="example1" class="form-control input-sm">
             <option value="">Send Email</option>
             <option value="">Delete Users</option>
        </select> 
        </th>
        <th>
        
        <button class="btn btn-primary btn-small">Send</button>
         </th>
</tr>
                  <tr>
                    <th>
                      
                       <input type="checkbox" name="select_all" class="checkbox" id="select_all">
                        
                      </th>
                    <th> <?php echo $this->lang->line('user_username'); ?> </th>

                    <th> Role </th>

                    <th> <?php echo $this->lang->line('user_email'); ?> </th>

                    <th class="td-actions">  </th>

                  </tr>

                </thead>

                <tbody>

                    <?php 

					foreach ($users as $u) {

						echo '<tr>';
                        echo '<td>' ?> 
                        <input type="checkbox" name="checked_id[]" class="checkbox" value="<?= $u['email'] ?>" >
                        
                        <?php echo '</td>';
						echo '<td>'.$u['userName'].'</td>';

            echo '<td>'.$u['usersRoleLabel'].'</td>';

						echo '<td>'.$u['email'].'</td>';

						echo '<td class="td-actions">';
						?>
                      
                        
                         <form method="post" action="<?= BASE_URL.'/admin/users/email';?>">
                         <input type="hidden" name="emailss" class="" value="<?= $u["email"]; ?>">
						 <button class="btn btn-primary btn-small"><i class="fa fa-envelope-o"> </i></button>  
                      
                         </form>
						<?php echo '<a href="'.BASE_URL.'/admin/users/edit/'.$u['userID'].'" class="btn btn-small btn-success"><i class="fa fa-pencil"> </i></a> <a data-toggle="modal" data-target="#ajaxModal" class="btn btn-danger btn-small" href="'.BASE_URL.'/admin/users/delete/'.$u['userID'].'"><i class="fa fa-remove"> </i></a></td>';

						echo '</tr>';

					} ?>
              
                </tbody>

              </table>
</form>
              <?php echo $this->pagination->create_links(); ?>

        	</div>

      </div>

 </div>

<?php echo $footer; ?>

<script>
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>