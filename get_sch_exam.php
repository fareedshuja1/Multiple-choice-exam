<?php
include("includes/config.php");
if(isset($_REQUEST['id'])) {
$id = $_REQUEST['id'];
$sid = $_SESSION['student_id'] ;
$query = mysql_query("SELECT c.`cat_name`,em.`exam_date`,DATEDIFF(em.`exam_date`,CURDATE()) AS remaining_days
,CASE
    WHEN DATEDIFF(em.`exam_date`,CURDATE()) = 0 THEN ' Today'
    WHEN DATEDIFF(em.`exam_date`,CURDATE()) = 1 THEN ' Day Left'
    ELSE ' Days Left'
END AS days
,em.`total_ques`,em.`tot_minutes`, em.`em_id`
FROM `class_code` AS cc,`exam_master` AS em,`category` AS c
WHERE em.`em_id` IN (SELECT DISTINCT q.`em_id` FROM `question_paper` AS q 
WHERE q.`em_id`=em.`em_id` AND q.`student_id`='$sid' AND q.`exam_status` IS NULL)
AND cc.`ccid`=em.`ccid`
AND em.`cat_id`=c.`cat_id`
AND em.`exam_date`>=CURDATE()
AND em.`e_end_time`> NOW()
AND cc.`ccid`=$id") or die(mysql_error());

$count = mysql_num_rows($query);
//$date = date("Y-m-d");
//$newdate = $date-2;

$Date = date("Y-m-d");
$newdate =  date('Y-m-d', strtotime($Date. ' + 3 days'));

if($count > 0) {
		while($row = mysql_fetch_assoc($query)) { 
		  
		  if($row['exam_date'] > $newdate) {
			  $image = "$row[remaining_days]"."$row[days] &nbsp; &nbsp; <img src='green.gif' />";
		  } else {
			  if($row['remaining_days'] ==0) {
			  $image = "$row[days] &nbsp; &nbsp; <img src='red.gif' /> ";
			  }
			  else
			  {
				$image = "$row[remaining_days]"."$row[days] &nbsp; &nbsp; <img src='red.gif' /> ";  
			  }
		  } 
		  
		  
		$EndDate = $row['exam_date'];
        $newDate2 = date("d-m-Y", strtotime($EndDate));
		  
		
		echo "<tr>
             <td>$row[cat_name]</td>
             <td>$newDate2</td>
             <td>$row[total_ques]</td>
			 <td>$row[tot_minutes]</td>
			 <td align='left' style='padding-left: -10px'>$image</td>
             </tr>";
	 }
} else {
	echo "<tr>
	      <td colspan='4' align='center'>No Exam Schedule</td>
	      </tr>";
}






}
?>
                       
                      
                       