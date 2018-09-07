<?php
set_time_limit(0);
include "PDO/connect.php";

error_log("made it to get it");


if (isSet($_POST['getClient'])){
  $table = $_POST['getClient'];  
  $st = $db->prepare("Select  uzrName, uzrEmail, firstname, lastname, company FROM $table");
  $st->execute();
  $results = $st->fetchALL();
  echo json_encode($results);
}






?>