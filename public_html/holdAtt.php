<?php
ob_start();
session_start();
$myusername = $_SESSION["mysession"];
$myemail = $_SESSION["myemail"];
$myusername = strtolower(ucwords($myusername));
$myemail = strtolower(ucwords($myemail));

if (!empty($_FILES)) {
  error_log("Not Empty");
  error_log("Set= ".$_FILES['file']['name']);
  $rName = $_FILES['file']['name'];
  $uploaddir = "/var/www/pick-n-drop.com/public_html/folderz/$myusername/tmp/";
  $uploadDir = "/var/www/pick-n-drop.com/public_html/folderz/$myusername";
  $uploadfile = $uploaddir . basename($_FILES['file']['tmp_name']);

  if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
    rename($uploadDir . $_FILES['file']['tmp_name'], $uploaddir . $rName);
    echo "<script> alert('File is valid, and was successfully uploaded.'); </script>";
  } else {
    echo "Possible file upload attack!\n";
  }
}else{
  error_log("is Empty");
}



?>