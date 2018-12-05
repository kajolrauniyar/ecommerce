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
            <h3>Banner List</h3>
          </div>
          <div class="title_right">
           <a href="javascript:0;" class="btn btn-success pull-right" onclick="showAddForm()">
            <i class="fa fa-plus"></i>Add Banner</a>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>All Banners</h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <table id="datatable" class="table table-bordered table-hover jambo_table">
                    <thead>
                      <th>S.N</th>
                      <th>Title</th>
                      <th>Link</th>
                      <th>Thumbnail</th>
                      <th>Status</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
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
<!-- modal start -->
<div class="modal fade bs-example-modal-bg" tabindex="-1" role="dialog" arial-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" data-dismiss="modal"><span arial-hidden="true">x</span></button>
        <h4 class="modal-title" id="myModallabel">Add Banner</h4>
      </div>
      <form action="" class="form form-horizontal">
        <div class="modal-body">
          <div class="row form-group">
            <label for="" class="col-sm-3">Banner Title:</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="title" id="title" required>
            </div>
          </div>

           <div class="row form-group">
            <label for="" class="col-sm-3">Link:</label>
            <div class="col-sm-9">
              <input type="url" class="form-control" name="link" id="link" required>
            </div>
          </div>

           <div class="row form-group">
            <label for="" class="col-sm-3">Status:</label>
            <div class="col-sm-9">
             <select name="status"  id="status" class="form-control" required>
               <option value="Active">Active</option>
               <option value="Inactive">Inactive</option>
             </select>
            </div>
          </div>

           <div class="row form-group">
            <label for="" class="col-sm-3">Image:</label>
            <div class="col-sm-9">
              <input type="file" accept="*image/*" name="image" id="image" required>
            </div>
          </div>

          <div class="modal-footer">
            <button type="reset" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash"></i>  Cancel</button>
            <button class="btn btn-success"><i class="fa fa-send"></i>  Save Changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require 'inc/footer.php'; ?>
<script src="<?php echo CMS_JS;?>datatables.min.js"></script>
<script>
  function showAddForm(){
    $('.modal').modal('show');
    
  }
</script>