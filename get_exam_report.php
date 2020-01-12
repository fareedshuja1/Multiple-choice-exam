<?php
include("includes/config.php");

if(isset($_REQUEST['ccode'])) {
$ccode  = $_REQUEST['ccode'];
$cat_id = $_REQUEST['cat_id'];
$date   = $_REQUEST['date'];
$scid   = $_REQUEST['scid'];
$etime   = $_REQUEST['etime'];

$sql = "SELECT em.`em_id`,scd.`student_id`,si.`student_email`,si.`emergency_email`
,CONCAT(CONCAT(si.`student_name`,CASE WHEN UCASE(si.`student_gender`)='MALE' THEN ' S/O '
WHEN UCASE(si.`student_gender`)='FEMALE' THEN ' D/O '
ELSE
' Select Gender ' END
),si.`student_fname`) AS std_info,
em.`total_ques`,em.`tot_minutes`,em.`pass_per`
,(SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`=scd.`student_id`
AND q.`std_status`='Y'
) AS Correct_ans
,(SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`=scd.`student_id`
AND q.`std_status`='N'
) AS Incorrect_ans
,(SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`=scd.`student_id`
AND (q.`std_status` IS NULL)
) AS Unsolved
,ROUND(((SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`=scd.`student_id`
AND q.`std_status`='Y'
)*100/em.`total_ques`),2) AS Percentage
,CASE
WHEN ROUND(((SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`=scd.`student_id`
AND q.`std_status`='Y'
)*100/em.`total_ques`),2)>=em.`pass_per` THEN 'Pass'
ELSE
'Fail'
END Pass_fail
FROM `exam_master` AS em,`class_code` AS cc,`student_course_detail` AS scd,`student_info` AS si
WHERE cc.`ccid`=scd.`ccid`
AND scd.`student_id`=si.`student_id`
AND em.`ccid`=cc.`ccid`
AND em.`exam_date`='$date'
AND em.`ccid`= $ccode
AND em.`cat_id`= $cat_id
AND em.`em_id`=$etime
AND scd.`student_id` IN (SELECT xx.`student_id` FROM `question_paper`  AS xx WHERE xx.`em_id`=em.`em_id`)";

$query = mysql_query($sql) or die(mysql_error());
$count = mysql_num_rows($query);
?>
          <form action='print_students_report.php' method='post' target='_blank'>
          <input type="hidden" name="sql" id="sql" value="<?php echo $sql;?>">
          <input type="hidden" name="scid" id="scid" value="<?php echo $scid;?>">
          <input type="hidden" name="ccode" id="ccode" value="<?php echo $ccode;?>">
          <input type="hidden" name="cat_id" id="cat_id" value="<?php echo $cat_id;?>">
          <input type="hidden" name="date" id="date" value="<?php echo $date;?>">

	<table width='100%' cellpadding='10' cellspacing='' border='0' class='table table-striped border-top' id='sample_1'>
	<tr><td colspan='8' align='right'>
	     
         <!-- <button type='button' class='btn btn-link' onclick="SentEmail();"><img src='email_icon1.png'></button>-->
	      <button type='submit' class='btn btn-link'><img src='printButton.gif' style='padding-right: 40px'></button>
          </form>
		  
	</td>
	</tr>
	<tr>
	      <td><b>ID</b></td>
	      <td><b>NAME</b></td>
		  <td><b>TOTAL MARKS</b></td>
		  <td><b>OBTAINED MARKS</b></td>
		  <td><b>PERCENTAGE</b></td>
		  <td><b>RESULT</b></td>
		  <td>&nbsp;</td>
	</tr>

    <?php
    if($count>0) {
    while($row = mysql_fetch_assoc($query)) {
	echo "<tr>";
	echo "<td>$row[student_id]</td>";
	echo "<td>$row[std_info]</td>";
	echo "<td align='center'>$row[total_ques]</td>";
	echo "<td align='center'>$row[Correct_ans]</td>";
	echo "<td align='center'>$row[Percentage]</td>";
	if($row['Pass_fail'] == 'Pass') {
	echo "<td align='center'><span class='label label-success' style='font-size: 12px'>PASS</span></td>";
	} else {
    echo "<td align='center'><span class='label label-danger' style='font-size: 12px'>FAIL</span></td>";
	}
	?>
     
    <td valign="top"><button type='button' class='btn btn-link' onclick="SentEmail('<?php echo $row['student_id']; ?>')">
    <img src='email_icon1.png' style="margin-top:-1px"></button></td>

    <td>
          <form action='print_student_detail.php' method='post' target='_blank'>
          <input type="hidden" name="scid" value="<?php echo $scid;?>">
          <input type="hidden" name="ccode" value="<?php echo $ccode;?>">
          <input type="hidden" name="cat_id" value="<?php echo $cat_id;?>">
          <input type="hidden" name="date" value="<?php echo $date;?>">
          <input type="hidden" name="std_id" value="<?php echo $row['student_id']; ?>">
          <input type="hidden" name="em_id" value="<?php echo $row['em_id']; ?>">
	      <button type='submit' class='btn btn-link'><img src='printButton.gif'></button>
          </form>  
    </td>

	<?php
	echo "</tr>";	
	}
    } else {
	echo "<tr>";
	echo "<td colspan='6'> No Record Found </td>";
	echo "</tr>";
    }
	echo "</table>";
    }
    ?>