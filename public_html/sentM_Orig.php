<?php 
$m = $myusername.'@pick-n-drop.com';  

$mbox = imap_open("{pick-n-drop.com:143/imap/novalidate-cert}Sent", "$m", "jN.9YobsAvFZ7.0c1s0LD9c1LEK8qQV", OP_READONLY)  //, OP_READONLY
    or die("can't connect: " . imap_last_error());

$MC = imap_check($mbox);

$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
$result = array_reverse($result);
  
$ref = 0;
$one = 1;
$pMo = '';
echo "Sent";
echo "<DIV id='sentM' class='emailWrapper' style='width:100%;height:200px;overflow-y:auto;display:none;'>";
  //if (empty($result)){
  //echo "<br><span style='width:99%;float:left;background-color:#000000'><input class='$cN' type='text' value='No Messages' style='width:100%;background-color:#000000;color:#FFFFFF;text-align:center;' READONLY/>";
  //}
foreach ($result as $overview) {      
  $mID = "showMess".$ref;
  $aID = "showAtt".$ref;
  $emltime = date('F-y-w-d-Hi', strtotime($overview->date));
  $time = date('l, jS - g:iA', strtotime($overview->date));
  $att = imap_fetchstructure($mbox, $overview->msgno);
  $mN = $overview->msgno;
  //print_r($att);
  //echo exec('whoami');
  $file = $att->parts[1]->parameters[0]->value;
  //echo "this is the count= ". $attFiles = count($att->parts);
  //$file = $att->parts[1]->dparameters[0]->value;
  $encoding = $att->parts[1]->encoding;
  if (strtolower($file) !== 'utf-8'){
    $filename = $file;
    $mess = imap_fetchbody($mbox, $overview->msgno, 1.1);
    $attachments = array();
    $attNames = array();
    if(isset($att->parts) && count($att->parts)) {
      for($i = 0; $i < count($att->parts); $i++) {
	$attachments[$i] = array(
				 'is_attachment' => false,
				 'filename' => '',
				 'name' => '',
				 'attachment' => '');
	
	if($att->parts[$i]->ifdparameters) {
	  foreach($att->parts[$i]->dparameters as $object) {
	    if(strtolower($object->attribute) == 'filename') {
	      $attachments[$i]['is_attachment'] = true;
	      $attachments[$i]['filename'] = $object->value;
	    }
	  }
	}
	
	if($att->parts[$i]->ifparameters) {
	  foreach($att->parts[$i]->parameters as $object) {
	    if(strtolower($object->attribute) == 'name') {
	      $attachments[$i]['is_attachment'] = true;
	      $attachments[$i]['name'] = $object->value;
	    }
	  }
	}
	if($attachments[$i]['is_attachment']) {
	  $attachments[$i]['attachment'] = imap_fetchbody($mbox, $overview->msgno, $i+1);
	  $fileName =  'rf_'.$overview->msgno.'-'. preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', '', iconv_mime_decode(utf8_decode(imap_utf8($attachments[$i]['filename']))));
	  $File = "/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/sent/".$fileName;
	  if($att->parts[$i]->encoding == 3) { // 3 = BASE64	       
	    array_push($attNames, $fileName);
	    $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
	    //if (!is_file($File)){
	    //echo "FILE HAS BEEN PLACED!";
	    file_put_contents("/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/sent/".$fileName, $attachments[$i]['attachment']);
	    //}
	  }            
	  elseif($att->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
	    array_push($attNames, $fileName);
	    $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
	    //if (!file_exists($File)){
	    file_put_contents("/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/sent/".$fileName, $attachments[$i]['attachment']);
	    //}
	  }
	}             
      } // for($i = 0; $i < count($att->parts); $i++)
    } 
  }else{
    $mess = imap_fetchbody($mbox, $overview->msgno, 1);
    if(isSet($filename)){
      unset($filename);
    }
  }
  $emailName = $emltime.'-.kml';
  //$mesS = imap_savebody($mbox, "/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/sent/".$emailName, $overview->msgno, 1);
  $header = imap_headerinfo($mbox, $overview->msgno);
  $from = $header->from[0]->mailbox.'@'.$header->from[0]->host;
  $mess = utf8_encode($mess);
  $moChk = $mo.'_chk';
  $one = 1;
  $aTT = "<b>Attachment:</b>&nbsp;";
  foreach ($attNames as $val){
    $showVal = preg_replace('/rf_(.*)-/', '', $val);
    $aTT .= "($one)<a href='/folderz/$myusername/emailAtt/sent/$val' download='$showVal'>$showVal</a><br>";
    $one++;
  }
  $kml = "
<div id='$overview->msgno' class='messShow' style='float:left;background-color:#000000;color:#FFFFFF;'> <b>Recieved:<b/> $time<br>
<b>From:</b> {$overview->from} <{$from}><br>
<b>Subject:</b> {$overview->subject}<br>
".((isSet($filename))? $aTT : "")."</div>
<div class='messOptions' style='float:right;'>
<img id='mRply' src='/IMG/reply.png' alt='Reply to this Message' height='25' width='25'> <img id='mFwd' src='/IMG/forward.png' alt='Forward this Message'  height='25' width='25'> ".(isSet($filename)? "<img id='mAtt' src='/IMG/att.png' alt='Attachment is Set'  height='25' width='25'>" : "<img id='mAtt' src='/IMG/attNo.png' alt='Attachment not Set'  height='25' width='25'>" )."<input type='checkbox' name='$overview->msgno' class='$moChk' value='$emailName' style='z-index:2;'>
</div>
<br><div id='show_$overview->msgno' style='display:none;'><br><SPAN class='closeMessage' value='show_$overview->msgno' style='float:right;color:#FFFFFF;background:#000000;font-size:20px;' >x</SPAN>
<br><br><br>
<PRE style='float:left;margin-top:20px;'>
$mess
</PRE>
</div>";
  file_put_contents("/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/sent/".$emailName, $kml);
  //echo "THIS IS THE COUNT= ".count($files);
  
  /*    foreach ($files as $val){
	echo "<script> alert('$val'); </script>";  
	if (strpos($val, '-.kml') !== false){
        $location = "/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/sent/$val";
	$fp = fopen($location, "r");
	
        //fpassthru($fp);
	
	}
	}*/
  
  //echo "<SPAN id='$ref holder' style='width:99%;'>";
  //echo "<DIV id='$ref' class='openMessage' style='text-align:left;float:left;'><b>Recieved:</b> $time <br><b>From:</b> {$overview->from} < $from > <br/><b>Subject:</b>  {$overview->subject} ";
  //if(isSet($filename)){
  //	echo "<br/><b>Attachment:</b>&nbsp; ";
  //   foreach ($attNames as $val){
  //	  echo "($one)<a href='/folderz/$myusername/emailAtt/sent/$val' download='$val'>$val</a>&nbsp;";
  //	  $one++;
  //	}
  //	$one = 1;
  //  }
  // echo "<br></DIV><br>";
  //echo "<DIV style='float:right;'>".(isSet($filename)? "<img id='mAtt' src='/IMG/att.png' alt='Attachment is Set'  height='25' width='25'>" : "<img id='mAtt' src='/IMG/attNo.png' alt='Attachment not Set'  height='25' width='25'>" )."<input type='checkbox' name='delete' class='$moChk' value='$mN' style='z-index:2;'></DIV><br/>";   
  //echo "<DIV class='$mID' id='aMessage' style='display:none;text-align:left;width:100%;' ><br/><SPAN class='closeMessage' value='$mID' style='float:right;color:#FFFFFF;background:#000000;font-size:20px;' >x</SPAN><br><pre style='float:left;'><br>$mess<br></pre></DIV></DIV>";
  //$ref++; 
  imap_delete($mbox, $overview->msgno);
  //$pMo = $mo;
  $ref++; 
}
$path = "/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/sent/";
$files = scandir($path);
$files = array_diff($files, array('.','..'));
$pMo = '';
//var_dump($files);
if (count($files) == 1){
  echo "<br><span style='width:99%;float:left;background-color:#000000'><input class='$cN' type='text' value='No Messages' style='width:100%;background-color:#000000;color:#FFFFFF;text-align:center;' READONLY/>";
}else{
  for($i=1;$i<=count($files);$i++){
    //echo "<script> alert('$i'); </script>";  
    if (strpos($files[$i], '-.kml') !== false){
      $getMo = explode('-', $files[$i]);
      $mo = $getMo[0];
      if ($mo !== $pMo){
	$cN = $mo.'H';
	echo "<span style='width:99.9%;float:left;background-color:#000000'><input class='$cN' type='text' value='$mo' style='width:90%;background-color:#000000;color:#FFFFFF;text-align:center;' READONLY/><input type='checkbox' id='delete_$mo' value='$mN' style=''></span>";
	$pMo = $mo;
      }
      $location = "/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/sent/$files[$i]";
      $fp = fopen($location, "r");
      echo "<DIV id='EvenorODD' class='$mo' style='display:inline-block;width:100%;text-align:left'>";
      fpassthru($fp);
      echo "</DIV>";
    }
  }
}
//echo "</DIV>";
echo "</DIV>";

imap_close($mbox);
//echo "</div>";
?>