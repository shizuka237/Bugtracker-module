<?php
	require_once('include/class.tbs.php');
	session_start();
    include 'clickjacking.php';

	require_once('include/class.user.php');

	if(empty($_SESSION['userid']))
    {
     header('Location:index.php');
	 exit;
	}
	$user = new user();

	$pagetitle = 'Home';
	
	$sql = "SELECT * FROM my_bugtracker WHERE 1 ORDER BY bug_id DESC";
	$bugarray = $user->m_db->get_results($sql, ARRAY_A);
	$bugarray = count($bugarray) ? $bugarray : array();
	foreach($bugarray as $key=>$val)
	{
		if(($val['check_id'] !='0') && (trim($val['check_id']) !='')) 
			$bugarray[$key]['ischecked'] = 1;
		else
			$bugarray[$key]['ischecked'] = 0;
	}
	//print"<PRE>";print_r($bugarray);print"</PRE>";exit;
	$TBS = new clsTinyButStrong();
	$TBS->LoadTemplate('main.html');
	$TBS->MergeBlock('bug_blk', $bugarray);
	$TBS->show();
	exit;

?>


