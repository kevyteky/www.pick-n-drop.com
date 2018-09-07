<?php/////////////////////////////  PHPMailer  Start //////////////////////////////////////////////////
  
$subscriber = $myemail;
$user = $myusername;

$From = 'pickndrop@kenosia.net'; 
$Name = 'Postmaster';
$To = $subscriber;
require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->smtpConnect([
		    'ssl' => [
			      'verify_peer' => false,
			      'verify_peer_name' => false,
			      'allow_self_signed' => true
			      ]
		    ]);
$mail->Host = 'mail.kenosia.net;127.0.0.1';                                // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                                                    // Enable SMTP authentication
$mail->Username = 'postmaster@kenosia.net';                                // SMTP username
$mail->Password = 'Zen!vEdk-#sjw7x2';                                      // SMTP password
$mail->SMTPSecure = 'tls';                                                 // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                                          // TCP port to connect to

$mail->setFrom($From, $Name);
$mail->addAddress($To, $user);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = "Welcome to the Language Services PickUp & DropOff";
$Message = "<pre>Hello $user, 

     You are receiving this email to acknowledge and approve your email address for validation to <a href='https://www.pick-n-drop.com/subscribed.php?verify=$To' target='_blank'>Language Services PickUp & DropOff</a>.

If you have any comments / questions do not reply to this email.

Send comments / questions to <i>Language Services PickUp & DropOff</i> <a href='http://www.pick-n-drop.com/?siteMenuOption=Contact%20Us' target='_blank'>Contact Page</a>.

     <b>In order to comfirm you credentials to log on you must,</b> <a href='https://www.pick-n-drop.com/subscribed.php?verify=$To' target='_blank'><input type='button' value='Verify $To' style='background-color:#0071c1;color:white;text-align:white;' /></a>.

Thank you, 
Language Services PickUp & DropOff.
Registration Center</pre>";
$mail->Body    = $Message;  // 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = $Message;  //'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
  error_log("this is error:\n  $mail->ErrorInfo");
  echo "<script> alert('Message Could Not Be Sent\n $mail->ErrorInfo'); </script>";
  // echo '<script>window.location="http://pick-n-drop.com?menuOption=Contact Us";</script>';
  header('Location: http://www.pick-n-drop.org/register.php'); //?siteMenuOption=Contact Us');
} else {
  echo '<script> alert("Email has been sent to '.$To.' for your confirmation "); </script>';
  header("Location: https://www.pick-n-drop.com/subscribed.php?thankYou=$user&subcriber=$To");
}
}


?>