<?PHP

print_r(array_keys($_POST));
echo "<br />";
print_r(array_Values($_POST));
echo "<br />";
print_r(array_keys($_GET));
echo "<br />";
print_r(array_Values($_GET));

require 'PDO/connect.php';

// username and password sent from form 
$myusername = strtolower($_POST['myusernameis']); 
$mypassword = $_POST['mypasswordis'];
$myemail = strtolower($_POST['myemailis']);

// To protect MySQL injection (more detail about MySQL injection)  /// Not needed with using Prepare statements
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
//$myusername = mysql_real_escape_string($myusername);
//$mypassword = mysql_real_escape_string($mypassword);

$uzr = substr($myusername,1,-2).' PLaYwrIgHt'.substr($myusername,1,-1);
//error_log('this is whats being hased= '.$uzr);
$Tlas = password_hash($uzr, PASSWORD_DEFAULT); 
$mypassword = password_hash($mypassword, PASSWORD_BCRYPT);

if(isSet($_POST['updateOnly'])){
  $regID = $_POST['myRegistration#'];
  $st = $db->prepare("SELECT uzrName FROM uzerz WHERE regID = '$regID'");
  $st->execute();
  $a = $st->fetch();
  $user = $a['uzrName'];
  if($user == ''){
    echo "<script> var Mess = 'Sorry, Registration code $regID <br/>is no longer valid!'; var subscriber = '$myusername'; </script>";
    echo "<script> alert('Sorry your request has been denied!  Please note error and Try Again.'); window.location.href = 'https://pick-n-drop.com/index.php?error=Mess&user=subscriber</script>";
  }else{
    $st = $db->prepare("UPDATE uzerz SET uzrPword = '$mypassword', uzrPtlas = '$Tlas' WHERE regID = '$regID'");
    $st->execute();
    $st = $db->prepare("UPDATE uzerz SET regID = '' WHERE regID = '$regID'");
    $st->execute();
    header("Location: https://www.pick-n-drop.com/subscribed.php?updated=$user");
  }
}

$dC = date('Y-m-d');
try {
  $st = $db->prepare("INSERT INTO uzerz (uzrName, uzrPword, uzrPtlas, uzrEmail, dateCreated) VALUES ('$myusername', '$mypassword', '$Tlas', '$myemail', '$dC')");
  $st->execute();
  if(!$st){
    $st->$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }else{
    $send = True;
  }
}catch (PDOException $e){
  error_log($e->getMessage());
  $temp = str_replace("SQLSTATE[23000]: Integrity constraint violation: 1062","****ERROR:: ", $e->getMessage());
  $temp = str_replace("'","\"", $temp);
  echo "<script> var Mess = '$temp'; var subscriber = '$subscriber'; </script>";
  echo "<script> alert('Sorry your request has been denied!  Please note error and Try Again.'); window.location.href = 'https://pick-n-drop.com/index.php?error=Mess&user=subscriber</script>";
  die();
}

