<?php
require_once('include/class.db.php');
require_once('include/class.user.php');
require_once('PHPMailer/PHPMailerAutoload.php');

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
		$result = $user->m_db->get_row($sql,ARRAY_A);
		$email_id=$result['email_id'];

		$sql= "UPDATE my_bugtracker SET check_id='', bug_resolve_time='' WHERE bug_id='{$_REQUEST['bugid']}'";
    	$user->m_db->query($sql);

          $mail = new PHPMailer;

                         

        $mail->isSMTP();                                      
		$mail->Host = 'smtp.gmail.com';                      
		$mail->SMTPAuth = true;                              
		$mail->Username = 'smritiraj1003@gmail.com';               
		$mail->Password = '8858003812';                           
		$mail->SMTPSecure = 'tls';                            
		$mail->Port = 587;                                    

        $mail->setFrom('smritiraj1003@gmail.com', 'Sender');
        $mail->addAddress($email_id);     
		$mail->addReplyTo('smritiraj1003@gmail.com', 'Information');
        $mail->isHTML(true);                                 
		$mail->Subject = 'Here is the subject';
        $mail->Body    = 'Somebody has tried to modify your data in the Bugtracker!!';

		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) 
        {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
        echo 'Message has been sent';
        }
    	
    }
    	}

?>

