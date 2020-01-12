<?php
include("../includes/connection.php");
if(isset($_REQUEST['ccid'])) {
$ccid = $_REQUEST['ccid'];
$scd_id = $_REQUEST['scd_id'];

$query = mysql_query("SELECT l.`ledger_id`,l.`paid_amt` AS tot_payment,NULL AS paid_amt,l.`payment_date` FROM `student_ledger` AS l
					  WHERE l.scd_id=$scd_id AND l.`payment_type`='T'
					  UNION
					  SELECT l.`ledger_id`,NULL AS tot_payment,l.`paid_amt` AS paid_amt,l.`payment_date` FROM `student_ledger` AS l
					  WHERE l.scd_id=$scd_id AND l.`payment_type`='P'") or die(mysql_error());
						
						
$class_name = mysql_query("SELECT `class_name` FROM `class_code` WHERE `ccid`=$ccid ") or die(mysql_error());
$cname = mysql_fetch_array($class_name);
$class_n = $cname['class_name'];


    $st_name = mysql_query("SELECT `student_name` FROM `student_info` AS si, `student_course_detail` AS scd
							WHERE scd.`student_id`=si.`student_id`
							AND scd.`scd_id`=$scd_id") or die(mysql_error());
	$sname = mysql_fetch_assoc($st_name);
	$s_name = $sname['student_name'];
?>

                          <thead>
                          <tr style="background-color:#CCC; height:50px">
                          <td style="border:none"><b>Student Name</b></td>
                          <td style="border:none"><?php echo $s_name; ?></td>
                          <td style="border:none"><b>Class Name</b></td>
                          <td colspan="3" style="border:none"><?php echo $class_n; ?></td>
                          </tr>
                          <tr height="50px">   
                          <th align="left"> Invoice No.</th>     
                          <th align="left"> Date</th>
                          <th align="left"> Total Fee Amount </th>
                          <th align="left" colspan="3"> Paid Fee Amount  </th> 
                          </tr>
                          </thead>
                          <tbody> 


<?php
$num_rows = mysql_num_rows($query);

if($num_rows > 0) {
while($row = mysql_fetch_assoc($query)) {
	
	$total_fee_amount += $row['tot_payment'];
	$total_paid_amount += $row['paid_amt'];
	
	$new_date = date('d-m-Y',strtotime($row['payment_date']));
	
	echo "<tr>";
	echo "<td>$row[ledger_id]</td>";
	echo "<td>$new_date</td>";
	echo "<td>$row[tot_payment]</td>";
	echo "<td colspan='3'>$row[paid_amt]</td>";
	echo "</tr>";
}
} else {
	echo "<tr>";
	echo "<td colspan='6'>No Ledger Found</td>";
	echo "</tr>";
	
}

if($num_rows > 0) {
$final_amount = $total_fee_amount-$total_paid_amount;

echo "<tr style='background-color:#333;color:#fff;height:30px'>";
echo "<td style='border:none'>&nbsp;</td>";
echo "<td style='border:none'>&nbsp;</td>";
echo "<td style='border:none'><b>Rs. $total_fee_amount /-</b></td>";
echo "<td style='border:none'><b>Rs. $total_paid_amount /-</b></td>";
echo "<td style='border:none'><b>Balance Fee:  &nbsp;&nbsp; Rs. $final_amount /- </b></td>";
   if($final_amount > 0) { 
   echo "<td style='border:none'>
         <a class='btn btn-success' style='color:#333' data-toggle='modal' onclick='get_balance_fee($final_amount);' href='#myModal2'>Payment</a>
		 </td>"; 
   } else {
   echo "<td style='border:none'>&nbsp;</td>";   
   }
echo "</tr>";

} else {
	
	$new_query = mysql_query("SELECT scd.rem_fee FROM `student_course_detail` AS scd 
								WHERE scd.`ccid` = '$ccid'
								AND scd.`scd_id`='$scd_id'") or die(mysql_error());
	
	while ($result = mysql_fetch_assoc($new_query)) {
		            echo "<tr style='background-color:#333;color:#fff'>";
					echo "<td style='border:none'>&nbsp;</td>";
					echo "<td style='border:none'>&nbsp;</td>";
					echo "<td style='border:none'>&nbsp;</td>";
					echo "<td style='border:none'>&nbsp;</td>";
					echo "<td style='border:none'><b>Balance Fee:  &nbsp;&nbsp; Rs. $result[rem_fee] /- </b></td>";
					   if($result['rem_fee'] > 0) { 
 echo "<td style='border:none'>
	   <a class='btn btn-success' style='color:#333' data-toggle='modal' onclick='get_balance_fee($result[rem_fee]);' href='#myModal2'>Payment</a>            </td>"; 
					   } else {
					   echo "<td style='border:none'>&nbsp;</td>";   
					   }
					echo "</tr>";
		
	}
	
}



}

?>

</tbody>
                       
                     