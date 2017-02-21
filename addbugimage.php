<?php

	require_once('include/class.tbs.php');
	require_once('include/class.user.php');
    include 'clickjacking.php';
	$user =  new user();

	if(($_POST) && $_SERVER['REQUEST_METHOD'] == "POST")
	{
		
		$valid_formats = array("jpg", "png", "gif", "jpeg");

		$valid_mimes=array("image/jpg","image/gif","image/png","image/jpeg");
		$finfo=finfo_open(FILEINFO_MIME_TYPE);
		$mime=finfo_file($finfo,$_FILES['files']['tmp_name']);

		$path = "bugimages/";
		$name = $_FILES['files']['name'];
		$size = $_FILES['files']['size'];
		$description = $_POST['description'];
		$description = trim($description);
		
		$error = 0;
        $imginfo_array=getimagesize($name);
		if(!in_array($mime,$valid_mimes))
		{
			$error=1;
			$html="This is not a valid image";
		}
		if(trim($name) == '')
		{
			$error = 1;
			$html = "Invalid image format";
		}

		if(strlen($name) && !$error)
		{
			$pi = pathinfo($name);
			$txt = $pi['filename'];
			$ext = $pi['extension'];
			
			if(in_array(strtolower($ext),$valid_formats))
			{
				$rand1 = rand(1, 500);
				$rand2 = rand(1, 500);
                date_default_timezone_set("Asia/Kolkata");
               // echo "The time is " . date("h:i:sa",$time);
			    $time = time();
                $time=$user->m_db->escape($time);
				$description=$user->m_db->escape($description);
				$actual_image_name = $rand1.$rand2.time().".".$ext;
				$tmp = $_FILES['files']['tmp_name'];
				if(move_uploaded_file($tmp, $path.$actual_image_name)){}
				$imgpath =$user->m_db->escape( $path.$actual_image_name);
				
				$sql ="INSERT INTO my_bugtracker (bug_description,check_id,time_stamp,bug_image,bug_resolve_time) VALUES ('{$description}',' ','{$time}','{$imgpath}',' ')";
				$user->m_db->query($sql);
				$insertid = $user->m_db->insert_id;

				$timeformat = date("h:i:sa",$time);
               //  $ischecked=$user->m_db->check_box;

				
				$html = "<div class=\" tabval\">
							<div class=\"val bug_id_value white font15 width20\" >{$insertid}</div>
							<div class=\"val bug_name white font15 width20\"  data-id=\"{$insertid}\">{$description}</div>
							<div class=\"val check_box white font15 width20\">
							<input type=\"checkbox\" data-id=\"{$insertid}
				\"name=\"bug\" class=\"bug_checkbox\"></div>
							<div class=\"val time white font15 width20\">{$timeformat}</div>
							<div class=\"val img white font15 width20\"><img src=\"{$imgpath}\" height=\"50\" width=\"50\"></div>
                           	<div class=\"val delete\"><a href=\"delete.php?id={$insertid}\">Delete</a></div>

						</div>";
			}
			else
			{
				$html = "Invalid image format";
				$error = 1;
			}
		}


	}	
	else
	{
		$error = 1;
		$html = "There seems to be a problem. Please try again later";
	}	

	$TBS = new clsTinyButStrong();
	$TBS->LoadTemplate('main.html');
	header('Content-type: application/json');
	$returnarray = array();
	$returnarray['html'] = $html;
	$returnarray['error'] = $error;
	print json_encode($returnarray);exit;

?>