if($_POST['userIs'] == 'peer'){ 
  $email = str_replace('@','_',$myemail);
  $email = str_replace('.com','',$email);
  error_log("this is the email= $email");
  try{
    $st = $db->prepare("CREATE TABLE $email (
                                               id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                               firstname VARCHAR(30),
                                               lastname VARCHAR(30),
                                               company VARCHAR(100),
                                               city_state_country VARCHAR(255),
                                               uzrEmail VARCHAR(100) UNIQUE,
                                               regID VARCHAR(110) NOT NULL UNIQUE
                                              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    $st->execute();
    if(!$st){
      $st->$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }else{
      $peer = True;
    }
  }catch(PDOException $e){
    error_log($e->getMessage());
    $temp = str_replace("SQLSTATE[23000]: Integrity constraint violation: 1062","****ERROR:: ", $e->getMessage());
    $temp = str_replace("'","\"", $temp);
    echo "<script> var Mess = '$temp'; var subscriber = '$myusername'; </script>";
    echo "<script> alert('Sorry your request has been denied!  Please note error and Try Again.'); window.location.href = 'https://pick-n-drop.com/index.php?error=Mess&user=subscriber</script>";
    die();
  }
}

if($send == True){ ///////////////////////////////////////////////////////////////////////// Create Folder & Send Welcome verification email.
  $subscriber = $myemail;
  $user = $myusername;
  $DIR = getcwd();
  $folder = $DIR."/folderz/$myusername";
  $container = $DIR."/containerz/$myusername";

  if (file_exists($folder)){
    continue;
  }else{
    //$old = umask(0);
    mkdir($DIR."/folderz/$user", 0754, true);
    mkdir($DIR."/folderz/$user/tmp", 0754, true);
    //umask($old);
    //chown($DIR."/folderz/$user", 'www-data');
    //$old = umask(0);
    mkdir($DIR."/folderz/$user/emailAtt", 0754, true);
    //umask($old);
    mkdir($DIR."/folderz/$user/emailAtt/sent", 0754, true);
  }
  if (file_exists($container)){
    continue;
  }else{
    // $old = umask(0);
    mkdir($DIR."/containerz/$user", 0754, true);
    //umask($old);
    //chown($DIR."/containerz/$user", 'www-data');
  }
  
  include "PDO/connectM.php";

  $eml = $myusername.'@pick-n-drop.com';
  $addThis = $eml.':{PLAIN}jN.9YobsAvFZ7.0c1s0LD9c1LEK8qQV';
  if (strpos(file_get_contents("/etc/dovecot/users"), $addThis) !== false){
    $fl = file_put_contents("/etc/dovecot/users", $addThis.PHP_EOL , FILE_APPEND | LOCK_EX);
  }
  try {
    $st = $dd->prepare("INSERT INTO virtual_users (domain_id, password, email) VALUES (5, 'jN.9YobsAvFZ7.0c1s0LD9c1LEK8qQV', '$eml')");
    $st->execute();
    if(!$st){
      $st->$dd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
  }catch (PDOException $e){
    error_log($e->getMessage());
  }
  
  $From = 'DoNotRespond@pick-n-drop.com'; 
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
  $mail->Username = 'postmaster@pick-n-drop.com';                            // SMTP username
  $mail->Password = 'EatMe123';                                              // SMTP password
  $mail->SMTPSecure = 'tls';                                                 // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 25;                                                          // TCP port to connect to
  
  $mail->setFrom($From, $Name);
  $mail->addAddress($To, $user);     // Add a recipient
  //$mail->addAddress('ellen@example.com');               // Name is optional
  $mail->addReplyTo('donotrespond@pick-n-drop.com', 'DNR');
  //$mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');
  //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  $mail->AddEmbeddedImage("/var/www/pick-n-drop.com/public_html/IMG/pick-n-drop.png", "siteLogo", "/var/www/pick-n-drop.com/public_html/IMG/pick-n-drop.png");
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = "Welcome to the PickUp & DropOff Site";
  $Message = "<pre>Hello $user, 

     You are receiving this email to acknowledge and approve your email address for validation to <a href='https://www.pick-n-drop.org/subscribed.php?verify=$To' target='_blank'>PickUp & DropOff</a> site.

If you have any comments / questions do not reply to this email.

Send all comments / questions to <i>PickUp & DropOff</i> <a href='https://www.pick-n-drop.com/?siteMenuOption=Contact%20Us' target='_blank'>Contact Page</a>.

     <b>In order to comfirm you credentials to log on you must,</b> <a href='https://www.pick-n-drop.com/subscribed.php?verify=$user&subscriber=$To' target='_blank'><input type='button' value='Verify $To' style='background-color:#0071c1;color:white;text-align:white;' /></a>.

Thank you, 
Language Services PickUp & DropOff.
<img src='cid:siteLogo'>
Registration Center</pre>";
  $mail->Body    = $Message;  // 'This is the HTML message body <b>in bold!</b>';
  $mail->AltBody = $Message;  //'This is the body in plain text for non-HTML mail clients';
  
  if(!$mail->send()) {
    error_log("this is error:\n  $mail->ErrorInfo");
    $Mess = $mail->ErrorInfo."'; var subscriber = '$user'; alert('Message Could Not Be Sent\n $mail->ErrorInfo'); </script>";
    header('Location: https://www.pick-n-drop.com/index?error=Mess&user=subscriber');
  } else {
    echo '<script> alert("Email has been sent to '.$To.' for your confirmation "); </script>';
    header("Location: https://www.pick-n-drop.com/subscribed.php?thankYou=$user&subcriber=$To");
  }
}


?>

