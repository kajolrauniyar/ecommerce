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
                <h2>Dashboard page</h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  Add content to the page ...
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