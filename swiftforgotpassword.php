<?php
require_once('include/class.db.php');
require_once('include/class.user.php');
require_once('swift/lib/swift_required.php');
//require_once('include/swift_required_pear.php');
include 'clickjacking.php';

$user = new user();
session_start();

$email_id=$user->m_db->escape($_REQUEST['email_id']);
$sql="SELECT * FROM my_table WHERE email_id='{$email_id}'";
$result = $user->m_db->get_row($sql,ARRAY_A);
$password=md5($_REQUEST['password']);
if(count($result))
{


    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $newpass= implode($pass);
	$new2pass=md5($newpass);
	$sql= "UPDATE my_table SET password='{$new2pass}' , confirm_password='{$new2pass}'  WHERE email_id='{$_REQUEST['email_id']}'";
	
	$user->m_db->query($sql);

    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
     ->setUsername('testbugtydy@gmail.com')
     ->setPassword('123@abc_123');
    print "yes";
    $mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance('Test Subject')
    ->setFrom(array('testbugtydy@gmail.com' => 'bug tracker '))
    ->setTo(array($_REQUEST['email_id']))
    ->setBody('Bug tracker recovery procedure.Your password is '.$newpass.'');

    $result = $mailer->send($message);
    
   
    if(!$result) 
    {
    echo 'Message could not be sent.';
  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
    echo 'Message has been sent';
    }
//     $rows=$user->m_db->get_row($result);
// 	$pass=$rows['password'];
// 	$to=$rows['email_id'];
// 	$from="bug tracker";
// 	$url="http://www.codingcy.com";
//     $body  =  "Coding Cyber password recovery Script
//         -----------------------------------------------
//         Url : $url;
//         email Details is : $to;
//         Here is your password  : $pass;
//         Sincerely,
//         Coding Cyber";


//     $from = "dp@gmail.com";
//     $subject = "Bug tracker Password recovered";
//     $headers1 = "From: $from\n";
//     $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
//     $headers1 .= "X-Priority: 1\r\n";
//     $headers1 .= "X-MSMail-Priority: High\r\n";
//     $headers1 .= "X-Mailer: Just My Server\r\n";
//     // $sentmail = 1;//mail($to, $subject, $body, $headers1 );
//     if($result)
//     {
//     echo "Your password has been sent to your mail address";

//     }
//     else
//     {
//         if($_REQUEST['email_id']!="")
//         {
//         echo "Cannot send password to your e-mail address.Problem with sending mail...";
//         }
//     }
}
else
{
	if($_REQUEST['email_id']!="")
	{
		echo "Not found your email in our database";
	}
}
// if($sentmail==1)
// {
// 	echo "Your password has been sent to your mail address";

// }
// else
// {
// 	if($_REQUEST['email_id']!="")
// 	{
// 		echo "Cannot send password to your e-mail address.Problem with sending mail...";
// 	}
// }

?>


