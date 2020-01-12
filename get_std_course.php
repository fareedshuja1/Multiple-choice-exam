<?php
include("includes/config.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$sid = $_SESSION['student_id'] ;

$exam_update= mysql_query("UPDATE `question_paper` SET exam_status='Y' WHERE student_id='$sid'
AND `em_id` IN (SELECT em.`em_id` FROM `exam_master` AS em
WHERE em.`exam_date`< CURDATE()
AND em.`ccid`=$id)") or die(mysql_error());

if ($exam_update) {

$query = mysql_query("SELECT c.`cat_name`,em.`exam_date`,em.`total_ques`,em.`tot_minutes`, em.`em_id`,em.`pass_per`
,(SELECT  COUNT(1) FROM `question_paper` qp
WHERE qp.`student_id`='$sid'
AND qp.`em_id`=em.`em_id`
AND UCASE(qp.`std_status`)=('Y')) AS correct
,(SELECT  COUNT(1) FROM `question_paper` qp
WHERE qp.`student_id`='$sid'
AND qp.`em_id`=em.`em_id`
AND UCASE(qp.`std_status`)=('N')) AS incorrect
,(SELECT  COUNT(1) FROM `question_paper` qp
WHERE qp.`student_id`='$sid'
AND qp.`em_id`=em.`em_id`
AND qp.`std_status`IS NULL) AS unsolved
,ROUND((SELECT  COUNT(1) FROM `question_paper` qp
WHERE qp.`student_id`='$sid'
AND qp.`em_id`=em.`em_id`
AND UCASE(qp.`std_status`)=('Y'))*100/IFNULL(em.`total_ques`,0),2) AS Per
,(CASE
WHEN em.`pass_per` <= ROUND((SELECT  COUNT(1) FROM `question_paper` qp
WHERE qp.`student_id`='$sid'
AND qp.`em_id`=em.`em_id`
AND UCASE(qp.`std_status`)=('Y'))*100/IFNULL(em.`total_ques`,0),2) THEN 'Pass' ELSE 'Fail'
END) AS Pass_status
FROM `class_code` AS cc,`exam_master` AS em,`category` AS c
WHERE cc.`ccid`=em.`ccid`
AND em.`cat_id`=c.`cat_id`
AND em.`exam_date`<=CURDATE()
AND em.`em_id` IN (SELECT DISTINCT qp.`em_id` FROM `question_paper` AS qp WHERE qp.`student_id` = '$sid'
AND qp.exam_status = 'Y')
AND cc.`ccid`=$id") or die(mysql_error());

$count = mysql_num_rows($query);
if($count > 0) {
		while($row = mysql_fetch_assoc($query)) { 
		if($row['unsolved'] == $row['total_ques']) {
		$var1 = "Absent";
		$var2 = "Absent";
		$var3 = "Absent";
		$var4 = "Fail";
		} else {
		$var1 = $row['correct'];
		$var2 = $row['incorrect'];
		$var3 = $row['unsolved'];
		$var4 = $row['Pass_status'];		
		}
		
		
				$EndDate = $row['exam_date'];
        $newDate2 = date("d-m-Y", strtotime($EndDate));
		
		echo "<tr>
             <td>$row[cat_name]</td>
             <td>$newDate2 </td>
             <td>$row[total_ques]</td>
			 <td>$row[tot_minutes]</td>
			 <td>$var1</td>
             <td>$var2</td>
			 <td>$var3</td>
			 <td>$var4</td>
			 
			 <td><span class='badge bg-success'>$row[Per]</span></td>
             </tr>";
	 }
} else {
	echo "<tr>
	      <td colspan='5' align='center'>No Result Found</td>
	      </tr>";
}
}
}
?>
                       
                      
                       