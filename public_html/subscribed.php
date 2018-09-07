<?php

print_r(array_keys($_POST));
echo "<br />";
print_r(array_Values($_POST));
echo "<br />";
print_r(array_keys($_GET));
echo "<br />";
print_r(array_Values($_GET));

require 'PDO/connect.php';

echo "<!DOCTYPE html><HTML>";
if(isSet($_GET['thankYou'])){
echo "<TITLE>PickUp & DropOff Registration Process </TITLE>";
}
if(isSet($_GET['updated'])){
echo "<TITLE>PickUp & DropOff Password Changed </TITLE>";
}
echo "<BODY>";
echo "<DIV id='mainHeader' align='right' style='min-height:5.5%;background-color:#000000;'>";
echo "<div style='display:inline-block;margin-right:65px;'><img id='userStatus' src='/IMG/loggedOff.png' alt='loggedOn'  height='50', width='55'></div style='display:inline-block;'><br/><div><table bgcolor='#000000' style='border: 1px solid black;'><tr><td width='175px' align='center' height='15px' style='background-color:#000000;color:#FFFFFF;'>".(($myusername != null)? $myusername : '')."</td></tr><td id='logOut' align='center' width='120px' style='background-color:#000000;color:#000000;'><form ".(($myusername != null)? "name='logOut' action='logOut.php' " : "name='logOn' action='index.php'")." method='POST' ><input type='submit' ".(($myusername != null)? "value='LogOut'" : "value='LogIn'")." style='width:50%;height:100%;background-color:#FFFFFF;color:#000000;'></form></td></tr></table></div>";
echo "</DIV>";
echo "<DIV align='center' style='height:25%;width:98%;position:absolute'>";
echo "<DIV align='center' style='height:25%;width:35%;margin-top:5cm'>";
echo "<img id='siteLogo' src='/IMG/pick-n-drop.png' alt='Logo'  height='150', width='155'>";
if(isSet($_GET['thankYou'])){
  $user = $_GET['thankYou'];
  $email = $_GET['subcriber'];
  echo "<H2>Thank you $user, for registering with <br/><i>PickUp & DropOff</i>,<br/>please check your email [$email] to complete the registration process to being uploading and downloading files.</H2><br/>";
}
if(isSet($_GET['updated'])){
  $user = $_GET['updated'];
  echo "<H2>Thank you $user, for updating your credentials with <br/><i>PickUp & DropOff</i>,<br/>You may now log in using your passcode and continue uploading and downloading files with your new password.</H2><br/>";
}
if(isSet($_GET['verify'])){
  $user = $_GET['verify'];
  $email = $_GET['subcriber'];
  try {
    $st = $db->prepare("UPDATE uzerz SET isValidated=1 WHERE uzrName = '$user'");
    $st->execute();
    if(!$st){
      $st->$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }else{
      echo "<H2>Thank you $user, for validating your email address with <br/><i>PickUp & DropOff</i>.<br/>You are now registered to logon and begin uploading and downloading files.</H2><br/>";
    }
  }catch(PDOException $e){
    error_log($temp = $e->getMessage());
    $temp = str_replace("SQLSTATE[23000]: Integrity constraint violation: 1062","****ERROR:: ", $e->getMessage());
    $temp = str_replace("'","\"", $temp);
    echo "<H2>Sorry $user, something went wrong with  validating your email address with <br/><i>PickUp & DropOff</i>.<br/>You you can still try to logon with the credentials you've created, but if you feel you reached this page due to no fault of your own, please leave us a message on the <a href='https://www.workspace.com/contactUs.php?era=$temp' target='_blank'><i>Contact Page</i></a>.</H2><br/>";
  }
}
echo "</DIV>";
echo "</BODY>";
echo "</HTML>";

?>