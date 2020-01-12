<?php
include("includes/config.php");

if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];

$query = mysql_query("SELECT c.`cat_name`,c.`cat_id` FROM `category` AS c WHERE c.`cat_id` IN (SELECT DISTINCT qb.`cat_id` FROM  `question_bank` AS qb WHERE qb.`scid`=$id)") or die(mysql_error());
$count = mysql_num_rows($query);
if($count>0) {
echo "<option value=''>Select Option</option>";
while($row = mysql_fetch_assoc($query)) {
echo "<option value='$row[cat_id]'>$row[cat_name]</option>";	
}
} else {
echo "<option value=''>No Question Available</option>";	

}
}
?>
                       
                       