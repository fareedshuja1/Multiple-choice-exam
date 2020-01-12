<?php include("includes/config.php");
extract($_POST);

$query = mysql_query(stripslashes($sql));
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

?>
<title>::  Exam Report ::</title>



<table width="80%" align="center" border="0" style="font-size:12px">
<tr align="center">
<td align="center" colspan="8"><img src="BD2.png" width="150" height="120" /></td></tr>
<tr><td colspan="8">&nbsp;</td></tr>
<tr><td colspan="8">&nbsp;</td></tr>
<tr>
<td align="center"><b>COURSE:</b></td>     <td align="center"><?php echo $course; ?></td>
<td align="center"><b>CLASS CODE:</b></td> <td align="center"><?php echo $class; ?></td>
<td align="center"><b>CATEGORY:</b></td>   <td align="center"><?php echo $cat; ?></td>
<td align="center"><b>EXAM DATE:</b></td>  <td align="center"><?php echo $newDate; ?></td>
</tr>
</table>



<br />
<table width='80%' border='1' align="center" style="border-collapse:collapse;">
 <tr style="background-color:#CCC;font-size:12px">
        <td align="center"><b>ID</b></td>
        <td align="center"><b>NAME</b></td>
        <td align="center"><b>TOTAL MARKS</b></td>
        <td align="center"><b>OBTAINED MARKS</b></td>
        <td align="center"><b>PERCENTAGE</b></td>
        <td align="center"><b>RESULT</b></td>
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
<table width='80%' border='0' align="center" style="border-collapse:collapse;font-size:12px">
<tr align="center">
<td align="center">COMPUTER GENERATED REPORT &nbsp;&nbsp;&nbsp; - &nbsp;&nbsp;&nbsp; Dated: <?php echo date("d-m-Y");?></td>
</tr> 
</table>