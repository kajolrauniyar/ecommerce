<?php 
$page_title = 'Dashboard';
require 'inc/header.php'; ?>

<?php require 'inc/checklogin.php'; ?>


<div class="container body">
  <div class="main_container">
   <?php require 'inc/sidebar.php';?>

    <!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <?php flash(); ?>
        <div class="page-title">
          <div class="title_left">
            <h3>Dashboard</h3>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Change Password</h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                      <form action="process/password-change" method="post" class="form form-horizontal">
                        <div class="row form-group">
                          <label for="" class="col-sm-3">Old Password: </label>
                          <div class="col-sm-9">
                            <input type="password" name="old_password" class="form-control" required id="old_password">
                          </div>
                        </div>
                        <div class="row form-group">
                          <label for="" class="col-sm-3">New Password: </label>
                          <div class="col-sm-9">
                            <input type="password" name="new_password" class="form-control" required id="password">
                          </div>
                        </div>

                        <div class="row form-group">
                          <label for="" class="col-sm-3">Re Password: </label>
                          <div class="col-sm-9">
                            <input type="password" name="re_password" class="form-control" required id="re_password">
                            <span class="hidden" id="err_pass"></span>
                          </div>
                        </div>

                        <div class="row form-group">
                          <label for="" class="col-sm-3"></label>
                          <div class="col-sm-9">
                            <a href="dashboard" class="btn btn-danger">
                              <i class="fa fa-trash"></i> Cancel
                            </a>
                            <button class="btn btn-success" id="submit">
                              <i class="fa fa-send"></i> Submit
                            </button>
                          </div>
                        </div>
                      </form>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
      <div class="pull-right">
       &copy;<?php echo date('Y');?>All rights reserved .Designed and developed by <a href="<?php echo SITE_URL; ?>"><?php echo SITE_NAME; ?></a>
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
  </div>
</div>
<?php require 'inc/footer.php'; ?>
<script src="<?php echo CMS_JS.'main.js'?>"></script>