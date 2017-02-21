<?php

require_once('include/class.db.php');
require_once('include/class.user.php');
  include 'clickjacking.php';

$user = new user();
session_start();

//$user->m_db->escape();
$email_id=$user->m_db->escape($_REQUEST['email_id']);
$password=md5($_REQUEST['password']);
//$password=md5($password);
//print '$password';

$sql="SELECT * FROM my_table WHERE email_id='{$email_id}' and password='{$password}'";
$result = $user->m_db->get_row($sql,ARRAY_A);

if(count($result))
{
	$issuccess=1;
}
else
	$issuccess=0;

//print_r($result);
/*if($result.length==1)
{
	window.location="main.html";
	
}
*/
$_SESSION['userid'] = $result['id'];
header('Content-type: application/json');
$returnarray = array();
$returnarray['responsearray'] = $result;
$returnarray['issuccess'] = $issuccess;
$jsonstring = json_encode($returnarray);
print $jsonstring;


/*if($_POST)
{
	$email_id=trim($_POST['username']);
	$password=trim($_POST['userpassword']);

	//$password = MD5($password);
	
    $sql="SELECT id FROM my_table WHERE email_id='{$email_id}' AND password='{$password}'";
	$num_row=$user->m_db->get_var($sql);
//	$row=mysqli_fetch_array($result);

    

	if($num_row==1)
	{
		$_SESSION['email_id']="true";

		header("Location: index.html");
		exit;
	}
	else
	{
		echo "Your Login Name or Password is invalid";
	}
}*/
//echo "finish";
?>

