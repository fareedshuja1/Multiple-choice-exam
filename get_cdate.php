<?php
include("includes/config.php");

if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$idd = $_REQUEST['idd'];

$query = mysql_query("SELECT DISTINCT em.`exam_date`
FROM `exam_master` AS em
WHERE em.`cat_id`=$idd
AND em.`ccid`=$id
ORDER BY em.`exam_date` DESC") or die(mysql_error());
$count = mysql_num_rows($query);

if($count>0) {
echo "<option value=''>Select Option</option>";
while($row = mysql_fetch_assoc($query)) {
	
		@$EndDate = $row['exam_date'];
        @$newDate2 = date("d-m-Y", strtotime($EndDate));
	
echo "<option value='$row[exam_date]'>$newDate2</option>";	
}
} else {
echo "<option value=''>No Category Available</option>";	

}

}

?>
                       
                       