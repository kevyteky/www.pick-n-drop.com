<?php

error_log(print_r(array_keys($_POST), true));
error_log(print_r(array_values($_POST), true));
//error_log(print_r(array_values($_POST)));
//error_log(print_r(array_keys($_GET)));
//error_log(print_r(array_values($_GET)));

if(isSet($_POST['from'])){
  $fr = $_POST['from'];
  $get = explode('@', $fr);
  $user = $get[0];
}if(isSet($_POST['to'])){
  $to = $_POST['to'];
}if(isSet($_POST['sub'])){
  $sub = $_POST['sub'];
}if(isSet($_POST['attach'])){
  $aTT = $_POST['attach'];
}if(isSet($_POST['body'])){
  $body = $_POST['body'];
}if(isSet($_POST['mFwd'])){
  $forward = $_POST['mFwd'];
}if(isSet($_POST['mRpy'])){
  $reply = $_POST['mRpy'];
}


$From = $fr; 
$Name = $user;
$To = $to;
require 'PHPMailer-master/PHPMailerAutoload.php';
include "PDO/connect.php";
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
$mail->Username = $fr;                                                     // SMTP username
$mail->Password = 'jN.9YobsAvFZ7.0c1s0LD9c1LEK8qQV';                       // SMTP password
$mail->SMTPSecure = 'tls';                                                 // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                                          // TCP port to connect to

