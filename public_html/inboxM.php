<?php 
$m = $myusername.'@pick-n-drop.com';  

$mbox = imap_open("{pick-n-drop.com:143/imap/novalidate-cert}INBOX", "$m", "jN.9YobsAvFZ7.0c1s0LD9c1LEK8qQV", CL_EXPUNGE)  //, OP_READONLY
    or die("can't connect: " . imap_last_error());

$MC = imap_check($mbox);

$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
$result = array_reverse($result);
  
$ref = 0;
$one = 1;
$pMo = '';
echo "<DIV id='inboxM' class='emailWrapper' style='width:100%;height:200px;overflow-y:auto;display:none;'>";
foreach ($result as $overview) {      
  $mID = "showMess".$ref;
  $aID = "showAtt".$ref;
  $emltime = date('YmdH-i-s-w', strtotime($overview->date));
  $time = date('l, jS - g:iA', strtotime($overview->date));
  $att = imap_fetchstructure($mbox, $overview->msgno);
  $mN = $overview->msgno;
  print_r($att);
  //echo exec('whoami');
  $file = $att->parts[1]->parameters[0]->value;
  //echo "this is the count= ". $attFiles = count($att->parts);
  //$file = $att->parts[1]->dparameters[0]->value;
  $encoding = $att->parts[1]->encoding;
  //echo "<br>This is the File= $file";
  if (strtolower($file) !== 'us-ascii'){
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
	  $fileName =  $emltime.'_'. preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', '', iconv_mime_decode(utf8_decode(imap_utf8($attachments[$i]['filename']))));
	  $File = "/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/".$fileName;
	  if($att->parts[$i]->encoding == 3) { // 3 = BASE64	       
	    array_push($attNames, $fileName);
	    $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
	    file_put_contents("/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/".$fileName, $attachments[$i]['attachment']);
	  }            
	  elseif($att->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
	    array_push($attNames, $fileName);
	    $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
	    file_put_contents("/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/".$fileName, $attachments[$i]['attachment']);
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
  //$mess = imap_savebody($mbox, "/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/".$emailName, $overview->msgno, 1);
  $header = imap_headerinfo($mbox, $overview->msgno);
  $from = $header->from[0]->mailbox.'@'.$header->from[0]->host;
  $mess = utf8_encode($mess);
  //echo $mess;
  $mo = date('F');
  $moChk = $mo.'_chk';
  $one = 1;
  $aTT = "<strong>Attachment:</strong>&nbsp;";
  foreach ($attNames as $val){
    error_log($val);
    $showVal = preg_replace('/(.*)_/', '', $val);
    echo "<input type='hidden' class='$emltime' value='$showVal'/>";
    $aTT .= "<img class='$val' src='/IMG/addAtt.png' alt='$at' height='15' width='15'><a class='".$emltime."_att' href='/folderz/$myusername/emailAtt/$val' download='$showVal'>".((strlen($showVal) > 40)?"<abbr title='$showVal'>".substr($showVal,0,38)."...</abbr>":$showVal)."</a>&nbsp;";
    if(($one % 3) == 0){
      $aTT .= '<br>';
    }
    $one++;
  } 
  $sub = $overview->subject;
  $kml = "
<div id='$emltime' class='messShow' style='float:left;background-color:#000000;color:#FFFFFF;'><strong>Recieved:<b/><$mo> $time<br>
<strong>From:</strong> {$overview->from} &#60;$from&#62;<br>
<strong>Subject:</strong> ".((strlen($overview->subject) > 50)? "<abbr title='$sub' >".substr($overview->subject,0,36).'...</abbr>':$overview->subject)."<br>
".((isSet($filename))? $aTT : "")."</div>
<div class='messOptions' style='float:right;'>
<img id='$from' class='mRply' src='/IMG/reply.png' alt='$emltime' title='Re: $sub' height='25' width='25'> <img class='mFwd' src='/IMG/forward.png' alt='$emltime' title='FW: $sub' height='25' width='25'> ".(isSet($filename)? "<img id='mAtt' src='/IMG/att.png' alt='Attachment is Set'  title='Attachment' height='25' width='25'>" : "<img id='mAtt' src='/IMG/attNo.png' alt='Attachment not Set'  title='No Attachments' height='25' width='25'>" )."<input type='checkbox' name='$emltime' class='$moChk' value='$emailName' title='Select for Delection' style='z-index:2;'>
</div>
<br><div id='show_$emltime' style='display:none;'><br><SPAN class='closeMessage' value='show_$emltime' style='float:right;color:#FFFFFF;background:#000000;font-size:20px;' >x</SPAN>
<br><br><br>
<PRE class='$emltime' style='float:left;margin-top:20px;'>
$mess
</PRE>
</div>";
  file_put_contents("/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/".$emailName, $kml);
  imap_delete($mbox, $overview->msgno);
  $ref++; 
}
$path = "/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/";
$files = scandir($path, 1);
$files = array_diff($files, array('.','..'));
$pMo = '';
if (count($files) == 1){
  echo "<br><span style='width:99%;float:left;background-color:#000000'><input class='$cN' type='text' value='No Messages' style='width:100%;background-color:#000000;color:#FFFFFF;text-align:center;' READONLY/>";
}else{
  for($i=1;$i<=count($files);$i++){
    if (strpos($files[$i], '-.kml') !== false){
      $getMo = explode('-', $files[$i]);
      $getMo = $getMo[0];
      $getObj = substr($getMo, 4, 2); 
      $moObj = DateTime::createFromFormat('m', $getObj);
      $mo = $moObj->format('F');
      if ($mo !== $pMo){
	$cN = $mo.'H';
	echo "<div style='width:99.9%;float:left;background-color:#000000'><input class='$cN' type='text' value='$mo' title='Click to hide $mo emails' style='width:90%;background-color:#000000;color:#FFFFFF;text-align:center;' READONLY/><input type='checkbox' id='delete_$mo' title='Select all of $mo' style='' /></div>";
	$pMo = $mo;
      }
      $location = "/var/www/pick-n-drop.com/public_html/folderz/$myusername/emailAtt/$files[$i]";
      $fp = fopen($location, "r");
      echo "<DIV id='EvenorODD' class='".$mo."' style='display:inline-block;width:100%;text-align:left'>";
      fpassthru($fp);
      echo "</DIV>";
    }
  }
}
echo "</DIV>";
imap_close($mbox);

?>