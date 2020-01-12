<?php
require 'PHPMailer/PHPMailerAutoload.php';
include('includes/config.php');

$ccode  = $_REQUEST['ccode'];
$cat_id = $_REQUEST['cat_id'];
$date   = $_REQUEST['date'];
$scid   = $_REQUEST['scid'];
$stud_id = $_REQUEST['id'];

$query = mysql_query("SELECT scd.`student_id`,si.`student_email`,si.`emergency_email`
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
AND si.`student_id`='$stud_id'") or die(mysql_error());;

$count = mysql_num_rows($query);


$sent_mail = mysql_query("SELECT `mail_host`,`mail_username`,`mail_password`,`mail_port`,`mail_sendername`
                          FROM `emails` WHERE `mail_status` = 'Active'") or die(mysql_error());
$fetch_mail = mysql_fetch_assoc($sent_mail);

$mail_host = $fetch_mail['mail_host'];
$mail_username = $fetch_mail['mail_username'];
$mail_password = $fetch_mail['mail_password'];
$mail_port = $fetch_mail['mail_port'];
$mail_sendername = $fetch_mail['mail_sendername'];


$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = $mail_host;
$mail->SMTPAuth = true;
$mail->Username = $mail_username;
$mail->Password = $mail_password;
$mail->SMTPSecure = 'tls';
$mail->Port = $mail_port;
$mail->FromName = $mail_sendername;


//while($row = mysql_fetch_assoc($query)) {
	
	$row = mysql_fetch_assoc($query);
	
	
	$re_name =  $row['std_info'];
    $re_email =  $row['student_email'];
    $cc_address = $row['emergency_email'];
	
	$message = "<table border='1' style='border-collapse:collapse; width:100%; height:100px'>
				<tr>
				<td style='background-color:#F1F1F1'><b>STUDENT NAME</b></td>
				<td>$re_name</td>
				<td style='background-color:#F1F1F1'><b>STUDENT ID</b></td>
				<td>$row[student_id]</td>
				<td style='background-color:#F1F1F1'><b>TOTAL QUESTIONS</b></td>
				<td>$row[total_ques]</td>
				</tr>
				<tr>
				<td style='background-color:#F1F1F1'><b>TOTAL MINUTES</b></td>
				<td>$row[tot_minutes]</td>
				<td style='background-color:#F1F1F1'><b>CORRECT ANSWERS</b></td>
				<td>$row[Correct_ans]</td>
				<td style='background-color:#F1F1F1'><b>INCORRECT ANSWERS</b></td>
				<td>$row[Incorrect_ans]</td>
				</tr>
				<tr>
				<td style='background-color:#F1F1F1'><b>UNSOLVED QUESTIONS</b></td>
				<td>$row[Unsolved]</td>
				<td style='background-color:#F1F1F1'><b>PASSING %AGE</b></td>
				<td>$row[pass_per]</td>
				<td style='background-color:#F1F1F1'><b>RESULT</b></td>
				<td>$row[Pass_fail]</td>
				</tr>
				</table>";
	
				$mail->addAddress($row['student_email'], $row['std_info']);
				$mail->AddBCC($row['emergency_email']);
				$mail->WordWrap = 1000;
				$mail->isHTML(true);
				$mail->Subject = 'Online Exam Result';
				$mail->Body    = $message;
               // $mail->send();
				
				if(!$mail->send()) {
				   echo 'Message could not be sent.';
				   echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
				   echo 'Email has been sent.';
				}				
				
//}



?>