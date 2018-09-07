<?php 

print_r(array_keys($_POST));
echo "<br />";
print_r(array_Values($_POST));
echo "<br />";
print_r(array_keys($_GET));
echo "<br />";
print_r(array_Values($_GET));
echo "<br />"; 
/*
$my = 'testing';
$DIR = getcwd();
$folder = $DIR."/folderz/$myusername";

//$old = umask(0);
mkdir($DIR."/folderz/$my", 0774, true);
//umask($old);
//chown($DIR."/folderz/$my", 'www-data');
//$old = umask(0);
mkdir($DIR."/folderz/$my/emailAtt", 0774, true);
//umask($old);
*/
echo "<!DOCTYPE html><HTML><HEAD>";
echo "<link rel='stylesheet' type='text/css' href='/VIEW/regStyle.css' title='wsite-theme-css'>";
echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>";
echo '<link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<link rel="manifest" href="favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">';
echo "<SCRIPT>";
echo "var changePass = false;";
if(isSet($_GET['regCode'])){
  echo "var changePass = true;";
}

echo "function sleep(miliseconds) {
   var currentTime = new Date().getTime();
   while (currentTime + miliseconds >= new Date().getTime()) {
   }
}";
echo "$(function(){ 
        if (changePass == true){
           $('#regID').attr('readOnly',true);
           $('#email').removeAttr('disabled');
           $('#email').attr('readOnly',true);
           $('#uzername').removeAttr('disabled');
           $('#uzername').attr('readOnly',true);
           $('#pass').removeAttr('disabled');
           $('#passOnly').removeAttr('disabled');
        }

        $('#regID').mouseleave(function(){
           var v = $(this).val();
           if(v.length == 0){
             $(this).val('A Valid Registration# Is Required');
           }
        });
           
        $('#regID').on('click',function(){
           $(this).val('');
        });
        $('#regID').on('change',function(){
           var v = $(this).val();
           var add = 0;
           if(v.length >= 90 && v.length <= 110 ){
              add = add + 1;
           }
           var upperCase = new RegExp(/[A-Z]/);
           if (upperCase.test(v)){
              add = add + 1;
           }
           var num = new RegExp(/[0-9]/);
           if (num.test(v)){
              add = add + 1;
           }
           var pattern = new RegExp(/[~`!#$%\^&*@+=\-\[\]\\';,/{}|\\\":<>\?]/);
           if (pattern.test(v)){
              add = add + 1;
           }
           var array = v.split('');
           var lowerCase = new RegExp (/[a-z]/);
           var ad = 0;
           array.forEach(function(i){
              if(lowerCase.test(i)){
                 ad = ad + 1;
              }
           });
           if(ad >= 4){
              add = add + 1;
           }
           if(add >= 5){          
              $.ajax({
                            url: '/chkIt.php',
                            type: 'POST',
                            data: {'regID':v}, 
                            dataType: 'json',                      
                            success: function(response) {
                                      if(response != 'Rejected'){
                                         $('#email').removeAttr('disabled');
                                         $('#email').attr('required',true);
                                         $('#regID').hide();
                                         if (response == 'Accredited' || response == 'Alsintl' || response == 'Legal' || response == 'University'){
                                            //alert(response+' peer is accepted');
                                            $('#regForm').append('<input id=\"partOf\" type=\"hidden\" name=\"userIs\" value=\"peer\" />'); 
                                            $('#regForm').append('<input id=\"domainOf\" type=\"hidden\" name=\"attachedTo\" value=\"'+response+'\" />');   
                                         }else{
                                            $('#emailValid').append('<input id=\"partOf\" type=\"hidden\" name=\"userIs\" value=\"client\" />');
                                            $('#emailValid').append('<input id=\"domainOf\" type=\"hidden\" name=\"attachedTo\" value=\"'+response+'\" />');  
                                         } 
                                      }else{
                                         $('#regID').val('A Valid Registration# Is Required');
                                      }
                            }
              });
           }else{
             $(this).val('A Valid Registration# Is Required');
           }
        });
        $('#emailDir').hover(function(){
           $(this).css('font-size','12pt');
        }); 
        $('#emailDir' ).mouseleave(function(){
           $(this).css('font-size','9pt');
        });
        $('#email').on('change',function(){
           var e = this.value;
           var d = $('#partOf').val();
           var bg = $(this).css('background-color');
           if(bg == 'rgb(221, 255, 221)'){
              $.ajax({
                            url: '/chkIt.php',
                            type: 'POST',
                            data: {'email':e,'partOf':d}, 
                            dataType: 'json',                      
                            success: function(response) {
                                     if(response == 'Accepted'){
                                        //alert('yes');
                                        $('#uzerNameDir').show();
                                        $('#uzername').removeAttr('disabled');
                                        $('#uzername').attr('required',true);
                                        $('#email').removeAttr('required');
                                        $('#emailDir').hide();
                                        $('#email').attr('readOnly',true);
                                        $('#email').css('background-color','#ddffdd');
                                     }else if(response == 'Rejected'){
                                        alert('Email is already in Use, Please try again');
                                        $('#email').val(''); 
                                     }else{
                                        alert(response);
                                        $('#email').val(''); 
                                     }
                            }
                     });              
           }
        });
        $('#uzername').on('click',function(){
           var v = $(this).val();
           if(v == 'No Special Characters' || v == 'No Numbers'){
              $(this).val('');
           }     
        });

        $('#uzername').on('change',function(){
           var v = $(this).val();
           var chk = v.match(/\d+/g);
           if(chk != null){ 
              $(this).val('No Numbers');          
              return;
           }
           chk = v.match(/[ !@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?]/);
           if(chk != null){
              $(this).val('No Special Characters');
              return;
           }           
           if(v.length >= 6){
              $.ajax({
                            url: '/chkIt.php',
                            type: 'POST',
                            data: {'username':v}, 
                            dataType: 'json',                      
                            success: function(response) {
                                     if(response == 'Accepted'){
                                        //alert(v);
                                        $('#passDir').show();
                                        $('#pass').removeAttr('disabled');
                                        $('#pass').attr('required',true);
                                        $('#uzername').removeAttr('required');
                                        $('#uzername').attr('readOnly',true);
                                        $('#uzername').css('background-color','#ddffdd');
                                        $('#uzerNameDir').hide();
                                     }else if(response == 'Rejected'){
                                        alert('Username is already in Use, Please try again');
                                     }
                            }
              });
           }
        });
        $('#uzerNameDir').hover(function(){
           $(this).css('font-size','12pt');
        }); 
        $('#uzerNameDir' ).mouseleave(function(){
           $(this).css('font-size','9pt');
        });
        var c;
        $('#pass').on('change',function(){
           $('#passConf').val('');
           $('#confirmChk').hide();
           $('#confirm').show();
           $('#submit').css({'background-color':'#EBEBE4','color':'#000000'});
           $('#submit').attr('disabled',true);
           $('#specChk').hide(); $('#spec').show();
           $('#numChk').hide(); $('#num').show();
           $('#lowChk').hide(); $('#low').show();
           $('#capChk').hide(); $('#cap').show();
           $('#charChk').hide(); $('#char').show();
           var v = this.value;
           c = v;
           var a = 0;
           if (v.length >= 8){
              $('#char').hide();
              $('#charChk').show(); 
              a = a + 1;                          
           }
           var upperCase = new RegExp(/[A-Z]/);
           if (upperCase.test(v)){
              $('#cap').hide();
              $('#capChk').show();
              a = a + 1;
           }
           var lowerCase = new RegExp(/[a-z]/);
           if (lowerCase.test(v)){
              $('#low').hide();
              $('#lowChk').show();
              a = a + 1;
           }
           var num = new RegExp(/[0-9]/);
           if (num.test(v)){
              $('#num').hide();
              $('#numChk').show();
              a = a + 1;
           }
           var pattern = new RegExp(/[~`!#$%\^&*@+=\-\[\]\\';,/{}|\\\":<>\?]/);
           if (pattern.test(v)){
              $('#spec').hide();
              $('#specChk').show();
              a = a + 1;
           } 
           if (a >= 4){
              $('#passConfirm').show();
              $('#passConf').attr('required',true);
              $(this).removeAttr('required');
              $('#passDir').hide();
              a = 0;
           }else{
              $('#pass').val('');
              $('#passDir').show();
              $('#passConfirm').hide();
              a = 0;
           }
        });
        $('#passConf').on('change',function(){
           var v = $(this).val();
           if(c == v){
              $('#submit').removeAttr('disabled');
              $('#confirm').hide();
              $('#confirmChk').show();
              $('#submit').css({'background-color':'#000000','color':'#FFFFFF'});
           }else{
              alert('No Match');
              $('#confirmChk').hide();
              $('#confirm').show();
              $('#submit').css({'background-color':'#EBEBE4','color':'#000000'});
              $('#submit').attr('disabled',true);
           }
        });

});";

