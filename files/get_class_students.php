<?php
include("../includes/connection.php");
if(isset($_REQUEST['ccid'])) {
$id = $_REQUEST['ccid'];

$query = mysql_query("SELECT scd.`scd_id`,scd.`discounted_fee`,si.`student_id`,si.`student_name`,scd.`ccid`
					  FROM `student_course_detail` AS scd, `student_info` AS si
					  WHERE scd.`student_id`=si.`student_id`
					  AND scd.`ccid` ='$id'") or die(mysql_error());

    echo "<option value=''>Select Student</option>";
while($row = mysql_fetch_assoc($query)) {
	echo "<option value='$row[scd_id]'>$row[student_name]</option>";	
}

}
?>
                       
                     