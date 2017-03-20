<?php echo $header; ?>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo $this->lang->line('menu_header'); ?>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>
                    <a href="<?= BASE_URL ;?>/admin">
                        <?php echo $this->lang->line('nav_dash'); ?> 
                    </a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-list-alt"></i>
                    <a href="#">New</a>
                </li>
            </ol>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <table id="makingShortCode" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Slider For</th>
                        <th>Layout</th>
                        <th>Items</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-id="<?=$slider['id']?>">
                        <td>
                            <div class="form-group">
                                <select id="sliderSelector" name="sliderSelector" class="form-control sliderSelector" data-name=""  data-table="">
                                    <option value="">Select Slider For</option>
                                    <option name="Esic Innovators" table="user"          value="ESIC">Esic Innovators</option>
                                    <option name="Investor"        table="esic_investor" value="INVESTORS">Esic Investors</option>
                                    <option name="Universities" table="esic_institution" value="UNIVERSITIES">Universities</option>
                                    <option name="Accelerators" table="esic_acceleration_logo" value="ACCELERATORS">Accelerators</option>
                                    <option name="R&D Partner" table="esic_rnd" value="R&DPARTNER">R&D Partners</option>
                                    <option name="" table="" value="R&DTAXCONSULTANT">R&D Tax Consultant</option>
                                    <option name="IP Lawyers" table="esic_lawyers" value="IPLAWYER">IP Laywer</option>
                                    <option name="" table="" value="GRANTCONSULTANT">Grant Consultant</option>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <select id="layoutSelector" name="layoutSelector" class="form-control layoutSelector">
                                    <option value="0">Select Layout</option>
                                    <?php
                                        if(isset($layouts) and is_array($layouts)){
                                            foreach ($layouts as $layout){
                                                echo '<option value="'.$layout->id.'"'.(($slider['layout_id'] === $layout->id)?"selected='selected'":'').'>' . $layout->name . '</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </td>
                         <td class="sliderTypes">
                            <div class="form-group">
                                <label for="sliderTypeDesktop">Desktop: </label>
                                <input type="number" name="sliderTypeDesktop" class="form-control" id="sliderTypeDesktop" />
                            </div>
                            <div class="form-group">
                                 <label for="sliderTypeTablet">Tablet: </label>
                                <input type="number" name="sliderTypeTablet" class="form-control" id="sliderTypeTablet" />
                            </div>
                            <div class="form-group">
                                <label for="sliderTypeMobile">Mobile: </label>
                                <input type="number" name="sliderTypeMobile" class="form-control" id="sliderTypeMobile" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="shortcode-container">
                <div class="action-buttons">
                    <button id="generateShortcode" class="btn btn-primary">Generate Shortcode</button>
                </div>
                <div class="shortcode-view-area">
                </div>
            </div>
            <hr>
            <div class="notes">
                <div class="form-group">
                    <label for="sliderNotes">Notes: </label>
                    <div id="sliderNotes" class="form-control" style="height: initial;">
                        <ol>
                            <li>Items Default  = 6</li>
                            <li>Copy & Paste Shortcode in Text Editor of Page Builder</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .action-buttons{
        display: inline-block;
        vertical-align: top;
    }
    .shortcode-view-area{
        text-align: center;
        background: rgba(255, 255, 255, 0.81);
        padding: 10px;
        border: solid 2px #eee;
        margin: 0px 10px 10px;
        display: inline-block;
        vertical-align: top;
        float: none;

    }
    #sliderType{
        max-width: 100px;
    }
</style>
<script type="text/javascript">
    $(function () {

        $('#sliderSelector').on('change',function(){
           var name = $(this).find(':selected').attr('name');
           var table = $(this).find(':selected').attr('table');
           $(this).attr('data-name', name );
           $(this).attr('data-table',table );

        });
        $('#generateShortcode').on('click',function(){

            var sliderTypeDesktop = $('#sliderTypeDesktop').val();
            var sliderTypeTablet  = $('#sliderTypeTablet').val();
            var sliderTypeMobile  = $('#sliderTypeMobile').val();
            var layoutSelector  = $('#layoutSelector').val();
            var sliderSelector  = $('#sliderSelector').val();
            var name  =  $('#sliderSelector').attr('data-name');
            var table = $('#sliderSelector').attr('data-table');

              var Shortcode = '{{';
                  Shortcode += sliderSelector; 
                  Shortcode += ' layout='+layoutSelector; 
                  Shortcode += ' Desktop='+sliderTypeDesktop;  
                  Shortcode += ' Tablet='+sliderTypeTablet;  
                  Shortcode += ' Mobile='+sliderTypeMobile;  
              Shortcode += ' }}';
              console.log(Shortcode);

              if(Shortcode.length > 0){
                //Run the ajax to updated the updated value.
                   $.ajax({
                        url: "<?=base_url()?>admin/slider/newSlider",
                        data:{
                            shortcode:Shortcode,
                            renderCode:sliderSelector,
                            layout:layoutSelector,
                            desktop:sliderTypeDesktop,
                            tablet:sliderTypeTablet,
                            mobile:sliderTypeMobile,
                            name: name,
                            table: table
                        },
                        type:"POST",
                        success:function(output){
                            console.log(output);
                            $('.shortcode-view-area').html();
                            $('.shortcode-view-area').html('<p>'+Shortcode+'</p>');

                        }
                    });
                     $('.shortcode-view-area').html();
                     $('.shortcode-view-area').html('<p>'+Shortcode+'</p>');
                }
        });
    });
</script>

<?php echo $footer; ?>
