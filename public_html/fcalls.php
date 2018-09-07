<?php

function is_dir_empty($dir) {
  if (!is_readable($dir)) return NULL; 
  return (count(scandir($dir)) == 2);
}
if (isSet($_POST['user'])){
  $user = $_POST['user'];
  $check = iterator_count(new DirectoryIterator("/var/www/pick-n-drop.com/public_html/folderz/$user/dir"));
  echo $check;
}
if (isSet($_POST['chkName'])){
  $user = $_POST['dir'];
  $folderName = $_POST['chkName'];
  $location = "folderz/$user/dir".$_POST['destination']."*";
  $dirs = array_filter(glob($location), "is_dir");
  foreach ($dirs as $dir){   
    $dir = str_replace("folderz/$user/dir/","",$dir);
    error_log($dir +' and '+$folderName);
    if (strpos(strtolower($dir), strtolower($folderName)) !== false){
      echo "Exists";
      exit();
    }
  }
}
if (isSet($_POST['fStatus'])){
  $user = $_POST['fStatus'];
  $location = "/folderz/$user/dir".$_POST['destination'];
  $folder = $_POST['folder'];
  $DIR = getcwd();
  $dir = $DIR.$location.$folder;
  //error_log('folders= '.$dir);
  $folders = scandir($dir,1);
  foreach($folders as $sub){
    if ($sub == '.' or $sub == '..'){
      continue;
    }
    if(is_dir($dir.'/'.$sub)){
      echo json_encode('subfolder');
      exit();
    }
  }
}
if (isSet($_POST['filesInFolder'])){
  $user = $_POST['filesInFolder'];
  $location = "/folderz/$user/dir".$_POST['destination'];
  $folder = $_POST['folder'];
  $DIR = getcwd();
  $dir = $DIR.$location.$folder;
  $folders = scandir($dir,1);
  $files = glob($dir."/*.*", GLOB_BRACE);
  //error_log($files);
  //error_log(print_r($files));
  foreach($files as $file){
    //$file = substr($file, strpos($file, '/') + 1);    
    $file = basename($file);
    //error_log('this is the file= '. $file);
    $regEx = '/^.*\.*$/';
      if (preg_match($regEx, $file)){
	echo "filesInFolder";
        exit();
      }   
  }
  /*
  error_log($dir);
  if (is_dir_empty($dir)) {
    echo "empty"; 
  }else{
    echo "NOT empty";
  }
  */
}
if (isSet($_POST['getRootFolders'])){
  $user = $_POST['getRootFolders'];
  $location = "/folderz/$user/dir".$_POST['destination'];
  $DIR = getcwd();
  $scan = scandir($DIR.$location);
  echo json_encode($scan);
}
if (isSet($_POST['createF'])){
  $folderName = $_POST['createF'];
  $user = $_POST['dir'];
  $location = "/folderz/$user/dir".$_POST['destination']."/";
  $shareF = $_POST['shareF'];
  $secureF = $_POST['secureF'];
  $secureCode = $_POST['secureVal'];
  $expireF = $_POST['expireF'];
  $expireDate = $_POST['expireVal'];
  $DIR = getcwd();
  if($shareF == 'yes'){
    error_log('share is set');
    $folderName .= '_+Sh';
    if($expireF == 'yes'){
      error_log('expire is set');
      $folderName .= '+E';
    }
    if($secureF == 'yes'){
      error_log('secure is set');
      $folderName .= '+S';
    }
    error_log('this is foldername= '.$folderName);
    mkdir($DIR.$location.$folderName, 0754, true);
    if (!file_exists('$DIR.$location.$folderName')) {
      echo 'Created';
    }  
    exit();
  }  
  if($expireF == 'yes'){
    $folderName .= '_+E';
    if($secureF == 'yes'){
      $folderName .= '+S';
    }
    mkdir($DIR.$location.$folderName, 0754, true);
    if (!file_exists('$DIR.$location.$folderName')) {
      echo 'Created';
    }
    exit();
  }
  if($secureF == 'yes'){
    $folderName .= '_+S';
    mkdir($DIR.$location.$folderName, 0754, true);
    if (!file_exists('$DIR.$location.$folderName')) {
      echo 'Created';
    }
    exit();
  }
  mkdir($DIR.$location.$folderName, 0754, true);
  if (!file_exists('$DIR.$location.$folderName')) {
    echo 'Created';
  }
}
if (!empty($_FILES)) {  
  $temp = $_FILES['file']['tmp_name'];
  $fileName = $_FILES['file']['name'];
  $user = $_POST['user'];
  $DIR = getcwd();
  $destination = $DIR."/folderz/$user/dir".$_POST['destination'].$fileName;
  error_log($destination);
  move_uploaded_file($temp,$destination); 
}
if (isSet($_POST['deleteFiles'])){
  $fileNames = $_POST['deleteFiles'];
  $user = $_POST['dir'];
  $DIR = getcwd();
  $removedFiles = [];
  foreach($fileNames as $fileName){ 
    $destination = $DIR."/folderz/$user/dir".$_POST['destination'].$fileName;
    error_log($destination);
    if(unlink($destination)){
      array_push($removedFiles, $fileName);
    }  
  }
  echo json_encode($removedFiles);
}
if (isSet($_POST['deleteFile'])){
  $fileName = $_POST['deleteFile'];
  $user = $_POST['dir'];
  $DIR = getcwd();
  $destination = $DIR."/folderz/$user/dir".$_POST['destination'].$fileName;
  error_log($destination);
  if(unlink($destination)){
    echo 'Deleted';
  }
}
if (isSet($_POST['deleteFolder'])){
  $folderName = substr($_POST['deleteFolder'], 0, -1) ;
  $user = $_POST['dir'];
  $DIR = getcwd();
  $destination = $DIR."/folderz/$user/dir".$folderName;
  error_log($destination);  
  if(rmdir($destination)){
    echo 'Deleted';
  }
}

?>