<?php
if(isset($keyword)){
    $keyword = $keyword;
}else{
    $keyword = '';
}


?>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css"  href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.24/daterangepicker.min.css"/>
<script type="text/javascript"  src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.24/moment.min.js"></script>
<script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.24/daterangepicker.min.js"></script>
<div class="container" style="margin-top: 90px;">
	<h1>Search Results For <?php if(isset($Title)){ echo $Title; } ?></h1>
	<div class="search-filter-container">
		<div class="filter-heading">
          	<h3>Filter By:</h3>
        </div>
        <div class="range-filters">
        	<label>Added Date</label>
            <form>
	            <input type="text" name="value_from_start_date"  class="form-control" data-datepicker="separateRange" placeholder="Start" value="<?= $filterStartDate; ?>"/>
	            <span><strong>To</strong></span>
	            <input type="text" name="value_from_end_date"  class="form-control" data-datepicker="separateRange" placeholder="End"  value="<?= $filterEndDate; ?>"/>
            </form>
            <label>Status</label>
            <form>
	          <select id="statusFilter" name="status" class="form-control" >
	            <option value="">-- Select --</option>
	          	<option value="0">Pending</option>
	          	<option value="1">Publish</option>
	          </select>
            </form>
        </div>
    </div>
	<div class="search-results-container">
		<div class="header_search item-container clearfix">
			<form id="searchForm" action="results_investors" method="post" accept-charset="utf-8">
	            <input type="text" name="keyword" class="form-control" placeholder="Investors" value="<?= $keyword ?>">
	            <input type="hidden" name="resultsFor" value="Investors">
	            <input type="hidden" id="filterStartDate" name="filterStartDate" value="">
	            <input type="hidden" id="filterEndDate"   name="filterEndDate" 	value="">
	            <input type="hidden" id="statusFilterField" name="statusFilter" value="">
	            <input type="button" value="" class="form-control submit-icon" >
	        </form>
        </div>
	<?php if(isset($Query)){ echo $Query; } ?>
	<?php 
	  if(isset($list) && !empty($list)){
	  	  foreach ($list as $key => $item) { 
	?>
	  		<div class="item-container clearfix">
                <div class="item-container-top clearfix">
	                <div class="status-container">
	                    <?php 
	                      	switch($item->status) {
	                      		case  0:
	                      			echo '<span class="label status label-danger">Pending</span>';
	                      		break;
	                      		default:
	                      			echo '<span class="label status label-success">Published</span>';
	                      		break;
	                      	}
	                    ?>	    
	                </div>
                    <div class="Title">
                        <h2>
                           <a href="#"><?= $item->firstName.' '.$item->lastName; ?></a>
                        </h2>
                    </div>
                </div>
                <div class="item-container-middle">
	                <div class="logo-image">
	                    <?php if(!empty($item->image)){ ?>
	                          	<img src="<?= base_url().'uploads/investor/'.$item->image?>" alt="" title="" border="0" />
	                    <?php }else{ ?>
	                    	  	<img src="<?= base_url().'/pictures/defaultLogo.png'; ?>" alt="" title="" border="0" />
	                    <?php } ?>
	                </div>
                </div>  
                <div class="item-container-bottom">          
	                <div class="item-meta">
	                      <?php if($item->email){ ?> 
		                  <p class="email"><strong>Email: </strong><?= $item->email; ?></p>
		                  <?php } ?>
		                  <?php if($item->company_name){ ?> 
		                  <p class="company-name"><strong>Company Name: </strong><?= $item->company_name; ?></p> 
		                  <?php } ?>
		                  <?php if($item->company_email){ ?> 
		                  <p class="company-email"><strong>Company Email: </strong><?= $item->company_email; ?></p> 
		                  <?php } ?>
		                  <?php if($item->added_date){ ?> 
		                  <p class="added-date"><strong>Added Date: </strong><?= $item->added_date; ?></p> 
		                  <?php } ?>
		                  <?php if($item->address){ ?> 
		                  <p class="address"><strong>Address: </strong><?= $item->address; ?></p> 
		                  <?php } ?>
		            </div>                                
		            <div class="descriptions">
		            	<label for="">Descriptions</label>
		                <p class="desc"> <?= $item->about;?> </p>
		            </div>
		            <div class="social">

		            </div>
		        </div>
            </div>
	<?php 
	  		}
	  	} 
	?>

	 </div>
</div>


<script>
    var separator = ' - ', dateFormat = 'YYYY-MM-DD';
    var options = {
        autoUpdateInput: false,
        locale: {
            format: dateFormat,
            separator: separator
        },

        opens: "right"
    };


    $('[data-datepicker=separateRange]')
        .daterangepicker(options)
        .on('apply.daterangepicker' ,function(ev, picker) {
            var boolStart = this.name.match(/value_from_start_/g) == null ? false : true;
            var boolEnd = this.name.match(/value_from_end_/g) == null ? false : true;

            var mainName = this.name.replace('value_from_start_', '');
            if(boolEnd) {
                mainName = this.name.replace('value_from_end_', '');
                $(this).closest('form').find('[name=value_from_end_'+ mainName +']').blur();
            }

            $(this).closest('form').find('[name=value_from_start_'+ mainName +']').val(picker.startDate.format(dateFormat));
            $(this).closest('form').find('[name=value_from_end_'+ mainName +']').val(picker.endDate.format(dateFormat));

            $(this).trigger('change').trigger('keyup');

            $('#filterStartDate').val(picker.startDate.format(dateFormat));
            $('#filterEndDate').val(picker.endDate.format(dateFormat));
            var statusFilter = $('#statusFilter').val();
            $('#statusFilterField').val(statusFilter);
            $('#searchForm').submit();


        })
        .on('show.daterangepicker', function(ev, picker) {
            var boolStart = this.name.match(/value_from_start_/g) == null ? false : true;
            var boolEnd = this.name.match(/value_from_end_/g) == null ? false : true;
            var mainName = this.name.replace('value_from_start_', '');
            if(boolEnd) {
                mainName = this.name.replace('value_from_end_', '');
            }

            var startDate = $(this).closest('form').find('[name=value_from_start_'+ mainName +']').val();
            var endDate = $(this).closest('form').find('[name=value_from_end_'+ mainName +']').val();

            $('[name=daterangepicker_start]').val(startDate).trigger('change').trigger('keyup');
            $('[name=daterangepicker_end]').val(endDate).trigger('change').trigger('keyup');

            if(boolEnd) {
                $('[name=daterangepicker_end]').focus();
            }
        });

        $('.submit-icon').click(function(event) {
        	var statusFilter = $('#statusFilter').val();
        	$('#filterStartDate').val($('input[name="value_from_start_date"]').val());
            $('#filterEndDate').val($('input[name="value_from_end_date"]').val());
             $('#statusFilterField').val(statusFilter);
            $('#searchForm').submit();
        });

        $('#statusFilter').change(function(e){
        	var statusFilter = $(this).val();
        	$('#filterStartDate').val($('input[name="value_from_start_date"]').val());
            $('#filterEndDate').val($('input[name="value_from_end_date"]').val());
            $('#statusFilterField').val(statusFilter);
            $('#searchForm').submit();
        });
        

</script>