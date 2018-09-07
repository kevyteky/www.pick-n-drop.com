<?PHP

print_r(array_keys($_POST));
echo "<br />";
print_r(array_Values($_POST));
echo "<br />";
print_r(array_keys($_GET));
echo "<br />";
print_r(array_Values($_GET));

require 'PDO/connect.php';

if(isSet($_POST['reg'])){
  header("location: https://pick-n-drop.com/register.php");
  exit();
}

if(isSet($_POST['lost'])){
  echo "<!DOCTYPE html><html><head><style>";
  echo ".modal {
    ##display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 300px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }
  /* Modal Content */
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }
  .modal-header {
    background-color: #000000;
    color:  #FFFFFF;
    width:  80%;
  }

  /* The Close Button */
  .close {
    color: #aaaaaa;
    float: right;
    font-size: 48px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: #FF0000;
    text-decoration: none;
    cursor: pointer;
  }";
  echo "</style><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script></head><body>";
  echo "<script>
     $(function(){
       $('.close').on('click',function(){
           window.location = 'https://pick-n-drop.com';
       });
     });
     </script>";
  echo "<div id='myModal' class='modal'>";
  echo "<!-- Modal content -->";
  echo "<div class='modal-content'>";
  echo "<img id='siteLogo' src='/IMG/pick-n-drop.png' alt='Logo'  height='150', width='155'>";
  echo "<span class='close'>&times;</span>";
  echo "<div class='modal-header'>
    <h2>".$_POST['lost']."</h2>
        </div>";
  echo "<form name='reset' action='sendReset.php' method='POST'><p>Enter Email address:</p><input type='email' name='sendReset' size='50' REQUIRED/><input type='submit' value='Submit' style='background-color:#000000;color:#FFFFFF;'/></form>
    <div class='modal-footer'>
    <h3>On submit a recovery email will be sent to the email address you provider which has been registered with <i>Pick~N~Drop</i> site.  After submit please check your email account to retrieve & begin temporarly password reset which is only valid for 3 hour after you have verified.</h3>
  </div>
  </div>";
  echo "</div></body></html>";
}

//if(($_POST['myusernameis']  == null) or ($_POST['mypasswordis'] == null)){
//  header("location: https://pick-n-drop.com/register.php");
//  exit();
//}

if(isSet($_POST['enter'])){
  // username and password sent from form 
  $myusername= strtolower($_POST['myusernameis']); 
  $mypassword= $_POST['mypasswordis'];
  // To protect MySQL injection (more detail about MySQL injection)
  $myusername = stripslashes($myusername);
  $mypassword = stripslashes($mypassword);

  $uzr = substr($myusername,1,-2).' PLaYwrIgHt'.substr($myusername,1,-1);

  $st = $db->prepare("SELECT uzrPword, uzrPtlas, uzrEmail FROM uzerz WHERE uzrName='$myusername'"); 
  $st->execute();
  $call = $st->fetch();
  //error_log("this is the call= ".$call['uzrPword']);
  if ($call['uzrPword'] == ''){
    $mess = "Wrong Username or Password";
    header("location: https://pick-n-drop.com?wrongLogin=$mess");
  }else{
    if (password_verify($mypassword, $call['uzrPword'])){
      if (password_verify($uzr, $call['uzrPtlas'])){
	session_start();
	$_SESSION["mysession"] = $myusername;
        $_SESSION["myemail"] = $call['uzrEmail'];
	global $myusername; 
	header("location: https://pick-n-drop.com"); 
      }else{
	$mess = "Wrong Username or Password";
	header("location: https://pick-n-drop.com?wrongLogin=$mess");
      }
    }else{
      $mess = "Wrong Username or Password";
      header("location: https://pick-n-drop.com?wrongLogin=$mess");
    }
  }
}

?>

