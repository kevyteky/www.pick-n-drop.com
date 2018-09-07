<?php
set_time_limit(0);
include "PDO/connect.php";

error_log("made it to create it");


If (isSet($_POST['createC'])){
  $uzr = $_POST['createC'];  
  if(isSet($_POST['username'])){
    $cN = $_POST['username'];
  }
  if(isSet($_POST['useremail'])){
    $cE = $_POST['useremail'];
  }
  if(isSet($_POST['regID'])){
    $cID = $_POST['regID'];
  }
  $st = $db->prepare("INSERT into $uzr (uzrName, uzrEmail, regID) VALUES ('$cN', '$cE', '$cID')");
  $st->execute();
  if(!$st){
    error_log('client failed');
    echo json_encode("Rejected");
  }else{
    date_default_timezone_set('UTC');
    $timeCode = date("Y-m-d H:i:sa");
    $timetokill = date("Y-m-d H:i:sa", strtotime('+3 Hours'.strtotime($timeCode)));
    $regStart = $myusername.'Jk'.$timeCode.'09n_';
    $regCode = rand(1111,9999).'AKOPL'.hash('sha384', $regStart);
    error_log('client success');
    echo json_encode($regCode);
  }
}
  









?>