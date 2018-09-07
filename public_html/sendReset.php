<?php
/////////////////////////////  PHPMailer  Start //////////////////////////////////////////////////
echo "<!DOCTYPE html><html><head>";
print_r(array_keys($_POST));
echo "<br />";
print_r(array_Values($_POST));
echo "<br />";
print_r(array_keys($_GET));
echo "<br />";
print_r(array_Values($_GET));
echo "<br />";

require 'PDO/connect.php';
echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
echo "</head><body>";

if(isSet($_POST['sendReset'])){  
  $subscriber = $_POST['sendReset'];
  $st = $db->prepare("Select uzrName from uzerz WHERE uzrEmail = '$subscriber'");
  $st->execute();
  $uzr = $st->fetch();
  error_log("this is the subcriber= $subscriber");
  if($uzr['uzrName'] == ''){
    echo "<script> var user = $subscriber; alert('Request Could Not Be Sent\n '+user+' not found'); </script>";
    header('Location: http://www.pick-n-drop.com/register.php');
    die();
  }else{
    $user = $uzr['uzrName'];
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
    $mail->AddEmbeddedImage("/var/www/pick-n-drop.com/public_html/IMG/pick-n-drop.png", "siteLogo", "/var/www/pick-n-drop.com/public_html/IMG/pick-n-drop.png");
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Password Request Confirmation ";
    $Message = "<pre>Hello $user, 

     You have requested to change your password or to retrive your username using our <i>Forgot Username or Password</i> function.  If you are not the one who requested this change, then please disregard this email.  If you feel this is a malicious attemp to compromise your account please send concerns / questions to <i>PickUp & DropOff</i> <a href='http://www.pick-n-drop.com/?register=Contact%20Us' target='_blank'>Contact Page</a>.

     <b>If this was indeed you who requested this change please confirm this link which will be active for three hours once you recieve your registration code for password change.   <a href='https://www.pick-n-drop.com/passReset.php?verify=$To&user=$user' target='_blank'><input type='button' value='Verify $To' style='background-color:#000000;color:white;text-align:white;' /></a>.

Thank you, 
PickUp & DropOff.
<img src='cid:siteLogo'>
Registration Center</pre>";
    $mail->Body    = $Message;  // 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = $Message;  //'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
      error_log("this is error:\n  $mail->ErrorInfo");
      echo "<script> alert('Message Could Not Be Sent\n $mail->ErrorInfo'); </script>";
      header('Location: http://www.pick-n-drop.com/register.php');
    } else {
      echo '<script> alert("Email has been sent to '.$To.' check your account for your confirmation!"); </script>';
      header("Location: https://www.pick-n-drop.com/register.php?thankYou=$user&subcriber=$To");
    }
  }
}

echo "</body></html>";

?>