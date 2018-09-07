<?php 

function formatBytes($bytes, $precision = 2) { 
  error_log('running function');
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
    // $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    echo  round($bytes, $precision) . ' ' . $units[$pow]; 
} 


function convertToReadableSize($size){
  error_log("this is the size= $size");
  $base = log($size) / log(1024);
  $suffix = array("", "KB", "MB", "GB", "TB");
  $f_base = floor($base);
  echo  round(pow(1024, $base - floor($base)), 1) . $suffix[$f_base];
}
if (isSet($_POST['bytes'])){
  $size = $_POST['bytes'];
  $byte = $_POST['bytes'];
  convertToReadableSize($size);
}
if (isSet($_POST['getSize'])){
  $file = $_POST['getSize'];
  $user = $_POST['user'];
  $box =  $_POST['box'];
  $target = "/var/www/pick-n-drop.com/public_html/folderz/$user/$box/$file";
  echo $filesize = filesize($target);
  error_log("this is the filesize= $filesize");
}

//formatBytes($byte);
?>