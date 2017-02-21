<?php

require_once('include/class.db.php');
require_once('include/class.user.php');
 include 'clickjacking.php';

$user = new user();
session_start();
if($_REQUEST)
{
	$bugid= $_REQUEST['bugid'];
	$sql = "SELECT check_id FROM my_bugtracker WHERE bug_id = '{$bugid}'";
	$checkid = $user->m_db->get_var($sql);
	if($checkid !='' && $checkid !=0)
	{
		$sql="SELECT * FROM my_table a LEFT OUTER JOIN my_bugtracker b ON a.id = b.check_id WHERE b.bug_id='{$bugid}'";
	}
	else
	{
		$sql="SELECT * FROM my_bugtracker WHERE bug_id='{$bugid}'";
	}
	$result = $user->m_db->get_row($sql,ARRAY_A);
	$result = count($result)? $result:array();
	$result['time_stamp'] = date("Y-m-d H:i:s",$result['time_stamp']);
	

}

header('Content-type: application/json');
$returnarray = array();
$returnarray['responsearray'] = $result;
$jsonstring = json_encode($returnarray);
print $jsonstring;

?>


