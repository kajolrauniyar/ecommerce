<?php
 function debugger($data, $is_die=false){
 	echo "<pre style='color:#FF0000'>";
 	print_r($data);
 	echo "</pre>";
 	if($is_die){
 		exit;
 	}
 	
 }
//currentpage  start

function getCurrentPage(){
	return pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
}
//currentpage end

//redirect  start
function redirect($path, $session_key = null, $session_msg = null){
	if(isset($session_key) && !empty($session_key)){
		$_SESSION[$session_key] = $session_msg;
	}
	
	@header('location: '.$path);
	exit;
}
//redirect end
//flash message start
function flash(){
	if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
		echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
		unset($_SESSION['success']);
	}
	if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
		echo "<p class='alert alert-danger'>".$_SESSION['error']."</p>";
		unset($_SESSION['error']);

	}
	if(isset($_SESSION['warning']) && !empty($_SESSION['warning'])){
		echo "<p class='alert alert-warning'>".$_SESSION['warning']."</p>";
		unset($_SESSION['warning']);
	}
?>
	<script type="text/javascript">
		setTimeout(function(){
			$('.alert').slideUp('slow');
		},3000);
	</script>
<?php
}
//flash message end
//randomstring 
function randomString($leng = 100){
	$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$str_len = strlen($chars);
	$random = '';
	for($i=0; $i<$leng; $i++){
		$random .= $chars[rand(0, $str_len-1)];
	}

	return $random;
}
//sendmessage start
	function sendMessage($to, $sub, $msg, $mail){
	
	//Server settings
    $mail->SMTPDebug = 0; // Enable verbose debug output
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = '	smtp.mailtrap.io';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'd26241e5991dfb'; // SMTP username
    $mail->Password = '1f95426b1f71f4'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 2525; // TCP port to connect to

    //Recipients
    $mail->setFrom('no-reply@meropasl.com', 'NO-Reply Meropasal');

    //Receiver
    $mail->addAddress($to);

/*    														$mail->addReplyTo('info@example.com', '  				Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');
*/
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $sub;
    $mail->Body    = $msg;
    /*$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';*/

    return $mail->send();
}


//send message end

//sanitize start
function sanitize($str){
	$str=strip_tags($str);
	$str=stripslashes($str);
	$str=rtrim($str);
	return $str;
	
}

function uploadImage($files,$upload_dir=null){
	if($files['error']==0){
		$ext=pathinfo($files['name'],PATHINFO_EXTENSION);

		if(in_array(strtolower($ext),ALLOWED_IMAGE_EXTENSION)){
			if($files['size']<=5000000){
				$upload_path = UPLOAD_DIR.$upload_dir;
				if(!is_dir($upload_path)){
					mkdir($upload_path,0777,true);
				}

				$file_name = ucfirst(strtolower($upload_dir))."-".date('ymdhis').rand(0,999).".".$ext;

				$success = move_uploaded_file($files['temp_name'],$upload_path."/".$file_name);

				if($success){
					return $file_name;
				}else{
					return null;
				}


			}else{
				return null;
			}

		}else{
			return null;
		}
	}else{
		return null;
	}
}
?>




