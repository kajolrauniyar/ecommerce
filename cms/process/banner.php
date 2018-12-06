<?php
require $_SERVER['DOCUMENT_ROOT'].'config/init.php';
require '../inc/checklogin.php';
//debugger($_POST);
//debugger($_FILES,true);
$banner = new Banner();

if(!isset($_POST)&& !empty($_POST)){
 	debugger($_POST);
 	debugger($_FILES, true);

 	$data=array(

 			'title'=>sanitize($_POST['title']),
			'link'=>filter_var($_POST['link'], FILTER_VALIDATE_URL),
			'status'=>$_POST['status'],		
			'added_by'=> $_SESSION['user_id']
 	);

 	if(isset($_FILES['image'])&& $_FILES['image']['error']==0){
 		$file_name=uploadImage($_FILES['image'],'banner');

 		if($file_name){
 			$data['image']= $file_name;
 		}else{
 			$_SESSION['warning']="File could not be uploaded.";
 		}
 	}

 	//database insert 
 	$baner_id=$banner->addBanner($data);

 	if($banner_id){
 		redirect('../banner','success','Banner added successfully');
 	}else{
		redirect('../banner','error','Sorry ! There was problem while adding banner.');
 	}

}else{
	redirect('../banner','error','Unauthorized  Access');
	
}


?>