
<?php  
	require_once $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	// debugger($_POST);
	$user = new User();
	if (isset($_POST) && !empty($_POST)) {
		$user_name = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);
		if (!$user_name) {
			redirect('../', 'error', 'Invalid username type. Username should be email.');
		}
		$password = sha1($user_name.$_POST['password']);
		$user_info = $user->getUserByUsername($user_name);

		if($user_info){
			if($password==$user_info[0]->password){
				if($user_info[0]->role =='Admin'){
					//debugger($user_info);password check garne thau
					if($user_info[0]->status=='Active'){
						//debugger($user_info);
						$_SESSION['user_id'] = $user_info[0]->id;
						$_SESSION['full_name'] = $user_info[0]->full_name;
						$_SESSION['email'] = $user_info[0]->email;
						$_SESSION['role'] = $user_info[0]->role;

						$token = randomString(100);

						$_SESSION['token'] = $token;

						if(isset($_POST['remember_me']) && $_POST['remember_me'] == 1){
						setcookie('_auth_user', $token, (time()+864000), '/');
					}

						// debugger($_SERVER);

					$args = array(
						'session_token' => $token,
						'last_login'	=> date('Y-m-d H:i:s'),
						'last_ip'		=> $_SERVER['REMOTE_ADDR']
					);

					$user->updateUser($args, $user_info[0]->id,true);

					redirect('../dashboard', 'success', 'Welcome '.$user_info[0]->full_name."! You have been successfully logged in to admin panel.");
					}else{
						redirect('../','error','Your account is not activated.Please contact administration.');
					}
				}else{
					redirect('../','error','You are not allowed to access this section');
				}
				//debugger($user_info);
			}else{
					redirect('../','error','password doesnot match');
			}

		}else{
			redirect('../','error','users not found');
		}
		//debugger($user_info );
	}else{
		redirect('../', 'error', 'Unautorized access.');
	}
	
?>