<?php $page_title = 'Admin Login'; ?>
<?php require 'inc/header.php'; ?>
    <div>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <?php flash(); ?>
            <form method="post" action="process/reset-password">
              <h1>Reset Form</h1>
              <div>
              	<label for="">Please provide your valid email address to send reset link.</label>
                <input type="text" class="form-control" placeholder="Username" required="" name="username"/>
              </div>
              <div>
                <button class="btn btn-default submit">Send Verification</button>
                <a class="reset_pass" href="login">Login?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <p>&copy; <?php echo date("Y"); ?> Powered By <a href="<?php echo SITE_URL; ?>"><?php echo SITE_NAME; ?></a></p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
<?php require 'inc/footer.php'; ?>