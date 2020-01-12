<?php
include("../includes/connection.php");

if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];

  $query = mysql_query("SELECT scd.`student_id` ,CONCAT(CONCAT(s.`student_name`,CASE WHEN `student_gender` =  'MALE'
						THEN  ' S/O ' ELSE ' D/O ' END ),`student_fname`) AS std_detail
						FROM `student_course_detail` AS scd,`student_info` AS s
						WHERE scd.`student_id`=s.`student_id`
						AND scd.`ccid`=$id") or die(mysql_error());
$count = mysql_num_rows($query);
if($count>0) {
//echo "<option value=''>Select Student</option>";
while($row = mysql_fetch_assoc($query)) {
echo "<option value='$row[student_id]'>$row[std_detail]</option>";	
}
} else {
echo "<option value=''>No Record Available</option>";	

}

}
?>
                       
                       