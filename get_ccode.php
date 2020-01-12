<?php
include("includes/config.php");

if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];

$query = mysql_query("SELECT cd.`class_name`,cd.`ccid` FROM `class_code` AS cd
WHERE cd.`ccid` IN (SELECT scd.`ccid` FROM `student_course_detail` AS scd 
WHERE scd.`ccid` IN (SELECT cc.`ccid` FROM `class_code` AS cc WHERE cc.`scid` =$id)
AND scd.`scd_status`=0)") or die(mysql_error());
$count = mysql_num_rows($query);
if($count>0) {
echo "<option value=''>Select Option</option>";
while($row = mysql_fetch_assoc($query)) {
echo "<option value='$row[ccid]'>$row[class_name]</option>";	
}
} else {
echo "<option value=''>No Students in this class</option>";	

}
}
?>
                       
                       