<?php
set_time_limit(0);
include "PDO/connect.php";

error_log("made it to check it");

if(isSet($_POST['email'])){
  $address = strtolower($_POST['email']);
  $split = explode('@', $address);
  $id = $split[0];
  $domain = str_replace(' ','', $split[1]);
  //error_log("id= $id & domain= $domain"); 

  $chkDomain = checkdnsrr($domain,'MX');
  
  if ($chkDomain == True){
    $chkAddress = True;
  }else{
    echo json_encode("no MX Record found for $domain, Please try again");
    die();
  }

  if($_POST['partOf'] == 'peer'){
    $domains = ['Accredited'=>'accreditedlanguage.com','Alsintl'=>'alsintl.com','Legal'=>'legallanguage.com','University'=>'universitylanguage.com'];
    //error_log("this is the Domain= $domain");    
    if ($domain != 'accreditedlanguage.com' && $domain != 'legallanguage.com' && $domain != 'universitylanguage.com' && $domain != 'alsintl.com'){
      $error = "Employees must use a company regulated email address to register on Pick~N~Drop site"; 
      echo json_encode($error);
      die();
    }
  }elseif(isSet($_POST['partOf'])){
    $uzerOf = str_replace('@', '_', $_POST['partOf']);
    $uzerOf = substr($uzerOf, 0, strrpos($uzerOf, '.'));
  }
  
  if ($chkAddress == True){
    $st = $db->prepare("SELECT table_name FROM information_schema.columns WHERE column_name='uzrEmail'");
    $st->execute();
    $search = $st->fetchAll();
    $n = 0;
    foreach ($search as $table){
      error_log('these are the tables= '.$table[0]);
      $n++;
    }
    foreach ($search as $table){
      $st = $db->prepare("SELECT count(*) FROM $table[0] WHERE uzrEmail='$address'");
      $st->execute();
      $count = $st->fetchColumn();
      if($count==1){
	echo json_encode('Email is already registered with Pick-n-Drop.com'); 
	die();
      }
    }
    if($count==0){
      echo json_encode('Accepted');
    }
    /*
    if ($_POST['setup'] == 'client'){
      $st = $db->prepare("SELECT count(*) FROM $uzerOf WHERE uzrEmail='$address'"); 
      $st->execute();
      $count = $st->fetchColumn();
    }else{
      $st = $db->prepare("SELECT count(*) FROM uzerz WHERE uzrEmail='$address'"); 
      $st->execute();
      $count = $st->fetchColumn();
    }
    if($count==1){
      echo json_encode('Rejected'); 
    }else{
      echo json_encode('Accepted');
    }
    */
  }     
}
/*
if(isSet($_POST['username'])){
  $name = strtolower($_POST['username']);
  $st = $db->prepare("SELECT count(*) FROM uzerz WHERE uzrName='$name'"); 
  $st->execute();
  $count = $st->fetchColumn();
  if($count==1){
    echo json_encode('Rejected'); 
  }else{
    echo json_encode('Accepted');
  }
}
*/
if(isSet($_POST['username'])){
  $name = strtolower($_POST['username']);
  $st = $db->prepare("SELECT table_name FROM information_schema.columns WHERE column_name='uzrName'");
  $st->execute();
  $search = $st->fetchAll();
  $n = 0;
  foreach ($search as $table){
     error_log($table[0]);
     $n++;
  }
  foreach ($search as $table){
    $st = $db->prepare("SELECT count(*) FROM $table[0] WHERE uzrName='$name'");
    $st->execute();
    $count = $st->fetchColumn();
    if($count==1){
      echo json_encode('Rejected'); 
      die();
    }
  }
  if($count==0){
    echo json_encode('Accepted');
  }
}

if(isSet($_POST['regID'])){
  //error_log('made it to regID check');
  $regID = $_POST['regID'];
  $s = $db->prepare("SHOW TABLES");
  $s->execute();
  $results = $s->fetchAll();
  $seq = substr($regID,0,3);
  if ($seq == 'Zv1'){
    $st = $db->prepare("SELECT uzrName, uzrEmail FROM uzerz WHERE regID='$regID'"); 
    $st->execute();
    $r = $st->fetch();
    error_log("this is the call= ".$r['uzrName']);
    if($r['uzrName'] != null){
      $uName = $r['uzrName'];
      $eMail = $r['uzrEmail'];
      header("location: https://pick-n-drop.com?uName=$uName&uMail=$eMail&regCode=$regID");
      exit();
    }
  }
  if (is_numeric($seq)){
    $userIs = 'client';
  }else{
    $userIs = 'employee';
  }
  //error_log('User is= '.$userIs);
  if($userIs == 'employee'){
    $st = $db->prepare("SELECT domain FROM regID WHERE regID='$regID'"); 
    $st->execute();
    $result = $st->fetchColumn();
    //error_log("result is= $result"); 
    if($result == null){
      echo json_encode('Rejected'); 
    }else{
      echo json_encode($result);
    }
  }else{
    foreach($results as $Employee){
      if($Employee == 'uzerz' xor $Employee == 'regID' xor $Employee == 'containerz' xor $Employee == 'pickups' xor $Employee == 'drops'){
	continue;
      }
      $st = $db->prepare("SELECT count(*) FROM $Employee WHERE regID='$regID'"); 
      $st->execute();
      $count = $st->fetchColumn();
      if($count==1){
	echo json_encode('Rejected'); 
      }else{
	echo json_encode($Employee);
      }
    }
  }
}


?>