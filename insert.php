<?php
require_once('include/class.db.php');
require_once('include/class.user.php');
include 'clickjacking.php';

$user = new user();

/*if(($_POST['submitform']))
{*/
	$first_name=$user->m_db->escape($_POST['first_name']);
	$last_name=$user->m_db->escape($_POST['last_name']);
	$email_id=$user->m_db->escape($_POST['email_id']);
	$phone_number=$user->m_db->escape($_POST['phone_number']);
    $password=md5($_POST['password']);

//	$password=md5($password);
	$confirm_password=md5($_POST['confirm_password']);

//	$confirm_password=md5($confirm_password);
/*	if($first_name!=''&&$last_name!=''&&$email_id!=''&&$phone_number!=''&&$password!=''&&$confirm_password!='')
	{*/
		$query=mysql_query("INSERT INTO my_table(first_name,last_name,email_id,phone_number
			,password,confirm_password)VALUES('$first_name','$last_name','$email_id','$phone_number'
				,'$password','$confirm_password')");
	//    header("Location: index.html");
	//	exit;
		//echo "<br/><br/><span>Data Inserted Successfully...!!</span>";
	
/*	else
	{
		echo"<p>Insertion Failed...Some fields are blank... !!</p>";
	}*/

	mysql_close($connection);
?>

