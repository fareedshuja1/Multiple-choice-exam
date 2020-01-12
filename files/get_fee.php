<?php
include("../includes/connection.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
if($id != NULL || $id != '') {
$query = mysql_query("SELECT s.`course_fee` FROM `sub_courses` AS s
         WHERE s.`scid` IN (SELECT c.`scid` FROM `class_code` AS c 
		 WHERE c.`ccid`=$id)") or die(mysql_error());
$row = mysql_fetch_assoc($query);
echo $row['course_fee'];
}
} else {
echo "";	
}

//echo "hello";


?>