<?php
echo "<!DOCTYPE html><html><head>";
require 'PDO/connect.php';
print_r(array_keys($_POST));
echo "<br />";
print_r(array_Values($_POST));
echo "<br />";
print_r(array_keys($_GET));
echo "<br />";
print_r(array_Values($_GET));
echo "<br />";

echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script></head><body>";
echo "<DIV id='mainHeader' align='right' style='min-height:4%;background-color:#000000;'>";
echo "<img id='userStatus' src='/IMG/loggedOff.png' alt='loggedOff'  height='35', width='35'>";
echo "</DIV>";
echo "<DIV align='center'><img id='siteLogo' src='/IMG/pick-n-drop.png' alt='Logo'  height='150', width='155'></div>";
if(isSet($_GET['verify'])){
  error_log("Madie it");
  $user = $_GET['user'];
  $userE = $_GET['verify'];
  date_default_timezone_set('UTC');
  $timeCode = date("Y-m-d H:i:sa");
  $timetokill = date("Y-m-d H:i:sa", strtotime('+3 Hours'.strtotime($timeCode)));
  $regStart = $userE.'Jk'.$timeCode.'_ArmStronS0|uT!0n_'.$user;
  $regCode = 'Zv1KK$'.hash('sha384', $regStart);
  //echo "$timetokill";
  $st = $db->prepare("UPDATE uzerz SET regID = '$regCode', uzrPword = '', uzrPtlas = '' WHERE uzrName = '$user'");
  $st->execute();
  $eventName = $user.'_deleteID';
  try {
    $stD = $db->prepare("CREATE EVENT $eventName ON SCHEDULE AT '$timetokill' DO UPDATE uzerz SET regID='' WHERE regID = '$regCode'");
    $stD->execute();
    if(!$stD){
      $stD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
  }catch(PDOException $e){
    $error = str_replace('SQLSTATE[HY000]: General error: 1537 ','',$e->getMessage());
    if ($error === "Event '$eventName' already exists"){
      $stK = $db->prepare("ALTER EVENT $eventName ON SCHEDULE AT '$timetokill' DO UPDATE uzerz SET regID='' WHERE regID = '$regCode'");
      $stK->execute();
      echo "<h2>Thank you for verifying your email address.  Your old password is now longer in use and you will need to create a new one.</h2><br/>";
      echo "<h3>You may now use the below registration code to enter a new password.</h3><br/>";
      echo "<h3>Registration#: <span>$regCode</span></h3>";
      echo "<h4>Please copy and paste it into registration field on <a href='https://www.pick-n-drop.com/register.php?regCode=$regCode&eml=$userE&user=$user' target='_blank' onclick='window.close();'>Registration</a> page.<br/>Also, please note username & email must be identical to previous.</h4>";
    } 
  }
}

echo "</body></html>";
?>

