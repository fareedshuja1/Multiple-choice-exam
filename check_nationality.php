<?php
include("includes/config.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$query = mysql_query("SELECT `nat_title` FROM `nationality` WHERE `nat_id`=$id") or die(mysql_error());
$row = mysql_fetch_assoc($query);
//$v = trim($row['nat_title']);
$v=$row['nat_title'];
echo $v;
}
?>
                       