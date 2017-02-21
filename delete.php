<?php
	require_once('include/class.tbs.php');
	require_once('include/class.user.php');
     include 'clickjacking.php';

	$user = new user();
	$pagetitle = 'Home';
	if(isset($_GET['id']))
	{
		$sql = "DELETE FROM my_bugtracker WHERE bug_id={$_GET['id']}";
		$bugarray = $user->m_db->get_results($sql, ARRAY_A);
		$bugarray = count($bugarray) ? $bugarray : array();
		header('location: main.php');
	}

	$TBS = new clsTinyButStrong();
	$TBS->LoadTemplate('main.php');
	$TBS->MergeBlock('bug_blk', $bugarray);
	$TBS->show();
	exit;

 ?>
