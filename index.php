<?php
	require_once('include/class.tbs.php');
	require_once('include/class.user.php');
     include 'clickjacking.php';
     require_once('include/csrf.class.php');
	 $csrf=new csrf();
	 $token_id=$csrf->get_token_id();
	 $token_value= $csrf->get_token($token_id);
     $form_names=$csrf->form_names(array('user','password'),false);
	 if(isset($_POST[$form_names['user']],$_POST[$form_names['password']])){
		 if($csrf->check_valid('post')){
			 $user=$_POST[$form_names['user']];
			 $password=$_POST[$form_names['password']];

		 }
		 $form_names=$csrf->form_names(array('user','password'),true);
	 }

     $newarray=array("id1"=>$token_id,"id2"=>$token_value,"user"=>$form_names['user'],"password"=>$form_names['password']);
    // print_r ($newarray);

	 $user = new user();

	$pagetitle = 'Home';
	
	$sql = "SELECT * FROM my_bugtracker WHERE 1 ORDER BY bug_id DESC";
	$bugarray = $user->m_db->get_results($sql, ARRAY_A);
	$bugarray = count($bugarray) ? $bugarray : array();

	$TBS = new clsTinyButStrong();
	$TBS->LoadTemplate('index.html');
	$TBS->MergeBlock('new_blk',$newarray);
	$TBS->MergeBlock('bug_blk', $bugarray);
	$TBS->show();
	exit;

?>
