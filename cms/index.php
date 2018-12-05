<?php  $page_title = 'Admin Login';?>
<?php  require 'inc/header.php'; ?>
<?php 
 //debugger($_SESSION,true);
    if(isset($_SESSION['token']) || isset($_COOKIE['_auth_user'])){
      redirect('dashboard', 'success', 'You are already logged in.');
    }
?>
  
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <?php echo flash(); ?>
                <form method="post" action="process/login">
                    <h1>Login</h1>
                    <div>
                        <input type="text" name="username" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="" />

                    </div>
                    <div>
                        <input type="checkbox" name="remember_me" value="1"  > Remember Me
                    </div>
                    <div>
                        <button class="btn btn-default submit"  >Log in</button>
                        <a class="reset_pass" href="reset">Lost your password?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> meropasal!</h1>
                            <p>© <?php echo date("Y"); ?> Powered by <a href="<?php echo SITE_URL; ?>"></a><?php echo SITE_NAME; ?>  </p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
     </div>
</div>
<?php  require 'inc/footer.php'; ?>
