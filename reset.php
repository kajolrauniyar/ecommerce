<?php

require 'config/init.php';
$user =new User();
//debugger($_GET);
if(isset($_GET['token'])&& !empty($_GET['token'])){
   $token=sanitize($_GET['token']);
   $user_info=$user->getUser(['password_reset_token'=>$token]);

   if(!$user_info){
   	redirect('login','error','Invalid reset token.Please send again');
   }else{
   		$_SESSION['reset_user_id']=$user_info[0]->id;
   		$_SESSION['reset_password_token']=$token;
   		?>
   		<html>
   			<head>
   				<title>Password Reset</title>
   				<link rel="stylesheet" href="<?php echo CMS_CSS.'bootstrap.min.css'?>">
   			</head>
   			<body>
   				<div class="container">
   					<div class="row">
   						<div class="col-md-12">
   							<h4 class="text-center">Password Reset Form</h4>
   							<hr>
   						</div>
   						<div class="col-md-12">
   							<form action="process/reset" class="form form-horizontal" method="post">
   								<div class="form-group row">
   									<label for="" class="col-sm-3">New Password:</label>
   								</div>
   								<div class="col-sm-9">
   									<input type="password" name="password" class="form-control" id="password" required>
   								</div>
   								<div class="form-group row">
   									<label for="" class="col-sm-3">Re Password:</label>
   								</div>
   								<div class="col-sm-9">
   									<input type="password" name="re-password" class="form-control" id="re-password" required>
   									<span class="hidden" id="err-pass"></span>
   								</div>
   								<div class="form-group row">
   									<label for="" class="col-sm-3"></label>
   								</div>
   								<div class="col-sm-9">
   									<button class="btn btn-success" id="submit">Reset Password</button>
   								</div>
   								
   							</form>
   						</div>
   					</div>
   				</div>
   				<script type="text/javascript"><?php echo CMS_JS.'jquery.min.js'?></script>
   				<script>
   					$('#re_password').keyup(function(){
   						var pass=$('#password').val();
   						var re_pass=$('#re_password').val();
   						if(pass !=re_pass){

   							$('#err_pass').html('Password doesnot match.').
   						removeClass('hidden').addClass('alert-danger');
   							$('#submit').attr('disabled','disabled');

   						}else{

   							$('#err_pass').html('').removeClass('alert-danger').addClass('hidden');
   							$('#submit').removeAttr('disabled','disabled');

   						}
   					})
   				</script>
   			</body>
   		</html>
   		<?php
   }
}else{
	redirect('login','error','Token not found');
}






?>