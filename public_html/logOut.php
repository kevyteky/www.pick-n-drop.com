<?php 
session_start();
$user = $_SESSION["mysession"];

$logOut = '$_POST["logOut"]';


if ($_POST = $logOut){
	session_destroy();
	header('location: index.php');
	
}

?>