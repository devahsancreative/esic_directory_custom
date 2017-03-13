<?php echo $header; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('menu_new_nav'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                <i class="fa fa-dashboard"></i>
                	<a href="<?= base_url()?>admin"><?php echo $this->lang->line('nav_dash'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-list-alt"></i>
                	<a href="<?= base_url()?>admin/navigation"><?php echo $this->lang->line('menu_header'); ?></a>
                </li>
                <li class="active">
                <i class="fa fa-fw fa-pencil"></i>
                	<?php echo $this->lang->line('menu_new_pages'); ?>
                </li>
            </ol>
        </div>
    </div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
           <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-pencil fa-fw"></i>
                    <?php  echo $this->lang->line('menu_new_pages'); ?>
                </h3>
            </div>
            <div class="panel-body">
             <?php 
		 
			 
			 foreach ($nav as $n) { ?>
             <div class="form-group">
              
					<?php $attr = array('id' => 'navForm');
					echo form_open('admin/navigation/update/'.$n['navSlug'], $attr); ?>

					<label class="control-label" for="pageTitle"><?php echo $this->lang->line('menu_new_nav_slug'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'navSlug',
						  'id'          => 'navSlug',
						  'class'       => 'form-control URLField disabled',
						  'disabled'	=> '',
						  'value'		=> set_value('navSlug', $n['navSlug'])
						);

						echo form_input($data); ?>
					</div> <!-- /controls -->
				</div> <!-- /form-group -->

                 <div class="form-group">
            		<?php echo form_error('navTitle', '<div class="alert">', '</div>'); ?>
					<label class="control-label" for="navTitle"><?php echo $this->lang->line('menu_new_nav_title'); ?></label>
					<div class="controls">
                    <?php 	$data = array(
						  'name'        => 'navTitle',
						  'id'          => 'navTitle',
						  'class'       => 'form-control',
						  'value'		=> set_value('navTitle', $n['navTitle'])
						);

						echo form_input($data); ?>
					</div> <!-- /controls -->
				</div> <!-- /form-group -->
               	<hr />
                <h3><?php echo $this->lang->line('menu_new_add_page'); ?></h3>
                <hr />
             <div class="form-group">
					<label class="control-label" for="pagesList"><?php echo $this->lang->line('menu_new_select_page'); ?></label>
					<div class="controls">

                       <?php $att = 'id="pagesList" class="form-control"';
				$data = array();
				foreach ($pages as $p){
				$data[$p['pageURL']] = $p['navTitle'];
				}
				echo form_dropdown('pagesList', $data, '1', $att); ?>

					</div> <!-- /controls -->
				</div> <!-- /form-group -->
      		<div class="form-group">
					<div class="controls">
           				<a class="btn btn-primary" onClick="addNav()"><?php echo $this->lang->line('btn_add'); ?></a>
      				</div> <!-- /controls -->
			</div> <!-- /form-group -->
            <hr />
            <div class="form-group">
					<label class="control-label" for="customlinkTitle"><?php echo $this->lang->line('menu_new_custom_title'); ?></label>
					<div class="controls">

                       <input type="text" id="customlinkTitle" value=""  class="form-control"/>

					</div> <!-- /controls -->
				</div> <!-- /form-group -->
            <div class="form-group">
					<label class="control-label" for="customURLHREF"><?php echo $this->lang->line('menu_new_custom_link'); ?></label>
					<div class="controls">

                       <input type="text" id="customURLHREF" value="http://"  class="form-control" />

					</div> <!-- /controls -->
				</div> <!-- /form-group -->
      		<div class="form-group">
					<div class="controls">
           				<a class="btn btn-primary" onClick="addCustomURL()"><?php echo $this->lang->line('btn_add'); ?></a>
      				</div> <!-- /controls -->
			</div> <!-- /form-group -->
            <hr />
            <h3><?php echo $this->lang->line('menu_new_drop_down'); ?></h3>
            <hr />
               <div class="form-group">
					<label class="control-label" for="parent"><?php echo $this->lang->line('menu_new_drop_title'); ?></label>
					<div class="controls">
                       <input type="text" id="parentTitle" value=""  class="form-control"/>
					</div> <!-- /controls -->
				</div> <!-- /form-group -->
                <div class="form-group">
					<label class="control-label" for="parent"><?php echo $this->lang->line('menu_new_drop_link'); ?></label>
					<div class="controls">
                       <input type="text" id="parentSlug" value=""  class="form-control URLField"/>
					</div> <!-- /controls -->
				</div> <!-- /form-group -->
      		<div class="form-group">
					<div class="controls">
           				<a class="btn btn-primary" onClick="addDropDown()"><?php echo $this->lang->line('btn_add'); ?></a>
      				</div> <!-- /controls -->
			</div> <!-- /form-group -->

            </div>
          </div>
     </div>

	<div class="col-md-8">
          <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php
                    //Navigation
                    echo $this->lang->line('menu_new_nav'); ?>
                </h3>
            </div>
            <div class="panel-body">
                <div class="dd" id="navHolder">
                    <ul class="dd-list" id="mainNav">
                        <?php  echo $n['navEdit'] ?>
                    </ul>
                </div>
            </div>
            <div class="panel-footer">
               <input type="hidden" id="seriaNav" name="seriaNav"/>
               <input type="hidden" name="convertedNav" id="convertedNav"/>
                <div class="controls">
                    <a class="btn btn-primary" onClick="serializeNav()"><?php echo $this->lang->line('btn_save'); ?></a>
                </div> <!-- /controls -->
                <?php echo form_close() ?>
			</div> <!-- /form-group -->

          </div>
          <!-- /widget -->
           </div>
 <?php } ?>


      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
<!-- Modal -->
<style type="text/css">
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {display:none;}

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<div class="modal fade" id="editIDModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Menu</h4>
            </div>
            <div class="modal-body">
                <form name="editMenuModalForm" method="POST" action="<?=base_url().'admin/navigation/updateNavTos'?>">

                    <div class="form-group">
                        <label style="display: block;">Menu <span style= "float: right;" id="menuTitle">Esic Database</span></label>
                        <input type="hidden" id="menuRef">
                    </div>

                    <div class="form-group" style="text-align: right">
                        <!-- Rectangular switch -->
                        <span style="float: left;font-weight:bold;">Enable TOS</span>
                        <label class="switch">
                            <input type="checkbox" id="tosCheckBox" name="tosCheckBox">
                            <div class="slider"></div>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="tosTextBox">Terms and Conditions</label>
                        <textarea class="form-control" id="tosTextBox" name="tosTextBox"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveMenuChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function addNav(){
    var navHolder = document.getElementById("mainNav").innerHTML;
	var navSelected = $('#pagesList').val();
	$.ajax({
		  url: "<?php echo BASE_URL; ?>/admin/navadd/" + navSelected,
		  type: "POST",
		  success: function(html){
			var navContainer = $('#navContainer'); //jquery selector (get element by id)
              if(html){
				 document.getElementById("mainNav").innerHTML += html;
              }
		  },
		  error: function (html){
			alert('error');
		  }
		});

}

function addCustomURL(){
	var navHolder = document.getElementById("mainNav").innerHTML;
	var customlinkTitle = document.getElementById("customlinkTitle").value;
	var customURLHREF = document.getElementById("customURLHREF").value;
	if (customlinkTitle != ""){
	newLink = "<li class='dd-item' data-href='" + customURLHREF +"' data-title='" + customlinkTitle +"' data-type='1'><a class='right' onclick='var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li);'><i class='fa fa-remove'></i></a><div class='dd-handle'>" + customlinkTitle +"</div></li>";
	document.getElementById("mainNav").innerHTML += newLink;
	}
}

function addDropDown(){
	var navHolder = document.getElementById("mainNav").innerHTML;
	var parentTitle = document.getElementById("parentTitle").value;
	var parentSlug = document.getElementById("parentSlug").value;
	var regexp = /^[a-zA-Z0-9-_]+$/;
	if (parentSlug.search(regexp) == -1)
    { alert('<?php echo $this->lang->line('menu_new_drop_error'); ?>'); }
	else
    {
	if (parentTitle != "" && parentSlug != ""){
	newLink = "<li class='dd-item parent' data-href='" + parentSlug + "' data-title='" + parentTitle +"'><a class='right' onclick='var li = this.parentNode; var ul = li.parentNode; ul.removeChild(li);'><i class='fa fa-remove'></i></a><div class='dd-handle'>" + parentTitle +" <b class='caret dd-caret'></b></div></li>";
	document.getElementById("mainNav").innerHTML += newLink;
	}}
}

 function updateOutput(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

$(document).ready(function()
{



    // activate Nestable for list 1
    $('.dd').nestable({
        group: 1,
		listNodeName:'ul',
		maxDepth: 2,
	    })
    .on('change', updateOutput);
	 // output initial serialised data
    updateOutput($('.dd').data('output', $('#seriaNav')));
});

function serializeNav(){
    updateOutput($('.dd').data('output', $('#seriaNav')));
  	var jsn = JSON.parse(document.getElementById('seriaNav').value);
  	var parentHREF = '';
	var parseJsonAsHTMLTree = function(jsn) {
    var result = '';

    jsn.forEach(function(item) {
      if (item.title && item.children) {
        result += '<li class="dropdown"><a href="<?php  echo BASE_URL; ?>/' + item.href + '">' + item.title + '<b class="caret"></b></a><ul class="dropdown-menu">';
		 ;

		  parentHREF = item.href;
        result += parseJsonAsHTMLTree(item.children);
		parentHREF = "";
        result += '</ul></li>';
      } else {
		  if (parentHREF == ""){
			  	if (item.href != "home"){
					if (item.type != "1"){
        				result += '<li><a href="<?php  echo BASE_URL; ?>/' + item.href + '">' + item.title + '</a></li>';
					} else {
			  			result += '<li><a href="<?php  echo BASE_URL; ?>/' + item.href + '">' + item.title + '</a></li>';
					}
				} else {
				result += '<li><a href="<?php echo BASE_URL; ?>">' + item.title + '</a></li>';
				}
		  } else {
				if (item.type != "1"){
			  	result += '<li><a href="<?php echo BASE_URL; ?>/' + parentHREF + "/" + item.href + '">' + item.title + '</a></li>';
				} else {
			  	result += '<li><a href="<?php echo BASE_URL; ?>' + item.href + '">' + item.title + '</a></li>';
				}
		  }
      }
    });

    return result + '';
  };

  var result = '<ul class="nav navbar-nav">' + parseJsonAsHTMLTree(jsn) + '</ul>';
  document.getElementById('convertedNav').value = result;
  document.getElementById('seriaNav').value = document.getElementById("mainNav").innerHTML;
  document.getElementById("navForm").submit();
 }


 $(function(){

     //Show and Hide the edit pencil buttons.
    $('.dd-item').on('mouseenter',function(){
        var menuRef = $(this).attr('data-href');
        var menuTitle = $(this).attr('data-title');
        var htmlToAppend = '<a class="right editID" data-toggle="modal" data-target="#editIDModal" data-menu="'+menuRef+'" data-menu-title="'+menuTitle+'"><i class="fa fa-pencil"></i></a>';
        $(this).find('a').after(htmlToAppend);
    }).on('mouseleave',function (e) {
        $(this).find('a.editID').remove();
    });



    //Perform event on Modal Trigger
     $('#editIDModal').on('shown.bs.modal',function(e){
        var modal = $(this);
        var button = e.relatedTarget;
        var menuRef = $(button).attr('data-menu');
        var menuTitle = $(button).attr('data-menu-title');
         var slug = "<?=$this->uri->segment(4)?>";
         var checkbox = modal.find('#tosCheckBox');


        //First Lets gets the Information for the database for the tos
         $.ajax({
             url: "<?=base_url()?>admin/navigation/getNavTos",
             data: {slug:slug,menu:menuRef},
             type:"POST",
             success:function (output) {
                 if(output){
                     try{
                         var data = JSON.parse(output);
                         var enabledTos = data.navTos;
                         var tosText = data.text;
                     }
                     catch (ex){
                         console.log(output);
                     }

                     //Now Assign Values to its fields.
                     if(enabledTos == 1){
                         checkbox.prop('checked',true);
                         $('#tosTextBox').prop('disabled',false);
                     }else{
                         checkbox.prop('checked',false);
                         $('#tosTextBox').prop('disabled',true);
                     }
                     modal.find('#tosTextBox').val(tosText);
                 }
                 else{
                     // Reset the fields if data is empty
                     modal.find('form')[0].reset();
                 }
             }
         });

        //Assign the Menu Title
        modal.find('#menuTitle').text(menuTitle);
        modal.find('#menuRef').val(menuRef);
        if(checkbox.is(':checked')){
            $('#tosTextBox').prop('disabled',false);
         }else{
            $('#tosTextBox').prop('disabled',true);
        }
     });

    //Enable Disable Tos
     $('#tosCheckBox').on('change',function(){
         var tosTextBox = $('#tosTextBox');
        if($(this).is(':checked')){
            tosTextBox.prop('disabled',false);
        }else{
            tosTextBox.prop('disabled',true);
        }
     });

    //save changes of menus
     $('#saveMenuChanges').on('click',function(e){
         e.preventDefault();
         var modal = $(this).parents('.modal');
        var form = $(this).parents('.modal-content').find('form');
        var tosCheckBox = form.find('input#tosCheckBox');
        if(tosCheckBox.is(':checked')){
            tosCheckBox = 1;
        }else{
            tosCheckBox = 0;
        }

        var relatedToS = form.find('#tosTextBox');
        var menuTitle = form.find('#menuTitle').text();
        var menuRef = form.find('input#menuRef');
        var slug = "<?=$this->uri->segment(4)?>";
//        var menuLabel = form.find('input#menuLabel');
         var formData = {enableTos:tosCheckBox,tos:relatedToS.val(),menu:menuRef.val(),slug:slug,menuTitle:menuTitle};
         var url = form.attr('action');
        console.log(url);
         $.ajax({
             url: url,
             data: formData,
             type:'POST',
             success:function (output) {
                 var data = output.split('::');
                 if(data[1] == 'OK'){
                     $('#saveMenuChanges').parents('.modal').modal('hide');
                 }
             }
         });
     });

 });//End of $(function()
</script>
<?php echo $footer; ?>