$mail->setFrom($From, $Name);
$mail->addAddress($To, $user);                                             // Add a recipient
//$mail->addAddress('ellen@example.com');                                  // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//error_log("Forward= $forward");
if (!empty($aTT)){
  //error_log("attachement is set");
  //error_log("Forward= $forward");
  if(is_array($aTT)){
    $num = 1;
    //error_log("attachement is array");
    foreach ($aTT as $at){
      //error_log("This is number $num in Array= $at");
      try {
	$file = "/var/www/pick-n-drop.com/public_html/folderz/$user/emailAtt/$forward"."_".$at;
      }catch (Exception $e){
	$file = "/var/www/pick-n-drop.com/public_html/folderz/$user/tmp/$at";
      }
      $mail->addAttachment($file, $at);  
      $num++;     
    }
  }else{
    //error_log("attachement is only One= $aTT");
    //error_log("/var/www/pick-n-drop.com/public_html/folderz/$user/tmp/$aTT");
      $file = "/var/www/pick-n-drop.com/public_html/folderz/$user/tmp/$aTT";
      $mail->addAttachment($file, $aTT);
  }
}
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $sub;
$Message = "<pre>$body</pre>";
$mail->Body    = $Message;  // 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = $Message;  //'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
  $err = $mail->ErrorInfo;
  error_log("this is error:  $err");
  echo "Rejected:  $err";
} else {
  $emltime = date('YmdH-i-s-w');
  if (!empty($aTT)){
    if(is_array($aTT)){
      foreach ($aTT as $at){
        if ($forward != 0){
	  $File = "/var/www/pick-n-drop.com/public_html/folderz/$user/emailAtt/$forward"."_".$at;
	  $fileName =  $emltime.'_'. preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', '', $at);
	  copy($File, "/var/www/pick-n-drop.com/public_html/folderz/$user/emailAtt/sent/$fileName");
	}else{
	  $File = "/var/www/pick-n-drop.com/public_html/folderz/$user/tmp/$at";
	  $fileName =  $emltime.'_'. preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', '', $at);
	  rename($File, "/var/www/pick-n-drop.com/public_html/folderz/$user/emailAtt/sent/$fileName");
	  //file_put_contents("/var/www/pick-n-drop.com/public_html/folderz/$user/emailAtt/sent/".$fileName, $File);
	  //unlink($File);
	}
      }
    }else{
      $File = "/var/www/pick-n-drop.com/public_html/folderz/$user/tmp/".$aTT;
      $fileName =  $emltime.'_'. preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', '', $aTT);
      rename($File, "/var/www/pick-n-drop.com/public_html/folderz/$user/emailAtt/sent/$fileName");
      //file_put_contents("/var/www/pick-n-drop.com/public_html/folderz/$user/emailAtt/sent/".$fileName, $File);
      //unlink($File);
    }
  }
  error_log("Message Sent!");
  $att = "<strong>Attachment:</strong>&nbsp;";
  $mo = date('F');
  $moChk = $mo.'_sentchk';
  $time = date('l, jS - g:iA');
  $emailName = $emltime.'-.kml';
  $one = 1;
  $kml = "
<div id='$emltime' class='messShowSent' style='float:left;background-color:#000000;color:#FFFFFF;'><strong>Sent:<b/><$mo> $time<br>
<strong>To:</strong> &#60;$To&#62;<br>
<strong>Subject:</strong> ".((strlen($sub) > 50)? "<abbr title='$sub' >".substr($sub,0,36).'...</abbr>':$sub)."<br>
".((!empty($aTT))? $att : "");
  if(!empty($aTT)){
     if(is_array($aTT)){
       foreach ($aTT as $at){
	 $kml .= "<img class='$at' src='/IMG/addAtt.png' alt='$at' height='15' width='15'><a class='sentAtt' href='/folderz/$user/emailAtt/sent/".$emltime."_".$at."' download='$at'> ".((strlen($at) > 12)?"<abbr title='$at'>".substr($at,0,8)."...</abbr>":$at)." </a>";
         if(($one % 3) == 0){
	   $kml .= '<br>';
	 }
	 $one++;
       }
     }else{
         $kml .= "<img class='$aTT' src='/IMG/addAtt.png' alt='$aTT' height='15' width='15'><a class='sentAtt' href='/folderz/$user/emailAtt/sent/".$emltime."_".$aTT."' download='$aTT'> ".((strlen($aTT) > 40)?"<abbr title='$aTT'>".substr($aTT,0,38)."...</abbr>":$aTT)."</a>";
     }
  }     
  $kml .= "</div><div class='messOptions' style='float:right;'>
<img id='$To' class='mRply' src='/IMG/reply.png' alt='$emltime' title='Re: $sub' height='25' width='25'> <img class='mFwd' ".(($forward != 0)? "src='/IMG/forwarded.png'" : "src='/IMG/forward.png'")." alt='$emltime' title='FW: $sub' height='25' width='25'> ".(!empty($aTT)? "<img id='mAtt' src='/IMG/att.png' alt='Attachment is Set'  title='Attachment' height='25' width='25'>" : "<img id='mAtt' src='/IMG/attNo.png' alt='Attachment not Set'  title='No Attachments' height='25' width='25'>" )."<input type='checkbox' name='$emltime' class='$moChk' value='$emailName' title='Select for Delection' style='z-index:2;'>
</div>
<br><div id='show_$emltime' style='display:none;'><br><SPAN class='closeMessage' value='show_$emltime' style='float:right;color:#FFFFFF;background:#000000;font-size:20px;' >x</SPAN>
<br><br><br>
<PRE class='$emltime' style='float:left;margin-top:20px;'>
$Message
</PRE>
</div>";
  file_put_contents("/var/www/pick-n-drop.com/public_html/folderz/$Name/emailAtt/sent/".$emailName, $kml);
  if($forward != 0){
    try {
      $st = $db->prepare("INSERT into mResponse (user, mID, forwarded) VALUES ('$user', '$forward', 1)");
      $st->execute();
    }catch (Exception $e){
      $st = $db->prepare("UPDATE mResponse SET user = '$user', forwarded = 1 WHERE mID = '$forward'");
      $st->execute();
    }      
  }
  if($reply != 0){
    try {
      $st = $db->prepare("INSERT into mResponse (user, mID, replied) VALUES ('$user', '$reply', 1)");
      $st->execute();
    }catch (Exception $e){
      $st = $db->prepare("UPDATE mResponse SET user = '$user', replied = 1 WHERE mID = '$reply'");
      $st->execute();
    }
  }
  echo "Approved";
}

?>