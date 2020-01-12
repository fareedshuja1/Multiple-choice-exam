<?php include("includes/config.php");
extract($_POST);

$query = mysql_query("SELECT scd.`student_id`,CONCAT(CONCAT(si.`student_name`,CASE WHEN UCASE(si.`student_gender`)='MALE' THEN ' S/O '
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
AND si.`student_id` = '$std_id'
AND em.`em_id` = $em_id");
$count = mysql_num_rows($query);


$course_q = mysql_query("SELECT `sc_title` FROM `sub_courses` WHERE `scid` = $scid") or die(mysql_error());
$course_r = mysql_fetch_assoc($course_q);
$course = $course_r['sc_title'];

$class_q = mysql_query("SELECT `class_name` FROM `class_code` WHERE `ccid` = $ccode") or die(mysql_error());
$class_r = mysql_fetch_assoc($class_q);
$class = $class_r['class_name'];

$cat_q = mysql_query("SELECT `cat_name` FROM `category` WHERE `cat_id` = $cat_id") or die(mysql_error());
$cat_r = mysql_fetch_assoc($cat_q);
$cat = $cat_r['cat_name'];

$newDate = date("d-m-Y", strtotime($date));


$detail = mysql_query("SELECT * FROM `student_info` AS s LEFT JOIN `nationality` AS n ON (s.`nat_id` = n.`nat_id`) LEFT JOIN                       `religion` AS r ON (s.`rel_id`=r.`rel_id`) WHERE s.`student_id`='$std_id'") or die(mysql_error());
$row = mysql_fetch_assoc($detail);


?>

<title>:: Student's Exam Report ::</title>

                        <table width="80%" align="center" border="0" style="">
                        <tr align="center">
                        <td align="center" colspan=""><img src="BD2.png" width="150" height="120" /></td></tr>
                        <tr><td colspan="">&nbsp;</td></tr>
                        <tr><td colspan="">&nbsp;</td></tr>
                        </table>
                        
                                                
                       <table width="80%" align="center" cellpadding="5" cellspacing="5" style="font-size:14px">
                       <tr style="background-color:#F9F9F9">
                       <td><b>NAME</b></td> <td><?php echo $row['student_name']; ?></td>
                       <td><b>FATHER NAME</b></td> <td><?php echo $row['student_fname']; ?></td>
                       <td><b>GENDER</b></td> <td><?php echo $row['student_gender']; ?></td>
                       </tr>
               
                       <tr>
                       <td><b>STUDENT NIC</b></td> <td><?php echo $row['student_nic']; ?></td>
                       <td><b>STUDENT PHONE NO.</b></td> <td><?php echo $row['student_phone']; ?></td>
                       <td><b>STUDENT CELL NO.</b></td> <td><?php echo $row['student_cell']; ?></td>
                       </tr>
                                          
                       <tr style="background-color:#F9F9F9">
                       <td><b>FATHER NIC</b></td> <td><?php echo $row['student_fnic']; ?></td>
                       <td><b>DOB</b></td> <td><?php echo $row['student_dob']; ?></td>
                       <td><b>STUDENT EMAIL</b></td> <td><?php echo $row['student_email']; ?></td>
                       </tr>
                                           
                       <tr>
                       <td><b>NATIONALITY</b></td> <td><?php echo $row['nat_title']; ?></td>
                       <td><b>RELIGION</b></td> <td><?php echo $row['rel_title']; ?></td>
                       <td><b>STUDENT ADDRESS</b></td> <td colspan="5"><?php echo $row['student_address']; ?></td>
                       </tr>
                       
                       <tr style="background-color:#F9F9F9">
                       <td><b>EMERGENCY PHONE NO.</b></td> <td><?php echo $row['emergency_phone']; ?></td>
                       <td><b>EMERGENCY CELL NO.</b></td> <td><?php echo $row['emergency_cell']; ?></td>
                       <td><b>EMERGENCY EMAIL</b></td> <td><?php echo $row['emergency_email']; ?></td>
                       </tr>
                     
                       <tr>
                       <td><b>CLASS CODE:</b></td> <td><?php echo $class; ?></td>
                       <td><b>CATEGORY:</b></td>   <td><?php echo $cat; ?></td>
                       <td><b>EXAM DATE:</b></td>  <td><?php echo $newDate; ?></td>
                       </tr>
                                            
                       </table>
                       <br /><br />


                        <!--<h3 align="center">Class / Course Details</h3>--> 
                        <table width='80%' border='1' align="center" style="border-collapse:collapse;font-size:14px">
                        <tr style="background-color:#CCC;">
                        <td align="center"><b>TOTAL MARKS</b></td>
                        <td align="center"><b>OBTAINED MARKS</b></td>
                        <td align="center"><b>PERCENTAGE</b></td>
                        <td align="center"><b>RESULT</b></td>
                        </tr>
 
  <?php
  if($count>0) {
						while($rows = mysql_fetch_assoc($query)) {
						echo "<tr>";
						echo "<td align='center'>$rows[total_ques]</td>";
						echo "<td align='center'>$rows[Correct_ans]</td>";
						echo "<td align='center'>$rows[Percentage]</td>";
						
						if($row['Pass_fail'] == 'Pass') {
						echo "<td align='center'><span class='label label-success' style='font-size: 12px'>PASS</span></td>";
						} else {
						echo "<td align='center'><span class='label label-danger' style='font-size: 12px'>FAIL</span></td>";
						}
						echo "</tr>";	
						}
						} else {
						echo "<tr>";
						echo "<td colspan='6'> No Record Found </td>";
						echo "</tr>";
						}
 
 ?>
                        </table>
 
<br /><br /> 
<table width='80%' border='0' align="center" style="border-collapse:collapse;">
<tr align="center">
<td align="center">COMPUTER GENERATED REPORT &nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp; Dated: <?php echo date("d-m-Y");?></td>
</tr> 
</table>
                          
                     
   