<?php
include("includes/config.php");

if(isset($_REQUEST['s_date'])) {

$s_date = $_REQUEST['s_date'];
$scid = $_REQUEST['scid'];


$query = mysql_query("SELECT sc.`course_duration` FROM `sub_courses` AS sc WHERE sc.`scid`= $scid") or die(mysql_error());
$row = mysql_fetch_assoc($query);
$duration = $row['course_duration'];


$query1 = mysql_query("SELECT DATE_ADD('$s_date', INTERVAL '$duration' MONTH ) as end_dt FROM DUAL") or die(mysql_error());
$row1 = mysql_fetch_assoc($query1);
$duration1 = $row1['end_dt'];

echo $duration1;
//echo "hello";

}
?>
                       
                       