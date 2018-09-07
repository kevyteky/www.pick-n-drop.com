<?php 
$m = $myusername.'@pick-n-drop.com';  
  
$ref = 0;
$one = 1;
$pMo = '';

echo "<DIV id='sentM' class='emailSentWrapper' style='width:100%;height:200px;overflow-y:auto;display:none;'>";

$path = "/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/sent/";
$files = scandir($path, 1);
$files = array_diff($files, array('.','..'));
$pMo = '';
if (count($files) == 0){
  echo "<br><span style='width:99%;float:left;background-color:#000000'><input class='noSentMessages' type='text' value='No Messages' style='width:100%;background-color:#000000;color:#FFFFFF;text-align:center;' READONLY/>";
}else{
  for($i=0;$i<=count($files);$i++){
    if (strpos($files[$i], '-.kml') !== false){
      $getMo = explode('-', $files[$i]);
      $getMo = $getMo[0];
      $getObj = substr($getMo, 4, 2); 
      $moObj = DateTime::createFromFormat('!m', $getObj);
      $mo = $moObj->format('F');
      if ($mo !== $pMo){
	$cN = $mo.'S';
	echo "<div style='width:99.9%;float:left;background-color:#000000'><input class='$cN' type='text' value='$mo' title='Click to hide $mo emails' style='width:90%;background-color:#000000;color:#FFFFFF;text-align:center;' READONLY/><input type='checkbox' id='deleteSent_$mo' value='$one' title='Select all of $mo' style='' /></div>";
	$pMo = $mo;
      }
      $location = "/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/sent/$files[$i]";
      $fp = fopen($location, "r");
      echo "<DIV id='EvenorODD' class='".$mo."_sent' name='$files[$i]' style='display:inline-block;width:100%;text-align:left'>";
      fpassthru($fp);
      echo "</DIV>";
    }
    $one++;
  }
}
echo "</DIV>";

?>