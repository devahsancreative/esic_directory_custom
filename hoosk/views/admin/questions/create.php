<section class="content">
    <div class="row">
    <div class="col-md-12">
        <form action="<?= base_url().'Question/store';?>" method="post" class="form" enctype="multipart/form-data">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Add Question</h3>
                    <div class="add-New-container">
                        <a href="<?= base_url().'admin/questions/index';?>" class="addNewBtn"><i class="fa fa-angle-double-left"></i> Listing</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <input type="hidden" id="hiddenListID" value="">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="NameTextBox">Question:</label>
                                <input type="text" name="Name" id="NameTextBox" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="answerType">Answer Type:</label>
                                <select class="form-control" name="answerType" id="answerType">
                                    <option value="0">Select Type</option>
                                </select>
                            </div>
                            <div class="from-group" id="answerBox">

                            </div>
                        </div>
                    </div>
                </div> <!-- /.box-body -->
                <div class="box-footer">
                    <div class="button-container">
                        <input type="submit" class="btn btn-primary" value="Save" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.col -->
</div>
</section>
