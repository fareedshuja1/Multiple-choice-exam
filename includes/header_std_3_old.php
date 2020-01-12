<?php 
include("config.php");
if (!$_SESSION['student_id']) { redirect_to("slogin.php"); }

$id = $_GET['id'];
$sid = $_SESSION['student_id'] ;

$query = mysql_query("SELECT em.`em_id`,DATE_FORMAT(em.`e_start_time`,'%h:%i %p') AS e_start_time
,DATE_FORMAT(em.`e_end_time`,'%h:%i %p') AS e_end_time,em.`total_ques`,em.`tot_minutes`
,(SELECT COUNT(1) AS rem_q 
FROM `question_paper` AS qp 
WHERE qp.`student_id`='$sid'
AND qp.`em_id`=em.`em_id`
AND qp.`std_status` IS NULL) AS unsloved
,(SELECT qp1.`rem_minutes`
FROM `question_paper` AS qp1 
WHERE qp1.`student_id`='$sid'
AND qp1.`em_id`=em.`em_id`
AND qp1.`rem_minutes` IS NOT NULL
ORDER BY qp1.`std_qno` DESC
LIMIT 1) AS rem_timing
,(SELECT qp1.`std_qno`
FROM `question_paper` AS qp1 
WHERE qp1.`student_id`='$sid'
AND qp1.`em_id`=em.`em_id`
AND qp1.`rem_minutes` IS NOT NULL
ORDER BY qp1.`std_qno` DESC
LIMIT 1) AS last_ques
FROM `exam_master` AS em
WHERE em.`em_id`=$id") or die(mysql_error());
$rslt = mysql_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>:: Online Exam System ::</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <!--<link href="css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />-->

  </head>

  <body>

  <section id="container" class="">
      
      <header class="header white-bg">
          <div class="sidebar-toggle-box">

          </div>
          <!--logo start-->
        <a href="#" class="logo"><img src="logo.jpg" width="70px" height="60px"><span></span></a>
        
         
        
        <form action="" method="post" id="remt"  style="display:none">
        <table border="0" style="margin-top: 20px;" align="center" cellpadding="10" id="remt">
        <tr>
        <td>
        <?php
		if($rslt['rem_timing'] == '' || $rslt['rem_timing'] == NULL) {
		
		echo "<input type='hidden' class='form-control' style='width: 100px' id='mns' readonly value='$rslt[tot_minutes]' />"; 
		} else {
		echo "<input type='hidden' class='form-control' style='width: 100px' id='mns' readonly value='$rslt[rem_timing]' />"; 
		}
		?>
        </td>
 
        <td valign="top">
        <label for="exampleInputEmail1">Remaining Minutes:</label><br>
        <input type="hidden" id="scs" name="scs" value="0"/>
       <span id="showmns" style="font-size:20px; color:#F00">00</span> : <span id="showscs" style="font-size:20px; color:#F00">00</span>  
        </td>
        
        </tr>
        </table></form>
                
      </header>
      
      
              
<script type="text/javascript">


var ctmnts = 0;
var ctsecs = 0;
var startchr = 0;      

function countdownTimer() {
	
	$("#ques_paper").show();
	$("#remt").show();
	$("#welcome").hide();
	
	

  if(startchr == 0 && document.getElementById('mns') && document.getElementById('scs')) {
    // makes sure the script uses integer numbers
    ctmnts = parseInt(document.getElementById('mns').value) + 0;
    ctsecs = parseInt(document.getElementById('scs').value) * 1;

    if(isNaN(ctmnts)) ctmnts = 0;
    if(isNaN(ctsecs)) ctsecs = 0;

    document.getElementById('mns').value = ctmnts;
    document.getElementById('scs').value = ctsecs;
    startchr = 1;
    document.getElementById('btnct').setAttribute('disabled', 'disabled');     // disable the button
  }

  if(ctmnts==0 && ctsecs==0) {
    startchr = 0;
    document.getElementById('btnct').removeAttribute('disabled');     // remove "disabled" to enable the button

    return false;
  }
  else {
    ctsecs--;
    if(ctsecs < 0) {
      if(ctmnts > 0) {
        ctsecs = 59;
        ctmnts--;
      }
      else {
        ctsecs = 0;
        ctmnts = 0;
      }
    }
  }

  // display the time in page, and auto-calls this function after 1 seccond
  document.getElementById('showmns').innerHTML = ctmnts;
  document.getElementById('showscs').innerHTML = ctsecs;
  setTimeout('countdownTimer()', 1000);
}
//-->
</script>
