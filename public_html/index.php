<?php 
ob_start();
session_start();
if (isset($_SESSION['mysession'])) {
  $myusername = $_SESSION["mysession"];
  $myusername = strtolower(ucwords($myusername));
}
if (isset($_SESSION['myemail'])) {
  $myemail = $_SESSION["myemail"];
  $myemail = strtolower(ucwords($myemail));
}
/*
print_r(array_keys($_POST));
echo "<br />";
print_r(array_Values($_POST));
echo "<br />";
print_r(array_keys($_GET));
echo "<br />";
print_r(array_Values($_GET));
*/ 
include "PDO/connect.php";

$browser = $_SERVER['HTTP_USER_AGENT'];
if (strpos($browser, 'Edge')){

  $webB = 'Edge';
}elseif (strpos($browser, 'Trident')){
  $webB = 'IE';
}elseif (strpos($browser, 'Chrome')){
  $webB = 'Chrome';
}elseif (strpos($browser, 'Firefox')){
  $webB = 'Firefox';
}
//echo $webB.'<br>';

$mO = date('M');
$month = date('F');

$yR = date('Y');
$toD = date('D');
$toDl = date('l');
$calDay = str_replace('0', '', date('d'));
$toDay = date('j', strtotime("now"));
$toYear = date('Y', strtotime("now"));
$wDays = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
$y2013Days = array('Tue','Wed','Thu','Fri','Sat','Sun','Mon');
$months = array('END','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$years = array('END','2018','2019','2020','2021','2022','2023','2024','2025','2026','2027','2028');
$thisMonth = date('n', strtotime("now")) - 1;
$MaxYear2013 = '365';
if(isSet($_GET['year'])){
  $calYear = $_GET['year'];
}
$firstDayMo = date('w', strtotime('first day of  '.$mO));
$numOfMo = date('n');
$numDays = cal_days_in_month(CAL_GREGORIAN, $numOfMo, $yR);
date_default_timezone_set('UTC');
$timeCode = date("Y-m-d H:i:sa");
$timetokill = date("Y-m-d H:i:sa", strtotime('+3 Hours'.strtotime($timeCode)));
$regStart = $myusername.'Jk'.$timeCode.'09n_';
$regCode = rand(1111,9999).'AKOPL'.hash('sha384', $regStart);
$windowsShit = "style=''";
//echo "<link rel='stylesheet' href='/resources/demos/style.css'>";
//echo "<script src='https://code.jquery.com/jquery-1.12.4.js'></script>";
//echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>";

echo "<!DOCTYPE html><HTML><HEAD>";
echo '<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo "<link rel='stylesheet' type='text/css' href='/VIEW/style.css' title='wsite-theme-css'>";
echo "<link rel='stylesheet' type='text/css' href='/VIEW/dropzone.css' title='wsite-theme-css'>";
echo "<link rel='stylesheet' href='//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'>";
echo "<script type='text/javascript' src='https://code.jquery.com/jquery-latest.min.js'></script>";
echo "<script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>";
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css'>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js'></script>";
echo '<script src="/js/dropzone.js"></script>';
//echo '<script type="text/javascript" src="/js/require.js"></script>';
echo "<script type='text/javascript' src='js/jquery-timepicker-master/jquery.timepicker.js'></script>
	<link rel='stylesheet' type='text/css' href='js/jquery-timepicker-master/jquery.timepicker.css' />
	<script type='text/javascript' src='js/jquery-timepicker-master/lib/bootstrap-datepicker.js'></script>
	<link rel='stylesheet' type='text/css' href='js/jquery-timepicker-master/lib/bootstrap-datepicker.css' />
	<script type='text/javascript' src='js/jquery-timepicker-master/lib/site.js'></script>
	<link rel='stylesheet' type='text/css' href='js/jquery-timepicker-master/lib/site.csss' />
     ";
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
echo "<style>
    a:link {
    color: #F1C40F; 
    background-color: transparent; 
    text-decoration: none;
    } 

    a:visited {
    color: pink;
    background-color: transparent;
    text-decoration: none;
    }

    a:hover {
    color: green;
    background-color: transparent;
    text-decoration: underline;
    }

    a:active {
    color: yellow;
    background-color: transparent;
    text-decoration: underline;
    }
    .dropzone .dz-remove {
    color: #000000;
    }
    #myModal {
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
   #sendModal {
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
  }</style>";
echo "<SCRIPT>";
echo "var myusername = '$myusername';";
echo "var myuseremail = '$myemail';";
echo "var uzer = myuseremail.replace('@','_');";
echo "uzer = uzer.substr(0, uzer.lastIndexOf('.'));";
$mos = ["January","February","March","April","May","June","July","August","September","October","November","December"];
echo "$(function(){";
echo "   $('#timepick').timepicker();  
         $('#datepick').datepicker(); ";

foreach ($mos as $val){
    echo "$('#delete_$val').on('click',function(){
             var chk = $(this).is(':checked');
             if (chk == true){
                $('.{$val}_chk').prop('checked',true);
             }
             if (chk == false){
                $('.{$val}_chk').prop('checked',false);
             }
          });
          $('.{$val}H').on('click',function(){
             $('.$val').toggle();
          });";
    echo "$('#deleteSent_$val').on('click',function(){
             var chk = $(this).is(':checked');
             if (chk == true){
                $('.{$val}_sentchk').prop('checked',true);
             }
             if (chk == false){
                $('.{$val}_sentchk').prop('checked',false);
             }
             $('#inboxM').hide(); 
          });
          $('.{$val}S').on('click',function(){
             $('.{$val}_sent').toggle();
          });";
}
echo "  var wWidth = window.screen.width;
        var wHeight = window.screen.height;
        //alert(wHeight)
        if (wHeight < 769 && wHeight > 600){
           $('#locationShow').css('width','200px');
           $('.day').css({'width':'45px','height':'45px'});
           $('#calendarM').css('width','73%');
           $('#preview').css('width','243px');
           $('.week').css('font-size','55%');
           $('.day').css('font-size','75%');
           $('.moreWeek').css({'font-size':'55%','margin-left':'1px'});
           $('.calendarMove').css('width','12%');
           $('#sendModal').css('padding-top','100px');
           $('#myModal').css('padding-top','100px');
           $('#sendBody').css('height','50%');
           $('#sendMessage').css('height','110px');
           $('.dropzone').css('min-height','50px');
           $('.sendDetails').css({'width':'10%','font-size':'12pt'});
           $('.detailsSend').css({'font-size':'8pt','width':'85%'});
           //$('#myFolderModal').css('width','350px');
           $('#myFolderModal').css({'padding-top':'140px','padding-left':'10px'});
           $('#fileDropZone').css('height','200px');
           $('#folder').css('width','450px');
           //$('#folderOptions').css('height','90%');
           
        }";
//$screenSize = '<script> alert(window.screen.width); </script>';
//echo 'This is the screensize= $screenSize';
echo "  $('.closeOpt').on('click',function(){
           $('.closeX').hide();
           $('.emailWrapper').hide();
           $('.emailSentWrapper').hide();
           return false;
        });
        $('.close').on('click',function(){
           alert('made it');
        });
        
        $('#createUO').on('click',function(){      ///////////////////////////////////////////////////////////////////////////////////////////////   CREATE
           $('#manageOpt').hide();
           $('#searchOpt').hide();
           $('#requestOpt').hide();
           $('#messagesOpt').hide(); 
           $('#calendarOpt').hide();
           $('#calendar').hide();
           $('#containerSearch').hide();
           $('#userSearches').hide();
           $('#containerSearch').hide();
           $('#clientSearches').hide();
           $('#clientsMan').hide();
           $('#containerMan').hide();
           $('#pickupsMan').hide();
           $('#dropsMan').hide();
           $('.emailWrapper').hide();
           $('.emailSentWrapper').hide();
           $('.hide').hide();
           $('#createOpt').show();
        });
        $('#creatingCloud').on('click',function(){
           $('#cloudContainer').show();
           $('#myClient').hide();
           $('#myPickups').hide();
           $('#myDrops').hide();
        });
        $('#creatingClient').on('click',function(){
           $('#myClient').show();
           $('#cloudContainer').hide();
           $('#myPickups').hide();
           $('#myDrops').hide();
        });
        $('#cCN').on('change',function(){
           var clientN = $(this).val();
            function removeMessage(){
                                        $('#cCN').val('');
                                        $('#cCN').css('color','#FFFFFF')
                                     }
           if (clientN.length >= 4){
               $.ajax({
                            url: '/chkIt.php',
                            type: 'POST',
                            data: {'username':clientN}, 
                            dataType: 'json',                      
                            success: function(response) {
                                     function removeMessage(){
                                        $('#cCN').val('');
                                        $('#cCN').css('color','#FFFFFF')
                                     }
                                     alert(response)
                                     if(response == 'Accepted'){                                       
                                        $('#cCN').prop('disabled', true);
                                        $('.uE').show();
                                     }else{
                                        $('#cCN').css('color','yellow');
                                        $('#cCN').val('User Name is already taken!  Please try again.');
                                        setTimeout(removeMessage, 1500);
                                        return;
                                     }
                            }
              });               
           }else{
              $('#cCN').css('color','yellow');
              $('#cCN').val('User Name must be four characters or longer!  Please try again.');
              setTimeout(removeMessage, 1500);
              return;
           }
        });
