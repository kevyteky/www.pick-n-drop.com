<?php


if(isSet($_POST['deleting'])){
  $target = $_POST['deleting'];
  $myusername = $_POST['folder'];
  $location = "folderz/$myusername/emailAtt/$target";
  $prefix = str_replace('-.kml','_', $target);
  unlink($location);
  $attachment_s = "folderz/$myusername/emailAtt/".$prefix.'*.*';
  array_map('unlink', glob($attachment_s));
  $location = "folderz/$myusername/emailAtt/sent/$target";
  unlink($location);
  $attachment_s = "folderz/$myusername/emailAtt/sent/".$prefix.'*.*';
  array_map('unlink', glob($attachment_s));
}
  
















?>