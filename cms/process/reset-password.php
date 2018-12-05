<?php
require $_SERVER['DOCUMENT_ROOT'].'config/config.php';
require CONFIG_PATH.'functions.php';
require CLASS_PATH.'Database.php';
require CLASS_PATH.'User.php';
//debugger($_POST,true);

require $_SERVER['DOCUMENT_ROOT'].'assets/plugins/SMTP.php';
require $_SERVER['DOCUMENT_ROOT'].'assets/plugins/PhpMailer.php';

$mail = new PHPMailer(true);

$user = new User();
if(isset($_POST) && !empty($_POST)){
	$user_name = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);
	
	if(!$user_name){
		redirect('../reset', 'error', 'Invaid username type. Username should be email.');
	}

	$user_info = $user->getUserByUsername($user_name);
	$reset_token = randomString(100);

	$args = array(
			'password_reset_token'	=> $reset_token
	);

	$user->updateUser($args, $user_info[0]->id);
	
	$message = " Dear ".$user_info[0]->full_name."! <br>";
	$message .= " You have requested for the password change. If you want to change the password, please click on the link below: <br>";
	$message .= "<a href='".SITE_URL.'reset/?token='.$reset_token."'>".SITE_URL.'reset?token='.$reset_token."</a>";
	$message .= "<br> If you did not request for the password change, please ignore this message.<br>";
	$message .= "Regards,<br>";
	$message .= "MeroPasal Administration";

	//$message = file_get_contents('resetpassword.html');


	$mail = sendMessage($user_info[0]->email, "Password reset Link", $message, $mail);
	//debugger($mail, true);
	//debugger($user_info,true);
	if($mail){
		redirect('../','success','An email has been sent to your account for password reset.');
	}else{
		redirect('../reset','error','Sorry!There was problem while sending you email at this moment.Please try again after sometimes.');
	}
} else {
	redirect('../reset', 'warning', 'Provide your username here.');
}


?>