<?php
include("includes/config.php");

if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$idd = $_REQUEST['idd'];
$date = $_REQUEST['date'];

$query = mysql_query("SELECT em.`em_id`, CONCAT(CONCAT(DATE_FORMAT(em.`e_start_time`,'%h:%i %p'),' - '),DATE_FORMAT(em.`e_end_time`,'%h:%i %p')) AS times
FROM `exam_master` AS em
WHERE em.`cat_id`=$idd
AND em.`ccid`=$id
AND em.`exam_date`='$date'") or die(mysql_error());
$count = mysql_num_rows($query);

echo "<option value=''>Select Option</option>";
while($row = mysql_fetch_assoc($query)) {
	
		//@$EndDate = $row['exam_date'];
        //@$newDate2 = date("d-m-Y", strtotime($EndDate));

echo "<option value='$row[em_id]'>$row[times]</option>";	
}

}

?>
                       
                       