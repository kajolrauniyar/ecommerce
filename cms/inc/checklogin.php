<?php

$user = new User();
    
  // debugger($_SESSION);
//session check
  if( !isset($_SESSION['token']) || empty($_SESSION['token']))
  {
    //cookie check
    if(!empty($_COOKIE['_auth_user'])){
      $token = $_COOKIE['_auth_user'];
      $user_info = $user->getUserByToken($token);

        if(!$user_info){
            unset($_SESSION['token']);

            if(isset($_COOKIE['_auth_user'])){
              setcookie('_auth_user', null, time()-60, "/");
            }


            redirect('./','warning', 'Your session has expired. Please login to access.');
        }


        $_SESSION['user_id'] = $user_info[0]->id;
        $_SESSION['full_name'] = $user_info[0]->full_name;
        $_SESSION['email'] = $user_info[0]->email;
        $_SESSION['role'] = $user_info[0]->role;

        $token = randomString(100);

        $_SESSION['token'] = $token;

        setcookie('_auth_user', $token, (time()+864000), '/');

        $args = array(
            'session_token' => $token,
            'last_login'  => date('Y-m-d H:i:s'),
            'last_ip'   => $_SERVER['REMOTE_ADDR']
        );

        $user->updateUser($args, $user_info[0]->id);

    } else {
      redirect('./','error','Please login first.');
    }
    
  }


  if($_SESSION['token']){
      $token = $_SESSION['token'];
      $user_info = $user->getUserByToken($token);

      if(!$user_info){
          unset($_SESSION['token']);

          if(isset($_COOKIE['_auth_user'])){
            setcookie('_auth_user', null, time()-60, "/");
          }


          redirect('./','warning', 'Your session has expired. Please login to access.');
      }
  }