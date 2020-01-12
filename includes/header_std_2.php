<?php 
include("config.php");
if (!$_SESSION['student_id']) { redirect_to("login.php"); }

$id = $_GET['id'];
$sid = $_SESSION['student_id'];
$sname = $_SESSION['student_name'];

$query = mysql_query("SELECT em.`em_id`,DATE_FORMAT(em.`e_start_time`,'%h:%i %p') AS e_start_time
,DATE_FORMAT(em.`e_end_time`,'%h:%i %p') AS e_end_time,em.`total_ques`,em.`tot_minutes`, em.`pass_per`
,(SELECT COUNT(1) AS rem_q 
FROM `question_paper` AS qp 
WHERE qp.`student_id`='$sid'
AND qp.`em_id`=em.`em_id`
AND qp.`std_status` IS NULL) AS unsloved
 ,(SELECT MIN(qp.`rem_minutes`)
FROM `question_paper` AS qp
WHERE qp.em_id=em.`em_id`
AND qp.student_id='$sid') AS rem_timing
,(SELECT qp1.`rem_sec`
FROM `question_paper` AS qp1 WHERE qp1.`rem_minutes` IN
(SELECT MIN(qp.`rem_minutes`)
FROM `question_paper` AS qp
WHERE qp.em_id=em.`em_id`
AND qp.student_id='$sid')
ORDER BY qp1.`rem_sec` ASC
LIMIT 1) AS rem_sec
,(SELECT q.`std_qno` FROM `question_paper` AS q WHERE
(q.`em_id`,q.`std_qno`,q.`rem_minutes`,q.`rem_sec`) = (
SELECT qp1.`em_id`,qp1.`std_qno`,qp1.`rem_minutes`,qp1.`rem_sec`
FROM `question_paper` AS qp1 WHERE qp1.`rem_minutes` IN
(SELECT MIN(qp.`rem_minutes`)
FROM `question_paper` AS qp
WHERE qp.em_id= em.`em_id`
AND qp.student_id='$sid')
ORDER BY qp1.`rem_sec` ASC
LIMIT 1)) AS last_ques
FROM `exam_master` AS em
WHERE em.`em_id`=$id") or die(mysql_error());
$rslt = mysql_fetch_assoc($query);
$total_quess = $rslt['total_ques'];

$sqlc = mysql_query("SELECT cc.`class_name` FROM `class_code` AS cc, `exam_master` AS em WHERE em.`ccid` = cc.`ccid` AND em.`em_id` = $id") or die(mysql_error());
$showc = mysql_fetch_assoc($sqlc);
$cc = $showc['class_name'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>:: Online Exam System ::</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
    
    <script type = "text/javascript" >
    history.pushState(null, null, 'start_exam.php');
    window.addEventListener('popstate', function(event) {
    history.pushState(null, null, 'start_exam.php');
    });
    </script>

  </head>

 <!-- <body oncontextmenu="return false;">-->
 
      
      <header class="header white-bg" id="headr" style="background-color:#F67A6E">
          <div class="sidebar-toggle-box">

          </div>
          <!--logo start-->
        <a href="#" class="logo" style="margin-top:1px"><img src="BD2.png" width="70px" height="60px"><span></span></a>
                
        <form action="" method="post" id="remt"  style="display:none">
        <table border="0" style="margin-top: 5px;" align="center" cellpadding="10" id="remt">
        <tr>
        <td>
        <?php 
		if($rslt['rem_timing'] == '' || $rslt['rem_timing'] == NULL ||	$rslt['rem_sec'] == '' || $rslt['rem_sec'] == NULL) {
		$rem_sec=00;
		echo "<input type='hidden' class='form-control' style='width: 100px' id='mns' readonly value='$rslt[tot_minutes]' />";
		echo "<input type='hidden' class='form-control' style='width: 100px' id='scs' readonly value='$rem_sec' />";
		} else {
		echo "<input type='hidden' class='form-control' style='width: 100px' id='mns' readonly value='$rslt[rem_timing]' />";
		echo "<input type='hidden' class='form-control' style='width: 100px' id='scs' readonly value='$rslt[rem_sec]' />"; 
		} 
		?>
        </td>

        <td valign="top">
  <label for="exampleInputEmail1" style="color:#FFF">Remaining Time:</label> &nbsp;&nbsp;
  <span id="showmns" style="font-size:30px; color:#FFF">00</span> <span style="color:#FFF">:</span> <span id="showscs" style="font-size:20px; color:#FFF">00</span> 
        </td>
       
        <td valign="top" style="padding-left: 200px">
     <label for="exampleInputEmail1" style="font-size: 18px;color:#FFF"><?php echo $sid; ?> &nbsp; / &nbsp; <?php echo $sname; ?>  &nbsp; / &nbsp; <?php echo $cc; ?></label><br>
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

    ctmnts = parseInt(document.getElementById('mns').value) + 0;
    ctsecs = parseInt(document.getElementById('scs').value) * 1;

    if(isNaN(ctmnts)) ctmnts = 0;
    if(isNaN(ctsecs)) ctsecs = 0;

    document.getElementById('mns').value = ctmnts;
    document.getElementById('scs').value = ctsecs;
    startchr = 1;
    document.getElementById('btnct').setAttribute('disabled', 'disabled');   
  }

  if(ctmnts==0 && ctsecs==0) {
    startchr = 0;
    document.getElementById('btnct').removeAttribute('disabled');  
	exam_finish();   

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

  document.getElementById('showmns').innerHTML = ctmnts;
  document.getElementById('showscs').innerHTML = ctsecs;
  setTimeout('countdownTimer()', 1000);
}
</script>