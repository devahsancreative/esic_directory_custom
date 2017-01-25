
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pre-assessment
            <small>DETAILS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Pre-Assessments</a></li>
            <li class="active">list</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
    	<?php
            if(isset($userProfile)){
            	///echo "<pre>";
               //// print_r($returnedData);
                //echo "</pre>";
                /*
                [FullName] => Soilkee Pty Ltd 
            [Email] => be11112st@gmail.ocm
            [Company] => Education and Training
            [Business] => 
            [BusinessShortDesc] => Soilkee Pty Ltd will commercialise a novel tilling machine that improves pasture productivity to provide feed for dairy and beef cattle herds. Use of the machine also reduces the need for herbicide and fertilizer application. Australian Government commercialisation support will enable Soilkee to access market research, business planning and IP protection. It will also allow Soilkee to access specialist agronomist advice to plan a subsequent trial that will provide independent agronomic data to encourage market adoption.    
            [Score] => 0
            [Logo] => uploads/users/17/Logo_17_1472554389.jpg
            [Web] => www.soilkee.com.au
            [expiry_date] => 0000-00-00
            [corporate_date] => 0000-00-00
            [added_date] => 0000-00-00
            [Status] =>  Pending */
            //print_r($userProfile);
              
         ?>
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
            <?php if(!empty($userProfile['Logo']) and is_file(FCPATH.'/'.$userProfile['Logo'])){ ?>
              <img class="profile-user-img img-responsive img-circle" src="<?= base_url().'/'.$userProfile['Logo'];?>" alt="User profile picture">
			<?php } ?>
            <?php if(!empty($userProfile['FullName'])){ ?>
              <h3 class="profile-username text-center"><?= $userProfile['FullName'];?></h3>
			<?php } ?>
            <?php if(!empty($userProfile['Company'])){ ?>
              <p class="text-muted text-center"><?= $userProfile['Company']?></p>
            <?php } ?>
              <ul class="list-group list-group-unbordered dates">
              	<?php if(!empty($userProfile['expiry_date'])){ ?>
	                <li class="list-group-item ">
	                  <b>Expiry Date</b> <a class="pull-right bg-red"><?= $userProfile['expiry_date'];?></a>
	                </li>
                <?php } ?>
                <?php if(!empty($userProfile['corporate_date'])){ ?>
                <li class="list-group-item">
                  <b>Corporate Date</b> <a class="pull-right bg-aqua"><?= $userProfile['corporate_date'];?></a>
                </li>
                <?php } ?>
                <?php if(!empty($userProfile['added_date'])){ ?>
                <li class="list-group-item">
                  <b>Added Date</b> <a class="pull-right bg-green"><?= $userProfile['added_date'];?></a>
                </li>
                <?php } ?>
              </ul>
              <?php 
              	if(!empty($userProfile['Web'])){
              ?>
              <a href="http://<?= $userProfile['Web'];?>" class="btn btn-primary btn-block" target="_blank"><b><?= $userProfile['Web'];?></b></a>
              <?php
              	}
              ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Company</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php 
                if(!empty($userProfile['Email'])){
            ?>
              <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

              <p class="text-muted">
                 <?= $userProfile['Email'];?>
              </p>
              <hr>
            <?php } ?>
              
            <?php 
                if(!empty($userProfile['sector'])){
            ?>
              <strong><i class="fa fa-industry margin-r-5"></i> Sector</strong>

              <p class="text-muted"> <?= $userProfile['sector'];?></p>
              <hr>
            <?php } 

                if(!empty($userProfile['business'])){
            ?>
              <strong><i class="fa fa-briefcase margin-r-5"></i> Business</strong>

              <p class="text-muted"> <?= $userProfile['business'];?></p>
              <hr>
            <?php } ?>

              <!--strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p-->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <style>
        .dates a{
          padding: 1px 5px;
        }
        .post.question-post{
          margin-left: 20px;
          padding-bottom: 5px;
        }
        .question-post .user-block .question-statement{
          margin-left: 0px;
        }
        .post .user-block {
          margin-bottom: 5px;
        }
        </style>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#questions" data-toggle="tab">Questions</a></li>
              <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="questions">
                <!-- Post -->
                <?php 
                foreach ($usersQuestionsAnswers as $key => $value) {
               ?>
                
                  <div class="post question-post">
                      <div class="user-block">
                            <span class="username question-statement">
                              <a href="#"><?= $value['Question'];?></a>
                            </span>
                        <!---span class="description">Shared publicly - 7:30 PM today</span-->
                      </div>
                    <!-- /.user-block -->
                    <p><?= $value['solution'];?></p>
                  </div>
                <? } ?>
                </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <?php

                if(!empty($userProfile['BusinessShortDesc'])){
                ?>
                <ul class="timeline timeline-inverse">
                  <!-- timeline item -->
                  <li>

                    <div class="timeline-item">

                      <h3 class="timeline-header">Brief Description</h3>

                      <div class="timeline-body">
                      <?= $userProfile['BusinessShortDesc'];?>
                      </div>
                      <!--div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div-->
                    </div>
                  </li>      
                </ul>
                <?php } ?>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
<?php
//}
   }
?>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.6
    </div>
    <strong>Copyright &copy; 2000-2016 <a href="http://creativetech-solutions.com/">Creativetech-Solutions/</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                            <p>New phone +1(800)555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                            <p>Execution time 5 seconds</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="label label-danger pull-right">70%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Update Resume
                            <span class="label label-success pull-right">95%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Laravel Integration
                            <span class="label label-warning pull-right">50%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)">
                        <h4 class="control-sidebar-subheading">
                            Back End Framework
                            <span class="label label-primary pull-right">68%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
        <!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Other sets of options are available
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-right" checked>
                    </label>

                    <p>
                        Allow the user to show his name in blog posts
                    </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-right" checked>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-right">
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!--Edit Ward Modal-->
<div class="modal approval-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Approval Status</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="hiddenUserID">
                    <div class="col-md-12">
                        <p>Update the Pre-Assessment Approval Status?</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger mright" id="noPending">Pending</button>
                <button type="button" class="btn btn-success" id="yesApprove">Approve</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /.End Edit Ward Modal --><!-- /.modal -->

