<?php
require_once('include/class.db.php');
require_once('include/class.user.php');
require_once('PHPMailer/PHPMailerAutoload.php');
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

	$user->m_db->query($sql);


    $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'testbugtydy@gmail.com';                 // SMTP username
$mail->Password = '123@abc_123';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('testbugtydy@gmail.com', 'Sender');
$mail->addAddress($_REQUEST['email_id']);     // Add a recipient
$mail->addReplyTo('testbugtydy@gmail.com', 'Information');
$mail->isHTML(true);                                  // Set email format to HTML
//print"<PRE>";print_r($mail);print"</PRE>";exit;

$mail->Subject = 'Here is the subject';
//print $password;exit;
$mail->Body    = 'Bug tracker recovery procedure.Your password is '.$newpass.'';
//print $mail->Body;exit;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    if(!$mail->send()) 
    {
		$varmsg='Message could not be sent. Mailer error '.$mail->ErrorInfo.'';
  //  echo 'Message could not be sent.';
  //  echo 'Mailer Error: ' . $mail->ErrorInfo;
   //  echo '<script type="text/javascript">';
  //   echo 'alert("Message could not be sent. Mailer error '.$mail->ErrorInfo.'")';
  //   echo '</script>';
	
    } 
	else {
    $varmsg= 'Message has been sent';
    }

}
else
{
	if($_REQUEST['email_id']!="")
	{
		$varmsg="Not found your email in our database";
	}
}
	header('Content-type: application/json');
    $result2=array("varmsg"=>$varmsg);
    $returnarray=array();
    $returnarray['responsearray']=$result2;
	$jsonstring = json_encode($returnarray);
    print $jsonstring;

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

