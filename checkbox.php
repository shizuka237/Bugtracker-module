<?php
require_once('include/class.db.php');
require_once('include/class.user.php');
include 'clickjacking.php';

$user = new user();
session_start();
if($_REQUEST)
{
	$date=date('Y-m-d H:i:s');
	$sql= "UPDATE my_bugtracker SET check_id='{$_SESSION['userid']}' , bug_resolve_time='{$date}' WHERE bug_id='{$_REQUEST['bugid']}'";
	$user->m_db->query($sql);
}

?>