/*
        $('#cCE').on('click',function(){
           var clientN = $('#cCN').val();
           function removeMessage(){
              $('#cCN').val('');
              $('#cCN').css('color','#FFFFFF')
           }
           if (clientN.length == 0){
              $('#cCN').css('color','yellow')
              $('#cCN').val('Name must be at least three characters or longer!');
              $(this).val('');
              setTimeout(removeMessage, 1500);
              return;
           }
           if(clientN.length >= 3){                           
              $(this).removeAttr('READONLY');
              $.ajax({
                            url: '/chkIt.php',
                            type: 'POST',
                            data: {'username':clientN}, 
                            dataType: 'json',                      
                            success: function(response) {
                                     alert(response)
                                     if(response == 'Accepted'){                                       
                                        $('#cCN').prop('disabled', true);
                                     }

                            }
              });
           }else{
              alert('Client\'s name must three characters or longer before you can move forward.')
              $('#cCN').val('');
              $(this).val('');
           } 
        });
*/
        $('#cCE').on('change',function(){
           var e = $(this).val();
           $.ajax({
                            url: '/chkIt.php',
                            type: 'POST',
                            data: {'email':e,'setup':'client','partOf':myuseremail}, 
                            dataType: 'json',                      
                            success: function(response) {
                                     function removeMessage(){
                                        $('#cCE').val('');
                                        $('#cCE').css('color','#FFFFFF');
                                        $('.uEEra').hide();
                                     }
                                     if(response == 'Accepted'){
                                        $('#cCE').prop('disabled', true);
                                        $('.confirmcCE').show();
                                     }else{
                                        $('.uEEra').show();
                                        $('#cCE').css('color','yellow');
                                        $('#cCE').val(response);
                                        setTimeout(removeMessage, 2500);
                                     }
                            }
                  });

        });
        $('#confirmcCE').on('change',function(){
           var emailIs = $('#cCE').val();
           emailIs = emailIs.replace(/\s/g, '');
           var confirm = $(this).val();
           confirm = confirm.replace(/\s/g, '');
           if (confirm == emailIs){
              alert('Accepted')
              $(this).attr('readonly',true);
              $(\"input[name = 'clientCreate']\").removeAttr('DISABLED');
              $(\"input[name = 'clientCreate']\").css('background','grey');
              $(\"input[name = 'clientCreate']\").css('color','#00FF00');
           }else{
              function removeMessage(){
                                        $('#confirmcCE').val('');
                                        $('#confirmcCE').css('color','#FFFFFF');
                                        $('.confirmEError').hide();
                                     }
              $('.confirmEError').show();
              $(this).css('color','yellow');
              $(this).val('Email does not match, Please try again!');
              setTimeout(removeMessage, 2500);
           }
        });
        $('#sCC').on('click',function(){
           var cCN = $('#cCN').val();
           var cCE = $('#cCE').val();
           var cRN = $('#cRN').val();
           $.ajax({
                            url: '/createIt.php',
                            type: 'POST',
                            data: {'createC':uzer,'username':cCN,'useremail':cCE,'regID':cRN}, 
                            dataType: 'json',                      
                            success: function(response) {
                                        if(response != 'Rejected'){
                                           alert('Client has been created')
                                           var cCN = $('#cCN');
                                           var cE = $('.uE');
                                           var cCE = $('#cCE');
                                           var cRN = $('#cRN');
                                           var sCC = $('#sCC');
                                           cCN.val('');
                                           cCN.removeAttr('disabled');
                                           cCE.val('');
                                           cCE.removeAttr('disabled');                                           
                                           cRN.val('');
                                           $('.confirmcCE').hide();
                                           $('#confirmcCE').val('');
                                           $('#confirmcCE').removeAttr('readonly');
                                           cE.hide();
                                           sCC.css({'background':'#000000','color':'#FFFFFF'});
                                           sCC.attr('disabled',true);
                                           cRN.val(response);                                          
                                        }

                            }
           });           
        });
        onceTime = 0;
        $('#creatingTeam').on('click',function(){
           onceTime = onceTime + 1;
           $('#myPickups').show();
           $('#cloudContainer').hide();
           $('#myClient').hide();
           $('#myDrops').hide();
           if (onceTime == 1){              
              var uuUser = $('#cScroll').clone();
              uuUser.attr({'id':'newTeam','class':'teamScroll'});             
              $('#createTeam').after(uuUser); 
              uuUser.show();
              uuUser.append('<option value=\"tester_tester-com\" name=\"McTester\"> tester &hArr; tester@tester.com </option>');
              uuUser.append('<option value=\"test_tester-com\" name=\"McGiver\"> test &hArr; test@tester.com </option>');           
           } 
        });
        $('#createTeam').change(function(){
           $('.teamName').text(this.value +' ');
        });
        sV = '';
        $(document).delegate('#newTeam','change', function(){
           if($('#createTeam').val() == ''){
              alert('You must name your team before proceeding')
              $(this).prop('selectedIndex',0);
              return;
           }
           sV = $(this).val();
           $('#newTeam option[value='+sV+']').remove(); 
           var Display   = sV.replace('_','@');
           Display = Display.replace('-','.');           
           $('#teamUsers').append(\"<br class='\"+sV+\"'><input class='\"+sV+\"' type='text' value='\"+Display+\"' disabled='disabled' style='width:35%;background-color:#000000;color:#FFFFFF;text-align:center;' /><input id='\"+sV+\"' class='removeMember' type='button' value='X' style='width:4%;background-color:#000000;color:#FFFFFF;text-align:center;'  />\");
            $('#sendPickup').val('Create '+$(\"#createTeam\").val()+' Team');
            $('#sendPickup').show();           
        });
        $(document).delegate('.removeMember','click',function(){
           var rMv = $(this).attr('id');
           $('.'+rMv).remove();
           $('#'+rMv).remove();
           var pBack = rMv.replace('_','@');
           pBack = pBack.replace('-','.');
           var firstName = pBack.split('@');
           $('#newTeam').append('<option value=\"'+rMv+'\">'+firstName[0]+' &hArr; '+pBack+'</option>');
           if($('.removeMember').length == 0){
              $('#sendPickup').val('');
              $('#sendPickup').hide();
              $('#createTeam').val('');
           } 
        });
        $('#creatingDrops').on('click',function(){
           $('#myDrops').show();
           $('#cloudContainer').hide();
           $('#myClient').hide();
           $('#myPickups').hide();
        });
        $('#searchUO').on('click',function(){             /////////////////////////////////////////////////////////////////////////////// SEARCH
           $('#createOpt').hide();
           $('#manageOpt').hide();
           $('#requestOpt').hide();
           $('#messagesOpt').hide(); 
           $('#calendarOpt').hide();
           $('#calendar').hide();
           $('#cloudContainer').hide();
           $('#myClient').hide();
           $('#myPickups').hide();
           $('#myDrops').hide();
           $('#clientsMan').hide();
           $('#containerMan').hide();
           $('#pickupsMan').hide();
           $('#dropsMan').hide();
           $('.emailWrapper').hide();
           $('.emailSentWrapper').hide();
           $('.hide').hide();
           $('#searchOpt').show();
        });
        $('#cloudSearch').on('click',function(){
           $('#containerSearch').show();
           $('#userSearches').hide();  
           $('#clientSearches').hide();       
        });
        $('#userSearch').on('click',function(){
           $('#containerSearch').hide();
           $('#clientSearches').hide();
           $('#userSearches').show();          
        });
        $('#clientSearch').on('click',function(){
           $('#userSearches').hide();
           $('#containerSearch').hide()
           $('#clientSearches').show();
        });
        $('#manageUO').on('click',function(){         //////////////////////////////////////////////////////////////////////////////////////////// MANAGE  
           $('#createOpt').hide();
           $('#searchOpt').hide();
           $('#requestOpt').hide();
           $('#messagesOpt').hide();
           $('#calendarOpt').hide();
           $('#calendar').hide();
           $('#cloudContainer').hide();
           $('#myClient').hide();
           $('#myPickups').hide();
           $('#myDrops').hide();
           $('#userSearches').hide();
           $('#containerSearch').hide(); 
           $('#clientSearches').hide();
           $('.emailWrapper').hide();
           $('.emailSentWrapper').hide();
           $('.hide').hide();
           $('#manageOpt').show();
        });
        $('#manContainer').on('click',function(){
           $('#containerMan').show();
           $('#clientsMan').hide();
           $('#pickupsMan').hide();
           $('#dropsMan').hide();
        });
        $('#manClients').on('click',function(){
           $('#clientsMan').show();
           $('#containerMan').hide();
           $('#pickupsMan').hide();
           $('#dropsMan').hide();
        });
        $('#manPickups').on('click',function(){
           $('#pickupsMan').show();
           $('#containerMan').hide();
           $('#clientsMan').hide();
           $('#dropsMan').hide();
        });
        $('#manDrops').on('click',function(){
           $('#dropsMan').show();
           $('#containerMan').hide();
           $('#clientsMan').hide();
           $('#pickupsMan').hide();
        });           
        $('#requestUO').on('click',function(){           
           $('#createOpt').hide();
           $('#searchOpt').hide();
           $('#manageOpt').hide();
           $('#messagesOpt').hide();
           $('#calendarOpt').hide(); 
           $('#calendar').hide();
           $('#cloudContainer').hide();
           $('#myClient').hide();
           $('#myPickups').hide();
           $('#myDrops').hide();
           $('#userSearches').hide();
           $('#containerSearch').hide();
           $('#clientSearches').hide();
           $('#clientsMan').hide();
           $('#containerMan').hide();
           $('#pickupsMan').hide();
           $('#dropsMan').hide();
           $('#requestOpt').show();
        });
        $('#messagesUO').on('click',function(){           ///////////////////////////////////////////////////////////////////////////////////////////  Messages
           $('#createOpt').hide();
           $('#searchOpt').hide();
           $('#manageOpt').hide();
           $('#requestOpt').hide();
           $('#calendarOpt').hide();
           $('#calendar').hide();
           $('#cloudContainer').hide();
           $('#myClient').hide();
           $('#myPickups').hide();
           $('#myDrops').hide();
           $('#userSearches').hide();
           $('#containerSearch').hide();
           $('#clientSearches').hide();
           $('#clientsMan').hide();
           $('#containerMan').hide();
           $('#pickupsMan').hide();
           $('#dropsMan').hide();
           $('.hide').hide();
           $('#messagesOpt').show();
           $('#inboxM').show(); 
        });
        attArray = [];
        attCount = 0;
        mForward = 0;
        mReply = 0;
        $('#sendMessage').on('click',function(){
           var sFrom = $('#sendFrom').val();
           var sTo = $('#sendTo').val();
           if (sTo == ''){
              alert('You must add recipient')
              return;
           }
           var sSubject = $('#sendSubject').val();
           alert(attCount)
           if (attCount != 0){
              if (attCount >= 2){ 
                 alert('more than one')
                 var sAtt = attArray;
                 attArray = [];
                 //$('input[class=\"sendAtt\"]').each(function(i, el){
                 //   sAtt.push($(this).val());   
                 //});
              }else{
                 var sAtt = attArray[0];   //$('.sendAtt').text();
                 alert('just one= '+ sAtt)
              }
           }else{
              alert('no attachments')  
              var sAtt = null;
           }           
           var sBody = $('#sendBody').val();
           $.ajax({
                   url:       'sMess.php',
                   type:      'POST',
                   data:      {'from':sFrom,'to':sTo,'sub':sSubject,'attach':sAtt,'body':sBody,'mFwd':mForward, 'mRpy':mReply},
                   success:   function(response){
                                 if (response == 'Approved'){
                                    location.reload();
                                 }else{
                                    alert(response);
                                 }
                              }
           });
        });
        $('#submitSend').on('click',function(){
        });
        $('#selectTo').on('click',function(){
           var size = $('#addClient').children('option').length;
           if (size > 1 ){
             $('#addClient').show();
           }
        });
        $('#selectAtt').on('click',function(){
           
        });      
        $('#addClient').on('change',function(){
           var apnd = $('#to').val();
           $('#to').val(apnd +$(this).val()+';');
           $('#addClient option[value='+$(this).val()+']').remove();
           $(this).hide();
        });
        $('.closeSend').on('click',function(){
           $('#sendModal').hide();
           $('#sentBody').hide();
           //$('#sendModal').children().last().remove(); // Doesn't work... thought it was but not!
           $('#sendTo').val('');
           $('#sendSubject').val('');
           $('#sendBody').val('');
           $('#attSize').text('');
           $('#totalSize').text('');
           $('.sendAtt').each(function(i, el){
              el.remove();
           });
           $('.dz-preview').remove();
           attCount = 0;
           mForward = 0;
           mReply = 0;
           attArray = [];         
        });
        $('.mRply').on('click',function(){
           $('#newM').trigger('click');
           var To = $(this).attr('id');
           var sub = $(this).attr('title');
           var mes = $(this).attr('alt');
           mReply = mes;
           var messHead = $('#'+mes).text();
           var mess = $('.'+mes).text();
           $('#sendTo').val(To);
           $('#sendSubject').val(sub);
           $('#sendBody').val('\\n \\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\\n'+messHead +'\\n \\n'+  mess);
        });

        $('.mFwd').on('click',function(){                      
           $('#newM').trigger('click');
           var sub = $(this).attr('title');
           var mes = $(this).attr('alt');
           mForward = mes;
           var aTT = [];
           $('.'+mes+'_att').each(function(i, obj){
              var v = $(this).attr('download');
              aTT.push(v);
           });
           var messHead = $('#'+mes).text();
           var mess = $('.'+mes).text();
           var fileN = mes+'_';
           var attach = [];
           if(aTT.length > 0){              
              if (aTT.length > 1){
                 //$('#placeAtt').append('<input class=\"sendAtt\" type=\"hidden\" name=\"mFwd\" />');                 
                 for(var i = 0; i <= aTT.length; i++){
                    if (aTT[i] === undefined){
                      continue;
                    }
                    var c = aTT[i];
                    var cName = c.replace(/[^a-zA-Z0-9]/g,'');                            
                    $('#placeAtt').append('<img id=\"'+cName+'_Icon\" class=\"sendAtt\" src=\"/IMG/addAtt.png\" alt=\"'+aTT[i]+'\" height=\"15\" width=\"15\"><input id=\"'+cName+'\" class=\"sendAtt\" type=\"text\" value=\"'+aTT[i]+'\" name=\"Forward\" style=\"width:auto;background-color:#000000;color:#FFFFFF\" READONLY />');
                    attCount++;
                    attArray.push(aTT[i]);
                    getFileSize = true;
                    phpBytes(fileN.concat(aTT[i]));
                 }
             }else{
                $('#placeAtt').append('<img class=\"sendAtt\" src=\"/IMG/addAtt.png\" alt=\"'+aTT+'\" height=\"15\" width=\"15\"><input id=\"send_'+aTT+'\" class=\"sendAtt\" type=\"text\" value=\"'+aTT+'\" name=\"attached\" style=\"width:auto;background-color:#000000;color:#FFFFFF\" READONLY />');
                attCount++;
                attArray.push(aTT[i]);
                getFileSize = true;
                phpBytes(fileN.concat(aTT));
             }
           }
           $('#sendSubject').val(sub);
           $('#sendBody').val('\\n \\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~\\n'+messHead +'\\n \\n'+  mess);
           var e = $('#attSize').html();
           /*
           if (e.includes('KB')){
              e = e.replace('KB','');
              function frKbToBytes(bits){
                 var get = bits.split('.');
                 var int = get[0] * +1024;
                 var fra = get[1];
                 var total = int + +fra;
                 $('#totalSize').html(int);   
              }
              frKbToBytes(e);
           }
           if (e.includes('MB')){
              e = e.replace('MB','');
              function frMbToBytes(bits){
                 alert('running MB to Bytes js function')
                 var get = bits.split('.');
                 var int = get[0];
                 var fra = get[1] * +1024;
                 var total = int + +fra;
                 $('#totalSize').html(total);   
              }
              frMbToBytes(e);
           }
           //$('#attSize').html('');                                                                                   
           alert('this is e= '+ e)
           */
        });
        $('#newM').on('click',function(){
           $('#sendModal').show();
           $('#sentBody').show();
           $('#sentBody').appendTo('#sendModal');
        });
        messageBox = 'emailAtt';
        $('#sentMessages').on('click',function(){
           $('#sentMessages').hide();
           $('#inboxMessages').show();
           InBoxM = $('#inboxM').detach();
           $('#sentM').show();
           messageBox = 'emailAtt/sent';
           return false;
        });
        $('#inboxMessages').on('click',function(){
           $('#inboxMessages').hide();
           $('#sentMessages').show();
           $('#sentM').hide();
           $('#inboxHere').append(InBoxM);           
           $('#inboxM').show();
           messageBox = 'emailAtt';  
           return false;
        });
        function continueHere(){
           var oneToManySent = $('[class$=_sentchk]:checkbox:checked');
           if(Object.keys(oneToManySent).length <= 2){
               return;
           }else if (Object.keys(oneToManySent).length == 3){
               var Title = 'Delete Email Confirm';
           }else {
               var Title = 'Delete Emails Confirm';
           }
           $.confirm({
              title: Title,
              content: 'This action can not be undone!',
              buttons: {
                 confirm: function () {
                    $.alert('Confirmed!');
                    $('[class$=_sentchk]:checkbox:checked').each(function(){
                       var folderN = '$myusername';
                       var Del = $(this).val();
                       //alert(Del)
                       var Hide = $(this).attr('name');
                       //alert(Hide)
                       $.ajax({
                             url: 'removeM.php',
                             type:  'POST',
                             data:  {'deleting':Del,'folder':folderN,'attach':Hide}, 
                             success: function(result){
                                 $('#'+Hide).parent().hide();
                             }
                       });
                    });
                 },
                 cancel: function () {
                    var Hide = $(this).attr('name');
                    $.alert('Canceled!');
                 }
              }
           });
        }
        $('#deleteM').on('click',function(){
           var oneToMany = $('[class$=_chk]:checkbox:checked');
           var oneToManySent = $('[class$=_sentchk]:checkbox:checked');
           if(Object.keys(oneToMany).length <= 2){
               if(Object.keys(oneToManySent).length <= 2){
                  alert('You must select a email')
               }else{
                  continueHere();
               }
               return;
           }else if (Object.keys(oneToMany).length == 3){
               var Title = 'Delete Email Confirm';
           }else {
               var Title = 'Delete Emails Confirm';
           }
           $.confirm({
              title: Title,
              content: 'This action can not be undone!',
              buttons: {
                 confirm: function () {
                    $.alert('Confirmed!');
                    $('[class$=_chk]:checkbox:checked').each(function(){
                       var folderN = '$myusername';
                       var Del = $(this).val();
                       //alert(Del)
                       var Hide = $(this).attr('name');
                       //alert(Hide)
                       $.ajax({
                             url: 'removeM.php',
                             type:  'POST',
                             data:  {'deleting':Del,'folder':folderN,'attach':Hide}, 
                             success: function(result){
                                 $('#'+Hide).parent().hide();
                                 continueHere();
                             }
                       });
                    });
                 },
                 cancel: function () {
                    var Hide = $(this).attr('name');
                    $.alert('Canceled!');
                 }
              }
           });
        });
        $('.messShow').on('click',function(){
           var show = $(this).attr('id');
           $('#show_'+show).show();
        });
        $('.messShowSent').on('click',function(){
           var show = $(this).attr('id');
           $('#show_'+show).show();
        });
        $('.openMessage').on('click',function(){
           var mess = $(this).attr('id');
           $('.showMess'+mess).show();
        });
        $('.closeMessage').on('click',function(){
           var mess = $(this).attr('value');
           $('#'+mess).hide();           
        });
        $('#expandM').on('click',function(){
           eX = $('#eX').detach();
           $(this).hide();
           $('#collapseM').show();
           $('#myModal').show();
           //$('#messagesUO').clone(true).appendTo('#myModal');
           $('#messagesUO').appendTo('#myModal');
           $('#inboxM').css('height','400px');
           $('#sentM').css('height','400px');
        });
        $('#collapseM').on('click',function(){
           $('#messagesOpt').prepend(eX);
           $('#calendarUO').before($('#messagesUO'));
           $('#myModal').children().last().remove();
           $('#collapseM').hide();
           $('#expandM').show();
           $('#myModal').hide();
           $('#inboxM').css('height','200px');
           $('#sentM').css('height','200px');           
        });
        /////////////////////////////////////////////////////////////////////////////////////////////////// CALENDAR
        var month = '$month';
        var start = '$firstDayMo';                     
        var End = '$numDays';
        var year = '$yR';
        var skipped = 36 - End - start;
        calendarExp = false;
        var months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        var Days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
        var monthIndex = months.indexOf(month);
        var trigClick = 0; 
        $('#calendarUO').on('click',function(){           
           $('#createOpt').hide();
           $('#searchOpt').hide();
           $('#manageOpt').hide();
           $('#requestOpt').hide();
           $('#messagesOpt').hide(); 
           $('#cloudContainer').hide();
           $('#myClient').hide();
           $('#myPickups').hide();
           $('#myDrops').hide();
           $('#userSearches').hide();
           $('#containerSearch').hide();
           $('#clientSearches').hide();
           $('#clientsMan').hide();
           $('#containerMan').hide();
           $('#pickupsMan').hide();
           $('#dropsMan').hide();
           $('.emailWrapper').hide();
           $('.emailSentWrapper').hide();
           $('#calendarOpt').show();
           $('#calendar').show();           
        });                
        $('#calHistory').on('click',function(){
           $('#historyOptions').show();  
           $('#deadlineOptions').hide(); 
           $('#calShareOptions').hide(); 
           //alert($('.cHScroll').length)
           if ($('.cHScroll').length > 0 ){
              $('.cHScroll').show();
              //alert('yes')
           }else{
              justOnce = 0;
           }   
        });               
        $('#clientHistory').on('click',function(){
           //alert(justOnce);               
           $(this).css({'background-color':'#00bfff','color':'#ffff00'});
           $('#transferHistory').css({'background-color':'','color':'#000000'});
           $('#eventHistory').css({'background-color':'','color':'#000000'});
           $('#historyStyleView').hide();         
           if (justOnce == 1){
              //alert('lenth= '+$('.cHScroll').length)  
              $('.cHScroll').show();
           }else{
              justOnce = justOnce + 1;
              if (justOnce == 1){
                 var ccC = $('#cScroll').clone();
                 ccC.attr('class','cHScroll hide');
                 $('#historyOptions').before(ccC);             
              }
           }                  
        });
        $('#transferHistory').on('click',function(){
           $(this).css({'background-color':'#00bfff','color':'#ffff00'});
           $('#clientHistory').css({'background-color':'','color':'#000000'});
           $('#eventHistory').css({'background-color':'','color':'#000000'});
           $('.cHScroll').remove();
           justOnce = 0;
           $('#historyStyleView').show();
           
        });
        $('#eventHistory').on('click',function(){
           $(this).css({'background-color':'#00bfff','color':'#ffff00'});
           $('#transferHistory').css({'background-color':'','color':'#000000'});
           $('#clientHistory').css({'background-color':'','color':'#000000'});
           $('.cHScroll').remove();
           justOnce = 0;
           $('#historyStyleView').hide();
        });      
        $('#expandCalendar').on('click',function(){
           calendarExp = true;
           $('.day').each(function (i){
              if($(this).attr('title') != null){
                 $(this).css('background-color','#FFFFFF');  
              }
           });
           //alert('made it to expand')           
           CalX = $('#calendar-eX').detach();
           CalP = $('#calPreview').detach();
           $(this).hide();
           $('#collapseCalendar').show();
           $('#calendarModal').show();
           $('#calendarUO').appendTo('#calendarModal');
           $('#calendarOpt').show();
           $('#calendar').show();
           //$('#calendar').appendTo('#calendarModal');
           //$('#calStart').css('margin-left','200px');
           $('.day').css({'width':'150px','height':'150px'});
           //$('.week').appendTo('#calendarModal');
           $('.moreWeek').css('margin-left','375px');
           if (trigClick > 0 ){
              $('#calendarOpt').show();
              $('#calendar').show();              
           }
           trigClick = trigClick + 1;
        });
        $('#collapseCalendar').on('click',function(){
           calendarExp = false;
           $('#calendarOpt').prepend(CalX);
           $('.moreWeek').append(CalP);
           $('#messagesUO').after($('#calendarUO'));
           //$('#calendarUO').append($('.week'));
           //$('#calendarUO').append($('.moreWeek'));
           $('#calendarModal').children().last().remove();
           $(this).hide();
           $('#expandCalendar').show();
           $('#calendarModal').hide();
           $('.day').css({'width':'85px','height':'85px'});
           //$('#calStart').css('margin-left','7px');
           $('.moreWeek').css('margin-left','9px');
         
        });        
        $('#calDeadlines').on('click',function(){
           if(typeof justOnce == 'undefined'){
              justOnce = 0;
           }
           $('.cHScroll').hide();
           $('#calShareOptions').hide();
           $('#historyOptions').hide();
           $('#deadlineOptions').show();
           if(justOnce == 0){                       
              justOnce = justOnce + 1;
           }          
           if (justOnce == 1){
              $('#deadlineClient').remove();
              var ccC = $('#cScroll').clone();
              ccC.attr('id','deadlineClient');
              ccC.attr('class','deadlineScroll hide');
              $('#copyClients').before(ccC); 
              ccC.append('<option value=\"test\"> test </option>');         
           }   
        });
        //$('#deadlineClient').on('change', function(){
        $(document).delegate('#deadlineClient','change',function(){
           if($('#deadlineAdd').val() == ''){
              alert('You must name deadline first')
              this.selectedIndex = 0;
           }else{
              $('#datepick').removeAttr('disabled');
              $('#deadlineAdd').attr('disabled','disabled');
              ca = $(this).val();
              $(this).before(\"<input type='text' value=\"+ca+\" style='text-align:center' disabled='disabled'/>\");
              $(this).remove();
           }
        });
        $('#datepick').change(function(){
           $('#timepick').removeAttr('disabled');
        });
        $('#timepick').change(function(){
           $('#submitDeadline').show();
        });
        var onlyOnce = 0;
        $('#calShare').on('click', function(){        
           onlyOnce = onlyOnce + 1;
           $('#deadlineOptions').hide();
           $('#historyOptions').hide();
           $('#calShareOptions').show();
           $('.cHScroll').hide();
           if($('.shareScroll').lenth > 0){
              $('.shareScroll').remove();
           }
           if (onlyOnce == 1){
              var uuU = $('#uScroll').clone();
              uuU.attr({'id':'calShareUsers','class':'shareScroll'});              
              $('#copyUsers').before(uuU);
              uuU.show();
              uuU.append('<option value=\"test_legallanguage-com\"> what the fuck &hArr; test@test.com </option>');                       
           }   
        });
        //$('#calShareUsers').change(function(){
        $(document).delegate('#calShareUsers','change', function(){
           var sV = $(this).val();
           //alert(sV)
           var displayName = sV.replace('-','.'); displayName = displayName.replace('_','@');
           $('#calShareUsers option[value='+sV+']').remove(); 
           $('#sharedUsers').append(\"<br class='_\"+sV+\"' ><input type='text' class='_\"+sV+\"' value='\"+displayName+\"' disabled='disabled' style='width:35%;background-color:#000000;color:#FFFFFF;text-align:center;' /><input id='\"+sV+\"' class='removeShare' type='submit' value='X' style='width:4%;background-color:#000000;color:#FFFFFF;text-align:center;'  />\");           
        });
        $(document).delegate('.removeShare','click', function(){           
           var rMv = $(this).attr('id');
           $('#'+rMv).remove();
           $('._'+rMv).remove();
           var displayName = rMv.replace('-','.'); 
           //alert(displayName)
           displayName = displayName.replace('_','@');
           var firstName = displayName.split('@');
           //alert(firstName)
           $('#calShareUsers').append('<option value=\"'+rMv+'\"> '+firstName[0]+' &hArr; '+displayName+' </option>');
        });
        $('#previousM').on('click',function(){
           //alert(calendarExp)
           var cY = $('#calendarY').val();
           //alert(year +' & '+ cY)           
           $('.day').contents().filter(function(){
              return (this.nodeType == 3);
           }).remove();           
           var yR = $('#calendarY').val();
           var mO = $('#calendarM').val();
           if (mO == 'January'){
              var mOI = 11;
              y = --yR;
              $('#calendarY').val(y);
              yR = $('#calendarY').val();
           }else{ 
              var d = months.indexOf(mO);
              var mOI = --d;
           }           
           $('#calendarM').val(months[mOI]);
           function daysInMonth (month, year) {
              return new Date(year, month+1, 0).getDate();
           }
           function firstDayInMonth (month, year) {
              return new Date(year, month, 1);
           }
           End = daysInMonth(mOI,yR);
           var fMo = firstDayInMonth(mOI,yR);
           fMo = String(fMo);
           fMo = fMo.split(' ', 1);
           start = Days.indexOf(String(fMo));           
           $('.info').text('');
           for (i=0;i<=36;i++){
              if (i >= start && i <= 35 - (36 - End - start) ){
                 continue;
              }
              $('#d'+i).css('background-color','#eee');
              $('#d'+i).attr('title','');
           }
           for (i=1;i<=End;i++){
              $('#'+start).html(i+')');
              $('#'+start).css('background-color','#d3d3d3');
              $('#'+start).parent().attr('title',mOI+'-'+i+'-'+yR);
              $('#'+start).parent().css('background-color','');
              if(calendarExp == true){
                 $('#'+start).parent().css('background-color','#FFFFFF');  
              }
           start++;
           } 
           if( year == cY){
              $('span[title=\"".$thisMonth."-".$toDay."-".$yR."\"]').append('TODAY');
           }
        });
        $('#nextM').on('click',function(){
           var cY = $('#calendarY').val();
           //alert(calendarExp)
           $('.day').contents().filter(function(){
              return (this.nodeType == 3);
           }).remove();
           var yR = $('#calendarY').val();
           var mO = $('#calendarM').val();
           if (mO == 'December'){
              var mOI = 0;
              y = ++yR;
              $('#calendarY').val(y);
              yR = $('#calendarY').val();
           }else{ 
              var d = months.indexOf(mO);
              var mOI = ++d;
           }           
           $('#calendarM').val(months[mOI]);
           function daysInMonth (month, year) {
              return new Date(year, month+1, 0).getDate();
           }
           function firstDayInMonth (month, year) {
              return new Date(year, month, 1);
           }
           End = daysInMonth(mOI,yR);
           var fMo = firstDayInMonth(mOI,yR);
           fMo = String(fMo);
           fMo = fMo.split(' ', 1);
           start = Days.indexOf(String(fMo));           
           $('.info').text('');
           for (i=0;i<=36;i++){
              if (i >= start && i <= 35 - (36 - End - start) ){
                 continue;
              }
              $('#d'+i).css('background-color','#eee');
              $('#d'+i).attr('title','');
           }
           for (i=1;i<=End;i++){                            
              $('#'+start).html(i+')');
              $('#'+start).css('background-color','#d3d3d3');              
              $('#'+start).parent().attr('title',mOI+'-'+i+'-'+yR);
              $('#'+start).parent().css('background-color','');
              if(calendarExp == true){
                 $('#'+start).parent().css('background-color','#FFFFFF');  
              }
           start++;
           }
           if( year == cY){             
              $('span[title=\"".$thisMonth."-".$toDay."-".$yR."\"]').append('TODAY');
           } 
        });
        for (i=0;i<=36;i++){
           if (i >= start && i <= 35 - (36 - End - start) ){
              continue;              
           }
           $('#d'+i).css('background-color','#eee');
        }
        $('#'+start).html('1)');
        $('#'+start).css('background-color','#d3d3d3');
        $('#'+start).parent().attr('title',monthIndex+'-1-'+year);  
        start = ++start;         
        for (i=2;i<=End;i++){
           //$('#'+start).parent().contents().empty();
           $('#'+start).html(i+')');
           $('#'+start).css('background-color','#d3d3d3'); 
           $('#'+start).parent().attr('title',monthIndex+'-'+i+'-'+year);
           $('#'+start).parent().css('background-color','');  
           start++;
        }  
        //for (i=2;i<=End;i++){
        //   $('#'+start).html(i+')');
        //   $('#'+start).css('background-color','#d3d3d3'); 
        //   $('#'+start).parent().attr('title',monthIndex+'-'+i+'-'+year); 
        //   start++;
        //}          
        $('#calendar').ready(function(){
           //alert(year +'".$yR."')
           if( year == ".date('Y', strtotime('now'))."){
              $('span[title=\"".$thisMonth."-".$toDay."-".$yR."\"]').append('TODAY');
              //$('span[title=\"".$thisMonth."-".$toDay."-".$yR."\"]').css('background-color','yellow'); //   append('TODAY');
           }
        });

////////////////////////////////////////////////////////////////////////////////////////////////  Folders
        
        changeOnce = 0;
        moreThanOne = 0;                
        $(document).delegate('#deleteObject','click',function(){ 
           var fF = $(this).val();
           var folder = $('#location').val();
           //alert('made it')
           var folderShow = $('#locationShow').val()+'fakefile.js';
           //var path = require('path');
           //folder = path.dirname(folder);
           var folderz = folderShow.split('/');
           //alert('actual location= '+folder)
           var filesIn = $('.file').length;
           var foldersIn = $('.f').length;           
           if (fF == 'Delete Folder'){
              var content = 'This action may or may not be undone!'
              if (filesIn == 1){
                 var fileStr = '  The file in this folder will be deleted.';
                 content = content.concat(fileStr);
              }else if (filesIn >= 2){
                 var fileStr = '  Files in this folder will be deleted.';
                 content = content.concat(fileStr);
              }
              if (foldersIn == 1){
                 var fileStr = '  That subfolder in this folder will also be deleted.';
                 content = content.concat(fileStr);
              }else if (foldersIn >= 2){
                 var fileStr = '  The subfolders in this folder will also be deleted.';
                 content = content.concat(fileStr);
              }
              var fName = folderz[folderz.length-2];
              $.confirm({
                 title: fF +'= '+fName,
                 content: content,
                 buttons: {
                    confirm: function () {
                       $.ajax({
                               type: 'POST',
                               url:  'fcalls.php',
                               data: {'deleteFolder':folder,'dir':myusername},                               
                               success:  function(response){
                                            if(response == 'Deleted'){
                                               $('#backOne').trigger('click');
                                            }else{
                                               alert(response)
                                            }
                                         }
                       });
                    },
                    cancel: function () {                       
                    }
                 }
              });    
           }
           if (fF == 'Delete File'){
              var file = $('.deleteFile');
               //.attr('name').is(':checked');              
              var fileName;              
              file.each(function(){
                 if($(this).is(':checked')){
                    fileName = $(this).attr('name');
                 }
              });
              var folderName = folderz[folderz.length-2];
              var content = fileName+' file will be removed from '+folderName+'.  This option may or may not be undone.';                            
              $.confirm({
                 title: fF +'= '+fileName+' From folder: '+folder,
                 content: content,
                 buttons: {
                    confirm: function () {
                       $.ajax({
                               type: 'POST',
                               url:  'fcalls.php',
                               data: {'deleteFile':fileName,'dir':myusername,'destination':folder},                               
                               success:  function(response){
                                            var iD = fileName.replace('.','');
                                            iD = iD.replace(/\s/g,'');                                            
                                            function waitItOut(){
                                                $('#file_'+iD).remove();
                                             }
                                            if(response == 'Deleted'){
                                               alert('this is iD= '+iD)
                                               $('#deleteObject').val('Delete Folder');
                                               $('#Del_'+iD).prop('checked',false);
                                               moreThanOne = 0;
                                               $('#file_'+iD).empty();
                                               $('#file_'+iD).append('<img id=\"justDeleted\" class=\"fileImage\" src=\"/IMG/poof.gif\" data-file=\"removedImage\" height=\"50\" width=\"55\">');
                                               setTimeout(waitItOut, 2400);
                                            }else{
                                               alert(response)
                                            }
                                         }
                       });
                    },
                    cancel: function () {                       
                    }
                 }
              });
           }
           if (fF == 'Delete Files'){
              //alert('Files')
              var file = $('.deleteFile');
               //.attr('name').is(':checked');              
              var fileNames = [];              
              file.each(function(){
                 if($(this).is(':checked')){
                    fileNames.push($(this).attr('name'));
                 }
              });
              var folderName = folderz[folderz.length-2];
              var content = 'These files will be removed from '+folderName+' folder.  This option may or may not be undone.';  
              var num = 0;                          
              $.confirm({
                 title: fF +' from= '+folderName,
                 content: content,
                 buttons: {
                    confirm: function () {
                          $.ajax({
                                  type: 'POST',
                                  url:  'fcalls.php',
                                  data: {'deleteFiles':fileNames,'dir':myusername,'destination':folder}, 
                                  dataType:  'json',                              
                                  success:  function(response){
                                               var n = 0;                                                                                              
                                               $.each(response, function(){
                                                  //alert('this is response #1= '+response[n])
                                                  var iD = response[n].replace('.','');
                                                  iD = iD.replace(/\s/g,'');                                                                                              
                                                  //alert('this is iD= '+iD)
                                                  $('#deleteObject').val('Delete Folder');
                                                  $('#Del_'+iD).prop('checked',false);
                                                  moreThanOne = moreThanOne - 1;
                                                  function waitItOut(){
                                                     $('#file_'+iD).remove();
                                                  }
                                                  $('#file_'+iD).empty();
                                                  $('#file_'+iD).append('<img id=\"justDeleted\" class=\"fileImage\" src=\"/IMG/poof.gif\" data-file=\"removedImage\" height=\"50\" width=\"55\">');
                                                  setTimeout(waitItOut, 1000);                                                                                                    
                                                  n = n + 1;
                                               });                                                    
                                            }
                          });
                    },
                    cancel: function () {                       
                    }
                 }
              });
           }
        });
       
        $(document).delegate('#deleteAllFiles','click',function(){ 
           var chk = $(this).is(':checked'); 
           var filez = $('.deleteFile').length; 
           if (chk == true){   
              $(this).prop('checked',true);
              $('.deleteFile').prop('checked',true);
              $('#deleteObject').val('Delete Files');
              moreThanOne = filez;
           }
           if (chk == false){   
              $(this).prop('checked',false);
              $('.deleteFile').prop('checked',false);
              $(this).hide();
              moreThanOne = 0;
              $('#deleteObject').val('Delete Folder');
           }
        });
        $(document).delegate('.deleteFile','click',function(){              
           if (this.checked == true){
               //alert(true)
               moreThanOne = moreThanOne + 1;
           }
           if (this.checked == false){
               //alert(false)
               moreThanOne = moreThanOne - 1;
           }
           if(moreThanOne == 0){
              $('#deleteObject').val('Delete Folder');
              $('#deleteAllFiles').hide();
           }
           if(moreThanOne == 1){         
              $('#deleteObject').val('Delete File');              
           }
           if(moreThanOne > 1){         
              $('#deleteObject').val('Delete Files');
              $('#deleteAllFiles').show();
           }
           //alert('num= '+moreThanOne)                    
        });
        
        $('#location').change(function(){           
           destination = $(this).val();
           if (destination !== '/'){
              $('#deleteObject').removeAttr('Disabled');
           }else{
              $('#deleteObject').attr('Disabled','Disabled');
           }
           moreThanOne = 0;
           $('#deleteObject').val('Delete Folder');
           //alert('change string= '+destination)           
           $.ajax({
                   url: 'fcalls.php',
                   type:  'POST',
                   data:  {'getRootFolders':myusername,'destination':destination},
                   dataType: 'json', 
                   success: function(response){
                               response.forEach(function(iTem){
                                  if (iTem == '.' || iTem == '..'){
                                     return;
                                  }
                                  if (iTem.includes('.')){
                                     var fIndex = iTem.lastIndexOf('.');
                                     var lIndex = iTem.length;
                                     var ext = iTem.substring(fIndex, lIndex);
                                     ext = ext.replace('.','');
                                     ext = ext.toLowerCase();
                                     var iD = iTem.replace('.','');
                                     iD = iD.replace(/\s/g,'');
                                     //alert(destination)
                                     $('#folderOptions').append(\"<div id='file_\"+iD+\"' class='file' align='center' ><a id='dblClickdownload' name='\"+iTem+\"' href='/folderz/kevinr/dir\"+destination+iTem+\"' download> <img id='\"+iTem+\"' class='fileImage' src='/IMG/fileIcons/\"+ext+\".png' data-file='\"+iTem+\"'  height='50' width='55'></a><input id='Del_\"+iD+\"' class='deleteFile' type='checkbox' name='\"+iTem+\"' /> <br><label>\"+iTem+\"</label></div>\");
                                     return;
                                  }
                                  var status = 'folder';
                                  var files = '';
                                  $.ajax({
                                          url: 'fcalls.php',
                                          type:  'POST',
                                          data:  {'fStatus':myusername,'destination':destination,'folder':iTem}, 
                                          dataType: 'json', 
                                          success: function(response){
                                                      status = response;
                                                  },
                                                  async: false
                                  });
                                  $.ajax({
                                          url: 'fcalls.php',
                                          type:  'POST',
                                          data:  {'filesInFolder':myusername,'destination':destination,'folder':iTem}, 
                                          success: function(response){                                                      
                                                      files = response;
                                                  },
                                                  async: false
                                  });
                                  //alert(files)
                                  if (iTem.includes('_+Sh+E+S')){
                                     iTemN = iTem.replace('_+Sh+E+S', '');
                                     if (status == 'subfolder'){
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage shFolder' src='/IMG/subFolderShES.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }else{
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage shFolder' src='/IMG/emptyFolderShES.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }
                                     return;
                                  }
                                  if (iTem.includes('_+Sh+E')){
                                     iTemN = iTem.replace('_+Sh+E', '');
                                     if (status == 'subfolder'){
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage sheFolder' src='/IMG/subFolderShE.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }else{
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage sheFolder' src='/IMG/emptyFolderShE.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }
                                     return;
                                  }
                                  if (iTem.includes('_+Sh+S')){
                                     iTemN = iTem.replace('_+Sh+S', '');
                                     if (status == 'subfolder'){
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage shsFolder' src='/IMG/subFolderShS.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }else{
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage shsFolder' src='/IMG/emptyFolderShS.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }
                                     return;
                                  }
                                  if (iTem.includes('_+E+S')){
                                     iTemN = iTem.replace('_+E+S', '');
                                     if (status == 'subfolder'){
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage esFolder' src='/IMG/subFolderES.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }else{
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage esFolder' src='/IMG/emptyFolderES.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }
                                     return;
                                  }
                                  if (iTem.includes('_+Sh')){
                                     iTemN = iTem.replace('_+Sh', '');
                                     if (status == 'subfolder'){
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage shFolder' src='/IMG/subFolderSh.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }else{
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage shFolder' src='/IMG/emptyFolderSh.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }
                                     return;
                                  }
                                  if (iTem.includes('_+E')){
                                     iTemN = iTem.replace('_+E', '');
                                     if (status == 'subfolder'){
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage shFolder' src='/IMG/subFolderE.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }else{
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage shFolder' src='/IMG/emptyFolderE.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }
                                     return;
                                  }
                                  if (iTem.includes('_+S')){
                                     iTemN = iTem.replace('_+S', '');
                                     if (status == 'subfolder'){
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage shFolder' src='/IMG/subFolderS.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }else{
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTemN+\"' class='fImage shFolder' src='/IMG/emptyFolderS.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTemN+\"</label></div>\");
                                     }
                                     return;
                                  }
                                  if (status == 'subfolder'){
                                     if (files == 'filesInFolder'){
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTem+\"' class='fImage' src='/IMG/notEmptySubFolder.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTem+\"</label></div>\");
                                     }else{
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTem+\"' class='fImage' src='/IMG/subFolder.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTem+\"</label></div>\");
                                     }
                                  }else{
                                     if (files == 'filesInFolder'){
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTem+\"' class='fImage' src='/IMG/notEmptyFolder.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTem+\"</label></div>\");
                                     }else{
                                        $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+iTem+\"' class='fImage' src='/IMG/emptyFolder.png' data-folder='\"+iTem+\"'  height='50' width='55'><br><label>\"+iTem+\"</label></div>\");
                                     }
                                  }
                               });
                            }
                   });
        });
        
       $('#searchFolder').on('click', function (){
          var Dir = $('#locationShow').val();
          if (Dir == '/'){
             Dir = 'Root'
          }
          Dir = Dir.replace(/\//g,' ');          
          $('#locationShow').val('Type Here to Search'+Dir+'folder');
          $('#locationShow').removeAttr('readonly');
          $('#locationShow').on('click', function(){
             $('#locationShow').val('');
          });
       });

        $(document).delegate('#dblClickdownload','click',function(e){
           e.preventDefault();
           return;
        });
        $(document).delegate('#dblClickdownload','dblclick',function(e){
           var name = $(this).attr('name');
           var uri = $(this).attr('href');       
           var link = document.createElement('a');
           link.download = name;
           link.href = uri;
           link.click();
           return;
        });
        checkAttr = ['_+Sh+E+S','_+Sh+E','_+Sh+S','_+Sh','_+E+S','_+E','+S'];           
        $('#backOne').on('click',function(){
           var str = $('#location').val();
           //alert('this is back string= '+str)
           if (str == '/'){
              return;
           }           
           str = str.substring(0, str.length - 1);
           var remove = str.substring(0, str.lastIndexOf( '/' ) + 1);           
           $('#folderOptions').empty();
           $('#location').val(remove);
           $('#location').change();             
           checkAttr.forEach(function(i){
              //alert(remove +' and '+i)
              if (remove.includes(i)){
                 remove = remove.replace(i,'');
                 $('#locationShow').val(remove);
                 return; 
              }else{
                 $('#locationShow').val(remove);
              }
           });         
        });
        $(document).delegate('.fImage','dblclick',function(){
           var folder = $(this).attr('data-folder');
           var rewrite = $('#locationShow').val()+$(this).attr('id')+'/';
           $('#location').val($('#location').val() + folder +'/');
           $('#folderOptions').empty();
           $('#location').change();           
           $('#locationShow').val(rewrite);
        });
        $('#folderSelect').on('click',function(){
           if (changeOnce == '1'){
              return;
           }
           $('#location').trigger('change');
           changeOnce = 1;
           $.ajax({
                   url: 'fcalls.php',
                   type:  'POST',
                   data:  {'user':myusername}, 
                   success: function(response){
                               if (response => 2){
                                  //$('#folderOptions').html('No Folders Available');
                               } 
                            }
                   });
        });
        $(document).delegate('#addFolder','click',function(){
        //$('#addFolder').on('click',function(){
           $('#myFolderModal').show();
           $('#folderLocation').val($('#location').val());
           $('#folderLocationShow').val($('#locationShow').val());           
           $('#addingFolder').show();
           $('#addingFolder').appendTo('#myFolderModal');
        });
        $('#xlose').on('click',function(){
           $('#myFolderModal').hide();
           $('#addingfolder').hide();
           $('#folderName').val('');
           $('#shareFolder').css('background-color','');
           $('#shareFolder').attr('name','0');
           $('#secureFolder').css('background-color','');
           $('#secureFolder').attr('name','0');
           $('.sCode').hide();
           $('#secureCode').val('');
           $('.cCode').hide();
           $('.cCode').attr('name','0');
           $('#confirmCode').val('');
           $('#expireFolder').css('background-color','');
           $('#expireFolder').attr('name','0');
           $('.exp').hide();
           $('#expires').val('');
           $('#folders').attr('src','/IMG/emptyFolder.png');
           $('#featuresOptions').css('visibility','visible');        
           $('div.dz-success').remove(); 
           $('div.dz-message').innerHTML('<span>Drag files in here to upload, or click to select a file to upload</span>');
           $('div.dz-message').show();
           $('#fileDropZone').removeAllFiles();       
        });
        $('#shareFolder').on('click',function(){
           if($(this).attr('name') == '1'){
              $(this).css('background-color','');
              $(this).attr('name','0');
              if ($('#secureFolder').attr('name') == '1' && $('#expireFolder').attr('name') == '1' ){
                 $('#folders').attr('src','/IMG/emptyFolderES.png');
              }else if($('#secureFolder').attr('name') == '1'){
                 $('#folders').attr('src','/IMG/emptyFolderS.png');
              }else if ($('#expireFolder').attr('name') == '1'){ 
                 $('#folders').attr('src','/IMG/emptyFolderE.png');
              }else {
                 $('#folders').attr('src','/IMG/emptyFolder.png');
              }              
           }else{
              $(this).css('background-color','yellow');
              $(this).attr('name','1');
              if ($('#secureFolder').attr('name') == '1' && $('#expireFolder').attr('name') == '1' ){
                 $('#folders').attr('src','/IMG/emptyFolderShES.png');
              }else if($('#secureFolder').attr('name') == '1'){
                 $('#folders').attr('src','/IMG/emptyFolderShS.png');
              }else if ($('#expireFolder').attr('name') == '1'){ 
                 $('#folders').attr('src','/IMG/emptyFolderShE.png');
              }else {
                 $('#folders').attr('src','/IMG/emptyFolderSh.png');
              }
           }      
        });
        $('#secureFolder').on('click',function(){
           if($(this).attr('name') == '1'){
              $(this).css('background-color','');
              $(this).attr('name','0');
              $('.sCode').hide();
              $('#confirmCode').hide();
              $('#confirmCode').val('');
              $('#secureCode').val('');
              if ($('#shareFolder').attr('name') == '1' && $('#expireFolder').attr('name') == '1' ){
                 $('#folders').attr('src','/IMG/emptyFolderShE.png');
              }else if($('#shareFolder').attr('name') == '1'){
                 $('#folders').attr('src','/IMG/emptyFolderSh.png');
              }else if ($('#expireFolder').attr('name') == '1'){ 
                 $('#folders').attr('src','/IMG/emptyFolderE.png');
              }else {
                 $('#folders').attr('src','/IMG/emptyFolder.png');
              }              
           }else{
              $(this).css('background-color','yellow');
              $(this).attr('name','1');
              $('.sCode').show();
              //$('#secureCode').val('');
              if ($('#shareFolder').attr('name') == '1' && $('#expireFolder').attr('name') == '1' ){
                 $('#folders').attr('src','/IMG/emptyFolderShES.png');
              }else if($('#shareFolder').attr('name') == '1'){
                 $('#folders').attr('src','/IMG/emptyFolderShS.png');
              }else if ($('#expireFolder').attr('name') == '1'){ 
                 $('#folders').attr('src','/IMG/emptyFolderES.png');
              }else {
                 $('#folders').attr('src','/IMG/emptyFolderS.png');
              }
           }      
        });
        $('#expireFolder').on('click',function(){
           if($(this).attr('name') == '1'){
              $(this).css('background-color','');
              $(this).attr('name','0');
              $('.exp').hide();
              $('#expires').val('');
              if ($('#secureFolder').attr('name') == '1' && $('#shareFolder').attr('name') == '1' ){
                 $('#folders').attr('src','/IMG/emptyFolderShS.png');
              }else if($('#secureFolder').attr('name') == '1'){
                 $('#folders').attr('src','/IMG/emptyFolderS.png');
              }else if ($('#shareFolder').attr('name') == '1'){ 
                 $('#folders').attr('src','/IMG/emptyFolderSh.png');
              }else {
                 $('#folders').attr('src','/IMG/emptyFolder.png');
              }              
           }else{
              $(this).css('background-color','yellow');
              $(this).attr('name','1');
              $('.exp').show();
              if ($('#secureFolder').attr('name') == '1' && $('#shareFolder').attr('name') == '1' ){
                 $('#folders').attr('src','/IMG/emptyFolderShES.png');
              }else if($('#secureFolder').attr('name') == '1'){
                 $('#folders').attr('src','/IMG/emptyFolderES.png');
              }else if ($('#shareFolder').attr('name') == '1'){ 
                 $('#folders').attr('src','/IMG/emptyFolderShE.png');
              }else {
                 $('#folders').attr('src','/IMG/emptyFolderE.png');
              }
           }      
        });
        $('#submitFolder').on('click',function(){
           $('#featuresOptions').css('visibility','hidden');
           var acceptFolder = 'no';
           var folderLocation = $('#folderLocation').val();
           var fName = $('#folderName').val();
           var share  = $('#shareFolder').attr('name');
           var secure  = $('#secureFolder').attr('name');
           var expire  = $('#expireFolder').attr('name');
           var expireV = $('#expiresV').val();
           var confirm  = $('.cCode').attr('name');
           var code = $('#secureCode').val();
           var cCode = $('#confirmCode').val();
           var fShare = 'no'; 
           var fExpire = 'no';
           var fSecure = 'no';   
           //alert('this is date val=  '+expireV)        
           if (share == '1'){
              fShare = 'yes';
           }else{
              fShare = 'no';
           }     
           if (secure == '1' && code == ''){
              alert('Secure code must not be empty')
              acceptFolder = 'no';
              return;
           }
           if (secure == '1' && code.length <= 7){
              alert('Secure code must be 8 characters or longer')
              acceptFolder = 'no';
              return;
           }
           if (confirm == '1' && cCode == code){
              $('.cCode').attr('name','0');
              confirm = $('.cCode').attr('name');
              fSecure = 'yes';             
           } 
           if (secure == '1' && code.length <= 8){ 
              alert('Confirm security code and resubmit')          
              $('.cCode').show();
              $('.cCode').attr('name','1');
              $('#secureFolder').attr('name','0');
              secure = $('#secureFolder').attr('name');
              $('#resubmit').text('RESUBMIT');
              return;
           }
           if (confirm == '1' && cCode == ''){     
              alert('Confirm code must not be empty')
              return;
           }
           if (confirm == '1' && cCode != code){
              alert('Please Try Again')
              return;
           }
           if (confirm == '1' && cCode == code){
              secureF = 'yes';
           }
           if (expire == '1' && expireV == ''){
              alert('Expiration date must not be empty')
              return;
           }       
           if (expire == '1' && expireV != ''){
              $('#expireFolder').attr('name','0');
              expire  = $('#expireFolder').attr('name');
              fExpire = 'yes';
           }   
           if (secure == '0' && expire == '0' && confirm == '0' && fName == ''){
              alert('You must name folder')
              acceptFolder = 'no';
              return;
           }

           //alert('secure folder= '+secure)
           //alert('expire foloder= '+expire)
           //alert('confirm folder= '+confirm)
           if (secure == '0' && expire == '0' && confirm == '0' && fName != ''){
              $.ajax({
                   url: 'fcalls.php',
                   type:  'POST',
                   data:  {'chkName':fName,'dir':myusername,'destination':folderLocation}, 
                   success: function(response){
                               if (response == 'Exists'){
                                   alert('This destination already contains a folder named \"'+fName+'\"')
                                   $('#folderName').val('');
                                   acceptFolder = 'no';
                                   return;
                               }else{
                                  acceptFolder = 'yes';
                               } 
                            },
                   async: false
              });
           }else{
              return;
           }
           if (acceptFolder == 'yes'){
              //alert('share= '+fShare)
              //alert('expire= '+fExpire)
              //alert('secure= '+fSecure)
              $.ajax({ 
                   url: 'fcalls.php',
                   type:  'POST',
                   data:  {'createF':fName,'dir':myusername,'destination':folderLocation,'secureF':fSecure,'secureVal':cCode,'expireF':fExpire,'expireVal':expireV,'shareF':fShare}, 
                   success: function(response){
                               if (response == 'Created'){
                                   alert(fName+' folder created') 
                                   if (fShare == 'yes' && fExpire == 'yes' && fSecure == 'yes'){
                                      alert('share & expire & secure') 
                                      $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+fName+\"' class='fImage shesFolder' src='/IMG/emptyFolderShES.png' data-folder='\"+fName+\"'  height='50' width='55'><br><label>\"+fName+\"</label></div>\");                              
                                   }else if (fShare == 'yes' && fExpire == 'yes'){
                                      alert('share & expire') 
                                      $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+fName+\"' class='fImage sheFolder' src='/IMG/emptyFolderShE.png' data-folder='\"+fName+\"'  height='50' width='55'><br><label>\"+fName+\"</label></div>\");                              
                                   }else if (fShare == 'yes' && fSecure == 'yes'){
                                      alert('share & expire') 
                                      $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+fName+\"' class='fImage shsFolder' src='/IMG/emptyFolderShS.png' data-folder='\"+fName+\"'  height='50' width='55'><br><label>\"+fName+\"</label></div>\");                              
                                   }else if (fExpire == 'yes' && fSecure == 'yes'){
                                      alert('expire & secure') 
                                      $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+fName+\"' class='fImage esFolder' src='/IMG/emptyFolderES.png' data-folder='\"+fName+\"'  height='50' width='55'><br><label>\"+fName+\"</label></div>\");                              
                                   }else if(fShare == 'yes'){
                                      alert('share')
                                      $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+fName+\"' class='fImage shFolder' src='/IMG/emptyFolderSh.png' data-folder='\"+fName+\"'  height='50' width='55'><br><label>\"+fName+\"</label></div>\");
                                   }else if(fExpire == 'yes'){
                                      alert('expire')
                                      $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+fName+\"' class='fImage eFolder' src='/IMG/emptyFolderE.png' data-folder='\"+fName+\"'  height='50' width='55'><br><label>\"+fName+\"</label></div>\");
                                   }else if(fSecure == 'yes'){
                                      alert('secure')
                                      $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+fName+\"' class='fImage sFolder' src='/IMG/emptyFolderS.png' data-folder='\"+fName+\"'  height='50' width='55'><br><label>\"+fName+\"</label></div>\");
                                   }else{
                                      alert('empty')
                                      $('#folderOptions').append(\"<div class='f' align='center' > <img id='\"+fName+\"' class='fImage' src='/IMG/emptyFolder.png' data-folder='\"+fName+\"'  height='50' width='55'><br><label>\"+fName+\"</label></div>\");
                                   } 
                                   $('#xlose').trigger('click');                                 
                                   return;
                               } 
                            },
                   async: false
              });
              
           }else{
              acceptFolder = 'no';
           }
             
        });
        //$('<input>').attr({type:'hidden',name:'destination',value:dest}).appendTo('#dropZone');
});";
echo "$(function(){";
echo "position = 0;";
for($i=0;$i<=36;$i++){
   echo "$('#d$i').mouseenter(function(){
            var pos = $( this ).offset();
            position = pos;
            var attr = $( this ).css('background-color');
            if (attr !== 'rgb(255, 255, 255)'){ 
               
            }
         });";
   echo "$('#d$i').mouseleave(function(){

         });";
}
echo "});";
echo "</SCRIPT>";
echo "</HEAD>";
$st = $db->prepare("Select mID from mResponse WHERE user = '$myusername' and forwarded = 1");
$st->execute();

echo "<DIV id='mainHeader' align='right' >";
if ($myusername == null){
  echo "<DIV id='mainHeader' align='right' style='min-height:4%;background-color:#000000;'>";
  echo "<img id='userStatus' src='/IMG/loggedOff.png' alt='loggedOff'  height='35' width='35'>";
  echo "</DIV>";
}else{
  echo "<DIV id='mainHeader' align='right' style='min-height:5.5%;background-color:#000000;'>";
  echo "<div style='display:inline-block;margin-right:65px;'><img id='userStatus' src='/IMG/userIcon.png' alt='loggedOn'  height='50', width='55'></div style='display:inline-block;'><br/><div><table bgcolor='#000000' style='border: 1px solid black;'><tr><td width='175px' align='center' height='15px' style='background-color:#000000;color:#FFFFFF;'> $myusername </td></tr><td id='logOut' align='center' width='120px' style='background-color:#000000;color:#000000;'><form name='logOut' action='logOut.php' method='POST' ><input type='submit' value='LogOut' style='width:50%;height:100%;background-color:#FFFFFF;color:#000000;'></form></td></tr></table></div></div>";
}

echo "</DIV>";
if (isSet($_GET['error'])){
  $errMess = $_GET['error'];    
  $user = $_GET['user'];
  if ($errMess == 'Employees must use a company regulated email address to register on Pick~N~Drop site'){
    $user = null;
  }
  if(!isSet($user)){
    $user = null;
  }
  echo "<TITLE>PickUp & DropOff LogOn </TITLE>";
  echo "<BODY>";
  echo "<DIV align='center' style='height:50%;width:98%;position:absolute'>";
  echo "<DIV align='center' style='height:35%;width:35%;margin-top:10cm'>";
  echo "<H2>To access the <i> PickUp & DropOff</i> you must logOn</H2>";
  echo "</DIV>";
  echo "<DIV align='center' style='height:35%;width:35%;position:'>";
  echo "There was a problem completing your request.  Please note the Errors below and reach out to us via the <a href='https://www.pick-n-drop.com/contact.php?note:".$errMess."' >Contact Page</a>.<br/>";
  echo "<span style='color:#FF0000;'>ERROR:  $errMess </span><br/>";
  echo "However, ".((isSet($user))? "you may still try to Log On using credentials you just created as $user or retry registrations process below.<br/>" :"you may retry registrations process below, but if registration code is no longer sufficient please <a href='https://www.pick-n-drop.com/contact.php?note:".$errMess."' >Contact Us</a>.<br/>"); 
  echo "<form name='entry' action='checklogin.php' method='POST'>";
  echo "<span id='username'>User Name</span><br/>";
  echo "<input type='text' size='25' name='myusernameis' ".((isSet($user))? $user : '')."/><br/>";
  echo "<span id='username'>Password</span><br/>";
  echo "<input type='password' size='25' name='mypasswordis' /><br/>";
  echo "<input type='submit' value='submit' name='enter' style='width:210px;background-color:#000000;color:#FFFFFF' /><br/>";
  echo "<input type='submit' value='Forgot Username or Password' name='lost' style='width:210px;background-color:#000000;color:#FFFFFF;' /><br/>";
  echo "<input type='submit' value='Register' name='reg' style='width:210px;background-color:#000000;color:#FFFFFF;' /></form>";
  echo "</DIV>";
  echo "</DIV>";
  die();
}

if ($myusername == null or isSet($_GET['wrongLogin'])){
  echo "<TITLE>PickUp & DropOff LogOn </TITLE>";
  if(isSet($_GET['wrongLogin'])){
    echo "<script> alert('Username or Password do not match'); </script>";
  }
  echo "<BODY>";
  echo "<DIV align='center' style='height:50%;width:98%;position:relative;'>";
  echo "<DIV align='center' style='height:35%;width:35%;margin-top:5cm'>";
  echo "<img id='siteLogo' src='/IMG/pick-n-drop.png' alt='Logo'  height='150', width='155'>";
  echo "<H2>To access the <i> PickUp & DropOff</i> you must logOn</H2>";
  echo "</DIV>";
  echo "<DIV align='center' style='height:35%;width:35%;'>";
  echo "<form name='entry' action='checklogin.php' method='POST'>";
  echo "<br/><br/><span id='username'>User Name</span><br/>";
  echo "<input type='text' size='25' name='myusernameis' /><br/>";
  echo "<span id='username'>Password</span><br/>";
  echo "<input type='password' size='25' name='mypasswordis' /><br/>";
  echo "<input type='submit' value='submit' name='enter' style='width:210px;background-color:#000000;color:#FFFFFF' /><br/>";
  echo "<input type='submit' value='Forgot Username or Password' name='lost' style='width:210px;background-color:#000000;color:#FFFFFF;' /><br/>";
  echo "<input type='submit' value='Register' name='reg' style='width:210px;background-color:#000000;color:#FFFFFF;' />";
  echo "</DIV>";
  echo "</DIV>";
}else{
  echo "<TITLE>PickUp & DropOff Welcome</TITLE>";
  echo "<BODY>";
  echo "<br/>";
  echo "<DIV id='bodyContainer' >";
  echo "<div style='margin-left:35%' ><SPAN id='folderSelect' class='switch' > FOLDERS </SPAN> <SPAN id='addFolder' class='add' > &#43; </SPAN> <input id='location' type='text' value='/' style='background-color:#000000;color:#FFFFFF;width:500px;display:none' READONLY/><input id='locationShow' type='text' value='/' style='background-color:#000000;color:#FFFFFF;width:500px;' READONLY/> <input id='backOne' type='button' value='&#171;' style='background-color:#000000;color:#FFFFFF' /> <input type='text' id='searchFolder' value='Search' style='width:44px;background-color:#000000;color:#FFFFFF;'> <input id='deleteObject' type='button' value='Delete Folder' style='background-color:#000000;color:#FFFFFF' disabled='disabled'/><input id='deleteAllFiles' class='deleteAll' title='Select all files' type='checkbox' name='\"+iTem+\"' style='display:none;'/></div>";
  echo "<DIV id='optionContainer' >";
  echo "<DIV id='userOptions' >";
  $uo = ['Create','Search','Manage','Request Access','Messages','Calendar'];

  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////   User Options (what users can do)
  /*
  date_default_timezone_set('UTC');
  $timeCode = date("Y-m-d H:i:sa");
  $timetokill = date("Y-m-d H:i:sa", strtotime('+3 Hours'.strtotime($timeCode)));
  $regStart = $myusername.'Jk'.$timeCode.'09n_';
  $regCode = rand(1111,9999).'AKOPL'.hash('sha384', $regStart);
  $windowsShit = "style=''";
  */
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////// Code for User Options
  echo "<DIV id='createUO' class='userOptions' ><SPAN class='btn'> Create </SPAN>";
  echo "<SPAN id='createOpt' class='closeX' style='display:none;' ><SPAN class='closeOpt' style='float:right;vertical-align:top;color:red;font-size:25px;' >x</SPAN><br/><br/><span class='gridWrap' ><span id='creatingCloud' class='button' ><u>Cloud Container</u></span><span id='creatingClient' class='button' ><u>Client</u></span><span id='creatingTeam' class='button' ><u>Team</u></span><span id='creatingDrops' class='button' ><u>Dropoffs</u></span></span></SPAN>";
  echo "<DIV id='cloudContainer' class='closeX' style='display:none;'>
           <form name='createCloud' action='cloudCreate.php' method='POST'>
              <label > Container Name </label><br/>
              <input type='text' name='countainerName' style='width:100%;background-color:#000000;color:#FFFFFF' /><br/>
              <label > In Folder </label><br/>";
  echo "      <input type='submit' name='containerCreate' value='Create' style='width:100%;background-color:#000000;color:#FFFFFF' />
           </form>
        </DIV>";
  echo "<DIV id='myClient' class='closeX' style='display:none;'>
           <form name='createClient' action='clientCreate.php' method='POST'>
              <label > User Name </label><br/>
              <input id='cCN' type='text' name='clientName' style='width:100%;background-color:#000000;color:#FFFFFF' /><br/>
              <label class='uE' style='display:none;'><span class='uEEra' style='display:none;'><img src='/IMG/oops!.png' alt='oops' height='30' width='30' /></span>User Email<span class='uEEra' style='display:none;'><img src='/IMG/oops!.png' alt='oops' height='30' width='30' /></span></label><br class='uE' style='display:none;'>
              <input id='cCE' class='uE' type='text' name='clientEmail' style='width:100%;background-color:#000000;color:#FFFFFF;display:none;' /><br class='uE' style='display:none;'>
              <label class='confirmcCE' style='display:none;'><span class='confirmEError' style='display:none;'><img src='/IMG/oops!.png' alt='your bad' height='30' width='30' /></span> Confirm Email <span class='confirmEError' style='display:none;'><img src='/IMG/oops!.png' alt='your bad' height='30' width='30' /></span></label><br class='confirmcCE' style='display:none;'>
              <input id='confirmcCE' class='confirmcCE' type='text' name='confirmClientEmail' style='width:100%;background-color:#000000;color:#FFFFFF;display:none;' /><br class='confirmcCE' style='display:none;'>
              <label > Registration Identification Number </label><br/>
              <input id='cRN' type='text' name='clientRegID' style='width:100%;background-color:#000000;color:#FFFFFF' value='$regCode' READONLY/><br/>
              <input id='sCC' type='button' name='clientCreate' value='Create' style='width:100%;background-color:#000000;color:#FFFFFF' DISABLED />
           </form>
        </DIV>";
  echo "<DIV id='myPickups' class='closeX' style='display:none;'>
          <form action='createTemp.php' method='POST' enctype='multipart/form-data'>
             <label ><b>Create A Team:</b></label><br/>
             <input id='createTeam' name='team' type='text' style='width:98%;background-color:#000000;color:#FFFFFF' />
              <span id='copyUserz' ><br>&uarr; Select a user above to add them to <label class='teamName'> </label>team. &uarr;</span><br><span id='teamUsers'>&darr; Below are users who are attached to <label class='teamName'>your team</label>team. &darr;</span>
             <div id='continuePU' align='center' style='display:none;'><label ><b>&darr; Please fill out all information below &darr;</b></label><br/> <span align='center' style='width:50%><label ><b>Created For</b></label></span><span align='center' style='width:50%><label ><b>Number of downloads:</b></label></span><br/>
             <input id='pickupFor1' type='text' style='width:50%;background-color:#000000;color:#FFFFFF' /><input id='pickupFor2' type='text' style='width:50%;background-color:#000000;color:#FFFFFF' /><br/>
             <input id='pickupFor3' type='file' style='width:99%;background-color:#000000;color:#FFFFFF' /></div>    
             <input id='sendPickup' type='button' value='' style='width:100%;background-color:#000000;color:#FFFFFF;display:none;'/><br/>
          </form>
        </DIV>";
  echo "<DIV id='myDrops' class='closeX' style='display:none;'>
          <form action='createTemp.php' method='POST' enctype='multipart/form-data'>
             <label ><b>Create Drop location:</b></label><br/>
             <input id='createDrops' name='drop' type='text' style='width:100%;background-color:#000000;color:#FFFFFF' /><br/>
             <div id='continueD' align='center' style='display:none;'><label ><b>&darr; Please fill out all information below &darr;</b></label><br/> <span align='center' style='width:50%><label ><b>Created For</b></label></span><span align='center' style='width:50%><label ><b>Maximum Size</b></label></span><br/>
             <input id='dropFor' type='text' style='width:50%;background-color:#000000;color:#FFFFFF' /><input id='dropSize' type='text' style='width:50%;background-color:#000000;color:#FFFFFF' /></div>    
             <input id='sendDrop' type='submit' value='Create' style='width:100%;background-color:#000000;color:#FFFFFF' DISABLED /><br/>
          </form>
        </DIV>";
  echo "</DIV>";
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  Searching user options
  echo "<br><DIV id='searchUO' class='userOptions' ><SPAN class='btn'> Search &#38; Request </SPAN>" ;
  echo "<SPAN id='searchOpt' class='closeX' style='display:none;' ><SPAN class='closeOpt' style='float:right;vertical-align:top;color:red;font-size:25px;' >x</SPAN><br/><br/><DIV class='gridWrap' ><SPAN id='cloudSearch' class='button'><u>Cloud Containers</u></SPAN> <SPAN id='userSearch' class='button'><u>Users</u></SPAN><SPAN id='clientSearch' class='button'><u>My Clients</u></SPAN></DIV></SPAN>";
  echo "<DIV id='containerSearch' class='closeX' style='display:none;'>
          <label ><b>Type to search:</b></label><br/>
          <input id='ccSearch' type='text' style='width:100%;background-color:#000000;color:#FFFFFF' /><br/>
          <div id='ccResults'></div>
          <label ><b>Scroll to search:</b></label><br/>
          <select id='ccScroll'><option value='null'>Select a Container</option>";
  $st = $db->prepare("SELECT * FROM containerz");
  $st->execute();
  $results = $st->fetchALL();
  foreach($results as $c){
    echo "<option value='".$c['name']."'>".$c['name']."</option>";
  }
  echo "</select><br/><div id='containerzResults'></div></DIV>";
  echo "<DIV id='userSearches' class='closeX' style='display:none;'>
          <label ><b>Type to search:</b></label><br/> 
          <input id='cSearch' type='text' style='width:100%;background-color:#000000;color:#FFFFFF' /><br/>  
          <div id='cResults'></div>
          <label ><b>Scroll to search:</b></label><br/>
          <select id='uScroll'><option value='null'>Select a User</option>";   
  $st = $db->prepare("SELECT uzrName, uzrEmail FROM uzerz");
  $st->execute();
  $results = $st->fetchALL();
  foreach($results as $c){
    if ($c['uzrName'] == ''){
      continue;
    }
    //$edit = 
      echo "<option value='".str_replace('.', '-', str_replace('@', '_', $c['uzrEmail']))."'>".$c['uzrName']." &hArr; ".$c['uzrEmail']."</option>";
  }
  echo "</select><br/><div id='usersResults'></div></DIV>";
  echo "<DIV id='clientSearches' class='closeX' style='display:none;'>
          <label ><b>Type to search:</b></label><br/> 
          <input id='uSearch' type='text' style='width:100%;background-color:#000000;color:#FFFFFF' /><br/>  
          <div id='cResults'></div>
          <label ><b>Scroll to search:</b></label><br/>
          <select id='cScroll'><option value='null'>Select a Client</option>";   
  $table = str_replace('@','_', $myemail);
  $table = str_replace('.com','', $table);
  $st = $db->prepare("Select uzerz.id, uzerz.uzrName, $table.firstname, $table.lastname, uzerz.dateCreated FROM uzerz INNER JOIN $table ON uzerz.uzrEmail = $table.uzrEmail");
  $st->execute();
  $results = $st->fetchALL();
  foreach($results as $c){
    if ($c['id'] == ''){
      continue;
    }
    echo "<option value='".$c['uzrName']."'>".$c['uzrName']." &hArr; ".$c['dateCreated']."</option>";
  }
  echo "</select><br/><div id='usersResults'></div></DIV>";
  echo "</DIV>";
  ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  Managing user options 
  echo "<br><DIV id='manageUO' class='userOptions' ><SPAN class='btn'>Manage</SPAN>";
  echo "<SPAN id='manageOpt' class='closeX' style='display:none;' ><SPAN class='closeOpt' style='float:right;vertical-align:top;color:red;font-size:25px;' >x</SPAN><br/><br/><DIV class='gridWrap' ><SPAN id='manContainer' class='button' ><u>Cloud Containers</u></SPAN><SPAN id='manClients' class='button' ><u>Clients</u></SPAN><SPAN id='manPickups' class='button' ><u>Pickups</u></SPAN><SPAN id='manDrops' class='button' ><u>Dropoffs</u></SPAN></DIV></SPAN>";
  echo "<DIV id='containerMan' class='closeX' style='display:none;'>
          <label ><b>My Containers:</b></label><br/>
          <select id='myContainers'><option value='null'>Select a Container</option>";
  $st = $db->prepare("SELECT name FROM containerz WHERE createdBy='$myusername'");
  $st->execute();
  $results = $st->fetchALL();
  foreach($results as $c){
    echo "<option value='".$c['name']."'>".$c['name']."</option>";
  }
  echo "</select><br/><div id='myContainerResults'></div></DIV>";
  echo "<DIV id='clientsMan' class='closeX' style='display:none;'>
          <label ><b>My Clients:</b></label><br/>
          <select id='myClientMan'><option value='null'>Select a Client</option>";
  //$st = $db->prepare("SELECT uzrName FROM uzerz WHERE uzerz.uzrEmail = $table.uzrEmail");
  $st = $db->prepare("SELECT uzrName FROM $table");
  $st->execute();
  $results = $st->fetchALL();
  foreach($results as $c){
    echo "<option value='".$c['uzrName']."'>".$c['uzrName']."</option>";
  }
  echo "</select><br/><div id='myClientsResults'></div></DIV>";
  echo "<DIV id='pickupsMan' class='closeX' style='display:none;'>
          <label ><b>Manage Pickup locations:</b></label><br/>
          <select id='myPickups'><option value='null'>Select a Pickup</option>";
  $st = $db->prepare("SELECT name, createdFor FROM pickups WHERE createdBy = '$myusername'");
  $st->execute();
  $results = $st->fetchALL();
  foreach($results as $c){
    echo "<option value='".$c['name']."'>".$c['createdFor']." &hArr; ".$c['name']."</option>";
  }
  echo "</select><br/><div id='myPickupsResults'></div></DIV>";
  echo "<DIV id='dropsMan' class='closeX' style='display:none;'>
          <label ><b>Manage Drop locations:</b></label><br/>
          <select id='myDrops'><option value='null'>Select a DropOff</option>";
  $st = $db->prepare("SELECT name, createdFor FROM drops WHERE createdBy = '$myusername'");
  $st->execute();
  $results = $st->fetchALL();
  foreach($results as $c){
    echo "<option value='".$c['name']."'>".$c['createdFor']." &hArr; ".$c['name']."</option>";
  }
  echo "</select><br/><div id='myPickupsResults'></div></DIV>";
  echo "</DIV>";
  /*
  echo "<DIV id='requestUO' class='userOptions' >Request Access";
  echo "<SPAN id='requestOpt' class='closeX' style='display:none;' ><br/><u>Access File</u> <u>Access Folder</u> <u>Request File</u> <u>Request Folder</u> </SPAN></DIV>";
  */
  echo "<br><DIV id='messagesUO' class='userOptions' ><SPAN class='btn'>Messages</SPAN>";  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////  MESSAGES
  echo "<SPAN id='messagesOpt' class='closeX' style='display:none;' ><SPAN id='eX' class='closeOpt' style='float:right;vertical-align:top;color:red;font-size:25px;' >x</SPAN><br/><br/><DIV class='gridWrap' ><SPAN id='newM'  class='button'><u>New</u></SPAN><SPAN id='sentMessages' class='button'><u>Sent</u></SPAN><SPAN id='inboxMessages' class='button' style='display:none;'><u>Inbox</u></SPAN><SPAN id='deleteM' class='button' ><u>Delete</u></SPAN><SPAN id='expandM' class='button'><u>Expand</u></SPAN><SPAN id='collapseM' class='button' style='display:none;'><u>Collapse</u></SPAN></DIV></SPAN>";

include 'sentM.php';
echo "<span id='inboxHere'>";
include 'inboxM.php';
echo "</span>";

  echo "<br></DIV>";
  echo "<div id='sentBody' style='height:40%;display:none;background-color:#000000;color:#FFFFFF'>
       <div>
       <div class='sendDetails' style='width:5%;float:left;font-size:16pt;'>
       &nbsp;<strong>From:</strong><br>
       &nbsp;<strong id='selectTo'>To:</strong><select id='addClient' style='display:none'><option value='Select'>Clients</option>";
  $client = ['a','b','c','d','e','ef'];
  foreach ($client as $option){
    echo "<option value='$option'>$option</option>";
  }

  echo "</select><br>";
  echo "<script>
        getFileSize = null;
        function phpBytes(bytes){
           $.ajax({
                   url: 'convertBytes.php',
                   type:  'POST',
                   data:  (getFileSize == 1) ? {'getSize':bytes,'user':myusername,'box':messageBox} : {'bytes':bytes}, 
                   success: function(response){
                               if (getFileSize == true){
                                  //alert(response)
                                  var currentSize = $('#totalSize').html(); 
                                  var addIt = +currentSize + +response;
                                  //alert('this is added together= '+addIt);                                
                                  $('#totalSize').html(addIt);
                                  var nowSize = $('#totalSize').html();
                                  getFileSize = null;
                                  phpBytes(+nowSize);
                               }else{
                                  $('#attSize').html( response );
                               }                               
                   },
                   async: false
           });

        }
        var add = 0;
        Dropzone.options.dropZone = {
                                     paramName: 'file', 
                                     addRemoveLinks: true,
                                     //maxFiles: 1,  // How many files
                                     maxFilesize: 30, // MB
                                     dictFileSizeUnits: 'mb',
                                     dictDefaultMessage: 'Drag a file in here to upload, or click to select a file to upload',
                                     init: function(){
                                              this.on('removedfile', function(file){
                                                    var r = file.name; 
                                                    alert(r)                                                  
                                                    var remove = r.replace(/[^a-zA-Z0-9]/g,'');
                                                    $('#'+remove).remove();
                                                    $('#'+remove+'_Icon').remove();
                                                    currentSize = $('#totalSize').html();
                                                    var minus = +currentSize - +file.size;
                                                    if(minus == 0){
                                                       $('#totalSize').html(minus);
                                                       $('#attSize').html('');                                                                                                       
                                                    }else{
                                                       phpBytes(minus);
                                                       $('#totalSize').html(minus);                                                                                                       
                                                    }
                                                    attCount--;
                                                    alert(attCount) 
                                                    var index = attArray.indexOf(file.name);
                                                    attArray.splice(index, 1);
                                              });
                                              this.on('success', function(file){
                                                    $('.dz-progress').hide();  
                                                    var c = file.name;
                                                    var cName = c.replace(/[^a-zA-Z0-9]/g,'');        
                                                    $('#placeAtt').append('<img id=\"'+cName+'_Icon\" class=\"sendAtt\" src=\"/IMG/addAtt.png\" alt=\"attachment'+add+'\" height=\"15\", width=\"15\"><input id=\"'+cName+'\" class=\"sendAtt\" type=\"text\" value=\"'+file.name+'\" name=\"attachmentAdd\" style=\"width:auto;background-color:#000000;color:#FFFFFF\" READONLY/>');
                                                    attCount++;
                                                    alert(attCount);
                                                    add = add + 1;
                                                    currentSize = $('#totalSize').html();
                                                    if (currentSize == ''){
                                                       var byte = file.size;
                                                    }else{
                                                       var byte = +file.size + +currentSize;
                                                    }
                                                    phpBytes(byte);
                                                    $('#totalSize').html(byte);
                                                    attArray.push(file.name);
                                                    //if( byte > '15000000'){
                                                    //   $('#attSize').css('color':'yellow');
                                                    //}
                                              });
                                           }
                                     };
       </script>";
  echo "&nbsp;<strong>Subject:</strong><br>
       &nbsp;<strong id='selectAtt'>Attachment:</strong><br>
       <input id='sendMessage' type='button' value='Send' style='width:85px;height:145px;background-color:#000000;color:#FFFFFF' />
       </div>
       <div class='detailsSend' style='width:90%;float:left;'> 
       <input type='text' id='sendFrom' name='from' value='$m' style='width:310px;background-color:#000000;color:#FFFFFF' size='150' READONLY><br>
       <input type='text' id='sendTo' name='to' style='width:100%;background-color:#000000;color:#FFFFFF' size='150'><br>
       <input type='text' id='sendSubject' name='subject' style='width:100%;background-color:#000000;color:#FFFFFF' size='150'><br style='line-height: 10px' /> &nbsp; &nbsp; &nbsp; &nbsp;
       <span id='placeAtt' style='height:15px'></span>&nbsp;&nbsp;<span id='attSize' class='size' style='height:15px;color:#82E0AA'></span><span id='totalSize' class='size' style='height:15px;display:none'></span>
       <div style='color:#000000;'><form action='holdAtt.php' method='POST' class='dropzone' id='dropZone'></form></div><br>
       </div>
       <div style='width:5%;float:left;'>
       <SPAN class='closeSend' style='float:right;vertical-align:top;color:#FFFFFF;font-size:30px;margin-right:30px;' >x</SPAN>
       </div>
       </div><br>
       <div style='clear:both;background-color:#000000;color:#FFFFFF;'><pre><textarea id='sendBody' rows='20' cols='260' class='mBody' ></textarea></pre></div></div>";

  echo "<div id='myModal' class='modal' style='display:none;'><br></div>";
  echo "<div id='sendModal' class='modal' style='display:none;'><br></div>";
  echo "<div id='calendarModal' class='modal' style='display:none;'><br></div>";
  echo "<DIV id='calendarUO' class='userOptions' ><br><SPAN class='btn'>Calendar</SPAN>"; //////////////////////////////////////////////////////////////////////////////////////////////////////////
  echo "<SPAN id='calendarOpt' class='closeX' style='display:none;' ><SPAN id='calendar-eX' class='closeOpt' style='float:right;vertical-align:top;color:red;font-size:25px;' >x</SPAN><br/><br/><span class='gridWrap' ><span id='calHistory' class='button' ><u>History</u></SPAN><SPAN id='calDeadlines' class='button' ><u>Deadlines</u></SPAN><SPAN id='calShare' class='button' ><u>Share</u></SPAN><SPAN id='expandCalendar' class='button' ><u>Expand</u></SPAN><SPAN id='collapseCalendar' class='button' style='display:none'><u>Collapse</u></SPAN></SPAN></SPAN>";
  echo "<div id='historyOptions' class='closeX hide' style='display:none;'><div id='historyStyleView' style='display:inline-block;display:none;' title='Select view style'><img id='barGraph' class='imgButton' src='/IMG/barGraph.png' alt='bar graph' height='35px' width='35px'><img id='lineGraph' class='imgButton' src='/IMG/lineGraph.png' alt='line graph view' height='35px' width='35px'><img id='pieGraph' class='imgButton' src='/IMG/pieGraph.png' alt='pie chart' height='35px' width='35px'><br/><input type='radio' name='styleRadio' value='Bar' title='select Bar Graph' checked='checked'/>&nbsp;&nbsp;&nbsp;<input type='radio' name='styleRadio' value='Line' title='select Line Graph' />&nbsp;&nbsp;&nbsp;<input type='radio' name='styleRadio' value='Pie' title='select Pie Graph'/></div><div id='clientHistory' class='buttonBlock' style='display:inline-block;margin-left:5px;'><img id='cHistory' class='imgButton' src='/IMG/clients.png' alt='Client History' height='35px' width='35px' ><br><label>Clients</label></div><div id='transferHistory' class='buttonBlock' style='display:inline-block;margin-left:5px;'><img id='tHistory' class='imgButton' src='/IMG/downUp.png' alt='Upload Download History' height='35px' width='35px'><br><label>Transfers</label></div><div id='eventHistory' class='buttonBlock' style='display:inline-block;margin-left:5px;background-color:#00bfff;color:#ffff00'><img id='eHistory' class='imgButton' src='/IMG/events.png' alt='Event History' height='35px' width='35px'><br><label>Events</label></div>";
  echo "</div>";
  echo "<div id='deadlineOptions' class='closeX hide' style='display:none;'><label id='disDeadline'>&darr; Deadline Name &darr;</label><br><input id='deadlineAdd' type='text' style='width:98%;background-color:#000000;color:#FFFFFF'/><br><label><u>Add to this Deadline</u></label><br><span id='copyClients'> </span><br><label><b>Date:</b></label><input type='text' id='datepick' disabled='disabled' /><label><b>Time:</b></label><input type='text' id='timepick' disabled='disabled' /><div id='submitDeadline' style='display:none'><input type='submit' value='Submit' style='width:50%;background-color:#000000;color:#FFFFFF' /><br><input type='Submit' value='Reset' style='width:50%;background-color:#000000;color:#FFFFFF' /></div></div>";
  echo "<div id='calShareOptions' class='closeX hide' style='display:none;'> <span id='copyUsers' ><br>&uarr; Select a user above to add them to your calendar. &uarr;</span><br><span id='sharedUsers'>&darr; Below are users who are able to view your calendar. &darr;</span></div>";

  echo "<br><div id='calendar' class='closeX' style='height:475;display:none;'>";
  echo "<input id='calendarY' type='text' value='$yR' style='width:99%;background-color:#000000;color:#FFFFFF;text-align:center;' READONLY><br>";
  echo "<input id='previousM' class='calendarMove' type='button' value='<<<' style='width:7%;background-color:#000000;color:#FFFFFF;text-align:center;' READONLY><input id='calendarM' type='text' value='$month' style='width:85%;background-color:#000000;color:#FFFFFF;text-align:center;' READONLY><input id='nextM' class='calendarMove' type='button' value='>>>' style='width:7%;background-color:#000000;color:#FFFFFF;text-align:center;' READONLY><br>";
  //echo "<div id='daysOfWeek' class='week'></div>";
  echo "<div id='calStart' class='week' ><SPAN id='Sunday'>Sunday</SPAN><SPAN id='Monday'>Monday</SPAN><SPAN id='tuesday'>Tuesday</SPAN><SPAN id='Wednesday'>Wednesday</SPAN><SPAN id='Thursday'>Thursday</SPAN><SPAN id='Friday'>Friday</SPAN><SPAN id='Saturday'>Saturday</SPAN>
<SPAN id='d0' class='day'><SPAN id='0' class='info'></SPAN> </SPAN><SPAN id='d1' class='day'><SPAN id='1' class='info'></SPAN> </SPAN><SPAN id='d2' class='day'><SPAN id='2' class='info'></SPAN> </SPAN><SPAN id='d3' class='day'><SPAN id='3' class='info'></SPAN> </SPAN><SPAN id='d4' class='day'><SPAN id='4' class='info'></SPAN> </SPAN><SPAN id='d5' class='day'><SPAN id='5' class='info'></SPAN> </SPAN><SPAN id='d6' class='day'><SPAN id='6' class='info'></SPAN> </SPAN>
<SPAN id='d7' class='day'><SPAN id='7' class='info'></SPAN> </SPAN><SPAN id='d8' class='day'><SPAN id='8' class='info'></SPAN> </SPAN><SPAN id='d9' class='day'><SPAN id='9' class='info'></SPAN> </SPAN><SPAN id='d10' class='day'><SPAN id='10' class='info'></SPAN> </SPAN><SPAN id='d11' class='day'><SPAN id='11' class='info'></SPAN> </SPAN><SPAN id='d12' class='day'><SPAN id='12' class='info'></SPAN> </SPAN><SPAN id='d13' class='day'><SPAN id='13' class='info'></SPAN> </SPAN>
<SPAN id='d14' class='day'><SPAN id='14' class='info'></SPAN> </SPAN><SPAN id='d15' class='day'><SPAN id='15' class='info'></SPAN> </SPAN><SPAN id='d16' class='day'><SPAN id='16' class='info'></SPAN> </SPAN><SPAN id='d17' class='day'><SPAN id='17' class='info'></SPAN> </SPAN><SPAN id='d18' class='day'><SPAN id='18' class='info'></SPAN> </SPAN><SPAN id='d19' class='day'><SPAN id='19' class='info'></SPAN> </SPAN><SPAN id='d20' class='day'><SPAN id='20' class='info'></SPAN> </SPAN>
<SPAN id='d21' class='day'><SPAN id='21' class='info'></SPAN> </SPAN><SPAN id='d22' class='day'><SPAN id='22' class='info'></SPAN> </SPAN><SPAN id='d23' class='day'><SPAN id='23' class='info'></SPAN> </SPAN><SPAN id='d24' class='day'><SPAN id='24' class='info'></SPAN> </SPAN><SPAN id='d25' class='day'><SPAN id='25' class='info'></SPAN> </SPAN><SPAN id='d26' class='day'><SPAN id='26' class='info'></SPAN> </SPAN><SPAN id='d27' class='day'><SPAN id='27' class='info'></SPAN> </SPAN>
<SPAN id='d28' class='day'><SPAN id='28' class='info'></SPAN> </SPAN><SPAN id='d29' class='day'><SPAN id='29' class='info'></SPAN> </SPAN><SPAN id='d30' class='day'><SPAN id='30' class='info'></SPAN> </SPAN><SPAN id='d31' class='day'><SPAN id='31' class='info'></SPAN> </SPAN><SPAN id='d32' class='day'><SPAN id='32' class='info'></SPAN> </SPAN><SPAN id='d33' class='day'><SPAN id='33' class='info'></SPAN> </SPAN><SPAN id='d34' class='day'><SPAN id='34' class='info'></SPAN> </SPAN>
</div><div class='moreWeek' style='margin-left:9px;'><SPAN id='d35' class='day' style='display:inline-block;float:left;margin-top:2px;font-size:75%;'><SPAN id='35' class='info'></SPAN> </SPAN><SPAN id='d36' class='day' style='display:inline-block;float:left;margin-top:2px;margin-left:2px;font-size:75%;'><SPAN id='36' class='info'></SPAN> </SPAN><SPAN id='calPreview' style='width:442px;height:85px;display:inline-block;float:left;text-align:left;border:1px solid black;margin-top:2px;margin-left:2px;overflow:auto;' >Preview Here just testing how long this span is so to see if need to add more length!</SPAN></div><br>";
  //echo "<div id='reminder' style='display:inline-block;' > &nbsp; by Kevy </div>";
  echo "</div>";
  echo "</DIV>";
  echo "<br/>";
 
  //echo "Hello";
  echo "</DIV>";
  
  echo "</DIV>";

  echo "<DIV id='folderOptions' >";
  
  echo "</DIV>";
    echo "<script>        
        Dropzone.options.fileDropZone = {        
           paramName: 'file',
           timeout: 1800000,  // = 30 mins
           maxFilesize: 9000, // MB
           addRemoveLinks: true,
           dictDefaultMessage: 'Drag files in here to upload, or click to select a file to upload',
           init: function() {
                        var dest = $('#folderLocation').val();
                        this.on('success', function(file){
                              var dest = $('#folderLocation').val();
                              if (dest == '/'){
                                 alert('Files can not be placed in root directory')
                                 this.removeFile(file);
                                 exit();
                              }
                              var fName = file.name;
                              var fIndex = fName.lastIndexOf('.');
                              var lIndex = fName.length;
                              var ext = fName.substring(fIndex, lIndex);
                              var iD = fName.replace('.','');
                              iD = iD.replace(/\s/g,'');
                              ext = ext.replace('.','');
                              ext = ext.toLowerCase();
                              if (changeOnce !== 0){
                                 $('#folderOptions').append(\"<div id='file_\"+iD+\"' class='file' align='center' ><a id='dblClickdownload' name='\"+fName+\"' href='/folderz/kevinr/dir\"+dest+fName+\"' download> <img id='\"+fName+\"' class='fileImage' src='/IMG/fileIcons/\"+ext+\".png' data-file='\"+fName+\"'  height='50' width='55'></a><input id='Del_\"+fName+\"' class='deleteFile' type='checkbox' name='\"+fName+\"' style=';'/><br><label>\"+fName+\"</label></div>\");    
                             }
                        });
                        this.on('sending', function(file, xhr, formData){
                              var dest = $('#folderLocation').val();                             
                              formData.append('destination',dest);
                              formData.append('user',myusername);
                        });
                        this.on('removedfile', function(file){
                              var dest = $('#folderLocation').val();
                              var fname = file.name;
                              $.ajax({
                                      type: 'POST',
                                      url:  'fcalls.php',
                                      data: {'deleteFile':fname,'dir':myusername,'destination':dest},
                                      success: function(response){
                                             var iD = fname.replace('.','');
                                             iD = iD.replace(/\s/g,'');
                                             $('#file_'+iD).empty();
                                             function waitItOut(){
                                                $('#file_'+iD).remove();
                                             }
                                             if(response == 'Deleted'){   
                                                $('#file_'+iD).append('<img id=\"justDeleted\" class=\"fileImage\" src=\"/IMG/poof.gif\" data-file=\"removedImage\" height=\"50\" width=\"55\">');
                                                setTimeout(waitItOut, 2400);
                                             }
                                      }
                              });
 
                        });                              
                           
           }  
        };</script>";
 
  echo "<div id='addingFolder' style='width:700px;display:none;'>";
  echo "<div id='folder' align='center' style='width:500px;display:inline-block;float:left' >";
  echo "<Label > Location </Label><br>";
  echo "<input id='folderLocation' type='text' style='background-color:#000000;color:#FFFFFF;width:490px;display:none;' READONLY/><input id='folderLocationShow' type='text' style='background-color:#000000;color:#FFFFFF;width:490px;' READONLY/><br>";
  echo "<img id='folders' src='/IMG/emptyFolder.png' alt='Folders & Files' height='75', width='75'><br>";
  echo "<Label > Name Folder </Label><br>";
  echo "<input id='folderName' type='text' style='background-color:#000000;color:#FFFFFF;width:200px;' /><br>";
  echo "<SPAN class='sCode' style='display:none'><Label> Enter Secure Code  </Label><br>";
  echo "<input id='secureCode' type='password' value='' style='background-color:#000000;color:#FFFFFF;width:200px;' /><br></SPAN>";
  echo "<SPAN class='cCode' style='display:none' name='0'><Label> Confirm Secure Code  </Label><br>";
  echo "<input id='confirmCode' type='password' value='' style='background-color:#000000;color:#FFFFFF;width:200px;' /><br></SPAN>";
  echo "<SPAN class='exp' style='display:none'><Label> Enter Expiration date  </Label><br>";
  echo "<input id='expiresV' type='date' style='background-color:#000000;color:#FFFFFF;width:200px;' /><br></SPAN>";
  echo "<form action='fcalls.php' class='dropzone dropScroll' id='fileDropZone' method='POST' ></form>";
  echo "</div>";
  echo "<div id='features' align='center' style='width:180px;display:inline-block;float:left;text-align:center;'>";
  echo "<div id='featuresOptions'>";
  echo "<button id='shareFolder' class='addFeatures' name='0' ><img id='shareThis' src='/IMG/share.png' alt='share this folder' height='25', width='25'><br>";
  echo "<Label > &nbsp;&nbsp;SHARE&nbsp;&nbsp; </Label></button><br><br>";
  echo "<button id='secureFolder' class='addFeatures' name='0' ><img id='secureThis' src='/IMG/Locked.png' alt='secure this folder' height='25', width='25'><br>";
  echo "<Label > SECURE </Label></button><br><br>";
  echo "<button id='expireFolder' class='addFeatures' name='0'><img id='deleteThis' src='/IMG/time2trash.png' alt='delete this folder' height='30', width='30'><br>";
  echo "<Label > EXPIRES </Label></button><br><br>";
  echo "</div>";
  echo "<button id='submitFolder' class='addFeatures' name='0' style='background-color:#000000;color:#FFFFFF;'><img id='createThis' src='/IMG/addFolder.png' alt='Create this folder' height='30', width='30'><br>";
  echo "<Label id='resubmit'> &nbsp;&nbsp;SUBMIT&nbsp;&nbsp; </Label></button>";
  echo "</div>";
  echo "<div id='xlose' style='width:19px;float:left;font-size:16pt;color:red;' > X </div>";
  echo "</div>";
  echo "<div id='myFolderModal' class='modal' style='display:none;'></div>";




  echo "</DIV>";
}
echo "<script>";
$fo = ['Folders','Create','Search','Manage','Archive','Favorites'];
$st = $db->prepare("Select mID from mResponse Where forwarded = 1");
$st->execute();
$result = $st->fetchALL(PDO::FETCH_COLUMN, 0);
foreach ($result as $eForward){
  echo "var change = $('img.mFwd[alt=\"$eForward\"]');
        change.attr('src','/IMG/forwarded.png');";
}
$st = $db->prepare("Select mID from mResponse Where replied = 1");
$st->execute();
$result = $st->fetchALL(PDO::FETCH_COLUMN, 0);
foreach ($result as $eReply){
  echo "var change = $('img.mRply[alt=\"$eReply\"]');
        change.attr('src','/IMG/replied.png');";
}
echo "</script>";
echo "</BODY>";
echo "</HTML>";
?>