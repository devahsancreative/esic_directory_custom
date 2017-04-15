<div class="box-group ui-sortable accordion" id="accordion">
    <?php
    if(isset($QASorting) and !empty($QASorting)){
        $count = 1;
        foreach($QASorting as $orderedQuestion){
            ?>
            <div data-id="<?=$orderedQuestion->ListItemID?>_<?=$count?>" id="question-<?=$orderedQuestion->questionID?>" class="panel box box-primary customQBox">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        <?= $orderedQuestion->QuestionOrder;?> -
                        <a data-toggle="collapse" data-parent="#accordion" href="#<?=$orderedQuestion->questionID?>">
                            <?=$orderedQuestion->Question?>
                        </a>
                    </h4>
                </div>
                <div id="<?=$orderedQuestion->questionID?>" class="panel-collapse collapse">
                    <?php
                    if(!empty($orderedQuestion->PossibleSolutions)){
                        $possibleSolutions = json_decode($orderedQuestion->PossibleSolutions);
                        $type = $possibleSolutions->type;
                        switch ($possibleSolutions->type){
                            case 'radios':
                                break;
                            case 'CheckBoxes':
                                break;
                            case 'SelectBox':
                                break;
                        }
                    }//End of If Statement.
                    ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-3 text-right"> <label for="">Type</label></div>
                            <div class="col-sm-6 col-md-4"><?=ucfirst($type)?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $count++;
        }//End Foreach
    }else{
        ?>
        <div class="panel box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#" href="#">
                        No Questions Available for this Section.
                    </a>
                </h4>
            </div>
        </div>

        <?php
    }
    ?>
</div>

<script type="text/javascript">
    $(function () {
        $(".accordion" ).sortable({
            cursorAt: { cursor: "move", top: -1 },
            placeholder: "ui-state-highlight",
            stop:function (event, ui) {
                //                        var obj = $(this);
                var selectedItem = $(ui.item);
                var sourceQuestionID = selectedItem.attr('data-id');

                var data = $(this).sortable('serialize');
                var postData = $(this).sortable('serialize', {
                    attribute: 'data-id',//this will look up this attribute
                    key: 'order[]',//this manually sets the key
                    expression: /(.+)/ //expression is a RegExp allowing to determine how to split the data in key-value. In your case it's just the value

                });

                $.ajax({
                    data: postData,
                    type: 'POST',
                    url: '<?=base_url()?>admin/questions/sort',
                    success:function (output) {
                        var data = output.trim().split('::');
                        Haider.notification(data[1],data[2]);
                    }
                });
            }
        });
        $( ".accordion" ).disableSelection();
/*        //Binded Events
        $( "#accordion" ).on( "sortstop", function( ) {

        });*/
    });
</script>
