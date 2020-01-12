<?php
include("includes/config.php");

if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];

$query = mysql_query("SELECT * FROM `sub_courses` WHERE mcid='$id'") or die(mysql_error());
$count = mysql_num_rows($query);
if($count>0) {
while($row = mysql_fetch_assoc($query)) {
echo "<option value='$row[scid]'>$row[sc_title]</option>";	
}
} else {
echo "<option value=''>No Record Available</option>";	

}

//echo "hello world" . $id;
}
?>
                       
                       