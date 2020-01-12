<?php
require 'PHPMailer/PHPMailerAutoload.php';
include('includes/config.php');


if (!$_SESSION['student_id']) { header('Location: login.php'); }

$sid = $_SESSION['student_id'] ;

$emid = $_REQUEST['emid'];

$show_res = mysql_query("SELECT 
c.`cat_name`,cc.`class_name`,em.`total_ques`,em.`tot_minutes`,em.`pass_per`
,(SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`='$sid'
AND q.`std_status`='Y'
) AS Correct_ans
,(SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`='$sid'
AND q.`std_status`='N'
) AS Incorrect_ans
,(SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`='$sid'
AND (q.`std_status` IS NULL)
) AS Unsolved
,ROUND(((SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`='$sid'
AND q.`std_status`='Y'
)*100/em.`total_ques`),2) AS Percentage
,CASE
WHEN ROUND(((SELECT COUNT(1) FROM `question_paper` AS q
WHERE q.`em_id`=em.`em_id`
AND q.`student_id`='$sid'
AND q.`std_status`='Y'
)*100/em.`total_ques`),2)>=em.`pass_per` THEN 'Pass'
ELSE
'Fail'
END Pass_fail
FROM `exam_master` AS em,`category` AS c,`class_code` AS cc
WHERE em.`cat_id`=c.`cat_id`
AND em.`ccid`=cc.`ccid`
AND em.`em_id`= $emid") or die(mysql_error());

$show_ress = mysql_fetch_assoc($show_res);


$selection = mysql_query("SELECT s.`student_name`,s.`student_image`,s.`student_email`,s.`emergency_email` FROM `student_info` AS s
WHERE s.`student_id`='$sid'") or die(mysql_error());
$selection_r = mysql_fetch_assoc($selection);


$sent_mail = mysql_query("SELECT `mail_host`,`mail_username`,`mail_password`,`mail_port`,`mail_sendername`
                          FROM `emails` WHERE `mail_status` = 'Active'") or die(mysql_error());
$fetch_mail = mysql_fetch_assoc($sent_mail);

$mail_host = $fetch_mail['mail_host'];
$mail_username = $fetch_mail['mail_username'];
$mail_password = $fetch_mail['mail_password'];
$mail_port = $fetch_mail['mail_port'];
$mail_sendername = $fetch_mail['mail_sendername'];
$re_name =  $selection_r['student_name'];
$re_email =  $selection_r['student_email'];
$cc_address = $selection_r['emergency_email'];

								
$message = "<table border='1' style='border-collapse:collapse; width:100%; height:100px'>
			<tr>
			<td style='background-color:#F1F1F1'><b>STUDENT NAME</b></td>
			<td>$selection_r[student_name]</td>
			<td style='background-color:#F1F1F1'><b>CLASS</b></td>
			<td>$show_ress[class_name]</td>
			<td style='background-color:#F1F1F1'><b>TOTAL QUESTIONS</b></td>
			<td>$show_ress[total_ques]</td>
			</tr>
			<tr>
			<td style='background-color:#F1F1F1'><b>TOTAL MINUTES</b></td>
			<td>$show_ress[tot_minutes]</td>
			<td style='background-color:#F1F1F1'><b>CORRECT ANSWERS</b></td>
			<td>$show_ress[Correct_ans]</td>
			<td style='background-color:#F1F1F1'><b>INCORRECT ANSWERS</b></td>
			<td>$show_ress[Incorrect_ans]</td>
			</tr>
			<tr>
			<td style='background-color:#F1F1F1'><b>UNSOLVED QUESTIONS</b></td>
			<td>$show_ress[Unsolved]</td>
			<td style='background-color:#F1F1F1'><b>PASSING %AGE</b></td>
			<td>$show_ress[pass_per]</td>
			<td style='background-color:#F1F1F1'><b>OBTAINED %AGE</b></td>
			<td>$show_ress[Percentage]</td>
			</tr>
			</table>";
                      
                   

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = $mail_host;
$mail->SMTPAuth = true;
$mail->Username = $mail_username;
$mail->Password = $mail_password;
$mail->SMTPSecure = 'tls';
$mail->Port = $mail_port;
$mail->FromName = $mail_sendername;
$mail->addAddress($re_email, $re_name);
$mail->AddCC($cc_address);
$mail->WordWrap = 1000;
$mail->isHTML(true);
$mail->Subject = 'Online Exam Result';
$mail->Body    = $message;

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
   echo 'Email has been sent to your email id.!';
}

?>