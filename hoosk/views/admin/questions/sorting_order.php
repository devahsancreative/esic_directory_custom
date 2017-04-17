<style type="text/css">
    .customQBox{
        margin-bottom:15px !important;
    }
    .ui-state-highlight {
        height: 1.5em; line-height: 1.2em;
        display: block;
        background: black;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sorting & Ordering
            <small>QUESTIONS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Questions & Answers</a></li>
            <li class="active">list</li>
        </ol>
    </section>
    <div class="col-md-6">

    </div>
    <section class="content">
        <!-- Custom Tabs (Pulled to the right) -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
                <?php
                $count = 0;
                    foreach($listing as $list){
                        echo '<li data-id="'.$list->id.'" class=" listTab '.(($count===0)?"active":"").'"><a href="#list-'.$list->id.'" data-toggle="tab" aria-expanded="'.(($count===0)?"active":"").'">'.$list->listName.'</a></li>';
                        $count++;
                    }
                ?>

<!--                <li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">Tab 2</a></li>
                <li class="active"><a href="#tab_3-2" data-toggle="tab" aria-expanded="true">Tab 3</a></li>-->


<!--                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        Dropdown <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                    </ul>
                </li>-->
                <li class="pull-left header"><i class="fa fa-th"></i> Questions List</li>
            </ul>
            <div class="tab-content">

                <?php
                $count = 0;
                    foreach($listing as $list){
                        ?>

                        <div class="tab-pane <?=(($count===0)?"active":"")?>" id="list-<?=$list->id;?>">

                        </div>

                <?php
                        $count++;
                    }
                ?>
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
    </section>
</div>

<script type="text/javascript">
    loadQuestionsList(1);
    $(function(){
        $('.listTab').on('click',function(){
            var listID = $(this).attr('data-id');
            loadQuestionsList(listID);
        });//end of onclick function
    });
    
    function loadQuestionsList(listID) {
            //Load the Questions for given listID
            var postData = {
                'listID' : listID
            };
            var text = $('#list-'+listID).text();
            if(text && text.trim().length==0){
                $.ajax({
                    url:"<?=base_url();?>admin/questions/getQuestionsList",
                    data:postData,
                    type:"POST",
                    success:function (output) {
                        $('#list-'+listID).html(output);
                    }
                });
            }//end of if statement
    }//End of main function
</script>



