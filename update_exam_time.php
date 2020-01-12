<?php
include("includes/config.php"); 
$sid = $_SESSION['student_id'];

$emid   = $_REQUEST['emid'];
$ctmnts = $_REQUEST['ctmnts'];
$ctsecs = $_REQUEST['ctsecs'];


if(isset($_REQUEST['emid'])) {
	
$sql = mysql_query("SELECT qp1.`student_id`,qp1.`em_id`,qp1.`ques_id`,qp1.`std_qno` ,qp1.`rem_minutes`,qp1.`rem_sec`
FROM `question_paper` AS qp1 WHERE qp1.`rem_minutes` IN
(SELECT MIN(qp.`rem_minutes`)
FROM `question_paper` AS qp
WHERE qp.em_id=$emid AND qp.student_id='$sid')
ORDER BY qp1.`rem_sec` ASC
LIMIT 1") or die(mysql_error());

$result = mysql_fetch_assoc($sql);

$ques_id      = $result['ques_id'];
$std_qno      = $result['std_qno'];
$rem_minutes  = $result['rem_minutes'];
$rem_sec      = $result['rem_sec'];

if($sql) {
	
	$update = mysql_query("UPDATE `question_paper` SET `rem_minutes` = '$ctmnts', `rem_sec` = '$ctsecs' WHERE `em_id` = '$emid'
                           AND `student_id` ='$sid' AND `ques_id` ='$ques_id' AND `std_qno` ='$std_qno'
						   AND `rem_minutes` = '$rem_minutes' AND `rem_sec` = '$rem_sec'") or die(mysql_error());
	
}
	
}


?>