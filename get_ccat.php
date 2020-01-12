<?php
include("includes/config.php");


if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$idd = $_REQUEST['idd'];

$query = mysql_query("SELECT c.`cat_id`,c.`cat_name` FROM `category` AS c
WHERE c.`cat_id` IN 
(SELECT em.`cat_id` FROM `exam_master` AS em WHERE em.`ccid` IN 
(SELECT cc.`ccid` FROM `class_code` AS cc WHERE cc.`scid`=$idd
AND cc.`ccid`=$id))") or die(mysql_error());
$count = mysql_num_rows($query);

if($count>0) {
echo "<option value=''>Select Option</option>";
while($row = mysql_fetch_assoc($query)) {
echo "<option value='$row[cat_id]'>$row[cat_name]</option>";	
}
} else {
echo "<option value=''>No Category Available</option>";	

}

}

?>
                       
                       