echo "</SCRIPT>";
echo "</HEAD>";
echo "<TITLE> ULS PickUp & DropOff Registration </TITLE>";
echo "<BODY>";
echo "<DIV id='mainHeader' align='right' style='min-height:5.5%;background-color:#000000;'>";
echo "<div style='display:inline-block;margin-right:65px;'><img id='userStatus' src='/IMG/loggedOff.png' alt='loggedOn'  height='50', width='55'></div style='display:inline-block;'><br/><div><table bgcolor='#000000' style='border: 1px solid black;'><tr><td width='175px' align='center' height='15px' style='background-color:#000000;color:#FFFFFF;'>".(($myusername != null)? $myusername : '')."</td></tr><td id='logOut' align='center' width='120px' style='background-color:#000000;color:#000000;'><form ".(($myusername != null)? "name='logOut' action='logOut.php' " : "name='logOn' action='index.php'")." method='POST' ><input type='submit' ".(($myusername != null)? "value='LogOut'" : "value='LogIn'")." style='width:50%;height:100%;background-color:#FFFFFF;color:#000000;'></form></td></tr></table></div>";
echo "</DIV>";
echo "<DIV align='center' style='height:10%;width:98%;position:absolute'>";
echo "<DIV align='center' style='width:35%;margin-top:5cm'>";
echo "<img id='siteLogo' src='/IMG/siteIcon.png' alt='Logo'  height='150', width='155'>";
echo "<H2>To access the <i>ULS PickUp & DropOff</i> you must create a account.</H2>";
echo "<form id='regForm' name='entry' action='createLogin.php' method='POST'>";
echo " <input id='regID' type='text' size='50' name='myRegistration#' value='".((isSet($_GET['regCode']))? $_GET['regCode'] : 'A Valid Registration# Is Required')."' style='margin:5px; display:block;' required/> ";
if(isSet($_GET['thankYou'])){
  $uEmail = $_GET['subcriber'];
  $uName = $_GET['thankYou'];
  echo "<br/><h3>Your submission for password reset or username request has been sent to the email: $uEmail.<br/>Please check your email for username or validate your request which will allow you to change your passcode.</h3><br/>";
}  
echo "</DIV>";
echo "<DIV align='center' style='width:100%;'>";
echo "<span>Email</span><br/>";
echo "<DIV id='emailValid'> <input id='email' type='email' size='25' name='myemailis' value='".((isSet($_GET['eml']))? $_GET['eml'] : '')."' disabled/></DIV>";
echo "<DIV id='emailDir' style='width:35%;font-size:9pt'> (A valid email is required for registration process and for contact purposes.)</DIV>";
echo "<span id='username'>User Name</span><br/>";
echo "<input id='uzername' type='text' size='25' name='myusernameis' value='".((isSet($_GET['user']))? $_GET['user'] : '')."' disabled /><br/>";
echo "<DIV id='uzerNameDir' style='width:35%;font-size:9pt;display:none;'> (Username must be 6 characters or longer and only contain letters.) </DIV>";
echo "<span>Password</span><br/>";
echo "<input id='pass' type='password' size='25' disabled /><br/>";
echo "<DIV id='passDir' style='width:40%;font-size:9pt;display:none;'> (You must get 4 out 5)<br/>Password must be 8 characters or longer.<img id='char' src='/IMG/emptyChkBox.png' alt='emptyBox'  height='13', width='13'><img id='charChk' src='/IMG/checkedBox.png' alt='checkedBox'  height='13', width='13' style='display:none'><br/>Must contain at least one Capital Letter.<img id='cap' src='/IMG/emptyChkBox.png' alt='emptyBox'  height='13', width='13'><img id='capChk' src='/IMG/checkedBox.png' alt='checkedBox'  height='13', width='13' style='display:none'><br/>Must contain at least one lowercase letter.<img id='low' src='/IMG/emptyChkBox.png' alt='emptyBox'  height='13', width='13'><img id='lowChk' src='/IMG/checkedBox.png' alt='checkedBox'  height='13', width='13' style='display:none'><br/>Must contain at least one Special Character.<img id='spec' src='/IMG/emptyChkBox.png' alt='emptyBox'  height='13', width='13'><img id='specChk' src='/IMG/checkedBox.png' alt='checkedBox'  height='13', width='13' style='display:none'><br/>Must contain at least one number.<img id='num' src='/IMG/emptyChkBox.png' alt='emptyBox'  height='13', width='13'><img id='numChk' src='/IMG/checkedBox.png' alt='checkedBox'  height='13', width='13' style='display:none'></DIV>";
echo "<div id='passConfirm' style='display:none;' > <input id='passConf' type='password' size='25' name='mypasswordis' /><br/><SPAN style='font-size:9pt'> Confirm password </SPAN><img id='confirm' src='/IMG/emptyChkBox.png' alt='emptyBox'  height='13', width='13'><img id='confirmChk' src='/IMG/checkedBox.png' alt='checkedBox'  height='13', width='13' style='display:none'> </div>";
echo "<input id='passOnly' type='hidden' value='updateOnly' name='updateOnly' disabled/>";
echo "<input id='submit' type='submit' value='Submit' name='enter' style='width:210px;' disabled/><br/>";
//echo "<input type='submit' value='Forgot Username or Password' name='lost' style='width:210px;' />";

echo "</DIV>";

echo "</DIV>";

echo "</BODY>";

echo "</HTML>";
?>